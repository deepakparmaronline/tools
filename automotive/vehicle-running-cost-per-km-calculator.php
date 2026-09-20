<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('automotive','vehicle-running-cost-per-km-calculator');
ob_start();
?>
<h2>Estimate vehicle running cost per kilometre</h2>
<p class="lead">Combine fuel, maintenance, annual fixed costs and depreciation into a transparent cost-per-km estimate.</p>
<div class="form-grid"><div class="field"><label for="fuelPrice">Fuel price per litre</label><input id="fuelPrice" type="number" value="100" min="0" step="any"></div><div class="field"><label for="eff">Fuel economy (km/L)</label><input id="eff" type="number" value="15" min="0.0001" step="any"></div><div class="field"><label for="maint">Maintenance & tyres per km</label><input id="maint" type="number" value="2.5" min="0" step="any"></div><div class="field"><label for="annualFixed">Insurance, registration & fixed annual cost</label><input id="annualFixed" type="number" value="30000" min="0" step="any"></div><div class="field"><label for="annualKm">Annual distance (km)</label><input id="annualKm" type="number" value="15000" min="0.0001" step="any"></div><div class="field"><label for="purchase">Vehicle purchase value</label><input id="purchase" type="number" value="1000000" min="0" step="any"></div><div class="field"><label for="resale">Expected resale value</label><input id="resale" type="number" value="500000" min="0" step="any"></div><div class="field"><label for="years">Ownership period (years)</label><input id="years" type="number" value="5" min="0.1" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Fuel cost</span><strong id="fuel">—</strong></div><div class="metric"><span>Fixed cost allocation</span><strong id="fixed">—</strong></div><div class="metric"><span>Depreciation</span><strong id="dep">—</strong></div><div class="metric"><span>Total cost per km</span><strong id="total">—</strong></div><div class="metric"><span>Estimated annual cost</span><strong id="annual">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const fp=n('fuelPrice'),eff=n('eff'),m=n('maint'),af=n('annualFixed'),ak=n('annualKm'),P=n('purchase'),R=n('resale'),yr=n('years');if(![fp,eff,m,af,ak,P,R,yr].every(Number.isFinite)||fp<0||eff<=0||m<0||af<0||ak<=0||P<0||R<0||yr<=0||R>P){note('Check fuel economy, annual distance, ownership years and vehicle values.',true);return;}const fuel=fp/eff,fixed=af/ak,dep=(P-R)/(yr*ak),total=fuel+m+fixed+dep,c=$('currency').value||'';$('fuel').textContent=money(fuel,c)+'/km';$('fixed').textContent=money(fixed,c)+'/km';$('dep').textContent=money(dep,c)+'/km';$('total').textContent=money(total,c)+'/km';$('annual').textContent=money(total*ak,c);note('This planning estimate excludes financing interest, parking, tolls, taxes not entered above and unexpected repairs.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('fuelPrice')?.addEventListener('input',go);$('fuelPrice')?.addEventListener('change',go);$('eff')?.addEventListener('input',go);$('eff')?.addEventListener('change',go);$('maint')?.addEventListener('input',go);$('maint')?.addEventListener('change',go);$('annualFixed')?.addEventListener('input',go);$('annualFixed')?.addEventListener('change',go);$('annualKm')?.addEventListener('input',go);$('annualKm')?.addEventListener('change',go);$('purchase')?.addEventListener('input',go);$('purchase')?.addEventListener('change',go);$('resale')?.addEventListener('input',go);$('resale')?.addEventListener('change',go);$('years')?.addEventListener('input',go);$('years')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the vehicle running cost per km calculator works</h2><p>Fuel cost per kilometre is fuel price divided by km/L. Annual insurance and registration are spread across annual kilometres. Straight-line depreciation spreads purchase value minus expected resale value across the ownership period and annual distance. Maintenance and tyre cost is entered directly per kilometre.</p>
<h2>Use cost per km for better comparisons</h2><p>A vehicle with low fuel consumption can still be expensive to operate if depreciation, insurance or maintenance is high. Putting all major ownership costs on the same per-kilometre basis helps compare personal cars, fleet vehicles, delivery routes and reimbursement rates.</p>
<h2>Costs this estimate does not automatically include</h2><p>Loan interest, parking, tolls, road taxes, accident damage and unusual repairs are not included unless you add them to the annual fixed or maintenance assumptions. Electric vehicles can still use the same framework if you separately convert charging cost into an energy cost per kilometre.</p>
<h2>Improve accuracy with your own records</h2><p>Use actual annual distance, observed fuel economy and maintenance history rather than brochure figures. Depreciation is often the largest hidden ownership cost, so realistic resale assumptions matter.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is fuel cost per km calculated?','Fuel price per litre is divided by kilometres travelled per litre.'],['Does this include depreciation?','Yes. It uses purchase price minus expected resale value, spread across ownership years and annual kilometres.'],['Can I use it for a business fleet?','Yes, but add any fleet-specific financing, permits, telematics, downtime or driver costs separately.'],['Why does annual distance change the result?','Fixed annual costs and depreciation are spread across the kilometres driven, so low utilization can raise cost per kilometre.']];
require __DIR__.'/../includes/tool-template.php';
