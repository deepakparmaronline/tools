<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'bands',
    'label' => 'Band count',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['4', '4 band'], ['5', '5 band']]
], [
    'name' => 'b1',
    'label' => 'Band 1',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['black', 'Black'], ['brown', 'Brown'], ['red', 'Red'], ['orange', 'Orange'], ['yellow', 'Yellow'], ['green', 'Green'], ['blue', 'Blue'], ['violet', 'Violet'], ['grey', 'Grey'], ['white', 'White']]
], [
    'name' => 'b2',
    'label' => 'Band 2',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['black', 'Black'], ['brown', 'Brown'], ['red', 'Red'], ['orange', 'Orange'], ['yellow', 'Yellow'], ['green', 'Green'], ['blue', 'Blue'], ['violet', 'Violet'], ['grey', 'Grey'], ['white', 'White']]
], [
    'name' => 'b3',
    'label' => 'Band 3 (5-band only)',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['black', 'Black'], ['brown', 'Brown'], ['red', 'Red'], ['orange', 'Orange'], ['yellow', 'Yellow'], ['green', 'Green'], ['blue', 'Blue'], ['violet', 'Violet'], ['grey', 'Grey'], ['white', 'White']]
], [
    'name' => 'mult',
    'label' => 'Multiplier',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['black', 'Black'], ['brown', 'Brown'], ['red', 'Red'], ['orange', 'Orange'], ['yellow', 'Yellow'], ['green', 'Green'], ['blue', 'Blue'], ['violet', 'Violet'], ['grey', 'Grey'], ['white', 'White'], ['gold', 'Gold'], ['silver', 'Silver']]
], [
    'name' => 'tol',
    'label' => 'Tolerance',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['brown', 'Brown ±1%'], ['red', 'Red ±2%'], ['green', 'Green ±0.5%'], ['blue', 'Blue ±0.25%'], ['violet', 'Violet ±0.1%'], ['grey', 'Grey ±0.05%'], ['gold', 'Gold ±5%'], ['silver', 'Silver ±10%']]
]]); ?>
