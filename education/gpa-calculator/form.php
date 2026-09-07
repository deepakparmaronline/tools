<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'courses',
    'label' => 'Courses',
    'type' => 'textarea',
    'placeholder' => '3,A\n4,B+\n3,A-',
    'help' => 'One course per line: credits,grade (A, B+, C-, etc.)'
]]); ?>
