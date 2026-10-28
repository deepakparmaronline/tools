# Freshdesk software cluster brief

- **Queue item:** Order 2 — Freshdesk alternative.
- **Saved keyword metrics:** US volume 480, KD 16, CPC US$46.98, commercial intent, rising trend; SERP features SL, AIO, Rev, Vid, Rel. These values remain exactly as saved in the queue and the 2026-10-24 snapshot. Semrush was not opened or run.
- **Publication date:** 2026-10-29 Asia/Kolkata. No backdated publication dates.
- **Content approach:** Each page answers a distinct search intent and uses product-specific evidence. No recycled product-name templates, generic pros/cons or unsupported ranking claims.
- **Research method:** Public SERP research plus current official product, pricing, help-center, export/API and product-update sources. No hands-on testing, independent benchmarks or invented customer outcomes.
- **Breadcrumb policy:** Visible breadcrumbs and BreadcrumbList JSON-LD are required for each applicable indexable page. The names, order and canonical URLs must match.
- **HTML/CSS:** Semantic headings, one H1, responsive tables, readable spacing, shared publication styles for reviews, shared software detail styles for hub/pricing/how-to/comparison, and the shared alternatives template for the alternatives page.
- **Schema:** Software hub emits Article, BreadcrumbList and SoftwareApplication. Pricing/how-to/comparison pages emit Article and BreadcrumbList. Reviews emit Article, BreadcrumbList and FAQPage. The alternatives page emits Article and BreadcrumbList from the template, plus an ItemList matching its seven visible alternatives and FAQPage matching its visible FAQ. No ratings or fabricated offers.

## Permanent URL map

| Page | Canonical URL | Registration/discovery |
|---|---|---|
| Tool hub | https://toolboxkart.tech/freshdesk/ | `data/software-pages.php`, tools index, `sitemap-tools.xml` |
| Alternatives | https://toolboxkart.tech/freshdesk/alternatives/ | `alternatives/articles/freshdesk-alternatives.php`, Alternatives index, `sitemap-alternatives.xml` |
| Review | https://toolboxkart.tech/freshdesk/review/ | `reviews/freshdesk-review/index.php`, `data/post-2026-10-29-freshdesk-review.php`, reviews index, `sitemap-reviews.xml` |
| Pricing | https://toolboxkart.tech/freshdesk/pricing/ | `data/software-pages.php`, pricing index, `sitemap-pricing.xml` |
| How-to | https://toolboxkart.tech/freshdesk/how-to-use/ | `data/software-pages.php`, how-to index, `sitemap-how-to-use.xml` |
| Shared comparison | https://toolboxkart.tech/compare/zendesk-vs-freshdesk/ | Existing permanent comparison record in `data/software-pages.php`, comparison index, `sitemap-compare.xml` |

The existing comparison was expanded instead of creating a duplicate Freshdesk-vs-Zendesk URL with reversed product order.

## Internal links

Every Freshdesk page links to the hub and relevant sibling pages. The shared comparison links to both tool hubs, reviews, pricing guides, how-to guides and alternatives pages. The Zendesk hub, pricing, how-to, review and alternatives pages now cross-link to Freshdesk where relevant. All new internal links use the permanent tool-first paths.

## Category decision

No customer-support category pillar was created. Only two relevant clusters (Zendesk and Freshdesk) are currently published, below the repository's `HUB_MIN_TOOLS=4` threshold.

## Known source boundaries

- Freshdesk pricing and its Free Program were checked against the official US pricing page and official help article on 2026-10-29.
- The official Freshdesk help article says filtered ticket exports do not include the full conversation or archived history; a separate account export is documented for broader data.
- Zoho Desk paid prices depend on region. The official page view used displayed INR amounts, so no US-dollar paid starting price is quoted.
- Gorgias' pricing page describes ticket-volume pricing but did not expose all plan prices in its text view; no exact starting price is invented.
- A dedicated Freshdesk release-by-release changelog was not located. The official quarterly update session dated July 16, 2026 was reviewed; no specific recent release claim is made.
- The saved Freshdesk keyword row contains no exact PAA question text. The FAQ is based on user decision needs and official documentation, not presented as PAA.

## Quality workflow and handoff

After the complete cluster reaches `main`, wait for the GitHub Actions workflow **ToolboxKart quality checks**. Read `seo/quality-status.json` from latest main and accept a pass only when `status` is `passed` and `commit` exactly matches the content commit. Fix any failure and rerun. Hostinger auto-deploys from main; live HTTP verification is the user's responsibility and is not a publication gate.
