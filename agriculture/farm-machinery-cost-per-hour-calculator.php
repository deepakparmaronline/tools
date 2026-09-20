<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','farm-machinery-cost-per-hour-calculator');
ob_start();
?>
<h2>Estimate farm machinery cost per hour</h2>
<p class="lead">Separate ownership and operating costs to estimate an hourly cost for tractors, harvesters and other farm machinery.</p>
<div class="form-grid"><div class="field"><label for="purchase">Purchase price</label><input id="purchase" type="number" value="2000000" min="0" step="any"></div><div class="field"><label for="salvage">Expected salvage value</label><input id="salvage" type="number" value="300000" min="0" step="any"></div><div class="field"><label for="life">Economic life (years)</label><input id="life" type="number" value="10" min="0.1" step="any"></div><div class="field"><label for="hours">Annual use (hours)</label><input id="hours" type="number" value="600" min="0.1" step="any"></div><div class="field"><label for="interest">Annual interest / capital rate (%)</label><input id="interest" type="number" value="8" min="0" step="any"></div><div class="field"><label for="otherAnnual">Insurance, tax & storage per year</label><input id="otherAnnual" type="number" value="50000" min="0" step="any"></div><div class="field"><label for="fuelUse">Fuel use per hour</label><input id="fuelUse" type="number" value="8" min="0" step="any"></div><div class="field"><label for="fuelPrice">Fuel price per unit</label><input id="fuelPrice" type="number" value="95" min="0" step="any"></div><div class="field"><label for="repair">Repairs & maintenance per hour</label><input id="repair" type="number" value="250" min="0" step="any"></div><div class="field"><label for="labor">Operator labour per hour</label><input id="labor" type="number" value="200" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Ownership cost / hour</span><strong id="fixedHr">—</strong></div><div class="metric"><span>Fuel cost / hour</span><strong id="fuelHr">—</strong></div><div class="metric"><span>Operating cost / hour</span><strong id="operHr">—</strong></div><div class="metric"><span>Total cost / hour</span><strong id="totalHr">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const P=n('purchase'),S=n('salvage'),L=n('life'),H=n('hours'),i=n('interest')/100,oa=n('otherAnnual'),fu=n('fuelUse'),fp=n('fuelPrice'),rep=n('repair'),lab=n('labor');
if(![P,S,L,H,i,oa,fu,fp,rep,lab].every(Number.isFinite)||P<0||S<0||S>P||L<=0||H<=0||i<0){note('Check purchase/salvage values, life, annual hours and non-negative operating costs.',true);return;}
const dep=(P-S)/L,cap=((P+S)/2)*i,fixed=(dep+cap+oa)/H,fuel=fu*fp,oper=fuel+rep+lab,total=fixed+oper,c=$('currency').value||'';
$('fixedHr').textContent=money(fixed,c);$('fuelHr').textContent=money(fuel,c);$('operHr').textContent=money(oper,c);$('totalHr').textContent=money(total,c);note('Ownership cost uses straight-line depreciation plus interest on average invested value. Enter local insurance, tax, repair and labour assumptions separately.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('purchase')?.addEventListener('input',go);$('purchase')?.addEventListener('change',go);$('salvage')?.addEventListener('input',go);$('salvage')?.addEventListener('change',go);$('life')?.addEventListener('input',go);$('life')?.addEventListener('change',go);$('hours')?.addEventListener('input',go);$('hours')?.addEventListener('change',go);$('interest')?.addEventListener('input',go);$('interest')?.addEventListener('change',go);$('otherAnnual')?.addEventListener('input',go);$('otherAnnual')?.addEventListener('change',go);$('fuelUse')?.addEventListener('input',go);$('fuelUse')?.addEventListener('change',go);$('fuelPrice')?.addEventListener('input',go);$('fuelPrice')?.addEventListener('change',go);$('repair')?.addEventListener('input',go);$('repair')?.addEventListener('change',go);$('labor')?.addEventListener('input',go);$('labor')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the farm machinery cost per hour calculator works</h2><p>Ownership cost uses straight-line depreciation, an annual capital charge on average invested value, and entered insurance/tax/storage costs spread over annual machine hours. Fuel, repairs and operator labour are then added as hourly operating costs.</p>
<h2>When to use this farm calculation</h2><p>Use an hourly machinery cost when comparing custom-hire quotes, estimating field-operation cost, building crop enterprise budgets or deciding whether higher annual utilization makes ownership more economical.</p>
<h2>Inputs, units and assumptions</h2><p>Actual machinery economics vary with resale value, financing, repair history, fuel load, inflation and taxes. The capital-rate method here is a planning approximation; if you have a loan schedule or detailed depreciation method, replace the simplified assumptions with your accounting figures.</p>
<h2>Practical example</h2><p>A machine used only a few hundred hours each year usually has a higher ownership cost per hour than the same machine used more intensively because annual fixed costs are spread across fewer hours.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is depreciation calculated?','The tool uses straight-line economic depreciation: purchase price minus expected salvage value, divided by economic life.'],['Why use average invested value for interest?','It provides a simple planning estimate of the capital tied up in the machine as value declines over its life.'],['Are repairs included?','Yes, as an editable hourly amount. Use your own maintenance records when available.'],['Should operator labour be included?','Include it when you want the full field-operation cost rather than machine-only ownership and operating cost.']];
require __DIR__.'/../includes/tool-template.php';
