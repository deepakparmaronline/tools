<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','material-wastage-allowance-calculator');
ob_start();
?>
<h2>Add a material wastage allowance</h2>
<p class="lead">Turn a net takeoff into an order quantity and see the cost impact of the selected waste percentage.</p>
<div class="form-grid"><div class="field"><label for="base">Net required quantity</label><input id="base" type="number" value="100" min="0" step="any"></div><div class="field"><label for="waste">Wastage allowance (%)</label><input id="waste" type="number" value="10" min="0" step="any"></div><div class="field"><label for="unit">Quantity unit</label><input id="unit" type="text" value="m²"></div><div class="field"><label for="unitCost">Unit cost (optional)</label><input id="unitCost" type="number" value="500" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Waste allowance quantity</span><strong id="extra">—</strong></div><div class="metric"><span>Order quantity</span><strong id="total">—</strong></div><div class="metric"><span>Net material cost</span><strong id="baseCost">—</strong></div><div class="metric"><span>Cost incl. waste</span><strong id="totalCost">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const b=n('base'),w=n('waste')/100,cost=n('unitCost');if(![b,w,cost].every(Number.isFinite)||b<0||w<0||cost<0){note('Enter non-negative quantity, waste and cost.',true);return;}const extra=b*w,total=b+extra,u=$('unit').value||'units',c=$('currency').value||'';$('extra').textContent=fmt(extra,3)+' '+u;$('total').textContent=fmt(total,3)+' '+u;$('baseCost').textContent=money(b*cost,c);$('totalCost').textContent=money(total*cost,c);note('A waste percentage is an estimating allowance, not a substitute for a layout or cut optimization. Use trade- and project-specific evidence.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('base')?.addEventListener('input',go);$('base')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);$('unitCost')?.addEventListener('input',go);$('unitCost')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the material wastage allowance calculator works</h2><p>The waste quantity equals net requirement × waste percentage. Adding it to the net requirement gives the planned order quantity, and optional unit cost shows the financial effect.</p><h2>Where this construction calculation helps</h2><p>Use it as a quick cross-check after a measured takeoff for tiles, boards, flooring, pipe, cable or other materials where cuts, damage or offcuts are expected.</p><h2>Measurements and assumptions</h2><p>A single percentage cannot model every material. Standardized panels may need pack rounding; expensive cut-to-length items may need optimization; custom stone patterns may need significantly more allowance. Base the percentage on trade guidance and actual project geometry.</p><h2>Worked example</h2><p>A net requirement of 100 m² with 10% waste gives an order quantity of 110 m².</p>
<h3>Set wastage by material and installation method</h3>
<p>A material wastage allowance should be a project assumption, not a universal percentage. Tiles, reinforcement, timber, drywall, pipe, cable and finishing materials generate different kinds of offcuts and losses. Repetition, module size, storage conditions, workmanship and the geometry of the project all affect the extra quantity required. Use the calculator to compare base quantity with alternative waste allowances, then document the selected percentage in the estimate so procurement can distinguish designed quantity from contingency.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Is wastage the same as contingency?','Not exactly. Wastage covers expected material loss from cuts, damage or handling; project contingency can cover broader uncertainty.'],['Should I add waste before pack rounding?','Usually yes: calculate waste-adjusted quantity first, then round to supplier pack or unit sizes.'],['Can wastage be zero?','Mathematically yes, but many physical materials require some allowance for cuts or defects.'],['Does a higher waste percentage always mean safer estimating?','It reduces shortage risk but can create unnecessary cost and surplus, so use evidence rather than an arbitrary high figure.']];
require __DIR__.'/../includes/tool-template.php';
