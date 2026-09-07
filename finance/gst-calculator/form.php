<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'currency',
    'label' => 'Currency',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Formatting only; no exchange-rate conversion',
    'options' => [['INR', '₹ Indian rupee'], ['USD', '$ US dollar'], ['EUR', '€ Euro'], ['GBP', '£ British pound'], ['AUD', 'A$ Australian dollar'], ['CAD', 'C$ Canadian dollar']]
], [
    'name' => 'amount',
    'label' => 'Amount',
    'type' => 'number',
    'placeholder' => '1000',
    'help' => 'Enter the base or tax-inclusive amount',
    'min' => '0',
    'step' => '0.01'
], [
    'name' => 'rate',
    'label' => 'GST rate (%)',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['0', '0%'], ['5', '5%'], ['12', '12%'], ['18', '18%'], ['28', '28%']]
], [
    'name' => 'mode',
    'label' => 'Calculation',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['add', 'Add GST'], ['remove', 'Remove GST from inclusive amount']]
]]); ?>
