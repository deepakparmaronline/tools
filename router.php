<?php
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($uri);

if ($path === '' || $path === '/') {
    require __DIR__ . '/index.php';
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

http_response_code(404);
require __DIR__ . '/404.php';
