<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('government-ngos','project-milestone-date-calculator');
ob_start();
?>
<h2>Calculate a project milestone date</h2><p class="lead">Add calendar days or business days to a start date and optionally exclude listed holidays.</p>
<div class="form-grid"><div class="field"><label for="start">Start date</label><input id="start" type="date" value="2026-09-18"></div><div class="field"><label for="duration">Duration (days)</label><input id="duration" type="number" min="0" step="1" value="30"></div><div class="field"><label for="mode">Day type</label><select id="mode"><option value="calendar">Calendar days</option><option value="business" selected>Business days (Mon–Fri)</option></select></div><div class="field full"><label for="holidays">Excluded holidays for business-day mode</label><textarea id="holidays" placeholder="YYYY-MM-DD, one per line"></textarea></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate milestone</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Milestone date</span><strong id="date">—</strong></div><div class="metric"><span>Calendar days elapsed</span><strong id="elapsed">—</strong></div><div class="metric"><span>Excluded days</span><strong id="excluded">—</strong></div></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),day=86400000;function iso(d){return d.toISOString().slice(0,10)}function go(){const st=new Date($('start').value+'T00:00:00Z'),dur=parseInt($('duration').value,10),mode=$('mode').value;if(!Number.isFinite(st.getTime())||!Number.isInteger(dur)||dur<0)return;const holidays=new Set($('holidays').value.split(/\s+/).filter(x=>/^\d{4}-\d{2}-\d{2}$/.test(x)));let d=new Date(st),count=0,excluded=0;if(mode==='calendar')d=new Date(st.getTime()+dur*day);else while(count<dur){d=new Date(d.getTime()+day);const wd=d.getUTCDay(),off=wd===0||wd===6||holidays.has(iso(d));if(off)excluded++;else count++;}$('date').textContent=iso(d);$('elapsed').textContent=Math.round((d-st)/day)+' days';$('excluded').textContent=excluded.toString();}
['start','duration','mode','holidays'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('start').value='2026-09-18';$('duration').value=30;$('mode').value='business';$('holidays').value='';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Calendar-day versus business-day milestone planning</h2><p>Calendar-day mode adds every day. Business-day mode counts Monday through Friday and also excludes any ISO-format holiday dates you provide.</p>
<h2>How the start date is treated</h2><p>The calculator treats the start date as day zero and begins counting the requested duration after it. This is common for project scheduling but can differ from contract-specific counting rules.</p>
<h2>Use one holiday calendar per project</h2><p>International teams may have different non-working days. Enter the holiday set that actually applies to the responsible team or contract rather than assuming one country’s calendar.</p>
<h2>Scheduling limitation</h2><p>This tool adds dates only. It does not account for task dependencies, resource constraints, half-days, calendars with weekend work, or critical-path logic.</p>
<h2>Use milestone dates as a planning baseline, not a full critical-path schedule</h2><p>This calculator moves a date by a specified number of calendar or business days, which is useful for grant deliverables, review windows and internal checkpoints. It does not model task dependencies, resource leveling, predecessor lag, approval uncertainty or local statutory calendars. For a complex project, place the calculated dates into a proper schedule and identify which dependencies can actually move the completion date.</p><h2>Make the calendar auditable</h2><p>When business-day mode matters, keep the holiday list used for the calculation with the project record. Different offices, countries and funders may observe different calendars, so the same “10 business days” can resolve to different dates unless the governing calendar is documented.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Does the start date count as day one?','No. This calculator treats the start date as day zero and adds the requested duration after it.'],['What counts as a business day?','Monday through Friday, excluding any additional YYYY-MM-DD holiday dates you enter.'],['Can I use a custom holiday list?','Yes. Enter one ISO date per line in the holiday field.'],['Does this replace a project scheduling tool?','No. It calculates a date offset only and does not model dependencies or resource availability.']];
require __DIR__.'/../includes/tool-template.php';
