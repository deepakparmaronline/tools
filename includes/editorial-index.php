<?php
require_once __DIR__.'/bootstrap.php';
$isAll = ($editorialKey ?? '') === 'content';
$items = $isAll ? $posts : posts_for_category($editorialKey);
usort($items, fn($a,$b)=>strcmp($b['date'],$a['date']) ?: strcmp($a['title'],$b['title']));
$pageTitle = page_title($isAll ? 'All articles' : 'Tech news and practical analysis');
$pageDescription = $isAll ? 'Browse published ToolboxKart articles, software alternatives, technology analysis, and practical guides.' : 'Read sourced technology news and practical analysis of AI models, API changes, product launches, and deployment decisions.';
$canonical = url($isAll ? 'content/' : 'tech/');
require __DIR__.'/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow"><?= $isAll ? 'Published articles' : 'Tech' ?></span><h1><?= $isAll ? 'All ToolboxKart articles' : 'Technology changes and what they mean for your work' ?></h1><p><?=e($pageDescription)?></p></div></section>
<section class="section"><div class="container"><div class="blog-grid">
<?php foreach($items as $item): ?><article class="post-card"><span class="tag"><?=e(post_category_label($item))?></span><h2><a href="<?=e(parse_url(post_url($item), PHP_URL_PATH))?>"><?=e($item['title'])?></a></h2><p><?=e($item['description'])?></p><time datetime="<?=e($item['date'])?>"><?=e(fmt_date($item['date']))?></time></article><?php endforeach; ?>
</div><?php if($isAll): ?><h2>Software alternatives</h2><div class="blog-grid"><?php render_alternative_cards(alternative_articles()); ?></div><?php endif; ?></div></section>
<?php unset($post); require __DIR__.'/footer.php'; ?>
