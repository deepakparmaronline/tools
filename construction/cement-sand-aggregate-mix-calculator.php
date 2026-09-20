<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','cement-sand-aggregate-mix-calculator');
ob_start();
?>
<h2>Estimate cement, sand and aggregate for a nominal mix</h2>
<p class="lead">Convert finished concrete volume and a volume ratio into dry material volumes and approximate cement bags.</p>
<div class="form-grid"><div class="field"><label for="wet">Finished concrete volume (m³)</label><input id="wet" type="number" value="1" min="0" step="any"></div><div class="field"><label for="dryFactor">Dry-volume factor</label><input id="dryFactor" type="number" value="1.54" min="1" step="any"></div><div class="field"><label for="cement">Mix ratio: cement</label><input id="cement" type="number" value="1" min="0.0001" step="any"></div><div class="field"><label for="sand">Mix ratio: sand</label><input id="sand" type="number" value="2" min="0" step="any"></div><div class="field"><label for="agg">Mix ratio: aggregate</label><input id="agg" type="number" value="4" min="0" step="any"></div><div class="field"><label for="density">Cement bulk density (kg/m³)</label><input id="density" type="number" value="1440" min="1" step="any"></div><div class="field"><label for="bag">Cement bag weight (kg)</label><input id="bag" type="number" value="50" min="0.1" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Dry material volume</span><strong id="dry">—</strong></div><div class="metric"><span>Cement volume</span><strong id="cementVol">—</strong></div><div class="metric"><span>Approx. cement bags</span><strong id="bags">—</strong></div><div class="metric"><span>Sand volume</span><strong id="sandVol">—</strong></div><div class="metric"><span>Aggregate volume</span><strong id="aggVol">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const wet=n('wet'),df=n('dryFactor'),c=n('cement'),s=n('sand'),a=n('agg'),dens=n('density'),bag=n('bag');if(![wet,df,c,s,a,dens,bag].every(Number.isFinite)||wet<0||df<=0||c<=0||s<0||a<0||dens<=0||bag<=0){note('Check volume, mix ratio, density and bag weight.',true);return;}const dry=wet*df,parts=c+s+a,cv=dry*c/parts,sv=dry*s/parts,av=dry*a/parts,kg=cv*dens,bags=kg/bag;$('dry').textContent=fmt(dry,3)+' m³';$('cementVol').textContent=fmt(cv,3)+' m³';$('bags').textContent=fmt(bags,2)+' bags';$('sandVol').textContent=fmt(sv,3)+' m³';$('aggVol').textContent=fmt(av,3)+' m³';note('Nominal volume-ratio mixes are planning estimates. Structural concrete should follow the specified engineered mix design and measured material properties.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('wet')?.addEventListener('input',go);$('wet')?.addEventListener('change',go);$('dryFactor')?.addEventListener('input',go);$('dryFactor')?.addEventListener('change',go);$('cement')?.addEventListener('input',go);$('cement')?.addEventListener('change',go);$('sand')?.addEventListener('input',go);$('sand')?.addEventListener('change',go);$('agg')?.addEventListener('input',go);$('agg')?.addEventListener('change',go);$('density')?.addEventListener('input',go);$('density')?.addEventListener('change',go);$('bag')?.addEventListener('input',go);$('bag')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the cement-sand-aggregate mix calculator works</h2><p>The calculator applies an editable dry-volume factor to the finished concrete volume, then splits that dry volume according to the entered cement:sand:aggregate ratio. Cement volume is converted to mass using an editable bulk density and then into bags.</p><h2>Where this construction calculation helps</h2><p>Use this for preliminary material planning for nominal mixes, small non-critical works or cross-checking hand calculations.</p><h2>Measurements and assumptions</h2><p>The familiar dry-volume factor and bulk density are approximations, not universal constants. Moisture, voids, aggregate grading and mix design affect yield. Reinforced or structural concrete should be produced from the specified mix design, not a generic nominal ratio.</p><h2>Worked example</h2><p>For 1 m³ finished concrete with a 1:2:4 nominal ratio and 1.54 dry factor, dry material volume is 1.54 m³, divided across seven ratio parts.</p>
<h3>Use nominal mix quantities as an estimate, not a structural design</h3>
<p>This cement, sand and aggregate mix calculator converts a selected nominal proportion into approximate ingredient quantities. Actual concrete yield depends on moisture, bulking, aggregate grading, compaction and the relationship between dry ingredient volume and finished concrete volume. Structural concrete should follow the specified mix design, strength class and local code rather than a generic site ratio. For purchasing, add an appropriate site allowance and compare the calculated quantities with batching practice and supplier units.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Why is dry material volume higher than finished concrete volume?','Loose dry ingredients contain voids and settle when mixed, so planning methods often use a dry-volume allowance.'],['Is 1.54 always the correct factor?','No. It is a common estimating assumption, so the tool makes it editable.'],['Can I use this for structural concrete?','Use the project engineer\'s specified mix design for structural work. A nominal ratio calculator is not a substitute for engineered batching.'],['Why is cement density editable?','Bulk density varies with material condition and measurement method, so an editable value is more transparent than a hidden constant.']];
require __DIR__.'/../includes/tool-template.php';
