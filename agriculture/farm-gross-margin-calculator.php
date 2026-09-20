<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','farm-gross-margin-calculator');
ob_start();
?>
<h2>Calculate farm gross margin</h2>
<p class="lead">Measure the contribution left after variable production costs, with optional gross margin per area.</p>
<div class="form-grid"><div class="field"><label for="revenue">Gross farm / enterprise revenue</label><input id="revenue" type="number" value="150000" min="0" step="any"></div><div class="field"><label for="variable">Variable costs</label><input id="variable" type="number" value="90000" min="0" step="any"></div><div class="field"><label for="area">Area (optional)</label><input id="area" type="number" value="10" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Gross margin</span><strong id="margin">—</strong></div><div class="metric"><span>Gross margin ratio</span><strong id="ratio">—</strong></div><div class="metric"><span>Gross margin per area</span><strong id="perArea">—</strong></div><div class="metric"><span>Variable cost share</span><strong id="vcShare">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const r=n('revenue'),v=n('variable'),a=n('area');if(!Number.isFinite(r)||!Number.isFinite(v)||r<0||v<0){note('Revenue and variable costs must be non-negative.',true);return;}const gm=r-v,c=$('currency').value||'';$('margin').textContent=money(gm,c);$('ratio').textContent=r>0?pct(gm/r*100):'—';$('perArea').textContent=Number.isFinite(a)&&a>0?money(gm/a,c):'—';$('vcShare').textContent=r>0?pct(v/r*100):'—';note('Gross margin subtracts variable operating costs from revenue. It does not automatically deduct fixed overhead, financing or owner drawings.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('revenue')?.addEventListener('input',go);$('revenue')?.addEventListener('change',go);$('variable')?.addEventListener('input',go);$('variable')?.addEventListener('change',go);$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the farm gross margin calculator works</h2><p>Farm gross margin is calculated as gross revenue minus variable costs. The gross margin ratio divides that margin by revenue, while the per-area result divides the same margin by the optional area input.</p>
<h2>When to use this farm calculation</h2><p>Gross margin is useful for comparing crop, livestock or other farm enterprises that use the same scarce resources. It can highlight whether higher revenue is actually creating more contribution after seed, feed, fertilizer, chemicals, casual labour and other variable inputs.</p>
<h2>Inputs, units and assumptions</h2><p>This is not the same as net farm profit. Fixed machinery ownership costs, rent, permanent labour, depreciation, interest, taxes and household drawings may sit outside the variable-cost figure depending on your accounting method.</p>
<h2>Practical example</h2><p>An enterprise with ₹150,000 revenue and ₹90,000 variable cost produces a ₹60,000 gross margin. Across 10 hectares, that is ₹6,000 per hectare before fixed costs.</p>
<h3>Use gross margin for enterprise comparisons</h3>
<p>A farm gross margin calculator is most useful when the same cost boundary is used for every crop or livestock enterprise. Include revenue that belongs to the enterprise and subtract variable costs that change with production, such as seed, fertilizer, crop protection, feed, casual labor or other direct inputs. Keep fixed overhead, land ownership costs and financing separate unless your management system deliberately allocates them. Comparing gross margin per hectare, acre, animal or production cycle can then reveal which enterprises contribute more toward fixed costs and farm profit.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What costs belong in farm gross margin?','Typically costs that vary with the enterprise or production level, such as seed, fertilizer, feed, chemicals and directly variable labour or services.'],['Is gross margin the same as profit?','No. Gross margin is before fixed and overhead costs unless you deliberately include those costs in the variable-cost input.'],['Can I compare two crops with this result?','Yes, especially when the calculations use consistent cost definitions and a common unit such as margin per hectare or acre.'],['What does a negative gross margin mean?','It means the entered variable costs exceed the entered revenue for that scenario.']];
require __DIR__.'/../includes/tool-template.php';
