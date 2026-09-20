<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('agriculture','harvest-moisture-shrink-calculator');
ob_start();
?>
<h2>Estimate harvest moisture shrink</h2>
<p class="lead">Calculate dry matter, equivalent weight at target moisture and moisture-only shrink from harvested weight.</p>
<div class="form-grid"><div class="field"><label for="wetWeight">Harvested / wet weight</label><input id="wetWeight" type="number" value="10000" min="0" step="any"></div><div class="field"><label for="initial">Initial moisture (%)</label><input id="initial" type="number" value="20" min="0" max="99.9" step="any"></div><div class="field"><label for="final">Target moisture (%)</label><input id="final" type="number" value="14" min="0" max="99.9" step="any"></div><div class="field"><label for="unit">Weight unit label</label><input id="unit" type="text" value="kg"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Dry matter</span><strong id="dry">—</strong></div><div class="metric"><span>Weight at target moisture</span><strong id="finalWeight">—</strong></div><div class="metric"><span>Moisture shrink</span><strong id="shrink">—</strong></div><div class="metric"><span>Shrink percentage</span><strong id="shrinkPct">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const w=n('wetWeight'),mi=n('initial'),mf=n('final');if(![w,mi,mf].every(Number.isFinite)||w<0||mi<0||mf<0||mi>=100||mf>=100){note('Weight must be non-negative and moisture percentages must be below 100%.',true);return;}if(mf>mi){note('Target moisture is above initial moisture, so this is not a drying-shrink scenario.',true);return;}const dry=w*(100-mi)/100,finalW=dry/(1-mf/100),shrink=w-finalW,sp=w>0?shrink/w*100:0,u=$('unit').value||'units';$('dry').textContent=fmt(dry,2)+' '+u;$('finalWeight').textContent=fmt(finalW,2)+' '+u;$('shrink').textContent=fmt(shrink,2)+' '+u;$('shrinkPct').textContent=pct(sp);note('This is moisture-only shrink based on conserved dry matter. It does not add handling, respiration, cleaning or storage losses.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('wetWeight')?.addEventListener('input',go);$('wetWeight')?.addEventListener('change',go);$('initial')?.addEventListener('input',go);$('initial')?.addEventListener('change',go);$('final')?.addEventListener('input',go);$('final')?.addEventListener('change',go);$('unit')?.addEventListener('input',go);$('unit')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the harvest moisture shrink calculator works</h2><p>The tool assumes dry matter stays constant during drying. It first calculates dry matter from harvested weight and initial moisture, then divides that dry matter by the dry-matter fraction at target moisture. The difference between harvested and target-moisture weight is moisture shrink.</p>
<h2>When to use this farm calculation</h2><p>Use the calculation when normalizing grain, forage or other crop weight to a common moisture basis for storage planning, yield comparison or pricing discussions.</p>
<h2>Inputs, units and assumptions</h2><p>Real shrink can exceed moisture-only shrink because of handling, respiration, foreign-material removal and storage losses. Commercial elevators may also use prescribed shrink schedules rather than the pure dry-matter relationship shown here.</p>
<h2>Practical example</h2><p>If 10,000 kg is harvested at 20% moisture, it contains 8,000 kg dry matter. At 14% moisture, the same dry matter corresponds to about 9,302 kg, so moisture-only shrink is about 698 kg.</p>
<h3>Why moisture shrink matters after harvest</h3>
<p>Harvest moisture shrink estimates how much saleable weight remains after grain or another commodity is dried from the measured harvest moisture to a target moisture. The result is a physical moisture-loss estimate, not automatically the same as an elevator or processor shrink schedule. Commercial buyers can add handling shrink, use different moisture bases or round deductions differently. Use the calculator for planning and comparison, then apply the buyer's published shrink table when estimating an actual settlement or contract payment.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is moisture shrink?','It is the reduction in total weight caused by removing water as a crop dries to a lower moisture content.'],['Does the calculator include handling loss?','No. It isolates moisture-only shrink and assumes dry matter is conserved.'],['Why is target weight not simply initial weight minus the moisture percentage difference?','Moisture percentages are fractions of total weight, so the denominator changes as water is removed.'],['Can I use pounds or tonnes instead of kilograms?','Yes. The formula is unit-neutral as long as the same weight unit is used throughout.']];
require __DIR__.'/../includes/tool-template.php';
