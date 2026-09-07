<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'title',
    'label' => 'Page title',
    'type' => 'text',
    'placeholder' => 'Free Tool | Example',
    'help' => 'Keep it descriptive and unique'
], [
    'name' => 'description',
    'label' => 'Meta description',
    'type' => 'textarea',
    'placeholder' => 'Describe the page clearly...',
    'help' => 'Write for humans first'
], [
    'name' => 'canonical',
    'label' => 'Canonical URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/page/',
    'help' => 'Use an absolute URL'
], [
    'name' => 'robots',
    'label' => 'Robots directive',
    'type' => 'select',
    'placeholder' => '',
    'help' => '',
    'options' => [['index,follow', 'index, follow'], ['noindex,follow', 'noindex, follow'], ['noindex,nofollow', 'noindex, nofollow']]
], [
    'name' => 'image',
    'label' => 'Social image URL',
    'type' => 'url',
    'placeholder' => 'https://example.com/image.jpg',
    'help' => 'Optional Open Graph/Twitter image'
], [
    'name' => 'social',
    'label' => 'Include social tags',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Open Graph and Twitter card tags',
    'checked' => true
]]); ?>
