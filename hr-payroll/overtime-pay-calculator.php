<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','overtime-pay-calculator');ob_start(); ?>
<h2>Estimate overtime pay</h2>
<p class="lead">Enter the eligible hourly rate, overtime hours and multiplier that applies to the situation.</p>
<div class="form-grid"><div class="field"><label for="rate">Eligible hourly pay rate</label><input id="rate" type="number" value="300" step="0.01" min="0"></div><div class="field"><label for="hours">Overtime hours</label><input id="hours" type="number" value="10" step="0.01" min="0"></div><div class="field"><label for="multiplier">Overtime multiplier</label><input id="multiplier" type="number" value="2" step="0.01" min="0"><small>Examples may be 1.5× or 2×, but use the verified rule that applies.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Overtime hourly rate</span><strong id="otRate">—</strong></div><div class="metric"><span>Overtime pay</span><strong id="otPay">—</strong></div><div class="metric"><span>Overtime hours</span><strong id="hoursOut">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const r=num('rate'),h=num('hours'),m=num('multiplier');if([r,h,m].some(v=>v<0)){note('Rate, hours and multiplier cannot be negative.',true);return;}const or=r*m;$('otRate').textContent=money(or,'');$('otPay').textContent=money(or*h,'');$('hoursOut').textContent=dec(h,2);note('This calculator does not determine overtime eligibility, wage base or the legally required multiplier.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Overtime hourly rate = eligible hourly rate × overtime multiplier. Overtime pay = overtime hourly rate × overtime hours.</p><h2>How to use the result</h2><p>Use the rate and multiplier determined by the applicable employment rules, award, contract or company policy. Keeping the multiplier editable avoids assuming one legal standard applies to every employee.</p><h2>Assumptions and limitations</h2><p>Overtime eligibility, calculation base, exclusions, weekly/daily thresholds and multiplier rules vary by jurisdiction and worker classification. This tool performs arithmetic only and does not determine legal entitlement.</p><h2>Example</h2><p>At a 300 eligible hourly rate with a 2× multiplier, 10 overtime hours produce an arithmetic overtime amount of 6,000.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this calculator decide whether an employee is eligible for overtime?','No. Eligibility and the applicable rules must be determined separately.'],['Can I use a 1.5× multiplier?','Yes. Enter any verified multiplier applicable to your calculation.'],['Does the rate include allowances?','Enter the hourly wage base that your applicable rule or payroll policy requires.'],['Does it calculate regular salary too?','No. It calculates the overtime component from the inputs provided.']];require __DIR__.'/../includes/tool-template.php';
