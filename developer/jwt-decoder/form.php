<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'token',
    'label' => 'JWT',
    'type' => 'textarea',
    'placeholder' => 'eyJ...',
    'help' => 'Paste a compact JWT'
]]); ?>
