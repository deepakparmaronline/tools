<?php
return array (
  'slug' => 'markup-calculator',
  'name' => 'Markup Calculator',
  'category' => 'business',
  'description' => 'Apply a markup to cost and see the resulting selling price, profit and gross margin.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Apply a markup to cost and see the resulting selling price, profit and gross margin. Use the form above to enter Currency, Cost, Markup (%), Units. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Cost, Markup (%), Units.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Selling price = cost × (1 + markup/100). Gross margin is then profit divided by selling price.',
  'warning' => '',
  'faqs' => 
  array (
    'What does Markup Calculator do?' => 'Apply a markup to cost and see the resulting selling price, profit and gross margin.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Cost, Markup (%), Units.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'ToolBark Markup Calculator',
      1 => 'ORMGuru Product Markup Calculator',
    ),
    'observed' => 'Cost and markup percent are the main inputs; leading tools also show resulting margin, profit and optional unit totals.',
  ),
);
