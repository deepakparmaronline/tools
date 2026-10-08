# Alternatives batch progress

Requested 2026-10-08. Publication authorized by the user. Work is sequential.

| # | Requested tool | Product / official URL | Status | Editorial folder | Website record | Canonical | Last work | Publication | Issue / next action |
|---|---|---|---|---|---|---|---|---|---|
| 1 | Hera | https://hera.video/ | done | articles/hera-alternatives/ | alternatives/articles/hera-alternatives.php | /alternatives/hera-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 2 | Pearl | https://hellopearl.com/ | done | articles/pearl-alternatives/ | alternatives/articles/pearl-alternatives.php | /alternatives/pearl-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 3 | Vector | https://vector.ethanlipnik.com/ | done | articles/vector-alternatives/ | alternatives/articles/vector-alternatives.php | /alternatives/vector-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 4 | Shadow | https://www.shadow.do/ | done | articles/shadow-alternatives/ | alternatives/articles/shadow-alternatives.php | /alternatives/shadow-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 5 | UPDF | https://updf.com/ | done | articles/updf-alternatives/ | alternatives/articles/updf-alternatives.php | /alternatives/updf-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 6 | Leave Me Alone | https://leavemealone.com/ | done | articles/leave-me-alone-alternatives/ | alternatives/articles/leave-me-alone-alternatives.php | /alternatives/leave-me-alone-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 7 | Orion Browser ✴︎ | https://orionbrowser.com/ | done | articles/orion-browser-alternatives/ | alternatives/articles/orion-browser-alternatives.php | /alternatives/orion-browser-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 8 | Ghostery | https://www.ghostery.com/ | done | articles/ghostery-alternatives/ | alternatives/articles/ghostery-alternatives.php | /alternatives/ghostery-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 9 | Arc Search | https://arc.net/search | done | articles/arc-search-alternatives/ | alternatives/articles/arc-search-alternatives.php | /alternatives/arc-search-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |
| 10 | Freedom | https://freedom.to/ | done | articles/freedom-alternatives/ | alternatives/articles/freedom-alternatives.php | /alternatives/freedom-alternatives/ | 2026-10-08 | live verified | Live URL, canonical, listing, related links, and sitemap verified |

## Batch summary

Local navigation fix: Alternatives cards and related cards use same-origin paths. The repository's preview-router.php keeps other internal article links and assets local while preserving production canonical/schema URLs. All ten articles and the Alternatives menu on the homepage, category, tool, and existing article pages were checked on the local preview.

Follow-up visual fix: the temporary router wrapper swallowed PHP's static-file return value, producing empty CSS/JavaScript responses with HTTP 200. Corrected the wrapper and restarted the preview directly with preview-router.php. Verified nonempty CSS/JavaScript responses with correct MIME types, styled Ghostery desktop rendering, the 360px mobile menu and listing, search, theme switching, and all ten local article routes. The integration checks now reject empty or incorrectly typed assets. Earlier route-only verification was insufficient to establish visual correctness.

Ten tools received; ten articles completed and live verified on October 8, 2026. All ten canonical URLs return HTTP 200 with one H1, the expected canonical, a description, Alternatives header navigation, and related links. The live listing shows all ten and the live sitemap includes all ten. The homepage, ChatGPT category, and SERP Preview tool page include Alternatives in their header. Live CSS and JavaScript responses are nonempty with correct MIME types. A browser review confirmed styled Ghostery rendering. No items need editorial review, clarification, or deployment.
