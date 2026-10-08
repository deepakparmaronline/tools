# Evidence ledger

Checked 2026-10-08, Asia/Kolkata. Primary sources support product facts. No hands-on model tests.

| Source | Official URL | Evidence and qualification |
|---|---|---|
| Mistral Large 4 announcement | https://mistral.ai/news/mistral-large-4/ | October 6 public preview; planned end-of-month weights; vendor benchmark claims qualified. |
| Mistral changelog | https://docs.mistral.ai/resources/changelogs | Model identifier, preview status, two-week 50% launch discount. |
| Mistral Large 4 model card | https://docs.mistral.ai/models/mistral-large-4-0 | Current direct API identifier and 1M context; extracted current page lists 52B active, while cached search showed 49B. Active count omitted because it is not needed for the decision. |
| Mistral API pricing | https://docs.mistral.ai/inference/pricing | Standard USD input 0.68 sale/1.36 list, cached 0.07/0.14, output 2.09/4.18 per million tokens. Arithmetic scenario explicitly not a benchmark or actual bill. |
| Mistral regional inference | https://docs.mistral.ai/inference/regional-inference | Regional 1.1x standard list surcharge, regional model listing required, unsupported stateful Agents/Batch/Files, control-plane and retention qualifications. |
| Mistral structured outputs | https://docs.mistral.ai/studio/conversations/structured-output | JSON mode and custom schema formats; formatting support is distinguished from correctness. |
| OpenRouter Large 4 route | https://openrouter.ai/mistralai/mistral-large-4-0 | Gateway identifier, 524288 context and 262144 max completion tokens; primary for its own service, not an explanation of the direct route’s limits. |

Coverage discovery: reviewed current October 6–7 coverage at mistrallarge4.org/api-pricing, omidsaffari.com/blog/mistral-large-4, mercatus-ai.com/blog/mistral-large-4-api-pricing, and highcircl.com/en/blog/mistral-large-4. Many explain promotional pricing and future weights. The useful added angle is the endpoint-specific context difference and regional feature exclusions, verified against the services’ own documentation. No competitor wording or performance claims copied.

Author image: public GitHub profile API identifies Deepak Parmar and avatar https://avatars.githubusercontent.com/u/231306918?v=4; downloaded unchanged JPEG for the author asset requested by the site owner.
