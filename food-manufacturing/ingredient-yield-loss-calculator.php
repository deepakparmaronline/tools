<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('food-manufacturing','ingredient-yield-loss-calculator');
ob_start();
?>
<h2>Calculate ingredient yield and loss</h2><p class="lead">Track how trim, cooking or processing loss changes usable weight and the real cost of an ingredient.</p>
<div class="form-grid"><div class="field"><label for="ap">As-purchased weight (kg)</label><input id="ap" type="number" min="0" step="any" value="10"></div><div class="field"><label for="trim">Trim / prep loss (%)</label><input id="trim" type="number" min="0" max="100" step="any" value="12"></div><div class="field"><label for="cook">Cooking / process loss after trim (%)</label><input id="cook" type="number" min="0" max="100" step="any" value="18"></div><div class="field"><label for="cost">As-purchased cost</label><input id="cost" type="number" min="0" step="any" value="50"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" maxlength="6" value="$"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate yield</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Finished usable weight</span><strong id="usable">—</strong></div><div class="metric"><span>Overall yield</span><strong id="yield">—</strong></div><div class="metric"><span>Overall loss</span><strong id="loss">—</strong></div><div class="metric"><span>Effective cost / usable kg</span><strong id="unitcost">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const ap=n('ap'),trim=n('trim'),cook=n('cook'),cost=n('cost'),c=$('currency').value||'';if(![ap,trim,cook,cost].every(Number.isFinite)||ap<=0||trim<0||trim>=100||cook<0||cook>=100||cost<0){$('note').textContent='Enter positive purchased weight and loss percentages below 100%.';$('note').className='helper danger';return;}const afterTrim=ap*(1-trim/100),usable=afterTrim*(1-cook/100),y=usable/ap*100;$('usable').textContent=usable.toFixed(3)+' kg';$('yield').textContent=y.toFixed(2)+'%';$('loss').textContent=(100-y).toFixed(2)+'%';$('unitcost').textContent=c+(cost/usable).toFixed(2)+'/kg';$('note').textContent='Sequential losses compound: a 10% trim loss followed by a 10% cook loss produces 81% overall yield, not 80%.';$('note').className='helper';}
['ap','trim','cook','cost','currency'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('ap').value=10;$('trim').value=12;$('cook').value=18;$('cost').value=50;$('currency').value='$';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Ingredient yield formula</h2><p>Yield is finished usable weight divided by as-purchased weight. This calculator applies trim loss first and process/cooking loss second, which reflects the fact that the second loss acts on the reduced weight rather than the original weight.</p>
<h2>Why yield changes true ingredient cost</h2><p>If 10 kg of material costs $50 but only 7 kg becomes usable product, the effective ingredient cost is based on $50 divided by 7 kg, not $50 divided by the purchased 10 kg.</p>
<h2>Use measured production data</h2><p>For food manufacturing, recipe costing and process improvement, replace generic loss percentages with your own recorded yields by ingredient, supplier, batch size and process. Moisture loss and trim can vary materially.</p>
<h2>Food-safety limitation</h2><p>This tool performs mass and cost calculations only. It does not determine cooking temperatures, shelf life, HACCP controls, allergen handling or regulatory compliance.</p>
<h2>Connect yield loss to purchasing and recipe cost</h2><p>Yield percentage affects more than production reporting. If 100 kg of raw material produces only 82 kg of usable ingredient, purchasing plans and recipe cost should be based on the usable yield rather than the invoice weight alone. Track yield by supplier, lot, season and preparation method when those factors matter. Separating trim, moisture loss, spoilage and process loss can reveal whether the best improvement opportunity is procurement, storage, cutting, cooking or handling.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is ingredient yield calculated?','Overall yield is finished usable weight divided by as-purchased weight, multiplied by 100.'],['Why are trim and cooking losses applied sequentially?','Cooking or processing loss usually occurs after trimming, so the second percentage applies to the remaining weight rather than the original purchased weight.'],['What is effective cost per usable kilogram?','It is the full as-purchased ingredient cost divided by the finished usable weight.'],['Can this calculator determine food safety requirements?','No. It only calculates yield and cost. Food-safety controls require separate validated procedures and applicable regulatory guidance.']];
require __DIR__.'/../includes/tool-template.php';
