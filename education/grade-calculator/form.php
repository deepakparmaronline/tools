<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'items',
    'label' => 'Graded items',
    'type' => 'textarea',
    'placeholder' => 'Homework,85,30\nMidterm,78,30\nProject,92,20',
    'help' => 'One line: name,score %,weight %'
], [
    'name' => 'remaining',
    'label' => 'Remaining weight (%)',
    'type' => 'number',
    'placeholder' => '20',
    'help' => 'Weight of final/ungraded item',
    'min' => '0',
    'max' => '100',
    'step' => '0.01'
], [
    'name' => 'target',
    'label' => 'Target course grade (%)',
    'type' => 'number',
    'placeholder' => '80',
    'help' => 'Desired overall grade',
    'step' => '0.01'
]]); ?>
