<?php
header('Content-Type: application/xml; charset=utf-8');

$root = dirname(__DIR__);
$baseUrl = 'https://toolboxkart.tech';
$urls = [];

// Directories that should never be included in the sitemap.
$excludedDirs = [
    '.git',
    '.github',
    'blog',
    'assets',
    'images',
];

function xml_escape($value) {
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

function add_page(&$urls, $root, $dir, $baseUrl) {
    $indexFile = $dir . '/index.html';
    if (!is_file($indexFile)) {
        return;
    }

    $relative = trim(str_replace($root, '', $dir), DIRECTORY_SEPARATOR);
    $urlPath = $relative === '' ? '/' : '/' . str_replace(DIRECTORY_SEPARATOR, '/', $relative) . '/';

    $urls[$urlPath] = [
        'loc' => $baseUrl . $urlPath,
        'lastmod' => date('c', filemtime($indexFile)),
    ];
}

// Include the homepage.
add_page($urls, $root, $root, $baseUrl);

// Recursively find every index.html page while ignoring WordPress /blog
// and non-page directories. This keeps the sitemap current as new tools
// and /post/ pages are added.
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {
    if (!$item->isDir()) {
        continue;
    }

    $relative = trim(str_replace($root, '', $item->getPathname()), DIRECTORY_SEPARATOR);
    if ($relative === '') {
        continue;
    }

    $parts = explode(DIRECTORY_SEPARATOR, $relative);
    $skip = false;
    foreach ($parts as $part) {
        if (in_array($part, $excludedDirs, true) || str_starts_with($part, '.')) {
            $skip = true;
            break;
        }
    }

    if ($skip) {
        continue;
    }

    add_page($urls, $root, $item->getPathname(), $baseUrl);
}

ksort($urls, SORT_STRING);

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($urls as $url) {
    echo '<url>';
    echo '<loc>' . xml_escape($url['loc']) . '</loc>';
    echo '<lastmod>' . xml_escape($url['lastmod']) . '</lastmod>';
    echo '</url>';
}

echo '</urlset>';
