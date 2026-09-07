<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'sip',
    'label' => 'Investment per contribution',
    'type' => 'number',
    'placeholder' => '5000',
    'help' => 'Amount invested each period',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'return',
    'label' => 'Expected annual return (%)',
    'type' => 'number',
    'placeholder' => '12',
    'help' => 'Assumed annualized return',
    'step' => '0.01'
], [
    'name' => 'years',
    'label' => 'Time period (years)',
    'type' => 'number',
    'placeholder' => '10',
    'help' => 'Investment horizon',
    'min' => '0.1',
    'step' => '0.1'
], [
    'name' => 'frequency',
    'label' => 'Contribution frequency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'How often you contribute',
    'options' => [['12', 'Monthly'], ['52', 'Weekly'], ['4', 'Quarterly'], ['1', 'Yearly']]
]]); ?>
