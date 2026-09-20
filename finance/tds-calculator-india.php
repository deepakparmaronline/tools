<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('finance','tds-calculator-india');ob_start(); ?>
<h2>Estimate a TDS deduction</h2>
<p class="lead">Enter the amount subject to TDS and the rate you have verified for the relevant section and payee.</p>
<div class="form-grid"><div class="field"><label for="amount">Amount subject to TDS</label><input id="amount" type="number" value="50000" step="0.01" min="0"></div><div class="field"><label for="rate">TDS rate (%)</label><input id="rate" type="number" value="10" step="0.01" min="0" max="100"><small>Enter the applicable rate yourself; this calculator does not select a section or threshold.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>TDS to deduct</span><strong id="tds">—</strong></div><div class="metric"><span>Net amount after TDS</span><strong id="net">—</strong></div><div class="metric"><span>Gross taxable amount</span><strong id="gross">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='₹')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const a=num('amount'),r=num('rate');if(a<0||r<0||r>100){note('Enter a non-negative amount and a rate from 0% to 100%.',true);return;}const t=a*r/100;$('tds').textContent=money(t,'₹');$('net').textContent=money(a-t,'₹');$('gross').textContent=money(a,'₹');note('This tool assumes the entire entered amount is subject to TDS at the entered rate.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>TDS amount = taxable payment amount × entered TDS rate. Net payment after TDS = taxable amount − TDS. The calculator deliberately requires you to enter the rate rather than automatically selecting one.</p><h2>How to use the result</h2><p>Use the tool after you have identified the relevant TDS section, threshold, payee status, PAN-related treatment and taxable base through your accounting or tax process. It is useful for checking the arithmetic of a planned deduction.</p><h2>Assumptions and limitations</h2><p>TDS rules can depend on the nature of payment, status of the deductor and payee, thresholds, PAN availability, certificates, surcharge or other provisions. This tool does not determine whether TDS applies or which statutory rate is current.</p><h2>Example</h2><p>If ₹50,000 is subject to TDS at 10%, the arithmetic deduction is ₹5,000 and the net payment is ₹45,000.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this calculator identify the TDS section?','No. You must enter the verified taxable amount and applicable rate.'],['Does it check TDS thresholds?','No. Threshold and applicability checks must be performed separately.'],['Why is the rate editable?','TDS rates differ by payment type and circumstances and can change, so hard-coding one rate could be misleading.'],['Can I use the result for filing?','Use it as an arithmetic check, not as a substitute for tax advice, statutory verification or filing software.']];require __DIR__.'/../includes/tool-template.php';
