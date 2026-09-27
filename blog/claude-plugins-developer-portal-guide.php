<?php require __DIR__.'/../includes/bootstrap.php';$post=post_by_slug('claude-plugins-developer-portal-guide') ?? ['slug'=>'claude-plugins-developer-portal-guide','title'=>'Claude Plugins: How the New Developer Submission Flow Works','description'=>'Anthropic introduced a developer portal for submitting Claude plugins on September 25, 2026. Here is what the new workflow covers and how teams should prepare.','category'=>'Claude','date'=>'2026-09-25','read_time'=>'7 min read'];ob_start(); ?>
<p>Anthropic added a new developer flow for Claude plugins on September 25, 2026. Its release notes say developers can submit plugins to the Claude directory through a new developer portal, track submissions through review, and see usage analytics after plugins are live. That turns plugin publishing into a managed lifecycle instead of a one-time upload.</p>
<h2>What changed for Claude plugin developers</h2>
<p>The new portal covers submission and review. Anthropic says developers can track a plugin through the review process and access usage analytics once the plugin is live.</p>
<h2>Why the review step matters</h2>
<p>A managed review process creates a clear checkpoint between development and public availability. Teams can use that checkpoint to confirm the plugin's permissions, data handling, user-facing description, failure behavior, and support process before release.</p>
<h2>What to prepare before submitting</h2>
<ul><li>A clear description of what the plugin does.</li><li>Documented permissions and connected services.</li><li>Input and output validation.</li><li>Fallback behavior when an external service fails.</li><li>A basic support and update process.</li></ul>
<h2>How to use analytics after launch</h2>
<p>Usage analytics can help a developer understand whether the plugin is actually being used and where users encounter friction. Treat those signals as product evidence, not as proof that every use case is working well.</p>
<h2>A simple plugin release workflow</h2>
<ol><li>Build and test the plugin.</li><li>Document permissions and data flows.</li><li>Submit through the Claude developer portal.</li><li>Track review feedback.</li><li>Release after approval.</li><li>Review usage analytics and improve the plugin based on observed behavior.</li></ol>
<h2>Sources</h2>
<ul><li><a href="https://support.claude.com/en/articles/12138966-release-notes">Anthropic — Claude Release Notes</a></li><li><a href="https://claude.com/blog/build-plugins-for-claude">Anthropic — Build plugins for Claude</a></li></ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';