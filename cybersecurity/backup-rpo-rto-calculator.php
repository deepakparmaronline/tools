<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('cybersecurity','backup-rpo-rto-calculator');
ob_start();
?>
<h2>Compare backup capability with RPO and RTO targets</h2>
<p class="lead">Enter business recovery objectives and actual backup/recovery timings to surface RPO or RTO gaps.</p>
<div class="form-grid"><div class="field"><label for="backupInterval">Actual backup / replication interval (minutes)</label><input id="backupInterval" type="number" value="60" min="0" step="any"></div><div class="field"><label for="rpo">Business RPO target (minutes)</label><input id="rpo" type="number" value="120" min="0" step="any"></div><div class="field"><label for="detect">Detection / declaration time (minutes)</label><input id="detect" type="number" value="15" min="0" step="any"></div><div class="field"><label for="restore">Restore / failover time (minutes)</label><input id="restore" type="number" value="90" min="0" step="any"></div><div class="field"><label for="validate">Validation & service restart time (minutes)</label><input id="validate" type="number" value="30" min="0" step="any"></div><div class="field"><label for="rto">Business RTO target (minutes)</label><input id="rto" type="number" value="180" min="0" step="any"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>

<div class="result-box"><div class="result-grid"><div class="metric"><span>Potential data-loss window</span><strong id="loss">—</strong></div><div class="metric"><span>RPO comparison</span><strong id="rpoStatus">—</strong></div><div class="metric"><span>Estimated recovery time</span><strong id="recovery">—</strong></div><div class="metric"><span>RTO comparison</span><strong id="rtoStatus">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const n=id=>{const v=parseFloat($(id)?.value);return Number.isFinite(v)?v:NaN;};
const fmt=(v,d=2)=>Number.isFinite(v)?v.toLocaleString(undefined,{maximumFractionDigits:d}):'—';
const money=(v,c='')=>Number.isFinite(v)?c+v.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}):'—';
const pct=(v,d=2)=>Number.isFinite(v)?v.toFixed(d)+'%':'—';
const note=(m,bad=false)=>{const el=$('note'); if(el){el.textContent=m||'';el.className='helper'+(bad?' danger':'');}};
function go(){ 
const bi=n('backupInterval'),rpo=n('rpo'),d=n('detect'),r=n('restore'),v=n('validate'),rto=n('rto');if(![bi,rpo,d,r,v,rto].every(Number.isFinite)||[bi,rpo,d,r,v,rto].some(x=>x<0)){note('Enter non-negative times.',true);return;}const recovery=d+r+v;$('loss').textContent=fmt(bi,0)+' min worst-case interval';$('rpoStatus').textContent=bi<=rpo?'Meets entered RPO':'RPO gap: '+fmt(bi-rpo,0)+' min';$('recovery').textContent=fmt(recovery,0)+' min';$('rtoStatus').textContent=recovery<=rto?'Meets entered RTO':'RTO gap: '+fmt(recovery-rto,0)+' min';note('RPO is a tolerated data-loss point in time; RTO is the tolerated recovery duration. These are business objectives, not values a calculator should invent.');
 }
$('calc')?.addEventListener('click',go);
$('reset')?.addEventListener('click',()=>{document.querySelectorAll('.tool-panel input,.tool-panel textarea,.tool-panel select').forEach(el=>{if(el.tagName==='SELECT')el.selectedIndex=0; else el.value=el.defaultValue;});go();});
$('backupInterval')?.addEventListener('input',go);$('backupInterval')?.addEventListener('change',go);$('rpo')?.addEventListener('input',go);$('rpo')?.addEventListener('change',go);$('detect')?.addEventListener('input',go);$('detect')?.addEventListener('change',go);$('restore')?.addEventListener('input',go);$('restore')?.addEventListener('change',go);$('validate')?.addEventListener('input',go);$('validate')?.addEventListener('change',go);$('rto')?.addEventListener('input',go);$('rto')?.addEventListener('change',go);
go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>RPO and RTO are different recovery objectives</h2><p>Recovery Point Objective (RPO) describes the point in time to which data must be recovered after an outage, which is closely related to tolerated data loss. Recovery Time Objective (RTO) describes how long recovery can take before business impact becomes unacceptable. The calculator therefore compares your entered capability with business-defined targets instead of guessing the objectives.</p>
<h2>How the backup RPO/RTO calculator works</h2><p>The backup or replication interval is used as a simple worst-case data-loss window. Estimated recovery time adds detection/declaration, restore or failover, and validation/restart time. Each result is compared independently with the entered RPO and RTO.</p>
<h2>Use realistic end-to-end recovery timings</h2><p>A backup completing every hour does not prove the service can be restored within an hour. Include time to discover the incident, obtain access, provision infrastructure, restore data, validate integrity and return the application to users.</p>
<h2>Important limitation</h2><p>Real recovery design also depends on backup success rate, immutable/offline copies, dependency order, network capacity, data consistency and tested procedures. A passing arithmetic result should be confirmed through recovery exercises.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is RPO?','RPO is the point in time to which data must be recovered after an outage; it represents tolerated data-loss exposure.'],['What is RTO?','RTO is the overall recovery time objective for returning a system or process to an acceptable operating state.'],['Is backup frequency the same as RPO?','Not exactly. Backup interval is one technical factor; successful recoverability, replication lag and business requirements also matter.'],['How do I know whether an RTO is realistic?','Measure end-to-end recovery through tests or exercises, including detection, restore, validation and dependent services.']];
require __DIR__.'/../includes/tool-template.php';
