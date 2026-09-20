# ToolboxKart AI Category Tool Packaging Prompt

Copy this entire prompt into an AI coding agent after attaching the current ToolboxKart site ZIP.

---

You are extending the attached ToolboxKart PHP website. The attached ZIP is the source of truth for the existing architecture, templates, CSS, JavaScript, routing, catalog, SEO rules, and security rules.

## Main request

Create the requested new tools and package them for import into the existing site.

I will attach the existing ToolboxKart site ZIP for inspection. Do not rebuild the website, redesign the website, or return a replacement ZIP of the entire site. Do not include the existing site files in your output packages unless a specific new file is required by the category package contract below.

Return one separate ZIP file for each tool category/niche. For example:

- `seo-tools.zip`
- `marketing-tools.zip`
- `finance-tools.zip`
- `healthcare-tools.zip`
- `developer-tools.zip`
- `productivity-tools.zip`
- `manufacturing-tools.zip`
- `photography-video-tools.zip`
- `printing-packaging-tools.zip`
- `real-estate-tools.zip`
- `sales-business-development-tools.zip`
- `science-labs-tools.zip`
- `solar-energy-tools.zip`
- `telecom-networking-tools.zip`

If only one category was requested, return only that category ZIP. If multiple categories were requested, return one ZIP per category. Never combine all categories into one ZIP.

## Before creating code

1. Inspect the attached ZIP before editing or generating anything.
2. Read these files if they exist:
   - `/TOOLBOXKART-AI-AGENT-REFERENCE-PACK.md`
   - `/TOOLBOXKART-AI-CATEGORY-TOOL-PACKAGING-PROMPT.md`
   - `/README.md`
   - `/docs/README.md`
   - `/docs/AI-SITE-RULES.md`
   - `/data/catalog.php`
   - `/includes/bootstrap.php`
   - `/includes/functions.php`
   - `/includes/tool-template.php`
   - `/includes/category-template.php`
   - `/router.php`
   - `/.htaccess`
3. Identify the existing PHP version, public URL pattern, category keys, catalog structure, template variables, CSS classes, JavaScript conventions, and validation commands.
4. Never invent a new framework, CMS, database, package manager, design system, or routing system when the attached site already provides one.
5. Ask a concise clarification only when the requested category, tool behavior, safety boundary, or import destination cannot be determined from the request and ZIP.

Before importing a generated package, compare every package category and filename with the existing site. Add only new files to an existing category, move entirely new category directories to the site root, and never overwrite a collision. If a filename or slug collides, inspect both versions and preserve the existing site file unless the owner explicitly authorizes replacement. Merge category metadata and tool records into the existing `/data/catalog.php`; never replace it with a fragment. Remove package fragments only after the imported files, catalog load, duplicate-slug check, and PHP syntax checks pass.

## Category and tool rules

A category is defined in the existing `/data/catalog.php` source of truth. Use a lowercase hyphenated category key, a clear human-readable category name, a short icon compatible with the existing catalog, and a factual introduction.

Use this category format:

```php
'seo'=>[
    'name'=>'SEO',
    'description'=>'Technical and on-page SEO utilities for snippets, metadata, crawl directives and content analysis.',
    'icon'=>'⌕',
],
```

Every new tool must have a catalog record with:

```php
[
    'category'=>'seo',
    'slug'=>'descriptive-tool-slug',
    'name'=>'Primary Search Phrase Tool',
    'description'=>'A clear, human description of what the tool does and who it helps.',
    'featured'=>false,
]
```

The catalog `name` must be a natural SEO-focused H1 and the primary phrase a person would use when searching for the tool. Use specific phrases such as `SERP Preview Tool`, `Loan EMI Calculator`, or `JSON Formatter & Validator`. Do not keyword-stuff, make awkward H1s, or claim unsupported search volume.

Use the existing shared tool template. Every tool page must provide the variables expected by the existing template, normally `$tool`, `$toolBody`, `$toolContent`, and `$faqs`, and must load `/includes/tool-template.php` using the site's existing pattern.

## Required tool page experience

Each tool must include:

