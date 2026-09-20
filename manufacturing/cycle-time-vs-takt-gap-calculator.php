<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','cycle-time-vs-takt-gap-calculator');
ob_start();
?>
<h2>Compare cycle time with takt time</h2><p class="lead">Calculate demand takt from effective production time, then compare it with the observed cycle time.</p>
<div class="form-grid"><div class="field"><label for="time">Effective available production time (minutes)</label><input id="time" type="number" min="0.0001" step="any" value="420"></div><div class="field"><label for="demand">Customer demand in same period (units)</label><input id="demand" type="number" min="0.0001" step="any" value="280"></div><div class="field"><label for="cycle">Actual cycle time (seconds/unit)</label><input id="cycle" type="number" min="0.0001" step="any" value="95"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Takt time</span><strong id="takt">—</strong></div><div class="metric"><span>Cycle − takt gap</span><strong id="gap">—</strong></div><div class="metric"><span>Cycle/takt ratio</span><strong id="ratio">—</strong></div><div class="metric"><span>Theoretical output at cycle</span><strong id="capacity">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const t=+$('time').value,d=+$('demand').value,c=+$('cycle').value;if(!(t>0&&d>0&&c>0)){['takt','gap','ratio','capacity'].forEach(id=>$(id).textContent='—');return}const ts=t*60/d,g=c-ts,r=c/ts,cap=t*60/c;$('takt').textContent=ts.toFixed(2)+' s/unit';$('gap').textContent=(g>=0?'+':'')+g.toFixed(2)+' s';$('ratio').textContent=r.toFixed(3)+'×';$('capacity').textContent=cap.toFixed(1)+' units';$('note').textContent=c<=ts?'Observed cycle time is at or below takt in this simplified comparison. Protecting flow still depends on uptime, variability, quality and staffing.':'Observed cycle time is slower than takt; at the entered pace the process would not theoretically produce the full demand within the effective time.';$('note').className='helper'+(c>ts?' danger':'')}['time','demand','cycle'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Cycle time versus takt time</h2><p><strong>Takt time</strong> is the customer-demand pace: effective available production time divided by customer demand. <strong>Cycle time</strong> is how long the process actually takes to produce a unit under the measurement definition used. Comparing them exposes a pace gap.</p>
<h2>Interpreting the gap</h2><p>If cycle time is greater than takt, the process is slower than the required demand pace in the simplified model. If cycle is lower than takt, there is nominal pace headroom. Neither result guarantees delivery because downtime, changeovers, scrap, starvation/blocking and mix variation can reduce realized output.</p>
<h2>Use effective production time consistently</h2><p>Lean Enterprise Institute describes takt as available production time divided by customer demand. Planned breaks and other non-production time are normally removed from the effective time available for the period. Keep the demand and time windows aligned. <a href="https://www.lean.org/lexicon-terms/takt-time/" target="_blank" rel="noopener">Lean Enterprise Institute takt definition</a>.</p>
<h2>Use the ratio as a prioritization signal</h2><p>Cycle/takt above 1.0 identifies a capacity/pace shortfall that may require work-content reduction, balancing, parallel capacity, schedule changes or other countermeasures. Investigate the bottleneck rather than simply demanding faster work.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Should cycle time always be below takt time?','To meet demand at a single-process pace, observed cycle generally needs to be no greater than takt with enough protection for losses and variability.'],['Are takt time and cycle time the same thing?','No. Takt is derived from demand and available time; cycle is an observed/process performance measure.'],['Should breaks be included in available time?','Use effective production time consistent with your takt definition; planned non-production periods such as breaks are commonly excluded.'],['Why can output still miss demand when cycle is faster than takt?','Downtime, quality loss, changeovers, material shortages, variation and other constraints can reduce realized output.']];
require __DIR__.'/../includes/tool-template.php';
