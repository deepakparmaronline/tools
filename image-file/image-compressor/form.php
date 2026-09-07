<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'file',
    'label' => 'Choose image',
    'type' => 'file',
    'placeholder' => '',
    'help' => 'JPG, PNG or WebP',
    'accept' => 'image/jpeg,image/png,image/webp'
], [
    'name' => 'format',
    'label' => 'Output format',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['image/webp', 'WebP'], ['image/jpeg', 'JPEG'], ['image/png', 'PNG']]
], [
    'name' => 'quality',
    'label' => 'Quality (%)',
    'type' => 'number',
    'placeholder' => '82',
    'help' => 'JPEG/WebP quality',
    'min' => '10',
    'max' => '100',
    'step' => '1'
], [
    'name' => 'maxw',
    'label' => 'Maximum width (px)',
    'type' => 'number',
    'placeholder' => '0',
    'help' => '0 keeps original dimensions',
    'min' => '0',
    'step' => '1'
]]); ?>
