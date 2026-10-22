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
<h2>How to opt in safely</h2>
<p>GitHub CLI v2.103.0 adds an explicit login flag. To enable the preview for a single sign-in, use:</p>
<pre><code>gh auth login --expiring</code></pre>
<p>To enable the setting for future sign-ins, GitHub documents this configuration command:</p>
<pre><code>gh config set expiring_credentials enabled</code></pre>
<p>After signing in, check the credential state with <code>gh auth status</code>. If you use Git over HTTPS and want GitHub CLI to manage the credential, GitHub recommends:</p>
<pre><code>gh auth setup-git</code></pre>
<p>Start with a development machine or a low-risk repository. Confirm that your CLI version is current, that the sign-in used the expiring option, and that the credential helper is configured if Git operations depend on it. Do not paste access or refresh tokens into logs, tickets or shell transcripts while testing.</p>
<h2>Check Git and automation compatibility</h2>
<p>GitHub strongly recommends Git 2.46 or newer when using expiring credentials. Newer Git versions can mark these credentials so they are not cached beyond their lifetime. Older versions may still work, but GitHub says they can print a one-time recommendation to upgrade. Check the Git version on developer machines and build agents, not only on your laptop.</p>
<p>The biggest migration risk is software that captures a token once and stores it for later. A script that runs <code>gh auth token</code> and writes the value into a long-lived environment variable or configuration file can eventually use an expired credential. If an external tool needs a token, fetch it at the time of use rather than persisting the old value. Prefer using GitHub CLI as the Git credential helper for normal HTTPS Git operations so refresh can happen in the expected path.</p>
<p>Before enabling the preview across a team, test clone, fetch, push and any CI job that uses GitHub CLI. Include non-interactive jobs, scheduled workflows, credential caching and scripts that call APIs directly. Keep a rollback plan and document which workflows should wait if they depend on a token remaining valid for a long time.</p>
<h2>What can break after the change?</h2>
<p>Any workflow that assumes a token stays valid indefinitely deserves attention. Common examples include a script that reads a token once at startup, a local tool that caches credentials for days, or an automation that passes a token to a second process and never refreshes it. A failed push may look like a permissions problem even when the actual issue is an expired cached credential.</p>
<p>Diagnose failures by checking the CLI's authentication state, the Git credential helper configuration and the versions of Git and GitHub CLI. Avoid printing secrets to debug output. If a workflow cannot request fresh credentials when needed, leave that workflow on its current authentication method until it is updated and tested.</p>
<p>Expiring tokens can improve the response to accidental exposure, but they do not replace organization policies, narrow scopes, environment isolation, secret storage or prompt revocation. Teams should continue to use short-lived CI credentials where supported, remove unused access and monitor for unexpected activity.</p>
<h2>Rollout checklist</h2>
<ul><li>Upgrade GitHub CLI to v2.103.0 or newer.</li><li>Check Git version and use 2.46 or newer where possible.</li><li>Test <code>gh auth status</code>, HTTPS Git and the credential helper.</li><li>Find scripts that persist the output of <code>gh auth token</code>.</li><li>Test automation without logging token values.</li><li>Enable the preview only after the affected workflows pass.</li></ul>
<h2>Sources</h2>
<ul><li><a href="https://github.blog/changelog/2026-10-21-github-cli-opt-in-to-expiring-auto-refreshing-oauth-tokens/" target="_blank" rel="noopener noreferrer">GitHub Changelog: Expiring, auto-refreshing OAuth tokens</a></li><li><a href="https://cli.github.com/manual/gh_auth_login" target="_blank" rel="noopener noreferrer">GitHub CLI: gh auth login manual</a></li></ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
