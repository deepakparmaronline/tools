# ChatGPT Schedule Guideline

**Purpose:** Mandatory operating rules for the recurring ToolBoxKart software decision content workflow. This schedule replaces ToolboxKart AI news, ChatGPT news, Claude news, Tools Guide, and general Tech publishing. Existing pages stay live, but the scheduled workflow does not create new content for those sections.

## 1. Repository and branch rules

- Repository: `deepakparmaronline/tools`.
- Work on the existing `main` branch and preserve the custom PHP site.
- Pull the latest `main` before every run.
- Preserve existing non-software pages. Software-cluster URLs use the permanent tool-first structure: `/{tool}/`, `/{tool}/alternatives/`, `/{tool}/review/`, `/{tool}/pricing/`, and `/{tool}/how-to-use/`. Comparisons remain `/compare/{tool}-vs-{other}/` unless explicitly migrated.
- Do not add a navigation link to a route that is not live.
- Commit and push only reviewed changes needed for the current run.
- Hostinger deploys automatically from GitHub `main`. The user performs live verification; do not make live HTTP/browser access a publication gate and do not claim it was verified unless it was actually checked.

## 2. Required files to read at the start of every run

Read the latest full contents of:

1. `seo/content_guide.md`
2. `seo/toolboxkart_publishing_plan.md`
3. `seo/tool_publishing_queue.md`
4. `seo/search_research_snapshot.md`
5. `alternatives list.md`
6. `agents.md`
7. `docs/ALTERNATIVES.md`
8. `articles/progress.md`
9. Existing tool, alternatives, reviews, compare or versus, pricing, how-to, category, sitemap, navigation, and `data/software-pages.php` implementation files that affect the queued tool.

If a required file is missing or unreadable, stop before publishing and report the exact blocker.

## 3. Take the next fixed queue item

- `seo/tool_publishing_queue.md` is the only tool-selection source.
- If a row is marked `in_progress`, resume the lowest Order `in_progress` row.
- Otherwise take the lowest Order row marked `queued`.
- Do not score candidates, choose among tools, reorder the queue, or use source-row order from `alternatives list.md`.
- Change the selected row to `in_progress` before content work.
- If its exact product or essential official facts cannot be verified, change it to `needs_review`, record the reason, and continue with the next `queued` row.
- Never select a held, duplicate, excluded, unsafe, paywall-bypass, piracy, non-software, or news topic.
- Do not touch the separate Tech Updates repository or its ChatGPT schedule.

## 4. Use only the saved search research

- Do not open, sign in to, or run Semrush during a scheduled publication.
- Read the selected row in `seo/tool_publishing_queue.md` and its matching full row in the 2026-10-24 Semrush snapshot in `alternatives list.md`.
- Use only the committed search volume, keyword difficulty, CPC, intent, trend, and SERP features. Never invent a missing metric, variant, query, or People Also Ask question.
- For the comparison page, use a comparison query already committed in the repository. If none is committed, use the strongest relevant alternative supported by the cluster brief, as allowed by `seo/content_guide.md`.
- Missing committed search evidence is not an ordinary blocker. Use public SERP research and official product sources to understand intent and fill supported facts. Preserve saved volume, KD, CPC, intent, trend and SERP-feature fields exactly. Never invent Semrush metrics or PAA questions. Omit unsupported details and continue; reserve `needs_review` for a genuine unresolved product identity, safety or material accuracy issue.
- Search research can be refreshed only in a separate owner-authorized task that saves the results in GitHub before a scheduled run uses them.

## 5. Build the complete cluster

The complete cluster may span several scheduled runs. Scheduled runs are bounded, so each run must finish one safe checkpoint instead of repeatedly attempting the whole cluster and saving nothing.

Use these checkpoints in order:

1. Evidence ledger and cluster brief.
2. Shared routing, template, registry and test support that the tool needs.
3. Tool hub and pricing draft.
4. Review and how-to draft.
5. Alternatives and comparison draft.
6. Cross-page consistency, internal links, registration, sitemap and public pillar integration.
7. GitHub quality workflow, publication and live verification.

Complete the selected software cluster end-to-end in the current run whenever the connected GitHub tools can safely support it. Do not stop at a draft checkpoint or move to another queue row because ordinary research is incomplete. Keep drafts unregistered, unlinked and out of public indexes/sitemaps until every required page is ready. Then register all completed pages and their listing/sitemap records in the same reviewed publication change. Keep the queue row `in_progress` until the complete cluster is committed to `main` and the matching quality workflow passes. If a genuine technical block prevents completion, record the exact block and next action in `articles/progress.md` without publishing partial pages.

