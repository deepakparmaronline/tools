<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','staff-incentive-calculator');
ob_start();
?>
<h2>Estimate staff incentive above a target</h2>
<p class="lead">Apply an incentive percentage only to eligible production above a threshold, with an optional quality or attendance multiplier.</p>
<div class="form-grid"><div class="field"><label for="actual">Eligible sales / production</label><input id="actual" type="number" value="250000" min="0" step="any"></div><div class="field"><label for="target">Target threshold</label><input id="target" type="number" value="200000" min="0" step="any"></div><div class="field"><label for="rate">Incentive rate on amount above target (%)</label><input id="rate" type="number" value="8" min="0" max="100" step="any"></div><div class="field"><label for="quality">Quality / attendance multiplier (%)</label><input id="quality" type="number" value="100" min="0" max="200" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Amount above target</span><strong id="excess">—</strong></div><div class="metric"><span>Base incentive</span><strong id="baseInc">—</strong></div><div class="metric"><span>Adjusted incentive</span><strong id="incentive">—</strong></div><div class="metric"><span>Target attainment</span><strong id="attain">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const a=n('actual'),t=n('target'),r=n('rate')/100,q=n('quality')/100;if(![a,t,r,q].every(Number.isFinite)||a<0||t<0||r<0||r>1||q<0){note('Check sales, target, rate and multiplier.',true);return;}const excess=Math.max(0,a-t),base=excess*r,incent=base*q,c=$('currency').value||'';$('excess').textContent=money(excess,c);$('baseInc').textContent=money(base,c);$('incentive').textContent=money(incent,c);$('attain').textContent=t>0?pct(a/t*100):'—';note('This models a simple threshold incentive. Document plan eligibility and avoid metrics that encourage unsafe rushing, overselling or poor customer outcomes.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('actual')?.addEventListener('input',go);$('actual')?.addEventListener('change',go);$('target')?.addEventListener('input',go);$('target')?.addEventListener('change',go);$('rate')?.addEventListener('input',go);$('rate')?.addEventListener('change',go);$('quality')?.addEventListener('input',go);$('quality')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the staff incentive calculator works</h2><p>The calculator subtracts the target threshold from eligible sales or production. Only the positive excess is multiplied by the incentive rate, then an optional quality/attendance multiplier adjusts the payout.</p><h2>How salons and spas can use it</h2><p>A threshold model can reward incremental performance without paying the same rate on baseline production. The multiplier can represent a clearly documented quality, retention or attendance condition when that is appropriate for the workplace.</p><h2>Assumptions to review</h2><p>Incentive plans should define eligible revenue, refunds, discounts, team splits and payout timing. Compensation laws and employment contracts vary by location. Avoid incentive structures that pressure staff to skip sanitation, shorten treatments unsafely or oversell services.</p><h2>Example</h2><p>At ₹250,000 eligible production against a ₹200,000 target, ₹50,000 is above target. An 8% rate produces a ₹4,000 base incentive before any multiplier.</p>
<h3>Design incentives around measurable salon performance</h3>
<p>A staff incentive calculator can model bonuses for service revenue, retail sales, rebooking or performance above a threshold, but the metric should be defined before the percentage is chosen. Decide whether incentives apply to total revenue or only the amount above target, how refunds and discounts are handled, and whether team and individual results are combined. Testing several scenarios helps management see the payroll cost of an incentive plan before launch and reduces disagreements caused by unclear bonus calculations.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Is the incentive paid on all sales?','In this calculator it is paid only on the amount above the entered threshold.'],['What is the multiplier for?','It lets you adjust the base incentive using a documented factor such as quality or attendance performance.'],['Can I model a tiered incentive plan?','Calculate each tier separately or adapt the eligible excess amount. This tool intentionally keeps the formula transparent.'],['Should incentives be based only on revenue?','Not necessarily. Balanced plans may also consider quality, retention, compliance and customer outcomes.']];
require __DIR__.'/../includes/tool-template.php';
