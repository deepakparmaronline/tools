<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('construction','drywall-gypsum-board-calculator');
ob_start();
?>
<h2>Estimate drywall or gypsum board quantity</h2>
<p class="lead">Calculate boards and packs from net surface area, board dimensions, number of layers and waste.</p>
<div class="form-grid"><div class="field"><label for="wallArea">Wall/ceiling gross area (m²)</label><input id="wallArea" type="number" value="80" min="0" step="any"></div><div class="field"><label for="openings">Openings to deduct (m²)</label><input id="openings" type="number" value="10" min="0" step="any"></div><div class="field"><label for="boardW">Board width (m)</label><input id="boardW" type="number" value="1.2" min="0.01" step="any"></div><div class="field"><label for="boardH">Board length (m)</label><input id="boardH" type="number" value="2.4" min="0.01" step="any"></div><div class="field"><label for="layers">Board layers</label><input id="layers" type="number" value="1" min="1" step="1"></div><div class="field"><label for="waste">Cutting/waste allowance (%)</label><input id="waste" type="number" value="10" min="0" step="any"></div><div class="field"><label for="boardsPack">Boards per pack (optional)</label><input id="boardsPack" type="number" value="1" min="1" step="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Layer-adjusted area</span><strong id="net">—</strong></div><div class="metric"><span>Boards before waste</span><strong id="raw">—</strong></div><div class="metric"><span>Boards incl. waste</span><strong id="boards">—</strong></div><div class="metric"><span>Packs required</span><strong id="packs">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const ga=n('wallArea'),o=n('openings'),bw=n('boardW'),bh=n('boardH'),l=n('layers'),w=n('waste')/100,bp=n('boardsPack');if(![ga,o,bw,bh,l,w,bp].every(Number.isFinite)||ga<0||o<0||bw<=0||bh<=0||l<=0||w<0||bp<=0){note('Check area, board dimensions, layers and wastage.',true);return;}const net=Math.max(0,ga-o)*l,board=bw*bh,raw=net/board,total=Math.ceil(raw*(1+w)),packs=Math.ceil(total/bp);$('net').textContent=fmt(net,2)+' m²';$('raw').textContent=fmt(raw,2)+' boards';$('boards').textContent=total+' boards';$('packs').textContent=packs+' packs';note('Board orientation, staggered joints, fire/acoustic layer requirements and offcut reuse can change real quantities.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('wallArea')?.addEventListener('input',go);$('wallArea')?.addEventListener('change',go);$('openings')?.addEventListener('input',go);$('openings')?.addEventListener('change',go);$('boardW')?.addEventListener('input',go);$('boardW')?.addEventListener('change',go);$('boardH')?.addEventListener('input',go);$('boardH')?.addEventListener('change',go);$('layers')?.addEventListener('input',go);$('layers')?.addEventListener('change',go);$('waste')?.addEventListener('input',go);$('waste')?.addEventListener('change',go);$('boardsPack')?.addEventListener('input',go);$('boardsPack')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the drywall / gypsum board calculator works</h2><p>Openings are deducted from gross surface area, then the area is multiplied by the number of board layers. Dividing by individual board area gives the theoretical board count, after which the waste allowance and pack rounding are applied.</p><h2>Where this construction calculation helps</h2><p>Use it for first-pass takeoffs on partitions, linings and ceilings where standard sheet sizes are known.</p><h2>Measurements and assumptions</h2><p>Real layouts depend on stud spacing, required orientation, joint staggering, fire/acoustic assemblies and whether offcuts can be reused. Very small openings are sometimes not deducted because cutting around them may consume as much board as the opening saves.</p><h2>Worked example</h2><p>Eighty square metres gross less 10 m² openings gives 70 m². With 1.2 × 2.4 m boards, one layer needs about 24.3 boards before waste.</p>
<h3>Plan board quantity around layout and openings</h3>
<p>A drywall or gypsum board calculator estimates sheet count from surface area and board dimensions. Real jobs also depend on board orientation, wall height, ceiling layout, door and window openings, offcuts and whether usable scraps can be carried to another area. A small waste percentage may work for simple rectangular rooms, while rooms with many corners or short sections usually need more. Round purchasing quantities to whole boards and confirm thickness, fire rating, moisture resistance and edge type separately from the area calculation.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Should I deduct every window and door?','Deduct meaningful openings, but tiny penetrations may not reduce purchased board because offcuts and cuts still create waste.'],['How do multiple layers affect quantity?','The net surface area is multiplied by the number of board layers.'],['What waste percentage should I use?','Use a project-specific allowance based on room geometry, sheet orientation and offcut reuse.'],['Does this calculate studs or joint compound?','No. It focuses on sheet quantity and packs.']];
require __DIR__.'/../includes/tool-template.php';
