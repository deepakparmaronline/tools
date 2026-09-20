<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','line-balance-calculator');
ob_start();
?>
<h2>Calculate line balance efficiency</h2><p class="lead">Compare total work content with the available station time in each cycle.</p>
<div class="form-grid"><div class="field"><label for="work">Total task/work content per unit (seconds)</label><input id="work" type="number" min="0.0001" step="any" value="420"></div><div class="field"><label for="stations">Workstations/operators</label><input id="stations" type="number" min="1" step="1" value="6"></div><div class="field"><label for="cycle">Line cycle time (seconds/unit)</label><input id="cycle" type="number" min="0.0001" step="any" value="80"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Balance efficiency</span><strong id="eff">—</strong></div><div class="metric"><span>Balance delay</span><strong id="delay">—</strong></div><div class="metric"><span>Theoretical min stations</span><strong id="min">—</strong></div><div class="metric"><span>Idle allowance/cycle</span><strong id="idle">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const w=+$('work').value,n=Math.floor(+$('stations').value),c=+$('cycle').value;if(!(w>0&&n>=1&&c>0)){['eff','delay','min','idle'].forEach(id=>$(id).textContent='—');return}const cap=n*c,e=w/cap*100,idle=cap-w;$('eff').textContent=e.toFixed(2)+'%';$('delay').textContent=(100-e).toFixed(2)+'%';$('min').textContent=Math.ceil(w/c).toString();$('idle').textContent=idle.toFixed(2)+' s';$('note').textContent=e>100?'The assigned work content exceeds station-cycle capacity; the line cannot sustain the entered cycle without added capacity or different task allocation.':'Efficiency is a theoretical aggregate. Precedence constraints and indivisible tasks can prevent achieving the theoretical minimum station count.';$('note').className='helper'+(e>100?' danger':'')}['work','stations','cycle'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Assembly line balance efficiency</h2><p>Line balance efficiency compares the productive work content required for one unit with the total station time made available per cycle. The formula is <strong>work content ÷ (number of stations × cycle time) × 100</strong>.</p>
<h2>Balance delay and idle allowance</h2><p>The complement of efficiency is balance delay in this simplified calculation. Total station-cycle time minus required work content shows aggregate idle allowance. It does not reveal which station is the bottleneck; a line can have reasonable average efficiency and still be constrained by one overloaded station.</p>
<h2>Theoretical minimum station count</h2><p><strong>ceil(work content ÷ cycle time)</strong> is a lower bound. Real task assignments must also obey precedence relationships, zoning, equipment, ergonomic, skill and task-indivisibility constraints, so the mathematical minimum may be infeasible.</p>
<h2>Use task-level data for balancing decisions</h2><p>This tool is useful for a first check or before/after comparison. For actual balancing, map individual task times and precedence, then verify station loads, walking, material presentation, variability and quality. Do not force operators to exceed safe standardized work simply to improve a percentage.</p>
<h2>Check balance under real product mix</h2><p>Mixed-model lines can have different work content by variant, so a single average unit can hide overload when a difficult sequence occurs. Test representative product mixes and sequence rules, and review station-level task times rather than relying only on total work content. The aggregate efficiency is a useful screen; a detailed balance should still respect task precedence, ergonomic limits and the actual bottleneck station.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is line balance efficiency?','It is required work content divided by total station-cycle time available, expressed as a percentage.'],['Can line balance efficiency exceed 100%?','A calculated value above 100% means the entered stations and cycle time do not provide enough aggregate time for the required work content.'],['Why is the minimum station count only theoretical?','Tasks may be indivisible and constrained by sequence, equipment, zoning or ergonomics, so not every combination can achieve the lower bound.'],['Does a high balance efficiency guarantee high output?','No. Downtime, defects, starvation/blocking, variability and bottlenecks can still reduce throughput.']];
require __DIR__.'/../includes/tool-template.php';
