<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','average-check-calculator');ob_start(); ?>
<h2>Calculate average check</h2>
<p class="lead">Measure average revenue per guest or cover for a meal period, day or reporting period.</p>
<div class="form-grid"><div class="field"><label for="revenue">Net sales revenue</label><input id="revenue" type="number" value="125000" step="0.01" min="0"></div><div class="field"><label for="covers">Covers / guests served</label><input id="covers" type="number" value="500" step="1" min="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Average check</span><strong id="avg">—</strong></div><div class="metric"><span>Revenue</span><strong id="rev">—</strong></div><div class="metric"><span>Covers</span><strong id="cov">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const r=num('revenue'),c=num('covers');if(r<0||c<=0){note('Revenue cannot be negative and covers must be greater than zero.',true);return;}$('avg').textContent=money(r/c,'');$('rev').textContent=money(r,'');$('cov').textContent=dec(c,0);note('Use the same definition of revenue and covers when comparing periods.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Average check = sales revenue ÷ number of covers. A cover generally represents one guest served, so the metric estimates how much revenue is generated per guest during the selected period.</p><h2>How to use the result</h2><p>Track average check alongside traffic, table turnover and food cost. An increase can come from price changes, product mix, add-ons or upselling, while a decline can reflect discounts or a shift toward lower-priced items.</p><h2>Assumptions and limitations</h2><p>Be consistent about whether revenue includes taxes, service charges, discounts, delivery sales or other non-dine-in revenue. Mixed definitions can make period comparisons misleading.</p><h2>Example</h2><p>If 125,000 in comparable restaurant sales comes from 500 covers, average check is 250.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What is a cover in a restaurant?','A cover generally means one guest served. Use your operation\'s standard reporting definition consistently.'],['Should GST be included in revenue?','Use whichever revenue basis your reporting system uses, but keep it consistent across periods.'],['Is average check the same as average order value?','They are similar, but average check usually uses guests/covers while order value uses transactions or orders.'],['Can average check rise while profit falls?','Yes. Higher revenue per guest does not guarantee better margin if food, labor, discount or channel costs rise.']];require __DIR__.'/../includes/tool-template.php';
