# ToolBoxKart AI Agent Reference Pack

**AI Site Rules • Production Deployment Checklist • Expansion Roadmap**

## How the AI publishing agent must use this document

Read this reference pack before every ToolBoxKart publishing run. Treat the live connected repository as the current implementation source of truth. If the repository shows that a category listing, sitemap, feed, index, or other derived file is generated automatically from a source file such as `/data/posts.php`, update only the documented source of truth and do not manually edit generated output. If the current repository documents a static/manual sitemap or listing, update it carefully according to the live architecture. Never change working architecture, shared templates, routing, CSS, JavaScript, deployment configuration, or other global systems merely to publish content. When uncertain, choose the least invasive change that preserves security, accessibility, SEO integrity, existing functionality, and current repository conventions.

The three source documents below are reproduced from the files supplied for this workflow.

## AI Site Rules

# ToolboxKart AI / Developer Site Rules

This file is the source of truth for anyone—human or AI—adding a tool, category, article, script, or UI component to ToolboxKart. The goal is to scale the library without breaking the theme, URLs, accessibility, SEO structure, or existing tools.

### 1. Non-negotiable architecture

- Production stack: PHP 8+, Apache .htaccess, vanilla JavaScript, shared CSS. Do not introduce a framework, CMS, jQuery, package manager, or database just to add a simple tool.
- Every tool has exactly one page file: `/<category>/<tool-slug>.php`.
- Public canonical tool URL never includes `.php`: `https://toolboxkart.tech/<category>/<tool-slug>`.
- Article file: `/blog/<post-slug>.php`; public canonical URL: `https://toolboxkart.tech/<article-category>/<post-slug>`.
- Header and footer are shared in `/includes/header.php` and `/includes/footer.php`. Never copy them into a tool or post.
- Global UI lives in `/assets/css/app.css` and `/assets/js/app.js`. Do not duplicate the global theme inside individual pages.
- Tool/category discovery comes from `/data/catalog.php`. Article discovery and metadata come from `/data/posts.php`.
- Reusable rendering is in `/includes/tool-template.php`, `/includes/category-template.php`, and `/includes/blog-template.php`.
- `/includes`, `/data`, and `/docs` are intentionally blocked from direct public browsing by `.htaccess`.

### 2. Design system: do not freelance a new theme

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
- Main content width: `1180px`
- Large card radius: `20–24px`; regular cards: `12–18px`

Rules:

- Use system fonts; do not add a remote font dependency without a measured reason.
- Tool UI appears before long explanatory copy.
- Keep visible labels on form controls. Placeholders do not replace labels.
- Mobile width must work at 360px without horizontal page overflow.
- Buttons use `.btn`, `.btn-primary`, `.btn-secondary`.
- Inputs use `.field`; outputs use `.result-box`, `.metric`, `.data-table` as appropriate.
- Use `.notice` for assumptions, privacy notes, safety caveats and non-error guidance.
- Never use color alone to communicate an error or success state.

### 3. Adding a new tool — required sequence

1. Choose the correct existing category. Create a new category only if at least several meaningful tools belong in it.
2. Add one tool record to `/data/catalog.php` with category, slug, name, description, featured.
3. Create `/<category>/<slug>.php`.
4. Start with:
   - `require __DIR__.'/../includes/bootstrap.php';`
   - `$tool=tool_by_path('<category>','<slug>');`
   - buffer `$toolBody`, then buffer `$toolContent`
   - define `$faqs`
   - load `/includes/tool-template.php`
5. Keep tool-specific JavaScript inside that tool file unless the exact behavior is reused by multiple tools; shared behavior belongs in `/assets/js/app.js`.
6. Add the canonical URL to `/sitemap.xml`.
7. Test default values, empty values, zero, negative values where applicable, very large inputs, malformed text, and copy/reset behavior.
8. Run `php -l` on every PHP file and perform a mobile/desktop rendering check.

### 4. Required tool-page SEO/content structure

Every indexable tool page must have:

- One unique H1: the tool name.
- Unique title and meta description from the catalog/tool configuration.
- Self-referencing canonical URL.
- Breadcrumbs.
- Working tool UI near the top.
- At least these visible content sections using useful, non-keyword-stuffed H2s:
  - what the tool does / formula / concept,
  - how to use it,
  - important assumptions or interpretation,
  - FAQs.
- 3–5 useful FAQs whose answers match visible page content.
- WebApplication, BreadcrumbList, and FAQPage JSON-LD from the shared template.
- Internal links only when they genuinely help the user.
- Original content. Never copy rival explanations, examples, FAQs or visual design.

