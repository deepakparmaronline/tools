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

if (isset($_GET['tk_security_check'])) {
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
$tool=tool_by_path('cybersecurity','security-headers-checker');
ob_start();
?>
<h2>Check HTTP security response headers</h2>
<p class="lead">Enter a public HTTPS URL to retrieve response headers and review common browser security controls against practical OWASP-style checks.</p>
<div class="form-grid"><div class="field full"><label for="url">Public URL</label><input id="url" type="url" value="https://example.com" placeholder="https://example.com"><small>For safety, the checker only connects to public IPv4 addresses on ports 80/443 and revalidates redirects.</small></div></div>
<div class="tool-actions"><button class="btn btn-primary" id="check" type="button">Check security headers</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid"><div class="metric"><span>HTTP status</span><strong id="status">—</strong></div><div class="metric"><span>Checks passed</span><strong id="passed">—</strong></div><div class="metric"><span>Needs review</span><strong id="review">—</strong></div><div class="metric"><span>Final URL</span><strong id="final">—</strong></div></div><div id="note" class="helper" style="margin-top:12px"></div></div>
<div class="result-box"><div class="table-wrap"><table class="data-table"><thead><tr><th>Header / control</th><th>Status</th><th>Observed value</th><th>Why it matters</th></tr></thead><tbody id="rows"></tbody></table></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);const rules=[
['content-security-policy','Content-Security-Policy','Helps restrict script/resource origins and mitigate injection attacks.'],
['strict-transport-security','Strict-Transport-Security','Tells browsers to use HTTPS for future requests; relevant only on HTTPS sites.'],
['x-content-type-options','X-Content-Type-Options','nosniff reduces MIME-type confusion.'],
['referrer-policy','Referrer-Policy','Controls how much referrer information is sent to other sites.'],
['permissions-policy','Permissions-Policy','Can restrict browser features such as camera, microphone and geolocation.'],
['x-frame-options','X-Frame-Options','Legacy clickjacking control; CSP frame-ancestors can supersede it.'],
['cross-origin-opener-policy','Cross-Origin-Opener-Policy','Helps isolate top-level browsing contexts where applicable.'],
['cross-origin-resource-policy','Cross-Origin-Resource-Policy','Controls which origins may embed a resource where applicable.']
];
async function go(){const url=$('url').value.trim();$('note').textContent='Checking public response headers…';$('note').className='helper';$('rows').innerHTML='';try{const r=await fetch(location.pathname+'?tk_security_check=1&url='+encodeURIComponent(url),{headers:{'Accept':'application/json'}});const data=await r.json();if(!data.ok)throw new Error(data.error||'Check failed');let pass=0,review=0;const h=data.headers||{};for(const [key,label,why] of rules){let value=h[key]||'';let ok=!!value;if(key==='x-content-type-options'&&value)ok=/nosniff/i.test(value);if(key==='x-frame-options'&&!value&&/frame-ancestors/i.test(h['content-security-policy']||'')){ok=true;value='Covered by CSP frame-ancestors';}if(ok)pass++;else review++;const tr=document.createElement('tr');for(const text of [label,ok?'Present / check':'Review',value||'Not present',why]){const td=document.createElement('td');td.textContent=text;tr.appendChild(td);}$('rows').appendChild(tr);}$('status').textContent=data.status;$('passed').textContent=pass;$('review').textContent=review;$('final').textContent=data.url;$('note').textContent='Header presence is not the same as a secure configuration. Review directive values and application context before changing production headers.';}catch(e){$('note').textContent=e.message;$('note').className='helper danger';}}
$('check').addEventListener('click',go);$('reset').addEventListener('click',()=>{$('url').value='https://example.com';$('rows').innerHTML='';['status','passed','review','final'].forEach(id=>$(id).textContent='—');$('note').textContent='';});})();
</script>
<?php
$toolBody=ob_get_clean();
ob_start();
?>
<h2>What this security headers checker reviews</h2><p>The checker fetches the final public response headers and surfaces common browser security controls including Content-Security-Policy, Strict-Transport-Security, X-Content-Type-Options, Referrer-Policy and Permissions-Policy. It also shows framing and cross-origin headers that may be useful depending on the application.</p>
<h2>Presence is not enough</h2><p>A header can exist and still be weak, incompatible or unsafe. CSP requires directive-level review; HSTS should only be deployed after HTTPS is reliable; Permissions-Policy depends on the features the application needs. The table therefore uses “present/check” rather than claiming a missing or present header proves the site is secure.</p>
<h2>Safe URL-fetching controls</h2><p>Because a server-side header checker can otherwise be abused to probe internal services, this implementation accepts only HTTP/HTTPS, standard ports and hosts resolving to public IPv4 addresses. Redirect targets are revalidated before connection.</p>
<h2>Use the result as a review checklist</h2><p>Compare each observed value with your application's threat model and current browser guidance. Security headers are one layer of defence; they do not replace secure code, authentication, patching, TLS configuration or vulnerability management.</p>
<?php
$toolContent=ob_get_clean();
$faqs=[['Which security headers should every site have?','There is no universal list for every response type. Common browser-facing controls include CSP, HSTS on HTTPS sites, X-Content-Type-Options and Referrer-Policy, but configuration depends on application context.'],['Is X-Frame-Options still needed with CSP?','Modern CSP frame-ancestors can provide framing control. Some sites keep X-Frame-Options for compatibility, but the policies should not conflict.'],['Why does the checker block private IP addresses?','That restriction reduces server-side request forgery risk by preventing the tool from being used to query internal or local services.'],['Does passing these checks mean a site is secure?','No. Headers are only one part of web security, and even present headers need their values reviewed.']];
require __DIR__.'/../includes/tool-template.php';
