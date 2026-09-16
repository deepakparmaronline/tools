<?php
require __DIR__.'/../includes/bootstrap.php';
$category = 'chatgpt';
$posts = posts_for_category($category);
$pageTitle = page_title('ChatGPT');
$pageDescription = 'Practical ChatGPT tutorials, workflows, product updates and real-world use cases from ToolBoxKart.';
$canonical = url('chatgpt/');
$extraHead = jsonld(['@context'=>'https://schema.org','@type'=>'CollectionPage','name'=>'ChatGPT','url'=>$canonical,'description'=>$pageDescription]);
require __DIR__.'/../includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="crumbs"><a href="/">Home</a><span>›</span><span>ChatGPT</span></div><span class="eyebrow"><?=count($posts)?> practical guides</span><h1>ChatGPT guides, updates and workflows</h1><p>Useful ChatGPT tutorials, product updates and real-world workflows for research, content, automation and daily work.</p></div></section>
<section class="section"><div class="container"><div class="blog-grid"><?php foreach($posts as $p):?><article class="post-card"><span class="tag"><?=e(post_category_label($p))?></span><h2><a href="<?=e(post_url($p))?>"><?=e($p['title'])?></a></h2><p><?=e($p['description'])?></p><div class="post-meta">By <?=SITE_AUTHOR?> · <?=e(fmt_date($p['date']))?> · <?=e($p['read_time'])?></div></article><?php endforeach?></div></div></section>
<?php require __DIR__.'/../includes/footer.php';
