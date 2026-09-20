<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','seed-rate-calculator');
ob_start();
?>
<h2>Calculate seed rate from target population</h2>
<p class="lead">Use target plants, thousand seed weight, germination and expected field establishment to estimate kg/ha and total seed requirement.</p>
<div class="form-grid"><div class="field"><label for="target">Target established plants (per m²)</label><input id="target" type="number" value="250" min="0.0001" step="any"></div><div class="field"><label for="tkw">Thousand seed weight (g)</label><input id="tkw" type="number" value="40" min="0.0001" step="any"></div><div class="field"><label for="germ">Laboratory germination (%)</label><input id="germ" type="number" value="95" min="0.1" max="100" step="any"></div><div class="field"><label for="est">Expected field establishment (%)</label><input id="est" type="number" value="85" min="0.1" max="100" step="any"></div><div class="field"><label for="area">Area (hectares)</label><input id="area" type="number" value="10" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Seeds required per m²</span><strong id="seeds">—</strong></div><div class="metric"><span>Seed rate</span><strong id="rate">—</strong></div><div class="metric"><span>Seed rate per acre</span><strong id="acre">—</strong></div><div class="metric"><span>Seed for entered area</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const target=n('target'),tkw=n('tkw'),g=n('germ')/100,e=n('est')/100,a=n('area');if(![target,tkw,g,e,a].every(Number.isFinite)||target<=0||tkw<=0||g<=0||g>1||e<=0||e>1||a<0){note('Check target population, thousand seed weight, germination and establishment values.',true);return;}const seeds=target/(g*e),kgHa=seeds*tkw/100,total=kgHa*a;$('seeds').textContent=fmt(seeds,1)+' seeds/m²';$('rate').textContent=fmt(kgHa,1)+' kg/ha';$('acre').textContent=fmt(kgHa/2.47105381,1)+' kg/acre';$('total').textContent=fmt(total,1)+' kg';note('Seed rate = target plants adjusted for germination and field establishment, multiplied by seed weight. Use crop-specific establishment assumptions.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('target')?.addEventListener('input',go);$('target')?.addEventListener('change',go);$('tkw')?.addEventListener('input',go);$('tkw')?.addEventListener('change',go);$('germ')?.addEventListener('input',go);$('germ')?.addEventListener('change',go);$('est')?.addEventListener('input',go);$('est')?.addEventListener('change',go);$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the seed rate calculator works</h2><p>The target plant population is divided by germination and expected field establishment fractions to estimate seeds that must be sown per square metre. Thousand seed weight converts seed count to mass, and the result is scaled to kilograms per hectare.</p>
<h2>When to use this farm calculation</h2><p>This population-based method is useful when seed lots differ in size or germination. It is more transparent than using a fixed kg/ha rate because it shows how seed quality and establishment assumptions affect the required seed mass.</p>
<h2>Inputs, units and assumptions</h2><p>Field establishment is not the same as laboratory germination. Soil temperature, seedbed quality, sowing depth, pests and weather can reduce emergence. Crop-specific agronomy should determine the target population and realistic establishment percentage.</p>
<h2>Practical example</h2><p>At 250 target plants/m², 40 g thousand seed weight, 95% germination and 85% field establishment, the calculated sowing rate is about 124 kg/ha.</p>
<h3>Separate seed count from established plant target</h3>
<p>A useful seed rate calculator should not assume that every seed becomes a productive plant. Start with the target established population, then account for germination and expected field establishment before converting seed numbers into weight. Thousand-seed weight or seeds per kilogram can vary by variety, seed lot and grading, so use the value printed on the seed lot certificate when available. This produces a more defensible seeding-rate estimate than relying on a single generic kilograms-per-hectare figure.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Why use thousand seed weight in a seed rate calculator?','It converts the number of seeds required for the target population into a mass-based sowing rate.'],['What is field establishment percentage?','It is the share of viable sown seed expected to become established plants under field conditions.'],['Should I use laboratory germination as field establishment?','No. Laboratory germination measures viability under controlled conditions; field establishment normally includes additional field losses.'],['Can this be used for every crop?','The math is general, but target population and establishment assumptions must be chosen for the specific crop, seed lot and conditions.']];
require __DIR__.'/../includes/tool-template.php';
