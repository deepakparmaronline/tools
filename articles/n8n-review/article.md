> **Short answer:** n8n is a strong option for technical teams that need visual workflows, API control, code steps and a choice between Cloud and self-hosting. It is less suitable if you need a simple no-code tool, a permissive licence for a customer-facing product or a workflow platform that nobody on your team can maintain.

## Verdict

n8n gives teams a flexible way to connect apps, APIs and internal systems. The visual editor helps you see how data moves, while HTTP requests, code nodes, conditions and sub-workflows cover cases that basic automation tools can struggle with. The Cloud plans use full workflow executions as the billing unit, and a self-hosted Community Edition is available for uses allowed by its licence.

That flexibility is also the main trade-off. A team needs to understand API credentials, data structures, errors, retries and security. Self-hosting adds responsibility for servers, databases, backups, upgrades and monitoring. The Sustainable Use License also means n8n should not be described as unrestricted open-source software. For an internal technical team, these limits may be manageable. For a small non-technical team or a product that sells automation to customers, another platform may be a better fit.

## Quick summary

| Area | Research-based assessment |
| --- | --- |
| Best for | Technical teams automating app, API and internal workflows |
| Main strength | Visual workflows with code and HTTP control |
| Cloud entry price | €20/month billed annually for 2,500 executions |
| Higher Cloud plan | €50/month billed annually for 10,000 executions |
| Business plan | €667/month billed annually, self-hosted only, 40,000 executions |
| Self-hosting | Community Edition available under the Sustainable Use License |
| Main risk | Licensing, maintenance and security need a clear owner |
| Current release note | Version 3.0 is listed as early access; check the migration guide before upgrading |

