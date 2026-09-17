# ToolboxKart AI / Developer Site Rules

This file is the source of truth for anyone—human or AI—adding a tool, category, article, script, or UI component to ToolboxKart. The goal is to scale the library without breaking the theme, URLs, accessibility, SEO structure, or existing tools.

## 1. Non-negotiable architecture

- Production stack: PHP 8+, Apache `.htaccess`, vanilla JavaScript, shared CSS. Do not introduce a framework, CMS, jQuery, package manager, or database just to add a simple tool.
- Every tool has exactly one page file: `/<category>/<tool-slug>.php`.
- Public canonical tool URL never includes `.php`: `https://toolboxkart.tech/<category>/<tool-slug>`.
- Blog file: `/blog/<post-slug>.php`; canonical URL: `https://toolboxkart.tech/blog/<post-slug>`.
- Header and footer are shared in `/includes/header.php` and `/includes/footer.php`. Never copy them into a tool or post.
- Global UI lives in `/assets/css/app.css` and `/assets/js/app.js`. Do not duplicate the global theme inside individual pages.
- Tool/category discovery comes from `/data/catalog.php`. Blog discovery comes from `/data/posts.php`.
- Reusable rendering is in `/includes/tool-template.php`, `/includes/category-template.php`, and `/includes/blog-template.php`.
- `/includes`, `/data`, and `/docs` are intentionally blocked from direct public browsing by `.htaccess`.

## 1A. Categories / niches — automatic workflow

Tool niches are defined only in `/data/catalog.php`. Do not maintain a second category list in a page, menu, sitemap, or stylesheet.

Each category record must use this shape:

```php
'seo'=>[
  'name'=>'SEO',
  'description'=>'Technical and on-page SEO utilities for snippets, metadata, crawl directives and content analysis.',
  'icon'=>'⌕',
],
```

The `name` is the visible category title. The `description` is the category introduction. Category pages append this standard sentence:

```text
Every tool is designed to expose its inputs and outputs clearly instead of hiding the logic behind a vague score.
```

The rendered category page therefore follows this content pattern:

```text
# SEO tools built for real work
Technical and on-page SEO utilities for snippets, metadata, crawl directives and content analysis. Every tool is designed to expose its inputs and outputs clearly instead of hiding the logic behind a vague score.
```

To create a new niche:

1. Add one top-level category record to `/data/catalog.php` with a lowercase hyphenated key, human-readable `name`, useful `description`, and short `icon`.
2. Add each tool under that niche to the `tools` array with the exact same `category` key, unique `slug`, `name`, `description`, and `featured` value.
3. Do not create a manual category page. `/router.php` automatically sends any catalog-defined category URL such as `/<new-category>/` to `/includes/category-template.php`.
4. The shared category template automatically creates the category title, introduction, tool grid, breadcrumbs, canonical URL, ItemList schema, and supporting sections.
5. The Browse Tools by Niche page, home category section, and sitemap automatically discover the new category through `tool_categories()`.

The shared helper is `tool_categories()` in `/includes/functions.php`. It is the only approved way for PHP pages to enumerate tool niches. Never replace it with a hardcoded list such as `['seo','marketing',...]`.

### Category URL and AI verification rules

- Public category URL: `https://toolboxkart.tech/<category>/`.
- Local routed URL: `http://127.0.0.1:8765/<category>/` when started with `php -S 127.0.0.1:8765 router.php`.
- New categories do not need a directory or `index.php`; the shared router and Apache fallback serve them automatically.
- Never use `.php` in public category links or canonical URLs.
- Run `php -l` on every changed PHP file, then verify the browse page, home page, new category page, tool links, sitemap, canonical URL, title, H1, intro, breadcrumbs, and mobile layout.
- Before any AI edit, read `/TOOLBOXKART-AI-AGENT-REFERENCE-PACK.md`, this file, `/README.md`, `/docs/README.md`, `/data/catalog.php`, `/includes/functions.php`, `/includes/category-template.php`, `/router.php`, and `.htaccess`.

## 2. Design system: do not freelance a new theme

Use the existing CSS variables. Do not hard-code random brand colors per tool.

Light theme core tokens:
- Background: `#f7f9fc`
- Surface: `#ffffff`
- Primary text: `#0b1220`
- Muted text: `#5d6b7e`
- Border: `#dbe4ef`
- Primary blue: `#2563eb`
- Teal accent: `#0f9f8f`
- Success: `#0f9f6e`
- Warning: `#b7791f`
- Danger: `#c2414a`
- Main content width: 1180px
- Large card radius: 20–24px; regular cards: 12–18px

