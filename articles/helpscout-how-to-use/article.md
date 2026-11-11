# How to use Help Scout

Canonical: https://toolboxkart.tech/helpscout/how-to-use/

**Short answer:** Set up Help Scout in this order: create the first Inbox, connect and test the support email, invite teammates, publish a Docs site, add Beacon, then build a small set of workflows and service rules. Add AI and extra channels only after the basic customer path works.

## What to prepare before setup

Collect the support address, domain access, teammate list, current help articles and a short list of common customer questions. Decide who owns billing, account settings, the knowledge base and workflow changes. If you are moving from another help desk, export a sample first and record which fields, tags, attachments and customer records must be kept. Help Scout can import selected email or ticket history, but its official import guide does not promise a full copy of the old platform.

Write down the first three queues your team actually needs. For example, a small software company may need Product Support, Billing and Account Access. A separate inbox is useful when a different group owns the response or has a different service target. If the only difference is the topic, a tag or saved view may be easier to manage.

## 1. Create your first Inbox

Start with one shared Inbox for the support address that receives the most customer requests. In Help Scout, open the Inbox area and create a new inbox. Give it a name that describes the work, such as Customer Support. Add a short description for teammates so they know which requests belong there. Keep the first setup simple. You can add more inboxes after you understand the volume and ownership pattern.

Before you invite the whole team, send one test conversation into the new inbox. Check that the subject, sender and message body appear correctly. Reply from the inbox and confirm the reply reaches the test address. This checks both the incoming and outgoing path. If the message does not arrive, confirm the support address and forwarding instructions in the official email setup guide.

## 2. Connect and verify the support email

Use the email connection method shown in your account. If Help Scout asks you to forward mail from an existing provider, add the forwarding rule there and complete any verification step. Avoid setting up two forwarding methods for the same address. Duplicate routes can create duplicate conversations or make it hard to see which system owns the message.

Test more than one case: a new email from an external address, a reply to an existing conversation and a message with an attachment. Check the sender name, reply address and signature. If you use a custom domain, review the sending and authentication instructions for SPF, DKIM and DMARC with your mail provider. The goal is to make replies trustworthy and keep messages out of spam folders.

## 3. Invite teammates and set roles

Invite the people who will answer customers or manage the support workspace. Give each person the role they need. Keep Account Owner and Administrator access limited to people who manage billing, security, inboxes or integrations. Other agents can work from the conversations without changing account-wide settings. Review access when a person changes role or leaves the team.

Agree on a small set of working rules before launch. Decide who owns an unassigned conversation, when an agent should add a private note, when to use a tag and when to move a conversation to another inbox. Use one naming pattern for tags and saved replies. If every agent creates their own tag for the same issue, reports and views become harder to trust.

## 4. Build the Docs knowledge base

Create a Docs site for answers customers can use without contacting support. Start with a few collections that match how people look for help: Getting Started, Account and Billing, Product Features and Troubleshooting. Write one article for each common question before moving a large archive. Each article should answer one task, explain the steps and say what to do if the steps do not work.

Use a clear title, short paragraphs and numbered steps for actions. Add screenshots only when they help the reader find a control. Keep a source owner for each article and set a review routine. A large help centre with old instructions is less useful than a smaller set of current answers. If you already have articles in another system, check the import guide. Help Scout says its import tool does not bring every knowledge base article or the old platform's configuration as native Help Scout objects.

## 5. Add Beacon to your website

Beacon connects the help centre with the place where customers ask for help. Create a Beacon, choose the Docs content it should show and add the contact options your team can support. Place the widget on the pages where customers need answers, such as pricing, onboarding and account settings. Do not put it on every page just because the code is available. The widget should help the visitor finish a task or reach the right team.

Test Beacon as a visitor who is not signed in. Search for a common question, open an article and use the contact option. Confirm the resulting conversation appears in the correct Inbox. If the widget shows old content, review the Docs collection and its visibility. If the contact form sends to the wrong team, check the Beacon and Inbox settings before adding more rules.

## 6. Build a small set of Workflows

Workflows help the team apply repeatable actions when a conversation matches a condition. Start with simple rules, such as applying a tag when a message arrives at a known address, assigning a conversation to the right group or sending an internal notification when a request needs attention. Keep each rule focused on one job. Use clear names that explain what it does.

Test every workflow with one conversation that should match and one that should not. Check whether the rule changes the right tag, owner or status. Avoid overlapping rules that keep changing the same field. If you need an approval or a human review, do not automate the final decision. Let the workflow prepare the conversation and leave the judgment with an agent.

## 7. Set service targets and saved views

Use views to give agents a short list of work they can act on. Examples include Unassigned, Waiting for Customer, Needs Follow-up and High Priority. Keep the names consistent with your team's process. A view is useful when it answers a question such as "What should I work on next?" It is not useful when it becomes another place to store every possible tag.

