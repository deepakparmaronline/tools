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
<meta name="twitter:card" content="<?=!empty($socialImage)?'summary_large_image':'summary'?>"><meta name="twitter:title" content="<?=e($pageTitle)?>"><meta name="twitter:description" content="<?=e($pageDescription)?>">
<?php if (!empty($socialImage)): ?>
<meta property="og:image" content="<?=e($socialImage)?>"><meta property="og:image:alt" content="<?=e($socialImageAlt ?? '')?>"><meta name="twitter:image" content="<?=e($socialImage)?>"><meta name="twitter:image:alt" content="<?=e($socialImageAlt ?? '')?>">
<?php endif; ?>
<meta name="theme-color" content="#2563eb"><link rel="icon" href="<?=asset('favicon.svg')?>" type="image/svg+xml"><link rel="stylesheet" href="<?=asset('css/app.css')?>"><link rel="stylesheet" href="<?=asset('css/article-overflow-fixes.css')?>"><script defer src="/assets/site.js"></script><script defer src="<?=asset('js/app.js')?>"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-53VHLS4K');</script>
<!-- End Google Tag Manager -->
<?=jsonld(['@context'=>'https://schema.org','@type'=>'WebSite','name'=>SITE_NAME,'url'=>SITE_URL,'potentialAction'=>['@type'=>'SearchAction','target'=>SITE_URL.'/all-tools?q={search_term_string}','query-input'=>'required name=search_term_string']])?>
<?=$extraHead??''?>
</head><body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53VHLS4K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<a class="skip-link" href="#main">Skip to content</a>
<header id="site-header" class="site-header"></header>
<noscript><nav class="site-nav-fallback" aria-label="Site navigation"><a href="/">ToolboxKart</a><a href="/tech/">Tech</a><a href="/tools-guide/">Tool guides</a><a href="/alternatives/">Alternatives</a><a href="/all-tools">All tools</a></nav></noscript>
<main id="main">
