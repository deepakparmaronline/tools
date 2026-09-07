<?php
return array (
  'slug' => 'grade-calculator',
  'name' => 'Grade Calculator',
  'category' => 'education',
  'description' => 'Calculate a weighted course grade from assignment scores and weights, or estimate the score needed on a final item.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate a weighted course grade from assignment scores and weights, or estimate the score needed on a final item. Use the form above to enter Graded items, Remaining weight (%), Target course grade (%). The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Graded items, Remaining weight (%), Target course grade (%).',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Weighted points equal each score multiplied by its weight. The remaining-score estimate solves the same weighted-average equation backward from the target grade.',
  'warning' => '',
  'faqs' => 
  array (
    'What does Grade Calculator do?' => 'Calculate a weighted course grade from assignment scores and weights, or estimate the score needed on a final item.',
    'What information do I need?' => 'The form is built around these inputs: Graded items, Remaining weight (%), Target course grade (%).',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Calculator.net Grade Calculator',
      1 => 'RapidTables Grade Calculator',
    ),
    'observed' => 'Assignment score and weight pairs are standard; many tools also solve the grade required on a final exam or remaining weighted item.',
  ),
);
