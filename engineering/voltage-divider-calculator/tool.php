<?php
return array (
  'slug' => 'voltage-divider-calculator',
  'name' => 'Voltage Divider Calculator',
  'category' => 'engineering',
  'description' => 'Calculate unloaded or loaded resistor-divider output voltage and branch current.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate unloaded or loaded resistor-divider output voltage and branch current. Use the form above to enter Input voltage (V), R1 (Ω), R2 (Ω), Load resistance (Ω). The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Input voltage (V), R1 (Ω), R2 (Ω), Load resistance (Ω).',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Unloaded output is Vin × R2 ÷ (R1 + R2). If a load is entered, the tool first combines that load in parallel with R2.',
  'warning' => 'Use appropriate engineering standards, tolerances and safety margins for real hardware or mains-powered systems.',
  'faqs' => 
  array (
    'What does Voltage Divider Calculator do?' => 'Calculate unloaded or loaded resistor-divider output voltage and branch current.',
    'What information do I need?' => 'The form is built around these inputs: Input voltage (V), R1 (Ω), R2 (Ω), Load resistance (Ω).',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'DigiKey Voltage Divider Calculator',
      1 => 'Omni Voltage Divider Calculator',
    ),
    'observed' => 'Vin, R1 and R2 are core; adding optional load resistance makes the calculator more realistic because a connected load changes the lower leg.',
  ),
);
