<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('github-cli-expiring-oauth-tokens');
ob_start(); ?>
<p>GitHub CLI now offers expiring, automatically refreshing OAuth credentials in public preview. In GitHub CLI v2.103.0, users can opt in with <code>gh auth login --expiring</code>; the CLI refreshes the access token when needed instead of relying on a long-lived token. This can reduce the useful lifetime of a leaked access token, but it can also break scripts that copy a token once and reuse it after expiry.</p>
<figure class="article-image"><img src="/assets/images/blog/github-cli-expiring-oauth-tokens.svg" alt="Diagram showing GitHub CLI refreshing a short-lived access token while scripts avoid caching stale credentials" width="1600" height="900" loading="lazy"><figcaption>Short-lived credentials improve containment only when tools request fresh tokens correctly.</figcaption></figure>
<h2>What the preview adds</h2>
<p>The feature pairs an expiring access token with a rotating refresh token. It is opt-in, and existing sign-ins keep their current behavior unless the setting is enabled.</p>
<h2>Sources</h2>
<ul><li><a href="https://github.blog/changelog/2026-10-21-github-cli-opt-in-to-expiring-auto-refreshing-oauth-tokens/" target="_blank" rel="noopener noreferrer">GitHub Changelog: Expiring, auto-refreshing OAuth tokens</a></li><li><a href="https://cli.github.com/manual/gh_auth_login" target="_blank" rel="noopener noreferrer">GitHub CLI: gh auth login manual</a></li></ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
