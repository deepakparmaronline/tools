<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'count',
    'label' => 'How many UUIDs?',
    'type' => 'number',
    'placeholder' => '5',
    'help' => 'Generate a batch',
    'min' => '1',
    'max' => '100',
    'step' => '1'
], [
    'name' => 'upper',
    'label' => 'Uppercase output',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => ''
], [
    'name' => 'hyphens',
    'label' => 'Keep hyphens',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => '',
    'checked' => true
]]); ?>
