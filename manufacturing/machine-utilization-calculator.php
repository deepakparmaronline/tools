<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','machine-utilization-calculator');
ob_start();
?>
<h2>Calculate machine utilization</h2><p class="lead">Separate calendar utilization from scheduled-time utilization so the denominator is explicit.</p>
<div class="form-grid"><div class="field"><label for="calendar">Calendar period hours</label><input id="calendar" type="number" min="0.0001" step="any" value="168"></div><div class="field"><label for="scheduled">Scheduled machine hours</label><input id="scheduled" type="number" min="0" step="any" value="120"></div><div class="field"><label for="run">Actual running hours</label><input id="run" type="number" min="0" step="any" value="92"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Calendar utilization</span><strong id="cal">—</strong></div><div class="metric"><span>Scheduled utilization</span><strong id="sched">—</strong></div><div class="metric"><span>Scheduled idle time</span><strong id="idle">—</strong></div><div class="metric"><span>Unscheduled calendar time</span><strong id="unsched">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const c=+$('calendar').value,s=+$('scheduled').value,r=+$('run').value;if(!(c>0&&s>=0&&r>=0&&s<=c&&r<=s)){['cal','sched','idle','unsched'].forEach(id=>$(id).textContent='—');$('note').textContent='Use runtime ≤ scheduled time ≤ calendar period.';$('note').className='helper danger';return}$('cal').textContent=(r/c*100).toFixed(2)+'%';$('sched').textContent=s>0?(r/s*100).toFixed(2)+'%':'—';$('idle').textContent=(s-r).toFixed(2)+' h';$('unsched').textContent=(c-s).toFixed(2)+' h';$('note').textContent='Calendar and scheduled utilization answer different questions. State the denominator whenever the KPI is reported.';$('note').className='helper'}['calendar','scheduled','run'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Machine utilization calculator</h2><p>“Utilization” is ambiguous unless the denominator is named. This tool reports two versions: <strong>runtime ÷ total calendar-period hours</strong> and <strong>runtime ÷ scheduled machine hours</strong>. A machine running every scheduled hour can have 100% scheduled utilization while calendar utilization is much lower.</p>
<h2>Scheduled idle time</h2><p>Scheduled hours minus actual running hours captures the entered period's non-running time inside the production schedule. Break it into reason codes such as breakdown, setup, no material, no operator and planned maintenance if you want actionable loss analysis.</p>
<h2>Utilization is not OEE</h2><p>Runtime alone does not measure speed loss or quality loss. OEE normally combines availability, performance and quality. A machine can show high runtime utilization while producing slowly or creating defects.</p>
<h2>Choose the denominator for the decision</h2><p>Calendar utilization helps with capital/asset intensity and unused shifts. Scheduled utilization helps operating teams understand how effectively committed schedule time becomes run time. Keep definitions stable before benchmarking machines or sites.</p>
<h2>Avoid optimizing utilization in isolation</h2><p>Keeping every machine running can create excess work-in-process if downstream demand does not require the output. In constraint-based systems, non-bottleneck idle time can be economically rational. Review utilization with throughput, queue/WIP, due-date performance and maintenance health. For capital decisions, a persistent high scheduled utilization on the true constraint is more informative than a high percentage on equipment that has no effect on system throughput.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is machine utilization?','It is a ratio of machine runtime to a defined available-time denominator. The denominator may be calendar time or scheduled time, so it should always be stated.'],['Why are two utilization percentages shown?','They answer different questions: asset use across the whole period versus execution during hours the machine was scheduled.'],['Is machine utilization the same as OEE availability?','Not necessarily. OEE availability uses Planned Production Time and its own downtime definitions; align boundaries before comparing.'],['Should planned maintenance be scheduled time?','That depends on your KPI definition. Be consistent and document whether planned maintenance is inside or outside the denominator.']];
require __DIR__.'/../includes/tool-template.php';
