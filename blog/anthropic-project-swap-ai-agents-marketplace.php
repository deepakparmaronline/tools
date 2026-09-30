<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('anthropic-project-swap-ai-agents-marketplace') ?? ['slug'=>'anthropic-project-swap-ai-agents-marketplace','title'=>'Anthropic Project Swap: What Agent-to-Agent Trading Reveals','description'=>'Anthropic used a miniature book market to study agents trading for people. The results show where agent preferences and negotiation systems still fall short.','category'=>'Claude','date'=>'2026-09-30','read_time'=>'8 min read'];
ob_start(); ?>
<p>Anthropic's Project Swap is a small experiment with a useful question: what happens when AI agents negotiate with other agents on behalf of people? In the September 24 study, employees across six offices brought books they wanted to give away and sent Claude-powered agents onto a miniature trading floor.</p>
<p>The experiment is interesting because it moves beyond a chatbot answering a request. Each agent had to represent a person's preferences, evaluate offers, negotiate with another agent and complete a trade.</p>

<h2>How Project Swap worked</h2>
<p>Participants had a short conversation with Claude about what they like to read. They also ranked 10 books based on their interests. Their agent then entered an open market where agents represented other participants.</p>
<p>The agents were asked to pitch books, negotiate and make deals. Anthropic repeated the trading floor many times with different models and instructions so the researchers could compare how the system behaved under different conditions.</p>

<h2>Preference matching was useful but incomplete</h2>
<p>Anthropic reports that after a five-minute conversation, an agent's ranking of the books matched its person's ranking on 61% of pairs. That is a meaningful result for such a short preference interview, but it also shows that the agent did not perfectly represent the person.</p>
<p>The gap matters because an agent can only negotiate as well as it understands the preferences and constraints of the person it represents. A simple conversation may capture broad interests while missing details such as budget, exclusions or priorities.</p>

<h2>The market problem was information</h2>
<p>Anthropic says the market generally traded well, and that the biggest shortfall came from information the agents lacked about their participants rather than from the negotiation itself.</p>
<p>This is an important design lesson. When an agent fails at a task, adding a stronger negotiation prompt may not solve the real problem. The agent may need better structured information about the user's preferences, constraints or goals.</p>

<h2>Model choice affected negotiation outcomes</h2>
<p>Anthropic re-ran the trading floors with different models and instructions. It reports that the model used by an agent made more difference to negotiation outcomes than the instructions given to it. Markets with stronger models were more efficient in the experiment.</p>
<p>That result should not be generalized into a claim that one model is always better for negotiation. It was observed in this controlled book-trading environment. A real marketplace would add pricing, fraud, identity, incomplete information and legal constraints that the experiment did not need to model.</p>

<h2>What this means for agent workflows</h2>
<p>Project Swap suggests that agent-to-agent systems need a clear representation of the person behind each agent. That representation should include explicit preferences and constraints rather than relying only on a short natural-language conversation.</p>
<p>For a business workflow, the same idea could apply to procurement, sales qualification or scheduling. An agent representing a buyer needs structured limits. An agent representing a seller needs clear product and pricing rules. The negotiation layer sits on top of those constraints.</p>

<h2>Where human approval still matters</h2>
<p>An agent making a book trade is low risk. The same pattern becomes much more sensitive when an agent can spend money, sign a contract, change a production system or disclose information.</p>
<p>A practical design is to let agents negotiate within a predefined range but require human approval before actions that have meaningful external consequences. The approval boundary should be based on impact, not simply on whether the action came from an AI model.</p>

<h2>What Project Swap does not prove</h2>
<p>The experiment does not show that autonomous agents can safely negotiate in every real-world market. It is a controlled study using books, a limited participant group and a defined trading environment.</p>
<p>Its value is as a systems experiment. It highlights the need to model user preferences, test agent-to-agent behavior and evaluate the effect of the model itself instead of assuming that better instructions alone will solve every workflow problem.</p>

<h2>A practical agent-to-agent checklist</h2>
<ol>
<li>Represent user preferences as explicit data where possible.</li>
<li>Separate preferences from hard constraints.</li>
<li>Define the maximum action an agent may take without approval.</li>
<li>Log offers, decisions and important tool calls.</li>
<li>Test the workflow with different models.</li>
<li>Measure completed outcomes, not just conversational quality.</li>
</ol>

<h2>Sources</h2>
<ul>
<li><a href="https://www.anthropic.com/research/project-swap">Anthropic: Project Swap — What happens when agents trade for us?</a></li>
<li><a href="https://www.anthropic.com/research/project-deal">Anthropic: Project Deal</a></li>
</ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';