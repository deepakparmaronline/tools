# ToolBoxKart Search Research Snapshot

## Saved research

The complete one-time Semrush US research is stored in `alternatives list.md` under `Semrush research snapshot: 2026-10-24`.

That snapshot contains all 324 unique supplied keywords. It records search volume, 12-month trend, intent, keyword difficulty, CPC, SERP features, the saved Keyword Overview report link, and editorial status. Semrush returned 323 result rows. `Orion Browser ✴︎ alternative` was checked separately and had no current metrics.

`seo/tool_publishing_queue.md` is the fixed priority order prepared from that snapshot. It is the only file that chooses the next tool.

## Scheduled-run rule

The recurring 8 PM publisher must not open, sign in to, or run Semrush. It must not run new keyword batches, refresh a keyword, or change the queue order.

For the selected queue row, the scheduled run must use:

1. The fixed tool and order in `seo/tool_publishing_queue.md`.
2. The matching full metric row in the Semrush snapshot in `alternatives list.md`.
3. The page and keyword rules in `seo/content_guide.md`.
4. Current official product sources for product facts, prices, limits, features, setup steps, imports, exports, and changes.

If committed research lacks a metric or exact question, use public SERP research to understand intent and competitor coverage. Do not invent Semrush metrics or exact PAA questions. Missing search metrics are not a blocker: preserve saved values and omit unknowns.

## Manual refresh rule

New Semrush research is a separate, owner-authorized task. It is not part of the recurring publisher. A manual refresh must be saved in the repository before a future scheduled run can use it.
