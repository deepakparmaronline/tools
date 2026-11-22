# How to Use Help Scout: Setup Guide

To use Help Scout, start with one shared Inbox, connect your support email, add the right teammates and decide how conversations should be assigned. Then publish a small Docs knowledge base and add Beacon if customers need help from your website. Build workflows only after the basic process works, so automation does not hide a broken support routine.

## What you need before setup

Prepare the email address customers already use, the people who will answer messages and a simple list of the requests your team receives most often. Decide who owns new conversations, who handles billing or technical questions and who can change account settings.

Check the plan before inviting the full team. Free includes up to five users, one Inbox, one Docs site and 100 contacts per monthly cycle; Standard includes two Inboxes, Plus five and Pro ten. Workflows are on Standard, Plus and Pro, while custom fields are on Plus and Pro. See the [Help Scout pricing guide](/help-scout/pricing/) before you build a process around a feature that may not be on your plan. These details were checked November 22, 2026 on the [official pricing page](https://www.helpscout.com/pricing/) and [Free plan guide](https://docs.helpscout.com/article/1597-free-plan).

## Quick setup: create your support workspace

### 1. Create your first Inbox

Help Scout creates the first Inbox during account setup. To add another one later, open Settings, choose Inboxes and select New Inbox. Enter the email address and Inbox name. Help Scout creates an address on its own subdomain that can receive messages.

Before adding many Inboxes, decide whether separate teams really need separate queues. Extra Inboxes have a charge when you go beyond the plan's included count. The [Create and Manage Inboxes guide](https://docs.helpscout.com/article/846-create-and-manage-mailboxes-in-help-scout) shows the current menu path and additional Inbox billing.

### 2. Connect your existing support email

If you want to keep an address on your own domain, open Settings, select Inboxes, choose the Inbox and open Connect Email & Social. Enter the domain email address and copy the Help Scout address shown on the screen. Then set up forwarding or redirection with your email provider.

Send a test message after forwarding is configured. Do not start replying from both the old provider inbox and Help Scout. Help Scout warns that replies sent from the original provider will not appear in the Help Scout conversation, which can split the record. Follow the [official email connection guide](https://docs.helpscout.com/article/830-get-your-email-into-help-scout) and [shared email forwarding guide](https://docs.helpscout.com/article/1752-forward-your-shared-email-in-to-help-scout).

### 3. Add teammates and choose permissions

Use the account owner or administrator account to add the people who need access. Give each person the role that matches their work. Administrators can manage settings and users. Standard Users can work in the Inboxes they can access and edit Docs articles, but they cannot manage workflows, custom fields or saved replies by default. Light Users are available on Plus and Pro and can view conversations and leave notes, but cannot reply to customers.

Review the [Help Scout user roles guide](https://docs.helpscout.com/article/15-user-roles-and-permissions) before changing access. Keep billing and role-permission control with a small number of trusted people.

### 4. Set a simple assignment process

Open a conversation and use the Assignee control in the details panel to choose the teammate responsible for it. You can also assign from a folder or while replying or adding a note. Use one owner for each active request. A shared Inbox should make work visible, not leave every message owned by everyone.

The [conversation assignment guide](https://docs.helpscout.com/article/842-assign-conversations) explains the available methods. The shared Inbox also supports collision detection and private notes, so teammates can ask for help without sending an internal discussion to the customer.

### 5. Add a few saved replies

Create saved replies for questions that have a stable answer, such as where to find an invoice or how to reset an account password. Open Settings, choose Inboxes, select your Inbox and open Saved Replies. Choose New Saved Reply, name it and write the response. You can also create one from the conversation editor by using the slash menu.

Do not turn every answer into a saved reply. Keep personal details, changing prices and account-specific instructions out of shared templates. Review saved replies when policies or product steps change. The [saved replies guide](https://docs.helpscout.com/article/18-create-saved-replies-for-fast-answers) explains how to create, edit and use them.

## Publish a Docs knowledge base

A help center is useful when customers ask the same questions often. Start with a short set of articles for account access, billing, common product tasks and contact options. Write each article for one question and keep the steps in the order a customer sees them.

To create a Docs site, open Settings and choose Docs Sites, then select New Site. Add a collection so the site has a place to organize articles. To create an article, open Tools, choose Docs, select a collection and use the Create menu. Add a title and URL slug, write the content, choose categories and preview the page before publishing.

The official [multiple Docs sites guide](https://docs.helpscout.com/article/229-multiple-docs-sites) explains site setup and collections. The [article creation guide](https://docs.helpscout.com/article/182-create-and-manage-docs-articles) shows how to create, preview and publish an article. Do not publish an empty help center just to complete setup. A small set of accurate answers is better than a large collection of old instructions.

## Add Beacon to your website

Beacon can show help articles and contact options on a website or app. Open Tools, select Beacons and choose Create a Beacon. Give it a name, set the button style and choose the contact options. Connect it to the Inbox that should receive form submissions and chats. Then choose a Docs site if you want self-service content to appear in the widget.

You can enable Scout where your plan and configuration allow it. Copy the installation code and give it to the person who manages the website, or use the Beacon JavaScript API if you need a custom trigger. A Beacon is associated with one Inbox. When chat is enabled, the email form remains available as a fallback if no team member is online. Follow the [official Beacon setup steps](https://docs.helpscout.com/article/1232-create-a-new-beacon).

## Create workflows after the basics work

Workflows are available on Standard, Plus and Pro. Open Settings, select Inboxes, choose your Inbox and open Workflows. Select New Workflow, give it a name and choose Manual or Automatic. For an automatic workflow, add conditions such as a subject or tag match, then choose the actions to apply. Review the summary and activate it only after checking the conditions.

Start with a low-risk action, such as adding a tag or assigning a conversation. Test the rule on a small set of messages before using actions that send replies or change status. Automatic workflows can apply to previous conversations if you enable that option. Read the [workflow guide](https://docs.helpscout.com/article/22-get-started-with-workflows) before turning on a rule that could affect a large backlog.

## Moving from another help desk

Help Scout's Import2 tool can import conversations or tickets, customer profiles and tags from supported providers. The tool is available to Account Owners and Administrators on Standard, Plus and Pro. The standard import does not bring over users, Inbox settings, knowledge base articles, saved replies, macros, automation rules or some custom fields, ticket types and statuses.

Create users and Inboxes before the sample import so records can be mapped. Run a sample and inspect conversation history, tags and attachments before planning the full move. If you are moving from Zendesk and need knowledge base articles, contact Help Scout before starting because a separate older import path may be available. For unsupported providers, a custom import through the Inbox API may be possible but requires development work. See the [official import guide](https://docs.helpscout.com/article/1495-import-emails-or-tickets-into-help-scout).

Do not treat a report export as a full backup. CSV and XLSX report exports exclude conversation thread contents. The Inbox API can provide customer, user and conversation data, while the Docs API provides Docs articles. The [data export guide](https://docs.helpscout.com/article/466-data-export-options) lists those routes.

## Common tasks after launch

- **Assign a request:** Open the conversation and choose a user in the Assignee control.
- **Ask a teammate for help:** Add a private note and mention the teammate rather than sending an internal question to the customer.
- **Reuse a standard answer:** Open the reply editor and select a saved reply from the shortcut menu.
- **Publish a new help article:** Open the correct Docs collection, create the article, preview it and publish when the instructions are correct.
- **Review a workflow:** Open Inbox settings and check whether each workflow is active, incomplete or flagged for review.

## Tips for a reliable setup

Start with one Inbox, clear ownership and a small tag set. Assign an owner and review date to each Docs article. Check the Unassigned folder daily and review reports after launch.

If you use custom fields, remember that they belong to an Inbox. Help Scout says field values do not carry over when a conversation moves to a different Inbox. This matters when designing a multi-Inbox setup. The [custom fields guide](https://docs.helpscout.com/article/593-custom-fields) explains the limits and behavior.

## Common setup mistakes

- **Forwarding is not tested:** Send a test message and confirm it appears in the right Inbox before changing the customer-facing process.
- **Agents keep replying in the old mailbox:** This can split conversation history between systems.
- **Too many Inboxes are created:** Start with one and add more only when ownership or reporting needs justify them.
- **The team expects every old setting to import:** Rebuild users, Inbox settings, saved replies and workflows as needed.
- **Automation is activated too early:** Test conditions and actions before applying a workflow to existing conversations.
- **Docs articles are published without a review owner:** Assign someone to keep the content accurate.

## Troubleshooting

**Email is not arriving.** Check that the domain address is connected to the correct Inbox, confirm forwarding at the email provider and send another test message. Review the provider's forwarding rules if the test does not arrive.

**Live chat is not visible.** Beacon chat only appears when Help Scout Users are online and available. Keep the contact form enabled as the fallback.

**A Docs site is not public.** Check that it has a collection and published articles. Help Scout says a Docs site becomes active once a collection is added.

**A workflow is marked incomplete.** Review its conditions and actions for deleted users, teams, Inboxes or custom fields, or a feature your plan does not support.

**MCP report tools return no data.** Help Scout says reporting tools require Plus or Pro. The connection is read-only for new setups, and Docs search also needs a Docs API key.

## Help Scout setup questions

**How do I connect my support email to Help Scout?**

Open the Inbox settings, connect your domain address, copy the Help Scout Inbox address and configure forwarding with your email provider. Send a test message before switching the team.

**How do I create a Help Scout knowledge base?**

Open Settings, choose Docs Sites and create a site. Add a collection, then create, preview and publish articles from Tools > Docs.

**Can I use Help Scout workflows on the Free plan?**

No. Help Scout lists workflows on Standard, Plus and Pro. The Free plan has an Inbox auto-reply feature, but not the paid workflow system.

**What does Help Scout import from another help desk?**

The standard Import2 tool can bring conversations or tickets, customer profiles and tags from supported providers. Users, Inbox settings, knowledge base articles, saved replies and automation rules are not included.

**Can I export Help Scout conversation threads?**

The in-app report export excludes conversation thread contents. Help Scout says other customer, user and conversation data can be obtained through the Inbox API, and Docs articles through the Docs API.

## More Help Scout guidance

Use the [Help Scout review](/help-scout/review/) to assess whether the platform fits your team, and the [pricing guide](/help-scout/pricing/) to check plan costs. If you are still choosing a platform, compare the [Help Scout alternatives](/help-scout/alternatives/) and the [Help Scout vs Zendesk guide](/compare/help-scout-vs-zendesk/).

Last updated: November 22, 2026. This setup guide follows Help Scout's official support documentation checked on that date. Menu labels and plan access can change, so confirm them in your account before a migration or major workflow change.
