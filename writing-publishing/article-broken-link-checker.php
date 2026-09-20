<?php

function tk_public_ipv4_for_host(string $host): string {
    if (filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        if (!filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            throw new RuntimeException('Private or reserved IP addresses are not allowed.');
        }
        return $host;
    }
    $records = @dns_get_record($host, DNS_A);
    if (!$records) throw new RuntimeException('Host could not be resolved to a public IPv4 address.');
    foreach ($records as $record) {
        $ip = $record['ip'] ?? '';
        if ($ip && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) return $ip;
    }
    throw new RuntimeException('Host does not resolve to an allowed public IPv4 address.');
}
function tk_absolute_url(string $base, string $location): string {
    $location = trim($location);
    if (preg_match('~^https?://~i', $location)) return $location;
    $p = parse_url($base);
    if (!$p || empty($p['scheme']) || empty($p['host'])) throw new RuntimeException('Invalid redirect base URL.');
    $origin = $p['scheme'].'://'.$p['host'].(isset($p['port']) ? ':'.$p['port'] : '');
    if (str_starts_with($location, '//')) return $p['scheme'].':'.$location;
    if (str_starts_with($location, '/')) return $origin.$location;
    $path = $p['path'] ?? '/';
    $dir = preg_replace('~/[^/]*$~', '/', $path);
    $full = $dir.$location;
    $parts = [];
    foreach (explode('/', $full) as $seg) {
        if ($seg === '' || $seg === '.') continue;
        if ($seg === '..') array_pop($parts); else $parts[] = $seg;
    }
    return $origin.'/'.implode('/', $parts);
}
function tk_fetch_head(string $url, int $maxRedirects = 3): array {
    for ($hop = 0; $hop <= $maxRedirects; $hop++) {
        $p = parse_url($url);
        if (!$p || !isset($p['scheme'], $p['host'])) throw new RuntimeException('Enter a complete http:// or https:// URL.');
        $scheme = strtolower($p['scheme']);
        if (!in_array($scheme, ['http','https'], true)) throw new RuntimeException('Only HTTP and HTTPS URLs are allowed.');
        if (isset($p['user']) || isset($p['pass'])) throw new RuntimeException('URLs containing credentials are not allowed.');
        $port = $p['port'] ?? ($scheme === 'https' ? 443 : 80);
        if (!in_array((int)$port, [80,443], true)) throw new RuntimeException('Only standard HTTP/HTTPS ports 80 and 443 are allowed.');
        $host = strtolower($p['host']);
        if ($host === 'localhost' || str_ends_with($host, '.local')) throw new RuntimeException('Local hosts are not allowed.');
        $ip = tk_public_ipv4_for_host($host);
        $path = ($p['path'] ?? '/').(isset($p['query']) ? '?'.$p['query'] : '');
        $contextOptions = [];
        if ($scheme === 'https') {
            $contextOptions['ssl'] = [
                'verify_peer' => true,
                'verify_peer_name' => true,
                'peer_name' => $host,
                'SNI_enabled' => true,
                'disable_compression' => true,
            ];
        }
        $context = stream_context_create($contextOptions);
        $transport = $scheme === 'https' ? 'tls' : 'tcp';
        $target = $transport.'://'.$ip.':'.$port;
        $errno = 0; $errstr = '';
        $fp = @stream_socket_client($target, $errno, $errstr, 6, STREAM_CLIENT_CONNECT, $context);
        if (!$fp) throw new RuntimeException('Connection failed: '.($errstr ?: 'unable to connect'));
        stream_set_timeout($fp, 6);
        $hostHeader = $host.((($scheme === 'http' && $port !== 80) || ($scheme === 'https' && $port !== 443)) ? ':'.$port : '');
        $request = "HEAD ".$path." HTTP/1.1\r\nHost: ".$hostHeader."\r\nUser-Agent: ToolboxKart-LinkChecker/1.0\r\nAccept: */*\r\nConnection: close\r\n\r\n";
        fwrite($fp, $request);
        $raw = '';
        while (!feof($fp) && strlen($raw) < 65536) {
            $raw .= fread($fp, 4096);
            if (str_contains($raw, "\r\n\r\n")) break;
        }
        fclose($fp);
        if (!str_contains($raw, "\r\n\r\n")) throw new RuntimeException('No complete HTTP response headers were received.');
        [$head] = explode("\r\n\r\n", $raw, 2);
        $lines = preg_split("/\r\n/", $head);
        $statusLine = array_shift($lines);
        if (!preg_match('~^HTTP/\S+\s+(\d{3})~', (string)$statusLine, $m)) throw new RuntimeException('The remote server returned an invalid HTTP status line.');
        $status = (int)$m[1];
        $headers = [];
        foreach ($lines as $line) {
            if (!str_contains($line, ':')) continue;
            [$k,$v] = explode(':', $line, 2);
            $key = strtolower(trim($k)); $val = trim($v);
            if (isset($headers[$key])) $headers[$key] .= ', '.$val; else $headers[$key] = $val;
        }
        if ($status >= 300 && $status < 400 && isset($headers['location'])) {
            if ($hop === $maxRedirects) throw new RuntimeException('Too many redirects.');
            $url = tk_absolute_url($url, $headers['location']);
            continue;
        }
        return ['status'=>$status,'headers'=>$headers,'url'=>$url,'ip'=>$ip];
    }
    throw new RuntimeException('Request failed.');
}

