<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'text',
    'label' => 'Prompt / document text',
    'type' => 'textarea',
    'placeholder' => 'Paste the text you plan to send to a model...',
    'help' => 'Nothing is uploaded'
], [
    'name' => 'method',
    'label' => 'Estimate method',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['chars', 'Characters ÷ 4'], ['words', 'Words × 1.33'], ['range', 'Show heuristic range']]
]]); ?>
