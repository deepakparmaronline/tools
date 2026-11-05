<?php
require __DIR__.'/../../includes/bootstrap.php';

$canonical = url('n8n/review/');
$seoTitle = 'n8n Review: Features and Limits';
$pageTitle = page_title($seoTitle);
$pageDescription = 'A research-based n8n review covering workflow features, AI nodes, pricing, licensing, self-hosting, limits and the teams most likely to benefit.';
$ogType = 'article';
$publishedAt = '2026-11-05T00:00:00+05:30';
$modifiedAt = '2026-11-05T00:00:00+05:30';
$faqItems = json_decode('[{"question":"Is n8n worth using?","answer":"It can be worth using for technical teams that need visual workflows, APIs, code and deployment choice. It is less attractive if nobody owns maintenance or if the licence does not fit the product you want to build."},{"question":"Is n8n free?","answer":"The self-hosted Community Edition is available without a software subscription for uses allowed by its licence. You still need infrastructure and maintenance. n8n Cloud offers a trial, not a permanent free Cloud plan."},{"question":"Is n8n open source?","answer":"n8n source is published under the Sustainable Use License. That licence is not OSI-approved open source, so check the exact terms for internal, commercial and customer-facing use."},{"question":"Can n8n run without Docker?","answer":"The current documentation lists n8n 3.0 as early access and says self-hosted deployments need Docker-based installation for that version. Review the migration guide before upgrading."},{"question":"Does n8n charge for every node?","answer":"No. n8n Cloud counts a full workflow run as one execution, regardless of how many steps it contains."}]', true);
$graph = [
    [
        '@type'=>'Article',
        '@id'=>$canonical.'#article',
        'headline'=>'n8n Review: Features, Pricing and Limits',
        'description'=>$pageDescription,
        'datePublished'=>$publishedAt,
        'dateModified'=>$modifiedAt,
        'author'=>['@type'=>'Person','name'=>'Deepak Parmar','url'=>url('about-deepak-parmar/')],
        'publisher'=>['@type'=>'Organization','name'=>SITE_NAME,'url'=>SITE_URL],
        'mainEntityOfPage'=>$canonical,
        'url'=>$canonical
    ],
    breadcrumbs([
        ['name'=>'Home','url'=>SITE_URL],
        ['name'=>'n8n','url'=>url('n8n/')],
        ['name'=>'n8n Review: Features, Pricing and Limits','url'=>$canonical]
    ]),
    ['@type'=>'FAQPage','mainEntity'=>array_map(fn($item)=>['@type'=>'Question','name'=>$item['question'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$item['answer']],],$faqItems)]
];
$extraHead = '<meta property="article:published_time" content="'.e($publishedAt).'">'
    .'<meta property="article:modified_time" content="'.e($modifiedAt).'">'
    .jsonld(['@context'=>'https://schema.org','@graph'=>$graph])
    .'<link rel="stylesheet" href="'.e(asset('css/publication.css')).'">';

require __DIR__.'/../../includes/header.php';
?>
<div class="container publication-head">
    <nav class="crumbs" aria-label="Breadcrumb">
        <a href="/">Home</a><span aria-hidden="true">›</span>
        <a href="/n8n/">n8n</a><span aria-hidden="true">›</span>
        <span>n8n Review: Features, Pricing and Limits</span>
    </nav>
    <span class="eyebrow">Software review</span>
    <h1>n8n Review: Features, Pricing and Limits</h1>
    <time class="publication-date" datetime="<?=$publishedAt?>">Published November 5, 2026</time>
    <span class="publication-date">Last updated <time datetime="2026-11-05">November 5, 2026</time></span>
    <div class="publication-author">
        <a href="/about-deepak-parmar/"><img src="/images/deepak-parmar.jpeg" alt="Deepak Parmar" width="54" height="54"></a>
        <div><strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong><div class="publication-author-links"><a href="https://www.linkedin.com/in/deepakparmaronline/">LinkedIn</a><a href="https://www.youtube.com/@deepakparmaronline">YouTube</a></div></div>
    </div>
