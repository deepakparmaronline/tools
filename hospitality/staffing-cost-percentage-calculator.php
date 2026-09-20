<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','staffing-cost-percentage-calculator');ob_start(); ?>
<h2>Measure staffing cost percentage</h2>
<p class="lead">Enter total comparable staffing cost and operating revenue for the same period.</p>
<div class="form-grid"><div class="field"><label for="staff">Staffing / labor cost</label><input id="staff" type="number" value="450000" step="0.01" min="0"></div><div class="field"><label for="revenue">Operating revenue</label><input id="revenue" type="number" value="1500000" step="0.01" min="0"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Staffing cost %</span><strong id="pct">—</strong></div><div class="metric"><span>Revenue after staffing cost</span><strong id="after">—</strong></div><div class="metric"><span>Revenue per 1 of staffing cost</span><strong id="ratio">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=num('staff'),r=num('revenue');if(s<0||r<0){note('Cost and revenue cannot be negative.',true);return;}$('pct').textContent=r>0?pct(s/r*100):'—';$('after').textContent=money(r-s,'');$('ratio').textContent=s>0?dec(r/s,2)+'×':'—';note('Define staffing cost consistently: wages only, or fully loaded labor including benefits and payroll costs.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Staffing cost percentage = staffing cost ÷ operating revenue × 100. The additional ratio shows how many rupees of revenue are generated per currency unit of entered staffing cost.</p><h2>How to use the result</h2><p>Use the metric by department, outlet or period, and pair it with service quality, occupancy/covers and productivity measures. A lower percentage is not automatically better if understaffing damages revenue or guest experience.</p><h2>Assumptions and limitations</h2><p>Decide whether staffing cost includes wages, overtime, benefits, payroll taxes, contractors, meals or agency staff, then use the same definition for comparisons. Revenue mix and seasonality can materially change the percentage.</p><h2>Example</h2><p>If staffing cost is 450,000 and comparable revenue is 1.5 million, staffing cost percentage is 30%.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Should benefits be included in staffing cost?','Use a fully loaded labor definition if that is how your operation manages labor, and keep the definition consistent.'],['Can the percentage exceed 100%?','Yes, if staffing cost is greater than revenue for the measured period.'],['Is lower staffing cost percentage always better?','No. The metric should be balanced against service, revenue, workload and guest satisfaction.'],['Can I use this for one restaurant outlet?','Yes, if both staffing cost and revenue refer to that same outlet and period.']];require __DIR__.'/../includes/tool-template.php';
