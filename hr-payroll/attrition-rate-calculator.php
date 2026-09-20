<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','attrition-rate-calculator');ob_start(); ?>
<h2>Calculate workforce attrition</h2>
<p class="lead">Enter opening headcount, closing headcount and departures for the same reporting period.</p>
<div class="form-grid"><div class="field"><label for="start">Opening headcount</label><input id="start" type="number" value="100" step="1" min="0"></div><div class="field"><label for="end">Closing headcount</label><input id="end" type="number" value="95" step="1" min="0"></div><div class="field"><label for="departures">Employee departures</label><input id="departures" type="number" value="12" step="1" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Average headcount</span><strong id="avg">—</strong></div><div class="metric"><span>Attrition rate</span><strong id="rate">—</strong></div><div class="metric"><span>Approx. non-departure share</span><strong id="retained">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('start'),e=num('end'),d=num('departures');if([s,e,d].some(v=>v<0)){note('Headcount and departures cannot be negative.',true);return;}const avg=(s+e)/2;$('avg').textContent=dec(avg,1);$('rate').textContent=avg>0?pct(d/avg*100):'—';$('retained').textContent=avg>0?pct(Math.max(0,1-d/avg)*100):'—';note('This uses average opening/closing headcount as the denominator. Keep the method consistent across periods.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Attrition rate = employee departures ÷ average headcount × 100, where average headcount is (opening headcount + closing headcount) ÷ 2. This is a common period-level approximation when daily or monthly average headcount is not available.</p><h2>How to use the result</h2><p>Use the metric to compare teams or periods only when departure definitions are consistent. You may also separate voluntary and involuntary departures to understand what is driving the headline rate.</p><h2>Assumptions and limitations</h2><p>Different organizations use different denominators and may annualize rates. This calculator does not annualize automatically and does not distinguish resignation, termination, retirement or internal transfer unless you choose which departures to include.</p><h2>Example</h2><p>If opening headcount is 100, closing is 95 and there are 12 departures, average headcount is 97.5 and period attrition is about 12.31%.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Should I include involuntary departures?','That depends on your reporting definition. Use a consistent inclusion policy and consider reporting voluntary attrition separately.'],['Does the tool annualize monthly attrition?','No. It reports the rate for the data period you enter.'],['Why use average headcount?','Average headcount better represents the workforce exposed to attrition during the period than using only the opening or closing count.'],['Can I compare departments?','Yes, if each department uses the same time period and departure/headcount definitions.']];require __DIR__.'/../includes/tool-template.php';