Rules:
- Use system fonts; do not add a remote font dependency without a measured reason.
- Tool UI appears before long explanatory copy.
- Keep visible labels on form controls. Placeholders do not replace labels.
- Mobile width must work at 360px without horizontal page overflow.
- Buttons use `.btn`, `.btn-primary`, `.btn-secondary`.
- Inputs use `.field`; outputs use `.result-box`, `.metric`, `.data-table` as appropriate.
- Use `.notice` for assumptions, privacy notes, safety caveats and non-error guidance.
- Never use color alone to communicate an error or success state.

## 3. Adding a new tool — required sequence

1. Choose the correct existing category. Create a new category only if at least several meaningful tools belong in it.
2. Add one tool record to `/data/catalog.php` with `category`, `slug`, `name`, `description`, `featured`.
3. Create `/<category>/<slug>.php`.
4. Start with:
   - `require __DIR__.'/../includes/bootstrap.php';`
   - `$tool=tool_by_path('<category>','<slug>');`
   - buffer `$toolBody`, then buffer `$toolContent`
   - define `$faqs`
   - load `/includes/tool-template.php`
5. Choose the catalog `name` as the primary user search phrase and write a natural SEO-focused H1 through the shared template. Keep wording readable; do not keyword-stuff.
6. Write `$toolContent` for the human reader after the interface. Include useful explanations, steps, examples, assumptions, limitations, and interpretation specific to the tool.
7. Define 3–5 specific `$faqs` with answers supported by the visible `$toolContent`; never add generic or unsupported FAQs.
8. Keep tool-specific JavaScript inside that tool file unless the exact behavior is reused by multiple tools; shared behavior belongs in `/assets/js/app.js`.
9. Use the shared related-tools block. It must list only tools whose catalog `category` equals the current tool category.
10. Add the canonical URL to `/sitemap.xml`.
11. Test default values, empty values, zero, negative values where applicable, very large inputs, malformed text, and copy/reset behavior.
12. Run `php -l` on every PHP file and perform a mobile/desktop rendering check.

## 4. Required tool-page SEO/content structure

Every indexable tool page must have:
- One unique, search-intent-focused H1: the tool name must contain the primary phrase people would use to find that utility, for example `SERP Preview Tool`, `Loan EMI Calculator`, or `JSON Formatter & Validator`. Do not force awkward keyword variations or make unsupported search-volume claims.
- Unique title and meta description from the catalog/tool configuration. The catalog `name` is the primary H1/title keyword phrase; the catalog `description` must explain the practical use case in natural language.
- Self-referencing canonical URL.
- Breadcrumbs.
- Working tool UI near the top.
- Human-written, original content after the tool interface. `$toolContent` must explain the tool's purpose, inputs, outputs, formula or method, interpretation, practical use cases, limitations, and assumptions in clear language. It must help a person complete a task; do not write filler paragraphs or repeat the description to add length.
- At least these visible content sections using useful, non-keyword-stuffed H2s:
  - what the tool does / formula / concept,
  - how to use it,
  - important assumptions or interpretation,
  - FAQs.
- A visible FAQ section on every tool page with 3–5 useful, human questions and direct answers. Questions must reflect real user intent around using, interpreting, or troubleshooting that tool. Answers must match visible page content, must not invent guarantees, and must be included in the shared `FAQPage` schema.
- `WebApplication`, `BreadcrumbList`, and `FAQPage` JSON-LD from the shared template.
- A related-tools block below the tool interface/content. It must use `get_related_tools($tool['category'], $tool['slug'])` or an equivalent category-filtered helper so every related link belongs to the current niche only. Never recommend tools from another category in this block.
- Internal links only when they genuinely help the user; related tools must be relevant and must not be keyword-stuffed.
- Original content. Never copy rival explanations, examples, FAQs or visual design.

The shared `/includes/tool-template.php` already renders the catalog name as the H1, places `$toolContent` after the tool UI, renders `$faqs` visibly and as FAQ schema, and renders same-category related tools from `get_related_tools()`. New tools must supply those variables instead of bypassing the template.

Do not promise rankings, rich results, deliverability, medical outcomes, profit, revenue or other results that the tool cannot guarantee. FAQ structured data describes visible content; it does not guarantee a rich result.

## 5. Tool UX rules

