<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','roof-pitch-roof-area-calculator');
ob_start();
?>
<h2>Calculate roof pitch, slope factor and roof area</h2>
<p class="lead">Convert rise/run to pitch angle and estimate sloped area for a simple roof from plan dimensions.</p>
<div class="form-grid"><div class="field"><label for="length">Building / roof plan length (m)</label><input id="length" type="number" value="10" min="0" step="any"></div><div class="field"><label for="width">Building / roof plan width (m)</label><input id="width" type="number" value="8" min="0" step="any"></div><div class="field"><label for="rise">Pitch rise</label><input id="rise" type="number" value="6" min="0" step="any"></div><div class="field"><label for="run">Pitch run</label><input id="run" type="number" value="12" min="0.0001" step="any"></div><div class="field"><label for="waste">Roofing waste allowance (%)</label><input id="waste" type="number" value="10" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Pitch angle</span><strong id="angle">—</strong></div><div class="metric"><span>Slope factor</span><strong id="factor">—</strong></div><div class="metric"><span>Sloped roof area</span><strong id="area">—</strong></div><div class="metric"><span>Area incl. waste</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const L=n('length'),W=n('width'),rise=n('rise'),run=n('run'),wa=n('waste')/100;if(![L,W,rise,run,wa].every(Number.isFinite)||L<0||W<0||rise<0||run<=0||wa<0){note('Check plan dimensions, pitch and waste.',true);return;}const slope=rise/run,factor=Math.sqrt(1+slope*slope),area=L*W*factor,total=area*(1+wa),angle=Math.atan(slope)*180/Math.PI;$('angle').textContent=fmt(angle,2)+'°';$('factor').textContent=fmt(factor,4);$('area').textContent=fmt(area,2)+' m²';$('total').textContent=fmt(total,2)+' m²';note('This assumes a simple symmetrical roof where sloped area equals plan area × slope factor. Hips, valleys, overhangs and complex roof geometry need separate takeoffs.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('length')?.addEventListener('input',go);$('length')?.addEventListener('change',go);$('width')?.addEventListener('input',go);$('width')?.addEventListener('change',go);$('rise')?.addEventListener('input',go);$('rise')?.addEventListener('change',go);$('run')?.addEventListener('input',go);$('run')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the roof pitch & roof area calculator works</h2><p>Pitch slope is rise divided by run. The angle is arctangent of that slope, while the slope factor is √(1 + slope²). Multiplying horizontal plan area by the slope factor estimates the sloped surface area for a simple roof.</p><h2>Where this construction calculation helps</h2><p>Use it to translate familiar pitch ratios into degrees and get an early roofing-material area before detailed hip, valley and flashing takeoffs.</p><h2>Measurements and assumptions</h2><p>The plan dimensions should reflect the horizontal roof footprint you want covered. Add overhangs if they are part of the roof area. Complex roofs should be divided into individual planes rather than treated as one rectangle.</p><h2>Worked example</h2><p>A 6:12 pitch has a slope of 0.5, an angle of about 26.57° and a slope factor of about 1.118.</p>
<h3>Distinguish plan area from sloped roof area</h3>
<p>A roof pitch and roof area calculator adjusts horizontal plan dimensions for slope so material coverage reflects the inclined surface rather than only the building footprint. The estimate may still need additions for eaves, rakes, hips, valleys, dormers and other roof geometry. Roofing products are commonly purchased in discrete sheets, bundles or tiles, so convert the calculated area using the manufacturer's coverage and add cutting or lap allowance appropriate to the system. Complex roofs should be broken into measurable planes instead of treated as one rectangle.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does a 6:12 roof pitch mean?','It means the roof rises 6 units for every 12 horizontal units of run.'],['Why is roof area larger than plan area?','The sloped surface is longer than its horizontal projection; the slope factor accounts for that difference.'],['Does the formula include overhangs?','Only if the entered plan length and width include them.'],['Can I use this for hip roofs?','Use it only as a rough plan-area cross-check; hips and valleys need plane-by-plane geometry for accurate material takeoff.']];
require __DIR__.'/../includes/tool-template.php';
