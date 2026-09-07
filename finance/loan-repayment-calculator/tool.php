<?php
return array (
  'slug' => 'loan-repayment-calculator',
  'name' => 'Loan Repayment Calculator',
  'category' => 'finance',
  'description' => 'Estimate scheduled loan payments and see how an optional extra monthly payment changes payoff time and interest.',
  'status' => 'published',
  'popular' => false,
  'about' => 'Estimate scheduled loan payments and see how an optional extra monthly payment changes payoff time and interest. Use the form above to enter Currency, Loan amount, Annual interest rate (%), Original term (months), Extra payment per month. The calculation or transformation runs locally in your browser.',
  'guide' => 
  array (
    0 => 'Enter Currency, Loan amount, Annual interest rate (%), Original term (months), Extra payment per month.',
    1 => 'Choose the options that match your task and leave genuinely optional fields blank when they do not apply.',
    2 => 'Select Calculate / Run and review the result panel.',
    3 => 'Check units, assumptions and any limitations shown on the page before using the result for an important decision.',
  ),
  'formula' => 'The scheduled payment uses the amortizing-loan formula. The payoff simulation then applies interest and any extra payment month by month until the balance reaches zero.',
  'warning' => 'Financial results are estimates. Rates, taxes, fees and real-world outcomes can differ.',
  'faqs' => 
  array (
    'What does Loan Repayment Calculator do?' => 'Estimate scheduled loan payments and see how an optional extra monthly payment changes payoff time and interest.',
    'What information do I need?' => 'The form is built around these inputs: Currency, Loan amount, Annual interest rate (%), Original term (months), Extra payment per month.',
    'Does my input get uploaded?' => 'For this tool, the calculation or transformation runs in your browser. Your entered values are not intentionally sent to ToolboxKart for processing.',
    'Is this tool free to use?' => 'Yes. You can use this ToolboxKart tool without creating an account.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Calculator.net Loan Calculator',
      1 => 'Bankrate Loan Calculator',
    ),
    'observed' => 'Principal, interest rate and term are core inputs; extra monthly payment is a common enhancement for payoff analysis.',
  ),
);
