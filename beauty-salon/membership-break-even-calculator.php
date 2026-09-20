<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('beauty-salon','membership-break-even-calculator');
ob_start();
?>
<h2>Calculate membership break-even</h2>
<p class="lead">Find contribution per member, break-even member count and monthly program contribution at a forecast membership level.</p>
<div class="form-grid"><div class="field"><label for="price">Monthly membership price</label><input id="price" type="number" value="2500" min="0" step="any"></div><div class="field"><label for="variable">Variable cost per member/month</label><input id="variable" type="number" value="700" min="0" step="any"></div><div class="field"><label for="fixed">Membership program fixed cost/month</label><input id="fixed" type="number" value="50000" min="0" step="any"></div><div class="field"><label for="members">Current / forecast members</label><input id="members" type="number" value="40" min="0" step="1"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" value="₹"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Contribution per member</span><strong id="contrib">—</strong></div><div class="metric"><span>Break-even members</span><strong id="be">—</strong></div><div class="metric"><span>Membership revenue</span><strong id="revenue">—</strong></div><div class="metric"><span>Contribution after fixed cost</span><strong id="profit">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const p=n('price'),v=n('variable'),f=n('fixed'),m=n('members');if(![p,v,f,m].every(Number.isFinite)||p<0||v<0||f<0||m<0){note('Enter non-negative values.',true);return;}const contrib=p-v,c=$('currency').value||'';const be=contrib>0?Math.ceil(f/contrib):NaN,profit=m*contrib-f;$('contrib').textContent=money(contrib,c);$('be').textContent=Number.isFinite(be)?be+' members':'No break-even';$('revenue').textContent=money(m*p,c);$('profit').textContent=money(profit,c);note(contrib<=0?'Membership price must exceed variable cost for a positive contribution margin.':'Break-even members = monthly fixed program cost ÷ contribution per member.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('price')?.addEventListener('input',go);$('price')?.addEventListener('change',go);$('variable')?.addEventListener('input',go);$('variable')?.addEventListener('change',go);$('fixed')?.addEventListener('input',go);$('fixed')?.addEventListener('change',go);$('members')?.addEventListener('input',go);$('members')?.addEventListener('change',go);$('currency')?.addEventListener('input',go);$('currency')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the membership break-even calculator works</h2><p>Contribution per member equals membership fee minus variable member cost. Monthly fixed program cost divided by that contribution gives the number of active members needed to cover the program's entered fixed cost.</p><h2>How salons and spas can use it</h2><p>Use the calculator when pricing recurring salon or spa memberships, testing included-service economics, or deciding whether a discount-heavy membership still contributes enough to support administration and capacity.</p><h2>Assumptions to review</h2><p>Variable cost should include benefits that scale with member usage, not just product cost. If members redeem services that displace full-price demand, consider opportunity cost separately. Churn and acquisition cost are also outside this simple monthly break-even view.</p><h2>Example</h2><p>A ₹2,500 membership with ₹700 variable cost contributes ₹1,800 per member. A ₹50,000 monthly fixed program cost therefore requires about 28 active members to break even.</p>
<h3>Test salon membership economics before setting the fee</h3>
<p>A salon membership break-even calculator should consider both recurring membership revenue and the expected cost of benefits redeemed. A plan can look profitable on subscription revenue while becoming unattractive if included services, discounts or product credits are used heavily. Model a conservative redemption rate, direct treatment cost and any incremental administration or payment fees. Then compare the required member count with current client frequency and retention so the membership target is tied to realistic customer behavior rather than an arbitrary sales goal.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is contribution per member?','Membership price minus the variable cost that changes with each member.'],['Should free included services count as a variable cost?','Include the consumables, labour or other incremental cost expected from those benefits; also consider capacity opportunity cost separately.'],['Does break-even include marketing acquisition cost?','Only if you add it to the fixed or variable cost assumptions.'],['What if contribution per member is negative?','There is no mathematical break-even because each additional member increases the loss under the entered assumptions.']];
require __DIR__.'/../includes/tool-template.php';
