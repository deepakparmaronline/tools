<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','cp-cpk-process-capability-calculator');
ob_start();
?>
<h2>Calculate Cp and Cpk process capability</h2><p class="lead">Compare process spread and centering with lower and upper specification limits.</p>
<div class="form-grid"><div class="field"><label for="lsl">Lower specification limit (LSL)</label><input id="lsl" type="number" step="any" value="9.5"></div><div class="field"><label for="usl">Upper specification limit (USL)</label><input id="usl" type="number" step="any" value="10.5"></div><div class="field"><label for="mean">Process mean</label><input id="mean" type="number" step="any" value="10.1"></div><div class="field"><label for="sd">Process standard deviation (σ estimate)</label><input id="sd" type="number" min="0.0000001" step="any" value="0.12"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Cp</span><strong id="cp">—</strong></div><div class="metric"><span>Cpk</span><strong id="cpk">—</strong></div><div class="metric"><span>CPU</span><strong id="cpu">—</strong></div><div class="metric"><span>CPL</span><strong id="cpl">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const l=+$('lsl').value,u=+$('usl').value,m=+$('mean').value,s=+$('sd').value;if(!(u>l&&s>0)){['cp','cpk','cpu','cpl'].forEach(id=>$(id).textContent='—');$('note').textContent='USL must be greater than LSL and standard deviation must be positive.';$('note').className='helper danger';return}const cp=(u-l)/(6*s),cpu=(u-m)/(3*s),cpl=(m-l)/(3*s),cpk=Math.min(cpu,cpl);$('cp').textContent=cp.toFixed(3);$('cpu').textContent=cpu.toFixed(3);$('cpl').textContent=cpl.toFixed(3);$('cpk').textContent=cpk.toFixed(3);$('note').textContent=(m<l||m>u?'The entered process mean is outside the specification interval. ':'')+'Capability indices are meaningful only when the process and standard-deviation estimate are appropriate for the analysis; check stability, distribution and sampling.';$('note').className='helper'+(m<l||m>u?' danger':'')}['lsl','usl','mean','sd'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Cp and Cpk formulas</h2><p>NIST gives the common normal-process capability relationships <strong>Cp = (USL − LSL) ÷ 6s</strong> and <strong>Cpk = min[(USL − mean) ÷ 3s, (mean − LSL) ÷ 3s]</strong>. The one-sided components are often called CPU and CPL. <a href="https://www.itl.nist.gov/div898/handbook/pmc/section1/pmc16.htm" target="_blank" rel="noopener">NIST process capability guidance</a>.</p>
<h2>Cp versus Cpk</h2><p>Cp compares specification width with six estimated standard deviations and therefore describes potential capability if the process is centered. Cpk also accounts for where the mean sits between the limits. If Cpk is materially lower than Cp, centering is reducing capability.</p>
<h2>Do not calculate capability on an unstable process</h2><p>A single Cp/Cpk number cannot repair poor sampling or special-cause variation. Check process stability using appropriate control methods and inspect the distribution. NIST notes that capability estimates need adequate independent data and that normal-based indices are not automatically valid for non-normal processes.</p>
<h2>No universal acceptance cutoff</h2><p>Values such as 1.00, 1.33 or 1.67 are used in different industries and contracts, but the required capability is a business/customer/quality-system decision. Do not label a process “acceptable” from a generic internet threshold; compare the result with the requirement governing that characteristic.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is the difference between Cp and Cpk?','Cp measures potential capability from process spread relative to spec width. Cpk also penalizes an off-center process by using the nearer specification limit.'],['Can Cpk be negative?','Yes. A negative Cpk can occur when the process mean lies beyond a specification limit.'],['What standard deviation should I enter?','Use the standard-deviation estimate appropriate to your capability method and quality system. Within-subgroup and overall variation answer different questions.'],['Is Cpk of 1.33 always required?','No. Capability requirements vary by customer, characteristic, industry and quality plan. Use the specified acceptance criterion.']];
require __DIR__.'/../includes/tool-template.php';
