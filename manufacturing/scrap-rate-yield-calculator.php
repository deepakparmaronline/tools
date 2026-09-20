<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','scrap-rate-yield-calculator');
ob_start();
?>
<h2>Calculate scrap rate and yield</h2><p class="lead">Separate permanently scrapped units from units that require rework so quality loss is easier to interpret.</p>
<div class="form-grid"><div class="field"><label for="input">Total input/processed units</label><input id="input" type="number" min="0.0001" step="any" value="10000"></div><div class="field"><label for="scrap">Scrapped units</label><input id="scrap" type="number" min="0" step="any" value="180"></div><div class="field"><label for="rework">Units requiring rework (subset of non-scrap output)</label><input id="rework" type="number" min="0" step="any" value="320"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Scrap rate</span><strong id="sr">—</strong></div><div class="metric"><span>Non-scrap yield</span><strong id="yield">—</strong></div><div class="metric"><span>Rework incidence</span><strong id="rr">—</strong></div><div class="metric"><span>Units not scrapped</span><strong id="good">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const i=+$('input').value,s=+$('scrap').value,r=+$('rework').value;if(!(i>0&&s>=0&&r>=0&&s<=i&&r<=i-s)){['sr','yield','rr','good'].forEach(id=>$(id).textContent='—');$('note').textContent='Scrap cannot exceed input and rework cannot exceed the non-scrapped quantity.';$('note').className='helper danger';return}$('sr').textContent=(s/i*100).toFixed(2)+'%';$('yield').textContent=((i-s)/i*100).toFixed(2)+'%';$('rr').textContent=(r/i*100).toFixed(2)+'%';$('good').textContent=(i-s).toLocaleString();$('note').textContent='Non-scrap yield does not mean first-pass good yield when reworked units are included. Use FPY when first-time success is the KPI.';$('note').className='helper'}['input','scrap','rework'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Scrap rate formula</h2><p><strong>Scrap rate = scrapped units ÷ total processed/input units × 100</strong>. The simple non-scrap yield shown here is the complement: units not scrapped divided by input. Keep physical-count boundaries consistent so components, pieces and finished units are not mixed.</p>
<h2>Rework is not the same as scrap</h2><p>Scrap represents output that is not recovered into conforming product under the measurement definition. Rework can consume capacity and cost while eventually preserving the unit, so this calculator reports rework incidence separately.</p>
<h2>Yield versus First Pass Yield</h2><p>A 98% non-scrap yield can hide extensive rework. First Pass Yield counts only units that meet requirements the first time. Use both when you need to separate permanent material loss from the hidden factory of repair and retest.</p>
<h2>Measure cost as well as unit count</h2><p>Unit-based scrap percentages can understate financial impact when high-value products fail disproportionately. Pair scrap units with material/labor value, defect cause, process step and disposition. Weight-based or cost-based scrap may be more useful for some continuous or mixed-value operations.</p>
<h2>Normalize scrap to the decision you are making</h2><p>Unit scrap is intuitive for discrete production, but weight, material cost or conversion value may be better for processes where units differ greatly in size or value. Keep numerator and denominator on the same basis and prevent reused/regrind material from being counted inconsistently. A good scrap dashboard often shows both physical loss and financial loss so teams can distinguish frequent low-cost defects from rarer high-cost failures.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is scrap rate calculated?','Scrap units divided by total processed/input units, multiplied by 100.'],['Is yield always 100% minus scrap rate?','For this simple non-scrap unit measure, yes. Other yield definitions such as FPY can be lower because they exclude rework.'],['Should reworked units count as scrap?','Not if they are recoverable and your definitions treat rework separately. Use a consistent disposition rule.'],['Can I calculate scrap by weight or cost instead?','Yes, but use the same basis in numerator and denominator. This calculator is labeled in units but the percentage arithmetic also works for consistent weight/cost quantities.']];
require __DIR__.'/../includes/tool-template.php';
