# ToolboxKart — Fresh Production Build

This repository is a brand-new ToolboxKart implementation created from a blank directory on 2026-09-07. It does not depend on or intentionally reuse the prior ToolboxKart theme/build.

## Public architecture
- PHP 8.1+ server-rendered pages.
- Physical tool folders: `/<category>/<tool>/index.php`, `tool.php`, `form.php`, `tool.js`.
- Browser-side tool execution wherever practical.
- Shared visitor shell: `partials/header.php`, `partials/footer.php`, `assets/theme.css`.
- Shared JS helpers: `assets/tool-core.js`.
- Category registry: `registry/categories.php`. Categories are not fixed.
- Tool index: `registry/tools.php`.
- Clean directory URLs; no `.php` in normal public tool URLs.
- Dynamic `/sitemap.xml` and `/robots.txt`.

## Current inventory
42 published tools across 10 current categories. Current categories are examples, not a product limitation. Future categories can include AI agents, civil/mechanical engineering, legal utilities, science, cybersecurity, DevOps, operations, logistics, construction or other useful domains.

## Mandatory workflow for every new tool
1. Identify the real user task.
2. Search the current web for several live competitors before coding.
3. Record what inputs, modes, outputs and friction patterns they use in `docs/COMPETITOR-RESEARCH.md`.
4. Check authoritative specifications/formulas when the tool is accuracy-sensitive.
5. Decide the ToolboxKart workflow. Learn from rivals, but do not copy their design or wording.
6. Create a physical tool directory with `index.php`, `tool.php`, `form.php`, `tool.js`.
7. Render title, introduction, form shell, supporting explanation and related tools server-side.
8. Keep user data in-browser whenever possible. If server-side fetching/uploading is genuinely required, document the data path and implement security controls first.
9. Test normal values, boundaries, missing input, invalid input and at least one known-answer case.
10. Add to the registry only when ready to publish.

## Public-copy firewall
Internal text must NEVER appear on a live page. This includes phrases about registries, architecture, future categories, AI agents working on the code, competitor research, developer instructions or deployment notes. The public site is for visitors. Development documentation stays in README/AGENTS/docs only.

## Design system
The current design is a fresh light product UI: white surfaces, soft gray canvas, indigo primary action, teal secondary accent, large searchable homepage and high-contrast tool workspaces. Do not reintroduce any old dark/yellow ToolboxKart styling unless the owner explicitly asks for a redesign.

## Deployment
1. Point a PHP 8.1+ Apache site/document root at the extracted folder.
2. Ensure `mod_rewrite` is enabled for `/sitemap.xml` and `/robots.txt`.
3. Change `TBK_CONTACT_EMAIL` in `config.php`.
4. Serve over HTTPS.
5. Test `/`, `/tools/`, one category, several tools, `/sitemap.xml`, `/robots.txt`.

## Adding a category
Create a key in `registry/categories.php` and a physical `/<category>/index.php` using the existing category-page pattern. Do not hard-code assumptions that only the current categories exist.

## Tool metadata
`tool.php` holds only metadata and internal research data. `includes/render-tool.php` deliberately does not render the research field. Competitor information belongs in internal docs, never public HTML.

## Safety/security
- Prefer browser-only processing.
- Never evaluate arbitrary user code with `eval`.
- Sanitize any user-derived HTML before rendering.
- If a future backend tool fetches URLs, protect against SSRF/private network access and enforce size/time limits.
- JWT decoding must never be described as signature verification.
- Health/financial/engineering outputs include context disclaimers.

## SEO
- Unique SSR title/description/canonical per tool.
- WebApplication schema on tool pages plus BreadcrumbList.
- Category pages use ItemList schema.
- FAQ schema is intentionally not emitted.
- Related tools are ordinary server-rendered anchor links.
- Do not produce thin location/query variants.
- Content sections should exist because they help the task, not to hit a word count.

## Rival design research
Before changing the public visual system, read `docs/DESIGN-RESEARCH.md`. It records the 2026 competitor UX benchmark and, importantly, what ToolboxKart chose **not** to copy.

## Repository map
```text
/
├── index.php                 Homepage
├── tools/                    Complete tool directory
├── <category>/               Category page + physical tool folders
│   └── <tool>/
│       ├── index.php         Physical SSR entry page
│       ├── tool.php          Metadata/content + non-rendered research
│       ├── form.php          Tool-specific server-rendered form
│       └── tool.js           Tool-specific browser logic
├── assets/
│   ├── theme.css             Current fresh design system
│   ├── site.js               Site search behavior
│   └── tool-core.js          Shared safe UI/result helpers
├── includes/                 SSR helpers and shared renderers
├── partials/                 Header/footer
├── registry/                 Category and published-tool indexes
├── docs/                     Internal research only
├── tests/                    Validation and formula smoke tests
├── AGENTS.md                 Coding-agent entry rules
├── sitemap.php               Source for /sitemap.xml
└── robots.php                Source for /robots.txt
```
