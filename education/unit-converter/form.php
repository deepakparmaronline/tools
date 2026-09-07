<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'category',
    'label' => 'Category',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['length', 'Length'], ['mass', 'Mass'], ['temperature', 'Temperature'], ['data', 'Digital data']]
], [
    'name' => 'value',
    'label' => 'Value',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Number to convert',
    'step' => 'any'
], [
    'name' => 'from',
    'label' => 'From unit',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['m', 'meter'], ['km', 'kilometer'], ['cm', 'centimeter'], ['in', 'inch'], ['ft', 'foot'], ['mi', 'mile']]
], [
    'name' => 'to',
    'label' => 'To unit',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['km', 'kilometer'], ['m', 'meter'], ['cm', 'centimeter'], ['in', 'inch'], ['ft', 'foot'], ['mi', 'mile']]
]]); ?>
