# ChatGPT Schedule Guideline

**Purpose:** Mandatory operating rules for the recurring ToolBoxKart software decision content workflow. This schedule replaces ToolboxKart AI news, ChatGPT news, Claude news, Tools Guide, and general Tech publishing. Existing pages stay live, but the scheduled workflow does not create new content for those sections.

## 1. Repository and branch rules

- Repository: `deepakparmaronline/tools`.
- Work on the existing `main` branch and preserve the custom PHP site.
- Pull the latest `main` before every run.
- Do not delete or redirect existing AI news, ChatGPT, Claude, Tools Guide, Tech, Alternatives, Versus, or Reviews pages.
- Do not add a navigation link to a route that is not live.
- Commit and push only reviewed changes needed for the current run.
- Hostinger deploys automatically from GitHub `main`. Verify the live result after pushing.

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
- Missing Semrush access is not a blocker because the schedule must not use Semrush. If missing committed search evidence prevents a required page from passing the quality gate, mark the row `needs_review`, record what is missing, and continue with the next queued row.
- Search research can be refreshed only in a separate owner-authorized task that saves the results in GitHub before a scheduled run uses them.

## 5. Build the complete cluster

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
- Confirm one unique primary keyword, title, meta description, canonical, H1, visible update date, breadcrumbs, and required schema per page.
- Confirm no banned phrases, em dashes used as punctuation, copied text, fake testing claims, or unsupported facts.
- Confirm internal links point only to live or included pages.
- Confirm all relevant PHP syntax checks and repository tests pass.
- Confirm the build passes.
- Confirm sitemap XML is valid and contains only live, canonical, indexable URLs.
- Confirm `/sitemap.xml` lists every required child sitemap. Confirm every new page appears exactly once in its matching child sitemap and appears on its matching public pillar.
- Review the complete diff and exclude unrelated changes, credentials, private data, and research debris.

If a check fails, fix it before publishing. If the facts cannot be verified, mark the item `needs_review` in the queue, record the reason, and move to the next queued row.

## 8. Publish and verify

- Commit and push the reviewed cluster to GitHub `main`.
- Verify the live hub, alternatives, review, pricing, how-to, comparison, and category pages that were created or changed.
- Verify the Tool hubs, Alternatives, Reviews, Pricing, How to use, Comparisons, and Best software indexes where applicable.
- Verify the homepage navigation contains Tool hubs, Alternatives, Reviews, Pricing, How to use, Comparisons, Best software, and Browse tools by niche, and does not contain ChatGPT, Claude, AI News, Tools Guide, or Tech.
- Verify the live sitemap entries and canonical URLs.
- Treat a missing pillar card or missing child-sitemap URL as a failed publication. Keep the queue row `in_progress` until both are live.
- Never claim live success from a GitHub commit alone.

## 9. Progress and final report

Update the queue or progress record with:

- The queue order and queued tool handled.
- The committed Semrush snapshot date and the saved metrics used.
- Any identity, duplicate, skipped, blocked, or `needs_review` issue.
- Every page created or updated.
- Commit SHA and GitHub link.
- Test, build, sitemap, and live verification status.
- The exact next `queued` row for the following run.

Mark the current queue row `published` only after GitHub push, Hostinger deployment, and live verification all succeed. If publication is incomplete or blocked, leave it `in_progress` with the exact blocker recorded in `articles/progress.md`.

Keep the final report concise. Report blockers honestly and do not fall back to news publishing.
