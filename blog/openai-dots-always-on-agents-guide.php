<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('openai-dots-always-on-agents-guide') ?? ['slug'=>'openai-dots-always-on-agents-guide','title'=>'OpenAI Dots: How Always-On AI Agents Work','description'=>'OpenAI introduced Dots on September 29. Learn how always-on agents use apps, cloud computers, permissions and approvals to handle work.','category'=>'ChatGPT','date'=>'2026-09-29','read_time'=>'8 min read'];
ob_start(); ?>
<p>OpenAI introduced Dots on September 29, 2026: always-on agents designed to work in the background rather than waiting for a single prompt. OpenAI says Dots run on their own cloud computer, can connect to more than 4,000 apps through its plugin ecosystem, and can be reached through ChatGPT, Slack and Teams.</p>
<figure class="article-image"><img src="/assets/images/blog/openai-dots-always-on-agents-guide.svg" width="1200" height="630" alt="Illustration of an OpenAI Dot running a background task across ChatGPT, Slack and connected apps"></figure>

<h2>What makes a Dot different from a normal chatbot</h2>
<p>A normal chatbot usually waits for a message and then produces a response. OpenAI describes Dots as agents that can keep working toward a goal, check connected information and return with progress, questions or decisions that need approval.</p>
<p>The difference is continuity. A Dot has a cloud computer of its own and can keep working even when the person who started the task is not actively using the chat. OpenAI calls one background mode “proactive research,” where the Dot uses connected read-only tools to look for useful updates.</p>

<h2>How Dots connect to work apps</h2>
<p>OpenAI says Dots can be reached through ChatGPT and can also communicate in Slack and Teams. A user can move between channels while the Dot retains the project's context. The company also describes a plugin ecosystem that can connect Dots to more than 4,000 apps.</p>
<p>That integration model is important because an agent becomes more useful when it can act on the information that teams already use. It also increases the need for careful permissions. An agent that can read from many systems can create a larger impact when a wrong assumption is repeated across those systems.</p>

<h2>Permissions and approval are core features</h2>
<p>OpenAI says users choose which apps a Dot can access through existing ChatGPT controls. Custom Rules can allow specific actions, require approval or block them. Built-in safety requirements still apply.</p>
<p>The company also says a Dot can use saved passwords for supported websites without exposing those passwords to the model. That does not remove the need for access reviews. Teams should still decide which sites and actions an agent is allowed to use and which actions must always be approved by a person.</p>

<h2>What happens when the agent works in the background</h2>
<table class="data-table"><thead><tr><th>Stage</th><th>Typical agent behavior</th><th>Human control</th></tr></thead><tbody>
<tr><td>Setup</td><td>Choose the Dot, project and connected apps.</td><td>Set boundaries and permissions.</td></tr>
<tr><td>Background work</td><td>Research, inspect information and prepare actions.</td><td>Monitor progress and redirect when needed.</td></tr>
<tr><td>External action</td><td>Draft or perform an allowed action.</td><td>Approve actions that require confirmation.</td></tr>
<tr><td>Review</td><td>Return results, notes and open decisions.</td><td>Check the evidence before important commitments.</td></tr>
</tbody></table>
<p>This is closer to an operations system than a chat window. The agent has state, tools and permission boundaries, so the surrounding controls become as important as the model.</p>

<h2>Why the cloud computer matters</h2>
<p>OpenAI says each Dot has its own cloud computer, keeping the user's personal computer and its contents separate unless the user chooses to connect them. That design can reduce the need for an agent to control a primary desktop directly.</p>
<p>The isolation is useful, but it should not be treated as a full security guarantee. The real question is what systems the cloud computer can reach, what credentials it can use, and what actions those credentials can perform.</p>

<h2>Practical use cases for an SEO team</h2>
<p>A marketing or SEO team could use an agent pattern like Dots for recurring research: watch incoming interview transcripts, identify material for clips, draft show notes, prepare social copy, or keep a project brief current as new information arrives.</p>
<p>The safe pattern is to separate read, draft and publish privileges. Reading source material can be automated more broadly. Publishing, sending external messages, changing a live website or spending money should use tighter rules and explicit approval.</p>

<h2>Availability and rollout</h2>
<p>OpenAI says Dots are rolling out to Pro and Business Premium users in eligible markets, with Enterprise, Edu and Healthcare users able to try the beta when workspace administrators enable it. The first Dot is included in the stated Pro or Business Premium plan.</p>
<p>Because the product is rolling out gradually, availability can vary by account and market. Teams should also verify which app connections and actions are supported in their workspace before designing a production workflow around them.</p>

<h2>Frequently asked questions</h2>
<h3>What is an OpenAI Dot?</h3>
<p>A Dot is an always-on AI agent designed to continue working toward a user's goals using connected apps and its own cloud computer.</p>
<h3>Can Dots work without an active chat session?</h3>
<p>Yes. OpenAI describes background work and proactive research, where a Dot can continue tasks outside an active conversation under its permission and safety controls.</p>
<h3>Can Dots send messages or change apps?</h3>
<p>They can perform permitted actions, but OpenAI says users control app access and can require approval for specific actions. Background proactive research uses restricted read-only tools.</p>

<h2>Sources</h2>
<ul>
<li><a href="https://openai.com/index/introducing-dots/">OpenAI — Introducing dots</a></li>
<li><a href="https://help.openai.com/en/articles/12960647-dots-in-chatgpt-faq">OpenAI Help — Dots in ChatGPT FAQ</a></li>
</ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';