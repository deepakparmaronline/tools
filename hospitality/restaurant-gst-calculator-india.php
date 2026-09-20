<?php require __DIR__.'/../includes/bootstrap.php';$tool=tool_by_path('hospitality','restaurant-gst-calculator-india');ob_start(); ?>
<h2>Calculate GST on a restaurant bill</h2>
<p class="lead">Choose whether the entered bill amount is before or after GST, then enter the applicable rate.</p>
<div class="form-grid"><div class="field"><label for="mode">Bill amount type</label><select id="mode"><option value="exclusive" selected>Before GST</option><option value="inclusive">GST included</option></select></div><div class="field"><label for="amount">Bill amount</label><input id="amount" type="number" value="2000" step="0.01" min="0"></div><div class="field"><label for="rate">GST rate (%)</label><input id="rate" type="number" value="5" step="0.01" min="0" max="100"><small>Verify the rate and treatment applicable to the restaurant and supply.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Pre-GST amount</span><strong id="base">—</strong></div><div class="metric"><span>GST component</span><strong id="gst">—</strong></div><div class="metric"><span>GST-inclusive bill</span><strong id="total">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const num=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:0;};
const money=(v,c='₹')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const dec=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const pct=v=>Number.isFinite(v)?v.toFixed(2)+'%':'—';
const note=(m,bad=false)=>{const el=$('note');if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){const a=num('amount'),r=num('rate')/100,m=$('mode').value;if(a<0||r<0){note('Amount and rate cannot be negative.',true);return;}let base,total,gst;if(m==='exclusive'){base=a;gst=a*r;total=a+gst;}else{total=a;base=a/(1+r);gst=a-base;}$('base').textContent=money(base,'₹');$('gst').textContent=money(gst,'₹');$('total').textContent=money(total,'₹');note('This is bill arithmetic only; it does not determine the legally applicable restaurant GST treatment.');}
if($('calc')) $('calc').addEventListener('click',go);
if($('reset')) $('reset').addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT') el.selectedIndex=0; else el.value=el.defaultValue;});go();});
document.querySelectorAll('.tool-panel input,.tool-panel select').forEach(el=>el.addEventListener('input',go));
go();
})();
</script>
<?php $toolBody=ob_get_clean();ob_start(); ?>
<h2>How the calculation works</h2><p>For a pre-GST amount, the GST component equals base amount × entered rate. For an inclusive bill, the pre-GST amount equals inclusive total ÷ (1 + GST rate), and the GST component is the difference.</p><h2>How to use the result</h2><p>Use the tool to check bill arithmetic or to extract the tax component from an inclusive menu or package price. Always enter the rate that has been verified for the restaurant's actual supply and tax position.</p><h2>Assumptions and limitations</h2><p>Restaurant GST treatment can depend on the type of establishment, location, supply and current tax rules. Service charges, discounts and other bill components may have separate treatment. This tool does not determine eligibility, input-tax-credit treatment or filing obligations.</p><h2>Example</h2><p>At a 5% entered rate, a ₹2,000 pre-GST amount produces ₹100 GST and a ₹2,100 inclusive total.</p>
<?php $toolContent=ob_get_clean();$faqs=[['Does this tool decide whether 5% or another rate applies?','No. The rate is editable because the correct treatment must be verified for the actual supply.'],['Can it extract GST from an inclusive menu price?','Yes. Choose GST included and enter the verified GST rate.'],['Does it include service charge?','Only if the amount you enter already contains the bill components you want to calculate on.'],['Is this a GST compliance tool?','No. It provides arithmetic only and does not replace tax verification or filing software.']];require __DIR__.'/../includes/tool-template.php';
