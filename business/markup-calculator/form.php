<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'cost',
    'label' => 'Cost',
    'type' => 'number',
    'placeholder' => '100',
    'help' => 'Cost or buy price',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'markup',
    'label' => 'Markup (%)',
    'type' => 'number',
    'placeholder' => '40',
    'help' => 'Markup is based on cost',
    'step' => '0.01'
], [
    'name' => 'units',
    'label' => 'Units',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Optional quantity',
    'min' => '1',
    'step' => '1'
]]); ?>
