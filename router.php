<?php
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($uri);

// Complete editorial HTML pages retain their directory canonical URLs.
if (preg_match('#^/(tech|seo-guide|explainers)/([a-z0-9-]+)/index\.html$#', $path, $matches) && is_file(__DIR__.$path)) {
    header('Location: /'.$matches[1].'/'.$matches[2].'/', true, 301);
    exit;
}
if (preg_match('#^/(tech|seo-guide|explainers)/([a-z0-9-]+)/?$#', $path, $matches)) {
    $editorialPath = '/'.$matches[1].'/'.$matches[2].'/';
    $editorialFile = __DIR__.$editorialPath.'index.html';
    if (is_file($editorialFile)) {
        if ($path !== $editorialPath) {
            header('Location: '.$editorialPath, true, 301);
            exit;
        }
        header('Content-Type: text/html; charset=UTF-8');
        readfile($editorialFile);
        return;
    }
}

if ($path === '' || $path === '/') {
    require __DIR__ . '/index.php';
    return;
}

if ($path === '/sitemap.xml') {
    require __DIR__.'/sitemap.php';
    return;
}

if (preg_match('#^/sitemap-(tools|alternatives|reviews|pricing|how-to-use|compare|categories|pages)\.xml$#', $path, $matches)) {
    require __DIR__.'/sitemap-'.$matches[1].'.php';
    return;
}

$legacyRedirects = [
    '/blog/claude-fable-5-1-whats-new-pricing-access-and-how-to-use-it/' => '/claude/',
    '/blog/gpt-6-astra-chatgpt-new-capabilities/' => '/chatgpt/chatgpt-gpt6-astra-workflow-guide',
    '/blog/google-ai-studio-prompt-testing-workflow/' => '/tools-guide/',
    '/seo-guide/keyword-clustering-guide/' => '/tools-guide/',
    '/seo-guide/robots-meta-tags-guide/' => '/ai-news/google-search-robots-meta-tags-outside-head',
];
if (isset($legacyRedirects[$path])) {
    header('Location: '.$legacyRedirects[$path], true, 301);
    exit;
}

if (preg_match('#^/alternatives(?:/index\.php)?/?$#', $path)) {
    if ($path !== '/alternatives/') {
        header('Location: /alternatives/', true, 301);
        exit;
    }
    require __DIR__.'/alternatives/index.php';
    return;
}

// Tool-first alternatives are routed from each published alternative record.
if (preg_match('#^/([a-z0-9-]+)/alternatives/?$#D', $path, $alternativeMatches)) {
    require_once __DIR__.'/includes/bootstrap.php';
    $requestedAlternativePath = '/'.$alternativeMatches[1].'/alternatives/';
    foreach (alternative_articles() as $candidateAlternative) {
        if (alternative_path($candidateAlternative) !== $requestedAlternativePath) continue;
        if ($path !== $requestedAlternativePath) {
            header('Location: '.$requestedAlternativePath, true, 301);
            exit;
        }
        $_GET['slug'] = $candidateAlternative['slug'];
        require __DIR__.'/alternatives/article.php';
        return;
    }
}


