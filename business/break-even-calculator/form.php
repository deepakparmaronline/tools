<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'fixed',
    'label' => 'Fixed costs',
    'type' => 'number',
    'placeholder' => '5000',
    'help' => 'Costs that do not change with unit volume',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'price',
    'label' => 'Selling price per unit',
    'type' => 'number',
    'placeholder' => '50',
    'help' => 'Revenue per unit',
    'min' => '0.01',
    'step' => '0.01'
], [
    'name' => 'variable',
    'label' => 'Variable cost per unit',
    'type' => 'number',
    'placeholder' => '20',
    'help' => 'Cost that changes per sale',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'target',
    'label' => 'Target profit',
    'type' => 'number',
    'placeholder' => '0',
    'help' => 'Optional profit above break-even',
    'step' => '0.01'
]]); ?>
