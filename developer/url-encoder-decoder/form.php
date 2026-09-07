<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'input',
    'label' => 'Input',
    'type' => 'textarea',
    'placeholder' => 'hello world & tools',
    'help' => 'Text to encode or decode'
], [
    'name' => 'mode',
    'label' => 'Mode',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['encode', 'Encode component'], ['decode', 'Decode component'], ['encodeurl', 'Encode full URL safely']]
]]); ?>
