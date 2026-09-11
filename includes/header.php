<?php
$pageTitle=$pageTitle??SITE_NAME.' — Free Tools for SEO, Marketing, Finance & More';
$pageDescription=$pageDescription??'Fast, transparent online tools for SEO, marketing, finance, healthcare RCM, developers and productivity.';
$canonical=$canonical??SITE_URL;
$robots=$robots??'index,follow,max-image-preview:large';
$ogType=$ogType??'website';
?><!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($pageTitle)?></title><meta name="description" content="<?=e($pageDescription)?>"><meta name="robots" content="<?=e($robots)?>"><link rel="canonical" href="<?=e($canonical)?>">
<meta property="og:type" content="<?=e($ogType)?>"><meta property="og:site_name" content="<?=SITE_NAME?>"><meta property="og:title" content="<?=e($pageTitle)?>"><meta property="og:description" content="<?=e($pageDescription)?>"><meta property="og:url" content="<?=e($canonical)?>">
<meta name="twitter:card" content="summary"><meta name="twitter:title" content="<?=e($pageTitle)?>"><meta name="twitter:description" content="<?=e($pageDescription)?>">
<meta name="theme-color" content="#2563eb"><link rel="icon" href="<?=asset('favicon.svg')?>" type="image/svg+xml"><link rel="stylesheet" href="<?=asset('css/app.css')?>"><link rel="stylesheet" href="<?=asset('css/article-overflow-fixes.css')?>"><script defer src="<?=asset('js/app.js')?>"></script>
<?=jsonld(['@context'=>'https://schema.org','@type'=>'WebSite','name'=>SITE_NAME,'url'=>SITE_URL,'potentialAction'=>['@type'=>'SearchAction','target'=>SITE_URL.'/all-tools?q={search_term_string}','query-input'=>'required name=search_term_string']])?>
<?=$extraHead??''?>
</head><body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header"><div class="container header-inner">
<a class="brand" href="/"><span class="brand-mark">TK</span><span>ToolboxKart</span></a>
<nav class="desktop-nav" aria-label="Primary"><a href="/seo/">SEO</a><a href="/marketing/">Marketing</a><a href="/finance/">Finance</a><a href="/healthcare/">Healthcare</a><a href="/developer/">Developer</a><a href="/blog/">Blog</a></nav>
<div class="header-actions"><button class="icon-btn search-trigger" type="button" aria-label="Search tools">⌕ <span>Search</span><kbd>⌘K</kbd></button><button class="icon-btn theme-toggle" type="button" aria-label="Toggle theme">◐</button><button class="menu-toggle" type="button" aria-label="Open menu">☰</button></div>
</div><div class="mobile-nav" aria-label="Mobile"><a href="/seo/">SEO</a><a href="/marketing/">Marketing</a><a href="/finance/">Finance</a><a href="/healthcare/">Healthcare</a><a href="/developer/">Developer</a><a href="/productivity/">Productivity</a><a href="/blog/">Blog</a></div></header>
<main id="main">
