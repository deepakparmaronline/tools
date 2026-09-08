<?php
return array (
  'slug' => 'duplicate-content-finder',
  'name' => 'Duplicate Content Finder',
  'category' => 'seo',
  'description' => 'Compare two content blocks for exact sentence matches, shared phrases and near-duplicate wording.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Compare two pieces of content in your browser and see how much wording they share. The tool reports word counts, phrase overlap, exact sentence matches and the strongest shared passages so you can review likely duplication.',
  'guide' => 
  array (
    0 => 'Paste the first content block and the second content block into the two editors.',
    1 => 'Choose a phrase size. Five-word phrases are the default balance between useful overlap and accidental matches.',
    2 => 'Run the comparison to review the similarity score, matched phrases and exact sentence matches.',
    3 => 'Use the result as a content-review signal, not as a Google ranking or penalty prediction.',
  ),
  'formula' => 'Phrase similarity uses Jaccard similarity: shared unique n-grams divided by the union of unique n-grams from both texts. Sentence matches are counted separately.',
  'warning' => 'This tool compares only the two text blocks you provide. It does not search the web, crawl URLs or determine how Google will canonicalize or rank pages.',
  'faqs' => 
  array (
    'What does Duplicate Content Finder detect?' => 'It compares two texts for shared word phrases and exact sentence matches and reports the overlap between them.',
    'Does it check live URLs?' => 'No. This version analyzes pasted text locally in your browser and does not fetch pages from the web.',
    'How is the similarity score calculated?' => 'The score uses Jaccard similarity over normalized word n-grams. A value of 100% means both texts have the same set of n-grams under the selected settings; it is not a Google duplicate-content threshold.',
    'What phrase size should I use?' => 'Five-word phrases are a practical default. Smaller phrases find more overlap but also more common language; larger phrases are stricter.',
    'Does duplicate content always cause a Google penalty?' => 'No. Google explains that duplicate or very similar pages can be clustered and a canonical version selected. Duplicate content itself is not automatically a spam penalty.',
  ),
  'research' => 
  array (
    'rivals' => 
    array (
      0 => 'Slogan.website Duplicate Content Checker',
      1 => 'RunTheTests Duplicate Content Comparer',
      2 => 'Wild Creek Web Studio Duplicate Content Checker',
    ),
    'observed' => 'Current browser-side tools commonly compare two text blocks, show a similarity score and expose evidence such as shared phrases or matching sentences. URL-crawling tools add convenience but require server-side fetching. ToolboxKart uses the local text workflow for privacy and simpler security boundaries.',
  ),
);
