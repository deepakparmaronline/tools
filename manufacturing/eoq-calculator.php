<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','eoq-calculator');
ob_start();
?>
<h2>Calculate Economic Order Quantity (EOQ)</h2><p class="lead">Estimate the order size that balances annual ordering and inventory holding costs under the classic EOQ model.</p>
<div class="form-grid"><div class="field"><label for="d">Annual demand (units)</label><input id="d" type="number" min="0.0001" step="any" value="24000"></div><div class="field"><label for="s">Ordering/setup cost per order</label><input id="s" type="number" min="0" step="any" value="80"></div><div class="field"><label for="h">Annual holding cost per unit</label><input id="h" type="number" min="0.0001" step="any" value="6"></div><div class="field"><label for="days">Operating days per year</label><input id="days" type="number" min="1" step="any" value="250"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>EOQ</span><strong id="eoq">—</strong></div><div class="metric"><span>Orders/year</span><strong id="orders">—</strong></div><div class="metric"><span>Average cycle stock</span><strong id="avg">—</strong></div><div class="metric"><span>Order interval</span><strong id="interval">—</strong></div><div class="metric"><span>Ordering + holding cost</span><strong id="cost">—</strong></div></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const d=+$('d').value,s=+$('s').value,h=+$('h').value,days=+$('days').value;if(!(d>0&&s>=0&&h>0&&days>0)){['eoq','orders','avg','interval','cost'].forEach(id=>$(id).textContent='—');return}const q=Math.sqrt(2*d*s/h),orders=q>0?d/q:Infinity,avg=q/2,cost=(q>0?d/q*s:0)+(q/2*h);$('eoq').textContent=q.toFixed(2)+' units';$('orders').textContent=Number.isFinite(orders)?orders.toFixed(2):'—';$('avg').textContent=avg.toFixed(2)+' units';$('interval').textContent=Number.isFinite(orders)?(days/orders).toFixed(2)+' days':'—';$('cost').textContent=cost.toLocaleString(undefined,{maximumFractionDigits:2})}['d','s','h','days'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>EOQ formula</h2><p>The classic Economic Order Quantity model uses <strong>EOQ = √(2DS/H)</strong>, where D is annual demand, S is ordering/setup cost per order and H is annual holding cost per unit. At the model optimum, the variable annual ordering and cycle-stock holding costs are balanced.</p>
<h2>What EOQ assumes</h2><p>Basic EOQ assumes relatively stable known demand, a fixed ordering cost, constant unit holding cost, replenishment without quantity constraints, and no stockouts within the cycle-stock model. Those assumptions can be unrealistic for seasonal, perishable, capacity-constrained or discount-driven inventory.</p>
<h2>EOQ is not a reorder point</h2><p>EOQ answers “how much to order” under the model. Reorder point answers “when to order” and must consider lead-time demand plus any safety stock. Do not use EOQ alone to set the trigger inventory level.</p>
<h2>Use economic inputs, not convenient guesses</h2><p>Ordering cost can include relevant procurement/setup/admin effort per order. Annual holding cost per unit can include capital, storage, insurance, obsolescence and shrinkage components appropriate to your organization. Purchase cost is excluded from the displayed ordering + holding total unless it changes with order size.</p>
<h2>Run sensitivity before changing purchasing policy</h2><p>EOQ changes with the square root of demand and cost assumptions, so modest input errors usually change the recommended quantity less dramatically than the raw inputs themselves. Still, test plausible ranges for order cost and holding cost before implementing a policy. Supplier minimums, case-pack quantities, shelf life, storage limits and cash constraints can require rounding or overriding the theoretical EOQ.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does EOQ minimize?','The classic model minimizes the combined variable annual ordering/setup cost and cycle-stock holding cost.'],['Is EOQ the same as safety stock?','No. EOQ is an order quantity. Safety stock is buffer inventory held for uncertainty.'],['Does EOQ include quantity discounts?','Not in this basic calculator. If unit price changes by order quantity, evaluate total cost at the discount breakpoints.'],['Why is average cycle stock EOQ divided by two?','Under the classic instantaneous-replenishment model, inventory cycles linearly from Q to zero, giving average cycle stock Q/2 before safety stock.']];
require __DIR__.'/../includes/tool-template.php';
