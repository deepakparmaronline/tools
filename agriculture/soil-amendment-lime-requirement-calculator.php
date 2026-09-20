<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','soil-amendment-lime-requirement-calculator');
ob_start();
?>
<h2>Adjust a soil-test lime requirement for material quality</h2>
<p class="lead">Convert a pure calcium-carbonate-equivalent recommendation into the amount of a lime material with a known effective neutralizing value.</p>
<div class="form-grid"><div class="field"><label for="recommended">Soil-test lime recommendation (pure CaCO₃ equivalent)</label><input id="recommended" type="number" value="2000" min="0" step="any"></div><div class="field"><label for="cce">Lime material effective CCE / neutralizing value (%)</label><input id="cce" type="number" value="90" min="0.1" max="200" step="any"></div><div class="field"><label for="area">Field area (ha)</label><input id="area" type="number" value="5" min="0" step="any"></div><div class="field"><label for="unit">Recommendation unit</label><select id="unit"><option value="kg" selected>kg/ha</option><option value="t">tonnes/ha</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Material required</span><strong id="mat">—</strong></div><div class="metric"><span>Material rate</span><strong id="tonnes">—</strong></div><div class="metric"><span>Total for field</span><strong id="total">—</strong></div><div class="metric"><span>Quality adjustment</span><strong id="adjust">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
let rec=n('recommended'),cce=n('cce')/100,a=n('area');if(![rec,cce,a].every(Number.isFinite)||rec<0||cce<=0||a<0){note('Enter a non-negative recommendation and a positive neutralizing value.',true);return;}if($('unit').value==='t')rec*=1000;const material=rec/cce,total=material*a;$('mat').textContent=fmt(material,0)+' kg/ha';$('tonnes').textContent=fmt(material/1000,3)+' t/ha';$('total').textContent=fmt(total/1000,2)+' t';$('adjust').textContent=fmt((1/cce)*100,1)+'% of pure-rate multiplier';note('This only adjusts a soil-test recommendation for material neutralizing value. It does not estimate lime need from pH alone.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('recommended')?.addEventListener('input',go);$('recommended')?.addEventListener('change',go);$('cce')?.addEventListener('input',go);$('cce')?.addEventListener('change',go);$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the soil amendment / lime requirement calculator works</h2><p>The calculator starts with a soil-test lime recommendation expressed on a pure calcium carbonate equivalent basis. Dividing that recommendation by the material's effective CCE or neutralizing fraction increases the physical product rate when the material is less reactive than pure CaCO₃.</p>
<h2>When to use this farm calculation</h2><p>Use this after a soil laboratory or local agronomy recommendation has already established the lime requirement. It is useful for comparing agricultural lime sources with different effective neutralizing values.</p>
<h2>Inputs, units and assumptions</h2><p>This is deliberately not a pH-only lime recommendation engine. Buffer pH, soil texture, target pH, crop, depth and local laboratory method can all affect the base recommendation. Enter the effectiveness value supplied for the actual material, which may be called CCE, ECCE or neutralizing value depending on region.</p>
<h2>Practical example</h2><p>A 2,000 kg/ha pure-equivalent recommendation with a 90% effective material requires about 2,222 kg/ha of that material.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Can I calculate lime requirement from soil pH alone?','No. Reliable lime recommendations commonly depend on buffer measurements and local soil-test methods, not only the current pH.'],['What is CCE?','Calcium carbonate equivalent is a measure of a liming material\'s acid-neutralizing capacity relative to pure calcium carbonate.'],['Why does a lower CCE increase product required?','Because more physical material is needed to deliver the same neutralizing equivalent.'],['Should I use CCE or ECCE?','Use the effectiveness value that matches the basis of your soil-test recommendation and supplier analysis. Local terminology and methods vary.']];
require __DIR__.'/../includes/tool-template.php';
