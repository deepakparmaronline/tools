<?php
if (!isset($alternative)) die('Alternative article data missing');
$pageTitle = page_title($alternative['seo_title'] ?? $alternative['title']);
$pageDescription = $alternative['description'];
$canonical = alternative_url($alternative);
$ogType = 'article';
$socialImage = alternative_image_url($alternative);
$socialImageAlt = $alternative['image_alt'] ?? $alternative['title'];
$schema = ['@type'=>'Article','headline'=>$alternative['title'],'description'=>$pageDescription,'datePublished'=>$alternative['date'],'dateModified'=>$alternative['updated'],'author'=>['@type'=>'Person','name'=>$alternative['author']],'publisher'=>['@type'=>'Organization','name'=>SITE_NAME,'url'=>SITE_URL],'mainEntityOfPage'=>$canonical,'url'=>$canonical];
if ($socialImage) $schema['image'] = ['@type'=>'ImageObject','url'=>$socialImage,'caption'=>$socialImageAlt];
$extraHead = '<meta property="article:published_time" content="'.e($alternative['date']).'"><meta property="article:modified_time" content="'.e($alternative['updated']).'">'.jsonld(['@context'=>'https://schema.org','@graph'=>[$schema,breadcrumbs([['name'=>'Home','url'=>SITE_URL],['name'=>'Alternatives','url'=>url('alternatives/')],['name'=>$alternative['title'],'url'=>$canonical]])]]);
require __DIR__.'/header.php';
?>
<header class="article-head"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><a href="/alternatives/">Alternatives</a><span aria-hidden="true">›</span><span><?=e($alternative['title'])?></span></nav><span class="eyebrow"><?=e($alternative['tag'])?></span><h1><?=e($alternative['title'])?></h1><p><?=e($pageDescription)?></p><div class="article-meta"><span>By <strong><?=e($alternative['author'])?></strong></span><span>Published <time datetime="<?=e($alternative['date'])?>"><?=e(fmt_date($alternative['date']))?></time></span><?php if ($alternative['updated'] !== $alternative['date']): ?><span>Updated <time datetime="<?=e($alternative['updated'])?>"><?=e(fmt_date($alternative['updated']))?></time></span><?php endif; ?></div></div></header>
<div class="container article-layout alternative-layout"><article class="article-body">
<?php if ($socialImage): ?><img class="alternative-featured-image" src="<?=e($socialImage)?>" alt="<?=e($socialImageAlt)?>" width="<?=e((string)($alternative['image_width'] ?? 1200))?>" height="<?=e((string)($alternative['image_height'] ?? 675))?>" fetchpriority="high" decoding="async"><?php endif; ?>
<?=$alternative['content']?>
<div class="author-box"><strong>About <?=e($alternative['author'])?></strong><p><?=e($alternative['author_bio'] ?? ($alternative['author'] === SITE_AUTHOR ? 'Deepak Parmar writes about SEO, AI, automation, and practical digital workflows at ToolboxKart.' : 'Contributor at ToolboxKart.'))?></p></div>
<p><a href="/alternatives/">Browse all alternative articles →</a></p>
</article><aside class="sidebar"><nav class="toc" aria-label="Table of contents"><h2>On this page</h2><div id="tocLinks"></div></nav></aside></div>
<?php
$related = array_values(array_filter(alternative_articles(), fn($item)=>$item['slug'] !== $alternative['slug']));
usort($related, fn($a,$b)=>(($b['tag'] === $alternative['tag']) <=> ($a['tag'] === $alternative['tag'])) ?: strcmp($b['date'],$a['date']));
if ($related): ?>
<section class="section alt"><div class="container"><div class="section-head"><h2>Related alternative articles</h2></div><div class="blog-grid"><?php render_alternative_cards(array_slice($related,0,3)); ?></div></div></section>
<?php endif; unset($post); require __DIR__.'/footer.php'; ?>
