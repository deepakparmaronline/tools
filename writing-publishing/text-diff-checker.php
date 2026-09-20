<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','text-diff-checker');
ob_start();
?>

<h2>Compare two versions of text</h2>
<p class="lead">Find additions, removals and unchanged content with a local line-by-line or word-by-word longest-common-subsequence diff.</p>
<div class="form-grid">
 <div class="field"><label for="left">Original text</label><textarea id="left" rows="10">The quick brown fox
jumps over the dog.</textarea></div>
 <div class="field"><label for="right">Revised text</label><textarea id="right" rows="10">The quick brown fox
jumps over the lazy dog.</textarea></div>
</div>
<div class="form-grid"><div class="field"><label for="mode">Compare by</label><select id="mode"><option value="line" selected>Line</option><option value="word">Word</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="compare" type="button">Compare text</button><button class="btn btn-secondary" id="swap" type="button">Swap sides</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Added units</span><strong id="added">0</strong></div><div class="metric"><span>Removed units</span><strong id="removed">0</strong></div><div class="metric"><span>Unchanged units</span><strong id="same">0</strong></div></div>
<div class="field" style="margin-top:12px"><label for="output">Diff</label><textarea id="output" rows="14" readonly></textarea></div><div id="note" class="helper"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
function tokens(t,mode){return mode==='line'?t.replace(/\r\n?/g,'\n').split('\n'):t.trim().split(/\s+/).filter(Boolean);}
function go(){
 const mode=$('mode').value,a=tokens($('left').value,mode),b=tokens($('right').value,mode),limit=700;
 if(a.length>limit||b.length>limit){$('note').textContent='For browser performance, compare at most '+limit+' '+mode+' units per side.';$('output').value='';return;}
 const dp=Array.from({length:a.length+1},()=>new Uint16Array(b.length+1));
 for(let i=a.length-1;i>=0;i--)for(let j=b.length-1;j>=0;j--)dp[i][j]=a[i]===b[j]?dp[i+1][j+1]+1:Math.max(dp[i+1][j],dp[i][j+1]);
 let i=0,j=0,add=0,rem=0,same=0,out=[];
 while(i<a.length||j<b.length){
   if(i<a.length&&j<b.length&&a[i]===b[j]){out.push('  '+a[i]);i++;j++;same++;}
   else if(j<b.length&&(i===a.length||dp[i][j+1]>=dp[i+1][j])){out.push('+ '+b[j]);j++;add++;}
   else{out.push('- '+a[i]);i++;rem++;}
 }
 $('added').textContent=add;$('removed').textContent=rem;$('same').textContent=same;$('output').value=out.join(mode==='line'?'\n':' ');
 $('note').textContent='Legend: + added, - removed, two spaces unchanged. Comparison runs locally in your browser.';
}
$('compare').addEventListener('click',go);$('mode').addEventListener('change',go);$('swap').addEventListener('click',()=>{const t=$('left').value;$('left').value=$('right').value;$('right').value=t;go();});$('reset').addEventListener('click',()=>{['left','right'].forEach(id=>$(id).value=$(id).defaultValue);$('mode').selectedIndex=0;go();});go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>How the text diff checker works</h2>
<p>A text diff highlights what changed between an original and a revised version. This browser tool uses a longest-common-subsequence comparison to align matching content and then marks insertions and deletions around that shared sequence.</p>
<h3>Line diff versus word diff</h3>
<p>Line mode is useful for articles, configuration snippets, notes and documents where each line is meaningful. Word mode is better for examining copy edits inside prose. Choose the coarser line mode for larger drafts because word-level dynamic programming uses more browser memory.</p>
<h3>Reading the output</h3>
<p>Lines or tokens prefixed with a plus sign exist only in the revised version. A minus sign identifies content only in the original. Unchanged units are prefixed with two spaces. This is a textual comparison and does not interpret whether a change is factually correct.</p>
<h3>Privacy and performance</h3>
<p>The comparison runs locally. To avoid freezing a browser tab, the interface imposes a per-side unit limit for the dynamic-programming matrix.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Does the text diff checker upload my text?','No. The comparison runs locally in your browser.'],['Which mode should I use for an article revision?','Start with line mode for the overall change set, then use word mode on smaller sections when you need detailed copy edits.'],['Why is there a comparison-size limit?','Longest-common-subsequence diff uses a matrix whose memory and processing cost grows with both inputs. The cap keeps the page responsive.'],['Does unchanged text mean the documents are semantically identical?','No. The tool compares literal tokens or lines, not meaning, facts or formatting semantics.']];
require __DIR__.'/../includes/tool-template.php';
