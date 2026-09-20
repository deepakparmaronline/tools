<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','first-pass-yield-calculator');
ob_start();
?>
<h2>Calculate First Pass Yield (FPY)</h2><p class="lead">Measure the share of input units that meet quality requirements the first time without rework, repair, retest or rerun.</p>
<div class="form-grid"><div class="field"><label for="input">Units entering process</label><input id="input" type="number" min="0.0001" step="any" value="1000"></div><div class="field"><label for="first">Good units on first pass</label><input id="first" type="number" min="0" step="any" value="930"></div><div class="field"><label for="recovered">Additional units recovered after rework (optional)</label><input id="recovered" type="number" min="0" step="any" value="45"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>First Pass Yield</span><strong id="fpy">—</strong></div><div class="metric"><span>First-pass fallout</span><strong id="fallout">—</strong></div><div class="metric"><span>Final recovered yield</span><strong id="final">—</strong></div><div class="metric"><span>Unrecovered units</span><strong id="loss">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const i=+$('input').value,g=+$('first').value,r=+$('recovered').value;if(!(i>0&&g>=0&&r>=0&&g<=i&&g+r<=i)){['fpy','fallout','final','loss'].forEach(id=>$(id).textContent='—');$('note').textContent='Good first-pass units plus recovered units cannot exceed total input.';$('note').className='helper danger';return}$('fpy').textContent=(g/i*100).toFixed(2)+'%';$('fallout').textContent=((i-g)/i*100).toFixed(2)+'%';$('final').textContent=((g+r)/i*100).toFixed(2)+'%';$('loss').textContent=(i-g-r).toLocaleString();$('note').textContent='FPY intentionally excludes recovered rework from the numerator; that is why final recovered yield can be higher than FPY.';$('note').className='helper'}['input','first','recovered'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>First Pass Yield formula</h2><p>ASQ describes first-pass yield as the percentage of units that complete a process meeting quality requirements without scrap, rerun, retest, repair or rework. In this calculator, <strong>FPY = first-pass good units ÷ units entering × 100</strong>. <a href="https://asq.org/quality-resources/first-pass-yield" target="_blank" rel="noopener">ASQ First Pass Yield resource</a>.</p>
<h2>Why FPY is different from final yield</h2><p>A process can ship nearly all input units after rework and still have poor FPY. That distinction is valuable because rework consumes labor, capacity, material, inspection and lead time that final-yield reporting can hide.</p>
<h2>Define the process boundary</h2><p>For useful comparisons, keep the entry point, quality criteria and definition of “first pass” stable. If a unit leaves the process for repair and returns, it should not be counted as first-pass good simply because it eventually passed.</p>
<h2>Use FPY with defect information</h2><p>FPY tells you how much flow succeeds without correction, but not why units fail. Pair it with defect categories, rework time/cost and process-step yields to prioritize improvement work. Multi-step Rolled Throughput Yield can reveal compound losses across an end-to-end process.</p>
<h2>Trend FPY at the right level</h2><p>Plant-wide FPY can improve simply because the product mix changed toward easier items. Segment by product family, process, shift or defect mode where appropriate, and preserve the same inspection standard. If measurement-system error is significant, apparent FPY changes may reflect inspection variation rather than process improvement. Pair the percentage with absolute volume so a small high-volume decline is not hidden by a high overall rate.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Does reworked product count in FPY?','No. FPY is intended to count units that meet requirements on the first pass without rework, repair, rerun or retest.'],['Can final yield be high while FPY is low?','Yes. Successful rework can raise final yield while the process still creates substantial first-pass fallout.'],['What denominator should I use?','Use the units entering the defined process boundary for the same period and product scope as the first-pass good count.'],['Is FPY the same as Rolled Throughput Yield?','No. FPY describes one process/step; RTY combines yields across multiple sequential steps.']];
require __DIR__.'/../includes/tool-template.php';
