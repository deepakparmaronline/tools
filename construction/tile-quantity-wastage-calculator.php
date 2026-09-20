<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','tile-quantity-wastage-calculator');
ob_start();
?>
<h2>Estimate tile quantity, boxes and wastage</h2>
<p class="lead">Convert surface area and tile dimensions into tiles and whole boxes, including a user-selected cutting allowance.</p>
<div class="form-grid"><div class="field"><label for="area">Surface area to tile (m²)</label><input id="area" type="number" value="25" min="0" step="any"></div><div class="field"><label for="tileL">Tile length (mm)</label><input id="tileL" type="number" value="600" min="1" step="any"></div><div class="field"><label for="tileW">Tile width (mm)</label><input id="tileW" type="number" value="600" min="1" step="any"></div><div class="field"><label for="waste">Cutting/waste allowance (%)</label><input id="waste" type="number" value="10" min="0" step="any"></div><div class="field"><label for="box">Tiles per box</label><input id="box" type="number" value="4" min="1" step="1"></div><div class="field"><label for="price">Price per box (optional)</label><input id="price" type="number" value="1800" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Theoretical tiles</span><strong id="raw">—</strong></div><div class="metric"><span>Tiles incl. waste</span><strong id="tiles">—</strong></div><div class="metric"><span>Boxes required</span><strong id="boxes">—</strong></div><div class="metric"><span>Purchase quantity</span><strong id="buy">—</strong></div><div class="metric"><span>Optional box cost</span><strong id="cost">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const area=n('area'),tl=n('tileL')/1000,tw=n('tileW')/1000,wa=n('waste')/100,b=n('box'),p=n('price');if(![area,tl,tw,wa,b,p].every(Number.isFinite)||area<0||tl<=0||tw<=0||wa<0||b<=0||p<0){note('Check surface area, tile size, box quantity and waste.',true);return;}const tileArea=tl*tw,raw=area/tileArea,total=Math.ceil(raw*(1+wa)),boxes=Math.ceil(total/b),buy=boxes*b,c=$('currency').value||'';$('raw').textContent=fmt(raw,2)+' tiles';$('tiles').textContent=total+' tiles';$('boxes').textContent=boxes+' boxes';$('buy').textContent=buy+' tiles purchased';$('cost').textContent=money(boxes*p,c);note('Actual layout can require more material for diagonal patterns, large-format cuts, shade matching, breakage or future spares.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('area')?.addEventListener('input',go);$('area')?.addEventListener('change',go);$('tileL')?.addEventListener('input',go);$('tileL')?.addEventListener('change',go);$('tileW')?.addEventListener('input',go);$('tileW')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);$('box')?.addEventListener('input',go);$('box')?.addEventListener('change',go);$('price')?.addEventListener('input',go);$('price')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the tile quantity & wastage calculator works</h2><p>Theoretical tile count equals surface area divided by one tile's face area. The waste percentage is added to that count, then box quantity rounds the purchase up to full boxes.</p><h2>Where this construction calculation helps</h2><p>Use it for floors, walls and other rectangular tiling takeoffs once the total surface area is known.</p><h2>Measurements and assumptions</h2><p>Grout joints usually have a small effect on purchased tile count compared with cuts and pack rounding, so this estimator uses tile face area. Pattern, orientation, room geometry, batch matching and spare tiles can materially change the final order.</p><h2>Worked example</h2><p>Twenty-five square metres with 600 × 600 mm tiles needs about 69.4 tiles before waste. With 10% allowance that rounds to 77 tiles, then to whole boxes.</p>
<h3>Convert tiled area into boxes and spare tiles</h3>
<p>A tile quantity calculator should use the actual tile dimensions or manufacturer-stated box coverage, then add waste before rounding up to full purchasable units. Straight grid layouts in square rooms may need relatively little cutting, while diagonal patterns, niches, borders and irregular walls generate more offcuts. Also check whether grout-joint width materially changes module planning. Buying all tiles from the same lot can reduce shade variation, so it is often practical to include future repair spares in the original order rather than ordering the exact mathematical minimum.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Should grout joints be added to tile dimensions?','For purchase estimating, cuts and pack rounding usually matter more; this tool uses tile face area. Detailed layout can account for joints separately.'],['How much tile waste should I add?','Use installer or supplier guidance for the pattern, tile size and room geometry rather than one fixed percentage.'],['Why can purchased tiles exceed the waste-adjusted count?','Tiles are sold in whole boxes, so the final purchase rounds up to the next complete box.'],['Should I keep spare tiles?','Many projects keep matching spares for future repairs; add that requirement to the waste/allowance decision.']];
require __DIR__.'/../includes/tool-template.php';