Create or update the queued tool's complete cluster according to `seo/content_guide.md` and `seo/toolboxkart_publishing_plan.md`:

- Tool hub
- Alternatives page
- Review page
- Pricing page
- How to use page
- One comparison page selected from Semrush comparison volume, or the top alternatives pick when no comparison keyword has volume
- Category pillar update when the publication threshold is met

Existing legacy Alternatives pages keep their current permanent URLs. Do not rename or remove them. Link them naturally into the new cluster where useful, and do not create duplicate pages that target the same primary keyword.

Use the current site architecture and shared components. Add new reusable routing, templates, registry entries, and sitemap support only when required. Keep facts consistent across every page in the cluster.

Use `HUB_MIN_TOOLS = 4`. Before four published tool clusters exist in a category, link to the closest live browse page instead of publishing a thin category pillar.

Every page and its discovery records must be committed together. Add each published page to its matching pillar and child sitemap through the shared registry:

- Tool hub: `/tools/` and `/sitemap-tools.xml`
- Alternatives: `/alternatives/` and `/sitemap-alternatives.xml`
- Review: `/reviews/` and `/sitemap-reviews.xml`
- Pricing: `/pricing/` and `/sitemap-pricing.xml`
- How to use: `/how-to-use/` and `/sitemap-how-to-use.xml`
- Comparison: `/compare/` and `/sitemap-compare.xml`
- Category pillar: `/best/` and `/sitemap-categories.xml`

Tool hubs, pricing guides, how-to guides, comparisons, and category pillars are registered in `data/software-pages.php`. Alternatives use their published article records. Reviews use the published Reviews post registry. Never publish an article file without its registration entry.

## 6. Research and honesty

- Open every product's official website, pricing page, documentation, help center, and changelog needed for the claims.
- Use official sources for prices, limits, features, integrations, imports, exports, and setup steps.
- Put a linked `Checked on [date]` note next to every price, plan detail, and material limit.
- Do not claim testing or hands-on use unless the repository contains confirmed test notes from the owner.
- Do not invent ratings, screenshots, user counts, quotes, discounts, pros, cons, or affiliate relationships.
- If a material fact cannot be verified, leave it out or mark the tool `needs_review` rather than publish unsupported content.
- Paid placement never changes editorial ranking. Any later paid link must use `rel="sponsored"` and a clear disclosure.

## 7. Quality gate

Before committing:

- Confirm every page follows its required order and word-count range.
- Use the permanent tool-first URL structure for every new software cluster. Update the registry, router, canonical, breadcrumbs, internal links, public indexes and sitemaps together. Add 301 redirects for any migrated old URL. Never create new software pages using the legacy `/tools/{tool}/`, `/pricing/{tool}/`, or `/how-to-use/{tool}/` patterns.
- Visually inspect the rendered page template against an existing correctly formatted page of the same type. Confirm the page loads its required stylesheet (for example, `assets/css/publication.css` for standalone publication pages), the table of contents renders as a vertical list rather than concatenated inline links, tables are readable and horizontally scrollable on mobile, and author/date/breadcrumb blocks have the intended spacing.
- Check the final rendered HTML and CSS together, not only the source text. Do not publish a page with missing styles, broken heading anchors, jammed navigation/TOC links, unstyled tables, or overflow on mobile.
- Confirm every live tool-cluster page has natural cross-links to the hub and at least two relevant live siblings. Reviews, pricing, how-to, alternatives and comparison pages should connect to each other wherever useful; never link to a draft or missing route.
- Confirm one unique primary keyword, title, meta description, canonical, H1, visible update date, breadcrumbs, and required schema per page.
- Confirm no banned phrases, em dashes used as punctuation, copied text, fake testing claims, or unsupported facts.
- Confirm internal links point only to live or included pages.
- Confirm all relevant PHP syntax checks and repository tests pass.
- Confirm the build passes.
- Confirm sitemap XML is valid and contains only live, canonical, indexable URLs.
- Confirm `/sitemap.xml` lists every required child sitemap. Confirm every new page appears exactly once in its matching child sitemap and appears on its matching public pillar.
- Review the complete diff and exclude unrelated changes, credentials, private data, and research debris.

If a check fails, fix it before publishing. If the facts cannot be verified, mark the item `needs_review` in the queue, record the reason, and move to the next queued row.

### GitHub runner for scheduled ChatGPT runs

