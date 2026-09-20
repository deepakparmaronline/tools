<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','plant-population-spacing-calculator');
ob_start();
?>
<h2>Calculate plant population from row and plant spacing</h2>
<p class="lead">Convert row spacing and in-row spacing into plants per square metre, hectare, acre and optional field total.</p>
<div class="form-grid"><div class="field"><label for="row">Row spacing</label><input id="row" type="number" value="45" min="0.0001" step="any"></div><div class="field"><label for="plant">Plant spacing within row</label><input id="plant" type="number" value="20" min="0.0001" step="any"></div><div class="field"><label for="unit">Spacing unit</label><select id="unit"><option value="cm" selected>Centimetres</option><option value="in">Inches</option></select></div><div class="field"><label for="area">Field area (hectares)</label><input id="area" type="number" value="1" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Population per m²</span><strong id="m2">—</strong></div><div class="metric"><span>Population per hectare</span><strong id="ha">—</strong></div><div class="metric"><span>Population per acre</span><strong id="acre">—</strong></div><div class="metric"><span>Plants in entered area</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
let r=n('row'),p=n('plant'),a=n('area');if(![r,p,a].every(Number.isFinite)||r<=0||p<=0||a<0){note('Row and plant spacing must be greater than zero.',true);return;}if($('unit').value==='in'){r*=0.0254;p*=0.0254;}else{r/=100;p/=100;}const perM2=1/(r*p),perHa=perM2*10000,perAcre=perM2*4046.8564224,total=perHa*a;$('m2').textContent=fmt(perM2,2)+' plants/m²';$('ha').textContent=fmt(perHa,0)+' plants/ha';$('acre').textContent=fmt(perAcre,0)+' plants/acre';$('total').textContent=fmt(total,0)+' plants';note('This is a geometric target population. Actual established population can be lower because of germination, emergence, skips and field losses.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('row')?.addEventListener('input',go);$('row')?.addEventListener('change',go);$('plant')?.addEventListener('input',go);$('plant')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the plant population / spacing calculator works</h2><p>For rectangular spacing, each plant occupies row spacing multiplied by in-row plant spacing. The reciprocal gives plants per square metre, which is then scaled to hectares and acres.</p>
<h2>When to use this farm calculation</h2><p>Use the calculator to translate a planting geometry into target population, compare alternative row widths, or estimate how many planting positions fit in a field before accounting for germination and establishment.</p>
<h2>Inputs, units and assumptions</h2><p>Spacing must be measured centre-to-centre and expressed in the selected unit. The estimate assumes uniform rectangular spacing and does not model headlands, irregular field boundaries, double rows, skips or mortality.</p>
<h2>Practical example</h2><p>Rows 45 cm apart with plants 20 cm apart produce about 11.11 plants/m², or roughly 111,111 planting positions per hectare.</p>
<h3>Translate spacing into a realistic field population</h3>
<p>A plant population and spacing calculator gives the mathematical population implied by row spacing and in-row spacing, but the number of established plants can be lower than the number of seeds placed. Germination percentage, emergence losses, skips, doubles, transplant mortality and field conditions all affect the final stand. Use the theoretical population as the starting point for seed ordering and layout, then apply an establishment allowance appropriate to the crop, planting method and local agronomic recommendation.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do row spacing and plant spacing affect population?','Narrower rows or closer in-row spacing increase the number of planting positions per unit area.'],['Does this equal final stand count?','Not necessarily. Germination, emergence and field losses can reduce established population.'],['Can I enter inches?','Yes. Select inches and the tool converts the spacing before calculating population.'],['Does field shape matter?','The per-area population does not, but the total field count can be lower in irregular fields because of headlands and unusable space.']];
require __DIR__.'/../includes/tool-template.php';
