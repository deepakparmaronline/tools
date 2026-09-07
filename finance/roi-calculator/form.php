<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'invested',
    'label' => 'Amount invested',
    'type' => 'number',
    'placeholder' => '10000',
    'help' => 'Initial investment or project cost',
    'min' => '0.01',
    'step' => '0.01'
], [
    'name' => 'returned',
    'label' => 'Final value / amount returned',
    'type' => 'number',
    'placeholder' => '12500',
    'help' => 'Ending value or proceeds',
    'step' => '0.01'
], [
    'name' => 'years',
    'label' => 'Holding period (years)',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Optional annualization period',
    'min' => '0.01',
    'step' => '0.01'
]]); ?>
