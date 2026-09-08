<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([[
    'name' => 'text_a',
    'label' => 'First text',
    'type' => 'textarea',
    'placeholder' => 'Paste the first page or content block...',
    'help' => 'Plain text, HTML, or Markdown can be pasted.'
], [
    'name' => 'text_b',
    'label' => 'Second text',
    'type' => 'textarea',
    'placeholder' => 'Paste the second page or content block...',
    'help' => 'Use comparable content for the clearest result.'
], [
    'name' => 'ngram',
    'label' => 'Phrase size',
    'type' => 'select',
    'placeholder' => '',
    'help' => 'Larger phrases are stricter; 5 words is a useful default.',
    'options' => [[3, '3 words'], [4, '4 words'], [5, '5 words'], [6, '6 words'], [7, '7 words']]
], [
    'name' => 'ignore_case',
    'label' => 'Ignore letter case',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Treat uppercase and lowercase words as the same.',
    'checked' => true
], [
    'name' => 'strip_html',
    'label' => 'Strip HTML and Markdown',
    'type' => 'checkbox',
    'placeholder' => '',
    'help' => 'Remove common markup before comparing.',
    'checked' => true
]]); ?>
