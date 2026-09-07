<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'cost',
    'label' => 'Cost per unit',
    'type' => 'number',
    'placeholder' => '60',
    'help' => 'Total cost for one unit',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'price',
    'label' => 'Selling price',
    'type' => 'number',
    'placeholder' => '100',
    'help' => 'Revenue per unit',
    'min' => '0.01',
    'step' => '0.01'
], [
    'name' => 'units',
    'label' => 'Units',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Optional scale for total profit',
    'min' => '1',
    'step' => '1'
], [
    'name' => 'target',
    'label' => 'Target margin (%)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Optional price target',
    'step' => '0.01'
]]); ?>
