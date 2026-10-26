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
