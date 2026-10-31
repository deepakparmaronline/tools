<?php
// Each article file returns its metadata and trusted, editorial HTML content.
function alternative_articles(): array {
    static $articles;
    if (isset($articles)) return $articles;
    $articles = [];
    foreach (glob(__DIR__.'/../alternatives/articles/*.php') ?: [] as $file) {
        $article = require $file;
        if (!is_array($article) || ($article['status'] ?? 'draft') !== 'published') continue;
        $slug = basename($file, '.php');
        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/D', $slug) || preg_match('/^\d{4}-\d{2}-\d{2}(?:-|$)/', $slug)) continue;
        if (!is_string($article['title'] ?? null) || trim($article['title']) === '' || !is_string($article['content'] ?? null) || trim($article['content']) === '' || !is_string($article['date'] ?? null)) continue;
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $article['date']);
        if (!$date || $date->format('Y-m-d') !== $article['date'] || $article['date'] > (new DateTimeImmutable('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d')) continue;
        $article['slug'] = $slug;
        if (empty($article['description'])) {
            $text = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($article['content']), ENT_QUOTES, 'UTF-8')));
            $characters = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $article['description'] = count($characters) > 160 ? implode('', array_slice($characters, 0, 157)).'…' : $text;
        }
        $article['author'] = $article['author'] ?? SITE_AUTHOR;
        $article['tag'] = $article['tag'] ?? 'Alternatives';
        $modified = $article['updated'] ?? $article['date'];
        $updated = is_string($modified) ? DateTimeImmutable::createFromFormat('!Y-m-d', $modified) : false;
        $article['updated'] = $updated && $updated->format('Y-m-d') === $modified && $modified >= $article['date'] && $modified <= (new DateTimeImmutable('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d') ? $modified : $article['date'];
        $articles[$slug] = $article;
    }
    uasort($articles, fn($a, $b) => strcmp($b['date'], $a['date']) ?: strcmp($a['title'], $b['title']));
    return $articles;
}

function alternative_url(array $article): string { return url(ltrim(alternative_path($article), '/')); }

function alternative_path(array $article): string {
    $customPath = $article['url_path'] ?? null;
    if (is_string($customPath) && preg_match('#^/[a-z0-9-]+/alternatives/$#D', $customPath)) return $customPath;
    return '/alternatives/'.($article['slug'] ?? '').'/';
}

function alternative_image_url(array $article): string {
    $image = $article['image'] ?? '';
    if (str_starts_with($image, '/') && !str_starts_with($image, '//')) return url($image);
    return filter_var($image, FILTER_VALIDATE_URL) && str_starts_with($image, 'https://') ? $image : '';
}

function alternative_topic_group(array $article): array {
    $slug = $article['slug'] ?? '';
    $groups = [
        'productivity'=>['name'=>'Productivity, focus and scheduling','description'=>'Task planning, calendars, focus blockers, booking and personal workflow tools.','slugs'=>['akiflow-alternatives','fantastical-alternatives','freedom-alternatives','odrive-alternatives','sunsama-alternatives','taskade-alternatives','tidycal-alternatives','vector-alternatives']],
        'privacy-browsers'=>['name'=>'Browsers and privacy','description'=>'Browser, tracker-blocking and private-search choices for different devices.','slugs'=>['arc-search-alternatives','ghostery-alternatives','orion-browser-alternatives']],
        'customer-growth'=>['name'=>'Customer, sales and marketing','description'=>'Customer success, support, feedback, messaging and lead-conversion software.','slugs'=>['callpage-alternatives','drift-alternatives','freshdesk-alternatives','gainsight-alternatives','leave-me-alone-alternatives','stonly-alternatives','survicate-alternatives','wati-alternatives','zendesk-alternatives']],
        'developer-creative'=>['name'=>'Developer and creative workflows','description'=>'Documentation, integrations, app delivery, design review and motion tools.','slugs'=>['hera-alternatives','mintlify-alternatives','mobiloud-alternatives','nylas-alternatives','ruttl-alternatives']],
        'documents-specialist'=>['name'=>'Documents, study and specialist software','description'=>'PDF, study, meeting, compliance and industry-specific software.','slugs'=>['notegpt-alternatives','pearl-alternatives','shadow-alternatives','updf-alternatives','vanta-alternatives']],
        'freelance-marketplaces'=>['name'=>'Freelance marketplaces','description'=>'Open freelance marketplaces, portfolio-led workspaces, vetted expert networks and design contests for buyers and independent professionals.','slugs'=>['fiverr-alternatives']],
    ];
    foreach ($groups as $key=>$group) if (in_array($slug,$group['slugs'],true)) return ['key'=>$key]+$group;
    return ['key'=>'other','name'=>'More software alternatives','description'=>'Additional researched alternatives for specific workflows.','slugs'=>[]];
}

function alternative_grouped_articles(): array {
    $groups = [];
    foreach (alternative_articles() as $article) {
        $group = alternative_topic_group($article);
        if (!isset($groups[$group['key']])) $groups[$group['key']] = ['name'=>$group['name'],'description'=>$group['description'],'articles'=>[]];
        $groups[$group['key']]['articles'][] = $article;
    }
    return $groups;
}

function related_alternative_articles(array $source, int $limit=3): array {
    $sourceGroup = alternative_topic_group($source)['key'];
    $sourceTokens = array_filter(preg_split('/[^a-z0-9]+/',strtolower(($source['title'] ?? '').' '.($source['tag'] ?? ''))) ?: [],fn($token)=>strlen($token)>3);
    $candidates = array_values(array_filter(alternative_articles(),fn($item)=>$item['slug'] !== $source['slug']));
    usort($candidates,function($a,$b) use ($source,$sourceGroup,$sourceTokens) {
        $score = function($item) use ($source,$sourceGroup,$sourceTokens) {
            $value = alternative_topic_group($item)['key'] === $sourceGroup ? 20 : 0;
            $value += ($item['tag'] ?? '') === ($source['tag'] ?? '') ? 30 : 0;
            $text = strtolower(($item['title'] ?? '').' '.($item['tag'] ?? ''));
            foreach ($sourceTokens as $token) if (str_contains($text,$token)) $value += 4;
            return $value;
        };
        return $score($b) <=> $score($a) ?: strcmp($b['date'],$a['date']);
    });
    return array_slice($candidates,0,$limit);
}

function render_alternative_cards(array $articles): void {
    foreach ($articles as $article): $image = alternative_image_url($article); ?>
    <article class="post-card alternative-card">
        <?php if ($image): ?><a href="<?=e(alternative_path($article))?>" tabindex="-1" aria-hidden="true"><img class="alternative-card-image" src="<?=e($image)?>" alt="" width="640" height="360" loading="lazy" decoding="async"></a><?php endif; ?>
        <span class="tag"><?=e($article['tag'])?></span>
        <h2><a href="<?=e(alternative_path($article))?>"><?=e($article['title'])?></a></h2>
        <p><?=e($article['description'])?></p>
        <div class="post-meta"><time datetime="<?=e($article['date'])?>"><?=e(fmt_date($article['date']))?></time></div>
        <a class="text-link alternative-read-more" href="<?=e(alternative_path($article))?>" aria-label="<?=e('Read more: '.$article['title'])?>">Read more →</a>
    </article>
    <?php endforeach;
}
