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
    'placeholder' => '250000',
    'help' => 'Principal borrowed',
    'min' => '0.01',
    'step' => '0.01'
], [
    'name' => 'rate',
    'label' => 'Annual interest rate (%)',
    'type' => 'number',
    'placeholder' => '7',
    'help' => 'APR-style annual rate',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'months',
    'label' => 'Original term (months)',
    'type' => 'number',
    'placeholder' => '60',
    'help' => 'Scheduled term',
    'min' => '1',
    'step' => '1'
], [
    'name' => 'extra',
    'label' => 'Extra payment per month',
    'type' => 'number',
    'placeholder' => '0',
    'help' => 'Optional amount paid above the scheduled payment',
    'min' => '0',
    'step' => '0.01'
]]); ?>
