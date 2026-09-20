<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('small-business','billable-utilization-rate-calculator');ob_start(); ?>
<h2>Measure billable utilization</h2>
<p class="lead">Compare client-billable hours with available working hours for the same person, team or period.</p>
<div class="form-grid"><div class="field"><label for="billable">Billable hours</label><input id="billable" type="number" value="120" step="0.01" min="0"></div><div class="field"><label for="available">Available working hours</label><input id="available" type="number" value="160" step="0.01" min="0.0001"></div><div class="field"><label for="target">Target utilization (%)</label><input id="target" type="number" value="75" step="0.01" min="0" max="100"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Billable utilization</span><strong id="util">—</strong></div><div class="metric"><span>Non-billable hours</span><strong id="nonbillable">—</strong></div><div class="metric"><span>Billable hours at target</span><strong id="targetHours">—</strong></div><div class="metric"><span>Hours vs target</span><strong id="gap">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const b=num('billable'),a=num('available'),t=num('target')/100;if(b<0||a<=0||t<0||t>1){note('Billable hours cannot be negative, available hours must be positive, and target must be 0%–100%.',true);return;}const th=a*t;$('util').textContent=pct(b/a*100);$('nonbillable').textContent=dec(a-b,2);$('targetHours').textContent=dec(th,2);$('gap').textContent=dec(b-th,2);note(b>a?'Billable hours exceed available hours. This may reflect overtime or a mismatch in definitions.':'Use a consistent definition of available capacity, excluding or including leave as your business policy requires.',b>a);}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Billable utilization = billable hours ÷ available working hours × 100. Target billable hours = available hours × target utilization. The gap shows actual billable hours minus target billable hours.</p><h2>How to use the result</h2><p>Use utilization for capacity planning, pricing and hiring decisions, but pair it with realization rate, project margin and workload sustainability. Non-billable time can include sales, training, administration and product development that still creates business value.</p><h2>Assumptions and limitations</h2><p>The denominator is a management choice. Some firms use paid hours, others subtract holidays, leave or internal time. A percentage is only comparable when the available-hours definition is consistent.</p><h2>Example</h2><p>120 billable hours out of 160 available hours equals 75% billable utilization.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What counts as available hours?','Use the capacity definition your business manages against, such as paid hours or net workable hours after leave.'],['Can utilization exceed 100%?','Yes if billable hours include overtime or if the available-hours denominator is too narrow; the tool flags that condition.'],['Is higher utilization always better?','No. Excessive utilization can crowd out sales, training, administration and recovery time.'],['How is target gap calculated?','Actual billable hours minus the billable hours required to hit the entered utilization target.']];require __DIR__.'/../includes/tool-template.php';
