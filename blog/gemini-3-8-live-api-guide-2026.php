<?php $post=post_by_slug('gemini-3-8-live-api-guide-2026');ob_start(); ?>
<p>Google introduced Gemini 3.8 Live and Gemini 3.8 Live Extended Thinking on September 15, 2026, as its newest live dialogue models for real-time voice applications. The important change is not only better speech quality. Google is combining native audio-to-audio interaction with multimodal input, background tool execution, asynchronous function calling and a separate model variant for deeper reasoning. For developers, the practical question is how the two models differ, what the Live API actually supports, where the limits are, and what changes when you move from the older Gemini 3.1 Flash Live model.</p>
<figure class="article-image"><img src="/assets/images/blog/gemini-3-8-live-api-guide-2026.svg" alt="Diagram showing Gemini 3.8 Live and Extended Thinking handling multimodal input, live dialogue and background tool calls"></figure>

<h2>What Google launched on September 15, 2026</h2>
<p>Google launched two related models. <code>gemini-3.8-live</code> is the standard low-latency option for most real-time voice agent experiences. <code>gemini-3.8-live-extended-thinking</code> is the higher-reasoning option for complex, multi-step work during a live conversation.</p>
<p>Both are available through the Gemini API and Google AI Studio. Google also says Gemini 3.8 Live is rolling into Search Live, while the Extended Thinking model is being used in selected Gemini and Workspace experiences. The two models share the same broad Live API interface, but they are meant for different latency and reasoning needs.</p>
<p>This matters because a voice agent does not behave like a normal text request. The application has to keep a live session open, process streaming media, preserve conversation state, handle interruptions and deal with external actions while the user is still speaking. The 3.8 release is built around that problem rather than simply adding speech output to a text model.</p>

<h2>What Gemini 3.8 Live can process and return</h2>
<p>The current model documentation lists text, images, audio and video as supported input types for <code>gemini-3.8-live</code>. Its outputs are text and audio. The listed input limit is 131,072 tokens and the output limit is 65,536 tokens.</p>
<p>The same documentation lists audio generation, Live API support, search grounding and function calling. It does not list code execution, file search, image generation, URL context or Google Maps grounding for this model. That distinction is useful when planning an agent: the Live model can call functions that your application exposes, but it is not a general-purpose tool box where every Gemini API capability is automatically available.</p>
<p>Google describes the standard model as the default choice for low-latency voice agents and real-time dialogue without reasoning-induced delays. It also supports interleaved reasoning, which means the system can use reasoning while continuing a live interaction instead of turning the conversation into a stop-and-wait text exchange.</p>

<h2>How the Extended Thinking model is different</h2>
<p><code>gemini-3.8-live-extended-thinking</code> is aimed at situations where the agent needs more background reasoning. Google describes it as a high-reasoning audio-to-audio model that can process reasoning and tool calls while streaming continuous audio responses.</p>
<p>The model page lists the same 131,072-token input limit and 65,536-token output limit. It supports function calling, but the documented mode is asynchronous. Search grounding is supported, while code execution, file search, Google Maps grounding, image generation, structured outputs and URL context are not listed as supported capabilities.</p>
<p>The practical difference is therefore not simply “better voice.” The choice is tied to task complexity. A short customer question may favor the standard Live model. A live booking flow, troubleshooting session or multi-step task can justify Extended Thinking when the added reasoning is more useful than the extra model work.</p>

<h2>What the Live API actually looks like</h2>
<p>The Gemini Live API uses WebSockets for persistent, bidirectional communication. Google’s SDK examples show a client opening a live session, selecting a model such as <code>gemini-3.8-live</code>, setting response modalities and then streaming audio or other input into the session.</p>
<p>This architecture is different from a typical request-response API. Instead of sending one message and waiting for one finished answer, the application maintains a session and continuously exchanges data with the model. That is why session state, reconnection and context management are part of the API design rather than optional extras.</p>
<p>Google’s session management documentation includes session resumption. When enabled, the service can issue a resumption token that the client can use after a WebSocket connection is reset. Those resumption tokens are valid for two hours after the last session termination. For a voice application, this is important because a dropped connection should not automatically mean losing the entire conversation state.</p>

