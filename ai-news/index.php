<?php
require __DIR__.'/../includes/bootstrap.php';
$category = 'ai-news';
$posts = posts_for_category($category);
$pageTitle = page_title('AI News');
$pageDescription = 'AI industry news, launches and broader ecosystem updates from across the AI landscape.';
$canonical = url('ai-news/');
$extraHead = jsonld(['@context'=>'https://schema.org','@type'=>'CollectionPage','name'=>'AI News','url'=>$canonical,'description'=>$pageDescription]);
require __DIR__.'/../includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="crumbs"><a href="/">Home</a><span>›</span><span>AI News</span></div><span class="eyebrow"><?=count($posts)?> news updates</span><h1>AI News and broader ecosystem coverage</h1><p>Coverage of launches, product changes, infrastructure updates, and AI industry developments beyond ChatGPT and Claude.</p></div></section>
<section class="section"><div class="container"><div class="blog-grid"><?php foreach($posts as $p):?><article class="post-card"><span class="tag"><?=e(post_category_label($p))?></span><h2><a href="<?=e(post_url($p))?>"><?=e($p['title'])?></a></h2><p><?=e($p['description'])?></p><div class="post-meta">By <?=SITE_AUTHOR?> · <?=e(fmt_date($p['date']))?> · <?=e($p['read_time'])?></div></article><?php endforeach?></div></div></section>
<?php require __DIR__.'/../includes/footer.php';
