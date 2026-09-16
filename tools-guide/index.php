<?php
require __DIR__.'/../includes/bootstrap.php';
$category = 'tools-guide';
$posts = posts_for_category($category);
$pageTitle = page_title('Tools Guide');
$pageDescription = 'Tool tutorials, comparisons and practical workflows for AI and digital productivity tools.';
$canonical = url('tools-guide/');
$extraHead = jsonld(['@context'=>'https://schema.org','@type'=>'CollectionPage','name'=>'Tools Guide','url'=>$canonical,'description'=>$pageDescription]);
require __DIR__.'/../includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="crumbs"><a href="/">Home</a><span>›</span><span>Tools Guide</span></div><span class="eyebrow"><?=count($posts)?> practical guides</span><h1>Tools Guide and workflow tutorials</h1><p>How-to guides, comparisons, and demos covering AI tools, SEO workflows, search tools and digital productivity systems.</p></div></section>
<section class="section"><div class="container"><div class="blog-grid"><?php foreach($posts as $p):?><article class="post-card"><span class="tag"><?=e(post_category_label($p))?></span><h2><a href="<?=e(post_url($p))?>"><?=e($p['title'])?></a></h2><p><?=e($p['description'])?></p><div class="post-meta">By <?=SITE_AUTHOR?> · <?=e(fmt_date($p['date']))?> · <?=e($p['read_time'])?></div></article><?php endforeach?></div></div></section>
<?php require __DIR__.'/../includes/footer.php';
?>
