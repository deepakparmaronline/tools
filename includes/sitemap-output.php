<?php

function sitemap_latest(array $entries, string $fallback='2026-10-25'): string {
    return array_reduce($entries, fn($latest, $entry) => max($latest, $entry['lastmod'] ?? ''), $fallback);
}

function sitemap_emit_urlset(array $entries): void {
    header('Content-Type: application/xml; charset=UTF-8');
    $escape = fn($value) => htmlspecialchars((string)$value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    $seen = [];
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($entries as $entry) {
        $location = $entry['url'] ?? '';
        if (!is_string($location) || !str_starts_with($location, SITE_URL.'/') || isset($seen[$location])) continue;
        $seen[$location] = true;
        echo '<url><loc>'.$escape($location).'</loc>';
        if (!empty($entry['lastmod'])) echo '<lastmod>'.$escape($entry['lastmod']).'</lastmod>';
        if (!empty($entry['changefreq'])) echo '<changefreq>'.$escape($entry['changefreq']).'</changefreq>';
        if (!empty($entry['priority'])) echo '<priority>'.$escape($entry['priority']).'</priority>';
        echo '</url>';
    }
    echo '</urlset>';
}

function sitemap_software_entries(string $slug, string $collection): array {
    $items = software_pages($collection);
    $entries = [[
        'url' => SITE_URL.'/'.$slug.'/',
        'lastmod' => sitemap_latest(array_map(fn($item) => ['lastmod'=>$item['date']], $items)),
        'changefreq' => 'weekly',
        'priority' => '0.8',
    ]];
    foreach ($items as $item) {
        $entries[] = ['url'=>url($item['url']), 'lastmod'=>$item['date'], 'priority'=>'0.7'];
    }
    return $entries;
}
