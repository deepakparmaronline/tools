<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('fitness-sports','exercise-calorie-burn-calculator');
ob_start();
?>
<h2>Estimate calories burned during exercise</h2><p class="lead">Use body weight, activity intensity in METs and exercise duration to estimate energy expenditure.</p>
<div class="form-grid"><div class="field"><label for="weight">Body weight (kg)</label><input id="weight" type="number" min="0" step="any" value="70"></div><div class="field"><label for="met">Activity intensity (MET)</label><input id="met" type="number" min="0" step="any" value="6"><small>Use a researched MET value for the activity and intensity you performed.</small></div><div class="field"><label for="mins">Duration (minutes)</label><input id="mins" type="number" min="0" step="any" value="45"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Estimate calories</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Estimated energy</span><strong id="kcal">—</strong></div><div class="metric"><span>Calories per minute</span><strong id="permin">—</strong></div><div class="metric"><span>MET-minutes</span><strong id="metmin">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const w=n('weight'),m=n('met'),t=n('mins');if(![w,m,t].every(Number.isFinite)||w<=0||m<=0||t<0){$('note').textContent='Enter positive body weight and MET value, plus a non-negative duration.';$('note').className='helper danger';return;}const per=m*3.5*w/200,k=per*t;$('kcal').textContent=k.toFixed(0)+' kcal';$('permin').textContent=per.toFixed(2)+' kcal/min';$('metmin').textContent=(m*t).toFixed(0);$('note').textContent='MET-based calorie estimates are population averages. Individual energy expenditure varies with fitness, body composition, movement efficiency, environment and measurement error.';$('note').className='helper';}
['weight','met','mins'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('weight').value=70;$('met').value=6;$('mins').value=45;go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Exercise calorie formula</h2><p>This calculator uses the common MET equation: calories per minute = MET × 3.5 × body weight in kilograms ÷ 200. Multiplying that value by exercise duration gives the estimated total calories.</p>
<h2>What is a MET?</h2><p>A metabolic equivalent (MET) expresses the energy cost of an activity relative to a standard resting reference. The Compendium of Physical Activities explains that standard MET values are useful for classifying activity intensity but were not created to predict an individual person’s exact energy cost. <a href="https://pacompendium.com/corrected-mets/" target="_blank" rel="noopener">Compendium MET guidance</a>.</p>
<h2>Choose the activity MET carefully</h2><p>Walking, cycling, swimming and gym exercises can have very different MET values depending on speed, resistance and technique. A generic activity label can therefore produce a broad estimate. Use the closest researched intensity rather than assuming every version of an activity has the same MET.</p>
<h2>Why wearable calories can differ</h2><p>Wearables may combine heart rate, motion sensors and proprietary models, while this tool uses only weight, MET and time. Neither method should be treated as laboratory-grade calorimetry.</p>
<h2>Why actual calorie burn can differ</h2><p>MET values are population-level activity estimates. Actual energy expenditure varies with movement economy, terrain, temperature, body composition, fitness, equipment and how intensely the activity is performed. Machine displays and wearable estimates can also use proprietary assumptions. For training logs, the most useful practice is to apply one consistent method and focus on trends rather than treating a single calorie estimate as laboratory measurement.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does MET mean?','MET stands for metabolic equivalent. It is a standardized way to describe activity energy cost relative to a resting reference.'],['What formula is used for calories burned?','Estimated kcal per minute = MET × 3.5 × body weight in kg ÷ 200; that value is multiplied by minutes exercised.'],['Why does the result differ from my smartwatch?','A smartwatch may use heart rate, motion sensors and its own model. This calculator uses a simpler MET-based population estimate.'],['Is the calorie result exact?','No. It is an estimate and can differ from an individual’s true energy expenditure.']];
require __DIR__.'/../includes/tool-template.php';
