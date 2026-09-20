<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','service-pricing-calculator');
ob_start();
?>
<h2>Price a salon or spa service from cost and target margin</h2>
<p class="lead">Combine loaded labour, product/disposable cost and allocated overhead, then calculate a price that reaches the entered gross-margin target.</p>
<div class="form-grid"><div class="field"><label for="minutes">Staff time per service (minutes)</label><input id="minutes" type="number" value="60" min="0" step="any"></div><div class="field"><label for="laborHr">Loaded labour cost per hour</label><input id="laborHr" type="number" value="400" min="0" step="any"></div><div class="field"><label for="product">Products & disposables per service</label><input id="product" type="number" value="300" min="0" step="any"></div><div class="field"><label for="overhead">Allocated overhead per service</label><input id="overhead" type="number" value="250" min="0" step="any"></div><div class="field"><label for="margin">Target gross margin (%)</label><input id="margin" type="number" value="55" min="0" max="99.9" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Labour cost</span><strong id="labor">—</strong></div><div class="metric"><span>Total service cost</span><strong id="cost">—</strong></div><div class="metric"><span>Price for target margin</span><strong id="price">—</strong></div><div class="metric"><span>Equivalent markup</span><strong id="markup">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const min=n('minutes'),lh=n('laborHr'),prod=n('product'),oh=n('overhead'),m=n('margin')/100;if(![min,lh,prod,oh,m].every(Number.isFinite)||min<0||lh<0||prod<0||oh<0||m<0||m>=1){note('Enter non-negative costs and a target margin below 100%.',true);return;}const labor=min/60*lh,cost=labor+prod+oh,price=cost/(1-m),profit=price-cost,markup=cost>0?profit/cost*100:0,c=$('currency').value||'';$('labor').textContent=money(labor,c);$('cost').textContent=money(cost,c);$('price').textContent=money(price,c);$('markup').textContent=pct(markup);note('Target-margin pricing divides service cost by 1 minus the target margin. Market positioning and customer willingness to pay still matter.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('minutes')?.addEventListener('input',go);$('minutes')?.addEventListener('change',go);$('laborHr')?.addEventListener('input',go);$('laborHr')?.addEventListener('change',go);$('product')?.addEventListener('input',go);$('product')?.addEventListener('change',go);$('overhead')?.addEventListener('input',go);$('overhead')?.addEventListener('change',go);$('margin')?.addEventListener('input',go);$('margin')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the service pricing calculator works</h2><p>Labour cost is staff minutes multiplied by loaded hourly labour cost. Product/disposable cost and allocated overhead are added to form service cost. The selling price required for a target margin is cost divided by one minus the target margin.</p><h2>How salons and spas can use it</h2><p>Use cost-based pricing as a floor for service-menu decisions. It reveals whether a popular treatment is priced high enough to cover labour, consumables and a fair share of overhead before owner profit or reinvestment.</p><h2>Assumptions to review</h2><p>Gross margin and markup are different. A 50% margin requires a 100% markup on cost. The calculator does not estimate customer demand, competitor pricing, tax, payment fees or the opportunity cost of scarce appointment slots unless you include them in cost.</p><h2>Example</h2><p>If a service costs ₹950 after labour, products and overhead, a 55% target margin requires a price of about ₹2,111.</p>
<h3>Build a salon service price from cost and time</h3>
<p>A salon service pricing calculator is stronger when technician time, product usage and overhead are treated separately. Labor should reflect the real cost of providing the appointment, consumables should reflect expected usage, and overhead allocation should cover the share of rent, utilities, software and support costs required by the service. After calculating a cost-based price, compare it with positioning, demand and local market prices. The goal is not to copy competitors but to understand the minimum economics behind a sustainable menu price.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is loaded labour cost?','It can include wage plus employer payroll costs, benefits and other direct employment costs you want assigned to service time.'],['Is margin the same as markup?','No. Margin is profit divided by selling price; markup is profit divided by cost.'],['Should rent be included?','Allocate a reasonable share of rent and other overhead if you want the price to help recover those costs.'],['Does this calculator add tax?','No. Treat applicable tax separately based on local rules and whether displayed prices are tax-inclusive.']];
require __DIR__.'/../includes/tool-template.php';