- Show the user exactly what inputs drive the result.
- Expose important formulas or assumptions below the tool.
- Avoid unexplained 0–100 “AI scores.” If a score is genuinely necessary, document every component and weight.
- Validate impossible combinations instead of silently producing nonsense.
- Never show `Infinity`, `NaN`, or a fabricated zero when division is undefined; show an explanatory unavailable state.
- Include copy buttons when output is intended to be reused.
- Prefer instant local computation for calculators, counters, formatters and generators.
- Do not require registration for a simple utility without a clear product reason.
- Do not add popups, interstitials or advertising that obstructs the primary task.

## 6. Healthcare rules

Current Healthcare tools are **administrative Revenue Cycle Management utilities**, not clinical tools.

- Do not ask for patient names, DOB, MRN, member IDs, claim numbers, diagnoses or any PHI.
- Inputs must be aggregate operational numbers.
- Include a visible no-PHI reminder on RCM calculators.
- Do not add symptom checkers, diagnosis, dosage, treatment recommendations, medical-device interpretation or other clinical decision tools under this simple template. Those require a separate safety and evidence review.
- Do not imply a billing metric is clinical advice.
- Distinguish billed charges from allowed amounts, expected reimbursement, collections and financial loss.

## 7. Finance rules

- State the formula and assumptions.
- Label outputs as estimates/scenarios where contractual or real-world results can differ.
- Do not present calculator output as investment, tax, lending or accounting advice.
- Never imply an assumed investment return is a forecast.
- Handle zero-interest and zero-denominator cases explicitly.
- Explain exclusions such as fees, taxes, insurance, overhead or variable rates where material.

## 8. Privacy, security and backend rules

- Process in the browser when the job can be safely completed in browser JavaScript.
- Never place API secrets, private keys or provider credentials in client-side code or in this ZIP.
- Escape any server-rendered user-controlled value with `e()`.
- If a future tool needs a server/API call: validate inputs server-side, restrict size, set timeouts, rate-limit abuse, handle failures, and document whether data is sent to a third party.
- Update `/privacy.php` before adding analytics, ads, accounts, forms, persistent storage, payment systems or third-party tracking.
- Keep dependencies minimal and vetted.

## 9. Adding a blog post

1. Copy `/blog/_POST-TEMPLATE.php.example` to `/blog/<slug>.php`.
2. Add matching metadata to `/data/posts.php` with `slug`, `title`, `description`, `category`, `date` (`YYYY-MM-DD`) and `read_time`.
3. Keep author as `Deepak Parmar` unless ownership intentionally changes site-wide.
4. Use one introductory paragraph followed by descriptive H2 sections. H2s generate the table of contents automatically.
5. The shared template automatically adds author, published date, read time, About Author, Latest Posts, Recent Posts, BlogPosting schema and breadcrumbs.
6. Link to relevant tools naturally; do not force links into unrelated paragraphs.
7. Add the canonical post URL to `/sitemap.xml`.
8. Use a real publication date; never invent “updated” dates just for freshness.

## 10. Performance rules

- No jQuery for features already handled by vanilla JS.
- Do not add a third-party script unless its value exceeds its privacy/performance cost.
- Defer non-critical JavaScript.
- Optimize future images as WebP/AVIF where practical, include width/height, descriptive alt text, and lazy-load below-the-fold images.
- Keep tool pages useful with JavaScript enabled; if a tool fundamentally requires JS, explanatory content must still render server-side.

## 11. URL and link rules

- Internal public links use extensionless URLs.
- Category index uses trailing slash: `/seo/`, `/marketing/`, etc.
- Tools and posts do not use trailing slashes in canonicals.
- Never rename an indexed slug without a 301 redirect from the old URL and a sitemap update.
- Do not create multiple live URLs for the same tool.

## 12. Definition of done for every change

A tool/post is not finished until:
- PHP syntax passes.
- Page renders without console-breaking JavaScript errors in supported modern browsers.
- Header/footer/search/theme still work.
- Mobile layout is usable at 360px and desktop at 1280px.
- H1 is unique; H2 structure is logical.
- Title, description and canonical are unique and correct.
- Tool formulas/edge cases have been tested.
- FAQ visible copy matches FAQ schema.
- Healthcare/finance caveats are included where applicable.
- Internal links resolve.
- Sitemap is updated.
- No global CSS is duplicated into the page.
- No credentials, PHI, secrets or personal data are committed.

If a future request conflicts with these rules, preserve safety, architecture, accessibility and working functionality over a cosmetic shortcut.
