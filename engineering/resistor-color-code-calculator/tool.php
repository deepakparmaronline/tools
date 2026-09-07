<?php
return array (
  'slug' => 'resistor-color-code-calculator',
  'name' => 'Resistor Color Code Calculator',
  'category' => 'engineering',
  'description' => 'Decode common 4-band and 5-band resistor colors into resistance and tolerance.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Decode common 4-band and 5-band resistor colors into resistance and tolerance. Use the form above to enter Band count, Band 1, Band 2, Band 3 (5-band only), Multiplier, Tolerance. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Band count, Band 1, Band 2, Band 3 (5-band only), Multiplier, Tolerance.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Color bands map significant digits and a power-of-ten multiplier to resistance, with the tolerance band defining the expected resistance range.',
  'warning' => 'Use appropriate engineering standards, tolerances and safety margins for real hardware or mains-powered systems.',
  'faqs' => 
  array (
    'What does Resistor Color Code Calculator do?' => 'Decode common 4-band and 5-band resistor colors into resistance and tolerance.',
    'What information do I need?' => 'The form is built around these inputs: Band count, Band 1, Band 2, Band 3 (5-band only), Multiplier, Tolerance.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Eng Bench Resistor Colour Code Calculator',
      1 => 'Pearson Resistor Color Code Calculator',
      2 => 'Reuven Engineering Tools',
    ),
    'observed' => 'Band count (4/5/6), color selections, tolerance and sometimes reverse encoding are standard. This launch version focuses on reliable 4/5-band decoding.',
  ),
);
