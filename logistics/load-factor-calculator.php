<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('logistics','load-factor-calculator');
ob_start();
?>
<h2>Calculate freight load factor by weight and volume</h2><p class="lead">Compare payload and cubic utilization to see whether a shipment is weight-limited or cube-limited.</p>
<div class="form-grid"><div class="field"><label for="weight">Cargo weight</label><input id="weight" type="number" min="0" step="any" value="14000"></div><div class="field"><label for="wcap">Maximum payload weight</label><input id="wcap" type="number" min="0.0001" step="any" value="20000"></div><div class="field"><label for="vol">Cargo volume</label><input id="vol" type="number" min="0" step="any" value="48"></div><div class="field"><label for="vcap">Usable cubic capacity</label><input id="vcap" type="number" min="0.0001" step="any" value="60"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Weight utilization</span><strong id="wu">—</strong></div><div class="metric"><span>Cube utilization</span><strong id="vu">—</strong></div><div class="metric"><span>Limiting utilization</span><strong id="limit">—</strong></div><div class="metric"><span>Primary constraint</span><strong id="constraint">—</strong></div></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const w=+$('weight').value,wc=+$('wcap').value,v=+$('vol').value,vc=+$('vcap').value;if(!(w>=0&&wc>0&&v>=0&&vc>0)){['wu','vu','limit','constraint'].forEach(id=>$(id).textContent='—');return}const a=w/wc*100,b=v/vc*100;$('wu').textContent=a.toFixed(1)+'%';$('vu').textContent=b.toFixed(1)+'%';$('limit').textContent=Math.max(a,b).toFixed(1)+'%';$('constraint').textContent=Math.abs(a-b)<1?'Balanced':a>b?'Weight/payload':'Volume/cube'}['weight','wcap','vol','vcap'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Weight and cube load factor</h2><p>A truck, trailer or container can run out of payload capacity before physical space, or fill its cubic space while staying below the weight limit. This calculator reports both ratios so a single utilization percentage does not hide the real constraint.</p>
<h2>Load factor formulas</h2><p><strong>Weight utilization = cargo weight ÷ allowable payload × 100</strong>. <strong>Cube utilization = cargo volume ÷ usable cubic capacity × 100</strong>. The larger percentage is shown as the limiting utilization.</p>
<h2>Usable capacity versus brochure capacity</h2><p>Enter operationally usable cube and legally/technically allowable payload, not necessarily the manufacturer's gross values. Pallet geometry, wheel wells, axle limits, load distribution, refrigeration units and stacking restrictions can make nominal capacity unusable.</p>
<h2>Interpreting a high load factor</h2><p>High utilization can reduce cost per shipped unit, but 100% theoretical cube does not mean a load can be safely packed. Validate axle weights, securing, hazardous-goods segregation, center of gravity, dimensional fit and local transport limits before dispatch.</p>
<h2>Use load factor with dimensional and legal constraints</h2><p>A shipment at 70% weight and 95% cube is operationally cube-constrained even though one metric looks underutilized. Conversely, dense freight can hit payload or axle limits with substantial empty volume. For repeat lanes, track both ratios by equipment type and product family. This can identify opportunities in packaging, pallet configuration, consolidation or equipment selection without encouraging unsafe overloading.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is freight load factor?','It is a utilization measure comparing loaded cargo with available capacity. For road/container planning, both weight and cubic capacity are useful.'],['Why can cube utilization be high while weight utilization is low?','Low-density or bulky cargo can fill the available space before reaching payload weight.'],['Should I use gross vehicle weight as payload capacity?','No. Use the allowable cargo payload after vehicle tare and other applicable constraints.'],['Does this calculator check axle or legal road limits?','No. It is a planning ratio and does not replace vehicle-specific loading and regulatory checks.']];
require __DIR__.'/../includes/tool-template.php';
