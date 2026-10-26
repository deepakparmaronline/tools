CONTENT GUIDE FOR THE ALTERNATIVES SITE

1. THE GOAL
   Every page must help a real person choose or use a software tool. Pages must be accurate, useful and honest. We rank by being better than the pages that rank today, not by publishing more pages.

2. WRITING STYLE

- Simple English. Short sentences. Plain words.
- Answer first. Put the answer in the first 2 or 3 sentences.
- No em dashes. Do not use hyphens as punctuation.
- No filler. Never use: delve, game changer, in today's fast paced world, unlock, seamless, robust, leverage, landscape, it is worth noting, in conclusion.
- One idea per paragraph. Paragraphs of 1 to 3 sentences.
- Use tables for comparisons and prices. Use bullets for pros and cons.
- Use the current year from the system date in titles when a year helps. Update it when content is refreshed.
- Write fresh sentences. Never copy text from any website. Do not quote more than a few words.

3. HONESTY AND SOURCES (MOST IMPORTANT)

- Take facts only from the tool's official website, pricing page, help center, documentation and changelog.
- Open the official pages every time. Do not rely on memory.
- Next to every price, limit or plan detail, add "Checked on [date]" and link the official source.
- Never write "we tested", "I used", "in our testing" or "hands on" unless the site owner confirmed real testing of that tool. Write "Based on the official pricing page and documentation checked on [date]" instead.
- Never invent screenshots, ratings, scores, user counts, customer quotes, discounts, or pros and cons you cannot support from a source.
- If a fact cannot be verified, leave it out. If it is important, write "Check the official site" and link it.
- Do not add Review or AggregateRating schema unless ratings come from real testing.
- If affiliate links are added later, use rel="sponsored" and show a clear disclosure near the top.

4. PAGE TYPES AND TEMPLATES
   Each tool has 6 pages. Each page has one primary keyword. No two pages share a primary keyword.

A. Tool hub page: /tools/[tool]/
Length 500 to 900 words. Content: what the tool is, who it is for, a quick facts table (category, starting price, free plan, best for), and one line plus a link for each page: review, pricing, how to use, alternatives, comparison, category page. Do not copy text from the review page.

B. Alternatives page: /tools/[tool]/alternatives/
Primary keyword: "[tool] alternatives". Also cover "[tool] alternative", "free [tool] alternative", "[tool] competitors". Length 1,800 to 2,800 words. Order:

1. H1 with the year.
2. First screen: a 2 to 3 sentence answer, then the top 3 picks, each with a "Best for" label.
3. Quick comparison table in real HTML: tool, best for, starting price, free plan, standout feature.
4. Why people look for a [tool] alternative. Base it on documented limits, pricing and missing features.
5. Each alternative (6 to 10): best for, what it does, price from, pros, cons, who should skip it, and a link to its review page if it exists.
6. Migration: what can be imported or exported, from official docs.
7. How to choose: 4 to 6 simple rules.
8. FAQ: 4 to 6 questions from People Also Ask data in Semrush.
9. Checked on date, method note, disclosure.

C. Review page: /tools/[tool]/review/
Primary keyword: "[tool] review". Length 1,500 to 2,200 words. Order: verdict first (3 sentences), summary box (best for, price from, free plan, main limit), what the tool does, key features (5 to 8), pricing summary with a link to the pricing page, pros and cons, who it fits, who should skip it, short alternatives section linking to the alternatives page, FAQ, checked on date.

D. Pricing page: /tools/[tool]/pricing/
Primary keyword: "[tool] pricing". Length 800 to 1,400 words. Content: plan table (plan, price, billing, key limits, best for), what is free, what costs extra, which plan fits which person, saving tips only if official, a link to the alternatives page for cheaper options. Checked on date and source link.

E. How to use page: /tools/[tool]/how-to-use/
Primary keyword: "how to use [tool]". Length 1,200 to 2,000 words. Order: what you need first, quick setup (numbered steps from official docs), common tasks, tips, common mistakes, troubleshooting, links to docs, link to the review. Include only steps you can confirm in the docs.

