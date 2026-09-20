<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','crop-break-even-price-calculator');
ob_start();
?>
<h2>Estimate crop break-even selling price</h2>
<p class="lead">Combine fixed and variable production costs with expected marketable yield to find the minimum price per output unit.</p>
<div class="form-grid"><div class="field"><label for="fixed">Fixed costs</label><input id="fixed" type="number" value="12000" min="0" step="any"></div><div class="field"><label for="variable">Variable costs</label><input id="variable" type="number" value="28000" min="0" step="any"></div><div class="field"><label for="yield">Expected marketable yield</label><input id="yield" type="number" value="50000" min="0.000001" step="any"></div><div class="field"><label for="profit">Target profit</label><input id="profit" type="number" value="5000" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div><div class="field"><label for="unit">Yield unit label</label><input id="unit" type="text" value="kg"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Total production cost</span><strong id="total">—</strong></div><div class="metric"><span>Break-even price</span><strong id="be">—</strong></div><div class="metric"><span>Price incl. target profit</span><strong id="target">—</strong></div><div class="metric"><span>Target profit share</span><strong id="profitShare">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const fixed=n('fixed'),variable=n('variable'),y=n('yield'),profit=n('profit');if(![fixed,variable,y,profit].every(Number.isFinite)||fixed<0||variable<0||profit<0||y<=0){note('Enter non-negative costs and a yield greater than zero.',true);return;}
const total=fixed+variable,be=total/y,target=(total+profit)/y,c=$('currency').value||'',u=$('unit').value||'unit';
$('total').textContent=money(total,c);$('be').textContent=money(be,c)+' / '+u;$('target').textContent=money(target,c)+' / '+u;$('profitShare').textContent=pct(profit/(total+profit)*100);
note('Break-even price = total production cost ÷ expected marketable yield. Target price adds the entered profit before dividing by yield.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('fixed')?.addEventListener('input',go);$('fixed')?.addEventListener('change',go);$('variable')?.addEventListener('input',go);$('variable')?.addEventListener('change',go);$('yield')?.addEventListener('input',go);$('yield')?.addEventListener('change',go);$('profit')?.addEventListener('input',go);$('profit')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the crop break-even price calculator works</h2><p>The calculator adds fixed and variable production costs, then divides that total by expected marketable yield. A second result adds your target profit before dividing by yield. This makes the cost basis transparent instead of hiding it inside a spreadsheet.</p>
<h2>When to use this farm calculation</h2><p>Use the result when evaluating crop marketing offers, comparing yield scenarios or deciding how much price movement a crop can absorb. It is most useful when the cost inputs and expected saleable yield refer to the same field, area or production period.</p>
<h2>Inputs, units and assumptions</h2><p>Use consistent currency and yield units. Include only costs that belong to the crop being evaluated, and use marketable yield rather than biological yield if some output is normally lost or downgraded. The result is a planning estimate, not a guaranteed market price.</p>
<h2>Practical example</h2><p>If total crop cost is ₹40,000 and expected marketable output is 50,000 kg, the break-even price is ₹0.80/kg. Adding a ₹5,000 profit goal lifts the target price to ₹0.90/kg.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is crop break-even price?','It is the selling price per unit of marketable yield required to recover the production costs included in the calculation.'],['Should land rent and machinery costs be included?','Include them if they are part of the economic cost you want the crop to recover. Keep the scope consistent across scenarios.'],['Should I use expected or best-case yield?','Use a realistic marketable yield assumption and test more than one scenario because break-even price changes directly with yield.'],['Does this calculator predict crop prices?','No. It calculates a cost-based threshold; market prices depend on supply, demand, quality, location and contracts.']];
require __DIR__.'/../includes/tool-template.php';
