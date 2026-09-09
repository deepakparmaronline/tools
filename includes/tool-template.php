<?php
if(!isset($tool,$toolBody,$toolContent,$faqs)) die('Tool template data missing');
$cat=category_data($tool['category']);
$pageTitle=page_title($tool['name']);$pageDescription=$tool['description'];$canonical=url($tool['category'].'/'.$tool['slug']);
$faqSchema=['@type'=>'FAQPage','mainEntity'=>array_map(fn($f)=>['@type'=>'Question','name'=>$f[0],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f[1]]],$faqs)];
$appSchema=['@type'=>'WebApplication','name'=>$tool['name'],'url'=>$canonical,'applicationCategory'=>'UtilitiesApplication','operatingSystem'=>'Any','offers'=>['@type'=>'Offer','price'=>'0','priceCurrency'=>'USD'],'description'=>$tool['description']];
$crumb=breadcrumbs([['name'=>'Home','url'=>SITE_URL],['name'=>$cat['name'],'url'=>url($tool['category'].'/')],['name'=>$tool['name'],'url'=>$canonical]]);
$extraHead=jsonld(['@context'=>'https://schema.org','@graph'=>[$appSchema,$faqSchema,$crumb]]);
require __DIR__.'/header.php';
?>
<div class="container tool-layout"><article class="tool-main"><div class="crumbs"><a href="/">Home</a><span>›</span><a href="/<?=e($tool['category'])?>/"> <?=e($cat['name'])?></a><span>›</span><span><?=e($tool['name'])?></span></div><header class="tool-title"><span class="eyebrow"><?=e($cat['name'])?> tool</span><h1><?=e($tool['name'])?></h1><p><?=e($tool['description'])?></p></header>
<section class="tool-panel" aria-label="<?=e($tool['name'])?> interface"><?=$toolBody?></section>
<div class="tool-content"><?=$toolContent?><h2 id="faqs">Frequently asked questions</h2><div class="faq-list"><?php foreach($faqs as $f):?><details class="faq"><summary><?=e($f[0])?></summary><div><?=e($f[1])?></div></details><?php endforeach?></div></div></article>
<aside class="sidebar"><div class="side-card"><h2>Related <?=e($cat['name'])?> tools</h2><?php foreach(get_related_tools($tool['category'],$tool['slug']) as $r):?><a class="side-link" href="/<?=e($r['category'])?>/<?=e($r['slug'])?>"><?=e($r['name'])?><small>Open tool →</small></a><?php endforeach?></div><div class="side-card"><h2>Privacy by default</h2><p class="helper">Tools in this release calculate in your browser unless a page clearly states otherwise.</p></div></aside></div>
<?php require __DIR__.'/footer.php'; ?>
