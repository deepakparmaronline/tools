<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','salon-commission-calculator');
ob_start();
?>
<h2>Calculate salon commission and total pay</h2>
<p class="lead">Apply separate service and retail commission rates, then add optional base pay for the selected payroll period.</p>
<div class="form-grid"><div class="field"><label for="serviceSales">Service sales</label><input id="serviceSales" type="number" value="200000" min="0" step="any"></div><div class="field"><label for="serviceRate">Service commission (%)</label><input id="serviceRate" type="number" value="10" min="0" max="100" step="any"></div><div class="field"><label for="retailSales">Retail product sales</label><input id="retailSales" type="number" value="50000" min="0" step="any"></div><div class="field"><label for="retailRate">Retail commission (%)</label><input id="retailRate" type="number" value="15" min="0" max="100" step="any"></div><div class="field"><label for="base">Base pay for period</label><input id="base" type="number" value="25000" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Service commission</span><strong id="sc">—</strong></div><div class="metric"><span>Retail commission</span><strong id="rc">—</strong></div><div class="metric"><span>Total commission</span><strong id="commission">—</strong></div><div class="metric"><span>Base + commission</span><strong id="pay">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const ss=n('serviceSales'),sr=n('serviceRate')/100,rs=n('retailSales'),rr=n('retailRate')/100,b=n('base');if(![ss,sr,rs,rr,b].every(Number.isFinite)||ss<0||rs<0||b<0||sr<0||sr>1||rr<0||rr>1){note('Enter non-negative sales/pay and commission rates between 0% and 100%.',true);return;}const sc=ss*sr,rc=rs*rr,total=sc+rc,pay=b+total,c=$('currency').value||'';$('sc').textContent=money(sc,c);$('rc').textContent=money(rc,c);$('commission').textContent=money(total,c);$('pay').textContent=money(pay,c);note('This calculator applies flat commission rates. Check employment rules, taxes, minimum wages, deductions and any tiered plan separately.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('serviceSales')?.addEventListener('input',go);$('serviceSales')?.addEventListener('change',go);$('serviceRate')?.addEventListener('input',go);$('serviceRate')?.addEventListener('change',go);$('retailSales')?.addEventListener('input',go);$('retailSales')?.addEventListener('change',go);$('retailRate')?.addEventListener('input',go);$('retailRate')?.addEventListener('change',go);$('base')?.addEventListener('input',go);$('base')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the salon commission calculator works</h2><p>Service and retail sales are multiplied by their respective flat commission rates. The two commission amounts are added, then optional base pay is included to show gross compensation before payroll deductions.</p><h2>How salons and spas can use it</h2><p>Use separate rates when a salon wants to reward service production and retail selling differently. The tool can also help staff understand how entered sales translate into gross commission under a simple plan.</p><h2>Assumptions to review</h2><p>Many salons use thresholds, tiers, team pools, guarantees or commission only after discounts/refunds. This calculator intentionally uses transparent flat rates. Employment law, minimum wage, overtime, payroll tax and contractor classification must be handled outside the commission math.</p><h2>Example</h2><p>With ₹200,000 in service sales at 10% and ₹50,000 retail at 15%, commission is ₹27,500. Adding ₹25,000 base pay gives ₹52,500 gross before deductions.</p>
<h3>Check commission against service margin</h3>
<p>A salon commission calculator is most useful when commission is evaluated together with the revenue base on which it is paid. Some businesses calculate commission on gross service sales, while others exclude tax, discounts, refunds, product cost or a threshold amount. Define that base clearly before comparing plans. A higher commission percentage can still be sustainable for high-margin services, while the same percentage may compress margin on heavily discounted or product-intensive treatments. Use the result to model compensation, not as a substitute for employment or tax rules.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Can service and retail commission rates be different?','Yes. The calculator applies separate rates to each sales category.'],['Does this support tiered commission?','Not directly. It is a flat-rate calculator; calculate each tier separately or adapt the plan before entering values.'],['Are taxes deducted?','No. Results are gross commission/pay before payroll tax, statutory deductions or other adjustments.'],['Should refunds be removed from sales?','If your commission policy excludes refunded or cancelled revenue, use net eligible sales rather than gross bookings.']];
require __DIR__.'/../includes/tool-template.php';
