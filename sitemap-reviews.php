<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
$reviews = posts_for_category('reviews');
$entries = [['url'=>SITE_URL.'/reviews/','lastmod'=>sitemap_latest(array_map(fn($post)=>['lastmod'=>$post['date']],$reviews)),'changefreq'=>'weekly','priority'=>'0.8']];
foreach ($reviews as $post) $entries[] = ['url'=>post_url($post),'lastmod'=>$post['date'],'priority'=>'0.7'];
sitemap_emit_urlset($entries);
