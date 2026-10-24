<?php
require_once __DIR__.'/bootstrap.php';

$collectionConfig = [
    'tool_hubs' => [
        'slug' => 'tools',
        'title' => 'Software Tool Hubs',
        'eyebrow' => 'Tool hubs',
        'heading' => 'Research every part of a software tool',
        'description' => 'Browse software tool hubs that connect independent reviews, verified pricing, setup guides, alternatives and direct comparisons for informed decisions.',
        'empty' => 'Tool hubs will appear here after every required page passes the editorial and source checks.',
    ],
    'pricing' => [
        'slug' => 'pricing',
        'title' => 'Software Pricing Guides',
        'eyebrow' => 'Pricing guides',
        'heading' => 'Compare software plans, limits and extra costs',
        'description' => 'Browse source-backed software pricing guides with plan tables, billing details, important limits, extra costs and dated official links before you buy.',
        'empty' => 'Pricing guides will appear here after their plan details and limits are checked against official sources.',
    ],
    'how_to_use' => [
        'slug' => 'how-to-use',
        'title' => 'How to Use Software',
        'eyebrow' => 'How-to guides',
        'heading' => 'Learn how to set up and use software tools',
        'description' => 'Browse practical software setup guides with documented steps, common tasks, troubleshooting help and links to official instructions for real tasks.',
        'empty' => 'How-to guides will appear here after every instruction is confirmed in the product documentation.',
    ],
    'comparisons' => [
        'slug' => 'compare',
        'title' => 'Software Comparisons',
        'eyebrow' => 'Comparisons',
        'heading' => 'Compare software tools for a specific decision',
        'description' => 'Browse direct software comparisons covering current pricing, features, integrations, support, limitations and the users each tool fits before choosing.',
        'empty' => 'Software comparisons will appear here after both products and their current terms are fully researched.',
    ],
    'categories' => [
        'slug' => 'best',
        'title' => 'Best Software by Category',
        'eyebrow' => 'Category guides',
        'heading' => 'Find the best software for a specific job',
        'description' => 'Browse category guides that compare published software tools using official sources, clear selection criteria and practical use cases for each job.',
        'empty' => 'A category guide will appear here when at least four complete tool clusters are published in that category.',
    ],
];

$config = $collectionConfig[$collectionKey ?? ''] ?? null;
if (!$config) {
    http_response_code(404);
    require __DIR__.'/../404.php';
    return;
}

$items = software_pages($collectionKey);
$latestUpdate = array_reduce($items, fn($latest, $item) => max($latest, $item['date']), '2026-10-25');
$pageTitle = page_title($config['title']);
$pageDescription = $config['description'];
$canonical = url($config['slug'].'/');
$extraHead = jsonld(['@context'=>'https://schema.org', '@graph'=>[
    ['@type'=>'CollectionPage','name'=>$config['title'],'description'=>$pageDescription,'url'=>$canonical,'dateModified'=>$latestUpdate],
    breadcrumbs([['name'=>'Home','url'=>SITE_URL],['name'=>$config['title'],'url'=>$canonical]]),
    ['@type'=>'ItemList','itemListElement'=>array_map(fn($item,$index)=>['@type'=>'ListItem','position'=>$index+1,'name'=>$item['title'],'url'=>url($item['url'])],$items,array_keys($items))],
]]);
require __DIR__.'/header.php';
?>
<section class="page-hero"><div class="container"><nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><span><?=e($config['title'])?></span></nav><span class="eyebrow"><?=e($config['eyebrow'])?></span><h1><?=e($config['heading'])?></h1><p><?=e($pageDescription)?></p><p class="post-meta">Last updated <time datetime="<?=e($latestUpdate)?>"><?=e(fmt_date($latestUpdate))?></time></p></div></section>
<section class="section"><div class="container">
<?php if ($items): ?><div class="blog-grid">
<?php foreach ($items as $item): ?><article class="post-card"><span class="tag"><?=e($config['eyebrow'])?></span><h2><a href="<?=e($item['url'])?>"><?=e($item['title'])?></a></h2><p><?=e($item['description'])?></p><div class="post-meta"><time datetime="<?=e($item['date'])?>"><?=e(fmt_date($item['date']))?></time></div></article><?php endforeach; ?>
</div><?php else: ?><div class="notice"><strong>Publication queue in progress.</strong> <?=e($config['empty'])?> You can browse the <a class="text-link" href="/alternatives/">published alternatives</a> and <a class="text-link" href="/reviews/">software reviews</a> now.</div><?php endif; ?>
</div></section>
<section class="section alt"><div class="container"><div class="section-head"><div><h2>Browse every software research path</h2><p>Start with the page that matches your question. Each published cluster connects its hub, alternatives, review, pricing, instructions and direct comparison.</p></div></div><div class="category-grid"><article class="category-card"><h3>Tool hubs</h3><p>See the full research cluster for one product.</p><a href="/tools/">Browse tool hubs →</a></article><article class="category-card"><h3>Alternatives</h3><p>Find substitutes for a product or workflow.</p><a href="/alternatives/">Browse alternatives →</a></article><article class="category-card"><h3>Reviews</h3><p>Check fit, limitations and current product facts.</p><a href="/reviews/">Browse reviews →</a></article><article class="category-card"><h3>Pricing</h3><p>Compare plans, usage limits and extra costs.</p><a href="/pricing/">Browse pricing guides →</a></article><article class="category-card"><h3>How to use</h3><p>Follow setup steps confirmed in official documentation.</p><a href="/how-to-use/">Browse how-to guides →</a></article><article class="category-card"><h3>Comparisons</h3><p>Choose between two named software tools.</p><a href="/compare/">Browse comparisons →</a></article><article class="category-card"><h3>Best by category</h3><p>Compare complete tool clusters for one kind of work.</p><a href="/best/">Browse category guides →</a></article><article class="category-card"><h3>Utility tools</h3><p>Use ToolboxKart calculators and browser-based tools.</p><a href="/browse-tools-by-niche">Browse tools by niche →</a></article></div></div></section>
<?php require __DIR__.'/footer.php'; ?>
