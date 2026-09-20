<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','compa-ratio-calculator');ob_start(); ?>
<h2>Calculate compa-ratio</h2>
<p class="lead">Compare current base salary with the midpoint of the relevant pay range.</p>
<div class="form-grid"><div class="field"><label for="salary">Employee base salary</label><input id="salary" type="number" value="800000" step="0.01" min="0"></div><div class="field"><label for="midpoint">Salary range midpoint</label><input id="midpoint" type="number" value="900000" step="0.01" min="0.01"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Compa-ratio</span><strong id="ratio">—</strong></div><div class="metric"><span>Midpoint percentage</span><strong id="percent">—</strong></div><div class="metric"><span>Salary minus midpoint</span><strong id="gap">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('salary'),m=num('midpoint');if(s<0||m<=0){note('Salary cannot be negative and midpoint must be greater than zero.',true);return;}const r=s/m;$('ratio').textContent=dec(r,3);$('percent').textContent=pct(r*100);$('gap').textContent=money(s-m,'');note(r<1?'Salary is below the entered midpoint.':r>1?'Salary is above the entered midpoint.':'Salary equals the entered midpoint.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Compa-ratio = employee base salary ÷ salary-range midpoint. A ratio of 1.00 means salary equals the midpoint; 0.90 means salary is 90% of midpoint; 1.10 means 110% of midpoint.</p><h2>How to use the result</h2><p>Use compa-ratio as one compensation diagnostic alongside job level, experience, performance, internal equity, location and market data. It can help show where salaries sit within a structured pay framework.</p><h2>Assumptions and limitations</h2><p>A compa-ratio is not a performance score and does not by itself determine whether pay is fair or should change. Range design and midpoint quality matter, and total compensation may differ from base salary.</p><h2>Example</h2><p>An 800,000 salary against a 900,000 midpoint has a compa-ratio of about 0.889, or 88.89%.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What does a compa-ratio of 1.0 mean?','The employee\'s entered salary is exactly equal to the entered range midpoint.'],['Is a compa-ratio below 1.0 automatically underpaid?','No. Salary position can reflect experience, tenure, performance and range design; the ratio is one data point.'],['Should I use base salary or CTC?','Compa-ratio is commonly based on base salary against a base-salary range midpoint. Use matching pay definitions.'],['Can compa-ratio be above 1?','Yes. It means salary is above the midpoint, provided the midpoint and salary use the same basis.']];require __DIR__.'/../includes/tool-template.php';
