<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','attendance-percentage-calculator');
ob_start();
?>
<h2>Calculate attendance percentage and target attendance</h2>
<p class="lead">Enter classes held and classes attended to calculate your attendance rate, then see how many future classes you need to attend—or may be able to miss—to stay above a target percentage.</p>
<div class="field-grid">
  <div class="field"><label for="held">Classes held</label><input id="held" type="number" min="1" step="1" value="120"></div>
  <div class="field"><label for="attended">Classes attended</label><input id="attended" type="number" min="0" step="1" value="92"></div>
  <div class="field"><label for="target">Target attendance (%)</label><input id="target" type="number" min="0.01" max="100" step="0.01" value="75"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate attendance</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite">
  <div class="result-grid">
    <div class="metric"><span>Attendance percentage</span><strong id="pct">—</strong></div>
    <div class="metric"><span>Classes missed</span><strong id="missed">—</strong></div>
    <div class="metric"><span>Target status</span><strong id="status">—</strong></div>
    <div class="metric"><span id="actionLabel">Target planning</span><strong id="action">—</strong></div>
  </div>
  <p id="note" class="helper" style="margin-top:12px"></p>
</div>
<script>
(()=>{
const $=id=>document.getElementById(id);
function n(id){return Number($(id).value)}
function go(){
 const held=n('held'), attended=n('attended'), target=n('target');
 if(!Number.isFinite(held)||held<=0||!Number.isInteger(held)||!Number.isFinite(attended)||attended<0||!Number.isInteger(attended)||attended>held||!Number.isFinite(target)||target<=0||target>100){
   $('pct').textContent=$('missed').textContent=$('status').textContent=$('action').textContent='—';
   $('note').textContent='Use whole-number class counts, keep attended classes between 0 and classes held, and enter a target from above 0% to 100%.';return;
 }
 const pct=attended/held*100, missed=held-attended, t=target/100;
 $('pct').textContent=pct.toFixed(2)+'%'; $('missed').textContent=missed.toLocaleString();
 if(pct+1e-12>=target){
   $('status').textContent='At / above target'; $('actionLabel').textContent='Additional classes you can miss';
   if(target===100){$('action').textContent=attended===held?'0':'—';}
   else $('action').textContent=Math.max(0,Math.floor(attended/t-held+1e-12)).toLocaleString();
   $('note').textContent='The missable-class figure assumes you attend no additional classes before those absences. Recalculate after your timetable changes.';
 }else{
   $('status').textContent='Below target'; $('actionLabel').textContent='Consecutive classes to attend';
   if(target===100){$('action').textContent='Not reachable';$('note').textContent='Once a class has been missed, 100% attendance cannot be restored without changing the recorded totals.';}
   else {
     const need=Math.max(0,Math.ceil((t*held-attended)/(1-t)-1e-12));
     $('action').textContent=need.toLocaleString();
     const projected=(attended+need)/(held+need)*100;
     $('note').textContent='Attend '+need.toLocaleString()+' consecutive future class'+(need===1?'':'es')+' to reach approximately '+projected.toFixed(2)+'%, assuming every new class is attended.';
   }
 }
}
$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{['held','attended','target'].forEach(id=>$(id).value=$(id).defaultValue);go();});['held','attended','target'].forEach(id=>$(id).addEventListener('input',go));go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How to calculate attendance percentage</h2>
<p>The basic attendance percentage formula is <strong>classes attended ÷ classes held × 100</strong>. If 92 classes were attended out of 120 held, the attendance percentage is 76.67%. The calculator also shows missed classes so the underlying counts remain visible.</p>
<h3>Attendance target calculator</h3>
<p>When current attendance is below a target, the tool solves for the number of consecutive future classes that must be attended. It finds the smallest whole number <em>x</em> for which <strong>(attended + x) ÷ (held + x)</strong> reaches the target. This is useful for 75% attendance calculations, 80% attendance targets, or any other threshold your institution uses.</p>
<h3>How many classes can I miss?</h3>
<p>If current attendance already meets the target, the calculator estimates how many additional classes could be missed before the percentage falls below the selected threshold. This is a mathematical planning estimate only. Colleges, universities, schools, training providers and individual courses can apply different attendance policies, rounding rules, excused-absence rules or minimum session requirements.</p>
<h3>Use recorded totals, not calendar guesses</h3>
<p>For the most reliable result, use the official number of classes or sessions recorded as held and attended. Do not count cancelled classes unless your institution records them as held. Recalculate after each new class because both the numerator and denominator can change.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['What is the formula for attendance percentage?','Attendance percentage = classes attended ÷ classes held × 100.'],
 ['How many classes do I need to attend to reach 75% attendance?','Enter your current held and attended totals and set the target to 75%. The calculator solves for the minimum number of consecutive future classes that must be attended.'],
 ['Can this calculator tell me how many classes I can miss?','Yes. If your current rate is at or above the target, it estimates how many additional classes could be missed before the rate drops below that target.'],
 ['Why might my college portal show a slightly different percentage?','Institutions may use subject-wise attendance, excused absences, lab sessions, credits, rounding rules or other policies that differ from a simple session-count formula.']
];
require __DIR__.'/../includes/tool-template.php';
