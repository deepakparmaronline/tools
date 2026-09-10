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

if ($doc === false || !isset($doc->url)) {
    fwrite(STDERR, "Invalid sitemap.xml: XML parsing failed or no <url> entries were found.\n");
    foreach ($errors as $error) {
        fwrite(STDERR, trim($error->message) . "\n");
    }
    exit(1);
}

$count = 0;
foreach ($doc->url as $url) {
    $loc = trim((string) $url->loc);
    if ($loc === '' || !filter_var($loc, FILTER_VALIDATE_URL)) {
        fwrite(STDERR, "Invalid or empty <loc> found in sitemap.xml\n");
        exit(1);
    }
    $count++;
}

$rawUrlBlocks = preg_match_all('/<url>\s*<loc>.*?<\/url>/s', $xml, $matches);
if ($rawUrlBlocks !== $count) {
    fwrite(STDERR, "Sitemap URL block count mismatch. Parsed: {$count}; raw blocks: {$rawUrlBlocks}.\n");
    exit(1);
}

echo "Sitemap valid: {$count} URLs\n";
