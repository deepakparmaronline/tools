<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'json',
    'label' => 'JSON input',
    'type' => 'textarea',
    'placeholder' => '{"name":"ToolboxKart","free":true}',
    'help' => 'Paste or type JSON'
], [
    'name' => 'indent',
    'label' => 'Indent',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['2', '2 spaces'], ['4', '4 spaces'], ['tab', 'Tab']]
], [
    'name' => 'sort',
    'label' => 'Sort object keys',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Sort keys alphabetically at every object level'
], [
    'name' => 'action',
    'label' => 'Action',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['format', 'Format'], ['minify', 'Minify'], ['validate', 'Validate only']]
]]); ?>
