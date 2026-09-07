<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'input',
    'label' => 'Input',
    'type' => 'textarea',
    'placeholder' => 'Hello ToolboxKart',
    'help' => 'Text or Base64'
], [
    'name' => 'mode',
    'label' => 'Mode',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['encode', 'Encode to Base64'], ['decode', 'Decode Base64']]
]]); ?>
