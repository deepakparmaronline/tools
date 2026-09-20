<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','table-turnover-calculator');ob_start(); ?>
<h2>Measure table turnover</h2>
<p class="lead">Enter the number of parties seated and tables available during the same service period.</p>
<div class="form-grid"><div class="field"><label for="parties">Parties / table seatings</label><input id="parties" type="number" value="120" step="1" min="0"></div><div class="field"><label for="tables">Tables available</label><input id="tables" type="number" value="40" step="1" min="1"></div><div class="field"><label for="hours">Service period hours</label><input id="hours" type="number" value="4" step="0.01" min="0.01"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Table turns per service</span><strong id="turns">—</strong></div><div class="metric"><span>Turns per table per hour</span><strong id="turnsHour">—</strong></div><div class="metric"><span>Average minutes per turn (implied)</span><strong id="minutes">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const p=num('parties'),t=num('tables'),h=num('hours');if(p<0||t<=0||h<=0){note('Parties cannot be negative and tables/hours must be positive.',true);return;}const turns=p/t,ph=turns/h,mins=turns>0?h*60/turns:NaN;$('turns').textContent=dec(turns,2);$('turnsHour').textContent=dec(ph,3);$('minutes').textContent=Number.isFinite(mins)?dec(mins,1)+' min':'—';note('The implied minutes figure is an aggregate pacing estimate, not actual guest dining time.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Table turnover = parties seated ÷ tables available during the service period. Turns per table per hour further divides turnover by service hours. The implied time per turn is service minutes ÷ turns per table.</p><h2>How to use the result</h2><p>Use turnover with average check and capacity data to understand revenue throughput. Faster turns can improve capacity utilization, but guest experience, cuisine style, reservations and party size influence what is realistic.</p><h2>Assumptions and limitations</h2><p>The calculation treats all tables as equivalent and does not account for table size, combined tables, partial closures, no-shows or uneven seating demand. The implied minutes are a high-level pacing metric, not measured dining duration.</p><h2>Example</h2><p>If 120 parties are seated across 40 tables, the restaurant achieves 3 table turns during that service period.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What counts as one table turn?','One turn generally means a table is used by one party and then becomes available for another party.'],['Is table turnover the same as seat turnover?','No. Table turnover uses tables; seat turnover uses seats or covers and can behave differently with party size.'],['Should unused tables count?','Use tables that were genuinely available for sale during the measured period.'],['Is a higher turnover always better?','Not necessarily. It must be balanced with guest experience, average check and concept expectations.']];require __DIR__.'/../includes/tool-template.php';
