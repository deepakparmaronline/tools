<?php
require __DIR__.'/../includes/bootstrap.php';
$post=post_by_slug('ai-agents-biological-data-research-leads');
ob_start(); ?>
<p>OpenAI, PerturbAI and Scripps Research reported on October 21, 2026 that thousands of GPT-Rosalind-powered AI agents analyzed existing experimental data from millions of mouse brain cells in 32 minutes. The system connected gene-disruption results with scientific literature to produce leads for scientists to investigate. This is a research workflow demonstration, not proof of a new treatment: the proposed biological explanations still need follow-up experiments.</p>
<figure class="article-image"><img src="/assets/images/blog/ai-agents-biological-data-research-leads.svg" alt="Illustration of parallel AI research agents connecting brain-cell experiment data with scientific papers and testable hypotheses" width="1600" height="900" loading="lazy"><figcaption>Distributed agents broaden literature review; scientists still decide which hypotheses merit experiments.</figcaption></figure>
<h2>What the research team reported</h2>
<p>The work applies separate agents to individual perturbations in a whole-brain CRISPR atlas, then combines the reports into a reasoning atlas that links genes, cell effects, publications and possible mechanisms.</p>
<h2>Sources</h2>
<ul><li><a href="https://openai.com/index/scaling-ai-research-for-complex-biological-data/" target="_blank" rel="noopener noreferrer">OpenAI: Using thousands of AI agents to uncover new leads in biological data</a></li><li><a href="https://github.com/jinlabneurogenomics/distributed_agent" target="_blank" rel="noopener noreferrer">Distributed Agents research repository</a></li><li><a href="https://doi.org/10.64898/2026.10.15.759436" target="_blank" rel="noopener noreferrer">Sun et al.: Distributed AI agents enable comprehensive discovery of biological insights at scale</a></li></ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
