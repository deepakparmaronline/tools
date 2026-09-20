<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','menu-pricing-calculator');ob_start(); ?>
<h2>Price a menu item from recipe cost</h2>
<p class="lead">Enter cost per serving and the food cost percentage you want the selling price to represent.</p>
<div class="form-grid"><div class="field"><label for="cost">Recipe cost per serving</label><input id="cost" type="number" value="120" step="0.01" min="0"></div><div class="field"><label for="target">Target food cost (%)</label><input id="target" type="number" value="30" step="0.01" min="0.01" max="100"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Calculated menu price</span><strong id="price">—</strong></div><div class="metric"><span>Gross profit per serving</span><strong id="gross">—</strong></div><div class="metric"><span>Gross margin before other costs</span><strong id="margin">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const c=num('cost'),t=num('target')/100;if(c<0||t<=0||t>1){note('Cost cannot be negative and target food cost must be above 0% and at most 100%.',true);return;}const p=c/t;$('price').textContent=money(p,'');$('gross').textContent=money(p-c,'');$('margin').textContent=p>0?pct((p-c)/p*100):'—';note('Calculated price is a cost-based reference, not a demand or competitor price recommendation.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Menu price = recipe cost per serving ÷ target food cost rate. If the target food cost is 30%, the recipe cost is intended to represent 30% of the selling price.</p><h2>How to use the result</h2><p>Use cost-based pricing as one input alongside guest willingness to pay, competitive positioning, contribution to fixed costs, portion size and menu engineering. Round or adjust the calculated price deliberately rather than treating it as automatic.</p><h2>Assumptions and limitations</h2><p>The tool assumes recipe cost per serving is accurate and excludes labor, rent, utilities, commissions and other overhead unless they are built into your target. Actual food cost can also differ because of waste, yield and purchase-price changes.</p><h2>Example</h2><p>If a dish costs 120 per serving and the target food cost is 30%, the cost-based menu price is 400.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Is target food cost the same as target margin?','No. A 30% food cost implies a 70% gross margin before labor and other operating costs.'],['Should I round the calculated menu price?','Usually pricing also considers customer perception and menu strategy, so use the result as a reference and apply deliberate rounding.'],['Does this include labor?','Not directly. The formula uses recipe cost and the selected food-cost target.'],['What if ingredient prices change?','Update the recipe cost and recalculate; stale recipe costs can make menu prices misleading.']];require __DIR__.'/../includes/tool-template.php';
