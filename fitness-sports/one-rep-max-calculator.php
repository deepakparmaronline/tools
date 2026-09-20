<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('fitness-sports','one-rep-max-calculator');
ob_start();
?>
<h2>Estimate one-rep max (1RM)</h2><p class="lead">Enter a weight and completed repetitions to compare two common 1RM prediction equations.</p>
<div class="form-grid"><div class="field"><label for="weight">Weight lifted</label><input id="weight" type="number" min="0" step="any" value="80"></div><div class="field"><label for="reps">Repetitions completed</label><input id="reps" type="number" min="1" max="20" step="1" value="5"></div><div class="field"><label for="unit">Weight unit</label><select id="unit"><option value="kg">kg</option><option value="lb">lb</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Estimate 1RM</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Epley estimate</span><strong id="epley">—</strong></div><div class="metric"><span>Brzycki estimate</span><strong id="brz">—</strong></div><div class="metric"><span>Midpoint estimate</span><strong id="avg">—</strong></div></div><div class="table-wrap" style="margin-top:14px"><table class="data-table"><thead><tr><th>% of midpoint 1RM</th><th>Estimated load</th></tr></thead><tbody id="loads"></tbody></table></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const w=n('weight'),r=n('reps'),u=$('unit').value;if(!Number.isFinite(w)||w<=0||!Number.isFinite(r)||r<1||r>20){$('note').textContent='Enter a positive weight and 1–20 repetitions.';$('note').className='helper danger';return;}const e=w*(1+r/30),b=r===1?w:w/(1.0278-.0278*r),a=(e+b)/2,fmt=x=>x.toFixed(1)+' '+u;$('epley').textContent=fmt(e);$('brz').textContent=fmt(b);$('avg').textContent=fmt(a);$('loads').innerHTML=[50,60,70,75,80,85,90,95].map(p=>'<tr><td>'+p+'%</td><td>'+fmt(a*p/100)+'</td></tr>').join('');$('note').textContent=(r>10?'Higher-repetition sets can make 1RM predictions less stable. ':'')+'A predicted 1RM is not the same as a directly tested maximum, and equation accuracy varies by exercise and lifter.';$('note').className='helper'+(r>10?' danger':'');}
['weight','reps','unit'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('weight').value=80;$('reps').value=5;$('unit').value='kg';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>1RM prediction formulas used</h2><p>The calculator compares two widely used equations. Epley: 1RM = weight × (1 + reps/30). Brzycki: 1RM = weight ÷ (1.0278 − 0.0278 × reps). Published research continues to compare these and other repetition-to-failure equations, and no single equation is perfect for every exercise or population.</p>
<h2>Why the tool shows two estimates</h2><p>Showing both equations makes the uncertainty visible. The midpoint is provided only as a convenient planning reference for the percentage-load table; it should not be treated as a measured maximum.</p>
<h2>Best repetition range for estimation</h2><p>Prediction generally becomes less dependable as repetitions climb. Sets near the lower repetition range are usually more useful for estimating maximal strength than very high-repetition endurance sets.</p>
<h2>Use a predicted 1RM conservatively</h2><p>Do not attempt an unsafe maximal lift merely to validate a calculator. Technique, equipment, fatigue, exercise selection and training experience all affect the relationship between a submaximal set and true 1RM.</p>
<h2>Use submaximal estimates safely</h2><p>One-rep-max equations are most useful when the test set is performed with sound technique and a moderate repetition count. Accuracy generally worsens as repetitions become very high or fatigue changes movement quality. Different exercises and athletes can also fit different equations. Use the result to plan approximate training percentages, then adjust loads based on actual performance, bar speed, repetitions in reserve and coaching guidance rather than forcing a predicted maximum.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What formulas does the 1RM calculator use?','It shows the Epley and Brzycki prediction equations and also displays their midpoint for percentage-load planning.'],['Why are the two 1RM estimates different?','They were derived using different mathematical relationships between repetitions and load. Their accuracy varies by exercise and individual.'],['Are high-repetition sets good for predicting 1RM?','They are generally less reliable for maximal-strength prediction. The tool flags sets above 10 reps as a higher-uncertainty estimate.'],['Is a predicted 1RM safe to test directly?','Not necessarily. A calculator cannot assess technique, injury risk or readiness. Direct maximal testing should only be performed when appropriate and safely supervised.']];
require __DIR__.'/../includes/tool-template.php';
