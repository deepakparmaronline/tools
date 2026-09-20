<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hr-payroll','time-to-fill-calculator');ob_start(); ?>
<h2>Calculate time-to-fill</h2>
<p class="lead">Choose the requisition start date and the date the role was filled.</p>
<div class="form-grid"><div class="field"><label for="start">Requisition approved / opened</label><input id="start" type="date" value="2026-08-01"></div><div class="field"><label for="end">Role filled / offer accepted</label><input id="end" type="date" value="2026-08-31"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Calendar days to fill</span><strong id="days">—</strong></div><div class="metric"><span>Weeks</span><strong id="weeks">—</strong></div><div class="metric"><span>Date check</span><strong id="status">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=$('start').value,e=$('end').value;if(!s||!e){$('days').textContent=$('weeks').textContent='—';$('status').textContent='Missing date';note('Choose both dates.',true);return;}const a=new Date(s+'T00:00:00'),b=new Date(e+'T00:00:00'),diff=Math.round((b-a)/86400000);$('days').textContent=diff>=0?diff:'—';$('weeks').textContent=diff>=0?dec(diff/7,2):'—';$('status').textContent=diff>=0?'Valid range':'End before start';note(diff>=0?'Calendar-day difference is shown.':'The fill date must not be earlier than the requisition date.',diff<0);}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>This calculator measures the calendar-day difference between the requisition start date and the date you define as filled, such as accepted offer date. Weeks are shown as calendar days divided by seven.</p><h2>How to use the result</h2><p>Document the start and end event your organization uses. Some teams begin at requisition approval, others at posting date; some end at accepted offer, others at start date. Consistency is more important than the label.</p><h2>Assumptions and limitations</h2><p>The tool counts calendar-day difference and does not exclude weekends, holidays, hiring freezes or candidate notice periods. It also does not average across multiple roles; calculate each role or aggregate separately.</p><h2>Example</h2><p>An opening date of August 1 and fill date of August 31 has a 30-calendar-day difference.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Is time-to-fill the same as time-to-hire?','Not always. Time-to-fill is commonly tied to the requisition lifecycle, while time-to-hire can focus on the candidate\'s journey. Definitions vary.'],['Does the calculator exclude weekends?','No. It calculates calendar-day difference.'],['Which date should count as filled?','Use the event defined by your organization, such as offer acceptance, and apply it consistently.'],['Can I use it for multiple roles?','Calculate each role separately, then average or summarize those results using your reporting method.']];require __DIR__.'/../includes/tool-template.php';
