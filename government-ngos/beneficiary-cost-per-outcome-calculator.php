<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('government-ngos','beneficiary-cost-per-outcome-calculator');
ob_start();
?>
<h2>Calculate cost per beneficiary and outcome</h2><p class="lead">Connect program spending with aggregate reach and achieved outcomes using clearly defined counts.</p>
<div class="form-grid"><div class="field"><label for="cost">Program cost</label><input id="cost" type="number" min="0" step="any" value="100000"></div><div class="field"><label for="beneficiaries">Unique beneficiaries served</label><input id="beneficiaries" type="number" min="0" step="1" value="1000"></div><div class="field"><label for="outcomes">Beneficiaries achieving defined outcome</label><input id="outcomes" type="number" min="0" step="1" value="650"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" maxlength="6" value="$"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate program metrics</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Cost per beneficiary</span><strong id="cpb">—</strong></div><div class="metric"><span>Cost per achieved outcome</span><strong id="cpo">—</strong></div><div class="metric"><span>Outcome rate</span><strong id="rate">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const c=n('cost'),b=n('beneficiaries'),o=n('outcomes'),s=$('currency').value||'';if(![c,b,o].every(Number.isFinite)||c<0||b<=0||o<0||o>b){$('note').textContent='Enter a positive beneficiary count, non-negative cost, and outcomes no greater than beneficiaries.';$('note').className='helper danger';return;}$('cpb').textContent=s+(c/b).toFixed(2);$('cpo').textContent=o>0?s+(c/o).toFixed(2):'—';$('rate').textContent=(o/b*100).toFixed(1)+'%';$('note').textContent='Define “beneficiary” and “outcome” consistently across reporting periods. This metric describes cost efficiency, not causal impact or program quality by itself.';$('note').className='helper';}
['cost','beneficiaries','outcomes','currency'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('cost').value=100000;$('beneficiaries').value=1000;$('outcomes').value=650;$('currency').value='$';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What cost per beneficiary measures</h2><p>Cost per beneficiary divides the selected program cost by unique people served. It is most useful when the cost boundary is consistent—for example, direct program cost only versus fully allocated cost including administration.</p>
<h2>Cost per outcome formula</h2><p>Cost per achieved outcome = program cost ÷ number of beneficiaries meeting the defined outcome. The quality of this metric depends on a clear outcome definition and reliable measurement.</p>
<h2>Do not confuse output with impact</h2><p>Serving a beneficiary is an output; a verified change can be an outcome. Neither number alone proves that the program caused the change. Impact evaluation may require a stronger study design, comparison group or counterfactual.</p>
<h2>Use comparable reporting periods</h2><p>Compare the same program scope, geographic area, beneficiary definition and accounting basis over time. Otherwise a change in cost per outcome may reflect measurement changes rather than operational performance.</p>
<h2>Keep beneficiary counts and outcomes conceptually separate</h2><p>Cost per beneficiary answers a reach question, while cost per outcome answers what it cost to achieve the defined result. A participant can receive services without achieving the outcome, and one person may contribute to more than one output. Define deduplication, attribution period and outcome criteria before reporting the ratio. For grant comparisons, also check whether overhead, in-kind support and partner costs are included consistently in the program-cost numerator.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is cost per beneficiary?','Program cost divided by the number of unique beneficiaries served during the same reporting period.'],['What is cost per outcome?','Program cost divided by the number of beneficiaries who achieved the clearly defined outcome.'],['Does a lower cost per outcome always mean a better program?','No. Cost efficiency is only one dimension; outcome quality, equity, duration, attribution and beneficiary needs also matter.'],['Should overhead be included in program cost?','Use the accounting basis required for your analysis or funder, and keep it consistent across comparisons.']];
require __DIR__.'/../includes/tool-template.php';
