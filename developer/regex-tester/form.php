<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'pattern',
    'label' => 'Pattern',
    'type' => 'text',
    'placeholder' => '\\btool\\w*',
    'help' => 'Do not include / delimiters'
], [
    'name' => 'flags',
    'label' => 'Flags',
    'type' => 'text',
    'placeholder' => 'gi',
    'help' => 'JavaScript flags such as g, i, m, s, u'
], [
    'name' => 'text',
    'label' => 'Test text',
    'type' => 'textarea',
    'placeholder' => 'ToolboxKart has useful tools.',
    'help' => 'Text to search'
]]); ?>
