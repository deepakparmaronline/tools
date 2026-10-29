<?php
if (!isset($alternative)) die('Alternative article data missing');
$pageTitle = page_title($alternative['seo_title'] ?? $alternative['title']);
$pageDescription = $alternative['description'];
$canonical = alternative_url($alternative);
$ogType = 'article';
$socialImage = alternative_image_url($alternative);
$socialImageAlt = $alternative['image_alt'] ?? $alternative['title'];
$schema = ['@type'=>'Article','headline'=>$alternative['title'],'description'=>$pageDescription,'datePublished'=>$alternative['date'],'dateModified'=>$alternative['updated'],'author'=>['@type'=>'Person','name'=>$alternative['author'],'url'=>url('about-deepak-parmar/'),'image'=>url('images/deepak-parmar.jpeg'),'sameAs'=>['https://www.linkedin.com/in/deepakparmaronline/','https://www.youtube.com/@deepakparmaronline'],'jobTitle'=>'SEO specialist and technology writer'],'publisher'=>['@type'=>'Organization','name'=>SITE_NAME,'url'=>SITE_URL],'mainEntityOfPage'=>$canonical,'url'=>$canonical];
if ($socialImage) $schema['image'] = ['@type'=>'ImageObject','url'=>$socialImage,'caption'=>$socialImageAlt];
$breadcrumbParentName = trim(is_string($alternative['breadcrumb_parent_name'] ?? null) ? $alternative['breadcrumb_parent_name'] : 'Alternatives');
$breadcrumbParentUrl = trim(is_string($alternative['breadcrumb_parent_url'] ?? null) ? $alternative['breadcrumb_parent_url'] : '/alternatives/');
if ($breadcrumbParentName === '' || (!preg_match('#^/[a-z0-9-]+/$#D', $breadcrumbParentUrl) && $breadcrumbParentUrl !== '/alternatives/')) {
    $breadcrumbParentName = 'Alternatives';
    $breadcrumbParentUrl = '/alternatives/';
}
$breadcrumbItems = [['name'=>'Home','url'=>SITE_URL],['name'=>$breadcrumbParentName,'url'=>url($breadcrumbParentUrl)],['name'=>$alternative['title'],'url'=>$canonical]];
$schemaGraph = [$schema, breadcrumbs($breadcrumbItems)];
$itemList = [];
foreach (is_array($alternative['item_list'] ?? null) ? $alternative['item_list'] : [] as $item) {
    if (!is_array($item) || !is_string($item['name'] ?? null) || !is_string($item['url'] ?? null)) continue;
    $name = trim($item['name']); $itemUrl = trim($item['url']);
    if ($name === '' || !filter_var($itemUrl, FILTER_VALIDATE_URL) || !str_starts_with($itemUrl, 'https://')) continue;
    $itemList[] = ['@type'=>'ListItem','position'=>count($itemList)+1,'name'=>$name,'item'=>$itemUrl];
}
if ($itemList) $schemaGraph[] = ['@type'=>'ItemList','name'=>$alternative['title'],'itemListElement'=>$itemList];
$faqs = [];
foreach (is_array($alternative['faqs'] ?? null) ? $alternative['faqs'] : [] as $faq) {
    if (!is_array($faq) || !is_string($faq['question'] ?? null) || !is_string($faq['answer'] ?? null)) continue;
    $question = trim($faq['question']); $answer = trim($faq['answer']);
    if ($question !== '' && $answer !== '') $faqs[] = ['@type'=>'Question','name'=>$question,'acceptedAnswer'=>['@type'=>'Answer','text'=>$answer]];
}
if ($faqs) $schemaGraph[] = ['@type'=>'FAQPage','mainEntity'=>$faqs];
$extraHead = '<meta property="article:published_time" content="'.e($alternative['date']).'"><meta property="article:modified_time" content="'.e($alternative['updated']).'">'.jsonld(['@context'=>'https://schema.org','@graph'=>$schemaGraph]);
require __DIR__.'/header.php';
?>
<header class="article-head"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><a href="<?=e($breadcrumbParentUrl)?>"><?=e($breadcrumbParentName)?></a><span aria-hidden="true">›</span><span><?=e($alternative['title'])?></span></nav><span class="eyebrow"><?=e($alternative['tag'])?></span><h1><?=e($alternative['title'])?></h1><p><?=e($pageDescription)?></p><div class="article-meta"><span>By <strong><a href="/about-deepak-parmar/"><?=e($alternative['author'])?></a></strong></span><span>Published <time datetime="<?=e($alternative['date'])?>"><?=e(fmt_date($alternative['date']))?></time></span><?php if ($alternative['updated'] !== $alternative['date']): ?><span>Updated <time datetime="<?=e($alternative['updated'])?>"><?=e(fmt_date($alternative['updated']))?></time></span><?php endif; ?></div></div></header>
<div class="container article-layout alternative-layout"><article class="article-body">
<?php if ($socialImage): ?><img class="alternative-featured-image" src="<?=e($socialImage)?>" alt="<?=e($socialImageAlt)?>" width="<?=e((string)($alternative['image_width'] ?? 1200))?>" height="<?=e((string)($alternative['image_height'] ?? 675))?>" fetchpriority="high" decoding="async"><?php endif; ?>
<?=$alternative['content']?>
<div class="author-box"><strong>About <a href="/about-deepak-parmar/"><?=e($alternative['author'])?></a></strong><p><?=e($alternative['author_bio'] ?? ($alternative['author'] === SITE_AUTHOR ? 'Deepak Parmar is an SEO specialist and web developer with seven years of experience. He researches software, technical SEO, AI search and practical digital workflows for ToolboxKart.' : 'Contributor at ToolboxKart.'))?></p><p><a href="/review-methodology">How we research comparisons</a> · <a href="/advertising-disclosure">Advertising disclosure</a> · <a href="/corrections-policy">Corrections</a></p></div>
<p><a href="/alternatives/">Browse all alternative articles →</a></p>
</article><aside class="sidebar"><nav class="toc" aria-label="Table of contents"><h2>On this page</h2><div id="tocLinks"></div></nav></aside></div>
<?php
$related = related_alternative_articles($alternative);
if ($related): ?>
<section class="section alt"><div class="container"><div class="section-head"><h2>Related alternative articles</h2></div><div class="blog-grid"><?php render_alternative_cards($related); ?></div></div></section>
<?php endif; unset($post); require __DIR__.'/footer.php'; ?>