<h2>Multimodal input is part of the live session</h2>
<p>Gemini 3.8 Live is not limited to microphone input. Google’s model page lists images and video alongside audio and text. The launch post also describes near-real-time visual processing, such as an agent using visual context during troubleshooting, onboarding and interactive tasks.</p>
<p>This changes the design of a voice product. A user can talk while the application sends a camera frame, document image or video context into the same live interaction. The model can then respond with audio while using the extra visual signal.</p>
<p>For developers, the important question is not whether the model accepts multiple modalities. It is how often the application should send them. Streaming every frame of a camera feed can increase cost and processing load. A better implementation can send only the visual updates that affect the current task, while keeping the conversation state stable.</p>

<h2>Asynchronous function calling changes agent design</h2>
<p>One of the more important implementation changes in 3.8 is asynchronous function calling. Google says asynchronous execution using <code>NON_BLOCKING</code> is now the default for <code>gemini-3.8-live</code>, while the older blocking behavior can be selected explicitly. Extended Thinking also uses asynchronous function calling.</p>
<p>In a real voice agent, this allows the conversation to continue while an external action is running. The agent might acknowledge a request, call a booking system or internal API, and keep the dialogue alive instead of forcing the user to wait silently for the tool response.</p>
<p>There is an important boundary here: the Live API documentation says automatic tool response handling is not provided in the same way as the standard generate-content flow. The client application must handle returned tool calls and send the function response back. In other words, your application still owns the orchestration layer.</p>
<p>That means the model should not be treated as the entire agent. The application remains responsible for authentication, authorization, tool validation, retries, timeouts, business rules and the final decision about whether a tool action is allowed.</p>

<h2>Search grounding is supported, but not every tool is</h2>
<p>The current 3.8 model documentation lists Search grounding as supported for both Live models. At the same time, several other Gemini capabilities are explicitly marked unsupported, including code execution, file search, URL context and Google Maps grounding.</p>
<p>This is useful for architecture decisions. A developer can design a voice assistant that answers with current web information and can call application-defined functions, but should not assume it can directly use every tool available in non-Live Gemini models.</p>
<p>The safest approach is to map every external action to an explicit tool declaration and test the exact model-tool combination used in production. Do not build around a capability because it exists somewhere else in the Gemini API.</p>

<h2>Pricing: audio is billed differently from text</h2>
<p>Google’s current Gemini API pricing page lists a free tier and paid pricing for the 3.8 Live models. On the paid tier, audio input is listed at $3.00 per million tokens or $0.005 per minute. Audio output is $12.00 per million tokens or $0.018 per minute. Text input is $0.75 per million tokens and text output is $4.50 per million tokens.</p>
<p>The token numbers alone do not tell the whole cost story. Google’s Live API best-practices documentation explains that the service bills the accumulated session context on each turn. As a conversation grows, earlier context can be re-processed and billed again. Long sessions can therefore become more expensive even if the user is not sending much new information per turn.</p>
<p>Google recommends context window compression for long sessions. The example in its documentation uses a compression trigger of 25,000 tokens and a sliding window of 8,000 tokens. The exact settings depend on the application, but the underlying lesson is clear: persistent voice agents need an explicit context-management strategy.</p>

<h2>Proactive audio can affect both behavior and billing</h2>
<p>Google documents proactive audio as a special behavior for the 3.8 Live models. Proactive audio is permanently enabled for <code>gemini-3.8-live</code> and <code>gemini-3.8-live-extended-thinking</code>.</p>
<p>Under Google’s billing guidance, proactive audio means input tokens can be charged while the Live API is continuously listening, while output tokens are charged when the model responds. This makes always-on listening a product decision as well as a technical one.</p>
<p>For a hands-free assistant, that behavior may be expected. For an application with long idle periods, developers should measure the cost of keeping a session alive rather than estimating the bill from response time alone.</p>