if (preg_match('#^/alternatives/([a-z0-9-]+)(?:\.php)?/?$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__.'/alternatives/article.php';
    return;
}

if (str_starts_with($path, '/alternatives/')) {
    http_response_code(404);
    require __DIR__.'/404.php';
    return;
}

if (preg_match('#^/blog/?$#', $path)) {
    header('Location: /chatgpt/', true, 301);
    exit;
}

if (preg_match('#^/blog/(.+)$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/blog-redirect.php';
    return;
}

if (preg_match('#^/(chatgpt|claude|ai-news|tools-guide)/(.+)$#', $path, $matches)) {
    $_GET['category'] = $matches[1];
    $_GET['slug'] = $matches[2];
    require __DIR__ . '/category-article.php';
    return;
}

if (preg_match('#^/([a-z0-9-]+)/([^/]+)/?$#', $path, $matches)) {
    require_once __DIR__ . '/includes/bootstrap.php';
    $toolFile = $toolFilesByPath[$matches[1].'/'.$matches[2]] ?? null;
    if ($toolFile && is_file($toolFile)) {
        require $toolFile;
        return;
    }
}

if (preg_match('#^/([a-z0-9-]+)/?$#', $path, $matches)) {
    require_once __DIR__ . '/includes/bootstrap.php';
    if (array_key_exists($matches[1], tool_categories())) {
        $category = $matches[1];
        require __DIR__ . '/includes/category-template.php';
        return;
    }
}

$physical = __DIR__ . $path;
if (is_file($physical)) {
    require $physical;
    return;
}

if (is_dir($physical)) {
    if (is_file($physical.'/index.html')) {
        header('Content-Type: text/html; charset=UTF-8');
        readfile($physical.'/index.html');
        return;
    }
    $index = $physical . '/index.php';
    if (is_file($index)) {
        require $index;
        return;
    }
}

$phpCandidate = __DIR__ . $path . '.php';
if (is_file($phpCandidate)) {
    require $phpCandidate;
    return;
}

// Permanent redirects from the previous software-cluster URL structure.
$softwareLegacyRedirects = [
    '/tools/zendesk/' => '/zendesk/',
    '/pricing/zendesk/' => '/zendesk/pricing/',
    '/how-to-use/zendesk/' => '/zendesk/how-to-use/',
    '/alternatives/zendesk-alternatives/' => '/zendesk/alternatives/',
    '/reviews/zendesk-review/' => '/zendesk/review/',
];
if (isset($softwareLegacyRedirects[$path])) {
    header('Location: '.$softwareLegacyRedirects[$path], true, 301);
    exit;
}

if ($path === '/zendesk/review/' || $path === '/zendesk/review') {
    if ($path !== '/zendesk/review/') { header('Location: /zendesk/review/', true, 301); exit; }
    require __DIR__.'/reviews/zendesk-review/index.php';
    return;
}

// Tool-first URLs: /tool/, /tool/pricing/, /tool/how-to-use/.
if (preg_match('#^/([a-z0-9-]+)/(pricing|how-to-use)/?$#D', $path, $newDetailMatches)) {
    require_once __DIR__.'/includes/bootstrap.php';
    $newCollection = $newDetailMatches[2] === 'pricing' ? 'pricing' : 'how_to_use';
    $newCanonical = '/'.$newDetailMatches[1].'/'.$newDetailMatches[2].'/';
    foreach (software_pages($newCollection) as $newPage) {
        if (($newPage['url'] ?? null) !== $newCanonical) continue;
        if ($path !== $newCanonical) {
            header('Location: '.$newCanonical, true, 301);
            exit;
        }
        require_once __DIR__.'/includes/software-detail.php';
        echo render_software_detail_page($newPage, $newCollection);
        return;
    }
}
if (preg_match('#^/([a-z0-9-]+)/?$#D', $path, $newHubMatches)) {
    require_once __DIR__.'/includes/bootstrap.php';
    $newCanonical = '/'.$newHubMatches[1].'/';
    foreach (software_pages('tool_hubs') as $newPage) {
        if (($newPage['url'] ?? null) !== $newCanonical) continue;
        if ($path !== $newCanonical) {
            header('Location: '.$newCanonical, true, 301);
            exit;
        }
        require_once __DIR__.'/includes/software-detail.php';
        echo render_software_detail_page($newPage, 'tool_hubs');
        return;
    }
}

// Software detail pages are served only from complete, published registry records.
$softwareDetailPrefixes = [
    'tools' => 'tool_hubs',
    'pricing' => 'pricing',
    'how-to-use' => 'how_to_use',
    'compare' => 'comparisons',
    'best' => 'categories',
];
if (preg_match('#^/(tools|pricing|how-to-use|compare|best)/([a-z0-9-]+)/?$#D', $path, $detailMatches)) {
    require_once __DIR__.'/includes/bootstrap.php';
    $collectionKey = $softwareDetailPrefixes[$detailMatches[1]];
    $canonicalPath = '/'.$detailMatches[1].'/'.$detailMatches[2].'/';
    foreach (software_pages($collectionKey) as $softwarePage) {
        if (($softwarePage['url'] ?? null) !== $canonicalPath) continue;
        if ($path !== $canonicalPath) {
            header('Location: '.$canonicalPath, true, 301);
            exit;
        }
        require_once __DIR__.'/includes/software-detail.php';
        $renderedPage = render_software_detail_page($softwarePage, $collectionKey);
        if ($renderedPage !== '') {
            echo $renderedPage;
            return;
        }
    }
}

http_response_code(404);
require __DIR__ . '/404.php';
