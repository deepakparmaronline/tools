# ToolBoxKart Software Content Plan

## Goal

Build ToolBoxKart into a source-backed software decision site that earns rankings through complete topic coverage, accurate current facts, strong internal links, and useful comparisons. The daily workflow publishes software decision content only. It does not publish AI news, ChatGPT news, Claude news, or general technology news.

The separate Tech Updates repository and schedule remain independent and must not be changed by this workflow.

## Editorial strategy

One tool is one content cluster. A cluster gives a reader every major decision and usage page without forcing several pages to compete for the same keyword.

| Page | Search job | Primary keyword pattern |
| --- | --- | --- |
| Tool hub | Understand the product and reach every sibling page | `[tool]` or a distinct navigational phrase |
| Alternatives | Find substitutes | `[tool] alternatives` |
| Review | Decide whether the tool fits | `[tool] review` |
| Pricing | Understand plans, limits, and extra costs | `[tool] pricing` |
| How to use | Set up and complete common tasks | `how to use [tool]` |
| Comparison | Choose between two tools | `[tool] vs [competitor]` |
| Category pillar | Compare the strongest tools in one category | `best [category] software` |

Each page must have a different primary keyword and a distinct purpose. Facts must remain consistent across the cluster.

## Fixed selection system

`seo/tool_publishing_queue.md` decides the tool. The daily schedule does not score or choose among keywords.

1. Resume the first `in_progress` row.
2. Otherwise take the lowest Order row marked `queued`.
3. Verify the exact product and its official website.
4. If verification fails, mark `needs_review` with the reason and continue to the next queued row.
5. Never publish a held, duplicate, excluded, unsafe, non-software, or news topic.

The complete one-time Semrush research remains in `alternatives list.md`, and `seo/search_research_snapshot.md` defines how the schedule may use it. It is committed evidence for the prepared order, not a nightly research task.

## Daily workflow

### 1. Establish the work item

Pull current `main`, read the required repository instructions, claim the next queue row, and inspect all existing pages for that tool. Preserve existing permanent URLs.

### 2. Load the committed search research

Read the queued row and its matching full Semrush snapshot row in `alternatives list.md`. Use the saved volume, keyword difficulty, CPC, intent, trend, and SERP features. Do not open or run Semrush during a scheduled publication. Do not invent missing variants, questions, or metrics. Use the documented comparison fallback when no committed comparison query is available.

### 3. Build an evidence ledger

Open the selected tool's official site, pricing, documentation, help center, and changelog. Do the same for alternatives and the comparison product where their facts are used. Record source URLs, dates, billing context, plan limits, migration details, and unresolved facts.

### 4. Prepare the cluster brief

Define the audience, category, search intent, switching reasons, who should stay, alternatives criteria, comparison opponent, internal-link plan, and factual boundaries. Check existing primary keywords to prevent cannibalization.

### 5. Build or extend the architecture

Preserve the custom PHP architecture and existing Alternatives URLs. Reuse shared components and registries. When a page type does not yet have reusable support, add the smallest shared routing, template, registry, sitemap, and index implementation needed before adding the page. Do not create isolated one-off page systems.

Use `HUB_MIN_TOOLS = 4` for a category pillar. Before four published tool clusters exist in a category, link to the closest live browse page rather than publishing a thin pillar.

### 6. Write the complete cluster

Follow `seo/content_guide.md` for page order, word ranges, language, sourcing, checked dates, metadata, schema, and links. Preserve useful legacy Alternatives content, but revise unsupported or outdated material when official evidence requires it.

### 7. Connect the cluster

Every page links to the tool hub, the live category destination, and at least two useful sibling pages. The hub links to every sibling. Alternatives pages link only to alternative reviews that exist. Update older same-category pages when they already mention the new tool.

Publishing a page and registering it are one atomic change. A newly published page must appear immediately on its matching public pillar and in its matching child sitemap:

| Published page | Public pillar | XML sitemap | Registration source |
| --- | --- | --- | --- |
| Tool hub | `/tools/` | `/sitemap-tools.xml` | `data/software-pages.php` → `tool_hubs` |
| Alternatives | `/alternatives/` | `/sitemap-alternatives.xml` | `alternatives/articles/*.php` |
| Review | `/reviews/` | `/sitemap-reviews.xml` | published Reviews post registry entry |
| Pricing | `/pricing/` | `/sitemap-pricing.xml` | `data/software-pages.php` → `pricing` |
| How to use | `/how-to-use/` | `/sitemap-how-to-use.xml` | `data/software-pages.php` → `how_to_use` |
| Comparison | `/compare/` | `/sitemap-compare.xml` | `data/software-pages.php` → `comparisons` |
| Category pillar | `/best/` | `/sitemap-categories.xml` | `data/software-pages.php` → `categories` |

`/sitemap.xml` is the sitemap index. A page is not publishable if it is missing from either its pillar or its child sitemap.

### 8. Run the quality gate

Check factual support, checked dates, originality, banned language, word ranges, primary-keyword uniqueness, metadata, canonicals, breadcrumbs, schema, PHP syntax, tests, internal links, sitemap XML, mobile layout, desktop layout, and the complete diff.

### 9. Publish and verify

Commit and push reviewed changes to GitHub `main`. Wait for Hostinger deployment. Verify the changed live pages, indexes, navigation, canonical URLs, HTTP responses, and sitemap entries. A GitHub commit is not proof of live publication.

### 10. Close the queue row

Mark the row `published` only after live verification. Record the completion date, canonical URLs, commit SHA, checks, and next queue row in `articles/progress.md`. If deployment is pending or blocked, leave the row `in_progress` and report the exact state.

## Ranking principles

- Answer the search question immediately.
- Cover the decision better, not merely longer.
- Use official sources and visible dates for volatile facts.
- Explain who should keep the original tool as well as who should switch.
- Use specific tradeoffs instead of generic praise and criticism.
- Build category depth through connected clusters.
- Avoid keyword cannibalization and duplicate pages.
- Refresh materially changed pricing, limits, and product facts.
- Keep affiliate and sponsored relationships separate from editorial order.
- Never claim testing that did not happen.

## Success measures

Track indexing, impressions, clicks, average position, internal-link coverage, published cluster completeness, stale price facts, and pages with declining performance. Traffic and revenue are outcomes to monitor, not facts the schedule may promise.
