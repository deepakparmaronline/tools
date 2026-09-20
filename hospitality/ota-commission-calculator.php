<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','ota-commission-calculator');ob_start(); ?>
<h2>Estimate OTA distribution cost</h2>
<p class="lead">Enter room revenue booked through an OTA, the commission rate and any fixed booking fee.</p>
<div class="form-grid"><div class="field"><label for="revenue">OTA-booked room revenue</label><input id="revenue" type="number" value="500000" step="0.01" min="0"></div><div class="field"><label for="rate">Commission rate (%)</label><input id="rate" type="number" value="18" step="0.01" min="0" max="100"></div><div class="field"><label for="bookings">Bookings</label><input id="bookings" type="number" value="100" step="1" min="0"></div><div class="field"><label for="fixed">Fixed fee per booking</label><input id="fixed" type="number" value="0" step="0.01" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Commission & fixed fees</span><strong id="commission">—</strong></div><div class="metric"><span>Net revenue after entered OTA fees</span><strong id="net">—</strong></div><div class="metric"><span>Effective fee rate</span><strong id="effective">—</strong></div><div class="metric"><span>Average fee per booking</span><strong id="perBooking">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const r=num('revenue'),p=num('rate')/100,b=num('bookings'),f=num('fixed');if([r,b,f].some(v=>v<0)||p<0||p>1){note('Use non-negative values and a commission between 0% and 100%.',true);return;}const fee=r*p+b*f;$('commission').textContent=money(fee,'');$('net').textContent=money(r-fee,'');$('effective').textContent=r>0?pct(fee/r*100):'—';$('perBooking').textContent=b>0?money(fee/b,''):'—';note('Actual settlement can contain taxes, promotions, payment fees and other adjustments not modeled here.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>OTA distribution cost = booked room revenue × commission rate + bookings × fixed fee. Net revenue subtracts the entered fees from booked revenue. The effective fee rate divides total modeled fees by booked revenue.</p><h2>How to use the result</h2><p>Use this to compare channel economics or to reconcile expected commission against settlement statements. Pair it with occupancy and rate data so lower acquisition cost is not evaluated without considering demand contribution.</p><h2>Assumptions and limitations</h2><p>OTA contracts can include taxes on commission, preferred-placement fees, sponsored visibility, member discounts, cancellation rules, payment processing and market-specific terms. Enter only the fees you intend to model.</p><h2>Example</h2><p>Fixed fees matter more when average booking value is low, while percentage commission scales directly with booked revenue.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this include OTA advertising fees?','Only if you include them through an appropriate fixed fee or model them separately.'],['What is effective fee rate?','It is total modeled OTA fees divided by OTA-booked room revenue.'],['Should cancelled bookings be included?','Use the revenue and bookings that are commissionable under your actual agreement and reporting basis.'],['Can I compare direct versus OTA bookings?','Yes, but direct bookings also have acquisition, payment and loyalty costs that should be included for a fair comparison.']];require __DIR__.'/../includes/tool-template.php';
