<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
$articles=alternative_articles();
$latest=array_reduce($articles,fn($date,$article)=>max($date,$article['updated'] ?? $article['date']), '2026-10-25');
$urls=[['url'=>SITE_URL.'/alternatives/','lastmod'=>$latest,'changefreq'=>'weekly','priority'=>'1.0']];
foreach($articles as $article)$urls[]=['url'=>alternative_url($article),'lastmod'=>$article['updated'],'changefreq'=>'monthly','priority'=>'0.8'];
sitemap_emit_urlset($urls);
