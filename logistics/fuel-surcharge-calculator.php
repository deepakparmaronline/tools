<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('logistics','fuel-surcharge-calculator');
ob_start();
?>
<h2>Calculate a fuel surcharge on freight</h2><p class="lead">Apply a carrier or contract fuel-surcharge percentage to the correct freight base and keep other charges separate.</p>
<div class="form-grid"><div class="field"><label for="base">Freight amount subject to surcharge</label><input id="base" type="number" min="0" step="any" value="1000"></div><div class="field"><label for="rate">Fuel surcharge (%)</label><input id="rate" type="number" min="0" step="any" value="18"></div><div class="field"><label for="other">Other/accessorial charges not subject to this surcharge</label><input id="other" type="number" min="0" step="any" value="75"></div><div class="field"><label for="currency">Currency symbol</label><input id="currency" value="$" maxlength="4"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Fuel surcharge</span><strong id="surcharge">—</strong></div><div class="metric"><span>Freight + fuel</span><strong id="freight">—</strong></div><div class="metric"><span>Total with other charges</span><strong id="total">—</strong></div></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const b=parseFloat($('base').value),r=parseFloat($('rate').value),o=parseFloat($('other').value),c=$('currency').value||'';if(!(b>=0&&r>=0&&o>=0)){['surcharge','freight','total'].forEach(id=>$(id).textContent='—');return}const s=b*r/100;$('surcharge').textContent=c+s.toLocaleString(undefined,{maximumFractionDigits:2});$('freight').textContent=c+(b+s).toLocaleString(undefined,{maximumFractionDigits:2});$('total').textContent=c+(b+s+o).toLocaleString(undefined,{maximumFractionDigits:2})}['base','rate','other','currency'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>Fuel surcharge formula</h2><p>When a carrier quotes a surcharge percentage against a defined freight base, the arithmetic is <strong>fuel surcharge = surchargeable freight × fuel surcharge rate ÷ 100</strong>. The calculator deliberately asks for the already-determined percentage rather than pretending there is one universal fuel index formula.</p>
<h2>Why carrier fuel surcharge tables differ</h2><p>Carriers and transport contracts can tie the surcharge to different diesel indexes, reference prices, update frequencies, lanes and base-rate definitions. Some accessorials may be excluded while others may be surchargeable. Always obtain the current carrier/contract table and enter the rate that applies to the shipment period.</p>
<h2>Choose the right surcharge base</h2><p>If a quote says the percentage applies only to line-haul freight, do not multiply it by taxes, duties, tolls or unrelated accessorial fees. Conversely, some contracts define a broader base. This tool keeps “other charges” outside the fuel calculation so the distinction stays visible.</p>
<h2>Use for quote reconciliation</h2><p>Compare the calculated amount with invoice fuel lines, record the effective percentage by billing period, and investigate differences caused by rate-table dates, rounding or base-charge definitions. The calculator performs arithmetic; it does not supply a live carrier rate.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Where do I get the fuel surcharge percentage?','Use the current rate from your carrier tariff, contract or published surcharge table for the relevant billing period and service.'],['Should accessorial charges be included in the surcharge base?','Only if the governing tariff or contract says they are surchargeable. Enter excluded accessorials in the separate other-charges field.'],['Does this tool use a live diesel price index?','No. Index methods differ by carrier and country, so the calculator requires you to enter the applicable percentage.'],['Can I use a negative fuel surcharge?','This tool requires a non-negative rate. If your agreement provides a fuel rebate below a reference price, calculate that contract-specific credit separately.']];
require __DIR__.'/../includes/tool-template.php';
