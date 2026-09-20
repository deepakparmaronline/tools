<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('automotive','fuel-economy-calculator');
ob_start();
?>
<h2>Convert fuel economy units</h2>
<p class="lead">Enter one fuel-economy measure and convert it instantly to L/100 km, km/L, US MPG and Imperial MPG.</p>
<div class="form-grid">
<div class="field"><label for="value">Fuel economy value</label><input id="value" type="number" step="any" min="0.000001" value="6.5"></div>
<div class="field"><label for="from">Input unit</label><select id="from"><option value="l100">L/100 km</option><option value="kml">km/L</option><option value="mpgus">MPG (US)</option><option value="mpgimp">MPG (Imperial)</option></select></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Convert</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid">
<div class="metric"><span>L/100 km</span><strong id="l100">—</strong></div>
<div class="metric"><span>km/L</span><strong id="kml">—</strong></div>
<div class="metric"><span>MPG (US)</span><strong id="mpgus">—</strong></div>
<div class="metric"><span>MPG (Imperial)</span><strong id="mpgimp">—</strong></div>
</div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);const note=(m,b=false)=>{const e=$('note');e.textContent=m;e.className='helper'+(b?' danger':'');};
function go(){const v=parseFloat($('value').value);if(!Number.isFinite(v)||v<=0){note('Enter a fuel-economy value greater than zero.',true);return;}let l100;switch($('from').value){case'l100':l100=v;break;case'kml':l100=100/v;break;case'mpgus':l100=235.214583/v;break;case'mpgimp':l100=282.480936/v;break;}const fmt=n=>n.toLocaleString(undefined,{maximumFractionDigits:3});$('l100').textContent=fmt(l100);$('kml').textContent=fmt(100/l100);$('mpgus').textContent=fmt(235.214583/l100);$('mpgimp').textContent=fmt(282.480936/l100);note('US and Imperial gallons are different sizes, so their MPG values are not interchangeable.');}
$('calc').addEventListener('click',go);$('value').addEventListener('input',go);$('from').addEventListener('change',go);$('reset').addEventListener('click',()=>{$('value').value='6.5';$('from').value='l100';go();});go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Fuel economy calculator and converter</h2><p>This fuel economy calculator converts between the four units drivers most often encounter. L/100 km measures fuel consumed for a fixed distance, while km/L and MPG measure distance travelled for a fixed amount of fuel. Because one is an inverse measure of the others, doubling km/L does not simply double L/100 km.</p>
<h2>US MPG vs Imperial MPG</h2><p>A US gallon and an Imperial gallon are different volumes. That means the same vehicle produces a higher numerical Imperial MPG than US MPG. The converter uses standard litre-per-gallon conversion constants so the two values remain distinct.</p>
<h2>Real-world fuel economy</h2><p>Official test-cycle fuel economy and actual road consumption can differ because of traffic, speed, temperature, load, tyre pressure, driving style and accessory use. For running-cost planning, use an observed average from several fill-ups when possible.</p>
<h2>How to use the result</h2><p>Enter the unit shown on a dashboard, listing or specification sheet, then compare the equivalent units. The L/100 km value is particularly useful when calculating fuel cost over a known distance.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How do I convert L/100 km to km/L?','Divide 100 by the L/100 km value.'],['Why is Imperial MPG higher than US MPG?','An Imperial gallon is larger than a US gallon, so the same fuel consumption produces a higher Imperial MPG number.'],['Which fuel economy unit is better?','None is inherently better; use the unit standard in your market and keep the unit consistent when comparing vehicles.'],['Does this estimate real-world mileage?','It converts an entered value. Real-world fuel economy depends on operating conditions and the value you supply.']];
require __DIR__.'/../includes/tool-template.php';
