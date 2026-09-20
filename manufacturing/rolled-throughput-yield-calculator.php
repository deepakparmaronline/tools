<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','rolled-throughput-yield-calculator');
ob_start();
?>
<h2>Calculate Rolled Throughput Yield (RTY)</h2><p class="lead">Enter step yields to see the probability-like proportion of units expected to pass every step without a defect/rework event under the simple independent yield model.</p>
<div class="field full"><label for="yields">Step yields (%) separated by commas or lines</label><textarea id="yields" rows="5">98, 97, 99, 96</textarea></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Process steps</span><strong id="steps">—</strong></div><div class="metric"><span>Rolled Throughput Yield</span><strong id="rty">—</strong></div><div class="metric"><span>Rolled fallout</span><strong id="loss">—</strong></div><div class="metric"><span>Equivalent per 1,000 starts</span><strong id="per">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const vals=$('yields').value.split(/[\s,]+/).filter(Boolean).map(Number);if(!vals.length||vals.some(v=>!Number.isFinite(v)||v<0||v>100)){['steps','rty','loss','per'].forEach(id=>$(id).textContent='—');$('note').textContent='Enter one or more yield percentages between 0 and 100.';$('note').className='helper danger';return}const r=vals.reduce((p,v)=>p*v/100,1);$('steps').textContent=vals.length.toString();$('rty').textContent=(r*100).toFixed(3)+'%';$('loss').textContent=((1-r)*100).toFixed(3)+'%';$('per').textContent=(1000*r).toFixed(1)+' first-time-equivalent passes';$('note').textContent='RTY is the product of the entered step yields. Make sure each step yield uses compatible boundaries and counts first-time success if that is your RTY convention.';$('note').className='helper'}$('yields').addEventListener('input',go);go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Rolled Throughput Yield formula</h2><p>For a sequence of process steps, a common RTY calculation multiplies the decimal yield at each step: <strong>RTY = Y1 × Y2 × … × Yn</strong>. ASQ describes rolled throughput yield as an overall yield measure built from process-step yields. <a href="https://asq.org/quality-resources/rolled-throughput-yield" target="_blank" rel="noopener">ASQ RTY resource</a>.</p>
<h2>Why good-looking step yields compound</h2><p>Four steps at 98%, 97%, 99% and 96% yield do not produce a 97.5% end-to-end RTY by averaging. Multiplication gives the proportion expected to make it through all four step criteria under the simple model, revealing compound hidden-factory loss.</p>
<h2>Keep step definitions compatible</h2><p>If one step counts final good units after rework while another counts first-pass good units, multiplying the ratios can create a misleading metric. Decide whether the analysis is first-time-through quality, final yield, or another specific flow definition and collect every step consistently.</p>
<h2>RTY is a diagnostic summary</h2><p>The product points to accumulated process loss but does not identify the defect mechanism. Review the lowest-yield steps, defect categories, rework loops and measurement systems. For correlated or branching processes, a simple straight-line product may not represent the real network.</p>
<h2>Use RTY to expose the hidden factory</h2><p>End-of-line yield can look acceptable when defects are repeatedly repaired between operations. RTY makes those step losses compound, which helps quantify how much first-time flow is being lost before final inspection. To improve the metric, focus on the steps with the largest fallout and the rework loops with the greatest cost or delay, not simply the step with the lowest percentage if its volume is small.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I calculate RTY?','Convert each step yield percentage to a decimal and multiply all step yields together, then convert the product back to a percentage.'],['Why not average the step yields?','An average does not represent the chance/proportion of passing every sequential step; sequential yields compound multiplicatively.'],['Should reworked units count as passing a step?','Use one consistent convention. First-time-through RTY normally aims to expose rework rather than count recovered units as first-pass success.'],['Can RTY be used for branching processes?','The simple product is best for a defined sequential route. Branching, re-entry and correlated failures may need a process-specific model.']];
require __DIR__.'/../includes/tool-template.php';
