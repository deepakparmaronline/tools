<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','salary-hike-calculator');ob_start(); ?>
<h2>Calculate a salary hike</h2>
<p class="lead">Enter current salary and either a proposed hike percentage or directly compare with a new salary.</p>
<div class="form-grid"><div class="field"><label for="current">Current annual salary</label><input id="current" type="number" value="800000" step="0.01" min="0"></div><div class="field"><label for="hike">Proposed hike (%)</label><input id="hike" type="number" value="15" step="0.01"></div><div class="field"><label for="newSalary">Optional new annual salary for reverse calculation</label><input id="newSalary" type="number" step="0.01" placeholder="Leave blank to use proposed hike"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Revised salary</span><strong id="revised">—</strong></div><div class="metric"><span>Annual increase</span><strong id="increase">—</strong></div><div class="metric"><span>Approx. monthly increase</span><strong id="monthly">—</strong></div><div class="metric"><span>Hike percentage</span><strong id="actualPct">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const c=num('current'),h=num('hike'),raw=$('newSalary').value.trim(),has=raw!==''&&Number.isFinite(parseFloat(raw)),n=has?parseFloat(raw):c*(1+h/100);if(c<0||!Number.isFinite(n)){note('Enter valid salary values.',true);return;}const inc=n-c;$('revised').textContent=money(n,'');$('increase').textContent=money(inc,'');$('monthly').textContent=money(inc/12,'');$('actualPct').textContent=c>0?pct(inc/c*100):'—';note(has?'Hike percentage is reverse-calculated from the optional new salary.':'Revised salary is calculated from the proposed hike percentage.');} $('newSalary').addEventListener('input',go);
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>When no new salary is entered, revised salary = current salary × (1 + hike percentage). If a new salary is supplied, the tool reverse-calculates hike percentage as (new − current) ÷ current × 100.</p><h2>How to use the result</h2><p>Use matching compensation definitions when comparing old and new amounts. For example, compare annual base salary with annual base salary rather than comparing base salary to total CTC.</p><h2>Assumptions and limitations</h2><p>The calculator does not model tax, bonus, employer contributions or take-home pay. A percentage increase in gross salary does not necessarily produce the same percentage increase in net pay.</p><h2>Example</h2><p>Moving from 800,000 to a 15% higher salary produces 920,000, an annual increase of 120,000.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Can I calculate the hike percentage from a new salary?','Yes. Enter the optional new annual salary and the tool will reverse-calculate the percentage increase.'],['Should I use CTC or base salary?','Either can be compared, but both current and new amounts must use the same compensation definition.'],['Does the monthly increase equal extra take-home?','No. It is the annual gross difference divided by 12 and does not account for tax or deductions.'],['Can the hike be negative?','Yes. A negative percentage models a salary reduction.']];require __DIR__.'/../includes/tool-template.php';
