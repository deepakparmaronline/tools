<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','appointment-capacity-calculator');
ob_start();
?>
<h2>Estimate salon appointment capacity</h2>
<p class="lead">Translate staff hours, average service time, buffer time and target utilization into practical daily and weekly appointment capacity.</p>
<div class="form-grid"><div class="field"><label for="staff">Service staff scheduled</label><input id="staff" type="number" value="5" min="0" step="1"></div><div class="field"><label for="hours">Service hours per staff member/day</label><input id="hours" type="number" value="8" min="0" step="any"></div><div class="field"><label for="duration">Average service duration (minutes)</label><input id="duration" type="number" value="60" min="1" step="any"></div><div class="field"><label for="buffer">Average cleanup/buffer (minutes)</label><input id="buffer" type="number" value="10" min="0" step="any"></div><div class="field"><label for="util">Target bookable utilization (%)</label><input id="util" type="number" value="85" min="1" max="100" step="any"></div><div class="field"><label for="days">Open days per week</label><input id="days" type="number" value="6" min="0" max="7" step="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Theoretical daily capacity</span><strong id="theory">—</strong></div><div class="metric"><span>Practical daily capacity</span><strong id="practical">—</strong></div><div class="metric"><span>Practical weekly capacity</span><strong id="weekly">—</strong></div><div class="metric"><span>Bookable staff time</span><strong id="bookable">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const s=n('staff'),h=n('hours'),d=n('duration'),b=n('buffer'),u=n('util')/100,days=n('days');if(![s,h,d,b,u,days].every(Number.isFinite)||s<0||h<0||d<=0||b<0||u<=0||u>1||days<0){note('Check staff, hours, service duration, buffer and utilization.',true);return;}const mins=s*h*60,slot=d+b,theoretical=mins/slot,practical=theoretical*u;$('theory').textContent=fmt(theoretical,1)+' appointments/day';$('practical').textContent=fmt(practical,1)+' appointments/day';$('weekly').textContent=fmt(practical*days,1)+' appointments/week';$('bookable').textContent=fmt(mins*u/60,1)+' staff-hours/day';note('Capacity is a planning average. Service mix, staff skills, room/equipment constraints, breaks and no-shows can reduce actual throughput.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('staff')?.addEventListener('input',go);$('staff')?.addEventListener('change',go);$('hours')?.addEventListener('input',go);$('hours')?.addEventListener('change',go);$('duration')?.addEventListener('input',go);$('duration')?.addEventListener('change',go);$('buffer')?.addEventListener('input',go);$('buffer')?.addEventListener('change',go);$('util')?.addEventListener('input',go);$('util')?.addEventListener('change',go);$('days')?.addEventListener('input',go);$('days')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the appointment capacity calculator works</h2><p>Total scheduled service minutes are divided by average appointment plus turnover/buffer minutes. Applying a target utilization percentage reduces theoretical capacity to a more realistic bookable level.</p><h2>How salons and spas can use it</h2><p>Use capacity to compare demand with staffing, plan online booking inventory, identify when hiring or longer opening hours may be needed, and test the effect of service-duration changes.</p><h2>Assumptions to review</h2><p>A single average duration cannot model every treatment mix. Room availability, specialist skills, breaks, late arrivals, no-shows and simultaneous processing time can all change real capacity.</p><h2>Example</h2><p>Five staff working eight service hours provide 2,400 staff-minutes. With 70-minute combined service/turnover slots, theoretical capacity is about 34 appointments; at 85% utilization, practical capacity is about 29.</p>
<h3>Turn theoretical salon capacity into bookable capacity</h3>
<p>A salon appointment capacity calculator shows how many services could fit into available staff time, but a full calendar should not be treated as 100% productive. Cleaning, setup, consultations, color processing overlap, breaks, late arrivals and no-shows all reduce usable capacity. Compare theoretical appointments with a realistic utilization target and the service mix actually sold. This helps salon and spa managers decide whether a booking problem comes from insufficient staff hours, long service duration, scheduling gaps or demand rather than simply adding more appointment slots.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is salon utilization?','It is the share of scheduled service time you expect to be productively booked rather than left idle or unavailable.'],['Should cleanup time be included?','Yes. Add turnover, sanitation or preparation time that prevents the next appointment from starting immediately.'],['Does the tool account for different service types?','It uses an average service duration. For a mixed menu, calculate separate service groups or use a weighted average.'],['Can capacity exceed room availability?','The math may, so compare the result with room, chair and equipment constraints before changing bookings.']];
require __DIR__.'/../includes/tool-template.php';
