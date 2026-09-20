<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('ecommerce','listing-title-length-checker');ob_start(); ?>
<h2>Check product title length</h2>
<p class="lead">Paste a listing title and set the character limit required by the marketplace or channel you are using.</p>
<div class="form-grid"><div class="field full"><label for="title">Listing title</label><textarea id="title">Wireless Noise Cancelling Headphones with 40-Hour Battery</textarea></div><div class="field"><label for="limit">Character limit</label><input id="limit" type="number" value="200" step="1" min="1"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Check</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Characters</span><strong id="chars">—</strong></div><div class="metric"><span>Words</span><strong id="words">—</strong></div><div class="metric"><span>Characters remaining</span><strong id="remaining">—</strong></div><div class="metric"><span>Status</span><strong id="status">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const s=$('title').value,lim=Math.max(1,num('limit'));const chars=[...s].length,words=(s.trim().match(/\S+/g)||[]).length,rem=lim-chars;$('chars').textContent=chars;$('words').textContent=words;$('remaining').textContent=rem;$('status').textContent=rem>=0?'Within limit':'Over limit';note(rem>=0?`${rem} characters remain before the configured limit.`:`Shorten the title by at least ${Math.abs(rem)} characters.`,rem<0);} $('title').addEventListener('input',go);
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>The checker counts Unicode characters in the title and compares the count with the limit you provide. It also reports whitespace-separated word count and the number of characters remaining.</p><h2>How to use the result</h2><p>Use the configured limit for the exact marketplace, category and listing type you are publishing to. A title that fits technically should still be readable and prioritize the product attributes customers use to identify the item.</p><h2>Assumptions and limitations</h2><p>Marketplace policies change and limits may differ by country, category, seller program or device. The tool does not validate prohibited terms, keyword quality or marketplace-specific style rules; it only measures length against your chosen limit.</p><h2>Example</h2><p>Because the limit is editable, the same checker can be used for Amazon, eBay, Etsy, Walmart Marketplace, Shopify feeds or internal catalog rules without hard-coding one platform policy.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does the checker use a fixed Amazon or marketplace limit?','No. Limits vary, so you enter the rule that applies to the listing you are preparing.'],['Are spaces counted as characters?','Yes. Character count includes spaces and punctuation.'],['Does it check keyword quality?','No. It measures length and word count, not relevance or marketplace search performance.'],['Does the title leave my browser?','No. The counting happens locally.']];require __DIR__.'/../includes/tool-template.php';
