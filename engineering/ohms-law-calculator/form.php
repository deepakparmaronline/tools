<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'voltage',
    'label' => 'Voltage (V)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Leave blank if unknown',
    'step' => 'any'
], [
    'name' => 'current',
    'label' => 'Current (A)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Leave blank if unknown',
    'step' => 'any'
], [
    'name' => 'resistance',
    'label' => 'Resistance (Ω)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Leave blank if unknown',
    'step' => 'any'
], [
    'name' => 'power',
    'label' => 'Power (W)',
    'type' => 'number',
    'placeholder' => '',
    'help' => 'Leave blank if unknown',
    'step' => 'any'
]]); ?>
