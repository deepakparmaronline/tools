# Help Scout: Customer Support Platform Guide

Help Scout is a customer support platform built around shared inboxes, a knowledge base, website support widgets, workflows and AI assistance. It suits teams that want to handle customer email together without making every reply feel like a formal ticket. The free plan is a useful starting point, but it has a 100-contact monthly limit. Paid plans add more inboxes, channels, automation and team controls. AI answers through Envoy are billed separately per resolution, so teams should plan those costs apart from user seats.

## What Help Scout does

Help Scout brings customer messages into a shared Inbox. Teammates can assign conversations, add private notes, use saved replies, view customer history and organize work. The [official Inbox guide](https://docs.helpscout.com/article/231-how-mailboxes-work-in-help-scout) explains how messages reach an Inbox, while the [shared Inbox overview](https://docs.helpscout.com/article/1581-what-is-shared-inbox) covers team collaboration. This setup can work well when agents want to reply in a familiar email style but need visibility into who owns each request.

Docs is Help Scout's knowledge base. Teams can write and organize help articles, then make them available to customers. The [Docs guide](https://docs.helpscout.com/article/129-help-scout-docs) explains the hosted help center. Beacon is the website or in-app widget that can show help content, contact forms and live chat. Its chat option depends on team availability, with the contact form as a fallback when chat is enabled. See the [Beacon setup guide](https://docs.helpscout.com/article/1250-beacon-jumpstart-guide).

## Plans and pricing

The Free plan includes up to five users, one Inbox and one Docs site. It also limits teams to 100 contacts per month, ten saved replies, ten tags, ten Docs articles and 30 days of report history. These caps make Free better for a small team testing a shared support process than a busy support desk.

The paid plans are Standard at US$25 per user per month, Plus at US$45, and Pro at US$75 on the monthly pricing view. The pricing page shows a 16% annual-billing discount. Standard adds more channels and basic workflows. Plus adds advanced workflows, routing, a customer portal and several integrations. Pro adds unlimited workflows and SLAs, more routing choices, SSO/SAML and higher team limits. Prices and plan limits were checked November 18, 2026 on the [official pricing page](https://www.helpscout.com/pricing/). See our [Help Scout pricing guide](/help-scout/pricing/) for a fuller plan-by-plan breakdown.

## Where AI fits

Help Scout includes AI tools for agents, such as writing assistance, summaries and drafts. Envoy is the customer-facing AI assistant. The official pricing page lists Envoy at US$0.75 per resolution and advertises a three-month trial. A resolution is counted when the AI solves a conversation without human assistance. Teams should measure actual resolved conversations before estimating savings.

## Switching and data limits

Help Scout's [Import2 tool](https://docs.helpscout.com/article/1495-import-emails-or-tickets-into-help-scout) can bring in conversations or tickets, customer profiles and tags from supported providers. The standard import does not move users, Inbox settings, help-center articles, saved replies, macros, automations or some custom fields and ticket types. A Zendesk knowledge-base import may require a separate tool arranged with Help Scout. Plan the migration around these gaps instead of assuming one import copies the whole support setup.

Reports can be exported to CSV or XLSX, but report exports do not include conversation thread contents. Other customer, user and conversation data is available through the Inbox API, and Docs articles through the Docs API. See [Data Export Options](https://docs.helpscout.com/article/466-data-export-options). A full backup plan should include the APIs and any custom export work you need.

## Who should choose Help Scout?

Choose it if your team handles a steady stream of customer email, wants a shared inbox and help center, and values a simple way to collaborate on replies. It is also worth comparing if you are moving from a personal or shared mailbox to a dedicated support tool.

Look elsewhere if you need highly complex ticket routing, many custom fields, deep IT service management, a large multibrand operation, or predictable costs based on ticket volume rather than agent seats. Start with the current [software tools directory](/tools/) and browse the [alternatives section](/alternatives/). The live [Freshdesk hub](/freshdesk/) and [Zendesk hub](/zendesk/) help compare more structured help-desk workflows.

## Research-led questions

**Is Help Scout free?** Yes. The Free plan has five users, one Inbox, one Docs site and a 100-contact monthly cap. Check the official pricing page for the current details.

**Can Help Scout replace a ticketing system?** It can manage conversations, assignments, tags, workflows and reporting. Teams that depend on advanced ticket fields or tightly linked incident types should compare their requirements before switching.

**Can I connect an AI agent to Help Scout?** The official [MCP connection](https://docs.helpscout.com/article/1779-help-scout-mcp-server) is read-only for new connections. Standard, Plus and Pro include API access; reporting tools require Plus or Pro.

## Sources and update method

This guide uses Help Scout's official product, pricing and support documentation checked November 18, 2026. It is desk research, not a hands-on test. Review the site-wide [review methodology](/review-methodology) before treating the page as a product evaluation.