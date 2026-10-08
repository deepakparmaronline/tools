<?php
// Local preview only: php -S 127.0.0.1:8765 preview-router.php
$previewPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ((str_starts_with($previewPath, '/assets/') || str_starts_with($previewPath, '/images/')) && is_file(__DIR__.$previewPath)) {
    return false;
}
ob_start(static function (string $html): string {
    // Keep navigation on this preview; retain production canonicals and schema.
    $html = preg_replace('~(<a\b[^>]*\bhref=["\'])https://toolboxkart\.tech(?=/|["\'])~i', '$1', $html);
    return preg_replace('~(\b(?:src|href)=["\'])https://toolboxkart\.tech/assets/~i', '$1/assets/', $html);
});
require __DIR__.'/router.php';
