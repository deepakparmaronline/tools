<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('small-business','late-payment-interest-calculator');ob_start(); ?>
<h2>Estimate late-payment interest</h2>
<p class="lead">Enter the overdue amount, permitted annual interest rate, days overdue and calculation method.</p>
<div class="form-grid"><div class="field"><label for="principal">Overdue principal</label><input id="principal" type="number" value="100000" step="0.01" min="0"></div><div class="field"><label for="rate">Annual interest rate (%)</label><input id="rate" type="number" value="18" step="0.01" min="0"></div><div class="field"><label for="days">Days overdue</label><input id="days" type="number" value="45" step="1" min="0"></div><div class="field"><label for="method">Interest method</label><select id="method"><option value="simple" selected>Simple daily interest</option><option value="compound">Daily compounding</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Calculated interest</span><strong id="interest">—</strong></div><div class="metric"><span>Principal + interest</span><strong id="total">—</strong></div><div class="metric"><span>Approx. first-day interest</span><strong id="daily">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const p=num('principal'),r=num('rate')/100,d=num('days'),m=$('method').value;if([p,r,d].some(v=>v<0)){note('Principal, rate and days cannot be negative.',true);return;}const daily=r/365,interest=m==='compound'?p*(Math.pow(1+daily,d)-1):p*daily*d;$('interest').textContent=money(interest,'');$('total').textContent=money(p+interest,'');$('daily').textContent=money(p*daily,'');note('Use only an interest rate and compounding method that your contract and applicable law permit.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Simple daily interest = principal × annual rate ÷ 365 × days overdue. Daily compounded interest = principal × ((1 + annual rate ÷ 365)^days − 1).</p><h2>How to use the result</h2><p>Use this as an arithmetic aid after confirming the contractual due date, permitted interest rate and whether simple or compounded interest is allowed. Keep an audit trail of the underlying invoice and payment terms.</p><h2>Assumptions and limitations</h2><p>Late-payment rights, statutory interest, grace periods, compounding, tax treatment and enforceability vary by contract and jurisdiction. The tool does not determine what rate is lawful or recoverable.</p><h2>Example</h2><p>With 100,000 overdue for 45 days at an entered 18% annual simple rate, interest is approximately 2,219.18 using a 365-day year.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this tell me the legal late-payment rate?','No. Enter a rate that you have verified under the contract and applicable law.'],['What is the difference between simple and compounded interest?','Simple interest applies the rate to principal only; compounding adds accrued interest to the balance each day in this model.'],['Why use 365 days?','This calculator uses a 365-day year for daily rate conversion. If your contract specifies another day-count convention, calculate accordingly.'],['Does it include collection fees?','No. Add any separately permitted fees outside this interest calculation.']];require __DIR__.'/../includes/tool-template.php';
