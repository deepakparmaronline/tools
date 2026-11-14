# How to Use Help Scout: Setup and Workflows

## Before you start

Help Scout works best when the team agrees on how a conversation should move from arrival to resolution. Before connecting a live address, decide which inboxes you need, who owns each queue, what counts as urgent, which questions deserve a saved reply, and which topics should become Docs articles.

A small team can start with the Free plan, which supports up to five users, one inbox, one Docs site, and 100 contacts per month. Paid plans add more inboxes, Docs sites, workflows, SLAs, and channel options. If you are moving from another help desk, read the [migration limits](/helpscout/alternatives/) before you import anything.

## Step 1: Create the account and choose an inbox structure

Create the Help Scout account, then set up the inboxes that match the way the support team works. One inbox is enough for a small team that handles one product and one support address. Separate inboxes can make sense for different brands, products, or departments, but do not create a new inbox for every topic. Too many queues make ownership harder to see.

The Help Scout support guide explains how to create and manage mailboxes. Decide the name, default assignment, who can access it, and the customer address before connecting email. If you need more inboxes than your plan includes, check the extra-inbox price before building the structure.

## Step 2: Connect the support email

Use the email connection flow for the address customers already know. Help Scout provides a forwarding address and setup instructions. Add the forwarding rule at the email provider, complete any verification steps, and send a test message from an outside account.

Check both directions. A message should arrive in the correct Help Scout inbox, and the reply should reach the original sender with the expected From address. Test a reply, a customer follow-up, a CC, and an attachment before announcing the change. If the old system still receives messages, plan the forwarding cutover so two systems do not both reply to the same customer.

For custom domains, follow the current email setup instructions in the Help Scout help center. Menu names can change, so use the account's current Settings or Manage area rather than relying on an old screenshot.

## Step 3: Add teammates and set permissions

Invite the agents and team leads who will use the inbox. Give each person the access they need, not the broadest role by default. Confirm who can manage account settings, billing, inbox configuration, workflows, and Docs content.

Set a clear ownership rule. For example, new billing questions may go to the billing team, product issues to product support, and account questions to customer success. A conversation should have one clear owner even when several teammates add internal notes. This reduces duplicate replies and makes reporting easier.

## Step 4: Create tags, views, and saved replies

Start with a small tag list. Tags should describe a useful category such as billing, login, bug report, refund, or feature request. Avoid creating a tag for every product version or customer name; those details belong in a customer profile or conversation field if your plan and workflow support them.

Create views around the work agents need to see: unassigned conversations, waiting for a customer, urgent requests, or items tagged for a specialist. Views should reduce the number of clicks needed to find work. If a view is never used, remove it.

Saved replies are useful for repeated questions, but they should not sound robotic. Write a short base response, then leave room for the agent to add the customer's context. Review saved replies after policy or product changes so old links and instructions do not stay in circulation.

## Step 5: Connect the channels you actually use

Help Scout's product pages list email, live chat, text, social, and phone as ways to manage customer conversations. The exact setup depends on the channel and plan. The product update dated August 4, 2026 describes connecting a Twilio number for two-way SMS. Help Scout also lists Instagram, Messenger, and WhatsApp connections.

Do not turn on every channel because it is available. Start with the channels where customers already ask for help. Check whether a channel requires an integration, a paid plan, or a separate provider. Test inbound messages, replies, attachments, customer identity, and assignment before making the channel public.

## Step 6: Build a small workflow before adding many rules

A workflow automates actions when conditions match. Start with one simple case, such as adding a tag when a conversation arrives at a billing inbox or notifying a team lead when an SLA is close to a deadline. Test the workflow with a sample conversation and check the result before adding more conditions.

Use manual workflows for repeatable actions that an agent should choose. Use automatic workflows for actions that should happen without a person remembering them. The pricing page separates basic and advanced workflow allowances, so check the plan limit before building a large automation set.

Routing features also differ by plan. Plus lists round-robin routing, while Pro lists balanced routing. If you need skill-based assignment, multiple queues, or complex escalations, compare the routing model with the process you use today.

## Step 7: Create the Docs site

Open Docs and create a site for the help content customers should be able to find. Start with a small set of collections and categories that match the way customers ask questions. A good first group might include getting started, account and billing, troubleshooting, and product guides.

Write articles around one clear task or question. Use a descriptive title, short steps, screenshots only when they add value, and links to related articles. Add a last-reviewed date to your editorial process, even if the public page does not show it. Assign an owner for each article so the knowledge base does not become stale.

