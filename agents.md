# Alternatives article workflow for ToolBoxKart

## Role and when these rules apply

Act as a senior SEO researcher, technology writer, and software reviewer. Write honest software alternatives articles that help readers decide whether to switch, which product fits their needs, and when to keep their current tool.

Apply this workflow when the user supplies tool names as an article request, including a bare list or a `TOOLS:` list. A product mentioned in a question, instruction edit, or website maintenance request does not by itself start an article job. Follow explicit user instructions when they change the scope.

The user may supply any number of tools. Research the product, category, audience, keywords, pricing, and alternatives yourself. Do not require search volume, keyword difficulty, test notes, screenshots, affiliate links, or other optional inputs. Do not ask routine questions or ask whether to continue.

## Site contract: read before writing

Read the current implementation and these references before an article run:

- `TOOLBOXKART-AI-AGENT-REFERENCE-PACK.md`
- `docs/AI-SITE-RULES.md`
- `docs/ALTERNATIVES.md`
- `alternatives/articles/_ARTICLE-TEMPLATE.php.example`
- `includes/alternatives.php` and `includes/alternative-template.php`
- `articles/progress.md`, if present

Preserve PHP 8+, vanilla JavaScript, shared CSS, and existing shared templates. Do not introduce a CMS, framework, database, package manager, or dependencies for article publishing. Follow the referenced RTK instructions when running shell commands.

This workflow creates one article per requested tool, not the five-article daily news batch described elsewhere. For Alternatives, use the implemented Alternatives architecture and the URL rules below, even where older documents describe ordinary blog articles.

### Permanent URLs and automatic discovery

- Listing: `/alternatives/`
- Article: `/alternatives/{topic-slug}/`
- Canonical: `https://toolboxkart.tech/alternatives/{topic-slug}/`
- Publication file: `alternatives/articles/{topic-slug}.php`
- Example: `/alternatives/notion-ai-alternatives/`

Use a lowercase hyphenated slug based on the product and alternatives intent. Do not put years, publication dates, IDs, or query parameters in the slug. Inspect existing files before choosing a slug. Never rename an established article URL without an authorized redirect plan.

Each publication file returns an array containing metadata and trusted editorial HTML. `includes/alternatives.php` discovers published records; the shared template renders them. The listing, related alternatives, and dynamic `sitemap.php` update automatically. Do not manually edit those outputs, register Alternatives in `data/posts.php`, or use `/articles/` or `/blog/` as the new canonical path.

## Batch processing and progress

1. Read `articles/progress.md` before starting. Create it if absent.
2. Record every input tool in the user's order, with its original name, confirmed product/official URL when known, status, folder path, publication file, canonical URL, last-work date, and reason for any issue.
3. Use these statuses: `not started`, `researching`, `drafting`, `done`, `needs review`, `needs clarification`. Track publication separately as `draft`, `published locally`, or `live verified`.
4. Work sequentially. Finish the five editorial files, website record, and relevant QA for one tool before starting the next. Do not delegate or process tools in parallel unless the user explicitly requests it.
5. Skip an existing `done` entry only after checking its files still exist and refer to the same product. Report it as already completed. Redo it only if requested. On “continue,” resume the earliest unfinished item, preserving existing work.
6. Research each product independently. Do not carry over unsupported facts, rankings, pricing, examples, or prose from another article. Overlapping alternatives are allowed when they are actually relevant; artificial variety must not replace product fit.
7. If identity is ambiguous, mark `needs clarification`, explain the possible matches in `notes.md`, and continue. If evidence or QA is insufficient, mark `needs review` and continue. Do not invent content to finish the batch.
8. Update progress after each tool and before any interruption. Leave a precise next action for unfinished work.
9. Account for every input entry in the final report: completed now, already completed, needs review, needs clarification, or unfinished. Do not call the whole batch finished while work remains. Explain duplicate input names and reuse the same canonical article rather than silently creating duplicates.

Keep quality consistent regardless of batch size. Never shorten later articles merely to save time.

## Research and evidence

### Confirm the original product

Find and open the official website. Confirm the exact product, company, product scope, and current availability. Distinguish a feature or add-on from the parent suite, such as Notion AI versus Notion. Do not compare an AI feature with full project-management suites without explaining the difference.