</div>
<div class="container publication-layout">
    <nav class="publication-toc" aria-label="Table of contents">
        <h2>On this page</h2><a href="#verdict">Verdict</a><a href="#quick-summary">Quick summary</a><a href="#what-n8n-does">What n8n does</a><a href="#key-strengths">Key strengths</a><a href="#pricing-and-licensing-trade-offs">Pricing and licensing</a><a href="#a-current-upgrade-point-n8n-3-0">n8n 3.0 update</a><a href="#who-should-use-n8n">Who should use n8n</a><a href="#who-should-look-elsewhere">Who should look elsewhere</a><a href="#n8n-review-faq">FAQ</a><a href="#review-methodology">Review methodology</a><a href="#sources">Sources</a>
    </nav>
    <article class="publication-body">
        <details class="publication-mobile-toc"><summary>On this page</summary><nav aria-label="Mobile table of contents"><a href="#verdict">Verdict</a><a href="#quick-summary">Quick summary</a><a href="#what-n8n-does">What n8n does</a><a href="#key-strengths">Key strengths</a><a href="#pricing-and-licensing-trade-offs">Pricing and licensing</a><a href="#a-current-upgrade-point-n8n-3-0">n8n 3.0 update</a><a href="#who-should-use-n8n">Who should use n8n</a><a href="#who-should-look-elsewhere">Who should look elsewhere</a><a href="#n8n-review-faq">FAQ</a><a href="#review-methodology">Review methodology</a><a href="#sources">Sources</a></nav></details>
        <section class="answer"><p><strong>Short answer:</strong> n8n is a strong option for technical teams that need visual workflows, API control, code steps and a choice between Cloud and self-hosting. It is less suitable if you need a simple no-code tool, a permissive licence for a customer-facing product or a workflow platform that nobody on your team can maintain.</p></section>
