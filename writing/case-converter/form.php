<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'text',
    'label' => 'Text',
    'type' => 'textarea',
    'placeholder' => 'the quick brown fox',
    'help' => 'Paste text to transform'
], [
    'name' => 'case',
    'label' => 'Target case',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['upper', 'UPPERCASE'], ['lower', 'lowercase'], ['title', 'Title Case'], ['sentence', 'Sentence case'], ['camel', 'camelCase'], ['pascal', 'PascalCase'], ['snake', 'snake_case'], ['kebab', 'kebab-case'], ['alternating', 'aLtErNaTiNg']]
]]); ?>
