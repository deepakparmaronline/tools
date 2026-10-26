<?php

/**
 * Keep incomplete detail-page records out of public indexes and sitemaps.
 * Existing standalone comparison pages under /versus/ use their own renderer.
 */
function software_page_has_detail_content(string $collection, array $item): bool {
    $routes = [
        'tool_hubs' => ['prefix' => '/tools/', 'pattern' => '#^/tools/[a-z0-9-]+/$#D'],
        'pricing' => ['prefix' => '/pricing/', 'pattern' => '#^/pricing/[a-z0-9-]+/$#D'],
        'how_to_use' => ['prefix' => '/how-to-use/', 'pattern' => '#^/how-to-use/[a-z0-9-]+/$#D'],
        'comparisons' => ['prefix' => '/compare/', 'pattern' => '#^/compare/[a-z0-9-]+/$#D'],
        'categories' => ['prefix' => '/best/', 'pattern' => '#^/best/[a-z0-9-]+/$#D'],
    ];
    if (!isset($routes[$collection])) return true;

    $url = $item['url'] ?? null;
    if (!is_string($url)) return false;
    if (!str_starts_with($url, $routes[$collection]['prefix'])) {
        return $collection === 'comparisons' && preg_match('#^/versus/[a-z0-9-]+/$#D', $url) === 1;
    }
    if (!preg_match($routes[$collection]['pattern'], $url)) return false;

    $content = $item['content'] ?? null;
    if (!is_string($content) || trim($content) === '') return false;
    return !preg_match('#<h1\\b|<!doctype\\b|<html\\b|<head\\b|<body\\b#i', $content);
}

function software_page_collections(): array {
    static $collections;
    if (isset($collections)) return $collections;

    $source = require __DIR__.'/../data/software-pages.php';
    $today = (new DateTimeImmutable('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d');
    $collections = [];

    foreach ($source as $key => $items) {
        $collections[$key] = [];
        foreach (is_array($items) ? $items : [] as $item) {
            if (!is_array($item) || ($item['status'] ?? 'draft') !== 'published') continue;
            if (!is_string($item['title'] ?? null) || trim($item['title']) === '') continue;
            if (!is_string($item['description'] ?? null) || trim($item['description']) === '') continue;
            if (!is_string($item['url'] ?? null) || !preg_match('#^/[a-z0-9][a-z0-9/-]*/$#D', $item['url'])) continue;
            if (!software_page_has_detail_content((string)$key, $item)) continue;
            if (!is_string($item['date'] ?? null)) continue;
            $date = DateTimeImmutable::createFromFormat('!Y-m-d', $item['date']);
            if (!$date || $date->format('Y-m-d') !== $item['date'] || $item['date'] > $today) continue;
            $collections[$key][] = $item;
        }
        usort($collections[$key], fn($a, $b) => strcmp($b['date'], $a['date']) ?: strcmp($a['title'], $b['title']));
    }

    return $collections;
}

function software_pages(string $collection): array {
    return software_page_collections()[$collection] ?? [];
}
