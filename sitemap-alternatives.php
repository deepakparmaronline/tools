<?php
require __DIR__.'/includes/bootstrap.php';
header('Content-Type: application/xml; charset=UTF-8');
$esc=fn($value)=>htmlspecialchars((string)$value,ENT_XML1|ENT_QUOTES,'UTF-8');
$articles=alternative_articles();
$latest=array_reduce($articles,fn($date,$article)=>max($date,$article['updated'] ?? $article['date']), '');
$urls=[['url'=>SITE_URL.'/alternatives/','lastmod'=>$latest,'changefreq'=>'weekly','priority'=>'1.0']];
foreach($articles as $article)$urls[]=['url'=>alternative_url($article),'lastmod'=>$article['updated'],'changefreq'=>'monthly','priority'=>'0.8'];
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($urls as $item){echo '<url><loc>'.$esc($item['url']).'</loc><lastmod>'.$esc($item['lastmod']).'</lastmod><changefreq>'.$esc($item['changefreq']).'</changefreq><priority>'.$esc($item['priority']).'</priority></url>';}
echo '</urlset>';
