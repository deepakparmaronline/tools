<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('openai-low-resource-programming-language-coding-evals');
ob_start(); ?>
<p>OpenAI published new coding evaluations on October 19, 2026, focused on programming languages that have less training material and public documentation than Python or JavaScript. The work covers building a SQLite-compatible database engine across 20 languages and migrating existing COBOL programs while preserving their behavior. OpenAI reports large gains on both tests, but the figures are results from the company's own evaluations, not a guarantee that every real-world codebase can be migrated automatically.</p>
<figure><img src="/assets/images/blog/openai-low-resource-programming-language-coding-evals.svg" alt="Diagram showing two coding evaluations: building a SQLite-compatible engine across languages and migrating COBOL while checking behavior" width="1600" height="900" loading="lazy"><figcaption>The evaluations test both building new software and preserving the behavior of existing systems.</figcaption></figure>
<h2>Why less-common programming languages matter</h2>
<p>Many organizations still depend on systems written in languages such as COBOL, Fortran, Visual Basic and OCaml. These systems may support financial records, scientific computing, internal business processes or infrastructure that has been maintained for years. A language model can appear strong in a popular language while struggling with a language where it has seen less code, fewer examples and less documentation.</p>
<p>That gap matters when a team needs to fix an old defect, add a feature or modernize a system without changing what the software does. A generated rewrite that compiles is not enough if it changes rounding, date handling, record processing or another business rule.</p>
<h2>What MultiLangBench measures</h2>
<p>OpenAI's MultiLangBench asks a model to build a SQLite-compatible database engine in a requested programming language. The evaluation is based on SQLite's test suite. A candidate implementation receives an initial database and a SQL query, updates the database, and is checked against expected results using the reference SQLite implementation.</p>
<p>The shared database interface makes it possible to compare work across languages. OpenAI says its reported evaluation covers 20 languages and measures both the test pass rate and API cost. The company has also published the evaluation setup and test suite in the <a href="https://github.com/openai/MultiLangBench" target="_blank" rel="noopener noreferrer">openai/MultiLangBench repository</a>, so developers can inspect what is tested rather than relying only on a headline score.</p>
<h2>The reported results for building software</h2>
<p>OpenAI reports that GPT-6 Astra achieved an average test pass rate of 87.4% across the 20 languages at maximum reasoning effort, compared with 26.8% for GPT-5.6 Sol. OpenAI says the improvement appeared in every language tested, although COBOL remained the most difficult language in this evaluation.</p>
<p>OpenAI also reports a lower-cost option: GPT-6 Luna reached an average pass rate of 40.3% at maximum reasoning effort, with an estimated average API cost of $0.77 per sample compared with $3.48 for GPT-5.6 Sol. These figures are tied to the evaluation's task, settings and cost assumptions. They should not be treated as a direct estimate for an arbitrary production repository.</p>
<h2>How the COBOL migration test works</h2>
<p>The second evaluation asks a model to migrate COBOL programs to C++, Java, Kotlin, Python or Rust while preserving behavior. The task is harder than translating syntax. Legacy programs can encode business rules in fixed-point arithmetic, record handling, rounding behavior and other details that are easy to change accidentally during a rewrite.</p>
<p>OpenAI says the evaluation uses hidden tests and requires byte-for-byte parity on observable outputs. A migration counts as successful only when all required tests pass. On this test, OpenAI reports 86.6% accuracy for GPT-6.1 Sol at low reasoning effort, compared with 5.4% for GPT-5.6 Sol at the same setting. The company says the newer result costs 39% less, and that accuracy reaches 97.9% at higher reasoning effort.</p>
<p>Those results suggest progress on a difficult, measurable task. They do not prove that a model can safely migrate an entire financial system without human review. The evaluation has defined inputs and tests; real systems also contain undocumented dependencies, operational constraints and data that may not be represented in a benchmark.</p>
<h2>What the results could mean for maintenance teams</h2>
<ul>
<li><strong>Legacy maintenance:</strong> a model may help explain unfamiliar code, propose a small fix or draft tests around behavior that must not change.</li>
<li><strong>Modernization planning:</strong> teams can use a model to explore a migration path, but should validate the proposed target language and runtime against their actual environment.</li>
<li><strong>Scientific software:</strong> language coverage matters when code is written in Fortran or other languages common in long-lived research systems.</li>
<li><strong>Review capacity:</strong> a faster first draft only helps when engineers can verify correctness, performance and operational fit.</li>
</ul>
<h2>A practical way to evaluate coding models</h2>
<ol>
<li>Choose a small, representative task from the real codebase rather than an easy demonstration.</li>
<li>Write down the expected behavior before asking a model to change the code.</li>
<li>Include edge cases such as empty records, boundary values, rounding and malformed input where relevant.</li>
<li>Run the same tests against the original and modified versions.</li>
<li>Record model version, reasoning setting, input size, output, latency and API cost.</li>
<li>Have a maintainer review the diff and the test coverage before accepting the change.</li>
<li>Expand only after the small evaluation shows repeatable results.</li>
</ol>
<p>For a broader comparison plan, see our <a href="/tools-guide/how-to-evaluate-ai-models-before-switching">guide to evaluating AI models before switching providers</a>. The key idea is to measure the tasks your team actually performs, not just a public benchmark score.</p>
<h2>What is still uncertain</h2>
<p>OpenAI's publication provides useful detail about the test design, but independent replication and performance on customer-specific repositories remain separate questions. The result can vary with the language, task complexity, model settings, available context and the quality of the tests. Teams should also account for code licensing, data handling, dependencies and the cost of reviewing generated changes.</p>
<p>The most practical takeaway is not that legacy modernization is solved. It is that coding models are becoming more capable on some low-resource language tasks, and that transparent evaluations can help developers decide where a controlled pilot is worth trying.</p>
<h2>Sources</h2>
<ul>
<li><a href="https://openai.com/index/low-resource-programming-languages/" target="_blank" rel="noopener noreferrer">OpenAI: Advancing coding in low-resource programming languages</a></li>
<li><a href="https://github.com/openai/MultiLangBench" target="_blank" rel="noopener noreferrer">OpenAI: MultiLangBench evaluation repository</a></li>
</ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