Do not promise rankings, rich results, deliverability, medical outcomes, profit, revenue or other results that the tool cannot guarantee. FAQ structured data describes visible content; it does not guarantee a rich result.

### 5. Tool UX rules

- Show the user exactly what inputs drive the result.
- Expose important formulas or assumptions below the tool.
- Avoid unexplained 0–100 “AI scores.” If a score is genuinely necessary, document every component and weight.
- Validate impossible combinations instead of silently producing nonsense.
- Never show Infinity, NaN, or a fabricated zero when division is undefined; show an explanatory unavailable state.
- Include copy buttons when output is intended to be reused.
- Prefer instant local computation for calculators, counters, formatters and generators.
- Do not require registration for a simple utility without a clear product reason.
- Do not add popups, interstitials or advertising that obstructs the primary task.

### 6. Healthcare rules

Current Healthcare tools are administrative Revenue Cycle Management utilities, not clinical tools.

- Do not ask for patient names, DOB, MRN, member IDs, claim numbers, diagnoses or any PHI.
- Inputs must be aggregate operational numbers.
- Include a visible no-PHI reminder on RCM calculators.
- Do not add symptom checkers, diagnosis, dosage, treatment recommendations, medical-device interpretation or other clinical decision tools under this simple template. Those require a separate safety and evidence review.
- Do not imply a billing metric is clinical advice.
- Distinguish billed charges from allowed amounts, expected reimbursement, collections and financial loss.

### 7. Finance rules

- State the formula and assumptions.
- Label outputs as estimates/scenarios where contractual or real-world results can differ.
- Do not present calculator output as investment, tax, lending or accounting advice.
- Never imply an assumed investment return is a forecast.
- Handle zero-interest and zero-denominator cases explicitly.
- Explain exclusions such as fees, taxes, insurance, overhead or variable rates where material.

### 8. Privacy, security and backend rules

- Process in the browser when the job can be safely completed in browser JavaScript.
- Never place API secrets, private keys or provider credentials in client-side code or in this ZIP.
- Escape any server-rendered user-controlled value with `e()`.
- If a future tool needs a server/API call: validate inputs server-side, restrict size, set timeouts, rate-limit abuse, handle failures, and document whether data is sent to a third party.
- Update `/privacy.php` before adding analytics, ads, accounts, forms, persistent storage, payment systems or third-party tracking.
- Keep dependencies minimal and vetted.

### 9. Adding an article

9. Copy `/blog/_POST-TEMPLATE.php.example` to `/blog/<slug>.php`.
10. Add matching metadata to `/data/posts.php` with slug, title, description, category, date (YYYY-MM-DD) and read_time.
11. Assign exactly one public category: `chatgpt`, `claude`, `ai-news`, or `tools-guide`. ChatGPT and Claude articles belong in their own category; other AI-company news belongs in `ai-news`; tool tutorials, comparisons, workflows and guides belong in `tools-guide`.
12. Keep author attribution as Deepak Parmar unless ownership intentionally changes site-wide. The shared author information includes LinkedIn (`https://www.linkedin.com/in/deepakparmaronline/`) and YouTube (`https://www.youtube.com/@deepakparmaronline/`).
13. Use one introductory paragraph followed by descriptive H2 sections. H2s generate the table of contents automatically.
14. The shared template automatically adds author, published date, read time, BlogPosting schema and breadcrumbs. Do not add “Recent posts by Deepak Parmar” or generic recent-post modules.
15. Link to relevant tools naturally; do not force links into unrelated paragraphs.
16. Add the category-based canonical post URL to `/sitemap.php`; do not add `/blog/<slug>` as a new canonical URL.
17. Use a real publication date; never invent “updated” dates just for freshness.

### 9A. Category listing freshness and publication verification

- The public category listings `/chatgpt/`, `/claude/`, `/ai-news/`, and `/tools-guide/` are generated from `/data/posts.php` and sorted so matching published articles appear automatically. A new article must not require a manual listing-page edit.
- The homepage “Latest practical guides” section intentionally shows only the three newest articles. Do not expand it to show the full registry.
- After every publishing run, verify the category listing that owns each new article and confirm the article appears with its correct title and category-based link.
- Verify the article URL as `/<category>/<post-slug>`. The old `/blog/<post-slug>` path is a legacy URL and should 301 redirect through `blog-redirect.php`; `/blog/` redirects to `/chatgpt/`.
- If a new article exists in the repository but is missing from its category listing, treat the run as failed until the registry, category mapping, PHP runtime/opcache, page-cache, or deployment issue is diagnosed and resolved within available tools.
- Never declare an article successfully published merely because `data/posts.php` or the article file was updated in GitHub.

