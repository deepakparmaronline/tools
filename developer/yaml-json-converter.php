<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('developer','yaml-json-converter');
ob_start();
?>
<h2>Convert YAML and JSON</h2>
<p class="lead">Convert common YAML configuration data to JSON or turn JSON into readable YAML. Parsing happens locally in your browser.</p>
<div class="form-grid">
<div class="field"><label for="direction">Conversion direction</label><select id="direction"><option value="y2j">YAML → JSON</option><option value="j2y">JSON → YAML</option></select></div>
<div class="field"><label for="indent">Output indentation</label><select id="indent"><option value="2">2 spaces</option><option value="4">4 spaces</option></select></div>
<div class="field full"><label for="input">Input</label><textarea id="input">name: ToolboxKart
enabled: true
ports:
  - 80
  - 443
database:
  host: localhost
  retries: 3</textarea></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="convert" type="button">Convert</button><button class="btn btn-secondary" id="copy" type="button">Copy output</button><button class="btn btn-secondary" id="swap" type="button">Swap direction</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><strong>Output</strong><pre id="output" class="code-output">—</pre><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const note=(m,b=false)=>{const e=$('note');e.textContent=m;e.className='helper'+(b?' danger':'');};
function stripComment(s){let q=null;for(let i=0;i<s.length;i++){const c=s[i];if((c==="'"||c==='"')&&(i===0||s[i-1]!=='\\'))q=q===c?null:(q||c);if(c==='#'&&!q&&i>0&&/\s/.test(s[i-1]))return s.slice(0,i).trimEnd();}return s;}
function scalar(v){v=v.trim();if(v==='')return {};if(v==='null'||v==='~')return null;if(/^(true|false)$/i.test(v))return v.toLowerCase()==='true';if(/^[-+]?\d+(?:\.\d+)?(?:e[-+]?\d+)?$/i.test(v))return Number(v);if((v[0]==='"'&&v.at(-1)==='"')||(v[0]==="'"&&v.at(-1)==="'")){if(v[0]==='"')return JSON.parse(v);return v.slice(1,-1).replace(/''/g,"'");}if((v[0]==='['&&v.at(-1)===']')||(v[0]==='{'&&v.at(-1)==='}')){try{return JSON.parse(v.replace(/'/g,'"'));}catch(e){}}return v;}
function parseYaml(text){
 const raw=text.replace(/\t/g,'    ').split(/\r?\n/).map((line,i)=>({n:i+1,indent:(line.match(/^ */)||[''])[0].length,text:stripComment(line.trim())})).filter(x=>x.text);
 if(!raw.length)return {};
 const root=raw[0].text.startsWith('- ')?[]:{}; const stack=[{indent:-1,val:root}];
 for(let idx=0;idx<raw.length;idx++){
  const row=raw[idx];while(stack.length>1&&row.indent<=stack.at(-1).indent)stack.pop();const parent=stack.at(-1).val;
  if(row.text.startsWith('-')){
   if(!Array.isArray(parent))throw new Error(`Line ${row.n}: sequence item is not inside a list`);
   const item=row.text.slice(1).trim();
   if(!item){const next=raw[idx+1];const child=next&&next.indent>row.indent&&next.text.startsWith('-')?[]:{};parent.push(child);stack.push({indent:row.indent,val:child});continue;}
   const m=item.match(/^([^:]+):(.*)$/);
   if(m){const obj={};parent.push(obj);const key=m[1].trim();const rest=m[2].trim();if(rest)obj[key]=scalar(rest);else{const next=raw[idx+1];const child=next&&next.indent>row.indent&&next.text.startsWith('-')?[]:{};obj[key]=child;stack.push({indent:row.indent,val:child});}}
   else parent.push(scalar(item));continue;
  }
  const m=row.text.match(/^([^:]+):(.*)$/);if(!m)throw new Error(`Line ${row.n}: expected "key: value"`);
  if(Array.isArray(parent))throw new Error(`Line ${row.n}: mapping entry is not inside an object`);
  const key=m[1].trim();const rest=m[2].trim();
  if(rest)parent[key]=scalar(rest);else{const next=raw[idx+1];const child=next&&next.indent>row.indent&&next.text.startsWith('-')?[]:{};parent[key]=child;stack.push({indent:row.indent,val:child});}
 }
 return root;
}
function quoteYaml(s){if(s===''||/[:#\[\]{},&*!|>'"%@`\n\r]|^(?:null|true|false|yes|no|on|off|[-+]?\d)/i.test(s))return JSON.stringify(s);return s;}
function toYaml(v,ind=0,step=2){
 const pad=' '.repeat(ind);
 if(Array.isArray(v))return v.map(x=>{if(x&&typeof x==='object'){const nested=toYaml(x,ind+step,step);return pad+'-\n'+nested;}return pad+'- '+formatScalar(x);}).join('\n');
 if(v&&typeof v==='object')return Object.entries(v).map(([k,x])=>{const key=quoteYaml(k);if(x&&typeof x==='object')return pad+key+':\n'+toYaml(x,ind+step,step);return pad+key+': '+formatScalar(x);}).join('\n');
 return pad+formatScalar(v);
}
function formatScalar(v){if(v===null)return 'null';if(typeof v==='boolean'||typeof v==='number')return String(v);return quoteYaml(String(v));}
function go(){try{const dir=$('direction').value,step=Number($('indent').value);let out;if(dir==='y2j')out=JSON.stringify(parseYaml($('input').value),null,step);else out=toYaml(JSON.parse($('input').value),0,step);$('output').textContent=out;note(dir==='y2j'?'Converted common YAML mappings, sequences and scalar values to JSON.':'Converted JSON objects and arrays to block-style YAML.');}catch(e){$('output').textContent='—';note(e.message,true);}}
$('convert').addEventListener('click',go);$('direction').addEventListener('change',go);$('indent').addEventListener('change',go);
$('copy').addEventListener('click',async()=>{if($('output').textContent!=='—'){await navigator.clipboard.writeText($('output').textContent);note('Output copied.');}});
$('swap').addEventListener('click',()=>{const out=$('output').textContent;if(out!=='—')$('input').value=out;$('direction').value=$('direction').value==='y2j'?'j2y':'y2j';go();});
$('reset').addEventListener('click',()=>{$('direction').value='y2j';$('indent').value='2';$('input').value='name: ToolboxKart\nenabled: true\nports:\n  - 80\n  - 443\ndatabase:\n  host: localhost\n  retries: 3';go();});go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>YAML to JSON and JSON to YAML conversion</h2>
<p>This YAML ↔ JSON converter is aimed at everyday configuration work: nested mappings, lists, strings, numbers, booleans and null values. YAML input is parsed into a data structure before JSON is produced, so indentation matters. JSON input is validated by the browser before the tool emits block-style YAML.</p>
<h2>Where this converter is useful</h2>
<p>Developers and DevOps teams often need to move configuration between API payloads, CI files, container settings and application configuration. A local converter is especially convenient for quick inspection because the pasted data does not need to be uploaded to a third-party service.</p>
<h2>YAML support and limitations</h2>
<p>YAML 1.2 is a large serialization language with advanced features such as anchors, aliases, tags, directives, complex keys and multiple documents. This lightweight browser tool intentionally supports the common subset used in simple configuration files rather than claiming full YAML 1.2 compliance. For advanced YAML, validate the result with the parser used by your application.</p>
<h2>Formatting guidance</h2>
<p>Use spaces rather than tabs for indentation. If a scalar contains punctuation that could be interpreted as YAML syntax, quote it. When converting JSON to YAML, the tool adds quotes where needed to reduce ambiguity.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Does this YAML JSON converter support nested objects and lists?','Yes. It supports common indentation-based mappings and sequences plus strings, numbers, booleans and null values.'],['Is it a complete YAML 1.2 parser?','No. YAML includes advanced features such as anchors, aliases, tags, directives and multi-document streams. This tool focuses on the common configuration subset.'],['Why did my YAML fail to parse?','Check indentation, tabs, missing colons and list placement. Complex YAML features may also be outside the supported subset.'],['Does my configuration leave the browser?','No. Conversion is performed locally.']];
require __DIR__.'/../includes/tool-template.php';
