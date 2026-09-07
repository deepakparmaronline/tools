<?php
return array (
  'slug' => 'ai-api-cost-calculator',
  'name' => 'AI API Cost Calculator',
  'category' => 'ai-agents',
  'description' => 'Estimate LLM API cost from your own token prices, token usage and request volume so model pricing never goes stale.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Estimate LLM API cost from your own token prices, token usage and request volume so model pricing never goes stale. Use the form above to enter Input price / 1M tokens ($), Output price / 1M tokens ($), Input tokens / request, Output tokens / request, Requests in period, Cached input (%). The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Input price / 1M tokens ($), Output price / 1M tokens ($), Input tokens / request, Output tokens / request, Requests in period, Cached input (%).',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Cost is calculated separately for normal input, cached input and output tokens using the per-million-token rates you enter, then multiplied by request volume.',
  'warning' => '',
  'faqs' => 
  array (
    'What does AI API Cost Calculator do?' => 'Estimate LLM API cost from your own token prices, token usage and request volume so model pricing never goes stale.',
    'What information do I need?' => 'The form is built around these inputs: Input price / 1M tokens ($), Output price / 1M tokens ($), Input tokens / request, Output tokens / request, Requests in period, Cached input (%).',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Anand Iyer LLM API Cost Calculator',
      1 => 'CloudOps Toolkit LLM API Cost Calculator',
      2 => 'GearBriefly Token Cost Calculator',
    ),
    'observed' => 'Strong current tools avoid relying only on hard-coded model prices. They ask for input/output price per million tokens, tokens per request, request volume and often cache usage.',
  ),
);