### 10. Performance rules

- No jQuery for features already handled by vanilla JS.
- Do not add a third-party script unless its value exceeds its privacy/performance cost.
- Defer non-critical JavaScript.
- Optimize future images as WebP/AVIF where practical, include width/height, descriptive alt text, and lazy-load below-the-fold images.
- Keep tool pages useful with JavaScript enabled; if a tool fundamentally requires JS, explanatory content must still render server-side.

### 11. URL and link rules

- Internal public links use extensionless URLs.
- Tool category indexes use trailing slash: `/seo/`, `/marketing/`, etc. Article category indexes use trailing slash: `/chatgpt/`, `/claude/`, `/ai-news/`, `/tools-guide/`.
- Tools and articles do not use trailing slashes in canonicals.
- Article canonicals use the assigned category path, never `/blog/`.
- Never rename an indexed slug without a 301 redirect from the old URL and a sitemap update.
- Do not create multiple live URLs for the same tool.

### 12. Definition of done for every change

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

## Deployment Checklist

# ToolboxKart Production Deployment Checklist

- ☐ Domain `toolboxkart.tech` points to the Hostinger site.
- ☐ SSL certificate is active and HTTPS loads without warnings.
- ☐ Upload site contents to the correct web root (`public_html` or configured document root).
- ☐ `.htaccess` uploaded successfully (some file managers hide dotfiles).
- ☐ `/seo/serp-preview` loads without `.php` in the public URL.
- ☐ Tool category URLs such as `/marketing/` load.
- ☐ Article category URLs `/chatgpt/`, `/claude/`, `/ai-news/`, and `/tools-guide/` load.
- ☐ A new article loads at its category URL, such as `/tools-guide/how-to-create-a-utm-naming-system`.
- ☐ The matching category listing shows every newly published article after deployment.
- ☐ A legacy `/blog/<slug>` URL 301 redirects to the correct category URL, and `/blog/` redirects to `/chatgpt/`.
- ☐ `/sitemap.xml` and `/robots.txt` return 200.
- ☐ Custom 404 works for a nonexistent URL.
- ☐ Search modal, mobile menu, dark mode and copy buttons work.
- ☐ Test at 360px mobile width and a standard desktop width.
- ☐ Replace Contact placeholder with real support contact/form.
- ☐ Legal pages reviewed for the actual company, audience and jurisdictions.
- ☐ Privacy policy updated before enabling analytics, ads, forms, accounts or third-party tracking.
- ☐ Optional HTTPS/host canonical redirect in `.htaccess` enabled only after SSL/DNS are verified.
- ☐ Submit sitemap to relevant webmaster/search-console products.

## Tool Roadmap

# ToolboxKart Expansion Roadmap

Do not publish empty tool pages from this list. A URL should go live only when its tool works, content is original/useful, edge cases are tested, and it follows AI-SITE-RULES.md.

### Priority A — expand existing categories

#### SEO

- Redirect chain checker — server-side URL fetch with SSRF protections and strict timeout.
- HTTP status checker — same secure fetch foundation.
- Canonical tag checker — fetch and inspect declared canonical.
- Heading structure checker — extract H1–H6 and show hierarchy.
- Open Graph preview/generator — explicit social metadata output.
- Twitter/X card generator — current card metadata output.
- XML sitemap validator — parse uploaded/pasted sitemap and report structural issues.
- Hreflang generator — generate reciprocal hreflang markup from locale/URL pairs.
- Hreflang validator — verify locale syntax and reciprocal mappings.
- Schema markup viewer — parse JSON-LD blocks pasted by the user.
- Slug generator — normalize titles into readable URL slugs.
- Keyword grouping helper — local/manual clustering first; AI version only with disclosed API behavior.
- Internal-link anchor planner — organize source URL, target URL and anchor ideas.
- SERP title batch preview — CSV/paste table of URLs/titles/descriptions.
- Content brief checklist — transparent editorial checklist, not a fake ranking score.

#### Marketing

