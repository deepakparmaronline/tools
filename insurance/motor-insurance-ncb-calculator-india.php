<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('insurance','motor-insurance-ncb-calculator-india');
ob_start();
?>
<h2>Estimate motor insurance NCB in India</h2><p class="lead">Calculate the standard no-claim bonus step and its estimated discount on the Own Damage portion of a motor premium.</p>
<div class="form-grid"><div class="field"><label for="od">Own Damage premium before NCB (₹)</label><input id="od" type="number" min="0" step="any" value="12000"></div><div class="field"><label for="years">Consecutive claim-free years</label><select id="years"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5" selected>5 or more</option></select></div><div class="field"><label for="claim">Claim made in the expiring policy period?</label><select id="claim"><option value="no">No</option><option value="yes">Yes</option></select></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate NCB</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Estimated NCB</span><strong id="ncb">—</strong></div><div class="metric"><span>Estimated OD discount</span><strong id="discount">—</strong></div><div class="metric"><span>OD premium after NCB</span><strong id="net">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const od=parseFloat($('od').value),y=+ $('years').value,claim=$('claim').value==='yes';if(!(od>=0)){$('ncb').textContent=$('discount').textContent=$('net').textContent='—';return}const table=[0,20,25,35,45,50],rate=claim?0:table[Math.min(5,Math.max(0,y))],d=od*rate/100;$('ncb').textContent=rate+'%';$('discount').textContent='₹'+d.toLocaleString('en-IN',{maximumFractionDigits:2});$('net').textContent='₹'+(od-d).toLocaleString('en-IN',{maximumFractionDigits:2});$('note').textContent=claim?'A standard NCB is generally lost after a claim, but NCB-protection add-ons/product terms can differ. Verify the insurer schedule.':'This is a standard NCB estimate applied to the Own Damage premium, not the third-party liability premium. Verify the renewal quote and policy terms.';$('note').className='helper'}['od','years','claim'].forEach(id=>$(id).addEventListener('input',go));$('calc').onclick=go;go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How motor insurance No Claim Bonus works in India</h2><p>IRDAI explains that No Claim Bonus (NCB) is a benefit on the <strong>Own Damage (OD) premium</strong> for claim-free years, generally starting at 20% and increasing up to 50%. It belongs to the insured rather than the vehicle and can generally be carried when changing insurers with appropriate proof. <a href="https://irdai.gov.in/motor-insurance" target="_blank" rel="noopener">IRDAI motor insurance consumer information</a>.</p>
<h2>Standard NCB progression used by this calculator</h2><p>The estimate uses the commonly prescribed progression of <strong>20%, 25%, 35%, 45% and 50%</strong> after one through five consecutive claim-free years. A claim in the expiring policy period is treated as resetting the standard NCB to zero for the estimate.</p>
<h2>NCB applies to Own Damage, not the full premium</h2><p>Motor insurance quotes can contain Own Damage, third-party liability, add-ons, taxes and other components. Applying the NCB percentage to the full invoice would overstate the discount. Enter only the pre-NCB OD premium in this calculator.</p>
<h2>Renewal terms can change the result</h2><p>Policy lapses, claim-protection add-ons, transfer documentation, vehicle changes and insurer/product wording can affect eligibility. Use this result as a renewal estimate and confirm the actual NCB percentage on the insurer's quote or certificate before purchase.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is the maximum NCB on motor insurance in India?','IRDAI consumer guidance describes NCB progressing up to 50% of the Own Damage premium after successive claim-free years.'],['Is NCB calculated on the total motor insurance premium?','No. NCB applies to the Own Damage premium, not the statutory third-party liability premium or automatically to every add-on.'],['Do I lose NCB after making a claim?','Under the standard structure a claim can cause the NCB to be lost at renewal. Some products offer NCB-protection add-ons, so verify your policy wording.'],['Can I transfer NCB when changing insurers?','IRDAI states that NCB belongs to the insured and can be transferred between insurers, subject to evidence/verification.']];
require __DIR__.'/../includes/tool-template.php';
