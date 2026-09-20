<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('events','event-budget-calculator');
ob_start();
?>
<h2>Plan an event budget and track actual costs</h2>
<p class="lead">Build an itemized event budget for a wedding, conference, party or corporate event. Compare estimates with actual or committed costs, add a contingency reserve, and calculate cost per guest.</p>
<div class="field-grid"><div class="field"><label for="budget">Overall budget</label><input id="budget" type="number" min="0" step="0.01" value="25000"></div><div class="field"><label for="guests">Expected guests</label><input id="guests" type="number" min="0" step="1" value="120"></div><div class="field"><label for="contingency">Contingency reserve (%)</label><input id="contingency" type="number" min="0" step="0.01" value="10"></div></div>
<div style="overflow-x:auto"><table style="width:100%;border-collapse:collapse"><thead><tr><th style="text-align:left;padding:8px">Budget item</th><th style="text-align:left;padding:8px">Estimated</th><th style="text-align:left;padding:8px">Actual / committed</th><th style="text-align:left;padding:8px">Variance</th><th></th></tr></thead><tbody id="rows"></tbody></table></div>
<div class="tool-actions"><button class="btn btn-secondary" id="add" type="button">Add budget item</button><button class="btn btn-primary" id="calc" type="button">Calculate event budget</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box" aria-live="polite"><div class="result-grid"><div class="metric"><span>Estimated subtotal</span><strong id="estimated">—</strong></div><div class="metric"><span>Contingency reserve</span><strong id="reserve">—</strong></div><div class="metric"><span>Planned total incl. reserve</span><strong id="planned">—</strong></div><div class="metric"><span>Actual / committed total</span><strong id="actual">—</strong></div><div class="metric"><span>Budget remaining</span><strong id="remaining">—</strong></div><div class="metric"><span>Planned cost per guest</span><strong id="perGuest">—</strong></div></div><p id="note" class="helper" style="margin-top:12px"></p></div>
<script>
(()=>{
const $=id=>document.getElementById(id);let seq=0;const money=n=>Number.isFinite(n)?n.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
function add(name='Item '+(seq+1),estimate=0,actual=0){seq++;const tr=document.createElement('tr');tr.innerHTML=`<td style="padding:6px"><input class="name" aria-label="Budget item" value="${name.replace(/"/g,'&quot;')}"></td><td style="padding:6px"><input class="est" aria-label="Estimated cost" type="number" min="0" step="0.01" value="${estimate}"></td><td style="padding:6px"><input class="act" aria-label="Actual or committed cost" type="number" min="0" step="0.01" value="${actual}"></td><td style="padding:6px" class="var">—</td><td style="padding:6px"><button type="button" class="btn btn-secondary remove">Remove</button></td>`;tr.querySelector('.remove').addEventListener('click',()=>{tr.remove();go();});tr.querySelectorAll('input').forEach(el=>el.addEventListener('input',go));$('rows').appendChild(tr);}
function go(){const budget=Number($('budget').value),guests=Number($('guests').value),cont=Number($('contingency').value);let est=0,act=0,valid=Number.isFinite(budget)&&budget>=0&&Number.isFinite(guests)&&guests>=0&&Number.isFinite(cont)&&cont>=0;[...$('rows').querySelectorAll('tr')].forEach(tr=>{const e=Number(tr.querySelector('.est').value),a=Number(tr.querySelector('.act').value);if(!Number.isFinite(e)||e<0||!Number.isFinite(a)||a<0){valid=false;tr.querySelector('.var').textContent='—';return;}est+=e;act+=a;const v=a-e;tr.querySelector('.var').textContent=(v>0?'+':'')+money(v);});
 if(!valid){['estimated','reserve','planned','actual','remaining','perGuest'].forEach(id=>$(id).textContent='—');$('note').textContent='Use non-negative numbers for the overall budget, contingency and each cost item.';return;}
 const reserve=est*cont/100,planned=est+reserve,remaining=budget-act;$('estimated').textContent=money(est);$('reserve').textContent=money(reserve);$('planned').textContent=money(planned);$('actual').textContent=money(act);$('remaining').textContent=(remaining<0?'-':'')+money(Math.abs(remaining));$('perGuest').textContent=guests>0?money(planned/guests):'—';
 const planVariance=budget-planned;$('note').textContent=(planVariance>=0?'Planned total is '+money(planVariance)+' below the stated budget.':'Planned total is '+money(Math.abs(planVariance))+' above the stated budget.')+' Actual/committed totals exclude the contingency reserve unless you add reserve spending as a line item.';
}
function reset(){seq=0;$('rows').innerHTML='';$('budget').value='25000';$('guests').value='120';$('contingency').value='10';add('Venue',6000,6000);add('Catering',8500,8200);add('Decor / production',2500,1800);add('Entertainment / AV',2200,2100);add('Photography / media',1800,1800);add('Invitations / signage',600,450);add('Transport / logistics',900,700);go();}
$('add').addEventListener('click',()=>{add();go();});$('calc').addEventListener('click',go);$('reset').addEventListener('click',reset);['budget','guests','contingency'].forEach(id=>$(id).addEventListener('input',go));reset();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How to use the event budget calculator</h2>
<p>Start with the maximum amount available for the event, then add the costs you expect to pay. Common categories include venue, catering, décor or production, audiovisual equipment, entertainment, photography, staffing, registration, invitations, transport, accommodation, permits and vendor fees. The calculator intentionally keeps these as editable line items rather than assuming one event type or one market price.</p>
<h3>Estimated budget vs actual or committed cost</h3>
<p>The estimated column is your planning baseline. The actual/committed column can hold signed contracts, deposits, invoices or known final costs. The variance for each line is <strong>actual cost − estimated cost</strong>, so positive variance means the line is running above its estimate.</p>
<h3>Contingency reserve</h3>
<p>A contingency percentage adds a reserve on top of the estimated subtotal. This gives late changes, overtime, delivery fees, guest-count shifts or other surprises somewhere to land without hiding them inside unrelated categories. The percentage is editable because appropriate reserves vary by event complexity and risk.</p>
<h3>Event cost per guest</h3>
<p>When a guest count is entered, the tool divides the planned total including contingency by expected guests. Cost per guest is useful for comparing venue or catering scenarios, but fixed expenses such as staging or photography do not necessarily fall when guest count falls.</p>
<h3>Keep taxes, service charges and payment terms visible</h3>
<p>Vendor quotes may include or exclude taxes, gratuities, service fees, delivery, overtime, deposits or cancellation charges. Add separate line items when those amounts matter so the event budget reflects the same basis across vendors.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[
 ['What should be included in an event budget?','Typical categories include venue, food and beverage, décor or production, AV, entertainment, photography, staffing, transport, invitations, accommodation, permits, taxes, service charges and contingency.'],
 ['How does the contingency calculation work?','The reserve equals the estimated subtotal multiplied by the contingency percentage you enter.'],
 ['What is event cost per guest?','It is the planned total including contingency divided by expected guests. It is a planning ratio, not a vendor quote.'],
 ['Why track estimated and actual costs separately?','Keeping both lets you see which lines are above or below plan and how much of the overall budget is already committed.']
];
require __DIR__.'/../includes/tool-template.php';
