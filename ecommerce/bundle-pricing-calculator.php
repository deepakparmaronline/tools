<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('ecommerce','bundle-pricing-calculator');ob_start(); ?>
<h2>Price a product bundle</h2>
<p class="lead">Compare the combined standalone value with a discounted bundle price and the bundle's total cost.</p>
<div class="form-grid"><div class="field"><label for="standalone">Combined standalone selling value</label><input id="standalone" type="number" value="300" step="0.01" min="0"></div><div class="field"><label for="cost">Total bundle cost</label><input id="cost" type="number" value="150" step="0.01" min="0"></div><div class="field"><label for="discount">Bundle discount (%)</label><input id="discount" type="number" value="10" step="0.01" min="0" max="100"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Bundle price</span><strong id="price">—</strong></div><div class="metric"><span>Customer saving</span><strong id="saving">—</strong></div><div class="metric"><span>Gross profit</span><strong id="profit">—</strong></div><div class="metric"><span>Gross margin</span><strong id="margin">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('standalone'),c=num('cost'),d=num('discount');if(s<0||c<0||d<0||d>100){note('Use non-negative values and a discount from 0% to 100%.',true);return;}const p=s*(1-d/100),profit=p-c;$('price').textContent=money(p,'');$('saving').textContent=money(s-p,'');$('profit').textContent=money(profit,'');$('margin').textContent=p>0?pct(profit/p*100):'—';note(profit<0?'The entered discount makes the bundle gross-profit negative.':'Compare this margin with your minimum acceptable bundle margin.',profit<0);}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Bundle price = combined standalone value × (1 − discount rate). Customer saving is the difference between the standalone value and bundle price. Gross profit = bundle price − total bundle cost, and gross margin = gross profit ÷ bundle price.</p><h2>How to use the result</h2><p>Use the outputs to test whether a promotion still leaves enough gross margin after the advertised bundle discount. If marketplace fees, shipping, taxes or returns are material, include them in the cost input or model them separately.</p><h2>Assumptions and limitations</h2><p>The calculation is a gross-profit view. It does not automatically include payment fees, marketplace commissions, fulfilment fees, taxes, advertising or return losses unless you include those amounts in total bundle cost.</p><h2>Example</h2><p>If items normally sell for 300 together, cost 150 and the bundle discount is 10%, the bundle price is 270 and gross profit is 120.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Should I enter product cost or selling price?','Enter the combined standalone selling value in the first field and the total economic cost of the bundle in the cost field.'],['Does the calculator include marketplace fees?','Not automatically. Add them to bundle cost when you want them reflected in gross profit.'],['Can a larger bundle discount reduce profit even if sales rise?','Yes. This tool shows unit economics only; higher volume must be assessed separately.'],['What is bundle gross margin?','It is bundle gross profit divided by the final bundle selling price.']];require __DIR__.'/../includes/tool-template.php';
