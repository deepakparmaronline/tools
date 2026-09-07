<?php
http_response_code(404);
require_once __DIR__.'/config.php';
require_once TBK_ROOT.'/includes/helpers.php';
$canonical=tbk_url('404');
$head_callback=function()use($canonical){
  tbk_page_head('Page not found','The page you requested could not be found. Find another useful tool on ToolboxKart.',$canonical);
};
require TBK_ROOT.'/partials/header.php';
?>
<section class="section"><div class="wrap"><div class="tool-intro"><span class="eyebrow">Error 404</span><h1>That page is not here.</h1><p>The link may be outdated or the address may have been entered incorrectly. ToolboxKart has plenty of useful tools waiting for you.</p><div class="tool-actions"><a class="btn primary" href="/tools/">Browse all tools</a><a class="btn secondary" href="/">Return home</a></div></div></div></section>
<?php require TBK_ROOT.'/partials/footer.php'; ?>