<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'vin',
    'label' => 'Input voltage (V)',
    'type' => 'number',
    'placeholder' => '12',
    'help' => 'Supply voltage',
    'step' => 'any'
], [
    'name' => 'r1',
    'label' => 'R1 (Ω)',
    'type' => 'number',
    'placeholder' => '10000',
    'help' => 'Top resistor',
    'min' => '0.000001',
    'step' => 'any'
], [
    'name' => 'r2',
    'label' => 'R2 (Ω)',
    'type' => 'number',
    'placeholder' => '10000',
    'help' => 'Bottom resistor',
    'min' => '0.000001',
    'step' => 'any'
], [
    'name' => 'load',
    'label' => 'Load resistance (Ω)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Optional resistor/load in parallel with R2',
    'min' => '0.000001',
    'step' => 'any'
]]); ?>