<h2>What happens when you migrate from Gemini 3.1 Flash Live</h2>
<p>Google’s 3.8 Live documentation includes a direct migration path from <code>gemini-3.1-flash-live-preview</code>. The model string changes to <code>gemini-3.8-live</code>.</p>
<p>There is also a configuration change. Google’s documentation says <code>thinking_level</code> and <code>thinking_config</code> are not supported for the standard 3.8 Live model, so older setup code that sends those fields should be removed.</p>
<p>Function calling also changes. Asynchronous execution using <code>NON_BLOCKING</code> is now the default, while <code>BLOCKING</code> can be explicitly selected when backward-compatible synchronous behavior is needed.</p>
<p>Google’s deprecation page lists Gemini 3.1 Flash Live as a legacy preview model and recommends updating to Gemini 3.8 Live. It does not list a shutdown date for 3.1 Flash Live, so migration is a recommendation rather than a forced immediate shutdown.</p>

<h2>Security should be handled outside the model</h2>
<p>Google’s Live API overview recommends ephemeral tokens for client-to-server production deployments rather than putting a standard API key in a browser or client application. The ephemeral-token documentation shows that a temporary token can be restricted to a specific Live API model and configuration.</p>
<p>That design is especially relevant for voice agents because the session can call tools and receive continuous user input. The model can decide to request an action, but your server should still validate whether that action is allowed, for which user, with which arguments and under which account or permission.</p>
<p>The Live API also exposes session-resumption features, which means a robust application should plan for reconnects rather than assuming a WebSocket will stay open forever. Logging, rate limits, tool timeouts and audit records should be implemented at the application layer.</p>

<h2>How the two 3.8 Live models compare</h2>
<table class="data-table"><thead><tr><th>Area</th><th>Gemini 3.8 Live</th><th>Gemini 3.8 Live Extended Thinking</th></tr></thead><tbody>
<tr><td>Primary use</td><td>Low-latency live dialogue and most voice agents</td><td>Complex, multi-step real-time tasks</td></tr>
<tr><td>Model ID</td><td><code>gemini-3.8-live</code></td><td><code>gemini-3.8-live-extended-thinking</code></td></tr>
<tr><td>Inputs</td><td>Text, images, audio, video</td><td>Text, images, audio, video</td></tr>
<tr><td>Outputs</td><td>Text and audio</td><td>Text and audio</td></tr>
<tr><td>Input limit</td><td>131,072 tokens</td><td>131,072 tokens</td></tr>
<tr><td>Output limit</td><td>65,536 tokens</td><td>65,536 tokens</td></tr>
<tr><td>Function calling</td><td>Supported; asynchronous default</td><td>Supported; asynchronous</td></tr>
<tr><td>Search grounding</td><td>Supported</td><td>Supported</td></tr>
<tr><td>Code execution</td><td>Not supported</td><td>Not supported</td></tr>
<tr><td>File search</td><td>Not supported</td><td>Not supported</td></tr>
<tr><td>Structured outputs</td><td>Not supported</td><td>Not supported</td></tr>
</tbody></table>

<h2>Where Gemini 3.8 Live fits compared with other voice architectures</h2>
<p>The launch also highlights an architectural difference that matters beyond model quality. An independent analysis from The New Stack describes Google’s approach as keeping reasoning inside the live voice model, while OpenAI’s GPT-Live-1 approach can separate real-time conversation from a backend reasoning model.</p>
<p>That distinction does not prove that one architecture is better for every workload. It changes where complexity lives. With an integrated live reasoning model, more of the conversational state and task behavior sits close to the voice session. With a split design, more orchestration can live in your application. The choice affects latency, state management, tool routing, cost accounting and failure handling.</p>
<p>For developers evaluating both approaches, test the full application rather than comparing voice demos. Record task completion, interruption handling, time to first audio, tool-call latency, failed actions, reconnect behavior and total cost per completed task.</p>

<h2>What the September 15 launch actually changes for developers</h2>
<p>Three changes stand out when the launch announcement is read together with the current API documentation.</p>
<p>First, live multimodal interaction is now a stable model path rather than only a narrow preview experience. The model page lists <code>gemini-3.8-live</code> as stable, and the deprecation page lists the release date as September 15, 2026 with no shutdown date announced.</p>
<p>Second, asynchronous tool use is part of the main agent design. A voice application can continue the dialogue while an external function is running, but the client still has to manage the tool response.</p>
<p>Third, the economics are tied to persistent session context. Developers need to treat context compression, idle listening and token growth as engineering concerns, not just billing details.</p>

