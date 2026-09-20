<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','title-case-sentence-case-converter');
ob_start();
?>

<h2>Convert text to title case, sentence case, upper or lower case</h2>
<p class="lead">Clean up headings and copy with practical case conversion while preserving short all-caps acronyms where possible.</p>
<div class="field"><label for="text">Text</label><textarea id="text" rows="8">a practical guide to SEO and content strategy</textarea></div>
<div class="form-grid"><div class="field"><label for="mode">Conversion</label><select id="mode"><option value="title" selected>Title Case</option><option value="sentence">Sentence case</option><option value="upper">UPPER CASE</option><option value="lower">lower case</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="convert" type="button">Convert</button><button class="btn btn-secondary" id="copy" type="button">Copy result</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="field"><label for="output">Result</label><textarea id="output" rows="8" readonly></textarea></div>
<div id="note" class="helper"></div>
<script>
(()=>{
const $=id=>document.getElementById(id),minor=new Set(['a','an','and','as','at','but','by','for','from','in','nor','of','on','or','per','the','to','via','vs','with']);
const acr=w=>/^[A-Z0-9]{2,5}$/.test(w.replace(/[^A-Z0-9]/g,''));
const cap=w=>w.split('-').map(x=>accr(x)).join('-');
function accr(w){if(acr(w))return w;return w? w.charAt(0).toUpperCase()+w.slice(1).toLowerCase():w;}
function title(s){
 return s.split(/\n/).map(line=>{const parts=line.split(/(\s+)/),words=parts.map((p,i)=>({p,i})).filter(x=>/\w/.test(x.p)),first=words[0]?.i,last=words.at(-1)?.i;
   return parts.map((p,i)=>{if(!/\w/.test(p))return p;if(acr(p))return p;const bare=p.toLowerCase().replace(/^[^a-z0-9]+|[^a-z0-9]+$/g,'');if(i!==first&&i!==last&&minor.has(bare))return p.toLowerCase();return cap(p);}).join('');
 }).join('\n');
}
function sentence(s){
 const low=s.toLowerCase();let start=true;return low.replace(/[a-z]/gi,ch=>{if(start){start=false;return ch.toUpperCase();}return ch;}).replace(/([.!?]\s+)([a-z])/g,(_,a,b)=>a+b.toUpperCase());
}
function go(){const s=$('text').value,m=$('mode').value;$('output').value=m==='title'?title(s):m==='sentence'?sentence(s):m==='upper'?s.toUpperCase():s.toLowerCase();$('note').textContent=m==='title'?'Title-case conventions vary by style guide; review brand names, acronyms and intentional capitalization.':'Conversion runs locally in your browser.';}
$('convert').addEventListener('click',go);$('text').addEventListener('input',go);$('mode').addEventListener('change',go);$('copy').addEventListener('click',async()=>{try{await navigator.clipboard.writeText($('output').value);$('note').textContent='Result copied.';}catch(e){}});$('reset').addEventListener('click',()=>{$('text').value=$('text').defaultValue;$('mode').selectedIndex=0;go();});go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>Title case and sentence case converter</h2>
<p>Writers often need to normalize headings copied from spreadsheets, CMS fields, briefs or AI-assisted drafts. This tool converts text locally into practical title case, sentence case, uppercase or lowercase.</p>
<h3>How title case is handled</h3>
<p>The title-case mode capitalizes principal words while keeping a short list of common articles, conjunctions and prepositions lowercase when they appear in the middle of a line. The first and last word are capitalized. Short all-caps tokens are preserved to reduce damage to acronyms such as SEO, API or HTML.</p>
<h3>Why style-guide review still matters</h3>
<p>AP, Chicago, MLA and individual brand guides do not use identical title-capitalization rules. Hyphenated compounds, prepositions used adverbially, product names and intentionally stylized brands can require manual adjustment.</p>
<h3>Sentence case</h3>
<p>Sentence mode lowercases the text and capitalizes the first alphabetical character after a sentence boundary. Because that intentionally normalizes casing, proper nouns and acronyms may need restoration.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Which title case style does this use?','It uses a practical general-purpose rule set, not a claim of exact AP, Chicago or another editorial style.'],['Will SEO or HTML stay uppercase?','Short all-caps acronyms are preserved in title-case mode where possible.'],['Why did sentence case change a brand name?','Sentence case intentionally normalizes most capitalization, so proper nouns and stylized brands should be reviewed after conversion.'],['Is my text sent to a server?','No. Case conversion runs locally in the browser.']];
require __DIR__.'/../includes/tool-template.php';
