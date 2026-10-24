<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
header('Content-Type: application/xml; charset=UTF-8');

$maps = [
    'sitemap-tools.xml' => sitemap_latest(sitemap_software_entries('tools', 'tool_hubs')),
    'sitemap-alternatives.xml' => sitemap_latest(array_map(fn($article)=>['lastmod'=>$article['updated']], alternative_articles())),
    'sitemap-reviews.xml' => sitemap_latest(array_map(fn($post)=>['lastmod'=>$post['date']], posts_for_category('reviews'))),
    'sitemap-pricing.xml' => sitemap_latest(sitemap_software_entries('pricing', 'pricing')),
    'sitemap-how-to-use.xml' => sitemap_latest(sitemap_software_entries('how-to-use', 'how_to_use')),
    'sitemap-compare.xml' => sitemap_latest(sitemap_software_entries('compare', 'comparisons')),
    'sitemap-categories.xml' => sitemap_latest(sitemap_software_entries('best', 'categories')),
    'sitemap-pages.xml' => max(array_column($posts, 'date')),
];

$escape = fn($value) => htmlspecialchars((string)$value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($maps as $file=>$lastmod) {
    echo '<sitemap><loc>'.$escape(SITE_URL.'/'.$file).'</loc><lastmod>'.$escape($lastmod).'</lastmod></sitemap>';
}
echo '</sitemapindex>';
