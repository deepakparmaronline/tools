<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('finance','gst-inclusive-exclusive-calculator-india');ob_start(); ?>
<h2>Add or extract GST</h2>
<p class="lead">Choose whether the entered amount excludes or already includes GST, then enter the applicable rate.</p>
<div class="form-grid"><div class="field"><label for="mode">Amount type</label><select id="mode"><option value="exclusive" selected>Amount excluding GST</option><option value="inclusive">Amount including GST</option></select></div><div class="field"><label for="amount">Amount</label><input id="amount" type="number" value="10000" step="0.01" min="0"></div><div class="field"><label for="rate">GST rate (%)</label><input id="rate" type="number" value="18" step="0.01" min="0" max="100"><small>Enter the rate applicable to your supply. The tool does not classify goods or services.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Taxable / base amount</span><strong id="base">—</strong></div><div class="metric"><span>GST amount</span><strong id="gst">—</strong></div><div class="metric"><span>GST-inclusive total</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='₹')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const m=$('mode').value,a=num('amount'),r=num('rate')/100;if(a<0||r<0){note('Amount and GST rate cannot be negative.',true);return;}let base,gst,total;if(m==='exclusive'){base=a;gst=a*r;total=a+gst;}else{total=a;base=r>=0?total/(1+r):total;gst=total-base;}$('base').textContent=money(base,'₹');$('gst').textContent=money(gst,'₹');$('total').textContent=money(total,'₹');note('Use the GST rate and tax treatment verified for your transaction.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>For a GST-exclusive amount, GST = base amount × GST rate and total = base + GST. For a GST-inclusive amount, base = inclusive total ÷ (1 + GST rate), and GST is the difference between the inclusive total and base.</p><h2>How to use the result</h2><p>Use this tool for invoice checks, price comparisons and extracting the tax component from a tax-inclusive figure. Enter the rate that applies to the specific supply instead of assuming the example rate applies universally.</p><h2>Assumptions and limitations</h2><p>GST rates, exemptions, place-of-supply rules, composition treatment, input tax credit and invoicing requirements depend on the transaction and can change. This calculator performs arithmetic only and does not determine the correct classification or tax position.</p><h2>Example</h2><p>At an 18% rate, ₹10,000 excluding GST produces ₹1,800 GST and an inclusive total of ₹11,800.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this choose the correct GST rate for me?','No. Enter the applicable rate after verifying the classification and tax treatment of the supply.'],['How do I extract GST from an inclusive price?','Select amount including GST. The tool divides the total by one plus the entered GST rate to find the base amount.'],['Does this split CGST, SGST or IGST?','No. It calculates the total GST component only; the legal split depends on the transaction.'],['Is this a tax filing tool?','No. It is an arithmetic calculator for planning and invoice checks.']];require __DIR__.'/../includes/tool-template.php';
