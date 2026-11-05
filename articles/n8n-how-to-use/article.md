> **Short answer:** To use n8n, create a workflow, add a trigger, connect one or more action nodes, test with sample data, then publish it. Before a workflow handles real customer data, check its credentials, error path, execution limits and backup plan.

## Before you start

You need an n8n Cloud account or a working self-hosted instance, access to the apps you want to connect and permission to create the required credentials. For a first workflow, choose a low-risk process such as copying a form response to a test spreadsheet. Avoid starting with payments, account deletion or messages to a large customer list.

If you are new to n8n, use the [official quickstart](https://docs.n8n.io/try-it-out/quickstart/) alongside this guide. The steps below explain the workflow pattern; the exact node labels can change as n8n updates the editor.

## 1. Create a workflow

Open the n8n workspace and create a new workflow. Give it a name that describes the business task, not just the app names. For example, “Send a review request after an order is delivered” is easier to understand later than “Shopify to Gmail”.

Write down the trigger, the expected input fields, the action and the result you want. This small plan helps you spot missing data before you add nodes. If the workflow needs a schedule, decide which timezone it should use. If it needs a webhook, confirm which system will send the event and what payload it will deliver.

## 2. Add a trigger

Choose the event that should start the workflow. Common trigger patterns include:

- **Schedule:** run at a set interval or time.
- **Webhook:** start when another system sends an HTTP request.
- **App trigger:** listen for an event from a supported service.
- **Manual trigger:** run the workflow while building or testing it.

For a schedule, check the timezone and interval before publishing. For a webhook, use the test URL while you build and the production URL after the workflow is published. Do not send live customer events to a test workflow unless you understand where that data will go.

## 3. Add action nodes

Add the action that should happen after the trigger. It could create a CRM record, add a row to a spreadsheet, send a notification or call an API. Select the correct account credential and map the fields from the trigger output.

Use the output panel to check field names and data types. A timestamp may arrive as text, a phone number may contain a country code, and an optional field may be empty. If the next node expects a different format, add a transformation or Edit Fields node before the action.

## 4. Add conditions and data checks

Use an If or Switch node when different records need different actions. For example, route a lead to sales only when the email address is valid and the consent field is present. Put checks before an action that sends a message, changes a record or starts a payment.

Keep the workflow readable. Use clear node names, group related steps and split a large process into sub-workflows when it becomes difficult to follow. Add a short description to explain why a condition exists. A workflow should be understandable by someone other than the person who built it.

## 5. Test with sample data

Run the workflow manually with safe sample data. Check the output from the trigger, every transformation and the final action. Test at least one normal record, one missing optional field and one record that should follow a different branch.

A green test run does not prove the production workflow is safe. Also check duplicate events, API rate limits, expired credentials, unexpected payloads and a failed destination service. Make sure a retry will not create duplicate payments, tickets or messages. If the action cannot safely be repeated, add an idempotency key or a check before it runs again.

## 6. Publish the workflow

The current n8n quickstart uses the Publish action to make a workflow live. Review the trigger, credentials, data mapping, error handling and timezone first. Then publish the workflow and use its production trigger URL or schedule.

Keep a record of what was published and who owns it. If the workflow affects customers or business records, define a rollback step and a person who can pause it. Do not treat a saved draft or a successful manual test as proof that the production workflow is active.

## 7. Monitor executions and errors

After publishing, review the execution list and inspect failed runs. Look for repeated errors, slow API calls, unexpected payloads and credentials that need renewal. If a workflow sends alerts, make sure the alert reaches someone who can act on it.

For important processes, create an error workflow or use the built-in error handling pattern. Decide whether the process should retry, stop, notify a person or move the failed item to a review queue. A retry should be safe for the destination system; otherwise it can repeat an action that already succeeded.

## 8. Protect credentials and workflow data

Use the credential store instead of pasting API keys into ordinary text fields. Limit who can edit workflows and who can use shared credentials. Review execution data because it can contain personal information, tokens or customer records.

For self-hosted n8n, the official docs explain that n8n creates an encryption key and uses it to encrypt credentials before they are saved to the database. If you set a custom key, keep it safe and use the same key across all workers in queue mode. Back up the key with the database; losing it can make stored credentials unusable. Read the [custom encryption key guide](https://docs.n8n.io/hosting/configuration/configuration-examples/encryption-key/) and [security overview](https://docs.n8n.io/hosting/securing/overview/).

## 9. Export or move a workflow

n8n stores workflows as JSON. You can download a workflow from the editor or import a JSON file into another instance. The official [export and import guide](https://docs.n8n.io/build/manage-workflows/export-and-import/) warns that exported JSON includes credential names and IDs. HTTP Request nodes imported from cURL may contain authentication headers. Remove or anonymize sensitive information before sharing an export.

For moving workflows between instances from the command line, n8n recommends the n8n CLI. Packages can carry workflows with their folders, projects and references, but the package feature is in preview and may change. A workflow JSON file is not a complete backup of your instance. Keep a separate backup of the database, encryption key, binary data and deployment configuration.

## 10. Plan self-hosted upgrades carefully

Self-hosting gives you control, but you own the maintenance. Use HTTPS, restrict access, review community nodes, monitor resource use, back up the database and test updates before applying them to production.

The documentation lists n8n 3.0 as early access. Its breaking-changes guide says self-hosted deployments need a Docker-based installation. If your current instance uses npm or npx, read the [3.0 breaking changes](https://docs.n8n.io/changelog/v30-breaking-changes/) and [migration tool guide](https://docs.n8n.io/changelog/v30-migration-tool/) before upgrading. Do not assume an early-access version is ready for a production migration.

## More n8n guides

- [n8n hub](/n8n/)
- [n8n review](/n8n/review/)
- [n8n pricing](/n8n/pricing/)
- [n8n alternatives](/n8n/alternatives/)
- [n8n vs Zapier](/compare/n8n-vs-zapier/)

## How to use n8n FAQ

### How do I create my first n8n workflow?

Create a workflow, add a trigger, connect an action node, test with sample data and publish it. Start with a low-risk process and check each node's output before connecting real accounts.

### How do I activate an n8n workflow?

The current quickstart uses the Publish action to make a workflow live. Check the trigger and credentials before publishing, then use the production trigger URL or schedule.

### Can I export n8n workflows?

Yes. n8n can export workflows as JSON and import JSON into another instance. The export can include credential names and IDs, and cURL imports can contain authentication headers, so remove sensitive details before sharing.

### How do I back up a self-hosted n8n instance?

Back up the database, encryption key, binary data and deployment configuration. A workflow JSON export is useful, but it is not a full instance backup.

### Can I use n8n without coding?

Yes. Many workflows can be built with the visual editor and app nodes. Code and HTTP requests are optional for workflows that need custom logic or unsupported API actions.

## Sources and update method

The workflow steps, publish terminology, export/import warnings, encryption-key guidance and 3.0 deployment note were checked against n8n's official documentation on November 5, 2026. This is a documentation-based guide and does not claim hands-on testing.
