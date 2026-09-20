<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('government-ngos','impact-indicator-ratio-calculator');
ob_start();
?>
<h2>Calculate an impact indicator ratio</h2><p class="lead">Standardize a numerator against a population or exposure denominator and compare the result with an optional target rate.</p>
<div class="form-grid"><div class="field"><label for="num">Indicator numerator</label><input id="num" type="number" min="0" step="any" value="85"></div><div class="field"><label for="den">Denominator / eligible population</label><input id="den" type="number" min="0" step="any" value="1000"></div><div class="field"><label for="base">Report rate per</label><select id="base"><option value="100">100</option><option value="1000" selected>1,000</option><option value="10000">10,000</option><option value="100000">100,000</option></select></div><div class="field"><label for="target">Target rate on same base (optional)</label><input id="target" type="number" min="0" step="any" value="100"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate indicator</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Indicator rate</span><strong id="rate">—</strong></div><div class="metric"><span>Raw proportion</span><strong id="prop">—</strong></div><div class="metric"><span>Gap to target</span><strong id="gap">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function go(){const a=n('num'),d=n('den'),b=n('base'),t=n('target');if(![a,d,b].every(Number.isFinite)||a<0||d<=0||b<=0){$('note').textContent='Enter a non-negative numerator and positive denominator/base.';$('note').className='helper danger';return;}const p=a/d,r=p*b;$('rate').textContent=r.toFixed(2)+' per '+b.toLocaleString();$('prop').textContent=(p*100).toFixed(2)+'%';$('gap').textContent=Number.isFinite(t)?(r-t).toFixed(2):'—';$('note').textContent='A rate is only comparable when numerator definition, denominator eligibility, geography and reporting period are aligned.';$('note').className='helper';}
['num','den','base','target'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('num').value=85;$('den').value=1000;$('base').value=1000;$('target').value=100;go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Impact indicator ratio formula</h2><p>Indicator rate = numerator ÷ denominator × reporting base. The base simply changes how the same proportion is expressed—for example, 8.5% is 85 per 1,000.</p>
<h2>Choose a denominator that matches the indicator</h2><p>The denominator should represent the population or exposure actually eligible to produce the numerator. A broad denominator can make a rate look artificially low; a narrow one can make it look high.</p>
<h2>Comparing to a target</h2><p>The target must use the same reporting base and definition. A positive gap in this calculator means the observed rate is above the entered target; whether that is desirable depends on what the indicator represents.</p>
<h2>Rates do not prove causation</h2><p>A change in an indicator can reflect program activity, population mix, external conditions, measurement changes or random variation. Use the ratio as one reporting measure, not a standalone causal conclusion.</p>
<h2>Do not let a ratio replace the indicator definition</h2><p>An impact or performance ratio is only as credible as its numerator and denominator. State who is eligible, the measurement period, data source, missing-data treatment and whether the indicator is an output, outcome or longer-term impact measure. When a target is used, document whether higher or lower is better before interpreting variance. For public reporting, retain the underlying counts so reviewers can understand scale and avoid being misled by percentages from small samples.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I calculate a rate per 1,000?','Divide the numerator by the denominator and multiply by 1,000.'],['Can I convert the same indicator to per 100 or per 100,000?','Yes. Changing the reporting base rescales the same underlying proportion.'],['What should the denominator represent?','The population or exposure that is actually eligible for the event or outcome measured in the numerator.'],['Does an indicator ratio prove program impact?','No. It describes a rate; causal impact requires additional evidence and study design.']];
require __DIR__.'/../includes/tool-template.php';
