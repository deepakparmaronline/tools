<?php
return [
  'slug' => 'search-console-regex-generator',
  'name' => 'Search Console Regex Generator',
  'category' => 'seo',
  'description' => 'Generate RE2-compatible regular expressions for Google Search Console query and page filters from your keywords or values.',
  'status' => 'published',
  'popular' => true,
  'about' => 'Build a copy-ready Google Search Console regex from a list of keywords, phrases, URLs or other values. The tool supports contains, exact, starts-with and ends-with matching, with optional grouping and case-sensitive matching.',
  'guide' => [
    'Enter one keyword, phrase, URL or value per line. You can also separate values with commas.',
    'Choose Query or Page and select how each value should match.',
    'Generate the pattern and review it before copying it into Search Console.',
    'In Google Search Console, open Performance, add a Query or Page filter, choose Custom (regex), then paste the pattern. Use Does not match regex when you want to exclude the generated values.'
  ],
  'formula' => 'For multiple values, the tool escapes regex metacharacters and joins the values with the RE2 alternation operator |. Exact, starts-with and ends-with modes add the appropriate anchors. Google Search Console uses RE2 and partial matching by default.',
  'warning' => 'Search Console uses RE2, not every feature available in PCRE or JavaScript. Lookarounds and backreferences are not valid choices for this generator. Page filters are case-sensitive in Search Console, while Query filters are case-insensitive.',
  'faqs' => [
    'What regex syntax does Google Search Console use?' => 'Google Search Console uses RE2 regular expression syntax. Its Custom (regex) filters use partial matching by default.',
    'Can I use this for both queries and pages?' => 'Yes. Choose Query for search queries or Page for URLs before generating the pattern.',
    'How do I create an exclude filter?' => 'Generate the values you want to exclude, then choose Does not match regex in the Search Console filter.',
    'Does this tool support negative lookahead?' => 'No. Google Search Console uses RE2, which does not support lookaround expressions such as negative lookahead.',
    'Does my data get uploaded?' => 'No. The regex generation runs in your browser. Your entered keywords, phrases and URLs are not intentionally sent to ToolboxKart for processing.',
    'Is the tool free?' => 'Yes. You can use the Search Console Regex Generator without an account or signup.'
  ],
  'research' => [
    'rivals' => [
      'MagsTags GSC Regex Generator',
      'Envision Marketing GSC Regex Generator',
      'KairoxBuild GSC Regex Builder & Tester'
    ],
    'observed' => 'Current tools commonly support keyword/value lists, include or exact matching, query/page context, copyable output and optional local testing. Google documents RE2 syntax, partial matching by default, and Matches regex or Does not match regex in Search Console.'
  ],
];
