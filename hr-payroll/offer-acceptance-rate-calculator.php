<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','offer-acceptance-rate-calculator');ob_start(); ?>
<h2>Measure offer acceptance</h2>
<p class="lead">Enter accepted, declined and still-pending offers for the reporting period.</p>
<div class="form-grid"><div class="field"><label for="accepted">Accepted offers</label><input id="accepted" type="number" value="35" step="1" min="0"></div><div class="field"><label for="declined">Declined offers</label><input id="declined" type="number" value="10" step="1" min="0"></div><div class="field"><label for="pending">Pending offers</label><input id="pending" type="number" value="5" step="1" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Decided offers</span><strong id="decided">—</strong></div><div class="metric"><span>Acceptance rate</span><strong id="rate">—</strong></div><div class="metric"><span>Decline rate</span><strong id="decline">—</strong></div><div class="metric"><span>Pending share of all offers</span><strong id="pendingShare">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const a=num('accepted'),d=num('declined'),p=num('pending');if([a,d,p].some(v=>v<0)){note('Offer counts cannot be negative.',true);return;}const decided=a+d,total=decided+p;$('decided').textContent=dec(decided,0);$('rate').textContent=decided>0?pct(a/decided*100):'—';$('decline').textContent=decided>0?pct(d/decided*100):'—';$('pendingShare').textContent=total>0?pct(p/total*100):'—';note('Pending offers are excluded from the acceptance-rate denominator until a decision is recorded.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Offer acceptance rate = accepted offers ÷ (accepted + declined offers) × 100. Pending offers are shown separately and excluded from the decided-offer denominator so they do not depress the rate before candidates respond.</p><h2>How to use the result</h2><p>Track acceptance by role, level, location, recruiter or hiring manager to find patterns. Pair the metric with offer cycle time and decline reasons to understand why acceptance changes.</p><h2>Assumptions and limitations</h2><p>Organizations sometimes define the denominator differently, especially for rescinded or expired offers. Use a documented definition and compare periods only when statuses are classified consistently.</p><h2>Example</h2><p>With 35 accepted and 10 declined offers, the decided-offer acceptance rate is 77.78%.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Why are pending offers excluded?','A pending offer has not yet produced an accept/decline decision, so excluding it avoids treating undecided outcomes as declines.'],['Should rescinded offers count?','Use your organization\'s reporting definition and apply it consistently. You may exclude them or classify them separately.'],['Can I calculate acceptance by recruiter?','Yes. Enter only the offers attributable to that recruiter and period.'],['Is a high acceptance rate always good?','It is one recruiting metric; hiring quality, compensation competitiveness and candidate experience also matter.']];require __DIR__.'/../includes/tool-template.php';
