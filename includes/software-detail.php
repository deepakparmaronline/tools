<?php
require_once __DIR__.'/bootstrap.php';

function software_detail_config(string $collectionKey): ?array {
    $configs = [
        'tool_hubs' => [
            'pattern' => '#^/[a-z0-9-]+/$#D',
            'index_url' => '/tools/',
            'index_title' => 'Software Tool Hubs',
            'eyebrow' => 'Software tool hub',
        ],
        'pricing' => [
            'pattern' => '#^/[a-z0-9-]+/pricing/$#D',
            'index_url' => '/tools/',
            'index_title' => 'Software Pricing Guides',
            'eyebrow' => 'Pricing guide',
        ],
        'how_to_use' => [
            'pattern' => '#^/[a-z0-9-]+/how-to-use/$#D',
            'index_url' => '/tools/',
            'index_title' => 'How to Use Software',
            'eyebrow' => 'How-to guide',
        ],
        'comparisons' => [
            'pattern' => '#^/compare/[a-z0-9-]+/$#D',
            'index_url' => '/compare/',
            'index_title' => 'Software Comparisons',
            'eyebrow' => 'Software comparison',
        ],
        'categories' => [
            'pattern' => '#^/best/[a-z0-9-]+/$#D',
            'index_url' => '/best/',
            'index_title' => 'Best Software by Category',
            'eyebrow' => 'Category guide',
        ],
    ];
    return $configs[$collectionKey] ?? null;
}

function software_detail_valid_date($value): ?string {
    if (!is_string($value) || !preg_match('/^\\d{4}-\\d{2}-\\d{2}$/D', $value)) return null;
    $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value, new DateTimeZone('Asia/Kolkata'));
    if (!$date || $date->format('Y-m-d') !== $value) return null;
    $today = (new DateTimeImmutable('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d');
    return $value <= $today ? $value : null;
}

