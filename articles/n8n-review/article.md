# n8n Review: Features, Pricing and Trade-Offs

## Verdict

n8n is a strong option for teams that need visual workflow design with room for custom logic, API requests and self-hosting. Its execution-based Cloud pricing can suit workflows with many steps, while the Community Edition gives technical teams a no-subscription way to run the software on their own infrastructure. The main trade-off is ownership: self-hosting adds security and maintenance work, and the license limits some commercial uses. Choose it when control and workflow flexibility justify that responsibility.

## Quick summary

- **Best for:** Technical teams automating multi-step processes across apps, APIs and data systems.
- **Price from:** Cloud Starter is listed at €20 per month billed annually for 2,500 executions. Checked November 2, 2026. [Official pricing](https://n8n.io/pricing/).
- **Free option:** Community Edition for self-hosting. Server, security, backups and maintenance remain your responsibility.
- **Main limit:** Self-hosting requires technical operations skills, and the Sustainable Use License limits some customer-facing and resale use cases.

## What n8n does

n8n connects triggers, app actions, transformations and code into a visual workflow. It can be used for lead routing, data synchronization, scheduled reporting, API orchestration and AI-related tasks. The official [product site](https://n8n.io/) and [built-in node reference](https://docs.n8n.io/integrations/builtin.md), checked November 2, 2026, describe the platform and its integration families.

The main distinction is the full workflow model. Rather than treating every action as a separate task, n8n Cloud counts a workflow run as an execution regardless of node count. This is helpful when a single event needs many transformations, but it does not remove the need to monitor retries, API limits or the cost of services called by the workflow.

## Key features that affect the decision

### 1. Visual node workflows

The canvas makes the path from trigger to result visible. A workflow can branch based on a value, transform data, call another service and route errors. That makes it easier to inspect a process than a long collection of disconnected scripts. The benefit depends on design quality: a graph with unclear names and too many branches can become difficult to maintain.

### 2. App nodes and API requests

The built-in node catalog includes core nodes, app nodes, trigger nodes and credentials. The current pricing page also lists custom API requests and code steps. When a native node lacks an operation, an HTTP request can cover a gap, but the builder must understand authentication, pagination, rate limits and response formats. A connector count alone does not prove the exact endpoint you need is available.

### 3. JavaScript and Python code steps

Code steps can handle a transformation that is awkward to express visually. This is useful for normalizing dates, mapping nested data or applying a rule before sending records to another system. The trade-off is that code requires review, tests and an owner who can debug it. Use the simplest approach that makes the workflow readable to the next maintainer.

### 4. Cloud and self-hosted deployment

Cloud removes much of the infrastructure work. Self-hosting gives an organization more control over deployment and data location, but it also moves patching, backup recovery, server security and capacity planning to that organization. n8n's [Docker guide](https://docs.n8n.io/deploy/host-n8n/install-with-docker.md), checked November 2, 2026, warns that self-hosting requires technical knowledge and recommends Cloud for teams without that experience.

### 5. AI and agent-related nodes

The current pricing page lists agent and model-related features across plans, with Assistant credits and some evaluation capabilities varying by tier. These allowances are separate from workflow executions and from any usage charges billed by an external model provider. If AI is central to your workflow, list every metered component before you estimate costs.

### 6. Workflow export and portability

n8n supports workflow JSON export and import and documents CLI and API approaches for moving workflows. The official [export/import guide](https://docs.n8n.io/build/manage-workflows/export-and-import.md), checked November 2, 2026, warns that exported files can contain credential names and IDs, and cURL imports can include authentication headers. Treat workflow files as sensitive until they have been reviewed and cleaned.

## Pricing and total cost

The official pricing page checked November 2, 2026 lists Starter at €20 per month billed annually for 2,500 executions, Pro at €50 for 10,000 executions and Business at €667 for 40,000 executions. Business is self-hosted only. Enterprise pricing is custom. The plan page has a monthly billing option, so verify the exact amount and commitment at checkout before buying.

The free Community Edition is a separate self-hosted route. It removes the software subscription fee, not the cost of infrastructure and operating time. Include compute, backups, monitoring, secure access, upgrades, recovery testing and the person who responds when a workflow fails. For a business-critical workflow, those costs are part of the decision even if the server is inexpensive.

n8n's execution model can compare well with per-action services when each run contains many steps. Still, do not assume it is automatically cheaper. Estimate full monthly runs, retries and sub-workflows, then add costs for external APIs, AI models, storage and the people who maintain the process. The [n8n pricing guide](/n8n/pricing/) explains the current plan table and cost worksheet.

## Strengths and limits

### Strengths

- Execution-based Cloud pricing that does not count every node as a separate task.
- Visual branching and data mapping with code steps when needed.
- Self-hosted option for teams able to operate their own instance.
- Workflow export and import options that support a controlled migration process.

### Limits

- Self-hosting creates ongoing security, backup, update and monitoring work.
- Complex workflows need documentation and testing to remain understandable.
- Cloud execution quotas and concurrency must be matched to workload peaks.
- The Sustainable Use License restricts some forms of resale and customer-facing use.

## Who should use n8n?

n8n fits technical teams, operations engineers and builders who need more control than a basic automation recipe offers. It is especially worth considering when one event triggers several data transformations or API actions, when the workflow needs custom branching, or when the organization wants to run the software on its own infrastructure.

It can also fit a small team that is willing to learn the editor and test carefully. Start with a workflow that has a clear owner, a low-risk output and a known failure path. Document expected data, credentials, trigger conditions and recovery steps so the workflow does not depend on one person's memory.

## Who should skip it?

Skip self-hosting if your team cannot patch servers, protect credentials, restore backups and monitor failures. n8n Cloud may still fit, but compare it with simpler managed tools if the process is a standard two-step connection that a business user needs to maintain.

Review the license before building a customer-facing automation product or a hosted service for third parties. The [official Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 2, 2026, describes use and distribution limits. Ask n8n about the appropriate commercial license if your model falls outside permitted use.

## Alternatives and next steps

Choose Zapier when broad standard app coverage and low setup effort matter more than self-hosting. Compare Make when you want a visual scenario builder and can model its operation-based credits. Consider Activepieces for its free entry tier and self-hosting choices, Pipedream for code-first API work, Node-RED for event-driven and IoT flows, Windmill for scripts and internal tools, or Kestra for data orchestration. The [n8n alternatives guide](/n8n/alternatives/) explains which workflow shape fits each option.

Before switching, export a small workflow, list credentials and external services, rebuild it in the target tool and compare outputs. Do not assume a workflow JSON file will transfer into a different product without changes. Keep the original available until the replacement has handled normal runs and known failure cases.

## Common questions

### Is n8n free to use?

The Community Edition is available for self-hosting without a software subscription. Cloud plans are paid after the trial. Infrastructure and license terms still matter.

### Does n8n charge per step?

No. Cloud pricing is based on full workflow executions, regardless of node count. Other providers used by the workflow may charge separately.

### Is n8n suitable for nontechnical users?

The visual editor helps, but credentials, data mapping and error handling can still require technical support. Start with a small process and test it before activation.

### Should I self-host n8n?

Self-host only when you can manage updates, backups, access control, server security and recovery. Otherwise consider n8n Cloud or a managed alternative.

## Review methodology

This review compares official product descriptions, plan details, documentation and license terms checked November 2, 2026. It does not claim hands-on testing, a performance benchmark or a user rating. Recommendations are editorial judgments based on workflow needs and the operating effort each deployment model requires.

## Sources

- [n8n product overview](https://n8n.io/), checked November 2, 2026.
- [n8n pricing and plan comparison](https://n8n.io/pricing/), checked November 2, 2026.
- [Built-in nodes reference](https://docs.n8n.io/integrations/builtin.md), checked November 2, 2026.
- [Export and import workflows](https://docs.n8n.io/build/manage-workflows/export-and-import.md), checked November 2, 2026.
- [Docker installation guide](https://docs.n8n.io/deploy/host-n8n/install-with-docker.md), checked November 2, 2026.
- [Sustainable Use License](https://github.com/n8n-io/n8n/blob/master/LICENSE.md), checked November 2, 2026.
