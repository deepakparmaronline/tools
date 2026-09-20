<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','revpar-adr-occupancy-calculator');ob_start(); ?>
<h2>Calculate three core hotel room metrics</h2>
<p class="lead">Enter room revenue, rooms sold and available room nights for the same reporting period.</p>
<div class="form-grid"><div class="field"><label for="revenue">Room revenue</label><input id="revenue" type="number" value="1800000" step="0.01" min="0"></div><div class="field"><label for="sold">Room nights sold</label><input id="sold" type="number" value="1800" step="1" min="0"></div><div class="field"><label for="available">Available room nights</label><input id="available" type="number" value="2400" step="1" min="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>ADR</span><strong id="adr">—</strong></div><div class="metric"><span>Occupancy</span><strong id="occupancy">—</strong></div><div class="metric"><span>RevPAR</span><strong id="revpar">—</strong></div><div class="metric"><span>Unsold available room nights</span><strong id="unsold">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const r=num('revenue'),s=num('sold'),a=num('available');if(r<0||s<0||a<=0||s>a){note('Revenue cannot be negative, available nights must be positive, and sold nights cannot exceed available nights.',true);return;}$('adr').textContent=s>0?money(r/s,''):'—';$('occupancy').textContent=pct(s/a*100);$('revpar').textContent=money(r/a,'');$('unsold').textContent=dec(a-s,0);note('RevPAR also equals ADR × occupancy rate when both use the same room-revenue basis.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>ADR = room revenue ÷ rooms sold. Occupancy = rooms sold ÷ available room nights × 100. RevPAR = room revenue ÷ available room nights. Mathematically, RevPAR also equals ADR × occupancy as a decimal.</p><h2>How to use the result</h2><p>Review the three metrics together. ADR shows achieved rate on sold rooms, occupancy shows inventory utilization, and RevPAR combines both without accounting for operating cost.</p><h2>Assumptions and limitations</h2><p>Use comparable definitions for room revenue and available inventory. Taxes, resort fees, packages, complimentary rooms, out-of-order rooms and cancellations can be treated differently across systems.</p><h2>Example</h2><p>If room revenue is 1.8 million from 1,800 sold room nights out of 2,400 available, ADR is 1,000, occupancy 75%, and RevPAR 750.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Can RevPAR increase if occupancy falls?','Yes, if ADR rises enough to offset lower occupancy.'],['Does RevPAR include hotel operating costs?','No. It is a room-revenue productivity metric, not a profit metric.'],['What if no rooms were sold?','ADR is undefined when rooms sold are zero, while occupancy and RevPAR can still be calculated.'],['Should unavailable rooms be counted?','Use the inventory definition your hotel reporting system uses and keep it consistent across periods.']];require __DIR__.'/../includes/tool-template.php';
