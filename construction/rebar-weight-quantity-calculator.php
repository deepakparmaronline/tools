<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','rebar-weight-quantity-calculator');
ob_start();
?>
<h2>Estimate rebar weight and stock-bar quantity</h2>
<p class="lead">Use bar diameter, required length and an allowance for laps/cuts to estimate steel weight and stock bars.</p>
<div class="form-grid"><div class="field"><label for="dia">Bar diameter (mm)</label><input id="dia" type="number" value="12" min="0.1" step="any"></div><div class="field"><label for="totalLength">Total required bar length (m)</label><input id="totalLength" type="number" value="500" min="0" step="any"></div><div class="field"><label for="stock">Stock bar length (m)</label><input id="stock" type="number" value="12" min="0.1" step="any"></div><div class="field"><label for="lap">Lap/cut allowance (%)</label><input id="lap" type="number" value="5" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Approx. unit weight</span><strong id="unit">—</strong></div><div class="metric"><span>Length incl. allowance</span><strong id="adj">—</strong></div><div class="metric"><span>Approx. steel weight</span><strong id="weight">—</strong></div><div class="metric"><span>Stock bars required</span><strong id="bars">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const d=n('dia'),L=n('totalLength'),stock=n('stock'),lap=n('lap')/100;if(![d,L,stock,lap].every(Number.isFinite)||d<=0||L<0||stock<=0||lap<0){note('Check diameter, length and allowance.',true);return;}const unit=d*d/162,adj=L*(1+lap),weight=unit*adj,bars=Math.ceil(adj/stock);$('unit').textContent=fmt(unit,3)+' kg/m';$('adj').textContent=fmt(adj,2)+' m';$('weight').textContent=fmt(weight,1)+' kg';$('bars').textContent=bars+' stock bars';note('The d²/162 rule is an approximate metric unit-weight formula for steel rebar. Final schedules must follow project bar-bending details, laps, hooks and specified steel mass.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('dia')?.addEventListener('input',go);$('dia')?.addEventListener('change',go);$('totalLength')?.addEventListener('input',go);$('totalLength')?.addEventListener('change',go);$('stock')?.addEventListener('input',go);$('stock')?.addEventListener('change',go);$('lap')?.addEventListener('input',go);$('lap')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the rebar weight & quantity calculator works</h2><p>For metric reinforcing bar, a common estimating approximation for unit mass is diameter² ÷ 162 kg/m. The calculator applies the entered lap/cut allowance to total length, then multiplies by unit mass and rounds stock bars up by stock length.</p><h2>Where this construction calculation helps</h2><p>Use it for preliminary reinforcement takeoffs and weight cross-checks when bar diameter and total scheduled length are known.</p><h2>Measurements and assumptions</h2><p>The d²/162 relationship is an approximation. Actual certified unit mass, rib geometry and project standards may differ slightly. A true bar-bending schedule must account for bends, hooks, lap lengths, couplers, bar marks and cutting optimization.</p><h2>Worked example</h2><p>A 12 mm bar has an estimated unit weight of about 0.889 kg/m. Five hundred metres plus a 5% allowance weighs about 467 kg.</p>
<h3>Convert reinforcement length into purchasing weight</h3>
<p>A rebar weight calculator uses bar diameter and total length to estimate steel mass. It is useful for takeoffs, procurement checks and comparing reinforcement schedules, but total bar length should include the detailing shown on approved drawings. Laps, hooks, bends, anchorage, starter bars and cutting waste can add substantial length beyond simple member dimensions. Bar unit weight can also vary slightly by standard and manufacturing tolerance. Use the calculated weight as an estimating check and rely on the structural bar bending schedule for final reinforcement quantities.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is the formula for rebar weight per metre?','A common metric estimating formula is d²/162 kg/m, where d is nominal bar diameter in millimetres.'],['Does the calculator include lap length?','It applies an entered percentage allowance rather than designing code-required lap lengths.'],['Why can stock-bar count differ from weight-based ordering?','Cutting patterns and offcuts can increase the number of stock bars even when total theoretical length is unchanged.'],['Can this replace a bar bending schedule?','No. Detailed reinforcement fabrication requires the approved structural drawings and bar schedule.']];
require __DIR__.'/../includes/tool-template.php';