function render_software_detail_page(array $page, string $collectionKey): string {
    global $catalog;

    $config = software_detail_config($collectionKey);
    if (!$config || ($page['status'] ?? 'draft') !== 'published') return '';
    if (!software_page_has_detail_content($collectionKey, $page)) return '';

    $canonicalPath = $page['url'] ?? null;
    if (!is_string($canonicalPath) || !preg_match($config['pattern'], $canonicalPath)) return '';

    $title = trim(is_string($page['title'] ?? null) ? $page['title'] : '');
    $description = trim(is_string($page['description'] ?? null) ? $page['description'] : '');
    $content = $page['content'] ?? null;
    $date = software_detail_valid_date($page['date'] ?? null);
    if ($title === '' || $description === '' || !is_string($content) || trim($content) === '' || !$date) return '';

    $updatedDate = software_detail_valid_date($page['updated'] ?? null);
    if (!$updatedDate || $updatedDate < $date) $updatedDate = $date;

    $seoTitle = trim(is_string($page['seo_title'] ?? null) ? $page['seo_title'] : '');
    if ($seoTitle === '') $seoTitle = $title;
    $authorName = trim(is_string($page['author'] ?? null) ? $page['author'] : SITE_AUTHOR);
    if ($authorName === '') $authorName = SITE_AUTHOR;

    $canonical = url($canonicalPath);
    $pageTitle = page_title($seoTitle);
    $pageDescription = $description;
    $ogType = 'article';
    $socialImage = '';
    $image = $page['image'] ?? null;
    if (is_string($image)) {
        $image = trim($image);
        if (str_starts_with(strtolower($image), 'https://')) {
            $socialImage = $image;
        } elseif (str_starts_with($image, '/') && !str_starts_with($image, '//')) {
            $socialImage = url($image);
        }
    }
    $socialImageAlt = trim(is_string($page['image_alt'] ?? null) ? $page['image_alt'] : '');
    if ($socialImageAlt === '') $socialImageAlt = $title;

    $imageWidth = is_numeric($page['image_width'] ?? null) ? (int)$page['image_width'] : 0;
    $imageHeight = is_numeric($page['image_height'] ?? null) ? (int)$page['image_height'] : 0;
    $showFeatureImage = $socialImage !== '' && $imageWidth > 0 && $imageHeight > 0 && trim((string)($page['image_alt'] ?? '')) !== '';

    $articleSchema = [
        '@type' => 'Article',
        '@id' => $canonical.'#article',
        'headline' => $title,
        'description' => $description,
        'datePublished' => $date.'T00:00:00+05:30',
        'dateModified' => $updatedDate.'T00:00:00+05:30',
        'author' => ['@type' => 'Person', 'name' => $authorName, 'url' => url('about-deepak-parmar/')],
        'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME, 'url' => SITE_URL],
        'mainEntityOfPage' => $canonical,
        'url' => $canonical,
    ];
    if ($socialImage !== '') {
        $articleSchema['image'] = ['@type' => 'ImageObject', 'url' => $socialImage, 'caption' => $socialImageAlt];
    }

    $breadcrumbItems = [['name' => 'Home', 'url' => SITE_URL]];
    $breadcrumbLabels = [['name' => 'Home', 'href' => '/']];

    if ($collectionKey === 'tool_hubs') {
        $softwareName = trim(is_string($page['software_name'] ?? null) ? $page['software_name'] : '');
        if ($softwareName === '') {
            $softwareName = trim(explode(':', $title, 2)[0]);
            if ($softwareName === '') $softwareName = ucwords(str_replace('-', ' ', trim($canonicalPath, '/')));
        }
        $breadcrumbItems[] = ['name' => $config['index_title'], 'url' => url($config['index_url'])];
        $breadcrumbItems[] = ['name' => $softwareName, 'url' => $canonical];
        $breadcrumbLabels[] = ['name' => $config['index_title'], 'href' => $config['index_url']];
        $breadcrumbLabels[] = ['name' => $softwareName, 'href' => null];
    } elseif (in_array($collectionKey, ['pricing', 'how_to_use'], true)
        && preg_match('#^/([a-z0-9-]+)/(pricing|how-to-use)/$#D', $canonicalPath, $crumbMatch)) {
        $hubPath = '/'.$crumbMatch[1].'/';
        $hub = null;
        foreach (software_pages('tool_hubs') as $candidateHub) {
            if (($candidateHub['url'] ?? null) === $hubPath) { $hub = $candidateHub; break; }
        }
        if ($hub !== null) {
            $toolName = trim(is_string($hub['software_name'] ?? null) ? $hub['software_name'] : '');
            if ($toolName === '') $toolName = ucwords(str_replace('-', ' ', $crumbMatch[1]));
            $sectionName = $collectionKey === 'pricing' ? 'Pricing' : 'How to Use';
            $breadcrumbItems[] = ['name' => $toolName, 'url' => url($hubPath)];
            $breadcrumbItems[] = ['name' => $sectionName, 'url' => $canonical];
            $breadcrumbLabels[] = ['name' => $toolName, 'href' => $hubPath];
            $breadcrumbLabels[] = ['name' => $sectionName, 'href' => null];
        }
    }

    if (count($breadcrumbItems) === 1) {
        $breadcrumbItems[] = ['name' => $config['index_title'], 'url' => url($config['index_url'])];
        $breadcrumbItems[] = ['name' => $title, 'url' => $canonical];
        $breadcrumbLabels[] = ['name' => $config['index_title'], 'href' => $config['index_url']];
        $breadcrumbLabels[] = ['name' => $title, 'href' => null];
    }

    $schemaGraph = [$articleSchema, breadcrumbs($breadcrumbItems)];
    if ($collectionKey === 'tool_hubs') {
        $softwareName = trim(is_string($page['software_name'] ?? null) ? $page['software_name'] : '');
        if ($softwareName === '') $softwareName = trim(explode(':', $title, 2)[0]);
        $schemaGraph[] = [
            '@type' => 'SoftwareApplication',
            '@id' => $canonical.'#software',
            'name' => $softwareName,
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web browser',
            'url' => $canonical,
        ];
    }

    $extraHead = '<meta property="article:published_time" content="'.e($date.'T00:00:00+05:30').'">'
        .'<meta property="article:modified_time" content="'.e($updatedDate.'T00:00:00+05:30').'">'
        .jsonld(['@context' => 'https://schema.org', '@graph' => $schemaGraph])
        .'<link rel="stylesheet" href="'.e(asset('css/software-detail.css')).'">';

    ob_start();
    require __DIR__.'/header.php';
    ?>
    <header class="article-head software-detail__head">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb">
                <?php foreach ($breadcrumbLabels as $index => $crumb): ?>
                    <?php if ($index > 0): ?><span aria-hidden="true">›</span><?php endif; ?>
                    <?php if ($index < count($breadcrumbLabels) - 1 && is_string($crumb['href'])): ?>
                        <a href="<?=e($crumb['href'])?>"><?=e($crumb['name'])?></a>
                    <?php else: ?>
                        <span><?=e($crumb['name'])?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
            <span class="eyebrow"><?=e($config['eyebrow'])?></span>
            <h1><?=e($title)?></h1>
            <p><?=e($description)?></p>
            <div class="article-meta">
                <span>By <strong><a href="/about-deepak-parmar/"><?=e($authorName)?></a></strong></span>
                <span>Last updated <time datetime="<?=e($updatedDate)?>"><?=e(fmt_date($updatedDate))?></time></span>
            </div>
        </div>
    </header>
    <div class="container article-layout software-detail__layout">
        <article class="article-body software-detail__content">
            <?php if ($showFeatureImage): ?>
            <figure class="software-detail__feature">
                <img src="<?=e($socialImage)?>" alt="<?=e($socialImageAlt)?>" width="<?=e((string)$imageWidth)?>" height="<?=e((string)$imageHeight)?>" fetchpriority="high" decoding="async">
            </figure>
            <?php endif; ?>
            <?=$content?>
            <div class="author-box">
                <strong>About <a href="/about-deepak-parmar/"><?=e($authorName)?></a></strong>
                <p>Software research and editorial analysis for ToolboxKart.</p>
            </div>
        </article>
    </div>
    <?php
    require __DIR__.'/footer.php';
    return (string)ob_get_clean();
}
