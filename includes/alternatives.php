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

function alternative_url(array $article): string { return url('alternatives/'.$article['slug'].'/'); }

function alternative_path(array $article): string { return '/alternatives/'.$article['slug'].'/'; }

function alternative_image_url(array $article): string {
    $image = $article['image'] ?? '';
    if (str_starts_with($image, '/') && !str_starts_with($image, '//')) return url($image);
    return filter_var($image, FILTER_VALIDATE_URL) && str_starts_with($image, 'https://') ? $image : '';
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
