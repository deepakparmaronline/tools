<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','spray-tank-dilution-calculator');
ob_start();
?>
<h2>Calculate spray product per tank</h2>
<p class="lead">Use field area, carrier volume, tank capacity and label rate to estimate hectares per tank, product per full tank and total product.</p>
<div class="form-grid"><div class="field"><label for="field">Field area (ha)</label><input id="field" type="number" value="12" min="0" step="any"></div><div class="field"><label for="sprayVol">Spray volume (L/ha)</label><input id="sprayVol" type="number" value="200" min="0.0001" step="any"></div><div class="field"><label for="tank">Tank capacity (L)</label><input id="tank" type="number" value="600" min="0.0001" step="any"></div><div class="field"><label for="rate">Product rate (L or kg per ha)</label><input id="rate" type="number" value="1.5" min="0" step="any"></div><div class="field"><label for="unit">Product unit label</label><input id="unit" type="text" value="L"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Area per full tank</span><strong id="areaTank">—</strong></div><div class="metric"><span>Product per full tank</span><strong id="prodTank">—</strong></div><div class="metric"><span>Tank-load equivalent</span><strong id="tanks">—</strong></div><div class="metric"><span>Total product</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const field=n('field'),sv=n('sprayVol'),tank=n('tank'),rate=n('rate');if(![field,sv,tank,rate].every(Number.isFinite)||field<0||sv<=0||tank<=0||rate<0){note('Field area and product rate must be non-negative; spray volume and tank size must be above zero.',true);return;}const areaTank=tank/sv,productTank=rate*areaTank,tanks=field/areaTank,total=rate*field,u=$('unit').value||'units';$('areaTank').textContent=fmt(areaTank,3)+' ha';$('prodTank').textContent=fmt(productTank,3)+' '+u;$('tanks').textContent=fmt(tanks,2)+' tank loads';$('total').textContent=fmt(total,2)+' '+u;note('The full-tank mix is based on tank capacity. For the final partial tank, scale product to the actual water volume and treated area. Always follow the product label.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('field')?.addEventListener('input',go);$('field')?.addEventListener('change',go);$('sprayVol')?.addEventListener('input',go);$('sprayVol')?.addEventListener('change',go);$('tank')?.addEventListener('input',go);$('tank')?.addEventListener('change',go);$('rate')?.addEventListener('input',go);$('rate')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the spray tank dilution calculator works</h2><p>Area covered by a full tank equals tank capacity divided by spray volume per hectare. Multiplying that area by the product label rate gives product per full tank. Total product is simply field area multiplied by the per-hectare product rate.</p>
<h2>When to use this farm calculation</h2><p>This calculation helps translate a label rate per hectare into a practical tank mix after the sprayer has been calibrated to a known carrier volume. It also makes the final partial load easier to plan.</p>
<h2>Inputs, units and assumptions</h2><p>The tool does not determine whether a pesticide, fertilizer or adjuvant rate is permitted. Use only the approved label rate, required personal protective equipment, compatibility instructions and local regulations. Calibrate actual nozzle output before relying on the tank plan.</p>
<h2>Practical example</h2><p>At 200 L/ha with a 600 L tank, a full tank covers 3 ha. A 1.5 L/ha product rate therefore requires 4.5 L of product in each full tank.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I calculate hectares covered per tank?','Divide tank capacity by the calibrated spray volume per hectare.'],['How much chemical goes in a partial tank?','Scale the product to the actual area the partial water volume will cover, using the same per-hectare label rate.'],['Does this tool recommend pesticide rates?','No. It only converts an entered rate into tank quantities. The legal label and local regulations control permitted use.'],['Why is sprayer calibration important?','If actual litres per hectare differ from the entered value, the area covered by each tank and the required mix quantity will also differ.']];
require __DIR__.'/../includes/tool-template.php';
