<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'type',
    'label' => 'Schema type',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['Organization', 'Organization'], ['Person', 'Person'], ['Article', 'Article'], ['Product', 'Product'], ['WebSite', 'WebSite']]
], [
    'name' => 'name',
    'label' => 'Name / headline',
    'type' => 'text',
    'placeholder' => 'Example Company',
    'help' => 'Primary name'
], [
    'name' => 'url',
    'label' => 'URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/',
    'help' => 'Canonical entity/page URL'
], [
    'name' => 'description',
    'label' => 'Description',
    'type' => 'textarea',
    'placeholder' => 'A concise description...',
    'help' => 'Optional description'
], [
    'name' => 'image',
    'label' => 'Image URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/image.jpg',
    'help' => 'Optional image'
]]); ?>
