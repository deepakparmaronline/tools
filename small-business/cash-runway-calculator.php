<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('small-business','cash-runway-calculator');ob_start(); ?>
<h2>Estimate cash runway</h2>
<p class="lead">Enter current cash plus average monthly cash inflows and outflows.</p>
<div class="form-grid"><div class="field"><label for="cash">Current cash balance</label><input id="cash" type="number" value="1200000" step="0.01" min="0"></div><div class="field"><label for="outflow">Average monthly cash outflow</label><input id="outflow" type="number" value="400000" step="0.01" min="0"></div><div class="field"><label for="inflow">Average monthly cash inflow</label><input id="inflow" type="number" value="250000" step="0.01" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Monthly net burn</span><strong id="burn">—</strong></div><div class="metric"><span>Estimated runway</span><strong id="months">—</strong></div><div class="metric"><span>Runway interpretation</span><strong id="dateNote">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const c=num('cash'),o=num('outflow'),i=num('inflow');if([c,o,i].some(v=>v<0)){note('Cash, inflow and outflow cannot be negative.',true);return;}const burn=o-i;$('burn').textContent=burn>0?money(burn,''):money(0,'');if(burn>0){$('months').textContent=dec(c/burn,2)+' months';$('dateNote').textContent='Cash declines at current average burn';note('Runway assumes monthly inflows and outflows remain constant.');}else{$('months').textContent='No finite burn runway';$('dateNote').textContent=burn===0?'Cash is flat under these averages':'Average inflow exceeds outflow';note('There is no positive net burn under the entered monthly averages.');}}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Monthly net burn = average monthly cash outflow − average monthly cash inflow. When net burn is positive, cash runway = current cash ÷ monthly net burn.</p><h2>How to use the result</h2><p>Use runway for scenario planning rather than as a fixed deadline. Model conservative, expected and growth scenarios because revenue collections, hiring, taxes and one-time payments can change cash movement quickly.</p><h2>Assumptions and limitations</h2><p>The calculation assumes constant monthly averages and ignores timing within each month, restricted cash, debt facilities, minimum cash buffers and one-time receipts or expenses. If inflow equals or exceeds outflow, there is no finite runway under this simple model.</p><h2>Example</h2><p>With 12 lakh cash, 4 lakh monthly outflow and 2.5 lakh inflow, net burn is 1.5 lakh and estimated runway is eight months.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What if monthly inflow is higher than outflow?','The model shows no finite burn runway because cash is not declining under the entered averages.'],['Should accounts receivable count as cash?','No. Use cash that is actually available; future receivables belong in inflow assumptions when expected to be collected.'],['Does runway include a safety buffer?','No. If you need a minimum cash reserve, subtract it from the usable cash balance before calculating.'],['Why should I run scenarios?','Small changes in hiring, collections or large expenses can materially change runway, so one average case can be misleading.']];require __DIR__.'/../includes/tool-template.php';
