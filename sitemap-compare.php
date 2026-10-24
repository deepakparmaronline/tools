<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
$entries = sitemap_software_entries('compare', 'comparisons');
$entries[] = ['url'=>SITE_URL.'/versus/','lastmod'=>sitemap_latest(array_map(fn($post)=>['lastmod'=>$post['date']],posts_for_category('versus'))),'changefreq'=>'weekly','priority'=>'0.6'];
sitemap_emit_urlset($entries);