- The repository workflow named `ToolboxKart quality checks` is the required execution environment when the scheduled ChatGPT task cannot run a local checkout.
- Do not treat missing local shell access as a publication blocker.
- Review the complete proposed change first. Commit only the current tool cluster and its required discovery, queue and progress updates.
- After the commit reaches GitHub, wait for `ToolboxKart quality checks` to finish. It checks every changed PHP file, validates the sitemap and runs the software and publication integration tests.
- Read `seo/quality-status.json` from the latest `main`. The workflow is confirmed only when its `status` is `passed` and its `commit` exactly matches the content commit being checked. The file also records the workflow run link and check time.
- The workflow creates a separate status-only commit after a pass. Do not mistake that status commit for the content commit and do not treat it as a new publishing checkpoint.
- If the workflow fails, read the failing step, fix the content or code and run it again. Do not mark the tool published and do not claim live success until the workflow passes.
- A passing workflow does not prove live HTTP status. The user has explicitly taken responsibility for live verification. Do not make live HTTP/browser access a publication gate.

## 8. Publish and verify

- Commit and push the reviewed cluster to GitHub `main`.
- Wait for the `ToolboxKart quality checks` workflow on that commit and confirm it passes.
- Verify repository-rendered indexes, registration, canonicals, internal links, child sitemaps and sitemap-index entries through the quality workflow.
- The user will verify live HTTP responses after Hostinger auto-deploys from GitHub main. Do not claim live verification unless it was actually performed, but do not block a complete commit because live access is unavailable.
- Missing registry, index or child-sitemap records are repository quality failures and must be fixed before publication.

## 9. Progress and final report

Update the queue or progress record with:

- The queue order and queued tool handled.
- The committed Semrush snapshot date and the saved metrics used.
- Any identity, duplicate, skipped, blocked, or `needs_review` issue.
- Every page created or updated.
- Commit SHA and GitHub link.
- Test, build and sitemap status, plus the live-verification handoff. Never claim live verification unless it was actually performed.
- The exact next `queued` row for the following run.

Mark the queue row `published` only after the complete reviewed cluster and its registry, public index and child-sitemap entries are committed to `main` and the matching quality workflow passes for the exact content commit. Hostinger auto-deploys from `main`; the user performs live verification. Do not hold publication for unavailable live HTTP checks.

Keep the final report concise. Report blockers honestly and do not fall back to news publishing.


## 10. Mandatory editorial and technical standards from the latest user instructions (2026-10-28)

These rules supersede any older wording in this file that conflicts with them.

- Original writing, never product-name swaps: every review, pricing page, how-to guide, comparison and alternatives article must be researched and written for that product's real workflows, plans, limits and audience. Do not reuse paragraphs, arguments, FAQ sets or a fixed article outline from another tool. Shared components and design styles are fine; article structure and analysis must fit the specific search intent. If changing only the product name leaves most of an article valid, rewrite it.
- Correct tool-first URLs: use /{tool}/, /{tool}/alternatives/, /{tool}/review/, /{tool}/pricing/, and /{tool}/how-to-use/. Comparisons use /compare/{tool}-vs-{competitor}/. Preserve existing permanent URLs. If a valid comparison already covers the same product pair and intent, improve and link to it instead of creating a reverse-direction duplicate.
- Breadcrumb schema is mandatory: every applicable indexable article and tool page must show visible breadcrumbs and valid BreadcrumbList JSON-LD. The visible trail and JSON-LD must match the real site hierarchy, positions and canonical URLs. Add a regression test for each new page type or route. Standalone review pages are not exempt.
- HTML and CSS: use semantic HTML, one H1, logical heading order, valid anchors, descriptive links, accessible labels and responsive tables. Load the required shared stylesheet. Check rendered layout for desktop and mobile, including TOC spacing, author/date/breadcrumb blocks and table overflow. Do not publish unstyled HTML or rely on source inspection alone when a rendered preview is available.
- Schema by page type: use Article/BlogPosting and BreadcrumbList as appropriate; use SoftwareApplication on a tool hub without fabricated ratings; use ItemList for a visible alternatives list when supported; add FAQPage only for questions and answers visible on the page. Never invent ratings, reviews, author credentials, prices or features.
- Research: read the selected queue row and its committed research snapshot, then use current public SERPs plus official product, pricing, help/documentation and product-update/changelog sources. Do not open or run Semrush. Keep saved metrics unchanged and do not claim editorial FAQs are Semrush PAA questions unless that exact data is saved.
- Publication handoff: commit the complete cluster and its registration/index/sitemap records to main, wait for the ToolboxKart quality workflow and confirm seo/quality-status.json matches the exact content commit. Live HTTP checks are the user's responsibility and are not a publication gate.
