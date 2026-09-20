<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','leave-encashment-calculator');ob_start(); ?>
<h2>Estimate leave encashment</h2>
<p class="lead">Enter the salary base, eligible unused leave days and the divisor used by your policy or rule.</p>
<div class="form-grid"><div class="field"><label for="salary">Eligible monthly salary base</label><input id="salary" type="number" value="60000" step="0.01" min="0"></div><div class="field"><label for="days">Leave days to encash</label><input id="days" type="number" value="10" step="0.01" min="0"></div><div class="field"><label for="divisor">Salary-day divisor</label><input id="divisor" type="number" value="30" step="0.01" min="0.0001"><small>Enter the divisor specified by your policy, contract or applicable rule.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Daily eligible salary</span><strong id="daily">—</strong></div><div class="metric"><span>Estimated leave encashment</span><strong id="encash">—</strong></div><div class="metric"><span>Leave days</span><strong id="daysOut">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('salary'),d=num('days'),v=num('divisor');if(s<0||d<0||v<=0){note('Salary and leave days cannot be negative, and divisor must be positive.',true);return;}const daily=s/v;$('daily').textContent=money(daily,'');$('encash').textContent=money(daily*d,'');$('daysOut').textContent=dec(d,2);note('Eligibility, salary components, tax treatment and divisor are policy/legal questions outside this arithmetic estimate.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Daily eligible salary = eligible monthly salary base ÷ entered divisor. Estimated leave encashment = daily eligible salary × eligible unused leave days.</p><h2>How to use the result</h2><p>Use the exact salary components and divisor specified by the employer policy, employment contract or applicable law. The editable divisor allows the tool to model different approaches without embedding a universal assumption.</p><h2>Assumptions and limitations</h2><p>Leave types, maximum accumulation, encashment eligibility, tax treatment, salary base and divisor can differ by employer and jurisdiction. The calculator does not determine whether leave must or may be encashed.</p><h2>Example</h2><p>If the eligible salary base is 60,000, divisor is 30 and 10 days are eligible, the arithmetic estimate is 20,000.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Why is the salary divisor editable?','Policies and rules can use different day bases, so the calculator should not assume one universal divisor.'],['Does this decide which leave types are encashable?','No. Enter only the leave days that your policy or applicable rule treats as eligible.'],['Does it calculate tax on leave encashment?','No. Tax treatment must be handled separately.'],['Can I use basic salary instead of gross salary?','Use whichever salary components your applicable policy or rule specifies; the tool does not choose them.']];require __DIR__.'/../includes/tool-template.php';
