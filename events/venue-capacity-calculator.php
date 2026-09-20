<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('events','venue-capacity-calculator');
ob_start();
?>
<h2>Estimate venue capacity</h2><p class="lead">Convert room area into a planning capacity using an editable space-per-person assumption. This is a planning estimate, not a fire-code occupancy certificate.</p>
<div class="form-grid">
<div class="field"><label for="unit">Area unit</label><select id="unit"><option value="sqm">Square metres</option><option value="sqft">Square feet</option></select></div>
<div class="field"><label for="area">Gross room area</label><input id="area" type="number" min="0" step="any" value="300"></div>
<div class="field"><label for="layout">Layout preset</label><select id="layout"><option value="0.7">Standing reception — 0.7 m²/person</option><option value="1.0">Theatre seating — 1.0 m²/person</option><option value="1.5">Classroom — 1.5 m²/person</option><option value="1.8" selected>Banquet rounds — 1.8 m²/person</option><option value="2.3">Cabaret / spacious banquet — 2.3 m²/person</option><option value="custom">Custom</option></select></div>
<div class="field"><label for="space">Space per guest (m²)</label><input id="space" type="number" min="0.1" step="0.01" value="1.8"></div>
<div class="field"><label for="usable">Usable floor area (%)</label><input id="usable" type="number" min="1" max="100" step="any" value="80"><small>Reduce gross area for stages, service stations, AV, fixed furniture and circulation.</small></div>
<div class="field"><label for="planned">Planned guest count (optional)</label><input id="planned" type="number" min="0" step="1" value="120"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate capacity</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Usable area</span><strong id="usableOut">—</strong></div><div class="metric"><span>Planning capacity</span><strong id="capacity">—</strong></div><div class="metric"><span>Area per planned guest</span><strong id="actualSpace">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),num=id=>parseFloat($(id).value),fmt=(v,d=1)=>v.toLocaleString(undefined,{maximumFractionDigits:d});
function go(){let area=num('area'),space=num('space'),usable=num('usable'),planned=num('planned');if(![area,space,usable].every(Number.isFinite)||area<=0||space<=0||usable<=0||usable>100){$('note').textContent='Enter a positive area and space allowance, with usable area between 1% and 100%.';$('note').className='helper danger';return;}const sqm=$('unit').value==='sqft'?area*0.09290304:area;const u=sqm*usable/100;const cap=Math.floor(u/space);$('usableOut').textContent=fmt(u)+' m²';$('capacity').textContent=cap.toLocaleString()+' guests';$('actualSpace').textContent=Number.isFinite(planned)&&planned>0?fmt(u/planned,2)+' m²/guest':'—';let msg='Planning capacity uses your selected area allowance. Confirm exits, aisle widths, accessibility, furniture layouts and the venue’s legally approved occupant load before committing guest numbers.';if(Number.isFinite(planned)&&planned>cap)msg='The planned guest count is above this planning estimate. '+msg;$('note').textContent=msg;$('note').className='helper'+((Number.isFinite(planned)&&planned>cap)?' danger':'');}
$('layout').addEventListener('change',()=>{if($('layout').value!=='custom')$('space').value=$('layout').value;go();});['unit','area','space','usable','planned'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('unit').value='sqm';$('area').value=300;$('layout').value='1.8';$('space').value=1.8;$('usable').value=80;$('planned').value=120;go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the venue capacity calculator works</h2><p>The calculator first converts the room into square metres, applies the usable-area percentage, and then divides usable area by the selected space allowance per guest. Because event layouts consume very different amounts of floor area, the preset is only a starting point and remains editable.</p>
<h2>Venue capacity formula</h2><p><strong>Planning capacity = usable floor area ÷ space per guest.</strong> Usable floor area is gross room area multiplied by the percentage that remains after allowing for stages, dance floors, bars, buffet stations, AV positions, registration desks and circulation.</p>
<h2>How to use the result</h2><p>Use the result for early event planning, room comparisons and seating discussions. For a banquet, draw the actual table plan before finalizing numbers because table diameter, chair pull-back, server aisles and emergency egress can materially reduce capacity.</p>
<h2>Important limitation</h2><p>This is not a building-code or fire-safety occupancy calculator. Legal occupant loads depend on local codes, approved use, exits, door widths, accessibility requirements and the authority having jurisdiction. The lower of your operational layout capacity and the legally approved occupant load should control.</p>
<h3>Example</h3><p>A 300 m² hall with 80% usable area leaves 240 m². At 1.8 m² per banquet guest, the planning capacity is 133 guests before any venue-specific legal limit is applied.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Is venue capacity the same as legal occupant load?','No. This tool estimates planning capacity from floor area. The legally approved occupant load may be lower and should be confirmed with the venue and local authority.'],['What usable-area percentage should I use?','Use the measured percentage that remains for guests after stages, bars, service areas, AV equipment, fixed furniture and circulation. If you do not know it yet, test several scenarios rather than treating one percentage as exact.'],['Why do banquet layouts need more space than theatre seating?','Banquets require table footprints, chair clearance and service aisles, so each guest usually consumes more floor area than a tightly arranged theatre seat.'],['Can I use square feet?','Yes. Choose square feet and the calculator converts the area internally before applying the selected layout allowance.']];
require __DIR__.'/../includes/tool-template.php';