If you are migrating from another knowledge base, do not assume the standard import tool will move it. Help Scout says its standard ticket import does not import knowledge base or help center articles. The Docs API can be used for a custom transfer, but that requires API work.

## Step 8: Add Beacon to your site or app

Beacon is the support widget that connects customers to self-service content and contact options. Create the Beacon, choose which support options should appear, and follow the official install instructions for your website builder or application.

Test Beacon on a staging page first. Check that Docs search returns the right articles, that the contact path reaches the correct inbox, and that chat availability matches the team's working hours. If the widget is not visible, check the installation snippet and whether the page loads the script. Avoid launching a widget that promises live chat when no agent is available.

## Step 9: Set SLAs and working hours

Use SLAs only when the team can meet the promise. Define first response and resolution goals for the types of conversations that matter. Set office hours for each inbox if departments work different schedules. Help Scout's product updates describe per-inbox office hours and workflows that can trigger around SLA deadlines.

Tell agents what happens when a conversation is close to a deadline. A workflow might notify a lead, add an internal note, or route a conversation to another team. Review the SLA report regularly and adjust the target if it creates alerts that nobody can act on.

## Step 10: Review reports and plan exports

Use the reports that match your support goals: volume, response time, channel mix, company trends, and customer happiness. Selected reporting data can be exported as CSV or XLSX. Help Scout's data export guide says those report exports exclude conversation thread contents. Customer, user, and conversation data are available through the Inbox API, while Docs articles are available through the Docs API.

If you plan to leave Help Scout later, document the export process now. Do not assume a report download is a complete conversation archive.

## Migration checklist

The standard Help Scout import tool is available to Account Owners and Administrators on Standard, Plus, and Pro. It supports providers including Freshdesk, Gmail, Gorgias, HubSpot Service Hub, Intercom, Zendesk, and Zoho Desk. It can import conversations or tickets with customer profiles and tags.

The import guide says users and inbox settings must be recreated. Knowledge base articles, saved replies, macros, ticket rules, automations, custom fields, ticket types, and custom statuses are not imported through the standard process. Run a sample import, inspect field mappings, and export the unsupported objects from the old system before you switch the live email forwarding. Imports of 500,000 records or fewer are free; larger imports are charged at $500 per 500,000 records, including the first 500,000.

## Common setup problems

- **Email does not arrive:** check forwarding, verification, and the source mailbox rule. Send a test from an external address.
- **Replies come from the wrong address:** review the connected email address and sending settings before going live.
- **A workflow does not fire:** check the trigger, conditions, inbox scope, and whether the workflow is automatic or manual.
- **Agents cannot see the right conversations:** review inbox access, assignment, views, and tags.
- **Beacon does not appear:** confirm the installation code is on the page and the widget is configured for that site.
- **Imported history is incomplete:** check the import mapping and remember that macros, automations, users, inbox settings, and help articles are not part of the standard import.

## Related guides

- Start with the [Help Scout hub](/helpscout/).
- Check the [Help Scout pricing guide](/helpscout/pricing/) before adding inboxes or workflows.
- Read the [Help Scout review](/helpscout/review/) for product fit and limits.
- Compare [Help Scout alternatives](/helpscout/alternatives/) if the migration or routing limits are a problem.
- Read [Help Scout vs Zendesk](/compare/helpscout-vs-zendesk/) for a larger ticketing workflow.

## Frequently asked questions

### Can I use Help Scout with Gmail?

Help Scout can connect a support email address through its email setup and forwarding process. The team should test inbound and outbound messages before switching the public support address.

### Can I create more than one inbox?

Yes, but the number included depends on the plan. The current pricing page lists one inbox on Free, two on Standard, five on Plus, and ten on Pro, with extra inboxes available at an additional cost.

### Does Help Scout import knowledge base articles?

The standard import tool does not import help center articles. Help Scout points to the Docs API for a custom knowledge-base transfer, which requires API work.

### Can I automate ticket assignment?

Help Scout Workflows can automate actions, and the pricing page lists round-robin routing on Plus and balanced routing on Pro. Check the current plan matrix for the routing method your team needs.

### Can I export conversation threads to CSV?

Selected reports can be exported as CSV or XLSX, but the export guide says conversation thread contents are excluded. Other conversation data is obtained through the Inbox API.

## Sources and update note

Steps and limits were checked against Help Scout's official help center, pricing page, import/export documentation, and product updates on November 14, 2026. This is a documentation-based setup guide, not a record of a live account configuration.