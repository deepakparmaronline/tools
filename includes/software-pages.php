<?php

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