<h2>What remains unconfirmed or easy to misunderstand</h2>
<p>Google’s public documentation explains the public 3.8 Live models and Live API capabilities. It does not establish that every internal Google voice or agent deployment uses the same configuration. Public API support should not be treated as evidence about private internal systems.</p>
<p>Google’s launch article also reports benchmark results from Artificial Analysis, ServiceNow EVA-Bench and other evaluations. Those measurements are useful context, but benchmark performance does not tell a developer how the model will behave on a particular production workflow. The right validation target is the actual workload, including interruptions, tool failures, noisy audio and long sessions.</p>

<h2>How to test Gemini 3.8 Live before production</h2>
<p>Start with a fixed test set of real conversations. Include normal requests, interrupted requests, ambiguous speech, visual context, unavailable tools, slow tools, rejected actions and reconnects. Test both the standard Live model and Extended Thinking on the same scenarios where both are viable.</p>
<p>Measure task completion, time to first response, total turn latency, audio input and output usage, context growth, tool-call errors, recovery after disconnects and human corrections. Also test a long session with context compression enabled and compare the cost with an uncompressed session.</p>
<p>For browser clients, implement ephemeral-token issuance on the server and keep the long-lived API credential out of client code. For tools that can create side effects, use explicit allowlists, argument validation, authorization checks and application-level logging.</p>

<h2>Related ToolBoxKart guides</h2>
<p>For the non-Live Gemini model family, see <a href="/blog/gemini-3-8-flash-api-features-pricing">Gemini 3.8 Flash API features and pricing</a>. For live voice architecture, see <a href="/blog/chatgpt-gpt-live-1-voice-api-guide">GPT-Live-1 Voice API</a>. For agent testing, read <a href="/blog/ai-agent-independent-evaluation-workflow">AI Agent Independent Evaluation</a>. For permissions, see <a href="/blog/how-to-audit-ai-agent-permissions">How to Audit AI Agent Permissions</a>. For broader agent architecture, see <a href="/blog/ai-agent-architect">AI Agent Architect</a>. For another Gemini workflow, read <a href="/blog/gemini-windows-app-guide">the Gemini Windows app guide</a>.</p>

<h2>Frequently asked questions</h2>
<h3>What is the Gemini 3.8 Live model ID?</h3>
<p>The standard model ID is <code>gemini-3.8-live</code>. The higher-reasoning variant is <code>gemini-3.8-live-extended-thinking</code>.</p>
<h3>Does Gemini 3.8 Live support video input?</h3>
<p>Yes. Google’s current model documentation lists video, along with text, images and audio, as supported inputs. Output is listed as text and audio.</p>
<h3>Does Gemini 3.8 Live support function calling?</h3>
<p>Yes. Function calling is supported. Google documents asynchronous execution as the default behavior for 3.8 Live and asynchronous function calling for the Extended Thinking model.</p>
<h3>What are the paid audio prices?</h3>
<p>Google’s current pricing page lists $0.005 per minute for audio input and $0.018 per minute for audio output on the paid tier, alongside token-based pricing.</p>

<h2>Sources</h2>
<ul>
<li><a href="https://blog.google/innovation-and-ai/models-and-research/gemini-models/gemini-3-8-live-gemini-3-8-live-extended-thinking/">Google — Introducing Gemini 3.8 Live and 3.8 Live Extended Thinking</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/models/gemini-3.8-live">Google AI for Developers — Gemini 3.8 Live</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/models/gemini-3.8-live-extended-thinking">Google AI for Developers — Gemini 3.8 Live Extended Thinking</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/live-api/capabilities">Google AI for Developers — Live API capabilities</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/pricing">Google AI for Developers — Gemini API pricing</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/live-api/best-practices">Google AI for Developers — Live API best practices</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/live-api/session-management">Google AI for Developers — Live API session management</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/live-api/ephemeral-tokens">Google AI for Developers — Live API ephemeral tokens</a></li>
<li><a href="https://ai.google.dev/gemini-api/docs/deprecations">Google AI for Developers — Gemini deprecations</a></li>
<li><a href="https://deepmind.google/models/model-cards/gemini-3-8-audio/">Google DeepMind — Gemini 3.8 Audio model card</a></li>
<li><a href="https://thenewstack.io/voice-agent-latency-architectures/">The New Stack — Voice-agent latency architectures</a></li>
</ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
