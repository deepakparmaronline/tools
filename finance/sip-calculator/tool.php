<?php
return array (
  'slug' => 'sip-calculator',
  'name' => 'SIP Calculator',
  'category' => 'finance',
  'description' => 'Estimate the future value of regular investments and separate the amount invested from estimated growth.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Estimate the future value of regular investments and separate the amount invested from estimated growth. Use the form above to enter Currency, Investment per contribution, Expected annual return (%), Time period (years), Contribution frequency. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Investment per contribution, Expected annual return (%), Time period (years), Contribution frequency.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'The estimate compounds the assumed annual return at the selected contribution frequency and adds each regular contribution to the future-value series.',
  'warning' => 'Financial results are estimates. Rates, taxes, fees and real-world outcomes can differ.',
  'faqs' => 
  array (
    'What does SIP Calculator do?' => 'Estimate the future value of regular investments and separate the amount invested from estimated growth.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Investment per contribution, Expected annual return (%), Time period (years), Contribution frequency.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'NISM SIP Calculator',
      1 => 'Zerodha SIP Calculator',
    ),
    'observed' => 'Common inputs are periodic investment, expected return and time; leading tools also support contribution frequency and split invested amount from returns.',
  ),
);
