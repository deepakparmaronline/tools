> **Short answer:** n8n connects apps, APIs and data through visual workflows, triggers, actions and code. You can use n8n Cloud or self-host its Community Edition, but check the Sustainable Use License before using it in a customer-facing product.

## What is n8n?

n8n is a workflow automation platform for linking services and handling repeat work. A workflow starts with a trigger, then passes data through nodes that read, change or send information. Conditions, loops, sub-workflows and code cover cases that a simple trigger-and-action tool cannot handle well. See the [official n8n product site](https://n8n.io/).

The product is aimed at technical users and teams that want more control over workflow logic. Built-in nodes cover common services, while HTTP requests and JavaScript or Python code can connect to custom APIs and handle data that needs extra work.

## Quick facts

| Question | Current answer |
| --- | --- |
| Product type | Visual workflow automation and integration platform |
| Cloud Starter | €20/month billed annually; 2,500 executions |
| Cloud Pro | €50/month billed annually; 10,000 executions |
| Business | €667/month billed annually; 40,000 executions; self-hosted only |
| Self-hosted option | Community Edition under the Sustainable Use License |
| Billing unit | One full workflow run counts as one execution, regardless of its steps |
| Current upgrade note | n8n 3.0 is early access; review the migration guide before upgrading |

Plan prices and limits were checked on the [official pricing page](https://n8n.io/pricing/) on November 5, 2026. Prices are shown in euros with annual billing. Check the live page for monthly billing, regional terms and taxes.

## How workflows work

A workflow usually starts with a schedule, webhook, app event or manual test. Nodes then read a record, update a service, send a message or call an API. You can inspect data at each step and use conditions to send records down different paths.

n8n also supports reusable sub-workflows, custom API requests, code steps and error workflows. This helps when a process needs data cleanup, branching or retries. It also means the team should document inputs, credentials and failure paths instead of building one large canvas that only its creator understands.

AI nodes can connect a model to business data or tools. They still need limits, structured outputs and human approval where an action can affect customers, money or important records.

## Cloud or self-hosted?

n8n Cloud is managed by n8n, so the vendor handles the instance and its updates. Starter and Pro are hosted by n8n. Business is listed as self-hosted only, while Enterprise can be hosted by n8n or self-hosted. Check the [current plan table](https://n8n.io/pricing/) before choosing.

Self-hosting gives you more control over infrastructure and where workflow data is stored. You also own updates, SSL, access control, database backups, monitoring and capacity. The Community Edition is not a blanket licence to resell n8n or offer a hosted automation service to customers. Read the [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md) and [official licensing guide](https://docs.n8n.io/sustainable-use-license/) before building a commercial product around it.

There is a current upgrade point to check. The n8n documentation lists version 3.0 as early access and says its self-hosted deployment path is Docker-based. Teams using npm or npx should read the [3.0 breaking-changes guide](https://docs.n8n.io/changelog/v30-breaking-changes/) and [migration tool guide](https://docs.n8n.io/changelog/v30-migration-tool/) before planning an upgrade.

## Who should consider n8n?

n8n is worth shortlisting if your team needs multi-step workflows, custom API calls, data transformation or control over where automation runs. It can suit developers and technical operations teams that can own credentials, errors and maintenance.

It may be a poor fit if you want the simplest no-code setup, have no one to maintain a server, need a permissive licence for a customer-facing product or prefer a per-user price. Compare [Zapier](https://zapier.com/), [Make](https://www.make.com/), [Activepieces](https://www.activepieces.com/) and Microsoft Power Automate before committing.

## Explore the n8n guide

- [n8n review](/n8n/review/)
- [n8n pricing](/n8n/pricing/)
- [How to use n8n](/n8n/how-to-use/)
- [n8n alternatives](/n8n/alternatives/)
- [n8n vs Zapier](/compare/n8n-vs-zapier/)
- [Browse tools by niche](/browse-tools-by-niche)

## n8n FAQ

### Is n8n free?

The Community Edition is available for self-hosting, but the licence applies and infrastructure still costs money. n8n Cloud offers a trial, not a permanent free Cloud plan.

### Is n8n open source?

n8n publishes source under the Sustainable Use License. It is not an OSI-approved open-source licence, so review the exact terms for your use.

### Does n8n charge for every workflow step?

No. n8n Cloud counts a full workflow run as one execution, regardless of the number of steps.

### Is n8n 3.0 ready for production?

The documentation lists n8n 3.0 as an early-access release. Review the breaking changes and migration report before upgrading production.

## Sources and update method

Product, pricing, licensing, deployment and release details were checked against n8n's official website, pricing page, documentation and source licence on November 5, 2026. This page is based on desk research and does not claim hands-on testing.
