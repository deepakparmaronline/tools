<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('education','rubric-builder-score-calculator');
ob_start();
?>
<h2>Build a weighted rubric and calculate the score</h2>
<p class="lead">Create rubric criteria, assign weights, enter earned and maximum points, and calculate both raw criterion percentages and a normalized weighted rubric score.</p>
<div style="overflow-x:auto"><table style="width:100%;border-collapse:collapse"><thead><tr><th style="text-align:left;padding:8px">Criterion</th><th style="text-align:left;padding:8px">Weight %</th><th style="text-align:left;padding:8px">Earned</th><th style="text-align:left;padding:8px">Max</th><th style="text-align:left;padding:8px">Contribution</th><th></th></tr></thead><tbody id="rows"></tbody></table></div>
<div class="tool-actions"><button class="btn btn-secondary" id="add" type="button">Add criterion</button><button class="btn btn-primary" id="calc" type="button">Calculate rubric score</button><button class="btn btn-secondary" id="copy" type="button">Copy rubric summary</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid"><div class="metric"><span>Total rubric weight</span><strong id="weightTotal">—</strong></div><div class="metric"><span>Weighted points</span><strong id="weighted">—</strong></div><div class="metric"><span>Normalized rubric score</span><strong id="normalized">—</strong></div></div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id);let seq=0,last='';
function esc(s){return String(s).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;')}
function add(name='Criterion '+(seq+1),w=25,earned=8,max=10){seq++;const tr=document.createElement('tr');tr.innerHTML=`<td style="padding:6px"><input class="name" aria-label="Criterion" value="${esc(name)}"></td><td style="padding:6px"><input class="weight" aria-label="Weight percent" type="number" min="0" step="0.01" value="${w}"></td><td style="padding:6px"><input class="earned" aria-label="Earned points" type="number" min="0" step="0.01" value="${earned}"></td><td style="padding:6px"><input class="max" aria-label="Maximum points" type="number" min="0.01" step="0.01" value="${max}"></td><td style="padding:6px" class="contrib">—</td><td style="padding:6px"><button class="btn btn-secondary remove" type="button">Remove</button></td>`;tr.querySelector('.remove').addEventListener('click',()=>{tr.remove();go();});tr.querySelectorAll('input').forEach(el=>el.addEventListener('input',go));$('rows').appendChild(tr);}
function go(){let wt=0,sum=0,valid=true,lines=['Rubric score summary'];const trs=[...$('rows').querySelectorAll('tr')];trs.forEach(tr=>{const name=tr.querySelector('.name').value.trim()||'Unnamed criterion',w=Number(tr.querySelector('.weight').value),e=Number(tr.querySelector('.earned').value),m=Number(tr.querySelector('.max').value);if(![w,e,m].every(Number.isFinite)||w<0||e<0||m<=0){valid=false;tr.querySelector('.contrib').textContent='—';return;}const pct=e/m*100,c=pct*w/100;wt+=w;sum+=c;tr.querySelector('.contrib').textContent=c.toFixed(2)+' pts';lines.push(name+': '+pct.toFixed(1)+'% × '+w.toFixed(1)+'% weight = '+c.toFixed(2)+' weighted points');});
 if(!valid||trs.length===0||wt<=0){$('weightTotal').textContent=$('weighted').textContent=$('normalized').textContent='—';$('note').textContent='Add at least one criterion with a positive total weight and valid scores.';last='';return;}
 const norm=sum/wt*100;$('weightTotal').textContent=wt.toFixed(2)+'%';$('weighted').textContent=sum.toFixed(2);$('normalized').textContent=norm.toFixed(2)+'%';$('note').textContent=Math.abs(wt-100)<0.01?'Weights total 100%, so weighted points equal the final percentage.':'Weights total '+wt.toFixed(2)+'%. The normalized score rescales the entered criteria to 100%; adjust weights to 100% if this is intended to be a complete rubric.';lines.push('Total weight: '+wt.toFixed(2)+'%','Normalized score: '+norm.toFixed(2)+'%');last=lines.join('\n');}
async function copy(){go();if(!last)return;try{await navigator.clipboard.writeText(last);$('note').textContent+=' Rubric summary copied.';}catch(e){$('note').textContent+=' Copy was blocked by the browser; select the results manually.';}}
function reset(){seq=0;$('rows').innerHTML='';add('Content accuracy',35,9,10);add('Evidence / support',25,8,10);add('Organization',20,9,10);add('Clarity / mechanics',20,8,10);go();}
$('add').addEventListener('click',()=>{add();go();});$('calc').addEventListener('click',go);$('copy').addEventListener('click',copy);$('reset').addEventListener('click',reset);reset();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How to build a weighted grading rubric</h2>
<p>A rubric separates an assignment or performance into criteria and makes the scoring logic visible. Give each criterion a weight that reflects its importance, then record earned points and maximum points. The tool first converts each criterion into a percentage and multiplies that percentage by the criterion weight.</p>
<h3>Weighted rubric score formula</h3>
<p>For each criterion, <strong>criterion percentage = earned points ÷ maximum points × 100</strong>. Its weighted contribution is <strong>criterion percentage × weight ÷ 100</strong>. If all criterion weights total 100%, adding the contributions gives the final rubric percentage.</p>
<h3>What if rubric weights do not total 100%?</h3>
<p>The calculator shows the actual total weight and also a normalized score. Normalization divides the weighted contribution total by the weight represented, so you can score a partial rubric without pretending the missing criteria were zeros. For a final published rubric, weights should normally match the grading design used by the course or assessment.</p>
<h3>Design criteria before scoring</h3>
<p>Good rubric criteria describe distinct evidence rather than repeating the same quality under different labels. Keep score ranges and performance descriptions clear, align weights with learning priorities, and use the same interpretation consistently across students. The calculator handles the arithmetic; it does not determine whether a rubric is valid, fair or aligned to learning outcomes.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['How do I calculate a weighted rubric score?','Convert each criterion to a percentage, multiply it by that criterion’s weight, and add the weighted contributions.'],
 ['Do rubric weights have to add to 100%?','For a complete weighted rubric they normally should. This tool also shows a normalized score when the entered weights represent only part of the rubric.'],
 ['Can criteria use different maximum point values?','Yes. Each criterion is converted to a percentage before its weight is applied, so different raw point scales can be combined.'],
 ['What makes a good grading rubric?','Criteria should be distinct, understandable, aligned to the task or learning outcomes, and paired with consistent scoring descriptions. The calculator only performs the numerical weighting.']
];
require __DIR__.'/../includes/tool-template.php';
