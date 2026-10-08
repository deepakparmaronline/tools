# Publishing progress

User supplied the locked publishing standard on October 8, 2026. The current run prepares one new story using that standard. Existing article URLs are retained.

| Story | Category | Canonical | State | Publication |
|---|---|---|---|---|
| Mistral Large 4: API Routes, Pricing, and Limits | Tech | /tech/mistral-large-4-api-routes/ | Editorial and local QA complete | Published locally; GitHub push awaiting authentication; live verification pending |

Research: announcement and release status, current API prices, direct/gateway context differences, regional feature restrictions, terminology, existing coverage, and current changelog checked against primary sources. Final recency check on October 8 re-opened the current model card, changelog, pricing, and OpenRouter listing; no newer official release or correction affecting the article was found.

QA: complete HTML without breadcrumbs; one H1 and publication date; two static author blocks; original SVG and existing public author photograph; static desktop/mobile TOCs; five real recent articles; matching Article/Person/Organization/FAQ schema; image/social/canonical consistency; internal links; Tech and central content index; homepage discovery; generated sitemap; correct asset bodies/MIME types. PHP lint and publishing/Alternatives integration checks passed. Browser checks at 360px and 1280px confirmed loaded assets, wrapped TOCs, anchor clicks, no horizontal overflow, header/footer navigation, search, and theme.

Remaining: authenticate Git write access and push the reviewed commit to deepakparmaronline/tools; use the existing host deployment path and verify the live article, indexes, and sitemap. HTTPS push access failed with “could not read Username for https://github.com”; the SSH dry run failed with “Permission denied (publickey)”. An existing signed-in GitHub browser session was confirmed, but the available browser interface cannot transfer the complete reviewed file set. The GitHub plugin is not connected. The new article and assets/site.js still return HTTP 404 on production. No successful push or live deployment of this new story is claimed.

Earlier Alternatives batch: all ten articles, their listing, canonicals, related links, and live sitemap were verified on October 8. Homepage, category, and tool navigation include Alternatives; a live Ghostery browser check confirmed its shared styles load.
