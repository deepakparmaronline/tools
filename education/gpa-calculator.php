<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','gpa-calculator');
ob_start();
?>
<h2>Calculate semester and cumulative GPA</h2>
<p class="lead">Add courses, credit hours and letter grades to calculate a credit-weighted GPA. Optionally include a previous cumulative GPA and completed credits for an updated cumulative estimate.</p>
<div style="overflow-x:auto"><table style="width:100%;border-collapse:collapse"><thead><tr><th style="text-align:left;padding:8px">Course</th><th style="text-align:left;padding:8px">Credits</th><th style="text-align:left;padding:8px">Grade</th><th style="text-align:left;padding:8px">Quality points</th><th></th></tr></thead><tbody id="rows"></tbody></table></div>
<div class="tool-actions"><button class="btn btn-secondary" id="add" type="button">Add course</button></div>
<h3>Optional previous GPA</h3>
<div class="field-grid"><div class="field"><label for="priorGpa">Previous cumulative GPA</label><input id="priorGpa" type="number" min="0" max="10" step="0.001" placeholder="e.g. 3.42"></div><div class="field"><label for="priorCredits">Previous GPA credits</label><input id="priorCredits" type="number" min="0" step="0.01" placeholder="e.g. 45"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate GPA</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid"><div class="metric"><span>Term GPA</span><strong id="termGpa">—</strong></div><div class="metric"><span>Term credits</span><strong id="termCredits">—</strong></div><div class="metric"><span>Term quality points</span><strong id="termPoints">—</strong></div><div class="metric"><span>Updated cumulative GPA</span><strong id="cumGpa">—</strong></div></div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const grades=[['A+',4],['A',4],['A-',3.7],['B+',3.3],['B',3],['B-',2.7],['C+',2.3],['C',2],['C-',1.7],['D+',1.3],['D',1],['D-',0.7],['F',0]];
let seq=0;
function add(course='Course '+(seq+1),credits=3,grade='A'){
 seq++; const tr=document.createElement('tr'); tr.innerHTML=`<td style="padding:6px"><input aria-label="Course name" class="cname" type="text" value="${course.replace(/"/g,'&quot;')}"></td><td style="padding:6px"><input aria-label="Credits" class="credits" type="number" min="0" step="0.01" value="${credits}"></td><td style="padding:6px"><select aria-label="Grade" class="grade">${grades.map(g=>`<option value="${g[1]}" ${g[0]===grade?'selected':''}>${g[0]} (${g[1].toFixed(1)})</option>`).join('')}</select></td><td style="padding:6px" class="qp">—</td><td style="padding:6px"><button type="button" class="btn btn-secondary remove">Remove</button></td>`;
 tr.querySelector('.remove').addEventListener('click',()=>{tr.remove();go();}); tr.querySelectorAll('input,select').forEach(el=>el.addEventListener('input',go)); $('rows').appendChild(tr);
}
function go(){
 let credits=0,points=0,valid=true; [...$('rows').querySelectorAll('tr')].forEach(tr=>{const c=Number(tr.querySelector('.credits').value),g=Number(tr.querySelector('.grade').value);if(!Number.isFinite(c)||c<0||!Number.isFinite(g)){valid=false;tr.querySelector('.qp').textContent='—';return;}const q=c*g;credits+=c;points+=q;tr.querySelector('.qp').textContent=q.toFixed(2);});
 if(!valid||credits<=0){$('termGpa').textContent=$('termCredits').textContent=$('termPoints').textContent=$('cumGpa').textContent='—';$('note').textContent='Add at least one course with positive credits.';return;}
 const term=points/credits;$('termGpa').textContent=term.toFixed(3);$('termCredits').textContent=credits.toFixed(2);$('termPoints').textContent=points.toFixed(2);
 const pg=Number($('priorGpa').value),pc=Number($('priorCredits').value),hasPrior=$('priorGpa').value!==''||$('priorCredits').value!=='';
 if(hasPrior&&Number.isFinite(pg)&&pg>=0&&Number.isFinite(pc)&&pc>0){$('cumGpa').textContent=((pg*pc+points)/(pc+credits)).toFixed(3);$('note').textContent='Uses the common credit-weighted quality-points method. Confirm your institution’s exact grade-point scale and which courses count toward GPA.';}
 else {$('cumGpa').textContent='—';$('note').textContent=hasPrior?'Enter both a valid previous GPA and positive previous GPA credits, or leave both blank.':'Term GPA calculated on the default 4.0 letter-grade scale shown in each row. Institutional scales can differ.';}
}
function reset(){seq=0;$('rows').innerHTML='';add('Course 1',3,'A');add('Course 2',4,'B+');add('Course 3',3,'A-');$('priorGpa').value='';$('priorCredits').value='';go();}
$('add').addEventListener('click',()=>{add('Course '+(seq+1),3,'A');go();});$('calc').addEventListener('click',go);$('reset').addEventListener('click',reset);['priorGpa','priorCredits'].forEach(id=>$(id).addEventListener('input',go));reset();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How this GPA calculator works</h2>
<p>GPA is usually calculated with credit-weighted grade points. For each course, multiply the grade-point value by the course credits to get quality points. Add all quality points, add all GPA credits, then divide: <strong>GPA = total quality points ÷ total GPA credits</strong>.</p>
<h3>Semester GPA example</h3>
<p>If a 3-credit course earns 4.0 grade points, it contributes 12 quality points. A 4-credit course at 3.3 contributes 13.2 quality points. The calculator performs this multiplication for every course and then divides the combined quality points by the combined credits.</p>
<h3>Cumulative GPA calculator</h3>
<p>If you already have a cumulative GPA, enter that GPA and the number of credits behind it. The tool converts the prior GPA back into prior quality points, adds the new term, and divides by the new total credit count. This avoids incorrectly averaging two GPAs that may represent different numbers of credits.</p>
<h3>Grade scales vary by institution</h3>
<p>The default selector uses a common 4.0 scale with plus/minus values, but universities and schools can use different point values, exclusions, repeat-course rules, pass/fail handling and rounding methods. Always compare the result with the grading policy on your transcript or registrar website.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['What is the GPA formula?','GPA = total quality points divided by total GPA credits. Quality points for a course equal its grade-point value multiplied by its credit hours.'],
 ['Can I calculate cumulative GPA with this tool?','Yes. Enter your prior cumulative GPA and the number of GPA credits behind it, then add the current courses.'],
 ['Why should I not simply average two semester GPAs?','Semesters can have different credit totals. Combining quality points and credits weights each term correctly.'],
 ['Is every school’s 4.0 scale the same?','No. Plus/minus values, repeated-course rules, pass/fail courses and rounding can differ, so verify your institution’s official policy.']
];
require __DIR__.'/../includes/tool-template.php';