F. Comparison page: /compare/[tool]-vs-[other]/
Primary keyword: "[tool] vs [other]". Choose the other tool by the best "X vs Y" volume in Semrush. If none has volume, use the top pick from the alternatives page. Length 1,500 to 2,200 words. Order: verdict first, quick table, then sections for pricing, features, ease of use, integrations, support and best for. Then "Choose [tool] if" and "Choose [other] if". Link to both reviews, pricing pages and alternatives pages.

G. Category page (pillar): /best/[category]/
Primary keyword: "best [category] software". Length 2,000 to 3,200 words. Order: answer first with top picks, comparison table, how the list is chosen (based on sources, no testing claims), a short blurb for each tool with links to its hub and alternatives page, how to choose, FAQ. Create it only when the category has at least HUB\_MIN\_TOOLS published tools. Update it every time a new tool is added to the category.

5. META AND ON PAGE

- One H1. Title under 60 characters. Meta description 140 to 160 characters, plain, with the keyword.
- Slug: lowercase, short, no dates, no stop words unless needed.
- Visible "Last updated" date. Breadcrumbs on every page. Canonical tag on every page.
- JSON LD schema: Article (with author and dates) and BreadcrumbList on all pages. SoftwareApplication on the tool hub with no rating. ItemList on alternatives and category pages. FAQPage is optional.
- Images: only use images the site owner provided or simple diagrams you create. Add alt text. No tool logos unless provided.

6. WRITING FOR AI SEARCH

- Start each H2 with a 1 to 2 sentence answer that stands alone.
- Put facts in tables: plan, price, limit.
- Use the tool's exact official name every time.
- Keep facts the same across all pages of a tool.
- Date every fact. Link to official sources.

7. INTERNAL LINKING

- Every page links to its tool hub, the category page (if live), and 2 sibling pages of the same tool.
- The tool hub links to all 5 sibling pages and the category page.
- Review, pricing, how-to, alternatives and comparison pages must cross-link naturally to the relevant live pages in the same cluster. A review should link to the hub, pricing, how-to, alternatives and comparison where relevant. Pricing and how-to pages should link back to the review and alternatives pages, plus the hub and comparison when useful.
- An alternatives page links to the review page of every alternative that exists on the site. Do not link to pages that do not exist.
- The category page links to the tool hub and alternatives page of every tool in the category.
- When a new tool goes live: go back through live pages in the same category. Where a page mentions the new tool, add a natural link. Add the tool to the category page. Update any alternatives page that lists the tool.
- 3 to 8 internal links in the body of each page. Descriptive anchor text. Vary the anchors.
- No orphan pages. Every page is reachable within 3 clicks of the home page.

8. XML SITEMAP RULES

- /sitemap.xml is a sitemap index. It lists: sitemap\_tools.xml, sitemap\_alternatives.xml, sitemap\_reviews.xml, sitemap\_pricing.xml, sitemap\_how\_to\_use.xml, sitemap\_compare.xml, sitemap\_categories.xml, sitemap\_pages.xml (home, about and other static pages).
- Use the site's own sitemap generator if it has one. If not, write a small script and run it in the build.
- List only URLs that are live, return 200, are indexable, and use the canonical URL.
- Add a URL only when the page goes live.
- lastmod is the date the main content really changed. Do not set it to today for every page.
- Max 50,000 URLs and 50 MB per file.
- robots.txt must contain: Sitemap: https\://[domain]/sitemap.xml
- After each change, check that the XML is valid.
  Owner step (manual): submit /sitemap.xml in Google Search Console once.

9. QUALITY GATE
   Before every pull request or commit, check:

- Every fact has a source link and a "Checked on" date.
- No banned phrases, no em dashes, no fake testing claims.
- Word counts are in range. Do not pad.
- No text copied from other sites. No large repeated blocks between pages of the same tool.
- Each page has a unique title, meta description and primary keyword.
- All internal links work. The build passes.
- The sitemap is updated and valid. If a check fails, fix it. If the tool facts cannot be verified, do not publish the tool. Mark it "needs\_review" in the queue and move to the next tool.   |&#x20;
