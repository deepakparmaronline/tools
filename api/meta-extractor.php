<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
function fail(string $message,int $status=400): never { http_response_code($status); echo json_encode(['ok'=>false,'error'=>$message],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); exit; }
if($_SERVER['REQUEST_METHOD']!=='POST') fail('POST requests only.',405);
$raw=file_get_contents('php://input');$input=json_decode($raw ?: '',true);
$url=is_array($input)?trim((string)($input['url']??'')):'';
if($url==='' || strlen($url)>2048) fail('Enter a valid public URL under 2,048 characters.');
$parts=parse_url($url);
if(!$parts || !isset($parts['scheme'],$parts['host']) || !in_array(strtolower((string)$parts['scheme']),['http','https'],true)) fail('Only http:// and https:// URLs are supported.');
if(isset($parts['user'])||isset($parts['pass'])) fail('URLs containing credentials are not allowed.');
$host=strtolower((string)$parts['host']);
if($host==='localhost'||$host==='127.0.0.1'||$host==='::1'||str_ends_with($host,'.local')) fail('Private or local hosts are not allowed.');
$ip=gethostbyname($host);
if($ip===$host && filter_var($host,FILTER_VALIDATE_IP)===false) fail('The hostname could not be resolved.',422);
if(filter_var($ip,FILTER_VALIDATE_IP,FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)===false) fail('Private or reserved network targets are not allowed.',422);
$ch=curl_init($url);if($ch===false) fail('Unable to start the fetcher.',500);
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_MAXREDIRS=>4,CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_TIMEOUT=>10,CURLOPT_USERAGENT=>'ToolboxKart Meta Extractor/1.0 (+https://toolboxkart.tech/)',CURLOPT_ENCODING=>'',CURLOPT_HTTPHEADER=>['Accept: text/html,application/xhtml+xml;q=0.9,*/*;q=0.1'],CURLOPT_PROTOCOLS=>CURLPROTO_HTTP|CURLPROTO_HTTPS,CURLOPT_REDIR_PROTOCOLS=>CURLPROTO_HTTP|CURLPROTO_HTTPS,CURLOPT_NOPROXY=>'*']);
$html=curl_exec($ch);$err=curl_error($ch);$status=(int)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);$statusText=(string)curl_getinfo($ch,CURLINFO_RESPONSE_CODE);$contentType=(string)curl_getinfo($ch,CURLINFO_CONTENT_TYPE);$finalUrl=(string)curl_getinfo($ch,CURLINFO_EFFECTIVE_URL);$bytes=strlen((string)$html);curl_close($ch);
if($html===false) fail($err!==''?$err:'The page could not be fetched.',502);
if($bytes>1500000) fail('The response is larger than the 1.5 MB limit.',413);
if($status<200||$status>=400) fail('The page returned HTTP '.$status.'.',502);
if(stripos($contentType,'text/html')===false && stripos($contentType,'application/xhtml+xml')===false) fail('The URL did not return HTML.',415);
libxml_use_internal_errors(true);$dom=new DOMDocument();$loaded=$dom->loadHTML('<?xml encoding="UTF-8">'.$html,LIBXML_NONET|LIBXML_NOWARNING|LIBXML_NOERROR);if(!$loaded) fail('The HTML could not be parsed.',422);$xp=new DOMXPath($dom);
$first=function(string $q)use($xp):string{$n=$xp->query($q);return($n&&$n->length)?trim((string)$n->item(0)->nodeValue):'';};
$meta=function(string $key,string $attr)use($xp):string{$q='//meta[translate(@'.$attr.',"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="'.strtolower($key).'"]';$n=$xp->query($q);return($n&&$n->length)?trim((string)$n->item(0)->getAttribute('content')):'';};
$title=$first('//title');$description=$meta('description','name');$robots=$meta('robots','name');$lang=$dom->documentElement?$dom->documentElement->getAttribute('lang'):'';$viewport=$meta('viewport','name');$canonical=$first('//link[contains(translate(@rel,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"),"canonical")]/@href');$h1=$xp->query('//h1');$h1Count=$h1?$h1->length:0;
$headings=[];$hn=$xp->query('//h1|//h2|//h3|//h4|//h5|//h6');if($hn){foreach($hn as $node){$text=preg_replace('/\s+/u',' ',trim((string)$node->textContent));if($text!=='')$headings[]=['level'=>strtoupper($node->nodeName),'text'=>mb_substr($text,0,300)];if(count($headings)>=80)break;}}
$social=[];$ogCount=0;$twitterCount=0;$metas=$xp->query('//meta[@property or @name]');if($metas){foreach($metas as $m){$prop=trim((string)$m->getAttribute('property'));$name=trim((string)$m->getAttribute('name'));$key=$prop!==''?$prop:$name;if(stripos($key,'og:')===0){$social[]=['name'=>$key,'value'=>trim((string)$m->getAttribute('content'))];$ogCount++;}elseif(stripos($name,'twitter:')===0){$social[]=['name'=>$name,'value'=>trim((string)$m->getAttribute('content'))];$twitterCount++;}if(count($social)>=40)break;}}
echo json_encode(['ok'=>true,'status'=>$status,'statusText'=>'HTTP '.$status,'contentType'=>$contentType,'bytes'=>$bytes,'finalUrl'=>$finalUrl,'title'=>$title,'description'=>$description,'robots'=>$robots,'lang'=>$lang,'viewport'=>$viewport,'canonical'=>$canonical,'h1Count'=>$h1Count,'headings'=>$headings,'social'=>$social,'ogCount'=>$ogCount,'twitterCount'=>$twitterCount],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);