<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('developer','unix-timestamp-converter');
ob_start();
?>
<h2>Convert Unix timestamps and dates</h2>
<p class="lead">Convert epoch values in seconds or milliseconds to readable UTC/local dates, or turn a date into Unix time without sending data anywhere.</p>
<div class="form-grid">
  <div class="field"><label for="ts">Unix timestamp</label><input id="ts" type="text" value="1767225600" inputmode="numeric"><small>Seconds and milliseconds are auto-detected. Large micro/nanosecond values are also normalized.</small></div>
  <div class="field"><label for="date">Date and time</label><input id="date" type="datetime-local" value="2026-01-01T00:00"><small>Interpreted in your browser's local time zone.</small></div>
</div>
<div class="tool-actions"><button class="btn btn-primary" id="fromTs" type="button">Timestamp → Date</button><button class="btn btn-secondary" id="fromDate" type="button">Date → Timestamp</button><button class="btn btn-secondary" id="now" type="button">Use current time</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid">
<div class="metric"><span>UTC</span><strong id="utc">—</strong></div>
<div class="metric"><span>Local time</span><strong id="local">—</strong></div>
<div class="metric"><span>Unix seconds</span><strong id="sec">—</strong></div>
<div class="metric"><span>Unix milliseconds</span><strong id="ms">—</strong></div>
<div class="metric"><span>Detected unit</span><strong id="unit">—</strong></div>
<div class="metric"><span>ISO 8601</span><strong id="iso">—</strong></div>
</div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
const set=(d,unit)=>{if(!(d instanceof Date)||Number.isNaN(d.getTime())){note('Enter a valid timestamp or date.',true);return;} $('utc').textContent=d.toUTCString(); $('local').textContent=d.toLocaleString(); $('sec').textContent=Math.floor(d.getTime()/1000).toString(); $('ms').textContent=d.getTime().toString(); $('unit').textContent=unit; $('iso').textContent=d.toISOString(); note('Conversion is performed locally. Unix time does not contain a time zone; the local display uses your browser time zone.');};
const note=(m,b=false)=>{const e=$('note');e.textContent=m;e.className='helper'+(b?' danger':'');};
function parseTs(){let raw=$('ts').value.trim(); if(!/^-?\d+(?:\.\d+)?$/.test(raw)){note('Timestamp must be numeric.',true);return;} let v=Number(raw),unit='seconds'; let ms;if(Math.abs(v)>=1e17){ms=v/1e6;unit='nanoseconds';}else if(Math.abs(v)>=1e14){ms=v/1e3;unit='microseconds';}else if(Math.abs(v)>=1e11){ms=v;unit='milliseconds';}else{ms=v*1000;unit='seconds';} set(new Date(ms),unit);}
function parseDate(){const v=$('date').value;if(!v){note('Choose a date and time.',true);return;} const d=new Date(v);set(d,'date input');}
$('fromTs').addEventListener('click',parseTs);$('fromDate').addEventListener('click',parseDate);
$('now').addEventListener('click',()=>{const d=new Date();$('ts').value=Math.floor(d.getTime()/1000);const pad=n=>String(n).padStart(2,'0');$('date').value=`${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;set(d,'current time');});
$('reset').addEventListener('click',()=>{$('ts').value='1767225600';$('date').value='2026-01-01T00:00';parseTs();});parseTs();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How this Unix timestamp converter works</h2>
<p>A Unix timestamp represents elapsed time from the Unix epoch. This converter accepts common epoch values and automatically distinguishes seconds from millisecond-sized values. It also normalizes very large microsecond and nanosecond inputs before creating a browser date object. The reverse conversion takes a local date-time input and returns both Unix seconds and milliseconds.</p>
<h2>Use UTC and local time correctly</h2>
<p>The epoch number itself has no time-zone label. The UTC result is the same instant everywhere, while the local result is formatted using the time zone configured in your browser or operating system. That distinction is useful when debugging API payloads, logs, database records, scheduled jobs and analytics events.</p>
<h2>Precision and practical limits</h2>
<p>JavaScript dates are stored with millisecond precision, so microsecond and nanosecond input is reduced to milliseconds for display. Extremely distant dates can exceed the browser date range. For production systems, also confirm whether an upstream service expects seconds, milliseconds or another unit before copying a value.</p>
<h2>Common developer workflow</h2>
<p>Paste an epoch value from a log or API response to inspect the corresponding ISO 8601 time. When preparing a request in the other direction, choose a local date, then copy the seconds or milliseconds value required by the target system.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What is a Unix timestamp?','It is a numeric representation of elapsed time from the Unix epoch. Many systems store it in seconds, while JavaScript and some APIs commonly use milliseconds.'],['Does the converter support milliseconds?','Yes. The tool auto-detects values that look like milliseconds and also normalizes very large microsecond or nanosecond inputs.'],['Why do UTC and local time look different?','They are two displays of the same instant. UTC is time-zone neutral, while the local display uses the time zone configured in your browser.'],['Is the timestamp uploaded anywhere?','No. Conversion runs in the browser.']];
require __DIR__.'/../includes/tool-template.php';
