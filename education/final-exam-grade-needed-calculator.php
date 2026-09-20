<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','final-exam-grade-needed-calculator');
ob_start();
?>
<h2>Find the score you need on your final exam</h2>
<p class="lead">Calculate the final exam grade needed to reach a target course grade, see whether the target is mathematically reachable, and test a what-if exam score.</p>
<div class="field-grid">
  <div class="field"><label for="current">Current course grade (%)</label><input id="current" type="number" min="0" step="0.01" value="84"></div>
  <div class="field"><label for="weight">Final exam weight (%)</label><input id="weight" type="number" min="0.01" max="100" step="0.01" value="30"></div>
  <div class="field"><label for="target">Target course grade (%)</label><input id="target" type="number" min="0" step="0.01" value="85"></div>
  <div class="field"><label for="whatif">What-if final exam score (%)</label><input id="whatif" type="number" min="0" step="0.01" value="80"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate required grade</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid">
 <div class="metric"><span>Final exam score needed</span><strong id="needed">—</strong></div>
 <div class="metric"><span>Reachability</span><strong id="reach">—</strong></div>
 <div class="metric"><span>Course grade if final = 0%</span><strong id="minGrade">—</strong></div>
 <div class="metric"><span>Course grade if final = 100%</span><strong id="maxGrade">—</strong></div>
 <div class="metric"><span>What-if course grade</span><strong id="whatifGrade">—</strong></div>
</div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id), num=id=>Number($(id).value);
function go(){
 const c=num('current'), wt=num('weight'), g=num('target'), f=num('whatif');
 if(![c,wt,g,f].every(Number.isFinite)||c<0||g<0||f<0||wt<=0||wt>100){
   ['needed','reach','minGrade','maxGrade','whatifGrade'].forEach(id=>$(id).textContent='—');$('note').textContent='Enter valid non-negative grades and a final exam weight above 0% and up to 100%.';return;
 }
 const w=wt/100, needed=(g-c*(1-w))/w, min=c*(1-w), max=min+100*w, what=min+f*w;
 $('needed').textContent=needed.toFixed(2)+'%'; $('minGrade').textContent=min.toFixed(2)+'%'; $('maxGrade').textContent=max.toFixed(2)+'%'; $('whatifGrade').textContent=what.toFixed(2)+'%';
 if(needed<0){$('reach').textContent='Target already secured';$('note').textContent='Under this simple weighted model, even a 0% on the final would still leave the overall grade at or above the target.';}
 else if(needed<=100){$('reach').textContent='Reachable at ≤100%';$('note').textContent='A final score of about '+needed.toFixed(2)+'% reaches the target under the stated weighting. Check your syllabus for curves, dropped work or category rules.';}
 else {$('reach').textContent='Above 100% required';$('note').textContent='The target is not reachable with a standard 100% maximum on the final alone. Extra credit or a different grading rule would be required.';}
}
$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{['current','weight','target','whatif'].forEach(id=>$(id).value=$(id).defaultValue);go();});['current','weight','target','whatif'].forEach(id=>$(id).addEventListener('input',go));go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Final exam grade needed formula</h2>
<p>This calculator uses a simple weighted-average model. If <em>C</em> is the current grade, <em>w</em> is the final exam weight written as a decimal, <em>G</em> is the target overall grade, and <em>F</em> is the required final exam score, then <strong>G = C × (1 − w) + F × w</strong>. Solving for the unknown exam score gives <strong>F = [G − C × (1 − w)] ÷ w</strong>.</p>
<h3>What does a required score over 100% mean?</h3>
<p>A result above 100% means the target cannot be reached through the final exam alone if 100% is the normal maximum score. The tool also shows the highest possible course grade if the final score is 100%, which makes the limitation easy to verify.</p>
<h3>What does a negative required final grade mean?</h3>
<p>A negative result means the target is already mathematically protected under the simple weighting model: even a zero on the final would leave the overall grade at or above the target. This does not mean skipping a required exam is allowed; course policies can still require participation or a minimum exam score.</p>
<h3>Use the what-if final score</h3>
<p>The what-if field lets you test a realistic expected exam score and immediately estimate the resulting course grade. This is helpful when comparing study goals, but it assumes the current grade already represents every non-final component and that no curve, extra credit, dropped assignments or category-specific rules change the calculation.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['How do I calculate what I need on my final exam?','Use required final = [target grade − current grade × (1 − final weight)] ÷ final weight, with the final weight written as a decimal.'],
 ['What if the calculator says I need more than 100%?','Your target is mathematically unreachable through the final alone under a standard 100% maximum. The calculator also shows the highest overall grade possible with a 100% final.'],
 ['Why does the calculator show a negative score needed?','It means your target is already secured under the simple weighted-average model, even if the final score were zero.'],
 ['Does this calculator handle curves or extra credit?','No. It models a straightforward weighted final. Adjust the inputs or follow your course grading rules if curves, extra credit, dropped grades or minimum exam requirements apply.']
];
require __DIR__.'/../includes/tool-template.php';
