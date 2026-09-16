<?php
require __DIR__.'/../includes/bootstrap.php';

// The blog index is database-free and reads the current post registry from /data/posts.php.
// Explicitly bypass PHP opcode staleness and intermediary page caching so a newly published
// 8 PM article appears on /blog/ without waiting for a cache timeout or PHP restart.
if (function_exists('opcache_invalidate')) {
    @opcache_invalidate(__DIR__.'/../data/posts.php', true);
}
$blogPosts = require __DIR__.'/../data/posts.php';
$blogPosts = is_array($blogPosts) ? $blogPosts : [];

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
if (function_exists('header_remove')) {
    @header_remove('ETag');
}
if (!headers_sent()) {
    header('X-LiteSpeed-Cache-Control: no-cache');
}

$pageTitle=page_title('Blog');
$pageDescription='Practical guides for SEO, marketing, finance, healthcare RCM and digital workflows from ToolboxKart.';
$canonical=url('blog/');
$extraHead=jsonld(['@context'=>'https://schema.org','@type'=>'Blog','name'=>'ToolboxKart Blog','url'=>$canonical]);
usort($blogPosts,fn($a,$b)=>strcmp($b['date'],$a['date']));
require __DIR__.'/../includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="crumbs"><a href="/">Home</a><span>›</span><span>Blog</span></div><span class="eyebrow">Guides by <?=SITE_AUTHOR?></span><h1>Useful explanations for better decisions</h1><p>Practical articles that explain formulas, workflows and implementation choices behind the tools.</p></div></section><section class="section"><div class="container"><div class="blog-grid"><?php foreach($blogPosts as $p):?><article class="post-card"><span class="tag"><?=e($p['category'])?></span><h2><a href="/blog/<?=e($p['slug'])?>"><?=e($p['title'])?></a></h2><p><?=e($p['description'])?></p><div class="post-meta">By <?=SITE_AUTHOR?> · <?=e(fmt_date($p['date']))?> · <?=e($p['read_time'])?></div></article><?php endforeach?></div></div></section><?php require __DIR__.'/../includes/footer.php';?>
