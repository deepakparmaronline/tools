<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'file',
    'label' => 'Choose image',
    'type' => 'file',
    'placeholder' => '',
    'help' => 'JPG, PNG or WebP',
    'accept' => 'image/jpeg,image/png,image/webp'
], [
    'name' => 'format',
    'label' => 'Convert to',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['image/webp', 'WebP'], ['image/jpeg', 'JPEG'], ['image/png', 'PNG']]
], [
    'name' => 'quality',
    'label' => 'Quality (%)',
    'type' => 'number',
    'placeholder' => '90',
    'help' => 'Applies to JPEG/WebP',
    'min' => '10',
    'max' => '100',
    'step' => '1'
]]); ?>
