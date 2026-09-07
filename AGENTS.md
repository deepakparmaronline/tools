# AGENTS.md — ToolboxKart coding-agent entry point

Before changing this repository, read `README.md` and `docs/COMPETITOR-RESEARCH.md`.

Critical rules:
1. Public pages must contain visitor-facing copy only. Never expose architecture notes, AI instructions, competitor names, research notes, TODOs, or internal implementation commentary.
2. Before adding or materially redesigning a tool, research current live rivals and record the observed inputs/workflow in `docs/COMPETITOR-RESEARCH.md`.
3. Categories are open-ended. Add a category to `registry/categories.php`; do not assume the current categories are permanent.
4. Every published tool gets its own physical `/<category>/<slug>/` folder with `index.php`, `tool.php`, `form.php`, and `tool.js`.
5. Initial page content and SEO must be server-rendered PHP. Tool interaction should be browser-side when practical.
6. Use the shared current design system; do not resurrect previous ToolboxKart themes.
7. Do not publish a tool until its inputs, formulas/spec, edge cases and privacy path have been checked.
