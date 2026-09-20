<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('government-ngos','donor-retention-calculator');
ob_start();
?>
<h2>Calculate donor retention</h2><p class="lead">Measure how many prior-period donors gave again and separate retention from new-donor acquisition.</p>
<div class="form-grid"><div class="field"><label for="begin">Donors in prior period</label><input id="begin" type="number" min="0" step="1" value="1000"></div><div class="field"><label for="retained">Prior donors who gave again</label><input id="retained" type="number" min="0" step="1" value="620"></div><div class="field"><label for="newdonors">New donors this period</label><input id="newdonors" type="number" min="0" step="1" value="300"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate retention</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Donor retention</span><strong id="ret">—</strong></div><div class="metric"><span>Lapse rate</span><strong id="lapse">—</strong></div><div class="metric"><span>Current donor count</span><strong id="current">—</strong></div><div class="metric"><span>New-donor share</span><strong id="newshare">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const b=n('begin'),r=n('retained'),nw=n('newdonors');if(![b,r,nw].every(Number.isFinite)||b<=0||r<0||r>b||nw<0){$('note').textContent='Enter a positive prior donor count; retained donors cannot exceed the prior count.';$('note').className='helper danger';return;}const current=r+nw;$('ret').textContent=(r/b*100).toFixed(1)+'%';$('lapse').textContent=((b-r)/b*100).toFixed(1)+'%';$('current').textContent=current.toLocaleString();$('newshare').textContent=(current?nw/current*100:0).toFixed(1)+'%';$('note').textContent='Retention should compare the same donor population and time window. Decide how you treat households, recurring gifts, anonymous donors and reactivated donors before reporting.';$('note').className='helper';}
['begin','retained','newdonors'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('begin').value=1000;$('retained').value=620;$('newdonors').value=300;go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Donor retention formula</h2><p>Donor retention rate = retained prior-period donors ÷ prior-period donors × 100. A retained donor is someone in the starting donor cohort who gives again in the comparison period.</p>
<h2>Retention is different from overall donor growth</h2><p>An organization can grow its total donor count while still having weak retention if acquisition is replacing many lapsed donors. Looking at retention and new-donor share together makes that dynamic visible.</p>
<h2>Define the donor cohort consistently</h2><p>Annual retention should compare like-for-like annual periods. Recurring donors, household records, merged duplicates and reactivated donors need consistent database rules or the reported rate will shift because of data handling rather than donor behavior.</p>
<h2>Use segments for better decisions</h2><p>Overall retention can hide large differences between first-time donors, recurring donors, major donors and event-acquired donors. Calculate the same metric by meaningful segment after validating your total.</p>
<h2>Define the donor cohort before benchmarking retention</h2><p>Retention can change dramatically depending on whether the denominator includes first-time donors, recurring donors, major gifts, institutional funders or people who gave through a one-off emergency appeal. Use the same donor identity rules and time window from period to period. Segmenting new-donor retention from repeat-donor retention often reveals more actionable fundraising behavior than one blended percentage, especially after a campaign that attracts many first-time supporters.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is donor retention rate?','The percentage of donors from the prior period who donated again in the current comparison period.'],['What is donor lapse rate?','One minus the retention rate: prior-period donors who did not donate again divided by the prior donor count.'],['Do new donors belong in the retention-rate denominator?','No. Retention follows the starting donor cohort. New donors are shown separately in this calculator.'],['Can donor count grow even when retention falls?','Yes. Strong acquisition can offset lapsed donors, which is why retention and new-donor share should be examined separately.']];
require __DIR__.'/../includes/tool-template.php';
