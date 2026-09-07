<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'original',
    'label' => 'Original text',
    'type' => 'textarea',
    'placeholder' => 'alpha\nbeta\ngamma',
    'help' => 'First version'
], [
    'name' => 'changed',
    'label' => 'Changed text',
    'type' => 'textarea',
    'placeholder' => 'alpha\nbeta changed\ngamma',
    'help' => 'Second version'
], [
    'name' => 'ignore_ws',
    'label' => 'Ignore whitespace differences',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => ''
], [
    'name' => 'ignore_case',
    'label' => 'Ignore case differences',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => ''
]]); ?>
