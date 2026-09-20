<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('fitness-sports','swim-pace-calculator');
ob_start();
?>
<h2>Calculate swim pace</h2><p class="lead">Enter swim distance and elapsed time to see pace per 100, pace per 50 and projected times.</p>
<div class="form-grid"><div class="field"><label for="distance">Distance</label><input id="distance" type="number" min="0" step="any" value="1500"></div><div class="field"><label for="unit">Pool/distance unit</label><select id="unit"><option value="m">Metres</option><option value="yd">Yards</option></select></div><div class="field"><label for="time">Elapsed time (HH:MM:SS or MM:SS)</label><input id="time" type="text" value="30:00"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate swim pace</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Pace / 100</span><strong id="p100">—</strong></div><div class="metric"><span>Pace / 50</span><strong id="p50">—</strong></div><div class="metric"><span>Average speed</span><strong id="speed">—</strong></div></div><div class="table-wrap" style="margin-top:14px"><table class="data-table"><thead><tr><th>Distance</th><th>Same-pace time</th></tr></thead><tbody id="proj"></tbody></table></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value);function sec(s){const p=s.trim().split(':').map(Number);if(p.some(x=>!Number.isFinite(x))||p.length<2||p.length>3)return NaN;return p.length===2?p[0]*60+p[1]:p[0]*3600+p[1]*60+p[2]}function clock(s){s=Math.round(s);const h=Math.floor(s/3600),m=Math.floor((s%3600)/60),x=s%60;return h?`${h}:${String(m).padStart(2,'0')}:${String(x).padStart(2,'0')}`:`${m}:${String(x).padStart(2,'0')}`}function go(){const d=n('distance'),t=sec($('time').value),u=$('unit').value;if(!Number.isFinite(d)||d<=0||!Number.isFinite(t)||t<=0)return;const per=t/d;$('p100').textContent=clock(per*100)+'/100 '+u;$('p50').textContent=clock(per*50)+'/50 '+u;$('speed').textContent=(d/(t/60)).toFixed(1)+' '+u+'/min';const arr=u==='m'?[50,100,200,400,800,1500]:[50,100,200,500,1000,1650];$('proj').innerHTML=arr.map(x=>'<tr><td>'+x+' '+u+'</td><td>'+clock(per*x)+'</td></tr>').join('');}
['distance','unit','time'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('distance').value=1500;$('unit').value='m';$('time').value='30:00';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Swim pace formula</h2><p>Swim pace is elapsed time divided by distance. The tool converts that base rate into the familiar time per 100 and time per 50 used for training sets and race splits.</p>
<h2>Metres and yards are not interchangeable</h2><p>A 100-yard repeat is shorter than a 100-metre repeat. Keep the unit consistent with the pool or open-water distance you actually swam instead of directly comparing the raw time per 100 across units.</p>
<h2>How to use same-pace projections</h2><p>The projection table assumes a constant average pace. It is useful for planning repeat intervals or rough pacing, but it does not account for starts, turns, fatigue, drafting, currents or changes in stroke.</p>
<h2>Elapsed versus moving swim time</h2><p>For continuous swims, elapsed time is usually straightforward. For interval sessions, calculate individual repeat pace separately if rest periods should not be included.</p>
<h2>Pool length and timing method affect swim pace</h2><p>Short-course and long-course swims include different numbers of turns, and turns can materially change average pace. Open-water distance can also be uncertain because of GPS error and navigation. Record whether a result came from a 25 m, 25 yd, 50 m pool or open water, and use the same convention when comparing sessions. The calculator converts time and distance accurately; it does not normalize for turns, currents or drafting.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How is pace per 100 calculated?','Total elapsed seconds are divided by total distance and then multiplied by 100.'],['Can I calculate pace for a yard pool?','Yes. Choose yards and the output will show time per 100 yards and time per 50 yards.'],['Should rest time be included?','Only if you want an overall session pace. For a swimming repeat pace, use the actual swimming time and exclude rest.'],['Are projected times race predictions?','No. They simply extend the same average pace to other distances.']];
require __DIR__.'/../includes/tool-template.php';
