<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','markdown-html-converter');
ob_start();
?>

<h2>Convert Markdown to HTML or HTML to Markdown</h2>
<p class="lead">Convert common article-formatting syntax locally in your browser. The converter covers everyday headings, paragraphs, emphasis, links, code, blockquotes and lists.</p>
<div class="form-grid">
 <div class="field"><label for="direction">Conversion direction</label><select id="direction"><option value="md-html" selected>Markdown → HTML</option><option value="html-md">HTML → Markdown</option></select></div>
</div>
<div class="field"><label for="source">Source</label><textarea id="source" rows="10"># Example heading

This is **bold**, *italic* and [a link](https://example.com).

- First item
- Second item</textarea></div>
<div class="tool-actions"><button class="btn btn-primary" id="convert" type="button">Convert</button><button class="btn btn-secondary" id="copy" type="button">Copy output</button><button class="btn btn-secondary" id="swap" type="button">Swap direction</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="field"><label for="output">Converted output</label><textarea id="output" rows="12" readonly></textarea></div>
<div id="note" class="helper"></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const esc=s=>s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
function inline(s){
 return s.replace(/`([^`]+)`/g,'<code>$1</code>')
 .replace(/\*\*([^*]+)\*\*/g,'<strong>$1</strong>').replace(/__([^_]+)__/g,'<strong>$1</strong>')
 .replace(/(^|[^\*])\*([^*\n]+)\*/g,'$1<em>$2</em>').replace(/\[([^\]]+)\]\((https?:\/\/[^)\s]+)\)/g,'<a href="$2">$1</a>');
}
function mdToHtml(md){
 md=md.replace(/\r\n?/g,'\n');const code=[];md=md.replace(/```([\w-]*)\n([\s\S]*?)```/g,(_,lang,c)=>{code.push('<pre><code'+(lang?' class="language-'+lang+'"':'')+'>'+esc(c.replace(/\n$/,''))+'</code></pre>');return '\u0000C'+(code.length-1)+'\u0000';});
 const lines=md.split('\n'),out=[];let list=null;
 const close=()=>{if(list){out.push('</'+list+'>');list=null;}};
 for(const raw of lines){const line=esc(raw);
   let m;if((m=line.match(/^(#{1,6})\s+(.+)$/))){close();out.push('<h'+m[1].length+'>'+inline(m[2])+'</h'+m[1].length+'>');continue;}
   if((m=line.match(/^>\s?(.*)$/))){close();out.push('<blockquote>'+inline(m[1])+'</blockquote>');continue;}
   if((m=line.match(/^\s*[-*+]\s+(.+)$/))){if(list!=='ul'){close();out.push('<ul>');list='ul';}out.push('<li>'+inline(m[1])+'</li>');continue;}
   if((m=line.match(/^\s*\d+[.)]\s+(.+)$/))){if(list!=='ol'){close();out.push('<ol>');list='ol';}out.push('<li>'+inline(m[1])+'</li>');continue;}
   close();if(!line.trim()){out.push('');continue;}if(/^\u0000C\d+\u0000$/.test(raw)){out.push(raw);continue;}out.push('<p>'+inline(line)+'</p>');
 } close();return out.join('\n').replace(/\u0000C(\d+)\u0000/g,(_,i)=>code[+i]);
}
function htmlToMd(html){
 const doc=new DOMParser().parseFromString(html,'text/html');
 const walk=node=>{
   if(node.nodeType===3)return node.nodeValue||'';if(node.nodeType!==1)return '';
   const tag=node.tagName.toLowerCase(),inner=[...node.childNodes].map(walk).join('');
   if(/^h[1-6]$/.test(tag))return '#'.repeat(+tag[1])+' '+inner.trim()+'\n\n';
   if(tag==='strong'||tag==='b')return '**'+inner+'**';if(tag==='em'||tag==='i')return '*'+inner+'*';if(tag==='code'&&node.parentElement?.tagName!=='PRE')return '`'+inner+'`';
   if(tag==='a')return '['+inner+']('+(node.getAttribute('href')||'')+')';
   if(tag==='blockquote')return inner.trim().split('\n').map(x=>'> '+x).join('\n')+'\n\n';
   if(tag==='li'){const ol=node.parentElement?.tagName==='OL';const idx=ol?[...node.parentElement.children].indexOf(node)+1:null;return (ol?idx+'. ':'- ')+inner.trim()+'\n';}
   if(tag==='ul'||tag==='ol')return inner+'\n';if(tag==='p')return inner.trim()+'\n\n';if(tag==='br')return '\n';
   if(tag==='pre')return '```\n'+node.textContent.replace(/\n$/,'')+'\n```\n\n';
   return inner;
 };return [...doc.body.childNodes].map(walk).join('').replace(/\n{3,}/g,'\n\n').trim();
}
function go(){$('output').value=$('direction').value==='md-html'?mdToHtml($('source').value):htmlToMd($('source').value);$('note').textContent='Converted locally. Review complex tables, nested lists, raw HTML, reference links and flavor-specific Markdown manually.';}
$('convert').addEventListener('click',go);$('source').addEventListener('input',go);$('direction').addEventListener('change',go);
$('copy').addEventListener('click',async()=>{try{await navigator.clipboard.writeText($('output').value);$('note').textContent='Output copied.';}catch(e){$('output').select();}});
$('swap').addEventListener('click',()=>{$('source').value=$('output').value;$('direction').selectedIndex=$('direction').selectedIndex?0:1;go();});
$('reset').addEventListener('click',()=>{$('source').value=$('source').defaultValue;$('direction').selectedIndex=0;go();});go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>Markdown to HTML converter for publishing workflows</h2>
<p>Markdown is convenient for drafting in editors, repositories and content systems, while HTML is the markup ultimately consumed by browsers and many CMS platforms. This converter handles the common subset needed for straightforward article drafts without sending the content to a server.</p>
<h3>Supported Markdown features</h3>
<p>The Markdown-to-HTML direction covers ATX headings, paragraphs, bold and italic emphasis, inline code, fenced code blocks, blockquotes, HTTP(S) links, unordered lists and ordered lists. HTML-to-Markdown converts the corresponding common elements back into readable Markdown.</p>
<h3>Why output may differ from another Markdown parser</h3>
<p>Markdown has multiple flavors and detailed parsing rules for nesting, escaping, tables, task lists, reference-style links and embedded HTML. This lightweight browser converter is intentionally not a complete CommonMark or GitHub Flavored Markdown implementation. Review complex documents before publishing.</p>
<h3>Safer conversion habit</h3>
<p>The generated HTML is shown as text instead of being rendered as a live preview. That makes the tool suitable for inspecting markup without executing pasted scripts or event attributes.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Does this support every Markdown feature?','No. It targets common article formatting and does not claim full CommonMark, GitHub Flavored Markdown or platform-specific compatibility.'],['Will the converter upload my draft?','No. The conversion itself runs locally in your browser.'],['Can I convert HTML tables to Markdown tables?','Not with this lightweight converter. Complex tables should be converted with a parser that explicitly supports the table syntax required by your publishing platform.'],['Why should I review converted links and code blocks?','Different Markdown flavors handle edge cases, escaping and nesting differently, so complex source should be checked before publication.']];
require __DIR__.'/../includes/tool-template.php';
