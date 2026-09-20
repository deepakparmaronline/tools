<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','fertilizer-nutrient-conversion-calculator');
ob_start();
?>
<h2>Convert fertilizer analysis into nutrient amounts</h2>
<p class="lead">Calculate N, P₂O₅ and K₂O supplied by a fertilizer quantity, plus elemental P/K equivalents and a reverse N requirement.</p>
<div class="form-grid"><div class="field"><label for="qty">Fertilizer product quantity (kg)</label><input id="qty" type="number" value="100" min="0" step="any"></div><div class="field"><label for="nPct">Nitrogen N (%)</label><input id="nPct" type="number" value="20" min="0" max="100" step="any"></div><div class="field"><label for="pPct">Phosphate P₂O₅ (%)</label><input id="pPct" type="number" value="20" min="0" max="100" step="any"></div><div class="field"><label for="kPct">Potash K₂O (%)</label><input id="kPct" type="number" value="20" min="0" max="100" step="any"></div><div class="field"><label for="targetN">Target N (kg) for reverse calculation</label><input id="targetN" type="number" value="60" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Nitrogen supplied</span><strong id="nkg">—</strong></div><div class="metric"><span>P₂O₅ supplied</span><strong id="pkg">—</strong></div><div class="metric"><span>K₂O supplied</span><strong id="kig">—</strong></div><div class="metric"><span>Elemental P / K</span><strong id="elemental">—</strong></div><div class="metric"><span>Product for target N</span><strong id="reverse">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const q=n('qty'),N=n('nPct'),P=n('pPct'),K=n('kPct'),target=n('targetN');if(![q,N,P,K,target].every(Number.isFinite)||q<0||[N,P,K].some(x=>x<0||x>100)||target<0){note('Quantities must be non-negative and analyses must be between 0% and 100%.',true);return;}const nkg=q*N/100,p2=q*P/100,k2=q*K/100;$('nkg').textContent=fmt(nkg,2)+' kg N';$('pkg').textContent=fmt(p2,2)+' kg P₂O₅';$('kig').textContent=fmt(k2,2)+' kg K₂O';$('elemental').textContent=fmt(p2*0.4364,2)+' kg P / '+fmt(k2*0.8301,2)+' kg K';$('reverse').textContent=N>0?fmt(target/(N/100),2)+' kg product':'—';note('Elemental conversion uses P = P₂O₅ × 0.4364 and K = K₂O × 0.8301. Confirm the nutrient basis used by your local fertilizer label or recommendation.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('qty')?.addEventListener('input',go);$('qty')?.addEventListener('change',go);$('nPct')?.addEventListener('input',go);$('nPct')?.addEventListener('change',go);$('pPct')?.addEventListener('input',go);$('pPct')?.addEventListener('change',go);$('kPct')?.addEventListener('input',go);$('kPct')?.addEventListener('change',go);$('targetN')?.addEventListener('input',go);$('targetN')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the fertilizer nutrient conversion calculator works</h2><p>Multiplying product quantity by each guaranteed analysis percentage gives the declared nutrient amount. The tool also shows common oxide-to-element conversion factors for phosphorus and potassium and reverses the nitrogen calculation when a target N amount is entered.</p>
<h2>When to use this farm calculation</h2><p>Use this calculator when translating an N-P₂O₅-K₂O fertilizer grade into nutrient kilograms, checking a fertilizer plan, or comparing recommendations that use elemental P/K with labels that use oxide equivalents.</p>
<h2>Inputs, units and assumptions</h2><p>The calculator does not decide how much nutrient a crop needs. Soil tests, yield targets, nutrient availability, placement and local agronomic recommendations still matter. Confirm whether your local recommendation is expressed as P, P₂O₅, K or K₂O before converting.</p>
<h2>Practical example</h2><p>Applying 100 kg of a 20-20-20 product supplies 20 kg each of N, P₂O₅ and K₂O. The 20 kg P₂O₅ corresponds to about 8.73 kg elemental P.</p>
<h3>Read fertilizer labels before converting nutrients</h3>
<p>This fertilizer nutrient conversion calculator works from the guaranteed analysis on the product label, so the percentage entered should match the nutrient basis actually stated by the manufacturer. A 46% nitrogen fertilizer, for example, contains 46 units of nitrogen per 100 units of product by weight. Phosphate and potash grades may be expressed as P2O5 and K2O rather than elemental phosphorus and potassium. Do not substitute one basis for another without the appropriate conversion because that can materially change the application-rate estimate.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does N-P-K on a fertilizer label mean?','It commonly expresses percentages of nitrogen, phosphate as P₂O₅ and potash as K₂O, although label conventions should be confirmed locally.'],['How do I convert P₂O₅ to elemental phosphorus?','This tool multiplies P₂O₅ by 0.4364 for a standard mass conversion.'],['How do I convert K₂O to elemental potassium?','This tool multiplies K₂O by 0.8301.'],['Does this calculator recommend a fertilizer rate?','No. It converts quantities and nutrient bases; agronomic rate decisions require crop and soil context.']];
require __DIR__.'/../includes/tool-template.php';
