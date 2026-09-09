# ToolboxKart Expansion Roadmap

Do **not** publish empty tool pages from this list. A URL should go live only when its tool works, content is original/useful, edge cases are tested, and it follows `AI-SITE-RULES.md`.

## Priority A — expand existing categories

### SEO
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

### Marketing
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

### Finance / Business
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

### Healthcare RCM / operations
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

### Developer
- URL encoder/decoder.
- HTML entity encoder/decoder.
- JWT decoder that explicitly does **not** claim to verify signatures without a key.
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

### Productivity
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

## Priority B — new categories after enough tools exist

### Ecommerce
- Marketplace fee calculator with user-supplied/current fee configuration.
- Product margin calculator.
- Average order value calculator.
- Cart abandonment impact calculator.
- Free-shipping threshold calculator.
- Inventory reorder-point calculator.
- Safety stock calculator.
- SKU profit calculator.

### Content / Writing
- Reading-time estimator (can reuse core logic from word counter without duplicating CSS/UI).
- Headline length checker.
- Meta description batch checker.
- Text case converter.
- Sentence/paragraph counter.
- Markdown previewer.
- HTML-to-plain-text cleaner.
- Content outline organizer.

### Data / Conversion
- Unit converter.
- Area converter.
- Length converter.
- Weight converter.
- Temperature converter.
- Storage-size converter.
- Percentage/ratio converter.
- CSV cleaner.

### Image utilities
Only add after image-processing dependencies and hosting resource limits are tested.
- Resize image.
- Compress image.
- Crop image.
- Convert PNG/JPEG/WebP.
- Favicon generator.
- Image metadata viewer/remover.

### Document utilities
Only add after server limits, privacy, temporary-file deletion and library licensing are reviewed.
- Merge PDF.
- Split PDF.
- Compress PDF.
- Images to PDF.
- PDF page counter/metadata viewer.

## Product priorities learned from rival benchmarking

- Breadth helps discovery, but avoid a homepage that becomes a wall of hundreds of links.
- Keep category landing pages and universal search as the scaling mechanism.
- Tool pages should be task-focused, with the interactive utility above long-form content.
- New high-cost/API tools should disclose limits and data sources instead of presenting opaque scores.
- Do not clone competitor wording, UI, examples, code, or proprietary scoring logic.
