<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'mode',
    'label' => 'Calculation',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['of', 'What is X% of Y?'], ['what', 'X is what % of Y?'], ['change', 'Percentage change from X to Y']]
], [
    'name' => 'x',
    'label' => 'X',
    'type' => 'number',
    'placeholder' => '20',
    'help' => 'First value',
    'step' => '0.01'
], [
    'name' => 'y',
    'label' => 'Y',
    'type' => 'number',
    'placeholder' => '150',
    'help' => 'Second value',
    'step' => '0.01'
]]); ?>
