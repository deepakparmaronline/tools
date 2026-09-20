<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','question-difficulty-index-calculator');
ob_start();
?>
<h2>Calculate item difficulty index</h2>
<p class="lead">Measure how easy or difficult a test question was using the proportion of students who answered correctly, or use mean score ÷ maximum score for partial-credit items.</p>
<div class="field"><label for="mode">Item type</label><select id="mode"><option value="binary">Right / wrong item</option><option value="partial">Partial-credit item</option></select></div>
<div id="binaryFields" class="field-grid"><div class="field"><label for="total">Students who answered</label><input id="total" type="number" min="1" step="1" value="40"></div><div class="field"><label for="correct">Students correct</label><input id="correct" type="number" min="0" step="1" value="28"></div></div>
<div id="partialFields" class="field-grid" style="display:none"><div class="field"><label for="mean">Mean item score</label><input id="mean" type="number" min="0" step="0.01" value="3.4"></div><div class="field"><label for="max">Maximum item score</label><input id="max" type="number" min="0.01" step="0.01" value="5"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate difficulty index</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid"><div class="metric"><span>Difficulty index (p)</span><strong id="p">—</strong></div><div class="metric"><span>Percent of maximum</span><strong id="pct">—</strong></div><div class="metric"><span>Descriptive reading</span><strong id="label">—</strong></div></div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id), n=id=>Number($(id).value);
function band(p){return p>=0.9?'Very easy / high success':p>=0.7?'Relatively easy':p>=0.3?'Moderate success':p>=0.1?'Relatively difficult':'Very difficult / low success'}
function go(){
 const mode=$('mode').value;let p;
 if(mode==='binary'){
   const total=n('total'),correct=n('correct');if(!Number.isFinite(total)||total<=0||!Number.isInteger(total)||!Number.isFinite(correct)||correct<0||!Number.isInteger(correct)||correct>total){p=NaN;}
   else p=correct/total;
 }else{
   const mean=n('mean'),max=n('max');if(!Number.isFinite(mean)||mean<0||!Number.isFinite(max)||max<=0||mean>max){p=NaN;}else p=mean/max;
 }
 if(!Number.isFinite(p)){['p','pct','label'].forEach(id=>$(id).textContent='—');$('note').textContent='Enter valid values. Correct responses cannot exceed total responses, and mean score cannot exceed the maximum item score.';return;}
 $('p').textContent=p.toFixed(3);$('pct').textContent=(p*100).toFixed(1)+'%';$('label').textContent=band(p);
 $('note').textContent='In classical item analysis, a higher difficulty index means more students succeeded on the item—so the item was easier. Use the descriptive band as context, not as a universal pass/fail rule.';
}
function toggle(){const partial=$('mode').value==='partial';$('binaryFields').style.display=partial?'none':'grid';$('partialFields').style.display=partial?'grid':'none';go();}
$('mode').addEventListener('change',toggle);$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{$('mode').value='binary';['total','correct','mean','max'].forEach(id=>$(id).value=$(id).defaultValue);toggle();});['total','correct','mean','max'].forEach(id=>$(id).addEventListener('input',go));toggle();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What is a question difficulty index?</h2>
<p>In classical test item analysis, the difficulty index is commonly the proportion of examinees who answer an item correctly. For a right/wrong question, <strong>p = number correct ÷ number who answered</strong>. A p-value of 0.70 means 70% of the group answered correctly.</p>
<h3>Why a higher difficulty index means an easier question</h3>
<p>The name can be counterintuitive: as the difficulty index rises, the observed success rate rises. An item with p = 0.90 was answered correctly by 90% of the group and was therefore easy for that group. An item with p = 0.20 was answered correctly by only 20% and was more difficult for that group.</p>
<h3>Partial-credit item difficulty</h3>
<p>For an item that can earn multiple points, this calculator can use <strong>mean item score ÷ maximum possible item score</strong>. That produces the average proportion of available points earned and keeps the index on a 0-to-1 scale.</p>
<h3>Difficulty is group-dependent</h3>
<p>An item does not have one permanent difficulty value. The index depends on the students who took the test, instruction, wording, administration conditions and scoring method. Difficulty should also be reviewed alongside discrimination, distractor performance, content coverage and learning objectives before revising an assessment.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['What is the formula for item difficulty index?','For a single-point right/wrong item, divide the number of correct responses by the number of students who answered the item.'],
 ['Does a higher difficulty index mean a harder question?','No. In the common classical-test definition, a higher p-value means a larger proportion answered correctly, so the item was easier for that group.'],
 ['How do I calculate difficulty for a partial-credit question?','A common approach is mean item score divided by maximum possible item score.'],
 ['What is a good difficulty index?','There is no universal ideal value. Appropriate difficulty depends on the assessment purpose, content and student group, and should be considered with other item-analysis evidence.']
];
require __DIR__.'/../includes/tool-template.php';
