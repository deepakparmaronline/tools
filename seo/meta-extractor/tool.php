<?php
return array (
  'slug' => 'meta-extractor',
  'name' => 'Meta Extractor',
  'category' => 'seo',
  'description' => 'Extract title, meta tags, canonical, Open Graph, Twitter Card and heading data from pasted HTML source.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Inspect the metadata returned in HTML source without sending the source to ToolboxKart. The extractor reads the document head and reports title, description, robots, canonical, Open Graph, Twitter Card, viewport, charset and other meta tags, plus page headings.',
  'guide' => 
  array (
    0 => 'Copy the HTML source of the page you want to inspect and paste it into the editor.',
    1 => 'Select Extract Meta Data and review the summary, metadata table and heading list.',
    2 => 'Use the copy report action when you need a plain-text audit for a ticket, migration or SEO review.',
    3 => 'If the page is JavaScript-rendered, compare the supplied source with the rendered DOM because this browser-only extractor analyzes only the HTML you provide.',
  ),
  'formula' => '',
  'warning' => 'This tool does not fetch URLs. It analyzes the HTML source you paste, so it cannot confirm what a live server returns or what a crawler receives.',
  'faqs' => 
  array (
    'What does Meta Extractor check?' => 'It extracts the page title, meta description, robots, canonical URL, viewport, charset, Open Graph tags, Twitter Card tags, other meta tags and headings found in the supplied HTML.',
    'Can I enter a URL instead of HTML?' => 'No. This version intentionally analyzes pasted HTML locally in your browser rather than fetching arbitrary URLs from the server.',
    'Does the HTML leave my browser?' => 'No. The extraction runs in your browser and the pasted source is not intentionally uploaded to ToolboxKart for processing.',
    'Does it validate SEO tags?' => 'It extracts and organizes metadata for inspection. It does not guarantee that a tag is correct, eligible for a search feature or used by a particular crawler.',
    'Can it inspect Open Graph and Twitter Card tags?' => 'Yes. It lists matching property or name attributes and their content values.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Zero Snippet Meta Tags Extractor',
      1 => 'Content Powered Meta Tag Extractor',
      2 => 'Encode64 HTML Meta Tag Extractor',
    ),
    'observed' => 'Current extractors commonly focus on title, description, canonical, robots, Open Graph and Twitter metadata. Some fetch URLs server-side, while browser-only tools accept pasted HTML; this implementation uses the safer local HTML workflow.',
  ),
);
