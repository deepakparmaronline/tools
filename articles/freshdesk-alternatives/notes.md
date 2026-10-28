# Freshdesk cluster notes

## Selection and status
- Queue row: Order 2, primary keyword **Freshdesk alternative**, US volume 480, KD 16, CPC US$46.98, commercial intent, rising trend. These fields are copied from the saved queue and the matching row in `alternatives list.md`; no Semrush run was made.
- Product identity: Freshdesk, the email-first help desk from Freshworks. Keep it distinct from Freshdesk Omni, the separate multichannel product.
- Cluster publication date: 2026-10-29 Asia/Kolkata. No dates were backfilled.
- Editorial state: prepared for publication. No hands-on testing is claimed.
- Public SERP research checked 2026-10-29. Listicle formats dominate the visible results; this cluster focuses on use-case fit, product scope, billing model and export/migration friction rather than ratings or unsupported rankings.
- The matched saved keyword row records SERP features SL, AIO, Rev, Vid and Rel. It does not provide PAA question text, so no exact PAA questions were invented.

## Selection rationale
Seven alternatives were selected to cover distinct decision paths: Zendesk for a broad help desk; Zoho Desk for small teams and the Zoho ecosystem; Help Scout for a human-led shared inbox; Front for team collaboration; Intercom for messaging and outcome-priced AI; Gorgias for ecommerce; and LiveAgent for combined ticketing, chat and phone. Each candidate has a documented support use case. No user ratings or unsupported “best overall” claims are used.

## Internal links
- Freshdesk hub: `/freshdesk/` for product scope.
- Freshdesk review: `/freshdesk/review/` for a research-based product assessment.
- Freshdesk pricing: `/freshdesk/pricing/` for plan prices and add-on costs.
- Freshdesk how-to: `/freshdesk/how-to-use/` for setup and workflow steps.
- Shared comparison: `/compare/zendesk-vs-freshdesk/` for the direct help desk comparison.
- Related Zendesk pages: `/zendesk/`, `/zendesk/review/`, `/zendesk/pricing/`, `/zendesk/how-to-use/`, `/zendesk/alternatives/`.
- Existing browse pages: `/tools/` and `/alternatives/`. No customer-support category pillar was created because fewer than four relevant tool clusters are published.

## Schema and page structure
- Canonical: `https://toolboxkart.tech/freshdesk/alternatives/`.
- Visible breadcrumbs: Home > Freshdesk > Alternatives.
- Shared template generates Article and BreadcrumbList JSON-LD. The article body contains ItemList JSON-LD matching the seven visible alternatives in order and FAQPage JSON-LD matching the visible five-question FAQ.
- No AggregateRating, Review, Offer, fake hands-on claims or unverified product ratings.
- The article uses a horizontally scrollable comparison table and semantic headings. The shared alternatives template supplies the page H1, metadata, author box and related cards.
- No featured image was added because no verified, relevant image asset was available and the article works without one.

## Research boundaries
- Freshdesk prices are from the official US pricing page and are per agent/month billed annually. The official help article says the Free Program is for two agent seats for six months and only for Freshdesk, not Freshdesk Omni.
- The first 500 AI Agent sessions are listed as included once per account; additional sessions are US$49 per 100, and Copilot is listed at US$29 per agent/month on Pro and Enterprise. Other usage charges exist.
- Zoho Desk paid pricing is region-dependent. The page view used showed INR rates, so a US-dollar paid starting price was not quoted.
- Gorgias' pricing page describes ticket-volume pricing and usage charges but did not expose each plan price in its text view; no exact starting price was invented.
- LiveAgent's official pricing page displayed a 30-day trial and changing plan selector/offer details; no volatile starting price was quoted.
- Competitor SERP pages were used to inspect intent and page formats, not as sources for current vendor pricing.
- A dedicated Freshdesk changelog page was not located in the official sources checked. No claim about a recent Freshdesk release is used.
- No exact PAA question text was present in the saved row. FAQ questions were written from the visible search intent and official docs, not labeled as PAA.

## QA checklist
- [x] Product identity and official pricing/docs checked.
- [x] SEO brief, evidence ledger, schema artifact and Markdown source saved.
- [x] New permanent tool-first URL specified in record.
- [x] Internal links point to existing or same-commit cluster pages.
- [x] Visible breadcrumb hierarchy and schema defined.
- [x] Product-specific trade-offs, pricing models and migration limitations covered.
- [x] No hands-on testing, ratings or unsupported metrics claimed.
- [ ] PHP syntax, integration tests, rendered CSS and responsive checks: run through the matching GitHub Actions workflow after the complete cluster is committed to main.
- [ ] Live HTTP/deployment verification: user will check production; it is not a publication gate.

## Publication handoff
- Complete cluster remains staged on `automation/freshdesk-cluster-2026-10-29` until the reviewed branch is moved to main.
- Expected public URLs: `/freshdesk/`, `/freshdesk/alternatives/`, `/freshdesk/review/`, `/freshdesk/pricing/`, `/freshdesk/how-to-use/`, and the existing `/compare/zendesk-vs-freshdesk/`.
- After the content commit reaches main, read `seo/quality-status.json` until it reports `status: passed` for the exact content commit. Fix any failing step before closing the queue row.