If the team has a response-time commitment, review the SLA options on the plan you intend to buy. Standard lists one basic SLA policy, Plus lists two advanced policies and Pro lists unlimited SLAs. Do not promise a service target until working hours, ownership and escalation are clear. A target without an owner can make reports look good while customers wait.

## 8. Connect the channels you can support

Help Scout product pages describe support across email and website messaging, with other channels and integrations depending on the plan and connection. The Fall 2026 product update page also describes SMS and customer portal changes. Before adding a channel, confirm that it is available to your account, check whether a third-party provider is needed and decide who owns the new queue. Test the channel with a real internal account before promoting it to customers.

## 9. Configure Scout or the AI agent carefully

Help Scout's pricing page lists AI assistance and an Envoy resolution-based add-on. Its setup documentation describes how to configure Scout. Start by checking which sources the agent can use, what content should be excluded and when it should hand the conversation to a person. Make sure the Docs site is current before you let an AI agent answer from it.

Test a small set of questions that include a clear answer, an answer that is missing from Docs and a request that needs an account-specific decision. The agent should answer the first, say it does not know or point to a human for the second, and hand off the third. Do not compare the US$0.75 Envoy price directly with another vendor's per-seat price or per-session fee. They measure different things.

## 10. Review the first month

After launch, check the number of conversations, unassigned work, first response time, reopened cases and common tags. Review which Docs articles people open and which searches return no useful answer. Ask agents where they still copy information between systems. Fix the process before adding more automation. Help Scout's Signal and reporting features can help the team look for patterns, but the report is only useful when tags and ownership are consistent.

## Common tasks after setup

- **Assign a conversation:** open the conversation, choose the teammate or team that owns the next step and add a private note if the handoff needs context.
- **Use a saved reply:** create a reply for a common answer, then review it when the product or policy changes. A saved reply should not contain an old price or a promise that no longer applies.
- **Tag a conversation:** use a small set of tags for issue type, product area or escalation. Avoid creating a new tag for every customer.
- **Close the loop:** set a reminder or follow-up view for conversations waiting on another team or the customer.
- **Update Docs:** assign an owner to each article and check it after a product release or policy change.

## Common setup problems

### Email does not arrive

Check that the support address is verified, the forwarding rule is active and the correct inbox receives the message. Send a new test from an outside address. If a duplicate appears, check for more than one forwarding route.

### Replies go to spam

Check the sender address and domain authentication with your mail provider. Review SPF, DKIM and DMARC, then test a reply to more than one email provider. Do not change DNS records without confirming the values with the provider that sends your messages.

### Beacon does not show an article

Check whether the article is published, visible to the intended audience and part of the Docs collection connected to Beacon. Test the widget in a private browser window so you see the customer view.

### A Workflow does not fire

Review its conditions, action order and whether another workflow changes the same field. Test one matching conversation and one non-matching conversation. Keep the rule narrow until the result is predictable.

### AI gives an incomplete answer

Check the source article, the allowed content and the handoff rule. Update the help content first. If the answer needs a private customer record or an account decision, route it to a human rather than expanding the agent's access without review.

## Related Help Scout guides

- [Help Scout product guide](/helpscout/)
- [Help Scout review](/helpscout/review/)
- [Help Scout pricing and limits](/helpscout/pricing/)
- [Help Scout alternatives](/helpscout/alternatives/)
- [Freshdesk vs Help Scout](/compare/freshdesk-vs-help-scout/)

## Common setup questions

### How do I start using Help Scout?

Create one Inbox, connect and test the support email, invite the first teammates and publish a small Docs site. Add Beacon and workflows after the basic reply path works.

### Can Help Scout import data from another help desk?

Yes. Its official import guide lists several supported sources, including Freshdesk and Zendesk. It does not import every user setting, knowledge base article, saved reply, automation or custom field.

### Do I need a separate Inbox for every topic?

No. Create a separate inbox when another team owns the response or needs a different service target. Use tags and views when the same team handles the work.

### Should I enable the AI agent on day one?

Not before the Docs content and handoff rules are ready. Test common, missing and account-specific questions first, then track resolutions and escalations.

## Official setup sources

Steps were checked against Help Scout product and help documentation on November 11, 2026. The guide does not claim hands-on testing.

- [Admin guide](https://docs.helpscout.com/article/1076-an-admins-guide-to-help-scout)
- [Email setup](https://docs.helpscout.com/article/830-get-your-email-into-help-scout)
- [Docs help](https://docs.helpscout.com/article/129-help-scout-docs)
- [Create a Beacon](https://docs.helpscout.com/article/1232-create-a-new-beacon)
- [Workflows guide](https://docs.helpscout.com/article/22-get-started-with-workflows)
- [Scout setup](https://docs.helpscout.com/article/1795-set-up-scout)
- [Import guide](https://docs.helpscout.com/article/1495-import-emails-or-tickets-into-help-scout)
