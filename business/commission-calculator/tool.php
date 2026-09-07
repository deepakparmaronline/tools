<?php
return array (
  'slug' => 'commission-calculator',
  'name' => 'Commission Calculator',
  'category' => 'business',
  'description' => 'Calculate commission and take-home sales value using a rate plus optional fixed bonus.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate commission and take-home sales value using a rate plus optional fixed bonus. Use the form above to enter Currency, Sales amount, Commission rate (%), Fixed bonus, Base pay for period. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Sales amount, Commission rate (%), Fixed bonus, Base pay for period.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Commission = sales amount × commission rate + fixed bonus. Optional base pay is added to show total pay for the period.',
  'warning' => '',
  'faqs' => 
  array (
    'What does Commission Calculator do?' => 'Calculate commission and take-home sales value using a rate plus optional fixed bonus.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Sales amount, Commission rate (%), Fixed bonus, Base pay for period.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Omni Commission Calculator',
      1 => 'CalculatorSoup Commission Calculator',
    ),
    'observed' => 'Sales amount and commission rate are core; optional fixed bonus/base pay makes the result more practical.',
  ),
);
