<?php
return array (
  'slug' => 'gpa-calculator',
  'name' => 'GPA Calculator',
  'category' => 'education',
  'description' => 'Calculate weighted GPA from course grades and credit hours on a 4.0 scale.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate weighted GPA from course grades and credit hours on a 4.0 scale. Use the form above to enter Courses. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Courses.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Each grade is converted to quality points on the 4.0 scale, multiplied by course credits, then divided by total credits.',
  'warning' => '',
  'faqs' => 
  array (
    'What does GPA Calculator do?' => 'Calculate weighted GPA from course grades and credit hours on a 4.0 scale.',
    'What information do I need?' => 'The form is built around these inputs: Courses.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Calculator.net GPA Calculator',
      1 => 'CollegeSimply GPA Calculator',
    ),
    'observed' => 'Course grade and credit hours are the standard repeated inputs; output is weighted quality points divided by credits.',
  ),
);
