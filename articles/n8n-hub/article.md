# n8n Guide: Workflows, Pricing and Alternatives

n8n is a workflow automation platform for connecting apps, APIs, databases and code in one visual workflow. It fits teams that need branching, custom logic, data mapping or self-hosting. Choose n8n Cloud if you want the vendor to run the service; choose self-hosting only if your team can manage updates, backups, security and uptime. Official product and pricing pages checked November 2, 2026: [n8n](https://n8n.io/) and [pricing](https://n8n.io/pricing/).

## What n8n is built to do

n8n lets you arrange trigger and action nodes into a workflow. A trigger starts the run, later nodes pass data between steps, and branches or code nodes handle cases that do not fit a simple straight line. The official [built-in nodes guide](https://docs.n8n.io/integrations/builtin.md), checked November 2, 2026, lists core nodes, app nodes, trigger nodes, cluster nodes and credentials. Exact node options depend on the service you connect.

This model suits teams that want more control than a simple trigger-and-action recipe. A workflow might receive a form submission, validate fields, look up a customer, call an API, route a result and notify a team. The design is flexible, but someone still needs to decide what happens when an API times out, a field is missing or a token expires.

## Quick facts

| Question | Current answer |
| --- | --- |
| Product category | Workflow automation and integration orchestration |
| Cloud entry price | Starter is listed at €20 per month when billed annually, with 2,500 workflow executions per month. [Official pricing](https://n8n.io/pricing/), checked November 2, 2026. |
| Free option | A free Community Edition is available for self-hosting. Server, storage, maintenance and security still cost time or money. [Pricing](https://n8n.io/pricing/) and [license](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 2, 2026. |
| Usage meter | Cloud plans count a workflow run as one execution, regardless of how many steps it contains. [Official pricing](https://n8n.io/pricing/), checked November 2, 2026. |
| Best for | Teams that need visual workflows, API access, branching, code steps or control over where automation runs. |

## Cloud or self-hosted?

Cloud reduces infrastructure work. n8n handles hosting and platform operations, and the plan table lists execution allowances, concurrency and collaboration features. Self-hosting gives your team more control over infrastructure and deployment, but your team must plan for patching, backups, encryption keys, access control, monitoring and recovery. n8n's [Docker installation guide](https://docs.n8n.io/deploy/host-n8n/install-with-docker.md), checked November 2, 2026, says self-hosting requires server, container, security and scaling knowledge and recommends Cloud when that experience is missing.

Do not treat the Community Edition as permission to resell a hosted n8n service. The [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 2, 2026, limits how the software may be used and distributed. Review the current terms before embedding n8n in a customer-facing product or running automations with third-party credentials for customers.

## Explore the n8n decision guide

- [n8n alternatives](/n8n/alternatives/) compares no-code, developer and orchestration tools.
- [n8n review](/n8n/review/) explains strengths, trade-offs and who should skip it.
- [n8n pricing](/n8n/pricing/) separates Cloud fees from self-hosting costs.
- [How to use n8n](/n8n/how-to-use/) walks through a safe first workflow.
- [n8n vs Zapier](/compare/n8n-vs-zapier/) compares execution and task-based billing.

## Questions to answer before choosing

Write down the systems you need to connect, how often each workflow will run, how much data passes between steps and who will own failures. Estimate Cloud executions from complete workflow runs, not the number of nodes. For self-hosting, add the server, backups, monitoring and staff time to the software cost. Check the license if your use case involves customer-facing services.

If you only need a small set of standard app connections and want a nontechnical owner to maintain them, compare [Zapier](https://zapier.com/pricing) or [Make](https://www.make.com/en/pricing), both checked November 2, 2026. For wider software discovery, use [Browse tools by niche](/browse-tools-by-niche). The best choice is the one that fits your workflow and operating capacity, not the one with the longest feature list.

## Common questions

### Is n8n free?

The Community Edition is available for self-hosting at no software subscription fee. You still pay for infrastructure and the work needed to operate it. n8n Cloud is a paid service with a trial shown on the official pricing page, checked November 2, 2026.

### Does n8n charge per workflow step?

No. n8n Cloud pricing is based on full workflow executions, regardless of the number of nodes.

### Do I need to know how to code?

You can build many workflows with visual nodes, but API setup, data mapping and error handling still need careful thought. Code nodes are available when the workflow needs custom logic.

## Sources and method

Product, pricing, documentation, integration and licensing details were checked November 2, 2026. This guide uses official vendor pages and does not claim hands-on testing. Prices and included limits can change, so confirm them on the linked official pages before buying or deploying.
