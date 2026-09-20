<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','portion-yield-calculator');ob_start(); ?>
<h2>Calculate recipe or batch yield</h2>
<p class="lead">Enter purchased batch quantity, waste percentage and portion size to estimate usable portions.</p>
<div class="form-grid"><div class="field"><label for="batch">Purchased batch quantity</label><input id="batch" type="number" value="10" step="0.01" min="0"></div><div class="field"><label for="waste">Trim / waste (%)</label><input id="waste" type="number" value="15" step="0.01" min="0" max="100"></div><div class="field"><label for="portion">Portion size in same quantity unit</label><input id="portion" type="number" value="0.25" step="0.01" min="0.000001"></div><div class="field"><label for="batchCost">Batch purchase cost</label><input id="batchCost" type="number" value="1200" step="0.01" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Usable quantity</span><strong id="usable">—</strong></div><div class="metric"><span>Full portions</span><strong id="portions">—</strong></div><div class="metric"><span>Cost per full portion</span><strong id="costPortion">—</strong></div><div class="metric"><span>Yield %</span><strong id="yieldPct">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const b=num('batch'),w=num('waste')/100,p=num('portion'),c=num('batchCost');if(b<0||w<0||w>1||p<=0||c<0){note('Check batch, waste, portion size and cost inputs.',true);return;}const usable=b*(1-w),portions=Math.floor(usable/p),cost=portions>0?c/portions:NaN;$('usable').textContent=dec(usable,3);$('portions').textContent=dec(portions,0);$('costPortion').textContent=Number.isFinite(cost)?money(cost,''):'—';$('yieldPct').textContent=pct((1-w)*100);note('Batch quantity and portion size must use the same unit, such as kg and kg.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Usable quantity = purchased batch quantity × (1 − waste rate). Full portions = usable quantity ÷ portion size, rounded down to complete portions. When batch cost is supplied, cost per full portion = batch cost ÷ full portions.</p><h2>How to use the result</h2><p>Use yield calculations for meats, produce, dough, sauces or other ingredients where trim, cooking or preparation losses affect usable quantity. Consistent yield assumptions improve recipe costing and purchasing forecasts.</p><h2>Assumptions and limitations</h2><p>Waste can vary by supplier, product grade, staff technique and cooking method. The calculator treats the entered waste rate as one combined loss and does not distinguish trim, cooking shrinkage or spoilage.</p><h2>Example</h2><p>If 10 kg has 15% loss, usable yield is 8.5 kg. At 0.25 kg per portion, that supports 34 full portions.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What units should I use?','Any quantity unit works as long as batch quantity and portion size use the same unit.'],['Why are portions rounded down?','The calculator reports complete portions rather than counting a partial remainder as a full serving.'],['Is waste the same as cooking loss?','You can use the field for total expected loss, but operationally you may want to track trim and cooking loss separately.'],['How is cost per portion calculated?','The entered batch purchase cost is divided by the number of full usable portions.']];require __DIR__.'/../includes/tool-template.php';
