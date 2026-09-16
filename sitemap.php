<?php
require __DIR__.'/includes/bootstrap.php';
header('Content-Type: application/xml; charset=UTF-8');
$esc=fn($v)=>htmlspecialchars((string)$v,ENT_XML1|ENT_QUOTES,'UTF-8');
$latestPostDate='';
foreach($posts as $p){if(($p['date']??'')>$latestPostDate)$latestPostDate=$p['date'];}
$urls=[];
$urls[]=['url'=>SITE_URL.'/','lastmod'=>$latestPostDate,'changefreq'=>'daily','priority'=>'1.0'];
$urls[]=['url'=>SITE_URL.'/all-tools','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.9'];
foreach(['chatgpt','claude','ai-news','tools-guide'] as $key){$urls[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.9'];}
foreach(['seo','marketing','finance','healthcare','developer','productivity'] as $key){$urls[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.9'];}
foreach($catalog['tools'] as $tool){$urls[]=['url'=>SITE_URL.'/'.$tool['category'].'/'.$tool['slug'],'lastmod'=>'2026-09-09','priority'=>'0.8'];}
foreach($posts as $p){$key=post_category_key($p['category']);$urls[]=['url'=>SITE_URL.'/'.$key.'/'.$p['slug'],'lastmod'=>$p['date'],'priority'=>'0.7'];}
foreach(['about','contact','privacy','terms','disclaimer'] as $page){$urls[]=['url'=>SITE_URL.'/'.$page,'lastmod'=>'2026-09-09','priority'=>'0.4'];}
$seen=[];echo '<?xml version="1.0" encoding="UTF-8"?>';echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($urls as $u){if(isset($seen[$u['url']]))continue;$seen[$u['url']]=true;echo '<url><loc>'.$esc($u['url']).'</loc>';if(!empty($u['lastmod']))echo '<lastmod>'.$esc($u['lastmod']).'</lastmod>';if(isset($u['changefreq']))echo '<changefreq>'.$esc($u['changefreq']).'</changefreq>';if(isset($u['priority']))echo '<priority>'.$esc($u['priority']).'</priority>';echo '</url>';}
echo '</urlset>';
