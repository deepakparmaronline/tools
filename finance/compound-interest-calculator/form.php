<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'initial',
    'label' => 'Initial investment',
    'type' => 'number',
    'placeholder' => '10000',
    'help' => 'Starting principal',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'monthly',
    'label' => 'Monthly contribution',
    'type' => 'number',
    'placeholder' => '500',
    'help' => 'Optional ongoing contribution',
    'step' => '0.01'
], [
    'name' => 'years',
    'label' => 'Years',
    'type' => 'number',
    'placeholder' => '10',
    'help' => 'Investment period',
    'min' => '0',
    'step' => '0.1'
], [
    'name' => 'rate',
    'label' => 'Annual interest rate (%)',
    'type' => 'number',
    'placeholder' => '7',
    'help' => 'Expected annual rate',
    'step' => '0.01'
], [
    'name' => 'compound',
    'label' => 'Compounding frequency',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['12', 'Monthly'], ['4', 'Quarterly'], ['2', 'Semiannually'], ['1', 'Annually']]
]]); ?>
