<?php
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function url(string $path=''): string { return SITE_URL.'/'.ltrim($path,'/'); }
function asset(string $path): string { return url('assets/'.ltrim($path,'/')); }
function tool_by_path(string $category,string $slug): ?array { global $catalog; foreach($catalog['tools'] as $t){ if($t['category']===$category && $t['slug']===$slug) return $t; } return null; }
function tool_categories(): array { global $catalog; return array_filter($catalog,fn($value,$key)=>$key!=='tools' && is_array($value) && isset($value['name'],$value['description'],$value['icon']),ARRAY_FILTER_USE_BOTH); }
function tools_in_category(string $category): array { global $catalog; return array_values(array_filter($catalog['tools'],fn($t)=>$t['category']===$category)); }
function category_data(string $category): ?array { global $catalog; $custom=['chatgpt'=>['name'=>'ChatGPT','description'=>'Practical ChatGPT tutorials, workflows, product updates and real-world use cases.','icon'=>'✦'],'claude'=>['name'=>'Claude','description'=>'Claude guides, product updates, workflows and practical AI research insights.','icon'=>'◌'],'ai-news'=>['name'=>'AI News','description'=>'AI industry news, launches and broader ecosystem updates from across the AI landscape.','icon'=>'◉'],'tools-guide'=>['name'=>'Tools Guide','description'=>'Tool tutorials, comparisons and practical workflows for AI and digital productivity tools.','icon'=>'▣']]; return $catalog[$category] ?? $custom[$category] ?? null; }
function post_category_key(string $category): string {
    $value = strtolower(trim($category));
    $match = strtolower(trim($category.' '));
    foreach($GLOBALS['posts'] ?? [] as $p) {
        if (($p['slug'] ?? '') === $category) { $match .= ' '.strtolower($p['title']); }
    }
    $haystack = $value . ' ' . $match;
    if (preg_match('/chatgpt|gpt-live|gpt-6|gpt6|openai|codex|o1|o3|gpt-5|gpt5/i', $haystack)) return 'chatgpt';
    if (preg_match('/claude|anthropic/i', $haystack)) return 'claude';
    if (preg_match('/how to use|how-to|guide|workflow|tutorial|comparison|best tools|using .* tool|tools guide|api guide|checklist|audit|review|generator|calculator|builder|analyzer/i', $haystack)) return 'tools-guide';
    return 'ai-news';
}
function post_category_label(array $post): string { $map=['chatgpt'=>'ChatGPT','claude'=>'Claude','ai-news'=>'AI News','tools-guide'=>'Tools Guide']; $key=post_category_key($post['title'].' '.$post['slug'].' '.$post['category']); return $map[$key] ?? 'AI News'; }
function category_display_name(string $category): string { return category_data($category)['name'] ?? strtoupper(str_replace('-',' ',$category)); }
function posts_for_category(string $category): array { global $posts; $items=array_values(array_filter($posts,fn($p)=>post_category_key($p['title'].' '.$p['slug'].' '.$p['category'])===$category)); usort($items,fn($a,$b)=>strcmp($b['date'],$a['date'])); return $items; }
function post_by_slug(string $slug): ?array { global $posts; foreach($posts as $p){if($p['slug']===$slug)return $p;} return null; }
function page_title(string $title): string { return $title.' | '.SITE_NAME; }
function jsonld(array $data): string { return '<script type="application/ld+json">'.json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>'; }
function breadcrumbs(array $items): array { return ['@type'=>'BreadcrumbList','itemListElement'=>array_map(fn($item,$i)=>['@type'=>'ListItem','position'=>$i+1,'name'=>$item['name'],'item'=>$item['url']],$items,array_keys($items))]; }
function get_related_tools(string $category,string $slug,int $limit=4): array { $items=array_values(array_filter(tools_in_category($category),fn($t)=>$t['slug']!==$slug)); return array_slice($items,0,$limit); }
function render_tool_cards(array $tools): void { foreach($tools as $t){ $cat=category_data($t['category']); echo '<a class="tool-card" href="/'.e($t['category']).'/'.e($t['slug']).'"><span class="tool-card__icon">'.e($cat['icon']).'</span><span><strong>'.e($t['name']).'</strong><small>'.e($t['description']).'</small></span><span class="arrow">→</span></a>'; } }
function fmt_date(string $date): string { return date('F j, Y', strtotime($date)); }
function post_url(array $post): string { $key=post_category_key($post['category']); return url($key.'/'.$post['slug']); }
