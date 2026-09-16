<?php
require __DIR__.'/includes/bootstrap.php';
$category = $_GET['category'] ?? '';
$slug = $_GET['slug'] ?? '';
$allowed = ['chatgpt','claude','ai-news','tools-guide'];
if (!in_array($category, $allowed, true) || $slug === '') {
    http_response_code(404);
    include __DIR__.'/404.php';
    exit;
}
$post = post_by_slug($slug);
if (!$post || post_category_key($post['title'].' '.$post['slug'].' '.$post['category']) !== $category) {
    http_response_code(404);
    include __DIR__.'/404.php';
    exit;
}
require __DIR__.'/blog/'.$slug.'.php';
