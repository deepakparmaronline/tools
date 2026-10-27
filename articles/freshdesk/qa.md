# Freshdesk cluster QA record

## Pre-merge review

- [x] Product identity and official site confirmed.
- [x] Official product, pricing, onboarding, email setup, automation, SLA, export and product-update sources checked.
- [x] Saved queue metrics retained exactly: US volume 480, KD 16, CPC US$46.98, commercial intent. No matching full row was found in `alternatives list.md`; trend, SERP-feature and exact PAA fields were not inferred.
- [x] No Semrush session used and no exact PAA question invented.
- [x] New cluster uses tool-first, date-free URLs.
- [x] Existing Zendesk vs Freshdesk comparison reused; no reverse-order duplicate created.
- [x] BreadcrumbList is mandatory and implemented in the shared renderer, alternatives template and standalone review.
- [x] Product-specific copy, semantic HTML, responsive tables and relevant schema added.
- [x] Non-essential unavailable product facts are omitted or qualified rather than blocking the cluster.
- [ ] GitHub Actions quality workflow must pass for the final main content commit.
- [ ] Inspect the matching seo/quality-status.json record after merge.
- [ ] User will verify live URLs after Hostinger auto-deployment; live verification is not a publication gate.

## Notes

No hands-on testing is claimed. Exact word counts and automated test results will be recorded after repository quality checks run.
