# ChatGPT Schedule Guideline

**Purpose:** Mandatory operating rules for every ChatGPT-scheduled ToolBoxKart publishing run. Read this file in full before doing any research or editing. These rules are safeguards against incomplete article registration, broken category URLs, and falsely reporting a deployment as successful.

## 1. Repository and branch rules

- Repository: `deepakparmaronline/tools`.
- Work only on the existing `main` branch and commit the reviewed publishing batch directly to `main`.
- Do not create a branch, pull request, GitHub Actions scheduler, or Hostinger-side scheduled job.
- Do not change Hostinger configuration.
- Preserve the existing custom PHP website architecture and current design. Do not redesign the site as part of publishing.
- Never add dates to permanent article URLs. Preserve the existing category URL format: `/<category>/<slug>`.

## 2. Mandatory files to read at the start of EVERY scheduled run

Fetch the latest versions from `main` and read the full relevant contents before research or edits:

1. `chatgpt schedule guidline.md` (this file)
2. `README.md`
3. `TOOLBOXKART-MASTER-DAILY-RESEARCH-WRITING-QA-PUBLISHING-PROMPT.md`
4. `TOOLBOXKART-AI-AGENT-REFERENCE-PACK.md`
5. `docs/AI-SITE-RULES.md`

If any required file cannot be read, stop before publishing, report the missing file, and do not claim the run succeeded. Treat the latest repository instructions as authoritative, while preserving the explicit safeguards in this file.

## 3. Daily publishing requirements

- Research current, verifiable developments from the last 24 hours and follow the master prompt's research and content-quality rules.
- Publish exactly five complete articles per successful run. If current news is weak, use the master prompt's permitted evergreen fallback rather than inventing news.
- Verify factual claims against reliable primary sources where possible; include useful source links and relevant internal links.
- Follow the repository's actual category allowlist, article template, metadata schema, image conventions, canonical rules, and navigation conventions.
- Create the article PHP files and required image assets, and register every article in `data/posts.php`.
- Keep the author and other site-wide conventions consistent with existing articles and the master prompt.

## 4. Critical PHP registry safeguard

**Never place article records after `return $posts;` in `data/posts.php`.** PHP stops executing the file at the return statement; any records after it are silently ignored.

Before committing, inspect the complete final `data/posts.php` and verify:

1. Every one of the five new article records occurs before the single final `return $posts;`.
2. The return statement is after all existing and new records, at the end of the registry logic.
3. All five slugs are unique and match their article filenames, metadata, internal links, and canonical URLs.
4. No duplicate, premature, or misplaced return statement prevents records from loading.
5. Each category key is one of the site's supported categories and matches the intended public URL.

Do not rely only on the commit diff or on the presence of article files. Check the final full file and the position of each new record relative to the return statement.

## 5. Required pre-commit quality assurance

Review the full batch and its diff. Confirm:

- Exactly five new article records and the expected five article files are included.
- Every article file exists at the path expected by the current router/template.
- PHP syntax is valid. Use an available syntax/runtime check when possible; if it is unavailable, say so and perform a careful structural review rather than claiming a syntax check ran.
- Article metadata is complete and uses the repository's existing field names and formats.
- Category route, slug, canonical URL, title, sitemap URL, and redirect behavior agree.
- Internal links resolve to valid site routes; external sources work and substantiate the claims.
- Images/assets referenced by each article exist and load.
- The sitemap and homepage/category listing logic will discover the new records.
- No unrelated files or permanent URL changes are included.

If a check fails, fix it before committing. Do not publish a success report for a batch with unresolved blockers.

## 6. Post-commit and live deployment verification

After committing directly to `main`:

1. Verify the commit exists on `main` and inspect the committed files, not just local assumptions.
2. Check each of the five public category URLs on the live Hostinger site. Verify an actual successful HTTP response (prefer HTTP 200), the expected article title/body, and the correct canonical URL.
3. Check the homepage and relevant category listing for the new articles, and check the live sitemap for their URLs.
4. Distinguish a confirmed live result from a stale search-engine cache or a tool that cannot access the page. A search snippet alone is not proof of deployment.
5. If the live site still serves old content, diagnose the registry, routing, cache/deployment status, and relevant files. Do not edit Hostinger settings. Report the exact unresolved check and do not claim that all five articles are live.
6. Never say deployment succeeded unless the live verification actually supports that statement. If live verification is unavailable, report the GitHub commit as complete and deployment verification as unconfirmed.

## 7. Final run report

Report:
- The five article titles and permanent URLs.
- The commit SHA and link.
- The key QA checks completed.
- Live verification status, clearly marked **verified**, **not verified**, or **blocked**.
- Any unresolved issue and the precise next step.

**Success means all five articles are registered correctly, the code and links pass QA, and live deployment is verified. A successful GitHub commit alone is not proof of a successful live publication.**