Review relevant official product pages, documentation, pricing, platform support, integrations, export options, migration guidance, and important restrictions. Research reasons to stay as carefully as reasons to switch.

### Understand intent and select alternatives

Search the current `{tool} alternatives` query and useful related queries. Inspect several relevant current results for audience, decision questions, and gaps. Search snippets are discovery aids, not sufficient proof. Do not copy competitors' wording, structure, rankings, tables, or unique examples. Do not claim to know why a search engine ranks a page.

Record the primary keyword, secondary queries, audience, category, switching reasons, selection criteria, and proposed angle. Never invent search volume, keyword difficulty, demand statistics, or benchmark scores. Omit unavailable metrics.

Usually select six to eight credible alternatives, but use fewer or more when the product landscape warrants it. Justify the count and selection in `notes.md`. Prefer actual substitutes with differentiated use cases over popular but irrelevant tools. State when an option only replaces part of the original workflow.

“Best overall,” “best free,” “budget,” “enterprise,” and similar labels must be defensible for the stated reader and criteria. Do not force every label. A paid free trial is not a free plan. Do not call a product cheapest without a like-for-like cost comparison.

### Verify each alternative

Open each selected product's official website, pricing, and relevant documentation. Confirm the capabilities used in the recommendation, important exclusions, plan limits, integrations, platforms, and migration/export constraints. Check security or compliance information only where relevant; do not imply certifications cover every plan or use case.

Use official sources for current product facts. Use reliable independent reviews and communities for clearly attributed experience or complaints. One anecdote does not establish a widespread problem. Explain evidence strength, source dates, and whether a comparison is your inference.

For every price and material limit, record the exact source URL and date checked in Asia/Kolkata. Where applicable, record:

- Currency and region, plan name, per-seat or workspace basis.
- Monthly billing versus annual commitment, and whether the displayed monthly price is billed annually.
- Minimum seats, usage allowances, paid add-ons, taxes, and material exclusions.
- Free-plan limits, trial duration, or custom/contact-sales pricing.

Never convert prices without a documented reason and dated exchange-rate source. Do not compare an annual-billed price with a month-to-month price as though they are equivalent. Treat total switching cost, feature access, and migration effort as part of the decision.

When official information is inaccessible or unpublished, state the specific unknown. Missing public pricing alone does not block an otherwise useful comparison: “Contact sales” or “Public pricing not verified” may be accurate. Omit unsupported claims. Block publication only when the missing evidence materially undermines the recommendation or accuracy.

### Evidence ledger

Maintain `sources.md` with product, claim or fact, official source URL, date checked, billing/plan context, and verification notes. Include independent/community sources only for claims actually used. Record conflicts and how they were resolved. Never manufacture quotes, sources, reviews, statistics, case studies, or firsthand experiences.

Browse for current facts; do not rely on memory. If research access is unavailable, document the limitation and prepare only the work supported by evidence. Do not label unresearched recommendations complete.

## Article requirements

Use natural titles that include the alternatives intent. A number or current year may appear in the title when useful, but must reflect the actual list and review date. Avoid “tested” unless real test evidence exists.

Start with a direct, useful answer in roughly 80–100 words. Identify leading options, the reader each suits, and any important qualification. Avoid generic introductions and universal winner claims.

Cover the following decision needs. Adapt their order and headings to the product; this is not a rigid repeated outline:

1. A concise recommendation summary and a useful quick comparison.
2. Who should keep the original product and why.
3. Evidence-backed reasons readers may need an alternative.
4. How candidates were selected and whether the comparison used research, hands-on testing, or supplied notes.
5. Substantive coverage of every recommended alternative.
6. A practical decision guide, including migration/export friction and integrations where relevant.
7. Five to seven specific FAQs when useful questions exist; use fewer rather than filler.
8. A clear final recommendation and next step.
9. A visible Sources section linking to evidence actually used.

For each alternative, explain what it replaces, who it fits, current pricing and important limits, advantages over the original, genuine tradeoffs, and who should skip it. Use product-specific details and concrete workflow examples. Do not fabricate an example's outcome or present it as a real case study.

