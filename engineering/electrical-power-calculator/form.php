<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'voltage',
    'label' => 'Voltage (V)',
    'type' => 'number',
    'placeholder' => '230',
    'help' => 'Supply voltage',
    'min' => '0',
    'step' => 'any'
], [
    'name' => 'current',
    'label' => 'Current (A)',
    'type' => 'number',
    'placeholder' => '2',
    'help' => 'Load current',
    'min' => '0',
    'step' => 'any'
], [
    'name' => 'pf',
    'label' => 'Power factor',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Use 1 for DC/resistive loads',
    'min' => '0',
    'max' => '1',
    'step' => '0.01'
], [
    'name' => 'hours',
    'label' => 'Runtime (hours)',
    'type' => 'number',
    'placeholder' => '1',
    'help' => 'Optional energy estimate',
    'min' => '0',
    'step' => '0.01'
]]); ?>