if (isset($_GET['tk_link_check'])) {
    header('Content-Type: application/json; charset=utf-8');
    try {
        $result = tk_fetch_head((string)($_GET['url'] ?? ''));
        echo json_encode(['ok'=>true]+$result, JSON_UNESCAPED_SLASHES);
    } catch (Throwable $e) {
        http_response_code(400);
        echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
    }
    exit;
}

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','article-broken-link-checker');
ob_start();
?>

<h2>Extract and check links from an article draft</h2>
<p class="lead">Paste HTML, Markdown or plain article text to extract HTTP links and check up to 20 public URLs for obvious broken-link responses.</p>
<div class="field"><label for="article">Article content</label><textarea id="article" rows="10" placeholder="Paste HTML, Markdown or text containing URLs..."></textarea></div>
<div class="tool-actions">
 <button class="btn btn-primary" id="extract" type="button">Extract links</button>
 <button class="btn btn-secondary" id="check" type="button">Check public URLs</button>
 <button class="btn btn-secondary" id="reset" type="button">Reset</button>
</div>
<div class="result-box">
 <div class="result-grid"><div class="metric"><span>Unique HTTP(S) links</span><strong id="count">0</strong></div><div class="metric"><span>Checked</span><strong id="checked">0</strong></div><div class="metric"><span>Needs review</span><strong id="issues">0</strong></div></div>
 <div id="note" class="helper" style="margin:12px 0"></div>
 <div style="overflow:auto"><table class="data-table" style="width:100%"><thead><tr><th>URL</th><th>Status</th><th>Result</th></tr></thead><tbody id="rows"></tbody></table></div>
