<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','headcount-growth-calculator');ob_start(); ?>
<h2>Measure headcount growth</h2>
<p class="lead">Compare opening and closing employee headcount for the same organizational scope.</p>
<div class="form-grid"><div class="field"><label for="start">Opening headcount</label><input id="start" type="number" value="80" step="1" min="0"></div><div class="field"><label for="end">Closing headcount</label><input id="end" type="number" value="100" step="1" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Net headcount change</span><strong id="change">—</strong></div><div class="metric"><span>Headcount growth</span><strong id="growth">—</strong></div><div class="metric"><span>Ending / opening multiple</span><strong id="multiple">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('start'),e=num('end');if(s<0||e<0){note('Headcount cannot be negative.',true);return;}$('change').textContent=dec(e-s,0);$('growth').textContent=s>0?pct((e-s)/s*100):(e>0?'New base':'—');$('multiple').textContent=s>0?dec(e/s,3)+'×':'—';note('Net headcount growth can hide simultaneous hiring and attrition; pair it with hires and departures when possible.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Net headcount change = closing headcount − opening headcount. Percentage growth = net change ÷ opening headcount × 100. The ending/opening multiple provides another view of scale change.</p><h2>How to use the result</h2><p>Use headcount growth for workforce planning, team expansion reporting or capacity analysis. Pair it with hiring, attrition and productivity metrics because the same net growth can come from very different employee flows.</p><h2>Assumptions and limitations</h2><p>When opening headcount is zero, percentage growth is mathematically undefined; the tool labels a positive closing value as a new base instead of displaying an infinite percentage.</p><h2>Example</h2><p>Growing from 80 to 100 employees is a net increase of 20 and a 25% headcount growth rate.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Why can net growth be misleading?','A company could hire many people and also lose many people while ending with only a small net change.'],['What if opening headcount is zero?','Percentage growth is undefined, so the tool reports a new base rather than an infinite growth percentage.'],['Should contractors be included?','Use the workforce population defined by your reporting policy and keep that scope consistent.'],['Does the tool annualize growth?','No. The result covers whatever period your opening and closing values represent.']];require __DIR__.'/../includes/tool-template.php';
