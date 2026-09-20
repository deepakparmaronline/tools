<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('data-analysis','correlation-calculator');
ob_start();
?>

<h2>Calculate Pearson and Spearman correlation</h2>
<p class="lead">Paste paired numeric observations to measure linear correlation with Pearson r and monotonic rank correlation with Spearman rho.</p>
<div class="field"><label for="pairs">Paired values (one pair per line)</label><textarea id="pairs" rows="10" placeholder="10, 15&#10;12, 17&#10;14, 21&#10;18, 24">10, 15
12, 17
14, 21
18, 24
20, 30</textarea><small>Separate X and Y with a comma, tab, semicolon or spaces.</small></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate correlation</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box">
 <div class="result-grid">
  <div class="metric"><span>Valid pairs</span><strong id="count">—</strong></div>
  <div class="metric"><span>Pearson r</span><strong id="pearson">—</strong></div>
  <div class="metric"><span>Spearman rho</span><strong id="spearman">—</strong></div>
  <div class="metric"><span>Pearson R²</span><strong id="r2">—</strong></div>
  <div class="metric"><span>Sample covariance</span><strong id="cov">—</strong></div>
 </div>
 <div id="note" class="helper" style="margin-top:12px"></div>
</div>
<script>
(()=>{
const $=id=>document.getElementById(id);
function parse(){
 return $('pairs').value.split(/\r?\n/).map(line=>line.trim()).filter(Boolean).map(line=>{
   const a=line.split(/[\s,;\t]+/).filter(Boolean).map(Number); return a.length>=2&&a.slice(0,2).every(Number.isFinite)?[a[0],a[1]]:null;
 }).filter(Boolean);
}
function ranks(vals){
 const indexed=vals.map((v,i)=>({v,i})).sort((a,b)=>a.v-b.v),out=Array(vals.length);let i=0;
 while(i<indexed.length){let j=i+1;while(j<indexed.length&&indexed[j].v===indexed[i].v)j++;const rank=(i+1+j)/2;for(let k=i;k<j;k++)out[indexed[k].i]=rank;i=j;}return out;
}
function pearson(x,y){
 const n=x.length,mx=x.reduce((a,b)=>a+b,0)/n,my=y.reduce((a,b)=>a+b,0)/n;let num=0,dx=0,dy=0;
 for(let i=0;i<n;i++){const a=x[i]-mx,b=y[i]-my;num+=a*b;dx+=a*a;dy+=b*b;}
 return {r:dx>0&&dy>0?num/Math.sqrt(dx*dy):NaN,cov:n>1?num/(n-1):NaN};
}
function go(){
 const p=parse();$('count').textContent=p.length;
 if(p.length<2){$('note').textContent='Enter at least two valid numeric pairs.';['pearson','spearman','r2','cov'].forEach(id=>$(id).textContent='—');return;}
 const x=p.map(v=>v[0]),y=p.map(v=>v[1]),a=pearson(x,y),b=pearson(ranks(x),ranks(y));
 $('pearson').textContent=Number.isFinite(a.r)?a.r.toFixed(4):'Undefined';
 $('spearman').textContent=Number.isFinite(b.r)?b.r.toFixed(4):'Undefined';
 $('r2').textContent=Number.isFinite(a.r)?(a.r*a.r).toFixed(4):'Undefined';
 $('cov').textContent=Number.isFinite(a.cov)?a.cov.toFixed(4):'—';
 $('note').textContent=!Number.isFinite(a.r)?'Pearson correlation is undefined when either variable has no variation.':'Correlation describes association, not causation. Pearson measures linear association; Spearman measures monotonic rank association.';
}
$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{$('pairs').value=$('pairs').defaultValue;go();});$('pairs').addEventListener('input',go);go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>How to use the correlation calculator</h2>
<p>Enter one X,Y pair per line. The calculator ignores blank lines and reports the number of valid pairs, Pearson's product-moment correlation coefficient, Spearman rank correlation, Pearson R² and sample covariance.</p>
<h3>Pearson r versus Spearman rho</h3>
<p>Pearson r measures the strength and direction of a linear relationship. Values range from −1 to +1 when defined. Spearman rho first converts the observations to ranks, using average ranks for ties, and then measures the correlation of those ranks. Spearman can capture monotonic relationships that are not well described by a straight line.</p>
<h3>What R² means here</h3>
<p>For a simple two-variable Pearson correlation, squaring r gives R². It describes the fraction of variance associated with the linear relationship in that simple setting. It does not establish a causal mechanism or replace regression diagnostics.</p>
<h3>Important limitations</h3>
<p>Outliers can strongly change Pearson correlation, restricted ranges can hide relationships, and combining different groups can create misleading aggregate patterns. Inspect the underlying data and its context rather than treating one coefficient as a complete analysis.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['What correlation value is considered strong?','There is no universal cutoff. The practical meaning of a correlation depends on the field, measurement quality, sample size and decision being made.'],['Why are Pearson and Spearman different?','Pearson focuses on linear association using raw values. Spearman uses ranks and therefore measures monotonic association and is less sensitive to some extreme values.'],['Can a correlation of zero mean there is no relationship?','No. A coefficient near zero can occur even when a strong nonlinear relationship exists.'],['Does correlation prove causation?','No. Correlation alone cannot distinguish direct effects from confounding, reverse causation, selection effects or coincidence.']];
require __DIR__.'/../includes/tool-template.php';
