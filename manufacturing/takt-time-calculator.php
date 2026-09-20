<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','takt-time-calculator');
ob_start();
?>
<h2>Calculate takt time</h2><p class="lead">Convert effective available production time and customer demand into the required production rhythm.</p>
<div class="form-grid"><div class="field"><label for="shift">Shift / scheduled period length (minutes)</label><input id="shift" type="number" min="0.0001" step="any" value="480"></div><div class="field"><label for="exclude">Planned non-production time to exclude (minutes)</label><input id="exclude" type="number" min="0" step="any" value="60"></div><div class="field"><label for="demand">Customer demand in period (units)</label><input id="demand" type="number" min="0.0001" step="any" value="280"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Effective production time</span><strong id="effective">—</strong></div><div class="metric"><span>Takt time</span><strong id="takt">—</strong></div><div class="metric"><span>Demand pace</span><strong id="pace">—</strong></div><div class="metric"><span>Units per effective hour</span><strong id="uph">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const s=+$('shift').value,e=+$('exclude').value,d=+$('demand').value;if(!(s>0&&e>=0&&e<s&&d>0)){['effective','takt','pace','uph'].forEach(id=>$(id).textContent='—');$('note').textContent='Excluded planned time must be less than the scheduled period and demand must be positive.';$('note').className='helper danger';return}const a=s-e,t=a*60/d;$('effective').textContent=a.toFixed(2)+' min';$('takt').textContent=t.toFixed(2)+' s/unit';$('pace').textContent=(t/60).toFixed(3)+' min/unit';$('uph').textContent=(60/(t/60)).toFixed(2)+' units/h';$('note').textContent='Takt is a demand rhythm, not the observed cycle time. Do not subtract unplanned downtime merely to make takt slower; use effective planned production time consistent with your operating definition.';$('note').className='helper'}['shift','exclude','demand'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Takt time formula</h2><p>Lean Enterprise Institute defines takt time as <strong>available production time divided by customer demand</strong>. The result expresses the required average rhythm for completing one unit if the process is to match demand. <a href="https://www.lean.org/lexicon-terms/takt-time/" target="_blank" rel="noopener">Lean Enterprise Institute: Takt Time</a>.</p>
<h2>Effective available production time</h2><p>Enter the scheduled period and subtract planned time that is genuinely unavailable for production, such as planned breaks under your local standard. Keep the demand period identical. If demand is per shift, available time must also be per shift.</p>
<h2>Takt is not cycle time</h2><p>Takt comes from the customer requirement. Cycle time is what the process actually takes. Comparing the two helps reveal a capacity gap, but downtime, variability, quality and changeovers still determine whether actual output meets demand.</p>
<h2>Do not manipulate takt to absorb losses</h2><p>Unplanned downtime and inefficiency are process losses, not customer-demand changes. Hiding them by reducing “available” time can produce a slower takt that no longer represents the required demand rhythm. Use separate loss metrics and improve the process against the real demand requirement.</p>
<h2>Recalculate takt when the demand window changes</h2><p>Takt is tied to a specific demand and available-time period. If orders, mix or staffing plans change materially, an old takt can stop representing the customer requirement. Operations may use a stable planning takt for a shift or day to avoid constant disruption, but the choice should be explicit. For mixed products, additional heijunka or pitch concepts may be needed to translate aggregate takt into a workable sequence.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is takt time?','Available production time divided by customer demand for the same period, expressing the required production rhythm per unit.'],['Should breaks be removed from available time?','Planned non-production periods are commonly excluded from effective production time. Use the definition established for your operation.'],['Is takt time the same as cycle time?','No. Takt is demand-derived; cycle time is the observed process pace.'],['What if demand changes during the day?','Recalculate takt for the planning interval where demand and available time are meaningful, or use level-loading/mix methods appropriate to your operation.']];
require __DIR__.'/../includes/tool-template.php';
