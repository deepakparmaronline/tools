<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','concrete-volume-calculator');
ob_start();
?>
<h2>Calculate concrete volume</h2><p class="lead">Estimate concrete for slabs, footings, walls, columns or circular elements and add an explicit waste allowance.</p>
<div class="form-grid">
<div class="field"><label for="shape">Shape</label><select id="shape"><option value="rect">Rectangular prism</option><option value="cyl">Cylinder / round column</option></select></div>
<div class="field"><label for="count">Number of identical elements</label><input id="count" type="number" min="1" step="1" value="1"></div>
<div class="field"><label for="a">Length / diameter (m)</label><input id="a" type="number" min="0" step="any" value="5"></div>
<div class="field"><label for="b">Width (m, rectangular only)</label><input id="b" type="number" min="0" step="any" value="4"></div>
<div class="field"><label for="d">Depth / height (m)</label><input id="d" type="number" min="0" step="any" value="0.15"></div>
<div class="field"><label for="waste">Waste allowance (%)</label><input id="waste" type="number" min="0" step="any" value="5"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Net volume</span><strong id="net">—</strong></div><div class="metric"><span>Volume incl. waste</span><strong id="total">—</strong></div><div class="metric"><span>Cubic yards</span><strong id="yd">—</strong></div><div class="metric"><span>Litres</span><strong id="litres">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value),fmt=(v,d=3)=>v.toLocaleString(undefined,{maximumFractionDigits:d});const note=(m,b=false)=>{const e=$('note');e.textContent=m;e.className='helper'+(b?' danger':'');};
function go(){const sh=$('shape').value,a=n('a'),b=n('b'),d=n('d'),c=n('count'),w=n('waste')/100;if(![a,b,d,c,w].every(Number.isFinite)||a<0||b<0||d<0||c<=0||w<0){note('Enter non-negative dimensions, a positive count and non-negative waste.',true);return;}let v=sh==='cyl'?Math.PI*Math.pow(a/2,2)*d:a*b*d;v*=c;const t=v*(1+w);$('net').textContent=fmt(v)+' m³';$('total').textContent=fmt(t)+' m³';$('yd').textContent=fmt(t*1.30795062)+' yd³';$('litres').textContent=fmt(t*1000,0)+' L';note('Order quantities should also consider batching minimums, uneven subgrade, form tolerances and site-specific placement losses.');}
['shape','a','b','d','count','waste'].forEach(id=>$(id).addEventListener('input',go));$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{Object.assign($('shape'),{value:'rect'});$('a').value=5;$('b').value=4;$('d').value=.15;$('count').value=1;$('waste').value=5;go();});go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the concrete volume calculator works</h2><p>Rectangular volume is length × width × depth. Cylindrical volume is π × radius² × height. The element count multiplies net volume, and the waste percentage is applied afterward.</p><h2>Where this construction calculation helps</h2><p>Use it for slabs, strip footings, pads, walls, columns and other simple shapes before ordering ready-mix or estimating site batching.</p><h2>Measurements and assumptions</h2><p>Use finished internal dimensions in metres. Irregular excavations, slopes, rebates, embedded voids and uneven subgrade should be broken into smaller shapes or measured with a more detailed takeoff. Waste is project-specific.</p><h2>Worked example</h2><p>A 5 m × 4 m slab at 150 mm thick contains 3.0 m³ net concrete; adding 5% allowance gives 3.15 m³.</p><h3>Before placing an order</h3><p>Compare the calculated quantity with drawings, site measurements and supplier minimum loads. Openings, thickened edges, steps and irregular foundations may need separate calculations. Ready-mix orders are commonly placed in supplier-specific increments, so round only after confirming the delivery rules and the project's tolerance for leftover concrete.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I convert slab thickness from mm to metres?','Divide millimetres by 1,000; for example, 150 mm is 0.15 m.'],['Should I always add 5% waste?','No. Use a project-specific allowance based on placement conditions, subgrade tolerance and supplier ordering increments.'],['Can it calculate round columns?','Yes. Select the cylinder option and enter diameter and height.'],['Does reinforcement reduce concrete volume?','Rebar displacement is usually small for preliminary concrete quantity estimates, but detailed project specifications should control final orders.']];
require __DIR__.'/../includes/tool-template.php';
