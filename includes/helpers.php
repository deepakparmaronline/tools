<?php
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
function tbk_url(string $path=''): string { return TBK_BASE_URL . '/' . ltrim($path,'/'); }
function tbk_categories(): array { static $x; return $x ??= require TBK_ROOT.'/registry/categories.php'; }
function tbk_tools(): array { static $x; return $x ??= require TBK_ROOT.'/registry/tools.php'; }
function tbk_tools_by_category(string $cat): array { return array_values(array_filter(tbk_tools(), fn($t)=>$t['category']===$cat && ($t['status']??'published')==='published')); }
function tbk_tool_by_slug(string $slug): ?array { foreach(tbk_tools() as $t) if($t['slug']===$slug) return $t; return null; }
function tbk_popular_tools(int $limit=8): array { $a=array_values(array_filter(tbk_tools(),fn($t)=>!empty($t['popular']))); return array_slice($a,0,$limit); }
function tbk_page_head(string $title,string $desc,string $canonical,string $type='website'): void {
  $full=$title.' | '.TBK_SITE_NAME;
  echo '<title>'.e($full).'</title><meta name="description" content="'.e($desc).'"><link rel="canonical" href="'.e($canonical).'">';
  echo '<meta property="og:title" content="'.e($full).'"><meta property="og:description" content="'.e($desc).'"><meta property="og:type" content="'.e($type).'"><meta property="og:url" content="'.e($canonical).'">';
  echo '<meta name="twitter:card" content="summary"><meta name="theme-color" content="#ffffff">';
}
function tbk_jsonld(array $data): void { echo '<script type="application/ld+json">'.json_encode($data,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>'; }
