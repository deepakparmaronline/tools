<?php
require __DIR__.'/../../includes/bootstrap.php';
$canonical = url('helpscout/review/');
$seoTitle = 'Help Scout Review: Features, Pricing and Fit';
$pageTitle = page_title($seoTitle);
$pageDescription = 'Read this Help Scout review for shared inbox features, pricing, free-plan limits, AI costs, migration rules and teams that may need a different help desk.';
$ogType = 'article';
$publishedAt = '2026-11-14T00:00:00+05:30';
$modifiedAt = '2026-11-14T00:00:00+05:30';
$faqItems = json_decode('[{"question":"Is Help Scout worth it for a small team?","answer":"It can be. Free supports up to five users and one inbox, while paid plans add more contacts, inboxes, workflows, and other features. Check the 100-contact monthly limit on Free."},{"question":"Does Help Scout include a knowledge base?","answer":"Yes. Docs is Help Scout\'s knowledge base product, and every plan includes at least one Docs site. Site and article limits vary by plan."},{"question":"Does Help Scout charge for AI?","answer":"AI Assist is listed on paid plans, while AI Drafts and AI Summarize are listed for Plus and Pro. Envoy is separate at $0.75 per resolution after the free-resolution period."},{"question":"Can Help Scout import Zendesk tickets and macros?","answer":"The import tool lists Zendesk as supported and can import tickets or conversations with customer profiles and tags. It does not import macros, automations, users, inbox settings, help center articles, custom fields, ticket types, or custom statuses."},{"question":"Can I export Help Scout conversation history?","answer":"Selected CSV and XLSX reports exclude conversation thread contents. Customer, user, and conversation data can be obtained through the Inbox API, and Docs articles through the Docs API."}]', true);
$graph = [
    ['@type'=>'Article','@id'=>$canonical.'#article','headline'=>'Help Scout Review: Features, Pricing and Fit','description'=>$pageDescription,'datePublished'=>$publishedAt,'dateModified'=>$modifiedAt,'author'=>['@type'=>'Person','name'=>'Deepak Parmar','url'=>url('about-deepak-parmar/')],'publisher'=>['@type'=>'Organization','name'=>SITE_NAME,'url'=>SITE_URL],'mainEntityOfPage'=>$canonical,'url'=>$canonical],
    breadcrumbs([['name'=>'Home','url'=>SITE_URL],['name'=>'Help Scout','url'=>url('helpscout/')],['name'=>'Help Scout Review: Features, Pricing and Fit','url'=>$canonical]]),
    ['@type'=>'FAQPage','mainEntity'=>array_map(fn($item)=>['@type'=>'Question','name'=>$item['question'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$item['answer']]],$faqItems)]
];
$extraHead = '<meta property="article:published_time" content="'.e($publishedAt).'"><meta property="article:modified_time" content="'.e($modifiedAt).'">'.jsonld(['@context'=>'https://schema.org','@graph'=>$graph]).'<link rel="stylesheet" href="'.e(asset('css/publication.css')).'">';
require __DIR__.'/../../includes/header.php';
?>
<header class="article-head publication-head"><div class="container">
<nav class="crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">›</span><a href="/helpscout/">Help Scout</a><span aria-hidden="true">›</span><span>Help Scout Review</span></nav>
<span class="eyebrow">Software review</span><h1>Help Scout Review: Features, Pricing and Fit</h1><p><?=e($pageDescription)?></p>
<div class="article-meta"><span><strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong></span><span>Published <time datetime="2026-11-14">November 14, 2026</time></span><span>Last updated <time datetime="2026-11-14">November 14, 2026</time></span></div>
</div></header>
<div class="container publication-layout">
<article class="publication-body article-body">
<h2 id="verdict">Verdict</h2>
<p>Help Scout is a good choice for a support team that wants a shared inbox with a calm, email-like workflow, a built-in knowledge base, and a support widget. Its main strength is the way conversations, customer profiles, internal notes, saved replies, and workflows sit together. A small team can start on the Free plan, then add seats, inboxes, Docs sites, SLAs, and automation as the operation grows.</p>
<p>The trade-off is that Help Scout is not a full replacement for every complex ticketing system. Its standard import does not move users, inbox settings, help center articles, macros, rules, automations, custom fields, ticket types, or custom statuses. Most non-report data exports require APIs. If those objects are important to your team, compare alternatives before migrating.</p>
<h2 id="review-summary">Review summary</h2>
<div class="table-scroll"><table class="data-table"><thead><tr><th scope="col">Area</th><th scope="col">Assessment</th></tr></thead><tbody><tr><th scope="row">Best for</th><td>Email-first support teams and small to midsize service operations</td></tr><tr><th scope="row">Core products</th><td>Inbox, Docs, Beacon, Workflows, and Envoy</td></tr><tr><th scope="row">Free plan</th><td>Up to 5 users, 1 inbox, 1 Docs site, 100 contacts/month</td></tr><tr><th scope="row">Paid prices shown</th><td>Standard $25, Plus $45, Pro $75 per user/month</td></tr><tr><th scope="row">Strong points</th><td>Shared context, Docs, Beacon, saved replies, workflows, and a free entry tier</td></tr><tr><th scope="row">Main limits</th><td>Migration gaps, plan-based workflow/routing limits, and usage-based Envoy cost</td></tr><tr><th scope="row">Testing basis</th><td>Desk research from official product, pricing, support, and update pages; no hands-on testing</td></tr></tbody></table></div>
<h2 id="what-help-scout-is">What Help Scout is</h2>
<p>Help Scout is a customer support platform built around conversations rather than a traditional ticket form as the main starting point. The Inbox gives a team a shared place to answer email and supported channels, assign ownership, add internal notes, and keep customer context nearby. The interface is designed so agents can work together without exposing internal collaboration to the customer.</p>
<p>The platform includes more than an inbox. Docs is the knowledge base for help articles, collections, and categories. Beacon is a support widget that can surface those articles and offer contact options on a website or product. Workflows automate repeatable actions, while SLAs and views help a team keep track of response commitments and priority conversations.</p>
<p>That combination is the main reason to consider Help Scout. A small support team can manage customer conversations and self-service content without stitching together a separate inbox, knowledge base, and widget. The trade-off is that teams that need highly customised ticket objects or complex multi-brand routing may outgrow the product.</p>
<h2 id="inbox-and-collaboration">Inbox and collaboration</h2>
<p>The Inbox is the strongest part of Help Scout's proposition. It brings conversations from supported channels into a shared workspace and keeps the customer profile, company context, conversation history, and internal notes close to the reply area. Teammates can assign a conversation, add a tag, use a saved reply, and follow a view that matches their role.</p>
<p>This is useful for teams where the same customer may contact support about billing, product use, and account access. A teammate can see earlier conversations and company details before replying. The product also supports collision awareness, so two agents can avoid doing the same work at the same time.</p>
<p>The October 1, 2026 product update describes a redesigned conversation sidebar. It brings status, assignee, SLA, topics, sentiment, company details, conversation history, custom fields, and apps into a consolidated view. Custom fields can be edited directly in the sidebar, and teams can resize or reorder sections. This is a current improvement worth checking if you last evaluated Help Scout before the redesign.</p>
<p>Help Scout supports email and live chat, and its product pages list SMS, Instagram, Messenger, WhatsApp, and phone integrations as ways to handle other customer channels. SMS can be connected through a Twilio number. Confirm which channels are included in the plan you select and which require an integration or add-on.</p>
<h2 id="docs-and-beacon">Docs and Beacon</h2>
<p>Docs gives a support team a place to publish answers that customers can find without opening a conversation. Articles can be organised into collections and categories. This is useful when the same questions arrive repeatedly, such as account setup, billing, troubleshooting, or product configuration.</p>
<p>Beacon places a support entry point on a website or inside a product. A customer can search Docs, open a chat when available, or send a message. The value depends on the quality of the knowledge base: an empty Beacon does not reduce support volume. Before enabling it, organise the most common questions, write clear articles, and decide who owns each article after launch.</p>
<p>Every Help Scout plan includes a Docs site, but the number of sites and the article limits change by tier. If you support multiple brands or products, check the site allowance and the extra-site price before choosing a plan.</p>
<h2 id="workflows-slas-and-ai">Workflows, SLAs, and AI</h2>
<p>Workflows can automate tasks such as tagging, assigning, changing a conversation status, or notifying a teammate. The pricing table separates basic and advanced workflow allowances. Standard includes a limited number of basic workflows, Plus adds a larger advanced allowance, and Pro lists unlimited advanced workflows. SLAs also increase by plan, and the routing options differ between tiers.</p>
<p>AI features need a clear cost distinction. The pricing page lists AI Assist on paid plans and AI Drafts and AI Summarize on Plus and Pro. These help agents work with existing conversations. Envoy is a separate AI-agent suite, with Scout as its built-in agent. The public Envoy page lists $0.75 per resolution and three months of free resolutions for a new account.</p>
<p>Do not assume every Envoy capability is available today. The product page labels past-conversation learning, app connections, and email handling as coming soon. If those features are important to your buying decision, ask Help Scout for a current rollout status and test the actual workflow before signing a longer contract.</p>
<h2 id="pricing-and-free-plan">Pricing and free plan</h2>
<p>The Free plan supports up to five users, one inbox, one Docs site, and 100 contacts per month. The detailed plan table also lists limits for saved replies, tags, Docs articles, Beacon, and report history. It is useful for a very small team, but the contact allowance means it is not an unlimited free help desk.</p>
<p>The pricing page currently displays Standard at $25, Plus at $45, and Pro at $75 per user/month. It has a Monthly/Annual selector and advertises a 16% saving on annual billing, so confirm the billing option and the current checkout amount. Standard is aimed at a smaller paid team; Plus adds more routing, SLAs, and AI writing features; Pro is aimed at larger teams that need more inboxes, workflows, and administration controls.</p>
<p>Extra inboxes and Docs sites can add to the bill. The pricing page lists extra inboxes at $10 per month on annual billing or $12 on monthly billing, and extra Docs sites at $20 per month. Envoy adds a separate $0.75 per-resolution charge after the free period. Model the cost using actual agents, inboxes, Docs sites, and expected AI resolutions rather than using only the headline seat price.</p>
<h2 id="migration-and-data-portability">Migration and data portability</h2>
<p>Migration is the most important limitation to understand before choosing Help Scout. The built-in import tool is available to Account Owners and Administrators on Standard, Plus, and Pro. It supports providers such as Freshdesk, Gmail, Gorgias, HubSpot Service Hub, Intercom, Zendesk, and Zoho Desk. It imports emails or tickets with attached customer profiles and tags.</p>
<p>The same Help Scout guide lists what is not included. Users and inbox settings must be recreated. The standard import does not move knowledge base articles, saved replies, canned responses, macros, ticket rules, automations, custom fields, ticket types, or custom statuses. Help Scout points teams to the Docs API for a custom knowledge-base transfer and the Inbox API for other custom imports.</p>
<p>The export guide says selected reports can be exported as CSV or XLSX, but conversation thread contents are excluded from those report exports. Other customer, user, and conversation data is obtained through the Inbox API; Docs articles use the Docs API. A customer-list CSV can be requested, but it contains names and email addresses rather than conversation history.</p>
<p>Imports of 500,000 records or fewer are free when started inside Help Scout. Imports above that size are billed at $500 per 500,000 records, including the first 500,000. A team with a long history should run a sample import, review field mappings, export unsupported objects, and plan the cutover before switching its live email forwarding.</p>
<h2 id="pros-and-cons">Pros and cons</h2>
<h3 id="pros">Pros</h3>
<ul><li>A shared inbox that keeps customer history, company context, and internal notes close to the reply.</li><li>Docs and Beacon are part of the same product family, so self-service content can connect to the support workflow.</li><li>Saved replies, views, tags, workflows, and SLAs help a small team build a consistent process.</li><li>The Free plan gives a small team a way to start with five users and one inbox.</li><li>The public pricing page makes the seat price and Envoy resolution rate visible.</li></ul>
<h3 id="cons">Cons</h3>
<ul><li>The Free plan is limited to 100 contacts per month and one inbox.</li><li>Workflow, SLA, routing, and Docs capacity changes by plan.</li><li>Envoy is a separate usage-based product; the per-resolution rate needs its own budget.</li><li>The standard import does not move several objects that teams may rely on, including macros, automations, custom fields, ticket types, and statuses.</li><li>Most data beyond selected report exports requires API work.</li></ul>
<h2 id="who-should-choose-help-scout">Who should choose Help Scout?</h2>
<p>Choose Help Scout if most customer support starts with email, your team wants a shared conversation record, and you value a knowledge base and support widget in the same platform. It is especially suitable when the team can manage a simple workflow without a dedicated administrator.</p>
<p>Look elsewhere if you need deep skills-based routing, complex ticket lifecycles, extensive custom objects, multi-brand governance, or a complete migration of old macros and automations. Zendesk is a stronger shortlist option for larger operations; Freshdesk is worth comparing for conventional ticketing; Front is a good match for cross-functional shared inbox work.</p>
<h2 id="related-guides">Related guides</h2>
<ul><li>Read the <a href="/helpscout/">Help Scout hub</a> for a quick product overview.</li><li>Compare every tier in the <a href="/helpscout/pricing/">Help Scout pricing guide</a>.</li><li>Follow the <a href="/helpscout/how-to-use/">Help Scout setup guide</a>.</li><li>See the <a href="/helpscout/alternatives/">seven Help Scout alternatives</a>.</li><li>Compare <a href="/compare/helpscout-vs-zendesk/">Help Scout vs Zendesk</a>.</li></ul>
<h2 id="frequently-asked-questions">Frequently asked questions</h2>
<h3 id="is-help-scout-worth-it-for-a-small-team">Is Help Scout worth it for a small team?</h3>
<p>It can be. The Free plan supports up to five users and one inbox, while paid plans add more contacts, inboxes, workflows, and other features. Check the 100-contact monthly limit on Free before treating it as a long-term plan.</p>
<h3 id="does-help-scout-include-a-knowledge-base">Does Help Scout include a knowledge base?</h3>
<p>Yes. Docs is Help Scout's knowledge base product, and every plan includes at least one Docs site. The number of sites and article limits vary by plan.</p>
<h3 id="does-help-scout-charge-for-ai">Does Help Scout charge for AI?</h3>
<p>AI Assist is listed on paid plans, while AI Drafts and AI Summarize are listed for Plus and Pro. Envoy is separate and priced at $0.75 per resolution after the three-month free-resolution period shown on its product page.</p>
<h3 id="can-help-scout-import-zendesk-tickets-and-macros">Can Help Scout import Zendesk tickets and macros?</h3>
<p>The import tool lists Zendesk as a supported provider and can import tickets or conversations with customer profiles and tags. It does not import macros, saved replies, ticket rules, automations, users, inbox settings, knowledge base articles, custom fields, ticket types, or custom statuses through the standard process.</p>
<h3 id="can-i-export-help-scout-conversation-history">Can I export Help Scout conversation history?</h3>
<p>The reporting export supports selected CSV and XLSX reports, but excludes conversation thread contents. Help Scout says customer, user, and conversation data can be obtained through the Inbox API, and Docs articles through the Docs API.</p>
<h2 id="review-methodology">Review methodology</h2>
<p>This is a research-based review, not a hands-on product test. We checked Help Scout's product pages, pricing table, support articles, migration and export documentation, and product updates on November 14, 2026. We did not create a paid account, run a benchmark, test a live inbox, or verify an implementation in a customer environment. No user rating or performance score is claimed.</p>
<h2 id="sources">Sources</h2>
<ul><li><a href="https://www.helpscout.com/">Help Scout product overview</a></li><li><a href="https://www.helpscout.com/pricing/">Help Scout pricing</a></li><li><a href="https://www.helpscout.com/agent/">Help Scout Envoy</a></li><li><a href="https://docs.helpscout.com/article/1495-import-emails-or-tickets-into-help-scout">Help Scout import guide</a></li><li><a href="https://docs.helpscout.com/article/466-data-export-options">Help Scout data export options</a></li><li><a href="https://updates.helpscout.com/">Help Scout product updates</a></li></ul>
<p>Pricing and feature availability can change, so verify the live plan before purchase.</p>
<section class="publication-end-author" aria-label="About the author"><div class="publication-author"><a href="/about-deepak-parmar/"><img src="/images/deepak-parmar.jpeg" alt="Deepak Parmar" width="54" height="54"></a><div><strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong><p>Deepak Parmar researches software, SEO and practical digital workflows for ToolboxKart. This review uses official product documentation and pricing, not hands-on testing.</p></div></div></section>
<div class="author-box"><p><a href="/review-methodology">How we research software</a> · <a href="/advertising-disclosure">Advertising disclosure</a> · <a href="/corrections-policy">Corrections</a></p></div>
</article>
<aside class="sidebar"><nav class="toc" aria-label="Table of contents"><h2>On this page</h2><ol>
<li><a href="#verdict">Verdict</a></li>
<li><a href="#review-summary">Review summary</a></li>
<li><a href="#what-help-scout-is">What Help Scout is</a></li>
<li><a href="#inbox-and-collaboration">Inbox and collaboration</a></li>
<li><a href="#docs-and-beacon">Docs and Beacon</a></li>
<li><a href="#workflows-slas-and-ai">Workflows, SLAs, and AI</a></li>
<li><a href="#pricing-and-free-plan">Pricing and free plan</a></li>
<li><a href="#migration-and-data-portability">Migration and data portability</a></li>
<li><a href="#pros-and-cons">Pros and cons</a></li>
<li><a href="#who-should-choose-help-scout">Who should choose Help Scout?</a></li>
<li><a href="#related-guides">Related guides</a></li>
<li><a href="#frequently-asked-questions">Frequently asked questions</a></li>
<li><a href="#review-methodology">Review methodology</a></li>
<li><a href="#sources">Sources</a></li>
</ol></nav></aside>
</div>
<?php require __DIR__.'/../../includes/footer.php'; ?>
