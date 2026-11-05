> **Short answer:** n8n Cloud starts at €20 per month for Starter with annual billing and 2,500 workflow executions. Pro is €50 per month for 10,000 executions. Business is €667 per month for 40,000 executions and is self-hosted only. The Community Edition is available to self-host, but its licence and infrastructure costs still matter.

## n8n pricing at a glance

| Plan | Public price shown | Execution allowance | Hosting |
| --- | --- | --- | --- |
| Starter | €20/month, billed annually | 2,500 workflow executions | Hosted by n8n |
| Pro | €50/month, billed annually | 10,000 workflow executions | Hosted by n8n |
| Business | €667/month, billed annually | 40,000 workflow executions | Self-hosted only |
| Enterprise | Contact sales | Custom workflow executions | Hosted by n8n or self-hosted |
| Community Edition | No software subscription price listed | No n8n Cloud allowance; instance capacity applies | Self-hosted |

The public [n8n pricing page](https://n8n.io/pricing/) lists the prices above in euros with annual billing. It also says all plans include unlimited users, workflows and integrations. The Business plan is marked self-hosted only. Enterprise uses custom pricing. Prices and plan features were checked on November 5, 2026; taxes, regional terms and billing options can change the final amount.

## How n8n counts executions

n8n Cloud counts a full workflow run as one execution. The number of nodes or steps inside that run does not change the count. This is different from platforms that bill each action, module or task.

For example, a workflow that runs once every day uses about 30 or 31 executions in a month. A workflow that runs every five minutes can use roughly 8,600 to 8,900 executions per month. Webhook workflows depend on how many events reach the trigger. These are planning examples, not a promise about your own workload.

Before selecting a plan, list every production workflow and estimate how often it starts. Include scheduled runs, webhook events, manual production runs and expected growth. Do not estimate by counting nodes: a 20-node workflow that runs 100 times still uses 100 executions, not 2,000.

## What the Cloud trial includes

The pricing page lists a Cloud trial with 1,000 executions, five concurrent executions, a 180-second execution timeout and one team project. The trial is a way to assess the product, not a permanent free Cloud tier. Trial availability and requirements can vary by plan and region, so check the [live trial details](https://n8n.io/pricing/) before you start.

## Community Edition and self-hosting costs

The Community Edition is available as a standard self-hosted version. That can reduce subscription cost for an internal team, but it does not remove the cost of running the service. You need compute, storage, database backups, SSL, monitoring, access control and time for upgrades. A small test instance and a production instance with high concurrency have different infrastructure needs.

The licence also matters. n8n's source is published under the Sustainable Use License, not an OSI-approved open-source licence. It permits certain personal and internal business uses, but it is not a general permission to resell n8n or offer a competing hosted automation service. Read the [official licence](https://github.com/n8n-io/n8n/blob/master/LICENSE.md) and [licensing guide](https://docs.n8n.io/sustainable-use-license/) before using it in a customer-facing product.

The Business plan is a paid self-hosted option for companies that need more collaboration and governance features. The current pricing page lists shared projects, SSO and LDAP, multiple environments, queue mode and Git-based version control. Enterprise adds custom execution pricing and more governance and support options. Compare the exact feature table instead of assuming every Cloud feature is available in Community Edition.

## Costs beyond the plan

- **Infrastructure:** server, database, storage, backups and bandwidth for self-hosted deployments.
- **Operations:** updates, monitoring, incident response, SSL renewal and capacity planning.
- **AI providers:** model API charges may sit outside the n8n subscription when you bring your own key.
- **Commercial licensing:** customer-facing or embedded use may need a separate licence review.
- **Migration:** rebuilding credentials, webhooks and workflow logic can take time even when JSON exports are available.

These costs are why a free self-hosted installation is not automatically cheaper than Cloud. Compare the total cost of ownership for the people and systems you need to support.

## Which n8n plan should you choose?

Choose Starter if a small team needs a managed instance and its estimated production runs fit within 2,500 executions a month. Choose Pro if you need a larger allowance, more shared projects or additional workflow history. Consider Business if your company needs the listed collaboration and governance features and is prepared to host the instance itself. Contact n8n for Enterprise if you need custom execution volume, extended retention, secret-store integration or dedicated support.

If you are still learning, use the trial to build a representative workflow and review the execution count. Do not test only a two-node demo if your production process will run every few minutes or process many webhook events.

## Current n8n 3.0 deployment note

The documentation lists n8n 3.0 as an early-access release. Its breaking-changes guide says self-hosted deployments need a Docker-based installation. If your current instance uses npm or npx, read the [3.0 breaking-changes guide](https://docs.n8n.io/changelog/v30-breaking-changes/) and [migration tool documentation](https://docs.n8n.io/changelog/v30-migration-tool/) before planning an upgrade. Do not add the cost of a rushed migration to a plan comparison without first checking the required deployment changes.

## Which n8n pages should you read next?

- [n8n hub](/n8n/) for product basics and deployment choices.
- [n8n review](/n8n/review/) for strengths, limits and licence trade-offs.
- [How to use n8n](/n8n/how-to-use/) for workflow setup and export guidance.
- [n8n alternatives](/n8n/alternatives/) for other automation platforms.
- [n8n vs Zapier](/compare/n8n-vs-zapier/) for a direct cost-meter comparison.

## n8n pricing FAQ

### How much does n8n cost per month?

The public annual-billing prices checked on November 5, 2026 are €20/month for Starter, €50/month for Pro and €667/month for Business. Business is self-hosted only. Enterprise pricing is custom.

### Does n8n have a free plan?

n8n offers a self-hosted Community Edition under its Sustainable Use License and a Cloud trial. The trial is not a permanent free Cloud plan.

### Does n8n charge per node or workflow?

n8n Cloud counts a full workflow run as one execution. A workflow with many nodes still counts as one execution each time it runs.

### Is n8n Business a Cloud plan?

No. The current pricing page marks Business as self-hosted only. Enterprise can be hosted by n8n or self-hosted.

### Is self-hosting n8n free?

The Community Edition has no listed software subscription price, but server, database, backups, security and maintenance still cost money. The Sustainable Use License also limits some commercial uses.

## Sources and update method

Prices, execution rules, trial limits, deployment options and licensing were checked against the official n8n pricing page, documentation and source licence on November 5, 2026. This guide does not assume a monthly price where the page displays annual billing.