</div>
<script>
(()=>{
const $=id=>document.getElementById(id);let links=[];
function extractUrls(){
 const text=$('article').value, found=[];
 if(/<\s*[a-z][\s\S]*>/i.test(text)){
   try{const doc=new DOMParser().parseFromString(text,'text/html');doc.querySelectorAll('a[href]').forEach(a=>found.push(a.getAttribute('href')));}catch(e){}
 }
 const md=/\[[^\]]*\]\((https?:\/\/[^)\s]+)(?:\s+["'][^"']*["'])?\)/gi;let m;while((m=md.exec(text)))found.push(m[1]);
 const bare=/https?:\/\/[^\s<>"'`)\]]+/gi;while((m=bare.exec(text)))found.push(m[0].replace(/[.,;:!?]+$/,''));
 links=[...new Set(found.map(u=>(u||'').trim()).filter(u=>/^https?:\/\//i.test(u)))];
 render();$('note').textContent=links.length>20?'Found '+links.length+' links. Live checking is limited to the first 20 per run.':'Links are extracted locally. Use Check public URLs to request HTTP status headers.';
}
function resultLabel(status){
 if(status>=200&&status<400)return 'OK / redirect resolved';
 if(status===401||status===403)return 'Reachable but access restricted';
 if(status===404||status===410)return 'Likely broken';
 if(status>=500)return 'Server error — review';
 if(status===405)return 'HEAD not allowed — manual review';
 return 'Review response';
}
function render(results={}){
 const tb=$('rows');tb.innerHTML='';
 links.forEach((u,i)=>{const r=results[i];const tr=document.createElement('tr'),td1=document.createElement('td'),td2=document.createElement('td'),td3=document.createElement('td');td1.textContent=u;td2.textContent=r?(r.ok?String(r.status):'Error'):'—';td3.textContent=r?(r.ok?resultLabel(r.status):r.error):'Not checked';tr.append(td1,td2,td3);tb.appendChild(tr);});
 $('count').textContent=links.length;
}
async function check(){
 if(!links.length)extractUrls();const slice=links.slice(0,20),results={},btn=$('check');btn.disabled=true;$('note').textContent='Checking public links…';
 for(let start=0;start<slice.length;start+=4){
   const batch=slice.slice(start,start+4);
   await Promise.all(batch.map(async(u,j)=>{const idx=start+j;try{const res=await fetch(location.pathname+'?tk_link_check=1&url='+encodeURIComponent(u),{headers:{'Accept':'application/json'}});const data=await res.json();results[idx]=data;}catch(e){results[idx]={ok:false,error:'Request failed'};}render(results);$('checked').textContent=Object.keys(results).length;}));
 }
 let issues=0;Object.values(results).forEach(r=>{if(!r.ok||r.status>=400&&![401,403,405].includes(r.status))issues++;});
 $('issues').textContent=issues;$('note').textContent='Finished checking '+slice.length+' URL'+(slice.length===1?'':'s')+'. Restricted, HEAD-blocked or dynamic endpoints may still need manual browser verification.';btn.disabled=false;
}
$('extract').addEventListener('click',extractUrls);$('check').addEventListener('click',check);$('reset').addEventListener('click',()=>{$('article').value='';links=[];render();$('checked').textContent='0';$('issues').textContent='0';$('note').textContent='';});
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>What the article broken link checker does</h2>
<p>This tool helps editors audit outbound links before publication or during content maintenance. It extracts unique HTTP and HTTPS URLs from common HTML anchors, Markdown links and bare URLs, then can request response headers for a limited set of public links.</p>
<h3>How broken-link checking is classified</h3>
<p>Successful 2xx responses and resolved redirects are treated as reachable. A 404 or 410 is a strong broken-link signal. Authentication responses such as 401 or 403 may still point to a valid resource, while a 405 can simply mean the server refuses HEAD requests. Server errors and unusual responses should be reviewed manually.</p>
<h3>Why a link can work in a browser but fail here</h3>
<p>Some sites block automated requests, require JavaScript, use bot protection, depend on cookies, or reject HEAD requests. This checker is deliberately conservative and does not bypass those controls. It also checks only public HTTP(S) destinations and blocks private or reserved network addresses.</p>
<h3>Editorial workflow</h3>
<p>Use the checker before publishing, after migrating a site, and when refreshing older content. For links flagged for review, open the destination manually and replace obsolete sources with the most authoritative current source rather than merely removing useful citations.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Does every 404 mean the link is permanently broken?','A 404 means the requested URL was not found at the time of checking. Verify manually in case the site uses unusual routing or temporary behavior.'],['Why are 401 and 403 not automatically marked broken?','Those status codes can mean a real resource exists but requires authentication or blocks automated access.'],['Can this checker scan an entire website?','No. It is designed for links pasted from one article draft and intentionally limits live URL checks per run.'],['Does the tool access private network URLs?','No. The server-side checker allows only public HTTP or HTTPS destinations and rejects private or reserved IPv4 targets.']];
require __DIR__.'/../includes/tool-template.php';
