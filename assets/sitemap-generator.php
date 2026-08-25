<?php
header('Content-Type: application/xml; charset=utf-8');

$root = dirname(__DIR__);
$allowed_niches = ['finance', 'seo', 'image-tools'];
$urls = [];

function add_url(&$urls, $root, $relativePath, $urlPath, $changefreq, $priority) {
    $indexFile = $root . '/' . $relativePath . '/index.html';
    if (!is_file($indexFile)) return;

    $urls[] = [
        'loc' => 'https://toolboxkart.tech' . $urlPath,
        'lastmod' => date('c', filemtime($indexFile)),
        'changefreq' => $changefreq,
        'priority' => $priority,
    ];
}

add_url($urls, $root, '', '/', 'weekly', '1.0');
add_url($urls, $root, 'seo-guide', '/seo-guide/', 'weekly', '0.9');

foreach ($allowed_niches as $niche) {
    add_url($urls, $root, $niche, '/' . $niche . '/', 'weekly', '0.9');

    $nichePath = $root . '/' . $niche;
    if (!is_dir($nichePath)) continue;

    foreach (scandir($nichePath) as $slug) {
        if ($slug === '.' || $slug === '..' || $slug[0] === '.') continue;

        $toolPath = $nichePath . '/' . $slug;
        if (!is_dir($toolPath)) continue;

        add_url(
            $urls,
            $root,
            $niche . '/' . $slug,
            '/' . $niche . '/' . $slug . '/',
            'monthly',
            '0.8'
        );
    }
}

$postPath = $root . '/post';
if (is_dir($postPath)) {
    foreach (scandir($postPath) as $slug) {
        if ($slug === '.' || $slug === '..' || $slug[0] === '.') continue;

        $guidePath = $postPath . '/' . $slug;
        if (!is_dir($guidePath)) continue;

        add_url(
            $urls,
            $root,
            'seo-guide/' . $slug,
            '/seo-guide/' . $slug . '/',
            'monthly',
            '0.6'
        );
    }
}

function xml_escape($value) {
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($urls as $url) {
    echo '<url>';
    echo '<loc>' . xml_escape($url['loc']) . '</loc>';
    echo '<lastmod>' . xml_escape($url['lastmod']) . '</lastmod>';
    echo '<changefreq>' . $url['changefreq'] . '</changefreq>';
    echo '<priority>' . $url['priority'] . '</priority>';
    echo '</url>';
}

echo '</urlset>';