Prices and product details were checked on November 5, 2026 against the [official pricing page](https://n8n.io/pricing/) and documentation. This is a source-based review, not a hands-on test or a user rating.

## What n8n does

n8n is a workflow automation platform. A workflow starts with a trigger, such as a schedule, webhook or app event. Nodes then read or change data, call another service or send an update. You can add filters, branches, loops and sub-workflows to control what happens next.

The product combines a visual editor with code options. The built-in node catalogue covers many common services, while the HTTP Request node can connect to an API that does not have a dedicated integration. JavaScript and Python Code nodes help when data needs custom handling. This mix makes n8n useful for processes that are too specific for a one-click template but do not justify a full custom application.

The same flexibility can create a maintenance problem. A workflow that uses several APIs needs clear documentation, stable credentials, sensible timeouts and a plan for rate limits. If the person who built it leaves, another team member should be able to understand the trigger, data shape, branches and failure path.

## Key strengths

### 1. One execution can contain many steps

n8n Cloud pricing is based on full workflow executions. The pricing page says a run counts as one execution regardless of how many steps it contains or how much data it processes. That can be attractive for long workflows with many nodes, but it does not make every workload cheap. A workflow that runs every few minutes or receives thousands of webhook events can still use a large execution allowance.

The useful comparison is not “one execution versus one task” without context. Count how often the workflow starts, then compare that with the task or credit model of each alternative. The [n8n pricing guide](/n8n/pricing/) explains the current plan limits and an example calculation.

### 2. Visual building with room for code

The editor helps a builder inspect input and output data at each step. Conditions and routing nodes can split records, while code and HTTP requests cover custom transformations and services. Developers can use this as a visual layer around code rather than writing an entire integration service from scratch.

This is a strength when the workflow has clear owners and review rules. It is not a reason to put complex business logic into one huge canvas. Split large processes into reusable sub-workflows, give nodes clear names and document the data contract between each stage.

### 3. Broad integration options

n8n includes built-in nodes for common services and supports custom API calls. A missing prebuilt node does not always block an integration if the service has a documented API. The cost is that a custom connection needs someone to understand authentication, pagination, rate limits, response formats and API changes.

Before choosing n8n, list the exact apps and operations your workflow needs. A logo in an integration directory does not prove that every endpoint or feature is supported. Confirm the required trigger and action, check the credential method and test the real data fields in a safe environment.

### 4. AI workflow components

n8n includes AI nodes, agent tools and model connections. These can help route text, extract fields, call tools or combine a model with business data. They are useful when an automation needs language understanding, but the workflow still needs limits and controls.

Do not let an AI node make a high-impact change without validation. Use structured outputs, allowed tool lists, human approval where needed, retry limits and logging. Also price the model provider separately where you bring your own API key. The n8n Cloud plan may include Assistant credits, but that is not the same as unlimited third-party model usage.

### 5. Cloud and self-hosting choices

n8n Cloud is managed by n8n. The Starter and Pro plans are hosted by n8n, while the Business plan is listed as self-hosted only. Enterprise can be hosted by n8n or self-hosted. This gives teams a route from a managed trial to a more controlled deployment, but the feature and support terms differ by plan.

Self-hosting can keep the workflow runtime and data on infrastructure you manage. It also makes you responsible for SSL, access, database backups, encryption keys, updates, monitoring, queue capacity and incident response. The official [security overview](https://docs.n8n.io/hosting/securing/overview/) lists controls such as security audits, SSL, SSO, encryption-key rotation, execution-data redaction and SSRF protection.

## Pricing and licensing trade-offs

The public pricing page lists Starter at €20/month billed annually for 2,500 executions, Pro at €50/month billed annually for 10,000 executions, and Business at €667/month billed annually for 40,000 executions. Business is self-hosted only. Enterprise uses custom execution pricing. The Cloud trial has a separate limit of 1,000 executions, five concurrent executions and a 180-second execution timeout. These details can change, so check the [official pricing page](https://n8n.io/pricing/) before buying.

The Community Edition is available as a self-hosted version, but the licence matters. n8n's [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md) allows certain internal business and personal uses. It is not an OSI-approved open-source licence, and it is not a general permission to resell n8n or offer a competing hosted automation service. If your product exposes n8n's functionality to customers, get licensing advice before you build around it.

There are also costs beyond the subscription. A self-hosted instance needs compute, storage, database backups, TLS, monitoring and time from an operator. Cloud users may need separate model-provider charges or additional capacity. The cheapest entry plan is not necessarily the lowest total cost for a production workflow.

## A current upgrade point: n8n 3.0

The n8n documentation lists version 3.0 as an early-access release. The breaking-changes guide says self-hosted deployments need to use Docker-based installation, so teams that currently use npm or npx should not treat the update as a routine version bump. Read the [3.0 breaking changes](https://docs.n8n.io/changelog/v30-breaking-changes/) and [migration tool guide](https://docs.n8n.io/changelog/v30-migration-tool/) before planning an upgrade. Review the migration report and test a copy of the instance before changing production.

This matters to buyers because the deployment method is part of the total cost of ownership. A team that does not want to manage Docker, backups and updates may be better off with n8n Cloud or a fully managed alternative.

## Who should use n8n?

n8n is worth considering when:

- You need multi-step automation across several services and internal APIs.
- A developer or technical operations owner can maintain credentials and workflows.
- You want a visual editor but still need custom code or HTTP requests.
- You need a self-hosted option for an allowed internal business use.
- Your workflow starts often enough that execution-based pricing compares well with task or credit billing.

## Who should look elsewhere?

Look at alternatives when:

- Your team needs the simplest no-code builder and does not have technical support.
- You do not want responsibility for server updates, backups or security.
- You need a permissive licence for a customer-facing automation product.
- Your workflow depends on a specific app action that n8n does not support well.
- A per-user plan or a Microsoft-managed desktop flow better matches your buying model.

Zapier and Make are easier places to start for many cloud-app workflows. Activepieces is worth checking if you want a visual builder with an on-prem path. Power Automate fits Microsoft environments, while Node-RED, Windmill and Kestra serve more technical use cases. Compare them in the [n8n alternatives guide](/n8n/alternatives/).

## n8n review FAQ

### Is n8n worth using?

It can be worth using for technical teams that need visual workflows, APIs, code and deployment choice. It is less attractive if nobody owns maintenance or if the licence does not fit the product you want to build.

### Is n8n free?

The self-hosted Community Edition is available without a software subscription for uses allowed by its licence. You still need infrastructure and maintenance. n8n Cloud offers a trial, not a permanent free Cloud plan.

### Is n8n open source?

n8n source is published under the Sustainable Use License. That licence is not OSI-approved open source, so check the exact terms for internal, commercial and customer-facing use.

### Can n8n run without Docker?

The current documentation lists n8n 3.0 as early access and says self-hosted deployments need Docker-based installation for that version. Review the migration guide before upgrading.

### Does n8n charge for every node?

No. n8n Cloud counts a full workflow run as one execution, regardless of how many steps it contains.

## Review methodology

This review uses official n8n product, pricing, licence, documentation and release-note sources checked on November 5, 2026. We did not connect an account, run a workflow, benchmark execution speed or assign a user rating. The review separates published plan details from operational trade-offs that depend on the deployment and workload. Read the site-wide [review methodology](/review-methodology) for the editorial process.


## More n8n guides

- [n8n hub](/n8n/)
- [n8n review](/n8n/review/)
- [n8n pricing](/n8n/pricing/)
- [How to use n8n](/n8n/how-to-use/)
- [n8n alternatives](/n8n/alternatives/)
- [n8n vs Zapier](/compare/n8n-vs-zapier/)

## Sources

- [n8n product site](https://n8n.io/), checked November 5, 2026.
- [n8n pricing](https://n8n.io/pricing/), checked November 5, 2026.
- [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 5, 2026.
- [n8n security overview](https://docs.n8n.io/hosting/securing/overview/), checked November 5, 2026.
- [n8n 3.0 breaking changes](https://docs.n8n.io/changelog/v30-breaking-changes/), checked November 5, 2026.
- [n8n 3.0 migration tool](https://docs.n8n.io/changelog/v30-migration-tool/), checked November 5, 2026.
