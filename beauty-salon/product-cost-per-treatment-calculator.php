<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','product-cost-per-treatment-calculator');
ob_start();
?>
<h2>Calculate product cost per treatment</h2>
<p class="lead">Convert package cost and product usage into treatment-level consumable cost, including expected wastage and disposables.</p>
<div class="form-grid"><div class="field"><label for="packCost">Product container/package cost</label><input id="packCost" type="number" value="3000" min="0" step="any"></div><div class="field"><label for="packQty">Usable quantity in package (ml, g or units)</label><input id="packQty" type="number" value="500" min="0.0001" step="any"></div><div class="field"><label for="use">Quantity used per treatment</label><input id="use" type="number" value="12" min="0" step="any"></div><div class="field"><label for="waste">Expected wastage (%)</label><input id="waste" type="number" value="5" min="0" max="99" step="any"></div><div class="field"><label for="disposable">Other disposables per treatment</label><input id="disposable" type="number" value="120" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Cost per product unit</span><strong id="unitCost">—</strong></div><div class="metric"><span>Product cost / treatment</span><strong id="prodCost">—</strong></div><div class="metric"><span>Total consumables / treatment</span><strong id="total">—</strong></div><div class="metric"><span>Treatments per package</span><strong id="treatments">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const pc=n('packCost'),pq=n('packQty'),use=n('use'),w=n('waste')/100,d=n('disposable');if(![pc,pq,use,w,d].every(Number.isFinite)||pc<0||pq<=0||use<0||w<0||w>=1||d<0){note('Check package quantity, usage and wastage values.',true);return;}const unit=pc/pq,adjUse=use/(1-w),prod=unit*adjUse,total=prod+d,treat=pq/adjUse,c=$('currency').value||'';$('unitCost').textContent=money(unit,c);$('prodCost').textContent=money(prod,c);$('total').textContent=money(total,c);$('treatments').textContent=fmt(treat,1);note('Wastage increases effective product used per completed treatment. Labour, rent and overhead are not included unless added separately.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('packCost')?.addEventListener('input',go);$('packCost')?.addEventListener('change',go);$('packQty')?.addEventListener('input',go);$('packQty')?.addEventListener('change',go);$('use')?.addEventListener('input',go);$('use')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);$('disposable')?.addEventListener('input',go);$('disposable')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the product cost per treatment calculator works</h2><p>The package cost is divided by usable package quantity to get cost per ml, gram or unit. Entered usage is adjusted upward for expected wastage, then other single-use consumables are added.</p><h2>How salons and spas can use it</h2><p>Treatment-level product costing helps price services, compare brands and detect hidden margin erosion from over-dispensing. It is also useful for training staff on standard usage quantities.</p><h2>Assumptions to review</h2><p>The calculation covers consumables only. Labour, utilities, equipment depreciation, room occupancy, card fees and general overhead belong in a full service-pricing model. Wastage should reflect actual dispensing loss rather than an arbitrary cushion.</p><h2>Example</h2><p>A ₹3,000 500 ml product costs ₹6/ml. Using 12 ml with 5% wastage makes effective usage about 12.63 ml, or roughly ₹75.79 in product before other disposables.</p>
<h3>Measure consumable cost at treatment level</h3>
<p>Product cost per treatment is more accurate when usage is measured in the same unit in which inventory is purchased. Convert millilitres, grams, pumps, sachets or units consistently, include normal dispensing waste where relevant, and separate reusable equipment from consumables. For services that use several products, calculate each product's treatment cost and add them together. The resulting direct product cost can then support service pricing, margin reviews, technician training and inventory controls without confusing retail product price with actual treatment consumption.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is product cost per treatment calculated?','Package cost is divided by usable package quantity, then multiplied by effective usage per treatment.'],['Why adjust usage for wastage?','Spillage, residue and dispensing loss can make purchased product consumption higher than the amount intentionally applied.'],['Can I use grams or individual units?','Yes. Keep package quantity and treatment usage in the same unit.'],['Does this include staff labour?','No. It calculates product and entered disposable cost; labour and overhead should be added in service pricing.']];
require __DIR__.'/../includes/tool-template.php';
