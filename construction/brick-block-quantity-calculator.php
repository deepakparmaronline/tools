<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','brick-block-quantity-calculator');
ob_start();
?>
<h2>Estimate brick or block quantity</h2>
<p class="lead">Calculate masonry units from net wall area, unit face dimensions, mortar joint and a wastage allowance.</p>
<div class="form-grid"><div class="field"><label for="length">Wall length (m)</label><input id="length" type="number" value="10" min="0" step="any"></div><div class="field"><label for="height">Wall height (m)</label><input id="height" type="number" value="3" min="0" step="any"></div><div class="field"><label for="openings">Doors/windows area (m²)</label><input id="openings" type="number" value="4" min="0" step="any"></div><div class="field"><label for="unitL">Brick/block length (mm)</label><input id="unitL" type="number" value="200" min="1" step="any"></div><div class="field"><label for="unitH">Brick/block height (mm)</label><input id="unitH" type="number" value="100" min="1" step="any"></div><div class="field"><label for="joint">Mortar joint (mm)</label><input id="joint" type="number" value="10" min="0" step="any"></div><div class="field"><label for="waste">Wastage (%)</label><input id="waste" type="number" value="5" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Net wall area</span><strong id="net">—</strong></div><div class="metric"><span>Base units</span><strong id="base">—</strong></div><div class="metric"><span>Units incl. wastage</span><strong id="total">—</strong></div><div class="metric"><span>Allowance units</span><strong id="wasteQty">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const L=n('length'),H=n('height'),o=n('openings'),uL=n('unitL')/1000,uH=n('unitH')/1000,j=n('joint')/1000,w=n('waste')/100;if(![L,H,o,uL,uH,j,w].every(Number.isFinite)||L<0||H<0||o<0||uL<=0||uH<=0||j<0||w<0){note('Check wall, unit and wastage dimensions.',true);return;}const gross=L*H,net=Math.max(0,gross-o),module=(uL+j)*(uH+j),base=net/module,total=Math.ceil(base*(1+w));$('net').textContent=fmt(net,2)+' m²';$('base').textContent=Math.ceil(base).toLocaleString();$('total').textContent=total.toLocaleString();$('wasteQty').textContent=Math.max(0,total-Math.ceil(base)).toLocaleString();note('Count is based on exposed wall face area and module dimensions. Wall thickness, bond pattern, cuts and local brick dimensions can change actual quantity.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('length')?.addEventListener('input',go);$('length')?.addEventListener('change',go);$('height')?.addEventListener('input',go);$('height')?.addEventListener('change',go);$('openings')?.addEventListener('input',go);$('openings')?.addEventListener('change',go);$('unitL')?.addEventListener('input',go);$('unitL')?.addEventListener('change',go);$('unitH')?.addEventListener('input',go);$('unitH')?.addEventListener('change',go);$('joint')?.addEventListener('input',go);$('joint')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the brick / block quantity calculator works</h2><p>Net wall area equals wall length multiplied by height minus openings. The calculator divides that area by the face module of one masonry unit, including the entered mortar joint, then adds wastage.</p><h2>Where this construction calculation helps</h2><p>Use the estimate for early material takeoffs, comparing block formats or checking supplier quantities for straightforward walls.</p><h2>Measurements and assumptions</h2><p>Measure the unit face that appears in the wall, not the thickness. Bond pattern, corners, piers, lintels, cuts and broken units can increase real usage. Openings should include doors, windows and other voids that genuinely reduce masonry area.</p><h2>Worked example</h2><p>A 10 m × 3 m wall with 4 m² of openings has 26 m² net area. Using a 200 × 100 mm unit with 10 mm joints gives a planning count before wastage.</p>
<h3>Allow for openings, mortar joints and site waste</h3>
<p>A brick or block quantity calculator converts wall dimensions and masonry unit size into an estimating quantity, but drawings and site conditions still matter. Deduct doors, windows and other large openings where appropriate, confirm whether the entered unit size includes the intended mortar joint, and apply a reasonable waste allowance for cutting, breakage and handling. Special bond patterns, piers, returns and nonstandard blocks can increase consumption. Use the result for preliminary material planning and verify final quantities against construction drawings and supplier pack sizes.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Does wall thickness affect the count?','For a single-leaf wall, quantity is driven mainly by the unit face area. Multi-leaf or thicker masonry systems need separate layers or a volume-based takeoff.'],['Should mortar joints be included?','Yes. Adding the joint to module dimensions prevents overestimating the number of units in a fixed wall area.'],['How much wastage should I use?','Use a project-specific allowance based on cuts, handling, unit type and site conditions rather than relying on one universal percentage.'],['Does the tool calculate mortar?','No. It estimates brick/block quantity only.']];
require __DIR__.'/../includes/tool-template.php';
