<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('cybersecurity','ip-subnet-cidr-calculator');
ob_start();
?>
<h2>Calculate an IPv4 subnet from CIDR</h2><p class="lead">Enter an IPv4 address and prefix length to calculate network, broadcast, mask, wildcard and host range.</p>
<div class="form-grid"><div class="field"><label for="ip">IPv4 address</label><input id="ip" type="text" value="192.168.10.37"></div><div class="field"><label for="prefix">CIDR prefix</label><input id="prefix" type="number" min="0" max="32" step="1" value="24"></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Calculate subnet</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>Network address</span><strong id="network">—</strong></div><div class="metric"><span>Broadcast address</span><strong id="broadcast">—</strong></div><div class="metric"><span>Subnet mask</span><strong id="mask">—</strong></div><div class="metric"><span>Wildcard mask</span><strong id="wild">—</strong></div><div class="metric"><span>Total addresses</span><strong id="total">—</strong></div><div class="metric"><span>Usable host addresses</span><strong id="usable">—</strong></div><div class="metric"><span>First host</span><strong id="first">—</strong></div><div class="metric"><span>Last host</span><strong id="last">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id),toIp=n=>[24,16,8,0].map(s=>(n>>>s)&255).join('.');
function parseIp(s){const p=s.trim().split('.');if(p.length!==4)return null;let n=0;for(const x of p){if(!/^\d+$/.test(x)||+x<0||+x>255)return null;n=(n*256)+(+x);}return n>>>0;}
function go(){const ip=parseIp($('ip').value),p=Number($('prefix').value);if(ip===null||!Number.isInteger(p)||p<0||p>32){$('note').textContent='Enter a valid IPv4 address and prefix from /0 to /32.';$('note').className='helper danger';return;}const mask=p===0?0:(0xffffffff<<(32-p))>>>0,network=(ip&mask)>>>0,broadcast=(network|(~mask>>>0))>>>0,total=2**(32-p),wild=(~mask)>>>0;let usable,first,last,note;if(p<=30){usable=total-2;first=network+1;last=broadcast-1;note='Usable-host count excludes network and broadcast addresses.';}else if(p===31){usable=2;first=network;last=broadcast;note='/31 is commonly used for point-to-point links where both addresses can be host endpoints.';}else{usable=1;first=network;last=network;note='/32 represents a single host route.';}$('network').textContent=toIp(network)+'/'+p;$('broadcast').textContent=toIp(broadcast);$('mask').textContent=toIp(mask);$('wild').textContent=toIp(wild);$('total').textContent=total.toLocaleString();$('usable').textContent=usable.toLocaleString();$('first').textContent=toIp(first>>>0);$('last').textContent=toIp(last>>>0);$('note').textContent=note;$('note').className='helper';}
$('calc').addEventListener('click',go);$('ip').addEventListener('input',go);$('prefix').addEventListener('input',go);$('reset').addEventListener('click',()=>{$('ip').value='192.168.10.37';$('prefix').value=24;go();});go();
})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>How the IP subnet / CIDR calculator works</h2><p>IPv4 addresses contain 32 bits. A CIDR prefix such as /24 means the first 24 bits identify the network while the remaining eight bits identify addresses inside that block. The subnet mask is the same prefix shown in dotted decimal, and the wildcard mask is its bitwise inverse.</p>
<h2>Network, broadcast and host range</h2><p>For conventional subnets up to /30, the first address is the network address and the last is the broadcast address, so the calculator excludes both from the usable-host count. It treats /31 as a point-to-point special case and /32 as a single-host route.</p>
<h2>Use cases</h2><p>Network engineers and IT support teams can use the tool to validate firewall objects, DHCP ranges, route summaries, VLAN plans and address allocations without converting bits manually.</p>
<h2>IPv4 only</h2><p>This page intentionally focuses on IPv4. IPv6 uses 128-bit addressing, hexadecimal notation and different subnetting conventions, so it should not be forced into an IPv4 calculator.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['What does /24 mean?','It means 24 of the 32 IPv4 bits are the network prefix, leaving 8 bits for addresses in the subnet.'],['How many addresses are in a /24?','A /24 contains 256 total IPv4 addresses; in a conventional LAN subnet, 254 are typically usable host addresses.'],['Why does /31 show two usable addresses?','A /31 is a special point-to-point subnet convention that can use both addresses as endpoints rather than reserving network and broadcast addresses.'],['Does this calculator support IPv6?','No. It is deliberately an IPv4 CIDR calculator.']];
require __DIR__.'/../includes/tool-template.php';
