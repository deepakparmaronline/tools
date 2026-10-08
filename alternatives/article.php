<?php
require_once __DIR__.'/../includes/bootstrap.php';
$slug = $_GET['slug'] ?? '';
$alternative = is_string($slug) ? (alternative_articles()[$slug] ?? null) : null;
if (!$alternative) {
    http_response_code(404);
    require __DIR__.'/../404.php';
    return;
}
$canonicalPath = '/alternatives/'.$alternative['slug'].'/';
if ((parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '') !== $canonicalPath) {
    header('Location: '.$canonicalPath, true, 301);
    exit;
}
require __DIR__.'/../includes/alternative-template.php';
