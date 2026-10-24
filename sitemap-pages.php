<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
$latestPostDate = max(array_column($posts, 'date'));
$entries = [
    ['url'=>SITE_URL.'/','lastmod'=>$latestPostDate,'changefreq'=>'daily','priority'=>'1.0'],
    ['url'=>SITE_URL.'/all-tools','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.9'],
    ['url'=>SITE_URL.'/browse-tools-by-niche','lastmod'=>'2026-09-17','changefreq'=>'weekly','priority'=>'0.9'],
    ['url'=>SITE_URL.'/content/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'],
    ['url'=>SITE_URL.'/tech/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'],
    ['url'=>SITE_URL.'/about-deepak-parmar/','lastmod'=>'2026-10-20','priority'=>'0.6'],
    ['url'=>SITE_URL.'/editorial-policy','lastmod'=>'2026-10-20','priority'=>'0.4'],
    ['url'=>SITE_URL.'/review-methodology','lastmod'=>'2026-10-20','priority'=>'0.5'],
    ['url'=>SITE_URL.'/advertising-disclosure','lastmod'=>'2026-10-20','priority'=>'0.4'],
    ['url'=>SITE_URL.'/corrections-policy','lastmod'=>'2026-10-20','priority'=>'0.4'],
];
foreach (['chatgpt','claude','ai-news','tools-guide'] as $key) $entries[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'];
foreach (array_keys(tool_categories()) as $key) $entries[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.8'];
foreach ($catalog['tools'] as $tool) $entries[]=['url'=>SITE_URL.'/'.$tool['category'].'/'.$tool['slug'],'lastmod'=>'2026-09-09','priority'=>'0.7'];
foreach ($posts as $post) {
    $category = $post['category'] ?? '';
    if (in_array($category, ['reviews','versus'], true)) continue;
    $entries[]=['url'=>post_url($post),'lastmod'=>$post['date'],'priority'=>'0.7'];
}
foreach (['about','contact','privacy','terms','disclaimer'] as $page) $entries[]=['url'=>SITE_URL.'/'.$page,'lastmod'=>'2026-09-09','priority'=>'0.4'];
sitemap_emit_urlset($entries);
