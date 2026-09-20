<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','fertilizer-cost-per-nutrient-calculator');
ob_start();
?>
<h2>Compare fertilizer cost per unit of nutrient</h2>
<p class="lead">Turn package price, package weight and nutrient analysis into cost per kilogram of the selected nutrient.</p>
<div class="form-grid"><div class="field"><label for="price">Fertilizer package price</label><input id="price" type="number" value="1800" min="0" step="any"></div><div class="field"><label for="weight">Package weight (kg)</label><input id="weight" type="number" value="50" min="0.0001" step="any"></div><div class="field"><label for="nutrient">Nutrient analysis (%)</label><input id="nutrient" type="number" value="46" min="0.0001" max="100" step="any"></div><div class="field"><label for="required">Target nutrient amount (kg)</label><input id="required" type="number" value="60" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Nutrient in package</span><strong id="nutrientKg">—</strong></div><div class="metric"><span>Cost per kg nutrient</span><strong id="costKg">—</strong></div><div class="metric"><span>Product for target nutrient</span><strong id="product">—</strong></div><div class="metric"><span>Cost for target nutrient</span><strong id="targetCost">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const price=n('price'),w=n('weight'),p=n('nutrient'),req=n('required');if(![price,w,p,req].every(Number.isFinite)||price<0||w<=0||p<=0||p>100||req<0){note('Use a package weight above zero and a nutrient percentage between 0 and 100.',true);return;}const nutrientKg=w*p/100,costKg=price/nutrientKg,product=req/(p/100),cost=product*(price/w),c=$('currency').value||'';$('nutrientKg').textContent=fmt(nutrientKg,3)+' kg';$('costKg').textContent=money(costKg,c)+' / kg nutrient';$('product').textContent=fmt(product,2)+' kg product';$('targetCost').textContent=money(cost,c);note('For blends, calculate each nutrient separately only when the comparison objective is clear; the package price buys all nutrients together.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('price')?.addEventListener('input',go);$('price')?.addEventListener('change',go);$('weight')?.addEventListener('input',go);$('weight')?.addEventListener('change',go);$('nutrient')?.addEventListener('input',go);$('nutrient')?.addEventListener('change',go);$('required')?.addEventListener('input',go);$('required')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the fertilizer cost per nutrient calculator works</h2><p>The nutrient contained in a package equals package weight multiplied by the nutrient analysis percentage. Package price divided by nutrient kilograms gives cost per kilogram of nutrient. The target section reverses the same relationship to estimate product quantity and cost for a chosen nutrient requirement.</p>
<h2>When to use this farm calculation</h2><p>This is useful when two fertilizer products have different concentrations or package sizes and shelf price alone is misleading. Comparing cost per kilogram of the nutrient you actually need gives a more consistent economic view.</p>
<h2>Inputs, units and assumptions</h2><p>Fertilizer labels may report nitrogen as N but phosphorus and potassium as P₂O₅ and K₂O equivalents depending on the market. Compare like with like, and do not treat a blended fertilizer as if the other nutrients have zero value.</p>
<h2>Practical example</h2><p>A 50 kg bag at 46% nutrient contains 23 kg of that nutrient. If the bag costs ₹1,800, the nutrient cost is about ₹78.26 per kg before application or transport costs.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I calculate nutrient kilograms in a fertilizer bag?','Multiply package weight by the nutrient percentage expressed as a decimal.'],['Can I compare urea with a blended NPK product?','You can compare the cost of a specific declared nutrient, but a blend also supplies other nutrients that may have economic value.'],['Does the tool include application cost?','No. Add transport, spreading, labour or machinery costs separately when comparing total field cost.'],['What percentage should I enter?','Enter the guaranteed analysis percentage for the nutrient basis you are comparing, such as N, P₂O₅ or K₂O.']];
require __DIR__.'/../includes/tool-template.php';
