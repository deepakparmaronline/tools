<?php
return array (
  'slug' => 'token-estimator',
  'name' => 'Token Estimator',
  'category' => 'ai-agents',
  'description' => 'Estimate token count from pasted text using character and word heuristics, with a clear reminder that exact counts depend on the model tokenizer.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Estimate token count from pasted text using character and word heuristics, with a clear reminder that exact counts depend on the model tokenizer. Use the form above to enter Prompt / document text, Estimate method. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Prompt / document text, Estimate method.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => '',
  'warning' => '',
  'faqs' => 
  array (
    'What does Token Estimator do?' => 'Estimate token count from pasted text using character and word heuristics, with a clear reminder that exact counts depend on the model tokenizer.',
    'What information do I need?' => 'The form is built around these inputs: Prompt / document text, Estimate method.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'OpenAI Tokenizer-style counters',
      1 => 'GearBriefly LLM token cost tools',
    ),
    'observed' => 'Text input, model/tokenizer context and counts are expected. This offline estimator deliberately labels results as approximate instead of pretending to match every tokenizer.',
  ),
);
