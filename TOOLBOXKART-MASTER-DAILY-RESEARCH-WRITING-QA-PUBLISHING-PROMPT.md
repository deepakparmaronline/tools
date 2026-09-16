# TOOLBOXKART — MASTER DAILY RESEARCH, WRITING, QA & PUBLISHING PROMPT

This document is the master operating prompt for ToolBoxKart’s daily research, writing, quality assurance, internal linking, repository review, deployment, and live verification workflow.

## Purpose

Run the complete workflow:

**research → select topics → verify facts → understand search intent → analyze competing coverage → write → edit → source → create/select visuals → internal-link → technical QA → repository QA → deploy → verify live pages**

The goal is to publish exactly five genuinely useful, accurate, well-sourced articles per daily run without manufacturing news, inventing facts, creating thin content, copying competitors, or breaking the existing custom PHP site.

## Full prompt

The complete master prompt is maintained in the source prompt supplied for this repository task. It includes the following mandatory sections:

- Daily automation context and exactly-five-article output
- Editorial pillars and topic-selection priorities
- Reference-pack and source-of-truth rules
- Repository architecture and custom PHP publishing rules
- Category taxonomy and category-listing auto-update rules
- Date/time and freshness-window verification
- Primary-source-first research and fact ledger
- Search intent, topic mapping, SERP research, and information gain
- Article depth and requirements for news, guides, research, model releases, and Google coverage
- Company-claim attribution, benchmark context, mechanics, examples, limitations, and unknowns
- Human writing, non-repetitive structure, no-hype, and editorial style rules
- SEO metadata, canonical, internal linking, two-way linking, sources, and tool-link verification
- Featured-image rights, alt text, and image-performance requirements
- PHP validation, link QA, rendering QA, mobile/desktop QA, blog-listing QA, and sitemap QA
- GitHub change discipline, security, full-diff review, individual article quality gate, and five-article batch quality gate
- Complete daily execution order and final non-negotiable publishing standard

## Non-negotiable operating principle

**Research first. Verify second. Understand third. Plan fourth. Write fifth. Edit like a human sixth. Source and link seventh. Create/select visuals eighth. Technical QA ninth. Batch QA tenth. Publish all five together. Verify live output last.**

Never publish an article simply because an AI system can write it quickly. Accuracy, site stability, research depth, search intent, information gain, human writing, reader usefulness, factual sourcing, internal linking, visual relevance, technical correctness, and SEO all take priority over publication volume.

## Current publishing architecture

- Article source files remain in `/blog/<post-slug>.php`, with metadata in `/data/posts.php`.
- Every article must be assigned exactly one public category: `chatgpt`, `claude`, `ai-news`, or `tools-guide`.
- Public article URLs use `/<category>/<post-slug>`; do not publish new `/blog/<post-slug>` canonicals.
- The category listing pages `/chatgpt/`, `/claude/`, `/ai-news/`, and `/tools-guide/` are generated automatically from `/data/posts.php`. Verify the matching listing after each run.
- ChatGPT and Claude articles belong in their named categories. Other AI-company news belongs in `ai-news`. Tool tutorials, comparisons, workflows and guides belong in `tools-guide`.
- Legacy `/blog/<post-slug>` URLs must redirect to the correct category URL, and `/blog/` redirects to `/chatgpt/`.
- The homepage “Latest practical guides” section displays only the three newest articles; do not use it as the complete article index.
- Article canonicals and sitemap entries must use category-based URLs. Update the registry/source files and generated sitemap logic, never create a separate manual blog listing.
- The shared author attribution is Deepak Parmar, with LinkedIn at `https://www.linkedin.com/in/deepakparmaronline/` and YouTube at `https://www.youtube.com/@deepakparmaronline/`.
- Every article page automatically includes a “Latest published posts” section after the author introduction. It must show exactly three other articles, sorted by publication date descending. Do not add “Recent posts by Deepak Parmar” or duplicate this section inside individual article files.

## Daily article publishing gate

Before declaring a daily run complete, check every article:

1. Its metadata exists in `/data/posts.php` with the correct category, slug, title, description, date and read time.
2. Its category URL returns the intended article page and its canonical matches that URL.
3. Its matching category listing displays the article with the correct title and link.
4. Its legacy `/blog/<post-slug>` URL redirects to the same category URL.
5. The article appears in `/sitemap.xml` with the category-based URL.
6. No article was added to the homepage beyond the newest-three limit.
7. The article page shows exactly three other latest published posts after the author introduction, ordered by publication date.
