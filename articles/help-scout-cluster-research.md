# Help Scout cluster research ledger

**Queue item:** Order 8, Help Scout
**Primary keyword:** HelpScout alternative
**Saved US metrics:** volume 260; KD 16; CPC US$46.62; intent informational/commercial
**Research checked:** November 17, 2026
**Research status:** official-source review complete; six-page editorial cluster still needs to be written, rendered, tested and published
**Semrush:** not refreshed. The saved snapshot remains the source of truth.

## Search intent and page plan

The saved snapshot lists the PAA SERP feature, images, videos and related searches, but it does not contain the actual PAA question wording. Do not invent PAA questions or claim that source-led FAQs are copied from Google. Build FAQs from verified vendor documentation and mark them as documentation-led. Public search results were used only to identify common comparison candidates, not as evidence for product or price claims.

| Page | Canonical path | Required word range | Main purpose |
|---|---|---:|---|
| Tool hub | /help-scout/ | 500-900 | Explain the product and connect the cluster |
| Alternatives | /help-scout/alternatives/ | 1,800-2,800 | Compare seven relevant support tools |
| Review | /help-scout/review/ | 1,500-2,200 | Assess features, limits and team fit |
| Pricing | /help-scout/pricing/ | 800-1,400 | Explain plans, usage fees and add-ons |
| How-to | /help-scout/how-to-use/ | 1,200-2,000 | Setup and migration guidance |
| Comparison | /compare/help-scout-vs-zendesk/ | 1,500-2,200 | Compare Help Scout with the strongest broad-ticketing alternative |

The comparison fallback is Help Scout vs Zendesk. Zendesk is the broadest upgrade path in the shortlist and ToolboxKart already has a Zendesk hub, pricing page, alternatives page and review. Keep the comparison balanced and compare equivalent billing periods and plan features.

## Verified Help Scout product facts

The official pricing page, product pages and support documentation were opened and checked on November 17, 2026.

- Free includes up to five users, one Inbox and one Docs site. The feature table lists 100 contacts per month, ten saved replies, ten tags, ten Docs articles and 30 days of report history.
- Standard is US$25 per user/month, Plus US$45 and Pro US$75 on the monthly pricing view. The page displays a 16% annual-billing discount.
- The plan table lists up to 25 users, two Inboxes and two Docs sites on Standard; up to 50 users, five Inboxes and three Docs sites on Plus; and unlimited users with a ten-user minimum, ten Inboxes and five Docs sites on Pro.
- Extra Inboxes are US$10/month with annual billing or US$12/month with monthly billing. Extra Docs sites are US$20/month annually or US$24/month monthly.
- Envoy is listed at US$0.75 per resolution. The pricing page advertises a three-month trial and a monthly spending cap. The page defines a billable resolution as a conversation resolved by Scout without human assistance.
- Help Scout's product areas are Inbox, Docs, Beacon and Envoy/Scout. The Inbox product page describes shared customer context, internal notes, routing and saved replies. Docs is the knowledge base. Beacon can display help content and contact options. Scout can use selected knowledge sources and hand off to a human.
- Current product material lists workflows, SLAs, reporting, 100+ app integrations, API access, webhooks and an MCP connection. The official MCP support article says new connections are read-only, access follows each user's permissions, API access is required, and report tools require Plus or Pro.

## Verified migration and export limits

The official Help Scout import guide says Import2 can bring emails or tickets with attached customer profiles and tags or labels from listed providers. Its list includes Freshdesk, Gorgias, Intercom, LiveAgent, Zendesk and Zoho Desk.

The standard import does not include users or Inbox settings, knowledge-base/help-center articles, saved replies/macros, ticket rules/automations, or some custom fields, ticket types and custom statuses. Users and Inboxes must be created before a sample import. Help Scout says Zendesk knowledge-base imports may be possible through an older tool arranged with its team. A custom import can use the Inbox API.

The export guide says selected reports can be exported to CSV or XLSX, but report exports exclude conversation thread contents. Other customer, user and conversation data is available through the Inbox API; Docs articles are available through the Docs API. Do not describe a generic export as a complete workspace backup.

