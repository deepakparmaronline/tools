<?php
require __DIR__.'/includes/bootstrap.php';
header('Content-Type: application/xml; charset=UTF-8');
$esc=fn($v)=>htmlspecialchars((string)$v,ENT_XML1|ENT_QUOTES,'UTF-8');
$latestPostDate='';
foreach($posts as $p){if(($p['date']??'')>$latestPostDate)$latestPostDate=$p['date'];}
$urls=[];
$urls[]=['url'=>SITE_URL.'/alternatives/','lastmod'=>array_reduce(alternative_articles(),fn($latest,$article)=>max($latest,$article['updated']),''),'changefreq'=>'weekly','priority'=>'0.9'];
foreach(alternative_articles() as $article){$urls[]=['url'=>alternative_url($article),'lastmod'=>$article['updated'],'priority'=>'0.7'];}
$urls[]=['url'=>SITE_URL.'/','lastmod'=>$latestPostDate,'changefreq'=>'daily','priority'=>'1.0'];
$urls[]=['url'=>SITE_URL.'/all-tools','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.9'];
$urls[]=['url'=>SITE_URL.'/browse-tools-by-niche','lastmod'=>'2026-09-17','changefreq'=>'weekly','priority'=>'0.9'];
foreach(['chatgpt','claude','ai-news','tools-guide'] as $key){$urls[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.9'];}
$urls[]=['url'=>SITE_URL.'/versus/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'];
$urls[]=['url'=>SITE_URL.'/reviews/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'];
$softwareIndexes=['tools'=>'tool_hubs','pricing'=>'pricing','how-to-use'=>'how_to_use','compare'=>'comparisons','best'=>'categories'];
foreach($softwareIndexes as $slug=>$collection){
    $items=software_pages($collection);
    $lastmod=array_reduce($items,fn($latest,$item)=>max($latest,$item['date']), '2026-10-25');
    $urls[]=['url'=>SITE_URL.'/'.$slug.'/','lastmod'=>$lastmod,'changefreq'=>'weekly','priority'=>'0.8'];
    foreach($items as $item)$urls[]=['url'=>url($item['url']),'lastmod'=>$item['date'],'priority'=>'0.7'];
}
$urls[]=['url'=>SITE_URL.'/tech/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.9'];
$urls[]=['url'=>SITE_URL.'/content/','lastmod'=>$latestPostDate,'changefreq'=>'weekly','priority'=>'0.8'];
$urls[]=['url'=>SITE_URL.'/about-deepak-parmar/','lastmod'=>'2026-10-20','priority'=>'0.6'];
$urls[]=['url'=>SITE_URL.'/editorial-policy','lastmod'=>'2026-10-20','priority'=>'0.4'];
$urls[]=['url'=>SITE_URL.'/review-methodology','lastmod'=>'2026-10-20','priority'=>'0.5'];
$urls[]=['url'=>SITE_URL.'/advertising-disclosure','lastmod'=>'2026-10-20','priority'=>'0.4'];
$urls[]=['url'=>SITE_URL.'/corrections-policy','lastmod'=>'2026-10-20','priority'=>'0.4'];
foreach(array_keys(tool_categories()) as $key){$urls[]=['url'=>SITE_URL.'/'.$key.'/','lastmod'=>'2026-09-09','changefreq'=>'weekly','priority'=>'0.9'];}
foreach($catalog['tools'] as $tool){$urls[]=['url'=>SITE_URL.'/'.$tool['category'].'/'.$tool['slug'],'lastmod'=>'2026-09-09','priority'=>'0.8'];}
foreach($posts as $p){$urls[]=['url'=>post_url($p),'lastmod'=>$p['date'],'priority'=>'0.7'];}
foreach(['about','contact','privacy','terms','disclaimer'] as $page){$urls[]=['url'=>SITE_URL.'/'.$page,'lastmod'=>'2026-09-09','priority'=>'0.4'];}
$seen=[];echo '<?xml version="1.0" encoding="UTF-8"?>';echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($urls as $u){if(isset($seen[$u['url']]))continue;$seen[$u['url']]=true;echo '<url><loc>'.$esc($u['url']).'</loc>';if(!empty($u['lastmod']))echo '<lastmod>'.$esc($u['lastmod']).'</lastmod>';if(isset($u['changefreq']))echo '<changefreq>'.$esc($u['changefreq']).'</changefreq>';if(isset($u['priority']))echo '<priority>'.$esc($u['priority']).'</priority>';echo '</url>';}
echo '</urlset>';
