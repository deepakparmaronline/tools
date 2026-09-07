<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'site',
    'label' => 'Site name',
    'type' => 'text',
    'placeholder' => 'ToolboxKart',
    'help' => 'Brand or site name'
], [
    'name' => 'url',
    'label' => 'Page URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/tool/',
    'help' => 'Displayed domain/URL'
], [
    'name' => 'title',
    'label' => 'SEO title',
    'type' => 'text',
    'placeholder' => 'A useful page title',
    'help' => 'Search result headline'
], [
    'name' => 'description',
    'label' => 'Meta description',
    'type' => 'textarea',
    'placeholder' => 'A concise description of this page.',
    'help' => 'Search result supporting text'
], [
    'name' => 'device',
    'label' => 'Preview',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['desktop', 'Desktop'], ['mobile', 'Mobile']]
]]); ?>
