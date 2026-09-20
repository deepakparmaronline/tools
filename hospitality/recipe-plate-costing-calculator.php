<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','recipe-plate-costing-calculator');ob_start(); ?>
<h2>Cost a recipe from ingredient usage</h2>
<p class="lead">Enter one ingredient per line using: Name | quantity used | package quantity | package price.</p>
<div class="form-grid"><div class="field full"><label for="lines">Ingredients</label><textarea id="lines">Chicken | 2 | 5 | 1500
Rice | 1.5 | 10 | 800
Sauce | 0.5 | 2 | 500</textarea><small>Use the same unit for quantity used and package quantity within each line.</small></div><div class="field"><label for="servings">Recipe servings</label><input id="servings" type="number" value="10" step="0.01" min="0.000001"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate Recipe</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Valid ingredients</span><strong id="ingredients">—</strong></div><div class="metric"><span>Recipe batch cost</span><strong id="batch">—</strong></div><div class="metric"><span>Cost per serving</span><strong id="serving">—</strong></div><div class="metric"><span>Skipped lines</span><strong id="invalid">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const rows=$('lines').value.split(/\r?\n/).filter(x=>x.trim()),serv=num('servings');let total=0,valid=0,bad=0;for(const row of rows){const p=row.split('|').map(x=>x.trim());if(p.length<4){bad++;continue;}const used=parseFloat(p[1]),pack=parseFloat(p[2]),price=parseFloat(p[3]);if(![used,pack,price].every(Number.isFinite)||used<0||pack<=0||price<0){bad++;continue;}total+=(used/pack)*price;valid++;}if(serv<=0){note('Servings must be greater than zero.',true);return;}$('ingredients').textContent=valid;$('batch').textContent=money(total,'');$('serving').textContent=money(total/serv,'');$('invalid').textContent=bad;note(bad?`${bad} line(s) were skipped because their format or numbers were invalid.`:'All non-empty ingredient lines were included.',bad>0);} $('lines').addEventListener('input',go);
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>Each ingredient cost is calculated as quantity used ÷ package quantity × package price. The recipe batch cost is the sum of valid ingredient costs, and plate or serving cost divides that batch total by the number of servings.</p><h2>How to use the result</h2><p>Use package sizes and prices from current purchasing data, then update the recipe whenever yield, portion size or supplier price changes. The line format makes it easy to paste a compact recipe without uploading a file.</p><h2>Assumptions and limitations</h2><p>The calculator assumes units are consistent within each ingredient line. It does not convert kilograms to grams or litres to millilitres automatically. It also excludes labor, utilities, packaging and waste unless reflected in the entered quantities or prices.</p><h2>Example</h2><p>For an ingredient where 2 kg is used from a 5 kg package costing 1,500, the recipe consumes 600 of that ingredient's package cost.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Can different ingredients use different units?','Yes, as long as quantity used and package quantity on each individual line use the same unit.'],['Does the tool convert grams to kilograms?','No. Convert quantities to a common unit within each line before entering them.'],['What happens to a malformed line?','It is skipped and counted in the skipped-lines result so you can correct it.'],['Does recipe cost include labor?','No. This calculator focuses on ingredient usage; add labor and overhead separately if needed.']];require __DIR__.'/../includes/tool-template.php';
