<?php
return array (
  'slug' => 'roi-calculator',
  'name' => 'ROI Calculator',
  'category' => 'finance',
  'description' => 'Calculate return on investment, gain or loss, and annualized ROI for a chosen holding period.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate return on investment, gain or loss, and annualized ROI for a chosen holding period. Use the form above to enter Currency, Amount invested, Final value / amount returned, Holding period (years). The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Amount invested, Final value / amount returned, Holding period (years).',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'ROI = (final value − amount invested) ÷ amount invested × 100. Annualized ROI uses the holding period to express an equivalent yearly rate.',
  'warning' => 'Financial results are estimates. Rates, taxes, fees and real-world outcomes can differ.',
  'faqs' => 
  array (
    'What does ROI Calculator do?' => 'Calculate return on investment, gain or loss, and annualized ROI for a chosen holding period.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Amount invested, Final value / amount returned, Holding period (years).',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Calculator.net ROI Calculator',
      1 => 'Omni ROI Calculator',
    ),
    'observed' => 'Initial amount and final return are the core inputs; period is commonly used for annualized return.',
  ),
);
