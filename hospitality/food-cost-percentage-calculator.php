<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','food-cost-percentage-calculator');ob_start(); ?>
<h2>Calculate food cost percentage</h2>
<p class="lead">Enter comparable food revenue and food cost for the same period or menu item.</p>
<div class="form-grid"><div class="field"><label for="sales">Food sales revenue</label><input id="sales" type="number" value="300000" step="0.01" min="0"></div><div class="field"><label for="cost">Food cost</label><input id="cost" type="number" value="90000" step="0.01" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Food cost %</span><strong id="foodPct">—</strong></div><div class="metric"><span>Gross profit before other costs</span><strong id="gross">—</strong></div><div class="metric"><span>Gross margin</span><strong id="grossPct">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('sales'),c=num('cost');if(s<0||c<0){note('Sales and cost cannot be negative.',true);return;}$('foodPct').textContent=s>0?pct(c/s*100):'—';$('gross').textContent=money(s-c,'');$('grossPct').textContent=s>0?pct((s-c)/s*100):'—';note('Use sales and food cost measured on the same basis and period.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Food cost percentage = food cost ÷ food sales × 100. The complementary gross margin before labor and other operating expenses is (food sales − food cost) ÷ food sales.</p><h2>How to use the result</h2><p>Use the metric at menu-item, category or period level to identify mix changes, purchasing pressure, waste or pricing issues. It is most useful when paired with recipe costing and inventory controls.</p><h2>Assumptions and limitations</h2><p>Accounting methods differ. Actual food cost may be based on beginning inventory + purchases − ending inventory, while recipe cost is theoretical. Taxes, comps, staff meals, waste and transfers can affect reported numbers.</p><h2>Example</h2><p>If food sales are 300,000 and food cost is 90,000, food cost percentage is 30% and gross margin before other expenses is 70%.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What is a good food cost percentage?','There is no universal target. It depends on concept, cuisine, pricing, labor model, rent and other operating costs.'],['Should I use purchases as food cost?','Purchases alone may not equal consumption. Period food cost is often adjusted for opening and closing inventory.'],['Is food cost percentage the same as gross margin?','No. Food cost percentage is cost divided by sales; gross margin is the remaining gross profit divided by sales.'],['Can I use this for a single menu item?','Yes, if sales price and recipe cost are measured consistently for that item.']];require __DIR__.'/../includes/tool-template.php';
