# Locked publishing standard: implementation

The user-supplied standard is preserved in `docs/PUBLISHING-STANDARD.md`. It supersedes older article instructions where they conflict. Existing indexed URLs are retained; the October 8 run adds one new story rather than migrating the historical article library.

New general articles use a complete HTML document under their category directory, for example `tech/mistral-large-4-api-routes/index.html`, with canonical `/tech/mistral-large-4-api-routes/`. Article content, author blocks, dates, heading IDs, desktop/mobile TOCs, recent links, sources, and metadata/schema are directly in the HTML. Nothing fetches or generates those elements in the browser.

`assets/site.js` supplies shared header/footer navigation across the site. Existing tool search, theme, and menu interactions remain in `assets/js/app.js`. The new article uses its own body/TOC selectors, so the legacy JavaScript TOC routine does not generate its article UI. PHP pages and standalone articles include a `noscript` navigation fallback. Tool interfaces and existing article routes retain their current PHP implementations.

New standalone metadata is registered in `data/post-*.php` with `category` and `standalone => true`. `post_url()` supplies the trailing-slash canonical. `/tech/`, the homepage, `/content/`, and `sitemap.php` discover the new record. `sitemap.xml` is refreshed by running the existing PHP generator, rather than editing generated URL entries manually.

`tools/build-mistral-article.py` is the source for this article and its five editorial artifacts. Run it with the truthful original publication timestamp when rebuilding; do not replace the timestamp to imply freshness. It requires Python Markdown in the editorial environment, not on the web host. PHP/Apache and vanilla browser assets remain the site's runtime stack.

Featured illustration: original standalone SVG with title/description and no external dependencies. Author photograph: unchanged JPEG from the repository owner's existing public GitHub avatar, at the path the owner requested. Author profile: `/about-deepak-parmar/`. No synthetic portrait or test screenshots were created.

Local preview: `php -S 127.0.0.1:8765 preview-router.php` from the repository root. The preview keeps internal links and assets local while preserving production canonicals and social/schema URLs.

Checks: `python3 tests/publication.py` against that running preview validates raw complete HTML, author/date counts, heading IDs and TOCs, five actual recent destinations, internal links, matching FAQ/schema and image metadata, indexes, sitemap, asset response bodies/MIME types, and canonical redirects. `python3 tests/alternatives.py` verifies affected legacy infrastructure with isolated temporary fixtures. Browser checks cover 360px mobile and 1280px desktop, image loading, TOC wrapping and anchor clicks, navigation, search, and theme. Apache rewrite execution and live publication still require verification on the production host.
