# ToolboxKart — Hostinger-ready PHP starter

This package contains a launch-ready multi-category utility website for `toolboxkart.tech`.

## Included in v1

- 20 working browser-based tools across SEO, Marketing, Finance, Healthcare RCM, Developer and Productivity.
- Shared responsive header/footer, mobile navigation, keyboard search (Ctrl/Cmd+K) and light/dark theme.
- Clean extensionless URLs through Apache `.htaccess`.
- Tool pages with unique metadata, visible long-form explanations, FAQs and JSON-LD.
- Category pages generated from a central catalog.
- Blog template with automatic table of contents, author `Deepak Parmar`, published date, read time, About Author, Latest Posts, Recent Posts and BlogPosting schema.
- Three starter articles.
- Privacy, Terms, Disclaimer, About, Contact and custom 404 pages.
- `robots.txt` and `sitemap.xml`.
- `docs/AI-SITE-RULES.md` for future human/AI development.

## Hostinger deployment

Upload the **contents** of this folder to the document root for `toolboxkart.tech` (commonly `public_html`). PHP 8+ and Apache rewrite support are required. Hostinger normally supports `.htaccess` on compatible shared-hosting plans.

Before launch:
1. Point the domain and confirm SSL works.
2. Test `/seo/serp-preview` and several other extensionless URLs.
3. Replace the placeholder Contact page with a real support channel.
4. Review Privacy/Terms/Disclaimer for your business and jurisdictions.
5. If you add analytics or advertising, update privacy/consent implementation first.
6. Submit `https://toolboxkart.tech/sitemap.xml` in the search-engine webmaster tools you use.

## Local development

PHP's built-in server does not read Apache `.htaccess`. You can inspect direct PHP paths locally, for example:

`php -S 127.0.0.1:8765 -t .`

Then open `/seo/serp-preview.php`. Clean public URLs are handled by Apache after deployment.

## Main source files

- `data/catalog.php` — categories and tool registry.
- `data/posts.php` — blog registry.
- `includes/tool-template.php` — shared tool page shell/schema.
- `includes/blog-template.php` — shared post layout/schema.
- `assets/css/app.css` — design system.
- `assets/js/app.js` — shared interactions/search/theme.
- `docs/AI-SITE-RULES.md` — rules for future additions.
