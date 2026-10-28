<?php
if (!isset($alternative)) die('Alternative article data missing');
$pageTitle = page_title($alternative['seo_title'] ?? $alternative['title']);
$pageDescription = $alternative['description'];
$canonicalPath = alternative_path($alternative);
$canonical = alternative_url($alternative);
$ogType = 'article';
$socialImage = alternative_image_url($alternative);
$socialImageAlt = $alternative['image_alt'] ?? $alternative['title'];
$publishedAt = $alternative['date'].'T00:00:00+05:30';
$modifiedAt = $alternative['updated'].'T00:00:00+05:30';
$breadcrumbItems = [['name'=>'Home','url'=>SITE_URL]];
if (preg_match('#^/([a-z0-9-]+)/alternatives/$#D', $canonicalPath, $breadcrumbMatch)) {
    $toolName = trim((string)($alternative['tool_name'] ?? ''));
    if ($toolName === '') $toolName = ucwords(str_replace('-', ' ', $breadcrumbMatch[1]));
    $breadcrumbItems[] = ['name'=>$toolName,'url'=>url($breadcrumbMatch[1].'/')];
    $breadcrumbItems[] = ['name'=>'Alternatives','url'=>$canonical];
} else {
    $breadcrumbItems[] = ['name'=>'Alternatives','url'=>url('alternatives/')];
    $breadcrumbItems[] = ['name'=>$alternative['title'],'url'=>$canonical];
}
$schema = ['@type'=>'Article','@id'=>$canonical.'#article','headline'=>$alternative['title'],'description'=>$pageDescription,'datePublished'=>$publishedAt,'dateModified'=>$modifiedAt,'author'=>['@type'=>'Person','name'=>$alternative['author'],'url'=>url('about-deepak-parmar/'),'image'=>url('images/deepak-parmar.jpeg'),'sameAs'=>['https://www.linkedin.com/in/deepakparmaronline/','https://www.youtube.com/@deepakparmaronline'],'jobTitle'=>'SEO specialist and technology writer'],'publisher'=>['@type'=>'Organization','name'=>SITE_NAME,'url'=>SITE_URL],'mainEntityOfPage'=>$canonical,'url'=>$canonical];
if ($socialImage) $schema['image'] = ['@type'=>'ImageObject','url'=>$socialImage,'caption'=>$socialImageAlt];
$extraHead = '<meta property="article:published_time" content="'.e($publishedAt).'"><meta property="article:modified_time" content="'.e($modifiedAt).'">'.jsonld(['@context'=>'https://schema.org','@graph'=>[$schema,breadcrumbs($breadcrumbItems)]]);
require __DIR__.'/header.php';
?>
<header class="article-head"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><?php foreach ($breadcrumbItems as $index=>$crumb): ?><?php if ($index > 0): ?><span aria-hidden="true">›</span><?php endif; ?><?php if ($index === count($breadcrumbItems)-1): ?><span aria-current="page"><?=e($crumb['name'])?></span><?php else: ?><a href="<?=e(parse_url($crumb['url'], PHP_URL_PATH) ?: '/')?>"><?=e($crumb['name'])?></a><?php endif; ?><?php endforeach; ?></nav><span class="eyebrow"><?=e($alternative['tag'])?></span><h1><?=e($alternative['title'])?></h1><p><?=e($pageDescription)?></p><div class="article-meta"><span>By <strong><a href="/about-deepak-parmar/"><?=e($alternative['author'])?></a></strong></span><span>Published <time datetime="<?=e($alternative['date'])?>"><?=e(fmt_date($alternative['date']))?></time></span><?php if ($alternative['updated'] !== $alternative['date']): ?><span>Updated <time datetime="<?=e($alternative['updated'])?>"><?=e(fmt_date($alternative['updated']))?></time></span><?php endif; ?></div></div></header>
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
