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
2. `alternatives list.md`
3. `agents.md`
4. `docs/ALTERNATIVES.md`
5. `articles/progress.md`
6. Existing tool, alternatives, reviews, versus, pricing, category, sitemap, and navigation implementation files that affect the selected tool.

If a required file is missing or unreadable, stop before publishing and report the exact blocker.

## 3. Semrush keyword batch

- Open Semrush Keyword Overview in the signed-in browser session.
- Take the next 100 unfinished keyword rows from `alternatives list.md`, preserving their order.
- Search all 100 keywords in one Keyword Overview batch when Semrush accepts the batch.
- Record the check date, search volume, keyword difficulty, intent, useful variants, and People Also Ask questions that Semrush provides.
- Never invent missing Semrush metrics.
- If Semrush access, login, or the 100-keyword batch is unavailable, do not pretend the research ran. Stop before selecting a new tool and report the blocker.
- Ignore duplicate rows for selection after recording that they are duplicates. Do not delete the source rows.
- Skip a keyword only when its product identity cannot be confirmed, its required facts cannot be verified, or the corresponding content already exists. Record the reason.

## 4. Choose one tool cluster

Choose one tool from the researched 100-keyword batch for the run. Prioritize:

1. Relevant software with a confirmed official site.
2. Strong search volume relative to keyword difficulty.
3. Clear user intent for alternatives, reviews, pricing, how-to, and comparison content.
4. A useful category cluster that can support internal links.
5. Credible future affiliate or sponsored placement potential without changing editorial rankings.

Do not choose by volume alone. Reject unsafe, illegal, piracy, paywall bypass, or non-software intent. If the best candidate is ambiguous or cannot be sourced, mark it `needs_review` and evaluate the next candidate in the same batch.

## 5. Build the complete cluster

Create or update the selected tool's complete cluster according to `seo/content_guide.md`:

- Tool hub
- Alternatives page
- Review page
- Pricing page
- How to use page
- One comparison page selected from Semrush comparison volume, or the top alternatives pick when no comparison keyword has volume
- Category pillar update when the publication threshold is met

Existing legacy Alternatives pages keep their current permanent URLs. Do not rename or remove them. Link them naturally into the new cluster where useful, and do not create duplicate pages that target the same primary keyword.

Use the current site architecture and shared components. Add new reusable routing, templates, registry entries, and sitemap support only when required. Keep facts consistent across every page in the cluster.

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
- Review the complete diff and exclude unrelated changes, credentials, private data, and research debris.

If a check fails, fix it before publishing. If the facts cannot be verified, mark the item `needs_review` in the queue and move to the next candidate.

## 8. Publish and verify

- Commit and push the reviewed cluster to GitHub `main`.
- Verify the live hub, alternatives, review, pricing, how-to, comparison, and category pages that were created or changed.
- Verify the Alternatives, Reviews, and Versus indexes where applicable.
- Verify the homepage navigation still contains Alternatives, Versus, Reviews, and Browse tools by niche, and does not contain ChatGPT, Claude, AI News, Tools Guide, or Tech.
- Verify the live sitemap entries and canonical URLs.
- Never claim live success from a GitHub commit alone.

## 9. Progress and final report

Update the queue or progress record with:

- The 100 keywords checked and the Semrush check date.
- The selected tool and selection reason.
- Duplicate, ambiguous, skipped, and `needs_review` rows.
- Every page created or updated.
- Commit SHA and GitHub link.
- Test, build, sitemap, and live verification status.
- The exact next unprocessed keyword row for the following run.

Keep the final report concise. Report blockers honestly and do not fall back to news publishing.
