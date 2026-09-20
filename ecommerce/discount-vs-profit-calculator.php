<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('ecommerce','discount-vs-profit-calculator');ob_start(); ?>
<h2>See how discounting changes profit</h2>
<p class="lead">Enter your current price and cost, then test a discount before running a promotion.</p>
<div class="form-grid"><div class="field"><label for="price">Current selling price</label><input id="price" type="number" value="1000" step="0.01" min="0"></div><div class="field"><label for="cost">Unit cost</label><input id="cost" type="number" value="600" step="0.01" min="0"></div><div class="field"><label for="discount">Proposed discount (%)</label><input id="discount" type="number" value="10" step="0.01" min="0" max="100"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Discounted price</span><strong id="newPrice">—</strong></div><div class="metric"><span>Current unit profit</span><strong id="oldProfit">—</strong></div><div class="metric"><span>Discounted unit profit</span><strong id="newProfit">—</strong></div><div class="metric"><span>New gross margin</span><strong id="newMargin">—</strong></div><div class="metric"><span>Volume increase needed</span><strong id="uplift">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const p=num('price'),c=num('cost'),d=num('discount');if(p<=0||c<0||d<0||d>100){note('Enter a positive price, non-negative cost and discount from 0% to 100%.',true);return;}const np=p*(1-d/100),op=p-c,npr=np-c;$('newPrice').textContent=money(np,'');$('oldProfit').textContent=money(op,'');$('newProfit').textContent=money(npr,'');$('newMargin').textContent=np>0?pct(npr/np*100):'—';$('uplift').textContent=(op>0&&npr>0)?pct((op/npr-1)*100):(npr<=0?'Not recoverable':'—');note(npr<=0?'At this discount, each unit has zero or negative gross profit.':'Volume increase is the extra units needed to match current gross profit.',npr<=0);}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>The discounted price is current price × (1 − discount rate). Unit gross profit is price minus unit cost. When both old and new unit profit are positive, required volume uplift = old unit profit ÷ new unit profit − 1.</p><h2>How to use the result</h2><p>Use the volume figure as a break-even benchmark for a promotion. For example, if unit profit falls sharply, the promotion must generate enough incremental orders just to preserve the same total gross profit.</p><h2>Assumptions and limitations</h2><p>This model assumes unit cost does not change with volume and treats all sold units as equivalent. It does not estimate demand response, advertising cost, returns, fulfilment limits or customer lifetime value.</p><h2>Example</h2><p>A discount can look small as a percentage of selling price but consume a much larger percentage of unit profit when margins are already thin.</p>
<?php $toolContent=ob_get_clean();$faqs=[['What does volume increase needed mean?','It is the percentage increase in unit sales required to generate the same gross profit as before the discount, assuming constant unit cost.'],['Why can the required volume jump so quickly?','Discounts reduce revenue dollar-for-dollar while cost may stay unchanged, so they can cut unit profit disproportionately.'],['What if discounted unit profit is negative?','The tool marks the old gross profit as not recoverable through more units because each additional discounted unit loses gross profit.'],['Does this predict sales uplift?','No. It calculates the uplift required, not the uplift customers will actually produce.']];require __DIR__.'/../includes/tool-template.php';
