# Publishing alternative articles

The Alternatives section uses the existing PHP/shared-template architecture. Its permanent listing is `/alternatives/`; article canonicals are `/alternatives/topic-slug/`.

1. Copy `alternatives/articles/_ARTICLE-TEMPLATE.php.example` to `alternatives/articles/topic-slug.php`. Use a stable lowercase, hyphenated filename with no date prefix.
2. Fill in the title, description, publication date (`YYYY-MM-DD`), tag, and researched HTML content. An optional `seo_title` overrides the search title; the visible H1 remains the article title. Use H2/H3 for content headings, never another H1.
3. Add an optional featured image using a root-relative path or HTTPS URL, meaningful `image_alt`, and its actual width/height. Images feed the cards, article, Open Graph, Twitter/X, and Article schema automatically.
4. Use `updated` only for an actual editorial update. Author defaults to Deepak Parmar; `author` and `author_bio` can be supplied for another contributor.
5. Set `status` to `published` after editorial review, validate PHP, and deploy the article file and image through the existing deployment process.

Standing user preference, October 9, 2026: future article requests proceed through research, QA, published status, commit and push to GitHub `main`, and the existing hosting deployment workflow unless the user explicitly requests drafts. Do not leave completed articles saved as drafts or ask again for routine publication approval. If access or a material editorial check blocks completion, record the blocker and next action. A GitHub push does not establish live deployment; verify the live article, listing and sitemap separately.

Hostinger automatically deploys GitHub `main`, confirmed by the user on October 9, 2026. A normal publication needs the GitHub update followed by public live verification; it does not need Hostinger sign-in or a manual upload. Investigate hosting access only if an actual deployment or live check fails.

Only published, complete records with valid publication dates no later than today in Asia/Kolkata are public. Drafts, future articles, and invalid records do not appear in the listing, related articles, sitemap, or single-article routes. `updated` defaults to publication date if invalid.

`includes/alternatives.php` discovers records automatically. No edits to listing pages, related sections, `data/posts.php`, or XML sitemap files are required. The existing blog registry and article URLs remain separate. This section does not migrate existing articles or publish sample editorial content.

Article content is trusted editorial HTML, like existing blog content. These PHP records must only be authored by trusted site editors; they are not a public upload interface. Apache blocks direct access to the record directory.

Verify `/alternatives/`, the new article's canonical URL, header/footer links, related articles, metadata, and `/sitemap.xml` after deployment. Start the local preview from the repository root with `php -S 127.0.0.1:8765 preview-router.php`. This keeps internal navigation and assets local while retaining production SEO metadata. Confirm CSS and JavaScript responses contain content and the correct MIME types; a 200 response alone does not establish that an asset loaded.
