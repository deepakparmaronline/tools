<?php
declare(strict_types=1);

$path = dirname(__DIR__) . '/sitemap.xml';
$xml = file_get_contents($path);
if ($xml === false) {
    fwrite(STDERR, "Unable to read sitemap.xml\n");
    exit(1);
}

libxml_use_internal_errors(true);
$doc = simplexml_load_string($xml);
$errors = libxml_get_errors();
libxml_clear_errors();
if ($doc === false || $doc->getName() !== 'sitemapindex') {
    fwrite(STDERR, "Invalid sitemap.xml: expected a sitemap index.\n");
    foreach ($errors as $error) fwrite(STDERR, trim($error->message) . "\n");
    exit(1);
}

$expectedPaths = [
    '/sitemap-tools.xml',
    '/sitemap-alternatives.xml',
    '/sitemap-reviews.xml',
    '/sitemap-pricing.xml',
    '/sitemap-how-to-use.xml',
    '/sitemap-compare.xml',
    '/sitemap-categories.xml',
    '/sitemap-pages.xml',
];
$site = 'https://toolboxkart.tech';
$expected = array_map(static fn(string $p): string => $site . $p, $expectedPaths);
$ns = $doc->getNamespaces(true)[''] ?? '';
$entries = $doc->children($ns)->sitemap;
$locations = [];
foreach ($entries as $entry) {
    $loc = trim((string) $entry->loc);
    if ($loc === '' || !filter_var($loc, FILTER_VALIDATE_URL)) {
        fwrite(STDERR, "Invalid or empty <loc> in sitemap index.\n");
        exit(1);
    }
    $locations[] = $loc;
}
if ($locations !== $expected || count($locations) !== count(array_unique($locations))) {
    fwrite(STDERR, "Sitemap index children are missing, duplicated, or out of order.\n");
    exit(1);
}
$rawBlocks = preg_match_all('/<sitemap>\s*<loc>.*?<\/sitemap>/s', $xml, $matches);
if ($rawBlocks !== count($expected)) {
    fwrite(STDERR, "Sitemap index block count mismatch.\n");
    exit(1);
}
$generatorFiles = array_map(static fn(string $p): string => dirname(__DIR__) . '/' . basename($p, '.xml') . '.php', $expectedPaths);
foreach ($generatorFiles as $generator) {
    if (!is_file($generator)) {
        fwrite(STDERR, "Missing child sitemap generator: {$generator}\n");
        exit(1);
    }
}
$robotsPath = dirname(__DIR__) . '/robots.txt';
$robots = file_get_contents($robotsPath);
if ($robots === false) {
    fwrite(STDERR, "Unable to read robots.txt\n");
    exit(1);
}
$requiredRobots = array_merge([$site . '/sitemap.xml'], $expected);
foreach ($requiredRobots as $url) {
    $declaration = 'Sitemap: ' . $url;
    if (substr_count($robots, $declaration) !== 1) {
        fwrite(STDERR, "robots.txt must declare exactly once: {$url}\n");
        exit(1);
    }
}
$declarationCount = preg_match_all('/^Sitemap:\s*\S+/mi', $robots, $robotsMatches);
if ($declarationCount !== count($requiredRobots)) {
    fwrite(STDERR, "robots.txt contains an unexpected or duplicate sitemap declaration.\n");
    exit(1);
}
echo "Sitemap index valid: " . count($expected) . " child maps; robots declarations complete.\n";
