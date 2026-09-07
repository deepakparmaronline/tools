<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'unit',
    'label' => 'Units',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['metric', 'Metric (kg, cm)'], ['imperial', 'Imperial (lb, in)']]
], [
    'name' => 'weight',
    'label' => 'Weight',
    'type' => 'number',
    'placeholder' => '70',
    'help' => 'kg or lb depending on units',
    'min' => '0.1',
    'step' => '0.1'
], [
    'name' => 'height',
    'label' => 'Height',
    'type' => 'number',
    'placeholder' => '175',
    'help' => 'cm or inches depending on units',
    'min' => '0.1',
    'step' => '0.1'
]]); ?>
