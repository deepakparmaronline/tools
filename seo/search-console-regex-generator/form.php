<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'terms',
    'label' => 'Keywords or values',
    'type' => 'textarea',
    'placeholder' => "seo tools, google search console, technical seo",
    'help' => 'Enter one value per line or separate values with commas.'
], [
    'name' => 'match',
    'label' => 'Match mode',
    'type' => 'select',
    'placeholder' => '',
    'options' => [
        ['contains', 'Contains any value'],
        ['exact', 'Exact values'],
        ['starts', 'Starts with any value'],
        ['ends', 'Ends with any value'],
    ],
    'help' => 'Contains is the most common choice for GSC query filters.'
], [
    'name' => 'dimension',
    'label' => 'GSC filter',
    'type' => 'select',
    'placeholder' => '',
    'options' => [
        ['query', 'Query'],
        ['page', 'Page'],
    ],
    'help' => 'Choose the Search Console dimension where you will paste the regex.'
], [
    'name' => 'group',
    'label' => 'Wrap alternatives in a group',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Uses a non-capturing group such as (?:seo|analytics).',
    'checked' => true
], [
    'name' => 'case_sensitive',
    'label' => 'Case-sensitive matching',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Adds (?-i). GSC is case-insensitive by default.',
    'checked' => false
]]); ?>
