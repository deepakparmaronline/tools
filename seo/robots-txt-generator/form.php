<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'agent',
    'label' => 'User-agent',
    'type' => 'text',
    'placeholder' => '*',
    'help' => 'Crawler name, usually *'
], [
    'name' => 'allow',
    'label' => 'Allow paths',
    'type' => 'textarea',
    'placeholder' => '/public/',
    'help' => 'One path per line; optional'
], [
    'name' => 'disallow',
    'label' => 'Disallow paths',
    'type' => 'textarea',
    'placeholder' => '/admin/\n/private/',
    'help' => 'One path per line'
], [
    'name' => 'sitemap',
    'label' => 'Sitemap URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/sitemap.xml',
    'help' => 'Optional absolute sitemap URL'
]]); ?>
