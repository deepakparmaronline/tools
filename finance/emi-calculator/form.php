<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'principal',
    'label' => 'Loan amount',
    'type' => 'number',
    'placeholder' => '500000',
    'help' => 'Principal you plan to borrow',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'rate',
    'label' => 'Annual interest rate (%)',
    'type' => 'number',
    'placeholder' => '8.5',
    'help' => 'Nominal annual rate',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'months',
    'label' => 'Loan tenure',
    'type' => 'number',
    'placeholder' => '60',
    'help' => 'Number of months',
    'min' => '1',
    'step' => '1'
]]); ?>
