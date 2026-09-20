<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','hotel-goppar-calculator');ob_start(); ?>
<h2>Calculate hotel GOPPAR</h2>
<p class="lead">Enter gross operating profit, rooms available per day and the number of days in the reporting period.</p>
<div class="form-grid"><div class="field"><label for="gop">Gross operating profit (GOP)</label><input id="gop" type="number" value="2500000" step="0.01"></div><div class="field"><label for="rooms">Available rooms per day</label><input id="rooms" type="number" value="120" step="1" min="1"></div><div class="field"><label for="days">Days in period</label><input id="days" type="number" value="30" step="1" min="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Available room nights</span><strong id="avail">—</strong></div><div class="metric"><span>GOPPAR</span><strong id="goppar">—</strong></div><div class="metric"><span>GOP</span><strong id="gop">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const g=num('gop'),r=num('rooms'),d=num('days');if(r<=0||d<=0){note('Available rooms and days must both be greater than zero.',true);return;}const a=r*d;$('avail').textContent=dec(a,0);$('goppar').textContent=money(g/a,'');$('gop').textContent=money(g,'');note('GOPPAR uses available room nights, whether or not they were sold.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>GOPPAR = gross operating profit ÷ available room nights. Available room nights are the number of sellable rooms multiplied by days in the reporting period.</p><h2>How to use the result</h2><p>Because it combines revenue and operating cost performance, GOPPAR can complement occupancy, ADR and RevPAR. Compare hotels or periods only when the definition of GOP and available inventory is consistent.</p><h2>Assumptions and limitations</h2><p>Property accounting practices can differ in what is included in gross operating profit. Out-of-order rooms may also be treated differently in inventory reporting. Use the same internal definition when comparing trends.</p><h2>Example</h2><p>A 120-room hotel over 30 days has 3,600 available room nights. 2.5 million of GOP produces GOPPAR of about 694.44.</p>
<?php $toolContent=ob_get_clean();$faqs=[['How is GOPPAR different from RevPAR?','RevPAR measures room revenue per available room; GOPPAR uses gross operating profit and therefore reflects operating costs as well.'],['Do unsold rooms count?','Yes. GOPPAR divides by available room nights, not occupied room nights.'],['Should closed or out-of-order rooms be included?','Follow the inventory definition used by your hotel reporting system and keep it consistent.'],['Can GOP be negative?','Yes. If gross operating profit is negative, GOPPAR will also be negative.']];require __DIR__.'/../includes/tool-template.php';
