<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('data-analysis','ab-test-significance-calculator');
ob_start();
?>

<h2>Compare two conversion rates with a two-proportion z-test</h2>
<p class="lead">Enter visitors and conversions for variants A and B to estimate conversion rates, relative lift, a two-sided p-value and a confidence interval for the absolute rate difference.</p>
<div class="form-grid">
  <div class="field"><label for="nA">Variant A visitors</label><input id="nA" type="number" value="1000" min="1" step="1"></div>
  <div class="field"><label for="xA">Variant A conversions</label><input id="xA" type="number" value="100" min="0" step="1"></div>
  <div class="field"><label for="nB">Variant B visitors</label><input id="nB" type="number" value="1000" min="1" step="1"></div>
  <div class="field"><label for="xB">Variant B conversions</label><input id="xB" type="number" value="120" min="0" step="1"></div>
  <div class="field"><label for="alpha">Significance level</label><select id="alpha"><option value="0.10">10% (90% confidence)</option><option value="0.05" selected>5% (95% confidence)</option><option value="0.01">1% (99% confidence)</option></select></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Analyze test</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box">
  <div class="result-grid">
    <div class="metric"><span>Conversion rate A</span><strong id="rateA">—</strong></div>
    <div class="metric"><span>Conversion rate B</span><strong id="rateB">—</strong></div>
    <div class="metric"><span>Relative lift B vs A</span><strong id="lift">—</strong></div>
    <div class="metric"><span>z statistic</span><strong id="z">—</strong></div>
    <div class="metric"><span>Two-sided p-value</span><strong id="pvalue">—</strong></div>
    <div class="metric"><span>Statistical result</span><strong id="sig">—</strong></div>
  </div>
  <div id="ci" class="helper" style="margin-top:12px"></div>
  <div id="note" class="helper" style="margin-top:8px"></div>
</div>
<script>
(()=>{
const $=id=>document.getElementById(id), num=id=>parseFloat($(id).value);
const erf=x=>{const s=x<0?-1:1,a=Math.abs(x),t=1/(1+0.3275911*a);const y=1-(((((1.061405429*t-1.453152027)*t+1.421413741)*t-0.284496736)*t+0.254829592)*t)*Math.exp(-a*a);return s*y;};
const normCDF=x=>(1+erf(x/Math.sqrt(2)))/2;
const zcrit={0.10:1.64485362695147,0.05:1.95996398454005,0.01:2.5758293035489};
function go(){
 const nA=num('nA'),xA=num('xA'),nB=num('nB'),xB=num('xB'),alpha=num('alpha');
 if(![nA,xA,nB,xB,alpha].every(Number.isFinite)||nA<=0||nB<=0||xA<0||xB<0||xA>nA||xB>nB){$('note').textContent='Conversions must be between 0 and the visitor count for each variant.';return;}
 const pA=xA/nA,pB=xB/nB,pool=(xA+xB)/(nA+nB);
 const sePool=Math.sqrt(pool*(1-pool)*(1/nA+1/nB));
 const z=sePool>0?(pB-pA)/sePool:0;
 const pv=sePool>0?2*(1-normCDF(Math.abs(z))):1;
 const seDiff=Math.sqrt(pA*(1-pA)/nA+pB*(1-pB)/nB),zc=zcrit[alpha]||1.95996398454005;
 const low=(pB-pA)-zc*seDiff,high=(pB-pA)+zc*seDiff;
 $('rateA').textContent=(pA*100).toFixed(2)+'%';$('rateB').textContent=(pB*100).toFixed(2)+'%';
 $('lift').textContent=pA>0?(((pB/pA)-1)*100).toFixed(2)+'%':'Not defined';
 $('z').textContent=z.toFixed(3);$('pvalue').textContent=pv<0.0001?'< 0.0001':pv.toFixed(4);
 $('sig').textContent=pv<alpha?'Statistically significant':'Not statistically significant';
 $('ci').textContent=`${Math.round((1-alpha)*100)}% CI for B − A: ${(low*100).toFixed(2)} to ${(high*100).toFixed(2)} percentage points.`;
 const expected=[nA*pool,nA*(1-pool),nB*pool,nB*(1-pool)];
 $('note').textContent=(expected.some(v=>v<5)?'Small expected counts detected; the normal approximation may be unreliable. ':'')+'Statistical significance does not measure business value and does not correct for peeking, multiple comparisons, seasonality or biased assignment.';
}
$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=1;else el.value=el.defaultValue;});go();});
['nA','xA','nB','xB','alpha'].forEach(id=>$(id).addEventListener('input',go));go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>What this A/B test significance calculator measures</h2>
<p>This calculator compares two independent conversion proportions using a pooled two-proportion z-test. It is useful for experiments such as landing-page, checkout, email or product-flow tests when each visitor is assigned to one variant and the outcome is binary, such as converted or did not convert.</p>
<h3>How the calculation works</h3>
<p>For each variant, conversion rate equals conversions divided by visitors. Under the null hypothesis that both variants have the same true rate, the test pools the two samples to estimate a common conversion probability. The observed rate difference is divided by its pooled standard error to obtain a z statistic. The calculator reports a two-sided p-value because either variant could outperform the other.</p>
<h3>How to interpret the result</h3>
<p>A p-value below the selected significance level means the observed difference would be relatively unusual under the equal-rate null model. It does not prove that B is better, estimate the probability that a hypothesis is true, or tell you whether the lift is economically important. Review the absolute difference, confidence interval, sample quality and experiment design together.</p>
<h3>When not to rely on the z-test</h3>
<p>The normal approximation can be weak with small expected counts. Repeatedly checking a test and stopping as soon as it becomes significant can also inflate false positives. Sequential tests, multiple variants, repeated users and clustered observations may require a different statistical design.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['What is a good p-value for an A/B test?','A commonly chosen threshold is 0.05, but the significance level should be selected before evaluating the experiment and should reflect the cost of false positives.'],['Does statistical significance mean the winning variant is worth launching?','No. Statistical significance and practical value are different. Consider the confidence interval, absolute lift, revenue or cost impact, implementation risk and test quality.'],['Why does the calculator show a small-sample warning?','The two-proportion z-test relies on a normal approximation. Very small expected success or failure counts can make that approximation unreliable.'],['Can I use this calculator for the same users measured twice?','Not as a simple independent-samples test. Paired or repeated observations violate the independence assumption and normally need a paired or repeated-measures method.']];
require __DIR__.'/../includes/tool-template.php';
