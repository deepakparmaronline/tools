<?php
return array (
  'slug' => 'gst-calculator',
  'name' => 'GST Calculator',
  'category' => 'finance',
  'description' => 'Add or remove GST from an amount and see the tax component clearly.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Add or remove GST from an amount and see the tax component clearly. Use the form above to enter Currency, Amount, GST rate (%), Calculation. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Amount, GST rate (%), Calculation.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Adding GST uses tax = base × rate. Removing included GST uses base = inclusive amount ÷ (1 + rate).',
  'warning' => 'Financial results are estimates. Rates, taxes, fees and real-world outcomes can differ.',
  'faqs' => 
  array (
    'What does GST Calculator do?' => 'Add or remove GST from an amount and see the tax component clearly.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Amount, GST rate (%), Calculation.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'ClearTax GST Calculator',
      1 => 'Zoho GST Calculator',
    ),
    'observed' => 'Amount, GST rate and inclusive/exclusive mode are the expected inputs.',
  ),
);
