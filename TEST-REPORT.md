# ToolboxKart Fresh Build — Final Test Report

Build date: 2026-09-07

This report applies to the completely fresh ToolboxKart build in this archive. The previous ToolboxKart theme/build was not used as the implementation base.

## Inventory

- 42 published tools
- 10 current categories (taxonomy is expandable)
- 42 physical `tool.php` files
- 42 physical `form.php` files
- 42 physical per-tool `tool.js` files
- 204+ project files before this report was added
- 58 public URLs in generated sitemap

## Rival research

- Current multi-tool rivals and specialist calculators were researched before defining the new build.
- Internal design findings: `docs/DESIGN-RESEARCH.md`
- Tool-by-tool input/workflow findings: `docs/COMPETITOR-RESEARCH.md`
- Rival/research content is not rendered by public templates.

## Automated checks

### PHP
- All PHP files linted with `php -l`.
- Result: 0 syntax failures.

### JavaScript
- All JavaScript files checked with `node --check`.
- Result: 0 syntax failures.

### Architecture validation
`php tests/validate.php`
- 42 tools discovered.
- Required physical tool files checked.
- Competitor research metadata checked.
- Result: PASS.

### Formula smoke tests
`node tests/formula-smoke.js`
Known-answer tests passed for:
- EMI
- GST
- ROI
- BMI
- BMR metric
- BMR imperial
- Profit margin
- Break-even
- Commission
- AI API cost
- Ohm's law
- Voltage divider
- Electrical power

Result: 13/13 PASS.

### SSR/rendering
A local PHP server rendered the homepage, all supporting public pages, all category pages and every tool page.
- Public routes tested: 58
- HTTP/render failures: 0
- PHP warnings/fatal errors in rendered HTML: 0

### Form-to-JavaScript consistency
Every tool JavaScript reference using `H.v`, `H.n`, `H.optN`, `H.checked` or `H.file` was checked against IDs in the server-rendered form HTML.
- Missing input IDs: 0

### Public-copy firewall
Rendered public HTML was checked for internal phrases including registry, competitor research, AGENTS/README/config references, coding-agent notes and architecture language.
- Internal/developer-copy leaks: 0

### Sitemap / robots
- `sitemap.php` output parsed successfully as XML.
- Sitemap URLs: 58
- `robots.php` contains crawler rules and Sitemap directive.

## Deployment checks still required on the real host

After extracting on the production Apache/PHP host:
1. Confirm `/sitemap.xml` and `/robots.txt` rewrites work under Apache `mod_rewrite`.
2. Confirm HTTPS and the production hostname generate the expected canonical URLs.
3. Update `TBK_CONTACT_EMAIL` in `config.php`.
4. Check representative pages on mobile and desktop browsers.
5. Confirm the host respects the `.htaccess` rules that block direct HTTP access to internal docs, registries, includes, partials and tool metadata/forms.

## Browser-only tools
Image processing relies on browser Canvas/File APIs and should receive a final manual production-browser check with real JPG/PNG/WebP samples after deployment. The code is syntax-checked and the page/form wiring is validated, but binary browser-file behavior is intentionally not misrepresented as fully end-to-end tested by the CLI suite.
