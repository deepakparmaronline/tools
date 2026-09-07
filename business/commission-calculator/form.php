<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'sales',
    'label' => 'Sales amount',
    'type' => 'number',
    'placeholder' => '25000',
    'help' => 'Eligible sales value',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'rate',
    'label' => 'Commission rate (%)',
    'type' => 'number',
    'placeholder' => '5',
    'help' => 'Percentage of sales',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'bonus',
    'label' => 'Fixed bonus',
    'type' => 'number',
    'placeholder' => '0',
    'help' => 'Optional flat bonus',
    'step' => '0.01'
], [
    'name' => 'base',
    'label' => 'Base pay for period',
    'type' => 'number',
    'placeholder' => '0',
    'help' => 'Optional base salary/pay',
    'step' => '0.01'
]]); ?>
