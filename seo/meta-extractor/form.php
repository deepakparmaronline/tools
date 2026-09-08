<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'html',
    'label' => 'HTML source',
    'type' => 'textarea',
    'placeholder' => '<!doctype html>\n<html>\n<head>\n  <title>Example page</title>\n  <meta name="description" content="Example description">\n  <link rel="canonical" href="https://example.com/page/">\n</head>\n</html>',
    'help' => 'Paste the full page source or the HTML head you want to inspect.'
]]); ?>
