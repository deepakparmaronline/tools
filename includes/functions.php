<?php
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function url(string $path=''): string { return SITE_URL.'/'.ltrim($path,'/'); }
function asset(string $path): string { return url('assets/'.ltrim($path,'/')); }
function tool_by_path(string $category,string $slug): ?array { global $catalog; foreach($catalog['tools'] as $t){ if($t['category']===$category && $t['slug']===$slug) return $t; } return null; }
function tools_in_category(string $category): array { global $catalog; return array_values(array_filter($catalog['tools'],fn($t)=>$t['category']===$category)); }
function category_data(string $category): ?array { global $catalog; return $catalog[$category] ?? null; }
function post_by_slug(string $slug): ?array { global $posts; foreach($posts as $p){if($p['slug']===$slug)return $p;} return null; }
function page_title(string $title): string { return $title.' | '.SITE_NAME; }
function jsonld(array $data): string { return '<script type="application/ld+json">'.json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>'; }
function breadcrumbs(array $items): array { return ['@type'=>'BreadcrumbList','itemListElement'=>array_map(fn($item,$i)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$item['name'],'item'=>$item['url']],$items,array_keys($items))]; }
function get_related_tools(string $category,string $slug,int $limit=4): array { $items=array_values(array_filter(tools_in_category($category),fn($t)=>$t['slug']!==$slug)); return array_slice($items,0,$limit); }
function render_tool_cards(array $tools): void { foreach($tools as $t){ $cat=category_data($t['category']); echo '<a class="tool-card" href="/'.e($t['category']).'/'.e($t['slug']).'"><span class="tool-card__icon">'.e($cat['icon']).'</span><span><strong>'.e($t['name']).'</strong><small>'.e($t['description']).'</small></span><span class="arrow">→</span></a>'; } }
function fmt_date(string $date): string { return date('F j, Y', strtotime($date)); }
