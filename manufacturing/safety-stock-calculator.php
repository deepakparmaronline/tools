<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('manufacturing','safety-stock-calculator');
ob_start();
?>
<h2>Calculate statistical safety stock</h2><p class="lead">Estimate buffer stock when both daily demand and replenishment lead time can vary.</p>
<div class="form-grid"><div class="field"><label for="demand">Average demand per day</label><input id="demand" type="number" min="0" step="any" value="100"></div><div class="field"><label for="sdDemand">Std. dev. of daily demand</label><input id="sdDemand" type="number" min="0" step="any" value="20"></div><div class="field"><label for="lead">Average lead time (days)</label><input id="lead" type="number" min="0" step="any" value="7"></div><div class="field"><label for="sdLead">Std. dev. of lead time (days)</label><input id="sdLead" type="number" min="0" step="any" value="1.2"></div><div class="field"><label for="z">Service factor (z)</label><select id="z"><option value="1.282">1.282 (~90%)</option><option value="1.645" selected>1.645 (~95%)</option><option value="1.960">1.960 (~97.5%)</option><option value="2.326">2.326 (~99%)</option></select></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Lead-time demand</span><strong id="ltd">—</strong></div><div class="metric"><span>Lead-time demand σ</span><strong id="sigma">—</strong></div><div class="metric"><span>Safety stock</span><strong id="ss">—</strong></div><div class="metric"><span>Illustrative reorder point</span><strong id="rop">—</strong></div></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const d=+$('demand').value,sd=+$('sdDemand').value,l=+$('lead').value,sl=+$('sdLead').value,z=+$('z').value;if(!(d>=0&&sd>=0&&l>=0&&sl>=0&&z>=0)){['ltd','sigma','ss','rop'].forEach(id=>$(id).textContent='—');return}const sig=Math.sqrt(l*sd*sd+d*d*sl*sl),ss=z*sig,ltd=d*l;$('ltd').textContent=ltd.toFixed(2)+' units';$('sigma').textContent=sig.toFixed(2)+' units';$('ss').textContent=Math.ceil(ss).toLocaleString()+' units';$('rop').textContent=Math.ceil(ltd+ss).toLocaleString()+' units'}['demand','sdDemand','lead','sdLead','z'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Safety stock formula with demand and lead-time variability</h2><p>This calculator uses a common independent-variability model in which lead-time-demand standard deviation is <strong>√(average lead time × demand SD² + average demand² × lead-time SD²)</strong>. Safety stock is that standard deviation multiplied by a selected z service factor. Oracle documents this combined-variability approach in inventory planning examples.</p>
<h2>Illustrative reorder point</h2><p>The displayed reorder point is <strong>average lead-time demand + safety stock</strong>. It assumes the demand/lead-time units are aligned and does not include order-review periods, minimum order quantities, pipeline-policy adjustments or known scheduled demand.</p>
<h2>No single safety-stock formula fits every inventory system</h2><p>IBM and other planning references note that safety-stock methods vary with the situation. Intermittent demand, non-normal demand, correlated demand/lead time, service-level definitions, perishability and multi-echelon networks can require different models or simulation.</p>
<h2>Service factor is not a guaranteed fill rate</h2><p>The z values correspond approximately to one-sided normal probabilities for a cycle-service interpretation. Fill rate and item-availability targets are different service concepts. Validate the selected service policy and estimate variability from clean, representative data rather than choosing a z value only because it looks conservative.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does the safety-stock result represent?','It is a statistical buffer estimate based on the entered demand/lead-time variability and z service factor under the formula assumptions.'],['What is the difference between safety stock and reorder point?','Safety stock is the uncertainty buffer; reorder point adds expected demand during replenishment lead time to that buffer.'],['Does 95% z mean a 95% fill rate?','Not necessarily. A normal z factor is commonly tied to cycle-service probability; fill rate is a different service measure.'],['Can I set lead-time standard deviation to zero?','Yes. Then the formula reduces to demand variability over a fixed average lead time.']];
require __DIR__.'/../includes/tool-template.php';
