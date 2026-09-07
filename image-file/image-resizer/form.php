<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'file',
    'label' => 'Choose image',
    'type' => 'file',
    'placeholder' => '',
    'help' => 'JPG, PNG or WebP',
    'accept' => 'image/jpeg,image/png,image/webp'
], [
    'name' => 'width',
    'label' => 'Width (px)',
    'type' => 'number',
    'placeholder' => '1200',
    'help' => 'Target width',
    'min' => '1',
    'step' => '1'
], [
    'name' => 'height',
    'label' => 'Height (px)',
    'type' => 'number',
    'placeholder' => '800',
    'help' => 'Target height',
    'min' => '1',
    'step' => '1'
], [
    'name' => 'lock',
    'label' => 'Keep aspect ratio',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => '',
    'checked' => true
], [
    'name' => 'format',
    'label' => 'Output format',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['image/webp', 'WebP'], ['image/jpeg', 'JPEG'], ['image/png', 'PNG']]
]]); ?>