<h2 id="verdict">Verdict</h2>
<p>n8n gives teams a flexible way to connect apps, APIs and internal systems. The visual editor helps you see how data moves, while HTTP requests, code nodes, conditions and sub-workflows cover cases that basic automation tools can struggle with. The Cloud plans use full workflow executions as the billing unit, and a self-hosted Community Edition is available for uses allowed by its licence.</p>
<p>That flexibility is also the main trade-off. A team needs to understand API credentials, data structures, errors, retries and security. Self-hosting adds responsibility for servers, databases, backups, upgrades and monitoring. The Sustainable Use License also means n8n should not be described as unrestricted open-source software. For an internal technical team, these limits may be manageable. For a small non-technical team or a product that sells automation to customers, another platform may be a better fit.</p>
<h2 id="quick-summary">Quick summary</h2>
<div class="publication-table"><table><thead><tr><th>Area</th><th>Research-based assessment</th></tr></thead><tbody><tr><td>Best for</td><td>Technical teams automating app, API and internal workflows</td></tr><tr><td>Main strength</td><td>Visual workflows with code and HTTP control</td></tr><tr><td>Cloud entry price</td><td>€20/month billed annually for 2,500 executions</td></tr><tr><td>Higher Cloud plan</td><td>€50/month billed annually for 10,000 executions</td></tr><tr><td>Business plan</td><td>€667/month billed annually, self-hosted only, 40,000 executions</td></tr><tr><td>Self-hosting</td><td>Community Edition available under the Sustainable Use License</td></tr><tr><td>Main risk</td><td>Licensing, maintenance and security need a clear owner</td></tr><tr><td>Current release note</td><td>Version 3.0 is listed as early access; check the migration guide before upgrading</td></tr></tbody></table></div>
<p>Prices and product details were checked on November 5, 2026 against the <a href="https://n8n.io/pricing/">official pricing page</a> and documentation. This is a source-based review, not a hands-on test or a user rating.</p>
<h2 id="what-n8n-does">What n8n does</h2>
<p>n8n is a workflow automation platform. A workflow starts with a trigger, such as a schedule, webhook or app event. Nodes then read or change data, call another service or send an update. You can add filters, branches, loops and sub-workflows to control what happens next.</p>
<p>The product combines a visual editor with code options. The built-in node catalogue covers many common services, while the HTTP Request node can connect to an API that does not have a dedicated integration. JavaScript and Python Code nodes help when data needs custom handling. This mix makes n8n useful for processes that are too specific for a one-click template but do not justify a full custom application.</p>
<p>The same flexibility can create a maintenance problem. A workflow that uses several APIs needs clear documentation, stable credentials, sensible timeouts and a plan for rate limits. If the person who built it leaves, another team member should be able to understand the trigger, data shape, branches and failure path.</p>
<h2 id="key-strengths">Key strengths</h2>
<h3 id="1-one-execution-can-contain-many-steps">1. One execution can contain many steps</h3>
<p>n8n Cloud pricing is based on full workflow executions. The pricing page says a run counts as one execution regardless of how many steps it contains or how much data it processes. That can be attractive for long workflows with many nodes, but it does not make every workload cheap. A workflow that runs every few minutes or receives thousands of webhook events can still use a large execution allowance.</p>
<p>The useful comparison is not “one execution versus one task” without context. Count how often the workflow starts, then compare that with the task or credit model of each alternative. The <a href="/n8n/pricing/">n8n pricing guide</a> explains the current plan limits and an example calculation.</p>
<h3 id="2-visual-building-with-room-for-code">2. Visual building with room for code</h3>
<p>The editor helps a builder inspect input and output data at each step. Conditions and routing nodes can split records, while code and HTTP requests cover custom transformations and services. Developers can use this as a visual layer around code rather than writing an entire integration service from scratch.</p>
<p>This is a strength when the workflow has clear owners and review rules. It is not a reason to put complex business logic into one huge canvas. Split large processes into reusable sub-workflows, give nodes clear names and document the data contract between each stage.</p>
<h3 id="3-broad-integration-options">3. Broad integration options</h3>
<p>n8n includes built-in nodes for common services and supports custom API calls. A missing prebuilt node does not always block an integration if the service has a documented API. The cost is that a custom connection needs someone to understand authentication, pagination, rate limits, response formats and API changes.</p>
<p>Before choosing n8n, list the exact apps and operations your workflow needs. A logo in an integration directory does not prove that every endpoint or feature is supported. Confirm the required trigger and action, check the credential method and test the real data fields in a safe environment.</p>
<h3 id="4-ai-workflow-components">4. AI workflow components</h3>
<p>n8n includes AI nodes, agent tools and model connections. These can help route text, extract fields, call tools or combine a model with business data. They are useful when an automation needs language understanding, but the workflow still needs limits and controls.</p>
<p>Do not let an AI node make a high-impact change without validation. Use structured outputs, allowed tool lists, human approval where needed, retry limits and logging. Also price the model provider separately where you bring your own API key. The n8n Cloud plan may include Assistant credits, but that is not the same as unlimited third-party model usage.</p>
<h3 id="5-cloud-and-self-hosting-choices">5. Cloud and self-hosting choices</h3>
<p>n8n Cloud is managed by n8n. The Starter and Pro plans are hosted by n8n, while the Business plan is listed as self-hosted only. Enterprise can be hosted by n8n or self-hosted. This gives teams a route from a managed trial to a more controlled deployment, but the feature and support terms differ by plan.</p>
<p>Self-hosting can keep the workflow runtime and data on infrastructure you manage. It also makes you responsible for SSL, access, database backups, encryption keys, updates, monitoring, queue capacity and incident response. The official <a href="https://docs.n8n.io/hosting/securing/overview/">security overview</a> lists controls such as security audits, SSL, SSO, encryption-key rotation, execution-data redaction and SSRF protection.</p>
<h2 id="pricing-and-licensing-trade-offs">Pricing and licensing trade-offs</h2>
<p>The public pricing page lists Starter at €20/month billed annually for 2,500 executions, Pro at €50/month billed annually for 10,000 executions, and Business at €667/month billed annually for 40,000 executions. Business is self-hosted only. Enterprise uses custom execution pricing. The Cloud trial has a separate limit of 1,000 executions, five concurrent executions and a 180-second execution timeout. These details can change, so check the <a href="https://n8n.io/pricing/">official pricing page</a> before buying.</p>
<p>The Community Edition is available as a self-hosted version, but the licence matters. n8n&#39;s <a href="https://github.com/n8n-io/n8n/blob/master/LICENSE.md">Sustainable Use License</a> allows certain internal business and personal uses. It is not an OSI-approved open-source licence, and it is not a general permission to resell n8n or offer a competing hosted automation service. If your product exposes n8n&#39;s functionality to customers, get licensing advice before you build around it.</p>
<p>There are also costs beyond the subscription. A self-hosted instance needs compute, storage, database backups, TLS, monitoring and time from an operator. Cloud users may need separate model-provider charges or additional capacity. The cheapest entry plan is not necessarily the lowest total cost for a production workflow.</p>
<h2 id="a-current-upgrade-point-n8n-3-0">A current upgrade point: n8n 3.0</h2>
<p>The n8n documentation lists version 3.0 as an early-access release. The breaking-changes guide says self-hosted deployments need to use Docker-based installation, so teams that currently use npm or npx should not treat the update as a routine version bump. Read the <a href="https://docs.n8n.io/changelog/v30-breaking-changes/">3.0 breaking changes</a> and <a href="https://docs.n8n.io/changelog/v30-migration-tool/">migration tool guide</a> before planning an upgrade. Review the migration report and test a copy of the instance before changing production.</p>
<p>This matters to buyers because the deployment method is part of the total cost of ownership. A team that does not want to manage Docker, backups and updates may be better off with n8n Cloud or a fully managed alternative.</p>
<h2 id="who-should-use-n8n">Who should use n8n?</h2>
<p>n8n is worth considering when:</p>
<ul><li>You need multi-step automation across several services and internal APIs.</li><li>A developer or technical operations owner can maintain credentials and workflows.</li><li>You want a visual editor but still need custom code or HTTP requests.</li><li>You need a self-hosted option for an allowed internal business use.</li><li>Your workflow starts often enough that execution-based pricing compares well with task or credit billing.</li></ul>
<h2 id="who-should-look-elsewhere">Who should look elsewhere?</h2>
<p>Look at alternatives when:</p>
<ul><li>Your team needs the simplest no-code builder and does not have technical support.</li><li>You do not want responsibility for server updates, backups or security.</li><li>You need a permissive licence for a customer-facing automation product.</li><li>Your workflow depends on a specific app action that n8n does not support well.</li><li>A per-user plan or a Microsoft-managed desktop flow better matches your buying model.</li></ul>
<p>Zapier and Make are easier places to start for many cloud-app workflows. Activepieces is worth checking if you want a visual builder with an on-prem path. Power Automate fits Microsoft environments, while Node-RED, Windmill and Kestra serve more technical use cases. Compare them in the <a href="/n8n/alternatives/">n8n alternatives guide</a>.</p>
<h2 id="n8n-review-faq">n8n review FAQ</h2>
<h3 id="is-n8n-worth-using">Is n8n worth using?</h3>
<p>It can be worth using for technical teams that need visual workflows, APIs, code and deployment choice. It is less attractive if nobody owns maintenance or if the licence does not fit the product you want to build.</p>
<h3 id="is-n8n-free">Is n8n free?</h3>
<p>The self-hosted Community Edition is available without a software subscription for uses allowed by its licence. You still need infrastructure and maintenance. n8n Cloud offers a trial, not a permanent free Cloud plan.</p>
<h3 id="is-n8n-open-source">Is n8n open source?</h3>
<p>n8n source is published under the Sustainable Use License. That licence is not OSI-approved open source, so check the exact terms for internal, commercial and customer-facing use.</p>
<h3 id="can-n8n-run-without-docker">Can n8n run without Docker?</h3>
<p>The current documentation lists n8n 3.0 as early access and says self-hosted deployments need Docker-based installation for that version. Review the migration guide before upgrading.</p>
<h3 id="does-n8n-charge-for-every-node">Does n8n charge for every node?</h3>
<p>No. n8n Cloud counts a full workflow run as one execution, regardless of how many steps it contains.</p>
<h2 id="review-methodology">Review methodology</h2>
<p>This review uses official n8n product, pricing, licence, documentation and release-note sources checked on November 5, 2026. We did not connect an account, run a workflow, benchmark execution speed or assign a user rating. The review separates published plan details from operational trade-offs that depend on the deployment and workload. Read the site-wide <a href="/review-methodology">review methodology</a> for the editorial process.</p>
<h2 id="more-n8n-guides">More n8n guides</h2>
<ul><li><a href="/n8n/">n8n hub</a></li><li><a href="/n8n/review/">n8n review</a></li><li><a href="/n8n/pricing/">n8n pricing</a></li><li><a href="/n8n/how-to-use/">How to use n8n</a></li><li><a href="/n8n/alternatives/">n8n alternatives</a></li><li><a href="/compare/n8n-vs-zapier/">n8n vs Zapier</a></li></ul>
<h2 id="sources">Sources</h2>
<ul><li><a href="https://n8n.io/">n8n product site</a>, checked November 5, 2026.</li><li><a href="https://n8n.io/pricing/">n8n pricing</a>, checked November 5, 2026.</li><li><a href="https://github.com/n8n-io/n8n/blob/master/LICENSE.md">Sustainable Use License</a>, checked November 5, 2026.</li><li><a href="https://docs.n8n.io/hosting/securing/overview/">n8n security overview</a>, checked November 5, 2026.</li><li><a href="https://docs.n8n.io/changelog/v30-breaking-changes/">n8n 3.0 breaking changes</a>, checked November 5, 2026.</li><li><a href="https://docs.n8n.io/changelog/v30-migration-tool/">n8n 3.0 migration tool</a>, checked November 5, 2026.</li></ul>
        <div class="publication-end-author">
            <strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong>
            <p>Software and SEO research based on official product, pricing, licence and documentation sources. This review does not claim hands-on testing.</p>
        </div>
    </article>
</div>
<?php
require __DIR__.'/../../includes/footer.php';
