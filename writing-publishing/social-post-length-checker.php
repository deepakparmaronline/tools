<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','social-post-length-checker');
ob_start();
?>

<h2>Check social post length against common platform presets</h2>
<p class="lead">Count characters, words and lines, then compare your draft with an editable platform limit before posting.</p>
<div class="form-grid">
 <div class="field"><label for="platform">Preset</label><select id="platform"><option value="280" selected>X standard post — 280</option><option value="25000">X Premium longer post — 25,000</option><option value="3000">LinkedIn post — 3,000</option><option value="custom">Custom limit</option></select></div>
 <div class="field"><label for="limit">Character limit</label><input id="limit" type="number" value="280" min="1" step="1"></div>
</div>
<div class="field"><label for="post">Post draft</label><textarea id="post" rows="10" placeholder="Write or paste your post..."></textarea></div>
<div class="result-box"><div class="result-grid">
 <div class="metric"><span>Characters</span><strong id="chars">0</strong></div><div class="metric"><span>Remaining</span><strong id="remaining">280</strong></div>
 <div class="metric"><span>Words</span><strong id="words">0</strong></div><div class="metric"><span>Lines</span><strong id="lines">0</strong></div>
 <div class="metric"><span>Limit used</span><strong id="used">0%</strong></div><div class="metric"><span>Status</span><strong id="status">Within limit</strong></div>
 </div><div id="note" class="helper" style="margin-top:12px"></div></div>
<div class="tool-actions"><button class="btn btn-secondary" id="copy" type="button">Copy post</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
function go(){
 const t=$('post').value,l=Math.max(1,parseInt($('limit').value,10)||1),c=[...t].length,w=(t.trim().match(/\S+/g)||[]).length,lines=t? t.split(/\r?\n/).length:0,rem=l-c;
 $('chars').textContent=c.toLocaleString();$('remaining').textContent=rem.toLocaleString();$('words').textContent=w.toLocaleString();$('lines').textContent=lines;$('used').textContent=(c/l*100).toFixed(1)+'%';$('status').textContent=rem>=0?'Within limit':'Over by '+Math.abs(rem).toLocaleString();
 $('note').textContent='Character presets are planning references and platform rules can change or vary by account/product. Use Custom for a different verified limit.';
}
$('platform').addEventListener('change',()=>{if($('platform').value!=='custom')$('limit').value=$('platform').value;go();});$('limit').addEventListener('input',go);$('post').addEventListener('input',go);
$('copy').addEventListener('click',async()=>{try{await navigator.clipboard.writeText($('post').value);$('note').textContent='Post copied.';}catch(e){}});
$('reset').addEventListener('click',()=>{$('post').value='';$('platform').selectedIndex=0;$('limit').value=280;go();});go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>Social post character counter and length checker</h2>
<p>Different publishing surfaces impose different text limits, and those limits can change as products evolve. This tool gives writers a fast pre-publish count for the standard X post, the longer X Premium post format and a LinkedIn post, while keeping the numeric limit editable.</p>
<h3>What is counted</h3>
<p>The character count uses Unicode code points rather than JavaScript's raw UTF-16 code units, which makes ordinary emoji counting more intuitive. Platform-specific counting can still differ for links, combined emoji sequences and other special content, so the platform's own composer remains the final authority.</p>
<h3>Use the custom limit for campaign rules</h3>
<p>Choose Custom when an ad field, scheduler, internal editorial policy or another social network uses a different maximum. The remaining-character and percentage indicators update as you type.</p>
<h3>Length is not the same as performance</h3>
<p>Staying under a technical limit does not make a post effective. Message clarity, audience relevance, opening context, visual assets, link treatment and accessibility still matter.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Does this exactly reproduce how X counts every character?','No. It is a practical Unicode character counter. X can apply product-specific counting rules to links, emoji sequences and other special cases.'],['Why is the platform limit editable?','Social products and account capabilities change. An editable limit lets you use the latest verified rule or a campaign-specific constraint.'],['Does the tool upload my social post?','No. Counting is performed locally in the browser.'],['Can I use it for platforms not listed?','Yes. Select Custom and enter the character limit you need.']];
require __DIR__.'/../includes/tool-template.php';
