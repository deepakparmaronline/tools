# n8n Pricing: Cloud Plans and Self-Hosting

n8n Cloud pricing is based on monthly workflow executions, while the self-hosted Community Edition has no software subscription fee. The current pricing page lists Starter at €20 per month billed annually, Pro at €50, and Business at €667. Business is self-hosted only; Enterprise pricing is custom. These prices and limits were checked November 2, 2026 on the [official n8n pricing page](https://n8n.io/pricing/).

## n8n plans at a glance

| Plan | Price shown | Execution allowance | Hosting and main fit |
| --- | --- | --- | --- |
| Community Edition | Free software | No Cloud execution quota; your infrastructure sets capacity | Self-hosted. Best for technical users who can operate the service. |
| Starter | €20 per month, billed annually | 2,500 executions per month | Hosted by n8n. One shared project and five concurrent executions. |
| Pro | €50 per month, billed annually | 10,000 executions per month | Hosted by n8n. Three shared projects, up to 50 concurrent executions, admin roles and workflow history. |
| Business | €667 per month, billed annually | 40,000 executions per month | Self-hosted only. Six shared projects, SSO and LDAP, environments and Git version control. |
| Enterprise | Contact sales | Custom | Cloud or self-hosted, with enterprise governance and dedicated support options. |

All plan prices and execution allowances in this table were checked November 2, 2026. The displayed prices are monthly equivalents for annual billing. n8n's pricing page has a monthly billing option and says annual billing saves 17 percent; check the live toggle for the exact month-to-month rate before comparing offers. Taxes, currency conversion, infrastructure and third-party service charges may change your final bill.

## Understand what an execution means

One execution is a full workflow run, not one node or action. A workflow with a trigger, six transformations and three API actions still counts as one execution when it runs once. This can make complex flows easier to estimate than tools that count each successful action as a task. The trade-off is that the entire workflow still consumes an execution even when the run stops early or fails after it has started. Read the current plan terms before building a budget around retries or frequent schedules.

Estimate volume from the number of full runs. For example, a workflow that runs 40 times per day for 30 days creates about 1,200 monthly executions if each schedule produces one run. If it runs for each incoming record, count records rather than calendar triggers. Add allowance for retries, testing and workflows that call other workflows, then compare the estimate with the plan quota.

## What changes between Cloud plans?

Starter is a starting point for a small production workflow. It includes one shared project and five concurrent executions. Pro increases the execution allowance, includes three shared projects and up to 50 concurrent executions, and adds admin roles, global variables, workflow history and execution search. The current page lists up to 9,600 Assistant credits per month on Pro. These details were checked November 2, 2026 on the [official plan table](https://n8n.io/pricing/).

Business is a different decision because it is self-hosted only. The plan lists 40,000 executions, six shared projects, SSO and LDAP, multiple environments, queue mode and Git version control. You need a server and someone to run it, so the license fee is not the full cost. Enterprise is quoted and may be hosted by n8n or self-hosted, with more concurrency, extended insight retention, external secret stores, log streaming and a dedicated support SLA. Ask sales for written terms when those controls are required.

## What is free, and what costs extra?

The Community Edition can be self-hosted without a software subscription, but it is not a no-cost operation. Include compute, database storage where used, backups, monitoring, network access, TLS, upgrades, incident response and the time needed to debug failed workflows. A low-cost server may be enough for a small internal workflow, but capacity and reliability depend on how much work it runs and how you configure it.

Cloud plans include a monthly execution allowance and some AI Assistant credits. AI credits are not the same as workflow executions. The pricing page also describes features that differ by plan, so check whether a specific feature, environment, access control or support option is included before you rely on it. External API providers can charge separately for their own usage, such as model tokens, SMS, email or a paid source application.

License terms also matter. The Community Edition is governed by n8n's Sustainable Use License, not a blanket permission to resell a hosted service. The [official license](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 2, 2026, describes use limits. If your business will offer hosted automations to customers, embed the editor in a commercial product or operate workflows with customer credentials, ask n8n for the license that fits the plan.

## Which plan should you choose?

- **Choose Community Edition** if the workflow is internal, your team can run servers securely and you accept responsibility for upgrades and recovery.
- **Choose Starter** if you want n8n Cloud and your forecast fits the 2,500 execution allowance with one shared project.
- **Choose Pro** if a larger execution allowance, more shared projects, history and admin controls matter.
- **Consider Business** if you need self-hosted deployment with SSO, environments and Git version control, and the listed fee fits your operating budget.
- **Talk to Enterprise sales** if your governance, support, concurrency or data retention needs require a custom agreement.

## How to avoid a poor estimate

Use a representative week of real workload rather than guessing from the number of connected apps. Include normal runs, retries, backfills and manual runs. Separate execution count from API usage because a provider may meter each API request or AI call independently. If the automation must run at a fixed time, also budget for monitoring and alerting so a missed run is noticed.

Compare total cost over the same period. An annual n8n price should not be compared directly with a competitor's monthly price without noting the commitment. A self-hosted plan should include server and maintenance costs. A plan with more included executions is not automatically cheaper if most of the quota stays unused, and a lower license price is not useful if your team cannot maintain the workflow.

## Related n8n guides

- [n8n guide](/n8n/) explains the product and deployment choices.
- [n8n review](/n8n/review/) evaluates the fit and trade-offs.
- [n8n alternatives](/n8n/alternatives/) compares other automation models.
- [How to use n8n](/n8n/how-to-use/) covers setup and troubleshooting.
- [n8n vs Zapier](/compare/n8n-vs-zapier/) compares usage billing.

## Common questions

### Is n8n Cloud free forever?

The official pricing page shows a free trial, not a permanent free Cloud tier. The Community Edition is a separate self-hosted option. Checked November 2, 2026.

### Does n8n charge per node?

No. Cloud billing is based on workflow executions, regardless of workflow complexity. Other connected services may have their own usage fees.

### Is self-hosted n8n really free?

The Community Edition has no software subscription fee, but the server, backups, maintenance and security work are not free. Review the license for your intended use.

## Sources and pricing method

Plan prices, billing basis and feature details were checked November 2, 2026 on the [official pricing page](https://n8n.io/pricing/). Hosting and licensing notes were checked in the [official Docker guide](https://docs.n8n.io/deploy/host-n8n/install-with-docker.md) and [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md). Verify the current plan selector and written terms before purchase.
