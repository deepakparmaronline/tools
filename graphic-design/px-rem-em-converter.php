<?php
require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('graphic-design','px-rem-em-converter');
ob_start();
?>
<h2>Convert px, rem and em units</h2><p class="lead">Set the root and parent font sizes, then convert a CSS length between pixels, rem and em.</p>
<div class="form-grid"><div class="field"><label for="value">Value</label><input id="value" type="number" step="any" value="24"></div><div class="field"><label for="unit">Input unit</label><select id="unit"><option value="px">px</option><option value="rem">rem</option><option value="em">em</option></select></div><div class="field"><label for="root">Root font size (px)</label><input id="root" type="number" min="0.1" step="any" value="16"></div><div class="field"><label for="parent">Parent/current font size for em (px)</label><input id="parent" type="number" min="0.1" step="any" value="16"></div></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Pixels</span><strong id="px">—</strong></div><div class="metric"><span>rem</span><strong id="rem">—</strong></div><div class="metric"><span>em</span><strong id="em">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{const $=id=>document.getElementById(id);function go(){const v=parseFloat($('value').value),root=parseFloat($('root').value),parent=parseFloat($('parent').value),u=$('unit').value;if(!Number.isFinite(v)||!(root>0)||!(parent>0)){$('px').textContent=$('rem').textContent=$('em').textContent='—';$('note').textContent='Enter a numeric value and root/parent font sizes greater than zero.';$('note').className='helper danger';return}const px=u==='px'?v:u==='rem'?v*root:v*parent;$('px').textContent=px.toFixed(4).replace(/\.0+$/,'')+' px';$('rem').textContent=(px/root).toFixed(4).replace(/0+$/,'').replace(/\.$/,'')+' rem';$('em').textContent=(px/parent).toFixed(4).replace(/0+$/,'').replace(/\.$/,'')+' em';$('note').textContent='rem is relative to the root font size; em is relative to the element/context font size you entered.';$('note').className='helper'}['value','unit','root','parent'].forEach(id=>$(id).addEventListener('input',go));go()})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>PX to REM and EM converter for CSS</h2><p>Pixels are an absolute CSS reference unit, while <code>rem</code> and <code>em</code> are relative units. One rem equals the computed font size of the document root element. One em depends on context: for a font-size declaration it is relative to the inherited parent font size, while for many other properties it relates to the element's own computed font size.</p>
<h2>Conversion formulas</h2><p><strong>rem = px ÷ root font size</strong>. For the simplified em calculation here, <strong>em = px ÷ parent/current font size</strong>. Reverse conversion multiplies the relative value by the corresponding reference size.</p>
<h2>Why the base size matters</h2><p>Many examples assume a 16px browser default, but real sites can change the root font size and users can have accessibility preferences. Treat 16px as a common example, not a universal guarantee. Use computed styles from the actual component when exact em behavior matters.</p>
<h2>When to use relative units</h2><p>Relative units are useful for scalable typography and spacing that should respond to a font-size context. Pixels can still be appropriate for hairlines, certain icons and exact design constraints. The best unit depends on the property, component and accessibility behavior you need.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['How many pixels is 1rem?','It equals the computed root font size. If the root is 16px, 1rem is 16px; if the root is 18px, 1rem is 18px.'],['Is 1em always 16px?','No. em depends on the relevant element font-size context. The calculator lets you enter that context explicitly.'],['Why use rem for typography?','rem can keep type and spacing tied to a root scale, making system-wide scaling easier while avoiding some compounding behavior associated with nested em values.'],['Does zoom change these formulas?','Browser zoom changes rendered physical size, but the CSS-unit relationship in the stylesheet is still based on computed CSS values.']];
require __DIR__.'/../includes/tool-template.php';
