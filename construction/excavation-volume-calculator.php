<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','excavation-volume-calculator');
ob_start();
?>
<h2>Calculate excavation volume</h2><p class="lead">Estimate straight trench volume or a sloped pit/frustum, then convert volume into approximate truck loads.</p>
<div class="form-grid">
<div class="field"><label for="shape">Excavation type</label><select id="shape"><option value="trench">Rectangular trench</option><option value="pit">Sloped rectangular pit</option></select></div>
<div class="field"><label for="length">Length / top length (m)</label><input id="length" type="number" min="0" step="any" value="20"></div>
<div class="field"><label for="width">Width / top width (m)</label><input id="width" type="number" min="0" step="any" value="1"></div>
<div class="field"><label for="depth">Depth (m)</label><input id="depth" type="number" min="0" step="any" value="1.5"></div>
<div class="field"><label for="bottomL">Bottom length (m, pit only)</label><input id="bottomL" type="number" min="0" step="any" value="18"></div>
<div class="field"><label for="bottomW">Bottom width (m, pit only)</label><input id="bottomW" type="number" min="0" step="any" value="0.5"></div>
<div class="field"><label for="swell">Swell / loose-volume allowance (%)</label><input id="swell" type="number" min="0" step="any" value="20"></div>
<div class="field"><label for="truck">Truck loose capacity (m³)</label><input id="truck" type="number" min="0.01" step="any" value="10"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Bank volume</span><strong id="bank">—</strong></div><div class="metric"><span>Loose volume</span><strong id="loose">—</strong></div><div class="metric"><span>Truck loads</span><strong id="loads">—</strong></div><div class="metric"><span>Cubic yards loose</span><strong id="yd">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value),fmt=(v,d=2)=>v.toLocaleString(undefined,{maximumFractionDigits:d});const note=(m,b=false)=>{const e=$('note');e.textContent=m;e.className='helper'+(b?' danger':'');};function go(){const sh=$('shape').value,L=n('length'),W=n('width'),D=n('depth'),bl=n('bottomL'),bw=n('bottomW'),sw=n('swell')/100,t=n('truck');if(![L,W,D,bl,bw,sw,t].every(Number.isFinite)||L<0||W<0||D<0||bl<0||bw<0||sw<0||t<=0){note('Check dimensions, swell and truck capacity.',true);return;}let v;if(sh==='trench')v=L*W*D;else{const A1=L*W,A2=bl*bw;v=D/3*(A1+A2+Math.sqrt(A1*A2));}const loose=v*(1+sw);$('bank').textContent=fmt(v)+' m³';$('loose').textContent=fmt(loose)+' m³';$('loads').textContent=Math.ceil(loose/t)+' loads';$('yd').textContent=fmt(loose*1.30795062)+' yd³';note('Swell varies greatly by soil/rock and compaction. Safe excavation slopes, shoring and spoil placement require site-specific engineering and regulations.');}['shape','length','width','depth','bottomL','bottomW','swell','truck'].forEach(id=>$(id).addEventListener('input',go));$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>location.reload());go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the excavation volume calculator works</h2><p>A rectangular trench uses length × width × depth. A sloped rectangular pit uses the rectangular-frustum formula from top and bottom areas. An editable swell allowance converts in-situ bank volume into a loose-haul volume before truck-load rounding.</p><h2>Where this construction calculation helps</h2><p>Use it for preliminary earthwork, spoil-haul planning and comparing trench or pit quantities.</p><h2>Measurements and assumptions</h2><p>Soil bulking/swell is highly material-dependent. Groundwater, overbreak, working space, batter slopes and shoring can dominate actual excavation. This calculator is a quantity estimator, not excavation-safety guidance.</p><h2>Worked example</h2><p>A 20 m × 1 m × 1.5 m trench contains 30 m³ bank volume. At 20% swell, loose spoil is about 36 m³.</p><h3>Bank volume, loose volume and haul planning</h3><p>Keep bank and loose quantities separate when comparing excavation takeoffs with transport capacity. Truck body ratings are usually loose-volume values, while drawings describe in-place geometry. Actual loads may be limited by weight before volume, especially for dense or wet material, so verify vehicle payload limits and disposal-site rules before using the truck count operationally.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is bank volume?','The volume of soil or rock in its undisturbed in-place condition.'],['What is swell?','Excavated material usually occupies more volume after loosening; swell is the percentage increase from bank to loose volume.'],['Can this design safe trench slopes?','No. Excavation safety, shoring and slope requirements need qualified site-specific assessment and local compliance.'],['Why round truck loads up?','A partial final load still requires a trip, so the planning count is rounded up.']];
require __DIR__.'/../includes/tool-template.php';
