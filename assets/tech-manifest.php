<?php
header('Content-Type: application/json; charset=utf-8');

$root = dirname(__DIR__) . '/tech';
$posts = [];

foreach (glob($root . '/*/index.html') as $file) {
    $html = file_get_contents($file);
    if ($html === false) {
        continue;
    }

    preg_match('/<title>(.*?)<\/title>/is', $html, $titleMatch);
    preg_match('/<meta\s+name=["\']description["\']\s+content=["\']([^"\']*)/is', $html, $descriptionMatch);
    preg_match('/<link\s+rel=["\']canonical["\']\s+href=["\']([^"\']*)/is', $html, $canonicalMatch);
    $url = $canonicalMatch[1] ?? '';
    if ($url === '') {
        continue;
    }

    $posts[] = [
        'title' => trim(html_entity_decode($titleMatch[1] ?? '', ENT_QUOTES, 'UTF-8')),
        'description' => trim(html_entity_decode($descriptionMatch[1] ?? '', ENT_QUOTES, 'UTF-8')),
        'url' => $url,
        'modified' => date('Y-m-d', filemtime($file)),
    ];
}

usort($posts, static fn($a, $b) => strcmp($b['modified'], $a['modified']) ?: strcmp($a['title'], $b['title']));
echo json_encode($posts, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
