<?php
require_once __DIR__.'/../includes/bootstrap.php';
$articles = alternative_articles();
$groups = alternative_grouped_articles();
$pageTitle = page_title('Software Alternatives & Comparisons');
$pageDescription = 'Explore practical software alternatives and comparisons to find tools that fit your workflow.';
$canonical = url('alternatives/');
$extraHead = jsonld(['@context'=>'https://schema.org', '@graph'=>[
    ['@type'=>'CollectionPage','name'=>'Software Alternatives & Comparisons','description'=>$pageDescription,'url'=>$canonical],
    breadcrumbs([['name'=>'Home','url'=>SITE_URL],['name'=>'Alternatives','url'=>$canonical]]),
    ['@type'=>'ItemList','itemListElement'=>array_map(fn($article,$i)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$article['title'],'url'=>alternative_url($article)],array_values($articles),array_keys(array_values($articles)))]
]]);
require __DIR__.'/../includes/header.php';
?>
<section class="page-hero"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><span>Alternatives</span></nav><span class="eyebrow">Software comparisons</span><h1>Software alternatives compared by use case</h1><p>Find researched alternatives for productivity, privacy, customer work, developer tools and specialist software. Each guide explains who should switch, who should stay, current plan limits and what may need rebuilding.</p><div class="hero-actions"><a class="btn btn-primary" href="#alternative-topics">Browse by topic</a><a class="btn btn-secondary" href="/review-methodology">Read our methodology</a></div></div></section>
<section class="section alt"><div class="container"><div class="section-head"><div><h2>Choose a research path</h2><p>Use alternatives for a shortlist, reviews for a deeper look at one product, and versus pages for a focused two-tool decision.</p></div></div><div class="category-grid"><article class="category-card"><h3>Alternative shortlists</h3><p>Compare several credible substitutes for a specific product and workflow.</p><a href="#alternative-topics">Browse alternatives →</a></article><article class="category-card"><h3>Two-tool comparisons</h3><p>Compare pricing, platforms and tradeoffs between two named products.</p><a href="/versus/">Browse versus guides →</a></article><article class="category-card"><h3>Software reviews</h3><p>Understand a product's fit, limits, export options and current pricing.</p><a href="/reviews/">Browse reviews →</a></article></div></div></section>
<section class="section" id="alternative-topics"><div class="container">
<?php if ($articles): ?><?php foreach($groups as $key=>$group): ?><section class="alternative-topic" id="<?=e($key)?>"><div class="section-head"><div><h2><?=e($group['name'])?></h2><p><?=e($group['description'])?></p></div></div><div class="blog-grid"><?php render_alternative_cards($group['articles']); ?></div></section><?php endforeach; ?>
<?php else: ?><div class="notice">Alternative articles will appear here as they are published. In the meantime, <a class="text-link" href="/browse-tools-by-niche">explore our tools by category</a>.</div><?php endif; ?>
</div></section>
<?php unset($post); require __DIR__.'/../includes/footer.php'; ?>
