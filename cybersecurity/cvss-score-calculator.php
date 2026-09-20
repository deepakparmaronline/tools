<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('cybersecurity','cvss-score-calculator');
ob_start();
?>
<h2>Calculate a CVSS v3.1 base score</h2>
<p class="lead">Choose the eight CVSS v3.1 base metrics to calculate the base score, severity and vector string locally.</p>
<div class="form-grid">
<div class="field"><label for="AV">Attack Vector (AV)</label><select id="AV"><option value="N">Network</option><option value="A">Adjacent</option><option value="L">Local</option><option value="P">Physical</option></select></div>
<div class="field"><label for="AC">Attack Complexity (AC)</label><select id="AC"><option value="L">Low</option><option value="H">High</option></select></div>
<div class="field"><label for="PR">Privileges Required (PR)</label><select id="PR"><option value="N">None</option><option value="L">Low</option><option value="H">High</option></select></div>
<div class="field"><label for="UI">User Interaction (UI)</label><select id="UI"><option value="N">None</option><option value="R">Required</option></select></div>
<div class="field"><label for="S">Scope (S)</label><select id="S"><option value="U">Unchanged</option><option value="C">Changed</option></select></div>
<div class="field"><label for="C">Confidentiality (C)</label><select id="C"><option value="H">High</option><option value="L">Low</option><option value="N">None</option></select></div>
<div class="field"><label for="I">Integrity (I)</label><select id="I"><option value="H">High</option><option value="L">Low</option><option value="N">None</option></select></div>
<div class="field"><label for="A">Availability (A)</label><select id="A"><option value="H">High</option><option value="L">Low</option><option value="N">None</option></select></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate CVSS</button><button class="btn btn-secondary" id="copy" type="button">Copy vector</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>CVSS v3.1 base score</span><strong id="score">—</strong></div><div class="metric"><span>Severity</span><strong id="severity">—</strong></div><div class="metric"><span>Impact sub-score</span><strong id="impact">—</strong></div><div class="metric"><span>Exploitability</span><strong id="exploit">—</strong></div></div><pre id="vector" class="code-output" style="margin-top:14px">—</pre><div id="note" class="helper"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const W={AV:{N:.85,A:.62,L:.55,P:.2},AC:{L:.77,H:.44},UI:{N:.85,R:.62},CIA:{N:0,L:.22,H:.56}};
const roundup1=x=>Math.ceil((x-1e-10)*10)/10;
function prWeight(pr,scope){if(scope==='U')return {N:.85,L:.62,H:.27}[pr];return {N:.85,L:.68,H:.5}[pr];}
function severity(s){if(s===0)return'None';if(s<4)return'Low';if(s<7)return'Medium';if(s<9)return'High';return'Critical';}
function go(){const av=$('AV').value,ac=$('AC').value,pr=$('PR').value,ui=$('UI').value,s=$('S').value,c=$('C').value,i=$('I').value,a=$('A').value;
const isc=1-(1-W.CIA[c])*(1-W.CIA[i])*(1-W.CIA[a]);let impact=s==='U'?6.42*isc:7.52*(isc-.029)-3.25*Math.pow(isc-.02,15);impact=Math.max(0,impact);
const exploit=8.22*W.AV[av]*W.AC[ac]*prWeight(pr,s)*W.UI[ui];let base;if(impact<=0)base=0;else base=roundup1(Math.min(s==='U'?impact+exploit:1.08*(impact+exploit),10));
const vector=`CVSS:3.1/AV:${av}/AC:${ac}/PR:${pr}/UI:${ui}/S:${s}/C:${c}/I:${i}/A:${a}`;
$('score').textContent=base.toFixed(1);$('severity').textContent=severity(base);$('impact').textContent=impact.toFixed(2);$('exploit').textContent=exploit.toFixed(2);$('vector').textContent=vector;$('note').textContent='This page calculates the CVSS v3.1 Base score. CVSS v4.0 is the newer standard; use version-appropriate scoring for your vulnerability program.';}
document.querySelectorAll('.tool-panel select').forEach(x=>x.addEventListener('change',go));$('calc').addEventListener('click',go);$('copy').addEventListener('click',async()=>navigator.clipboard.writeText($('vector').textContent));$('reset').addEventListener('click',()=>{['AV','AC','PR','UI','S'].forEach(id=>$(id).selectedIndex=0);['C','I','A'].forEach(id=>$(id).value='H');go();});go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What this CVSS score calculator covers</h2><p>This implementation calculates the CVSS v3.1 Base score from Attack Vector, Attack Complexity, Privileges Required, User Interaction, Scope, Confidentiality, Integrity and Availability. It also produces the complete v3.1 vector string so the selected metrics can be reviewed and reproduced.</p>
<h2>CVSS version matters</h2><p>CVSS v4.0 is the newer standard and changes both the metric model and scoring approach. This page intentionally labels its calculation as v3.1 because silently mixing v3.1 inputs with v4.0 scoring would be misleading. Use the version required by your vulnerability-management process and keep the vector with the numerical score.</p>
<h2>How to interpret the result</h2><p>CVSS communicates technical severity; it is not a complete business-risk score. Asset importance, exploit activity, exposure, compensating controls and environmental context can change remediation priority even when two vulnerabilities have the same Base score.</p>
<h2>Scoring discipline</h2><p>Choose metric values from the vulnerability's actual characteristics rather than from the desired severity outcome. When publishing or sharing a score, include the vector string and the CVSS version so others can reproduce the assessment.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Does this calculate CVSS v4.0?','No. This tool calculates the CVSS v3.1 Base score and labels that version explicitly. CVSS v4.0 uses a different scoring model.'],['What is a CVSS vector string?','It is a compact representation of the metric values used to derive the score, making the assessment reproducible.'],['Is CVSS the same as business risk?','No. CVSS describes vulnerability severity; business risk also depends on asset value, exposure, threat activity and controls.'],['Why keep the CVSS version with the score?','Scores from different CVSS versions are not interchangeable, so the version is necessary context.']];
require __DIR__.'/../includes/tool-template.php';