## Competitor shortlist and official pricing references

Use these vendor pages for feature and price claims. Re-open them immediately before publication if a price is quoted in a page. All figures below are the official pages checked November 17, 2026.

| Alternative | Official pricing evidence | Fit to explain |
|---|---|---|
| Zendesk | Support Team US$19/agent/month annual; Suite Team US$55 annual | Structured ticketing, routing and broader service operations |
| Freshdesk | Growth US$19/agent/month annual; higher plans add features | Conventional help desk and self-service |
| Front | Starter US$25/seat/month annual; Professional US$65; Enterprise US$105 | Shared customer work across departments |
| Intercom | Essential annual list US$29/seat/month, page showed a new-customer US$19 offer; Advanced US$85; Expert US$132; Fin US$0.99/outcome | Product-led, chat-first support and AI |
| Zoho Desk | Free up to three users; US annual selector starts at US$7/user/month for Express | Budget teams and Zoho users |
| LiveAgent | Regular annual prices: Starter US$15, Team US$29, Business US$49 per agent/month | Multichannel support; AI uses the team's provider account |
| Gorgias | Official plan breakdown starts at US$10/month for 50 tickets; ticket-volume model; AI Agent US$0.90/outcome annual or US$1 monthly | Shopify and ecommerce support |

For LiveAgent, the pricing page also displayed a temporary offer ending November 22, 2026. Use regular prices in the comparison table and mention the temporary offer only if the final article clearly labels the expiry date. For Gorgias, state that AI Agent is for Shopify stores and that ticket-volume pricing is not directly comparable with per-seat pricing.

## Existing pages that need cross-links

The published Freshdesk alternatives and Zendesk alternatives pages already mention Help Scout. When the new cluster is ready, update those existing Help Scout sections with the current Free contact limit, current Standard price, Envoy resolution fee and links to the new Help Scout hub, review, pricing and setup guide. Update their modified dates and source ledgers in the same content commit.

## Publication and schema requirements

- Use tool-first permanent paths exactly as listed above. Do not add dates to URLs.
- All six pages need indexable metadata, unique canonical URLs, useful internal links and a public registry entry.
- Hub: SoftwareApplication plus Article, BreadcrumbList and source-led FAQPage. Do not add ratings.
- Alternatives: Article, BreadcrumbList, ItemList of seven tools and FAQPage. Link to existing Zendesk and Freshdesk reviews where relevant.
- Review: Article, BreadcrumbList and FAQPage only. Do not use Review or AggregateRating schema, and do not invent a rating or hands-on test.
- Pricing, how-to and comparison: Article, BreadcrumbList and FAQPage.
- Keep each page's title and description within the repository's length rules. Check rendered HTML, not only source metadata.
- Add the Help Scout alternative to the existing customer-growth alternative group. The existing /alternatives/ directory is the closest live browse page; do not invent a customer-support category pillar without a matching tool-category mapping.
- No legacy Help Scout URL was found, so do not add redirects unless a verified old URL is discovered.

## Sitemap discovery plan

The repository already has dynamic child sitemap generators for tools, alternatives, reviews, pricing, how-to-use, compare, categories and pages. Add the new records to their existing dynamic source registries so the six canonicals appear exactly once in the correct child maps:

- /help-scout/ in sitemap-tools.xml
- /help-scout/alternatives/ in sitemap-alternatives.xml
- /help-scout/review/ in sitemap-reviews.xml
- /help-scout/pricing/ in sitemap-pricing.xml
- /help-scout/how-to-use/ in sitemap-how-to-use.xml
- /compare/help-scout-vs-zendesk/ in sitemap-compare.xml

The root sitemap index and robots.txt already declare all eight child maps. The static sitemap.xml currently differs from the dynamic root index; align the static file to the same sitemap-index structure in the publication commit. Extend the sitemap validator to validate the root index, all dynamic child generators, duplicate canonicals and robots declarations.

## Current queue state

Order 8 is in_progress. Do not mark it published until all six pages, registries, internal links and sitemap discovery are in one content commit, all relevant tests pass, and seo/quality-status.json reports status=passed with the exact content commit SHA.