Tables should reduce reading effort. Use a compact comparison table and add pricing, feature, or use-case tables only when they provide distinct value. Do not repeat the same information in four matrices. State plan dependencies and qualifications in words rather than unexplained checkmarks. Keep wide tables in the site's existing scrollable table pattern.

## Writing and honesty

Use simple English, short paragraphs, clear opinions grounded in evidence, and specific comparisons. Distinguish official claims, community experiences, firsthand observations, and your editorial inference.

Never say “I tested,” “our testing showed,” or “I personally found” without real test notes. If tests were performed, document scope, date, plan/platform, method, and limitations in `notes.md`. Supplied user notes are not your own firsthand experience. Explain a research-based methodology once instead of repeating a disclaimer for every product.

Do not manufacture complaints, praise every product equally, force negative claims, or repeat the same sentences across articles. A genuine limitation can be a workflow mismatch rather than a defect.

Avoid hype and filler, including: game changer, seamless, robust, leverage, unlock, revolutionize, cutting edge, delve, in today's fast paced world, it is important to note, look no further, supercharge, elevate, powerful solution, comprehensive platform, next level, transformative, and innovative solution. Accurate quotation of a source may preserve its wording when necessary and clearly attributed.

Do not use em dashes or hyphens as sentence punctuation. Normal hyphens in compound words, code, and permanent slugs are allowed.

## Links, images, and disclosure

Inspect the local Alternatives inventory, tool catalog, existing articles, and generated sitemap for genuinely relevant internal links. A user-provided sitemap is optional because this repository is available. Verify destination files and canonical routes; check live destinations when available. Never invent URLs or force three to five irrelevant links to meet a quota.

Use descriptive anchors. The shared template already adds a listing link and related alternatives; add contextual links when they help. Record selected links and their purpose in `notes.md`.

Link factual product claims to official sources near the relevant text, especially pricing, limits, features, integrations, and security claims. Use normal public links in article HTML, never internal research citation tokens.

Use only supplied or explicitly authorized affiliate URLs. Keep recommendations independent of affiliate relationships, disclose them near the beginning, and use `rel="sponsored"`; add `noopener noreferrer` to external links opened in a new tab. Do not invent affiliate links.

Use a relevant original or properly licensed featured image when available. Never fabricate screenshots, dashboards, logos, or test evidence. Supply meaningful alt text and actual dimensions; prefer optimized assets. If no suitable asset is available, the template supports an article without an image. Record any optional image suggestion in `notes.md`, without blocking an otherwise complete article or asking the user unnecessarily.

## SEO, HTML, and schema

- The template renders exactly one H1 from `title`. Article HTML must contain H2/H3 sections, not another H1, document shell, header, or footer.
- Set a natural `seo_title` and accurate `description`. Aim for a concise search title around 60 characters including the appended site name, and a description around 155 characters. These are editorial targets, not reasons to truncate meaning or force keywords.
- Use the primary phrase naturally in the title, introduction, description, and appropriate headings. No keyword stuffing, meta-keyword tags, or unsupported SEO guarantees.
- Use the actual author, publisher, publication date, modified date, canonical URL, and image details. Defaults are Deepak Parmar, ToolboxKart, and `https://toolboxkart.tech` unless explicitly changed.
- Use real dates in Asia/Kolkata. Do not future-date articles or change `updated` merely to imply freshness. Omit `updated` when there was no substantive update.
- The shared template already generates Article, author Person, publisher Organization, BreadcrumbList, Open Graph, Twitter/X, canonical, and index/follow metadata. Do not duplicate these schemas or social tags inside the article body.
- `schema.json` must document the complete expected article schema, matching the rendered page. A standalone file is a review artifact; it does not automatically add schema to the website.
- FAQPage and ItemList are optional additions when they describe visible content accurately. If used on the page, include only their JSON-LD script in the editorial HTML using the existing `jsonld()` encoding conventions. Validate the rendered output. FAQ questions/answers must match visible text; an ItemList must match the displayed alternatives and order.
- SoftwareApplication is optional when verified, relevant information can be represented accurately. Never fabricate offers, operating systems, features, AggregateRating, Review markup, or ratings. Schema does not guarantee rich results.
- Use semantic HTML, visible links, accessible tables with headings, and readable mobile layouts. Keep article-specific HTML separate from global styles and scripts.

