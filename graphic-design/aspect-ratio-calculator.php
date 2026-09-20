<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('graphic-design','aspect-ratio-calculator');
ob_start();
?>
<h2>Calculate and resize an aspect ratio</h2><p class="lead">Enter width and height to simplify the ratio, then calculate a matching height or width without stretching the design.</p>
<div class="form-grid">
<div class="field"><label for="w">Current width</label><input id="w" type="number" min="0.0001" step="any" value="1920"></div>
<div class="field"><label for="h">Current height</label><input id="h" type="number" min="0.0001" step="any" value="1080"></div>
<div class="field"><label for="newW">New width (optional)</label><input id="newW" type="number" min="0" step="any" value="1280"></div>
<div class="field"><label for="newH">New height (optional)</label><input id="newH" type="number" min="0" step="any" placeholder="Leave blank to calculate from width"></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate ratio</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Simplified ratio</span><strong id="ratio">—</strong></div><div class="metric"><span>Decimal ratio</span><strong id="decimal">—</strong></div><div class="metric"><span>Matching dimensions</span><strong id="dims">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);const n=id=>parseFloat($(id).value);function gcd(a,b){while(b){const t=b;b=a%b;a=t}return a}function simplify(w,h){const scale=10000,wi=Math.round(w*scale),hi=Math.round(h*scale),g=gcd(wi,hi);return[(wi/g),(hi/g)]}function go(){const w=n('w'),h=n('h'),nw=n('newW'),nh=n('newH');if(!(w>0&&h>0)){$('ratio').textContent=$('decimal').textContent=$('dims').textContent='—';$('note').textContent='Width and height must both be greater than zero.';$('note').className='helper danger';return}const [a,b]=simplify(w,h);$('ratio').textContent=a+':'+b;$('decimal').textContent=(w/h).toFixed(4);let out='Enter a new width or height';if(nw>0&&!(nh>0))out=nw.toLocaleString()+' × '+(nw*h/w).toFixed(2);else if(nh>0&&!(nw>0))out=(nh*w/h).toFixed(2)+' × '+nh.toLocaleString();else if(nw>0&&nh>0){out=nw.toLocaleString()+' × '+nh.toLocaleString();const drift=Math.abs((nw/nh)/(w/h)-1)*100;$('note').textContent=drift<0.01?'The new dimensions preserve the source aspect ratio.':'The entered new dimensions differ from the source ratio by '+drift.toFixed(2)+'% and may crop or distort unless handled intentionally.';$('note').className='helper'+(drift>=0.01?' danger':'');return}$('dims').textContent=out;$('note').textContent='Matching dimensions preserve proportional width and height. Cropping can still change the visible composition.';$('note').className='helper'}['w','h','newW','newH'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('w').value=1920;$('h').value=1080;$('newW').value=1280;$('newH').value='';go()};go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What an aspect ratio calculator tells you</h2><p>An aspect ratio describes the proportional relationship between width and height. A 1920 × 1080 canvas simplifies to 16:9, while 1080 × 1080 is 1:1. The ratio is independent of physical size: 1920 × 1080, 1280 × 720 and 640 × 360 all share the same 16:9 proportion.</p>
<h2>How to resize without distortion</h2><p>If the source width is W and height is H, the matching height for a new width N is <strong>N × H ÷ W</strong>. The matching width for a new height N is <strong>N × W ÷ H</strong>. This preserves geometry instead of stretching pixels or vectors.</p>
<h2>Aspect ratio versus resolution</h2><p>Aspect ratio is a proportion; resolution is the actual pixel count. Two images can share an aspect ratio but have very different sharpness, file size and suitability for print or high-density displays. Social platforms and ad networks may also crop assets even when the mathematical ratio is valid, so check the current placement specification before export.</p>
<h2>Practical uses</h2><p>Use the calculator for video frames, thumbnails, ad creative, presentation slides, responsive embeds, image crops and screen mockups. If both replacement dimensions are entered, the tool also flags proportional drift so you can decide whether cropping or intentional distortion is acceptable.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is aspect ratio?','Aspect ratio is width divided by height, commonly written as two simplified numbers such as 16:9 or 4:3.'],['Does a 16:9 image have to be 1920 × 1080?','No. Any proportional dimensions such as 1280 × 720 or 640 × 360 are also 16:9.'],['Why can a correctly sized image still be cropped?','Platforms can use cover-style layouts or safe areas that crop the edges even when the uploaded asset has the requested ratio.'],['Can I use this for print dimensions?','Yes for proportional resizing, but print quality also depends on physical size and pixel density such as PPI/DPI.']];
require __DIR__.'/../includes/tool-template.php';
