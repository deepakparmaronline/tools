<?php
return array (
  'slug' => 'bmi-calculator',
  'name' => 'BMI Calculator',
  'category' => 'health',
  'description' => 'Calculate body mass index from height and weight and see the standard adult BMI category.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Calculate body mass index from height and weight and see the standard adult BMI category. Use the form above to enter Units, Weight, Height. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Units, Weight, Height.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'BMI = weight in kilograms ÷ height in metres squared. Imperial inputs are converted to the equivalent standard BMI calculation.',
  'warning' => 'This tool provides a general estimate only and is not medical advice, diagnosis or treatment.',
  'faqs' => 
  array (
    'What does BMI Calculator do?' => 'Calculate body mass index from height and weight and see the standard adult BMI category.',
    'What information do I need?' => 'The form is built around these inputs: Units, Weight, Height.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Calculator.net BMI Calculator',
      1 => 'NHLBI BMI tools',
    ),
    'observed' => 'Height and weight are core; reputable tools support metric/imperial units and explain adult BMI categories.',
  ),
);
