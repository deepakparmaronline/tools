<?php
return array (
  'slug' => 'emi-calculator',
  'name' => 'EMI Calculator',
  'category' => 'finance',
  'description' => 'Calculate monthly loan EMI, total interest and total repayment from loan amount, annual interest rate and tenure.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Calculate monthly loan EMI, total interest and total repayment from loan amount, annual interest rate and tenure. Use the form above to enter Currency, Loan amount, Annual interest rate (%), Loan tenure. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Loan amount, Annual interest rate (%), Loan tenure.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'Monthly EMI uses the standard amortizing-loan formula: P × r × (1+r)^n ÷ ((1+r)^n − 1), where r is the monthly rate and n is the number of payments.',
  'warning' => 'Financial results are estimates. Rates, taxes, fees and real-world outcomes can differ.',
  'faqs' => 
  array (
    'What does EMI Calculator do?' => 'Calculate monthly loan EMI, total interest and total repayment from loan amount, annual interest rate and tenure.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Loan amount, Annual interest rate (%), Loan tenure.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'BankBazaar EMI Calculator',
      1 => 'Calculator.net Loan Calculator',
    ),
    'observed' => 'Loan amount/principal, annual interest rate and tenure are the core inputs; results commonly show installment, interest and total repayment.',
  ),
);