- CAC calculator.
- LTV calculator with disclosed model assumptions.
- LTV:CAC ratio calculator.
- Conversion lift calculator.
- A/B test sample-size estimator with documented statistics.
- A/B test significance calculator with documented test assumptions.
- CPM/CPC/CPA reverse calculator.
- Email open/click/conversion funnel calculator.
- Webinar funnel calculator.
- Lead-to-customer funnel calculator.
- Landing-page conversion calculator.
- Influencer CPM/CPV calculator.
- Affiliate commission calculator.
- Discount code campaign calculator.
- Social engagement-rate calculator.

#### Finance / Business

- Sales tax calculator with manual user-supplied rate; do not hard-code changing tax law without a maintained data source.
- VAT calculator with manual rate.
- Simple interest calculator.
- Effective annual rate calculator.
- Savings goal calculator.
- Debt payoff scenario calculator.
- Discount calculator.
- Markup-to-margin converter.
- Cash runway calculator.
- Burn rate calculator.
- Working capital calculator.
- Inventory turnover calculator.
- Accounts receivable turnover calculator.
- ROI calculator.
- Payback-period calculator.

#### Healthcare RCM / operations

- Collection rate calculator using aggregate totals.
- Net collection rate calculator with clearly defined contractual adjustments.
- Gross collection rate calculator.
- A/R aging percentage calculator using aggregate aging buckets.
- A/R over-90-days calculator.
- First-pass resolution rate calculator.
- Claim rejection rate calculator with rejection/denial distinction.
- Charge lag calculator using aggregate dates/counts, no PHI.
- Payment variance percentage calculator using aggregate expected/paid totals.
- Provider productivity aggregate calculator only where definitions are operational and non-clinical.

Never add diagnosis, symptom, dose, treatment, triage or clinical decision utilities under the normal RCM template.

#### Developer

- URL encoder/decoder.
- HTML entity encoder/decoder.
- JWT decoder that explicitly does not claim to verify signatures without a key.
- UUID generator.
- Unix timestamp converter.
- Regex tester with clear runtime limitations.
- CSV-to-JSON converter.
- JSON-to-CSV converter.
- XML formatter/validator.
- YAML/JSON converter using a vetted parser dependency if needed.
- Hash generator for non-password integrity uses; explain password hashing separately.
- Color HEX/RGB/HSL converter.
- CSS minifier.
- JavaScript minifier only with a vetted parser/minifier; do not use dangerous regex-only transformation.
- Lorem ipsum / structured placeholder text generator.

#### Productivity

- Case converter.
- Duplicate line remover.
- Sort lines.
- Text difference viewer.
- Random list picker.
- Number list generator.
- Date difference calculator.
- Time duration calculator.
- Business-day calculator with user-selected holidays/calendar assumptions.
- Age calculator.
- Tip calculator.
- Pace calculator.
- Ratio calculator.
- Average/median calculator.
- Roman numeral converter.

### Priority B — new categories after enough tools exist

#### Ecommerce

- Marketplace fee calculator with user-supplied/current fee configuration.
- Product margin calculator.
- Average order value calculator.
- Cart abandonment impact calculator.
- Free-shipping threshold calculator.
- Inventory reorder-point calculator.
- Safety stock calculator.
- SKU profit calculator.

#### Content / Writing

- Reading-time estimator (can reuse core logic from word counter without duplicating CSS/UI).
- Headline length checker.
- Meta description batch checker.
- Text case converter.
- Sentence/paragraph counter.
- Markdown previewer.
- HTML-to-plain-text cleaner.
- Content outline organizer.

#### Data / Conversion

- Unit converter.
- Area converter.
- Length converter.
- Weight converter.
- Temperature converter.
- Storage-size converter.
- Percentage/ratio converter.
- CSV cleaner.

#### Image utilities

Only add after image-processing dependencies and hosting resource limits are tested.

- Resize image.
- Compress image.
- Crop image.
- Convert PNG/JPEG/WebP.
- Favicon generator.
- Image metadata viewer/remover.

#### Document utilities

Only add after server limits, privacy, temporary-file deletion and library licensing are reviewed.

- Merge PDF.
- Split PDF.
- Compress PDF.
- Images to PDF.
- PDF page counter/metadata viewer.

### Product priorities learned from rival benchmarking

- Breadth helps discovery, but avoid a homepage that becomes a wall of hundreds of links.
- Keep category landing pages and universal search as the scaling mechanism.
- Tool pages should be task-focused, with the interactive utility above long-form content.
- New high-cost/API tools should disclose limits and data sources instead of presenting opaque scores.
- Do not clone competitor wording, UI, examples, code, or proprietary scoring logic.
