<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('github-cli-expiring-oauth-tokens');
ob_start(); ?>
<p>GitHub CLI now offers expiring, automatically refreshing OAuth credentials in public preview. In GitHub CLI v2.103.0, users can opt in with <code>gh auth login --expiring</code>; the CLI refreshes the access token when needed instead of relying on a long-lived token. This can reduce the useful lifetime of a leaked access token, but it can also break scripts that copy a token once and reuse it after expiry.</p>
<figure class="article-image"><img src="/assets/images/blog/github-cli-expiring-oauth-tokens.svg" alt="Diagram showing GitHub CLI refreshing a short-lived access token while scripts avoid caching stale credentials" width="1600" height="900" loading="lazy"><figcaption>Short-lived credentials improve containment only when tools request fresh tokens correctly.</figcaption></figure>
<h2>What the preview adds</h2>
<p>The feature pairs an expiring access token with a rotating refresh token. It is opt-in, and existing sign-ins keep their current behavior unless the setting is enabled.</p>
<h2>Why expiring tokens are different</h2>
<p>GitHub's preview changes the lifetime and renewal path of the credential used by the CLI. Instead of relying on a long-lived access token, GitHub CLI can use a short-lived access token together with a rotating refresh token. The CLI renews the access token when it is needed, so users can remain signed in without manually repeating authentication at every expiry.</p>
<p>The security benefit is limited but useful: a copied access token has a shorter window in which it can be reused. It does not make a compromised workstation safe, protect a refresh token stored on a compromised machine, or replace least-privilege permissions. Treat it as one layer in credential hygiene rather than a complete account security solution.</p>
<p>The feature is opt-in and backward compatible. If you do not enable it, existing sign-ins and manually supplied tokens continue to work as before. GitHub says the behavior is available on github.com and ghe.com, while GitHub Enterprise Server support starts with GHES 3.23; earlier versions fall back to non-expiring behavior.</p>
<h2>Sources</h2>
<ul><li><a href="https://github.blog/changelog/2026-10-21-github-cli-opt-in-to-expiring-auto-refreshing-oauth-tokens/" target="_blank" rel="noopener noreferrer">GitHub Changelog: Expiring, auto-refreshing OAuth tokens</a></li><li><a href="https://cli.github.com/manual/gh_auth_login" target="_blank" rel="noopener noreferrer">GitHub CLI: gh auth login manual</a></li></ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
