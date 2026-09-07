<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'input_price',
    'label' => 'Input price / 1M tokens ($)',
    'type' => 'number',
    'placeholder' => '1.00',
    'help' => 'Use the current provider price',
    'min' => '0',
    'step' => '0.0001'
], [
    'name' => 'output_price',
    'label' => 'Output price / 1M tokens ($)',
    'type' => 'number',
    'placeholder' => '5.00',
    'help' => 'Use the current provider price',
    'min' => '0',
    'step' => '0.0001'
], [
    'name' => 'input_tokens',
    'label' => 'Input tokens / request',
    'type' => 'number',
    'placeholder' => '2000',
    'help' => 'Average uncached input tokens',
    'min' => '0',
    'step' => '1'
], [
    'name' => 'output_tokens',
    'label' => 'Output tokens / request',
    'type' => 'number',
    'placeholder' => '500',
    'help' => 'Average output tokens',
    'min' => '0',
    'step' => '1'
], [
    'name' => 'requests',
    'label' => 'Requests in period',
    'type' => 'number',
    'placeholder' => '10000',
    'help' => 'Daily, monthly or project total',
    'min' => '0',
    'step' => '1'
], [
    'name' => 'cached_pct',
    'label' => 'Cached input (%)',
    'type' => 'number',
    'placeholder' => '0',
    'help' => 'Optional share of input billed at cached multiplier',
    'min' => '0',
    'max' => '100',
    'step' => '0.1'
], [
    'name' => 'cache_mult',
    'label' => 'Cached price multiplier',
    'type' => 'number',
    'placeholder' => '0.1',
    'help' => 'Example: 0.1 means 10% of normal input price',
    'min' => '0',
    'step' => '0.01'
]]); ?>
