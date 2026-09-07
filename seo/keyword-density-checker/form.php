<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'text',
    'label' => 'Text to analyze',
    'type' => 'textarea',
    'placeholder' => 'Paste your article or page copy here...',
    'help' => 'Processing stays in your browser'
], [
    'name' => 'keyword',
    'label' => 'Focus keyword or phrase',
    'type' => 'text',
    'placeholder' => 'online tools',
    'help' => 'Optional phrase to measure directly'
], [
    'name' => 'minlen',
    'label' => 'Minimum word length',
    'type' => 'number',
    'placeholder' => '3',
    'help' => 'Ignore very short words in the frequency table',
    'min' => '1',
    'max' => '20',
    'step' => '1'
]]); ?>
