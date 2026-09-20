<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('events','wedding-cost-split-calculator');
ob_start();
?>
<h2>Split a wedding budget</h2><p class="lead">Allocate the total wedding budget among contributors and see whether the planned contributions fully cover the budget.</p>
<div class="form-grid"><div class="field"><label for="budget">Total wedding budget</label><input id="budget" type="number" min="0" step="any" value="20000"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" type="text" maxlength="6" value="$"></div></div>
<div class="table-wrap" style="margin-top:16px"><table class="data-table"><thead><tr><th>Contributor</th><th>Share %</th><th>Fixed contribution</th><th>Calculated contribution</th></tr></thead><tbody>
<tr><td>Couple</td><td><input id="p1" type="number" min="0" max="100" step="any" value="50"></td><td><input id="f1" type="number" min="0" step="any" placeholder="optional"></td><td id="o1">—</td></tr>
<tr><td>Family A</td><td><input id="p2" type="number" min="0" max="100" step="any" value="25"></td><td><input id="f2" type="number" min="0" step="any" placeholder="optional"></td><td id="o2">—</td></tr>
<tr><td>Family B</td><td><input id="p3" type="number" min="0" max="100" step="any" value="25"></td><td><input id="f3" type="number" min="0" step="any" placeholder="optional"></td><td id="o3">—</td></tr>
<tr><td>Other</td><td><input id="p4" type="number" min="0" max="100" step="any" value="0"></td><td><input id="f4" type="number" min="0" step="any" placeholder="optional"></td><td id="o4">—</td></tr>
</tbody></table></div>
<p class="helper">If a fixed contribution is entered, it overrides that contributor’s percentage. Percentages are applied to the total budget.</p>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate split</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Total contributions</span><strong id="total">—</strong></div><div class="metric"><span>Unfunded / surplus</span><strong id="gap">—</strong></div><div class="metric"><span>Percent covered</span><strong id="covered">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id),n=id=>parseFloat($(id).value),money=(v,c)=>c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});function go(){const b=n('budget'),c=$('currency').value||'';if(!Number.isFinite(b)||b<0){$('note').textContent='Enter a non-negative total budget.';$('note').className='helper danger';return;}let total=0,pct=0;for(let i=1;i<=4;i++){const p=n('p'+i),f=n('f'+i);if(Number.isFinite(p))pct+=p;let x=Number.isFinite(f)&&f>=0?f:(Number.isFinite(p)&&p>=0?b*p/100:0);total+=x;$('o'+i).textContent=money(x,c);}const gap=total-b;$('total').textContent=money(total,c);$('gap').textContent=(gap>=0?'+':'')+money(gap,c);$('covered').textContent=(b>0?(total/b*100):0).toFixed(1)+'%';let msg='Fixed contributions override percentages for that row. Revisit the split whenever the total wedding budget changes.';if(Math.abs(gap)>0.005)msg=(gap<0?'The plan is underfunded by '+money(-gap,c)+'. ':'The plan has a surplus of '+money(gap,c)+'. ')+msg;if(pct>100)msg+=' Percentage entries total '+pct.toFixed(1)+'%, but fixed overrides can change the final total.';$('note').textContent=msg;$('note').className='helper'+(gap<-.005?' danger':'');}
['budget','currency','p1','p2','p3','p4','f1','f2','f3','f4'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;$('reset').onclick=()=>{$('budget').value=20000;$('currency').value='$';[50,25,25,0].forEach((v,i)=>$('p'+(i+1)).value=v);for(let i=1;i<=4;i++)$('f'+i).value='';go();};go();})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What a wedding cost split calculator does</h2><p>This tool turns a single wedding budget into transparent contribution amounts for the couple, families or another contributor. You can use percentage shares, fixed contributions, or a mix of both.</p>
<h2>Percentage split versus fixed contribution</h2><p>A percentage keeps each person’s share proportional when the wedding budget changes. A fixed contribution is better when someone has committed to a specific amount. In this calculator, a fixed amount overrides that row’s percentage so you do not accidentally count the same contribution twice.</p>
<h2>Use the unfunded balance as a planning control</h2><p>The most useful number is often the gap between the total planned contributions and the total budget. A negative gap means the current contribution plan does not cover the budget. A positive gap can be left as contingency rather than immediately assigned to more spending.</p>
<h2>Practical wedding budgeting tip</h2><p>Keep the contribution split separate from the vendor category budget. First agree who is funding how much, then allocate the funded amount across venue, catering, photography, attire, decor, entertainment, travel and contingency. That makes changes easier to discuss without confusing contributor responsibility with vendor cost.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Do wedding contributions have to add to 100%?','Not necessarily if you use fixed contributions. The important check is whether the calculated contribution total covers the wedding budget without unintended double counting.'],['Can one contributor pay a fixed amount while others use percentages?','Yes. Enter the fixed amount for that contributor and leave the others as percentages. The fixed amount overrides the percentage on that row.'],['What does a positive unfunded/surplus number mean?','A positive number means planned contributions exceed the current wedding budget. You can keep the difference as contingency or reduce one or more contributions.'],['Should contingency be included in the total budget?','Usually yes if you want the split to fund it. Add the contingency to the total wedding budget before calculating each contributor’s share.']];
require __DIR__.'/../includes/tool-template.php';