- A working interface near the top of the page.
- Clear visible labels, useful defaults, validation, reset behavior, and copy behavior where relevant.
- Original human-written content after the tool interface.
- Content explaining what the tool does, how to use it, inputs and outputs, formula or method, examples, interpretation, assumptions, limitations, and practical use cases.
- Useful H2 sections that support real user questions without keyword stuffing.
- Exactly 3–5 specific FAQs based on real user intent. FAQ answers must be visible, accurate, useful, and consistent with the page content.
- The shared page title, H1, breadcrumbs, canonical URL, WebApplication schema, BreadcrumbList schema, and FAQPage schema.
- Related tools rendered by the shared related-tools behavior. Related tools must come only from the same category key as the current tool. Never manually add a related tool from another niche.
- Browser-local processing whenever practical. Never expose credentials, API keys, private data, or PHI.

Healthcare tools must remain administrative Revenue Cycle Management utilities using aggregate data only. Finance tools must disclose assumptions and must not present estimates as financial advice. Follow every safety rule in the attached site documentation.

## ZIP package contract

Create a separate ZIP for each requested category. Each category ZIP must contain only the new or changed files needed to import that category into the existing site, with this structure:

```text
seo-tools.zip
├── seo/
│   ├── new-tool-one.php
│   ├── new-tool-two.php
│   └── ...
├── data/
│   └── catalog-seo.php
└── IMPORT-INSTRUCTIONS.md
```

Package rules:

- The category directory must use the exact catalog category key, such as `seo/`.
- Put each tool page directly inside that category directory.
- Do not include the entire existing site, shared CSS, shared JavaScript, headers, footers, templates, vendor folders, cache folders, `.git`, credentials, environment files, or unrelated categories.
- Do not include a manual category `index.php` when the attached site uses the automatic category router. State this in `IMPORT-INSTRUCTIONS.md`.
- Include `data/catalog-<category-key>.php` as an import manifest containing the category metadata and the new tool records. Make it safe to inspect and merge; do not overwrite the site's complete `/data/catalog.php`.
- If the existing site uses a different catalog fragment convention, follow that convention and explain it in `IMPORT-INSTRUCTIONS.md`.
- Include `IMPORT-INSTRUCTIONS.md` with exact destination paths, catalog merge instructions, required category key, tool URLs, validation commands, and any assumptions.
- Never silently modify shared files inside the package. If a shared-file change is truly required, list it clearly in the import instructions and explain why.
- Use relative paths that can be copied into the existing site root.
- Do not place nested ZIP files inside a category ZIP.

The import manifest should make the requested merge obvious. For example:

```php
<?php
return [
    'category'=>[
        'key'=>'seo',
        'name'=>'SEO',
        'description'=>'Technical and on-page SEO utilities for snippets, metadata, crawl directives and content analysis.',
        'icon'=>'⌕',
    ],
    'tools'=>[
        [
            'category'=>'seo',
            'slug'=>'new-tool-one',
            'name'=>'New Tool One',
            'description'=>'...',
            'featured'=>false,
        ],
    ],
];
```

## Validation before delivery

Before returning any category ZIP:

1. Run PHP syntax checks on every PHP file in the package.
2. Confirm every tool file uses the existing bootstrap and shared template correctly.
3. Confirm every catalog record points to an existing tool file and uses the exact category key.
4. Confirm every slug is unique within the category and does not collide with an existing site tool.
5. Confirm H1/title phrases, descriptions, canonical paths, breadcrumbs, FAQs, and same-category related-tool links.
6. Test normal, empty, zero, negative, very large, malformed, and boundary inputs where relevant.
7. Check that no secret, credential, PHI, tracking key, generated cache, or unrelated site file is included.
8. Confirm each ZIP can be extracted directly into the existing site root without overwriting unrelated files.
9. Report the exact ZIP filenames, contained files, tool URLs, test commands, and any manual catalog merge step.
10. If the package is imported later, verify category/file collisions and merge the catalog into the existing source of truth before deleting any package fragments.

## Final response format

Return:

- One download link or file for each category ZIP.
- A short list of tools inside each ZIP.
- The exact catalog merge step for each ZIP.
- Validation results.
- Any assumptions or blockers.

Do not return a full replacement website ZIP. Do not claim deployment or GitHub changes unless explicitly requested and actually completed.
