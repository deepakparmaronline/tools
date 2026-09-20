<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','flooring-quantity-calculator');
ob_start();
?>
<h2>Estimate flooring quantity and packs</h2>
<p class="lead">Calculate net floor area, waste-adjusted order area, packs and optional material cost.</p>
<div class="form-grid"><div class="field"><label for="length">Room length (m)</label><input id="length" type="number" value="5" min="0" step="any"></div><div class="field"><label for="width">Room width (m)</label><input id="width" type="number" value="4" min="0" step="any"></div><div class="field"><label for="exclude">Area to exclude (m²)</label><input id="exclude" type="number" value="0" min="0" step="any"></div><div class="field"><label for="waste">Cutting/waste allowance (%)</label><input id="waste" type="number" value="8" min="0" step="any"></div><div class="field"><label for="pack">Coverage per pack/carton (m²)</label><input id="pack" type="number" value="2.2" min="0.0001" step="any"></div><div class="field"><label for="pricePack">Price per pack (optional)</label><input id="pricePack" type="number" value="2500" min="0" step="any"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Net floor area</span><strong id="net">—</strong></div><div class="metric"><span>Area incl. waste</span><strong id="order">—</strong></div><div class="metric"><span>Packs required</span><strong id="packs">—</strong></div><div class="metric"><span>Purchased coverage</span><strong id="coverage">—</strong></div><div class="metric"><span>Material cost</span><strong id="cost">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const L=n('length'),W=n('width'),ex=n('exclude'),wa=n('waste')/100,pack=n('pack'),pp=n('pricePack');if(![L,W,ex,wa,pack,pp].every(Number.isFinite)||L<0||W<0||ex<0||wa<0||pack<=0||pp<0){note('Check room size, exclusion, waste and pack coverage.',true);return;}const net=Math.max(0,L*W-ex),order=net*(1+wa),packs=Math.ceil(order/pack),coverage=packs*pack,c=$('currency').value||'';$('net').textContent=fmt(net,2)+' m²';$('order').textContent=fmt(order,2)+' m²';$('packs').textContent=packs+' packs';$('coverage').textContent=fmt(coverage,2)+' m²';$('cost').textContent=money(packs*pp,c);note('Pattern matching, plank direction, room shape and minimum supplier pack quantities can increase real waste.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('length')?.addEventListener('input',go);$('length')?.addEventListener('change',go);$('width')?.addEventListener('input',go);$('width')?.addEventListener('change',go);$('exclude')?.addEventListener('input',go);$('exclude')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);$('pack')?.addEventListener('input',go);$('pack')?.addEventListener('change',go);$('pricePack')?.addEventListener('input',go);$('pricePack')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the flooring quantity calculator works</h2><p>Net floor area is room length × width minus any excluded area. The tool adds a cutting/waste percentage, divides by pack coverage and rounds up to whole packs.</p><h2>Where this construction calculation helps</h2><p>Use it for laminate, vinyl planks, engineered timber, carpet tiles or other products sold by pack coverage.</p><h2>Measurements and assumptions</h2><p>Irregular rooms should be split into rectangles and added. Diagonal layouts, herringbone patterns, shade/batch matching and future spare material can justify a higher allowance. Always order whole packs according to supplier rules.</p><h2>Worked example</h2><p>A 5 × 4 m room is 20 m². With 8% waste, order area is 21.6 m²; at 2.2 m² per pack, 10 packs provide 22 m².</p>
<h3>Choose flooring waste based on the installation pattern</h3>
<p>A flooring quantity calculator starts with net floor area, then adds a waste or cutting allowance before converting the result into boxes or units. Straight layouts in simple rooms generally create less offcut than diagonal, herringbone or complex patterned installations. Alcoves, stairs and irregular boundaries can also increase waste. Use the coverage printed on the actual flooring package, round up to full boxes, and consider retaining spare material from the same production lot for future repairs where color or pattern matching matters.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Why does the pack count round up?','Flooring is generally sold as whole packs, so any fractional requirement needs the next full pack.'],['Should wardrobes or cabinets be deducted?','Only deduct areas that will definitely not receive the flooring system; installation practice varies by product.'],['How much waste should I add?','Use project-specific guidance based on room shape, pattern, plank/tile size and installer practice.'],['Can I include price?','Yes. Enter pack price to get a simple material-cost estimate before accessories and labour.']];
require __DIR__.'/../includes/tool-template.php';
