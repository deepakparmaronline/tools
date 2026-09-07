<?php
return array (
  'slug' => 'electrical-power-calculator',
  'name' => 'Electrical Power Calculator',
  'category' => 'engineering',
  'description' => 'Calculate electrical power, current, voltage or energy for a simple DC/single-phase load.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Calculate electrical power, current, voltage or energy for a simple DC/single-phase load. Use the form above to enter Voltage (V), Current (A), Power factor, Runtime (hours). The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Voltage (V), Current (A), Power factor, Runtime (hours).',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'For the simple single-phase estimate, apparent power = V × I and real power = V × I × power factor. Energy = real power × time.',
  'warning' => 'Use appropriate engineering standards, tolerances and safety margins for real hardware or mains-powered systems.',
  'faqs' => 
  array (
    'What does Electrical Power Calculator do?' => 'Calculate electrical power, current, voltage or energy for a simple DC/single-phase load.',
    'What information do I need?' => 'The form is built around these inputs: Voltage (V), Current (A), Power factor, Runtime (hours).',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'RapidTables Electrical Calculators',
      1 => 'Omni Electric Power Calculator',
    ),
    'observed' => 'Voltage and current are common inputs; power factor matters for AC real power, and runtime is useful for an energy estimate.',
  ),
);
