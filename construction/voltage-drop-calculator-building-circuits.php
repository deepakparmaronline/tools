<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','voltage-drop-calculator-building-circuits');
ob_start();
?>
<h2>Estimate building-circuit voltage drop</h2>
<p class="lead">Calculate approximate resistive voltage drop for copper or aluminium conductors and compare it with an editable design percentage.</p>
<div class="form-grid"><div class="field"><label for="system">Circuit type</label><select id="system"><option value="single" selected>Single-phase / two-wire</option><option value="three">Three-phase</option></select></div><div class="field"><label for="material">Conductor material</label><select id="material"><option value="copper" selected>Copper</option><option value="aluminum">Aluminium</option></select></div><div class="field"><label for="length">One-way conductor length (m)</label><input id="length" type="number" value="30" min="0" step="any"></div><div class="field"><label for="current">Load current (A)</label><input id="current" type="number" value="20" min="0" step="any"></div><div class="field"><label for="area">Conductor area (mm²)</label><input id="area" type="number" value="4" min="0.01" step="any"></div><div class="field"><label for="voltage">Nominal system voltage (V)</label><input id="voltage" type="number" value="230" min="0.01" step="any"></div><div class="field"><label for="temp">Conductor temperature estimate (°C)</label><input id="temp" type="number" value="40" min="-50" step="any"></div><div class="field"><label for="limit">Design comparison limit (%)</label><input id="limit" type="number" value="3" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Estimated voltage drop</span><strong id="drop">—</strong></div><div class="metric"><span>Voltage drop percentage</span><strong id="pct">—</strong></div><div class="metric"><span>Estimated load-end voltage</span><strong id="end">—</strong></div><div class="metric"><span>Comparison</span><strong id="status">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const type=$('system').value,mat=$('material').value,L=n('length'),I=n('current'),A=n('area'),V=n('voltage'),T=n('temp'),limit=n('limit');if(![L,I,A,V,T,limit].every(Number.isFinite)||L<0||I<0||A<=0||V<=0||limit<0){note('Check length, current, conductor size and voltage.',true);return;}const rho20=mat==='copper'?0.017241:0.028264,alpha=mat==='copper'?0.00393:0.00403,rho=rho20*(1+alpha*(T-20)),r=rho*L/A,drop=(type==='three'?Math.sqrt(3):2)*I*r,p=drop/V*100,end=V-drop;$('drop').textContent=fmt(drop,2)+' V';$('pct').textContent=pct(p);$('end').textContent=fmt(end,2)+' V';$('status').textContent=p<=limit?'Within entered limit':'Above entered limit';note('This is a resistive planning estimate. AC reactance, power factor, cable grouping, ampacity, harmonics and local electrical-code requirements can affect design.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('system')?.addEventListener('input',go);$('system')?.addEventListener('change',go);$('material')?.addEventListener('input',go);$('material')?.addEventListener('change',go);$('length')?.addEventListener('input',go);$('length')?.addEventListener('change',go);$('current')?.addEventListener('input',go);$('current')?.addEventListener('change',go);$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);$('voltage')?.addEventListener('input',go);$('voltage')?.addEventListener('change',go);$('temp')?.addEventListener('input',go);$('temp')?.addEventListener('change',go);$('limit')?.addEventListener('input',go);$('limit')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the voltage drop calculator for building circuits works</h2><p>The tool estimates conductor resistance from resistivity, length and cross-sectional area, with a simple temperature adjustment. A two-wire/single-phase circuit uses twice the one-way resistance; a balanced three-phase circuit uses √3 times the one-way resistance. Voltage drop percentage is drop divided by nominal voltage.</p><h2>Where this construction calculation helps</h2><p>Use it as an early conductor-sizing cross-check before detailed electrical design.</p><h2>Measurements and assumptions</h2><p>This model focuses on conductor resistance. Real AC circuits may require impedance, reactance and power-factor treatment. Ampacity, fault protection, grounding, derating, harmonics and installation methods must be checked separately against the applicable electrical code. The comparison percentage is editable rather than presented as a universal legal limit.</p><h2>Worked example</h2><p>For a 230 V single-phase circuit, longer cable runs or smaller conductor area increase resistance and therefore voltage drop for the same current.</p>
<h3>Use voltage drop as one part of conductor selection</h3>
<p>A building-circuit voltage drop calculator estimates the reduction in voltage caused by conductor resistance over a specified run. It is useful for comparing conductor sizes and identifying long circuits that may need closer review, but voltage drop is only one design constraint. Ampacity, insulation rating, installation method, ambient temperature, grouping, fault protection, earthing and local electrical code can govern the final cable size. Treat the entered voltage-drop limit as a design target and have regulated electrical work checked by a qualified professional.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Why is one-way length doubled for a single-phase two-wire circuit?','Current travels out to the load and returns through the circuit conductors, so the resistive path includes both directions.'],['Does this calculator check cable ampacity?','No. Voltage drop and thermal ampacity are separate design checks.'],['Why is the voltage-drop limit editable?','Recommended or required limits depend on the applicable code, circuit type and design criteria.'],['Can I use this for three-phase circuits?','Yes for a balanced resistive planning estimate; detailed designs may need cable impedance and power-factor data.']];
require __DIR__.'/../includes/tool-template.php';