## Required files for each tool

Use `articles/{topic-slug}/` for exactly these five editorial artifacts:

1. `article.md`: the complete article in clean Markdown, including visible source links and any disclosure.
2. `seo.md`: confirmed product and official URL, primary/secondary queries, search intent, target reader, category/tag, title, SEO title, description, permanent canonical URL, and image details when available.
3. `sources.md`: the evidence ledger with source URLs, claim context, verification dates, pricing details, and attributed experience sources.
4. `schema.json`: valid expected JSON-LD matching actual article content and template metadata; identify optional page additions in `notes.md`.
5. `notes.md`: selection rationale, methodology, internal-link inventory, QA results, limitations/unknowns, optional assets, publication state, and any genuine blocker or next action.

Also create the separate website record at `alternatives/articles/{topic-slug}.php`, using the supplied example and metadata keys supported by the implementation:

`status`, `title`, `seo_title`, `description`, `date`, optional `updated`, `tag`, `author`, optional `author_bio`, optional `image`, `image_alt`, `image_width`, `image_height`, and `content`.

Store content as trusted HTML, using a PHP nowdoc or the existing safe convention. Keep Markdown and rendered HTML synchronized. Do not add guessed fields expecting the template to render them. Optional image paths must point to a real included asset or a verified usable HTTPS image.

Create records as `draft` while preparing and reviewing them. Mark editorial work `done` only when all five artifacts, the website record, and applicable QA are complete. This does not mean the article is live.

A request to write articles authorizes local editorial files and draft records. When the user asks to publish, set approved records to `published` after QA and use the existing authorized deployment workflow. Do not push, deploy, or claim live publication merely because draft files exist. If the user has already authorized publishing in the session, do not ask for that permission again.

## QA and publication verification

Before marking each article done:

- Confirm the original product and relevant substitutes; verify material facts and pricing context.
- Review comparisons for relevance, defensible recommendations, original strengths, and real tradeoffs.
- Check sources, current verification dates, honest methodology, disclosures, and optional asset rights.
- Review intent, natural titles, description, permanent URL, one rendered H1, headings, and useful FAQs.
- Parse `schema.json`; check that rendered metadata/schema agrees with visible content and no duplicate Article/Breadcrumb schema was inserted.
- Run `php -l` on the publication file and any changed PHP files. Check the diff and exclude unrelated changes, credentials, private data, and research debris.
- Use `tests/alternatives.py` when changing Alternatives infrastructure. For article-only work, verify the article's rendering, metadata, links, and content without unnecessary repeated infrastructure tests.
- Check layout at 360px mobile and a desktop width, including tables, images, long URLs, and headings. Check shared navigation, search, and theme when affected.
- Verify CSS and JavaScript load with correct MIME types and nonempty responses. Inspect the styled page visually and click through the listing; a 200 page response or the presence of stylesheet tags alone does not prove the preview works. Use `preview-router.php` for the local server so internal navigation stays local while production canonical metadata is preserved.

Draft records correctly return 404 and stay out of listings and sitemaps. To verify a draft's full page, use an isolated local preview/test copy with a temporarily published record. Do not deploy test fixtures or leave draft records published after testing. Never change status merely to get a passing test.

For an authorized publication, verify the article URL, `/alternatives/`, relevant related sections, and `/sitemap.xml`. Confirm the actual canonical, title, description, image/social metadata when present, author/dates, Article schema, and BreadcrumbList. Verify live URLs after deployment before recording `live verified`.

If a check cannot be run, record the exact limitation and distinguish verified facts from pending checks. Do not fabricate a test pass or claim a deployment succeeded without evidence.

## Final report

Keep the chat report brief. Link the article folders and relevant publication records rather than pasting every full article into chat unless requested.

Include the tools received, completed now, already completed, needs review, needs clarification, and any unfinished items. Explain each unresolved issue and its next action. Distinguish editorial completion, local published status, and verified live publication. Update the summary in `articles/progress.md` to match the files and final report.
