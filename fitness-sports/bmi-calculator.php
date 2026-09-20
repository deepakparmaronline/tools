<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('fitness-sports','bmi-calculator');
ob_start();
?>
<h2>Calculate adult BMI</h2><p class="lead">Enter height and weight to calculate body mass index (BMI). This tool is intended for adults age 20+ and is a screening calculation, not a diagnosis.</p>
<div class="form-grid"><div class="field"><label for="unit">Units</label><select id="unit"><option value="metric">Metric (kg, cm)</option><option value="us">US (lb, ft/in)</option></select></div><div class="field"><label for="weight">Weight</label><input id="weight" type="number" min="0" step="any" value="70"></div><div class="field"><label for="height">Height (cm or total inches)</label><input id="height" type="number" min="0" step="any" value="175"><small>For US units, enter total inches (for example 69).</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate BMI</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>BMI</span><strong id="bmi">—</strong></div><div class="metric"><span>Adult BMI category</span><strong id="cat">—</strong></div><div class="metric"><span>Height in metres</span><strong id="hm">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function category(b){return b<18.5?'Underweight':b<25?'Healthy weight':b<30?'Overweight':b<35?'Obesity class 1':b<40?'Obesity class 2':'Obesity class 3'}function go(){const u=$('unit').value,w=n('weight'),h=n('height');if(!Number.isFinite(w)||!Number.isFinite(h)||w<=0||h<=0){$('note').textContent='Enter a positive height and weight.';$('note').className='helper danger';return;}const kg=u==='metric'?w:w*0.45359237,m=u==='metric'?h/100:h*0.0254,b=kg/(m*m);$('bmi').textContent=b.toFixed(1);$('cat').textContent=category(b);$('hm').textContent=m.toFixed(3)+' m';$('note').textContent='CDC describes adult BMI as a screening measure that should be considered alongside other health information. It does not directly measure body fat or diagnose a condition.';$('note').className='helper';}
['unit','weight','height'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('unit').value='metric';$('weight').value=70;$('height').value=175;go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>BMI formula for adults</h2><p>BMI = weight in kilograms ÷ height in metres squared. For US measurements, pounds and inches are converted to metric before the same formula is applied.</p>
<h2>Adult BMI categories</h2><p>For adults age 20 and older, the CDC lists categories of below 18.5, 18.5 to under 25, 25 to under 30, and 30 or above, with obesity further divided into classes. The calculator uses those thresholds. <a href="https://www.cdc.gov/bmi/adult-calculator/bmi-categories.html" target="_blank" rel="noopener">CDC adult BMI categories</a>.</p>
<h2>What BMI can and cannot tell you</h2><p>BMI is useful for population-level and screening contexts because it is quick and consistent. It does not distinguish muscle from fat, does not measure fat distribution, and should not be used by itself to diagnose health status.</p>
<h2>Who should not rely on this adult calculator</h2><p>This page is not designed for children or teenagers, pregnancy-specific assessment, or clinical decision-making. Athletes with high muscularity and people with unusual body composition may also find BMI less representative.</p>
<h2>Use BMI as one part of a broader assessment</h2><p>BMI is useful for population screening because it standardizes weight for height, but it does not directly measure body fat, muscle mass, fat distribution or metabolic health. Athletes, older adults, pregnant people and some population groups may need additional context. If a BMI result is being used for a health decision rather than general information, combine it with clinical history and measurements chosen by a qualified health professional.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is the BMI formula?','BMI is weight in kilograms divided by height in metres squared.'],['What BMI range does the CDC call healthy weight for adults?','For adults age 20 and older, the CDC lists 18.5 to less than 25 as the healthy-weight BMI range.'],['Does BMI measure body fat percentage?','No. BMI is based only on height and weight and does not directly measure body fat or distinguish fat mass from muscle mass.'],['Can this calculator diagnose a health condition?','No. BMI is a screening measure, not a diagnosis. Health questions should be discussed with a qualified healthcare professional.']];
require __DIR__.'/../includes/tool-template.php';
