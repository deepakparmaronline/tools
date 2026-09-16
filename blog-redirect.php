<?php
require __DIR__.'/includes/bootstrap.php';
$slug = $_GET['slug'] ?? '';
$post = post_by_slug($slug);
if (!$post) {
    header('Location: /chatgpt/', true, 301);
    exit;
}
$category = post_category_key($post['title'].' '.$post['slug'].' '.$post['category']);
header('Location: /'.$category.'/'.$slug, true, 301);
exit;
