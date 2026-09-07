<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'urls',
    'label' => 'Page URLs',
    'type' => 'textarea',
    'placeholder' => 'https://example.com/\nhttps://example.com/about/',
    'help' => 'One absolute URL per line'
], [
    'name' => 'lastmod',
    'label' => 'Last modified date',
    'type' => 'date',
    'placeholder' => '',
    'help' => 'Optional date applied to all URLs'
], [
    'name' => 'changefreq',
    'label' => 'Change frequency',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['', 'Do not include'], ['daily', 'daily'], ['weekly', 'weekly'], ['monthly', 'monthly'], ['yearly', 'yearly']]
], [
    'name' => 'priority',
    'label' => 'Priority',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['', 'Do not include'], ['1.0', '1.0'], ['0.8', '0.8'], ['0.5', '0.5'], ['0.3', '0.3']]
]]); ?>
