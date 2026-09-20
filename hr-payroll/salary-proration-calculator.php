<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','salary-proration-calculator');ob_start(); ?>
<h2>Prorate monthly salary</h2>
<p class="lead">Enter monthly eligible salary, payable days and the divisor used by your payroll policy.</p>
<div class="form-grid"><div class="field"><label for="salary">Monthly eligible salary</label><input id="salary" type="number" value="60000" step="0.01" min="0"></div><div class="field"><label for="allowance">Monthly eligible fixed allowance</label><input id="allowance" type="number" value="0" step="0.01" min="0"></div><div class="field"><label for="payable">Payable days</label><input id="payable" type="number" value="20" step="0.01" min="0"></div><div class="field"><label for="divisor">Payroll day divisor</label><input id="divisor" type="number" value="30" step="0.01" min="0.0001"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Daily prorated rate</span><strong id="daily">—</strong></div><div class="metric"><span>Prorated gross amount</span><strong id="pay">—</strong></div><div class="metric"><span>Amount not earned vs full eligible month</span><strong id="unpaid">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('salary'),a=num('allowance'),p=num('payable'),d=num('divisor');if([s,a,p].some(v=>v<0)||d<=0){note('Amounts/days cannot be negative and divisor must be positive.',true);return;}const full=s+a,daily=full/d,pay=daily*p;$('daily').textContent=money(daily,'');$('pay').textContent=money(pay,'');$('unpaid').textContent=money(full-pay,'');note(p>d?'Payable days exceed the entered divisor; confirm whether that is intentional.':'Use the divisor and eligible salary components defined by your payroll process.',p>d);}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Eligible monthly pay = monthly salary + entered eligible allowance. Daily prorated rate = eligible monthly pay ÷ payroll divisor. Prorated gross amount = daily rate × payable days.</p><h2>How to use the result</h2><p>Use the day-count convention actually used by payroll, such as calendar days or another policy basis. The editable divisor makes the calculation visible rather than assuming every employer uses 30 days.</p><h2>Assumptions and limitations</h2><p>Proration can differ for joiners, leavers, unpaid leave, different months and salary components. Statutory deductions, tax and benefits are not calculated here.</p><h2>Example</h2><p>If eligible monthly pay is 60,000, the divisor is 30 and 20 days are payable, prorated gross pay is 40,000.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Why is the payroll divisor editable?','Employers can use different proration methods, so you should enter the divisor used by the applicable policy or payroll system.'],['Should allowances be prorated?','Only include allowances that are eligible for the same proration method.'],['Does the result include PF, ESI or tax?','No. It estimates prorated gross pay before separate payroll deductions.'],['Can payable days exceed the divisor?','The tool allows it but flags the situation because it may indicate a mismatch in day-count conventions.']];require __DIR__.'/../includes/tool-template.php';
