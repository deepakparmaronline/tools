<?php
require __DIR__."/../includes/bootstrap.php";
$post = post_by_slug("australian-youth-safety-blueprint-six-pillars");
if (!$post) { http_response_code(404); exit; }
?>
<!doctype html><html><head><title><?=e($post["title"])?></title></head><body><h1><?=e($post["title"])?></h1><p><?=e($post["description"])?></p><p>Diagnostic page.</p></body></html>