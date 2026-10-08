<?php
require_once __DIR__.'/../includes/bootstrap.php';
$articles = alternative_articles();
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
<section class="page-hero"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><span>Alternatives</span></nav><span class="eyebrow">Software comparisons</span><h1>Find alternatives that fit your work</h1><p>Explore practical comparisons of software and tools, with clear explanations of where each option fits.</p></div></section>
<section class="section"><div class="container">
<?php if ($articles): ?><div class="blog-grid"><?php render_alternative_cards($articles); ?></div>
<?php else: ?><div class="notice">Alternative articles will appear here as they are published. In the meantime, <a class="text-link" href="/browse-tools-by-niche">explore our tools by category</a>.</div><?php endif; ?>
</div></section>
<?php unset($post); require __DIR__.'/../includes/footer.php'; ?>
