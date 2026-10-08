# Mistral Large 4: API Routes, Pricing, and Limits

Published October 8, 2026. Written by Deepak Parmar.

Mistral Large 4 entered public preview on October 6, 2026. Its launch gives developers a new model to evaluate for coding, document analysis, and tool-based workflows, while downloadable weights remain planned for later in October. The immediate decision is which API route fits your application. Mistral’s model page lists a one-million-token context window; OpenRouter lists 524,288 tokens for its route. That difference matters when moving a large document workflow or an existing agent.

![Mistral Large 4 API routes compared by context window and regional feature checks](/images/mistral-large-4-api-routes.svg)

**Short answer:** Evaluate Mistral Large 4 through the exact endpoint you expect to deploy, checking its context budget, features, and full-price costs. Wait for the published weights and deployment terms if self-hosting is a requirement.

## What is available today?

The hosted preview API is available, while the downloadable weights are still an announced future release. Mistral’s [October 6 announcement](https://mistral.ai/news/mistral-large-4/) says the weights will arrive by the end of the month. Its [changelog](https://docs.mistral.ai/resources/changelogs) identifies the API model as `mistral-large-4` and labels it Public Preview.

“Open weights” means access to the model’s learned parameters for deployment under the release’s terms. A preview API gives access to a hosted service. Treat those as separate milestones, and check the eventual license and deployment documentation before making a self-hosting commitment.

Mistral reports coding, visual understanding, and agent-workflow evaluations in the announcement. These are useful shortlist signals, but the company’s reported results do not establish reliability on your documents, integrations, or acceptance criteria. This guide uses documentation; it does not report hands-on model testing.

## Which context limit should you plan around?

Use the limit published for the route your application will call. On October 8, Mistral’s [version-specific model card](https://docs.mistral.ai/models/mistral-large-4-0) lists 1M tokens, while [OpenRouter’s model page](https://openrouter.ai/mistralai/mistral-large-4-0) lists 524,288 tokens and up to 262,144 completion tokens.

| Route | Model identifier | Published context |
|---|---|---|
| Mistral API | `mistral-large-4` | 1M tokens on the model card |
| OpenRouter | `mistralai/mistral-large-4-0` | 524,288 tokens on its listing |

A context window is the working budget for the request and response. It is not a promise of accurate recall across every token. Large prompts also need room for instructions, tool messages, and the answer you expect.

For example, a workflow designed around a roughly 700,000-token request should not be moved unchanged to the listed OpenRouter route. Reduce the material, retrieve relevant sections, or evaluate the direct route. Confirm your account and request settings before relying on either advertised ceiling.

Record the endpoint, model identifier, and documentation date with your evaluation. A saved model name alone is insufficient to explain a later capacity error.

## How much does the preview cost?

Mistral’s current standard API sale rate is $0.68 per million input tokens and $2.09 per million output tokens. Its [API price sheet](https://docs.mistral.ai/inference/pricing) shows the undiscounted rates alongside the sale, and the changelog describes a two-week, 50% launch offer.

| Token type | Launch sale, USD per million | Listed undiscounted rate |
|---|---|---|
| Input | $0.68 | $1.36 |
| Cached input | $0.07 | $0.14 |
| Output | $2.09 | $4.18 |

As a worked example, 10 million uncached input tokens and one million output tokens cost $8.89 at these sale rates, versus $17.78 at the listed rates. This arithmetic excludes taxes, extra services, and route-specific charges. It is a scenario, not an observed monthly bill.

Budget using the undiscounted rates as well. Agent retries and repeated document submissions can change total consumption even when the per-token price is attractive. Compare cost per accepted task, including human review, rather than the price of one successful-looking response.

## Does a regional endpoint change the feature set?

Yes. Mistral’s [regional inference documentation](https://docs.mistral.ai/inference/regional-inference) lists restrictions beyond geography. Regional endpoints support function calling, but stateful Agents, Batch, and the Files API are unavailable there; model availability also varies by region.

The EU and US endpoints apply a 10% regional surcharge. The documentation describes this as 1.1 times standard list pricing, so confirm the applicable regional quote instead of applying the launch sale automatically.

Regional inference controls where eligible inference is processed. It does not localize every account, billing, or operational record, and it is separate from zero data retention. Check these controls independently before deciding that a deployment meets your data requirements.

Before a migration, list the models available on your intended regional endpoint. A global model card does not confirm availability or feature parity for that endpoint.

## What should a useful pilot check?

Start with a small set of representative tasks and written acceptance criteria. Include ordinary cases, missing information, a long document, and a malformed tool response. Keep the current working model available for comparison and rollback.

### Structured output and application checks

Mistral documents [custom structured outputs and JSON mode](https://docs.mistral.ai/studio/conversations/structured-output). A format constraint helps an application parse an answer; it does not prove that the extracted values are true.

Use ToolboxKart’s [JSON Formatter & Validator](/developer/json-formatter) to inspect a sanitized sample for syntax. Then check it against your application schema and source document. A syntactically valid amount can still reference the wrong invoice.

### Tool actions and failure handling

Separate proposed actions from executed actions. During the pilot, use a test environment, inspect tool arguments, and require review for changes that affect customers or production systems. Record failures and retries alongside accepted outputs.

Our [AI agent approval policy guide](/ai-news/ai-agent-approval-policy-template) provides a starting point for deciding which actions need review. Adapt that policy to the permissions your application actually grants.

## Mistral Large 4 FAQ

### Can I download Mistral Large 4 now?

The sources checked on October 8 describe hosted public preview access and weights planned by the end of October. Verify the official release before planning a downloadable deployment.

### Why does OpenRouter list a smaller context window?

Its listing publishes a different allowance for its API route. Use that route’s documented limit; the pages reviewed do not establish the reason for the difference.

### Is the launch price permanent?

No. Mistral’s changelog describes a two-week launch discount. Confirm current pricing before purchase and model your ongoing costs at the undiscounted rates too.

### Does EU inference mean all account data stays in the EU?

No. Mistral says regional inference does not provide regional storage for all control-plane data, including billing and account configuration.

## Make the endpoint part of the decision

Shortlist Large 4 when its documented capabilities fit a real task. Choose an API route, check the features and limits on that route, then run a controlled pilot against explicit acceptance criteria. If downloadable deployment is essential, make the final decision after the weights, terms, and operating requirements are available.


## Sources

- [Mistral Large 4 announcement](https://mistral.ai/news/mistral-large-4/)
- [Mistral changelog](https://docs.mistral.ai/resources/changelogs)
- [Mistral Large 4 model card](https://docs.mistral.ai/models/mistral-large-4-0)
- [Mistral API pricing](https://docs.mistral.ai/inference/pricing)
- [Mistral regional inference](https://docs.mistral.ai/inference/regional-inference)
- [Mistral structured outputs](https://docs.mistral.ai/studio/conversations/structured-output)
- [OpenRouter Large 4 route](https://openrouter.ai/mistralai/mistral-large-4-0)
