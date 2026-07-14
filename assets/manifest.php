<?php
header('Content-Type: application/json');
$root = $_SERVER['DOCUMENT_ROOT'];
$exclude = ['blog', 'images', 'assets', 'about-deepak-parmar', 'cgi-bin', 'wp-content'];
$acronyms = ['seo' => 'SEO', 'ai' => 'AI', 'ux' => 'UX', 'ui' => 'UI', 'api' => 'API', 'faq' => 'FAQ'];

function nicenamize($slug, $acronyms) {
    $words = preg_split('/[-_]+/', $slug);
    $out = [];
    foreach ($words as $w) {
        $lw = strtolower($w);
        $out[] = $acronyms[$lw] ?? ucfirst($lw);
    }
    return implode(' ', $out);
}

$niches = [];

foreach (scandir($root) as $item) {
    if ($item === '.' || $item === '..' || $item[0] === '.') continue;
    $nichePath = $root . '/' . $item;
    
    if (!is_dir($nichePath)) continue;
    if (in_array($item, $exclude)) continue;

    $tools = [];
    foreach (scandir($nichePath) as $sub) {
        if ($sub === '.' || $sub === '..' || $sub[0] === '.') continue;
        
        $toolPath = $nichePath . '/' . $sub;
        if (!is_dir($toolPath)) continue;
        
        $indexFile = $toolPath . '/index.html';
        if (!file_exists($indexFile)) continue;

        $name = nicenamize($sub, $acronyms);
        
        $html = @file_get_contents($indexFile);
        if ($html && preg_match('/<title>(.*?)<\/title>/is', $html, $m)) {
            $titleParts = explode('|', trim($m[1]));
            if (trim($titleParts[0]) !== '') {
                $name = trim($titleParts[0]);
            }
        }

        $tools[] = [
            'name' => $name,
            'slug' => $sub,
            'path' => '/' . $item . '/' . $sub . '/',
        ];
    }

    if (count($tools) === 0) continue;
    usort($tools, fn($a, $b) => strcmp($a['name'], $b['name']));

    $niches[] = [
        'key' => $item,
        'label' => nicenamize($item, $acronyms),
        'path' => '/' . $item . '/',
        'tools' => $tools,
    ];
}

usort($niches, fn($a, $b) => strcmp($a['label'], $b['label']));
echo json_encode(['niches' => $niches], JSON_PRETTY_PRINT);
?>