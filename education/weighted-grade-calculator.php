<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','weighted-grade-calculator');
ob_start();
?>
<h2>Calculate a weighted course grade</h2>
<p class="lead">Combine homework, quizzes, projects and exams using category percentages and weights. The calculator shows the weighted total, remaining weight, and a normalized current grade when not all categories are complete.</p>
<div style="overflow-x:auto"><table style="width:100%;border-collapse:collapse"><thead><tr><th style="text-align:left;padding:8px">Category</th><th style="text-align:left;padding:8px">Grade %</th><th style="text-align:left;padding:8px">Weight %</th><th style="text-align:left;padding:8px">Weighted points</th><th></th></tr></thead><tbody id="rows"></tbody></table></div>
<div class="tool-actions"><button class="btn btn-secondary" id="add" type="button">Add category</button><button class="btn btn-primary" id="calc" type="button">Calculate weighted grade</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid"><div class="metric"><span>Entered weight</span><strong id="weight">—</strong></div><div class="metric"><span>Weighted points earned</span><strong id="points">—</strong></div><div class="metric"><span>Normalized current grade</span><strong id="current">—</strong></div><div class="metric"><span>Unentered course weight</span><strong id="remaining">—</strong></div></div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id);let seq=0;
function add(name='Category '+(seq+1),grade=85,weight=20){seq++;const tr=document.createElement('tr');tr.innerHTML=`<td style="padding:6px"><input class="name" aria-label="Category name" value="${name.replace(/"/g,'&quot;')}"></td><td style="padding:6px"><input class="grade" aria-label="Category grade percent" type="number" min="0" step="0.01" value="${grade}"></td><td style="padding:6px"><input class="weight" aria-label="Category weight percent" type="number" min="0" step="0.01" value="${weight}"></td><td style="padding:6px" class="pts">—</td><td style="padding:6px"><button type="button" class="btn btn-secondary remove">Remove</button></td>`;tr.querySelector('.remove').addEventListener('click',()=>{tr.remove();go();});tr.querySelectorAll('input').forEach(el=>el.addEventListener('input',go));$('rows').appendChild(tr);}
function go(){let wt=0,pts=0,valid=true;const trs=[...$('rows').querySelectorAll('tr')];trs.forEach(tr=>{const g=Number(tr.querySelector('.grade').value),w=Number(tr.querySelector('.weight').value);if(!Number.isFinite(g)||g<0||!Number.isFinite(w)||w<0){valid=false;tr.querySelector('.pts').textContent='—';return;}const p=g*w/100;wt+=w;pts+=p;tr.querySelector('.pts').textContent=p.toFixed(2);});
 if(!valid||wt<=0){['weight','points','current','remaining'].forEach(id=>$(id).textContent='—');$('note').textContent='Enter at least one category with a positive weight and valid non-negative grades.';return;}
 $('weight').textContent=wt.toFixed(2)+'%';$('points').textContent=pts.toFixed(2);$('current').textContent=(pts/wt*100).toFixed(2)+'%';$('remaining').textContent=Math.max(0,100-wt).toFixed(2)+'%';
 if(Math.abs(wt-100)<0.01)$('note').textContent='Weights total 100%, so weighted points represent the complete course grade under this model.';
 else if(wt<100)$('note').textContent='Only '+wt.toFixed(2)+'% of the course is represented. The normalized current grade rescales completed categories; it is not the same as treating remaining work as zero.';
 else $('note').textContent='Weights exceed 100%. Check the syllabus or category weights before using the result as a final grade.';
}
function reset(){seq=0;$('rows').innerHTML='';add('Homework',85,20);add('Quizzes',88,20);add('Projects',92,30);add('Final exam',80,30);go();}
$('add').addEventListener('click',()=>{add();go();});$('calc').addEventListener('click',go);$('reset').addEventListener('click',reset);reset();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Weighted grade calculator formula</h2>
<p>For each course category, multiply the category grade by its weight as a decimal. A grade of 88% in a category worth 20% contributes 17.6 percentage points to the course total. Add all category contributions to get the weighted points earned.</p>
<h3>When weights total 100%</h3>
<p>If all course categories are entered and their weights add to 100%, the sum of weighted points is the overall course percentage under the weighted-category model. Check that the category averages you enter already reflect any dropped assignments, bonus points or within-category point weighting used by your gradebook.</p>
<h3>Current grade when only some categories are graded</h3>
<p>If entered categories represent less than 100% of the course, the calculator also shows a normalized current grade: <strong>weighted points ÷ entered weight × 100</strong>. This answers, “How am I performing on the work represented so far?” It does not assume the ungraded portion is a zero.</p>
<h3>Why online gradebooks can differ</h3>
<p>Some systems weight individual assignments by points inside each category, drop low scores, ignore empty categories, allow extra credit or apply institutional rounding. Use the syllabus and official gradebook rules as the source of truth if their calculation differs.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['How do I calculate a weighted grade?','Multiply each category grade by its percentage weight written as a decimal, then add the weighted contributions.'],
 ['What if my weights do not add to 100% yet?','The calculator shows the entered weight and a normalized current grade for the portion represented so far.'],
 ['Is an ungraded category treated as zero?','No. If you do not enter it, the normalized current grade is based only on the weights you have entered.'],
 ['Why does my learning management system show a different grade?','Gradebooks may apply assignment points, dropped scores, extra credit, missing-work rules or rounding differently. Follow your course’s official grading setup.']
];
require __DIR__.'/../includes/tool-template.php';
