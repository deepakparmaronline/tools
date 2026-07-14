<?php
/**
 * Toolbox Kart — shared RSS news fetcher with server side caching.
 * Used by /finance/index.php and /seo/index.php
 *
 * How it works:
 * 1. On page load, checks the cache file's age.
 * 2. If the cache is missing or older than $ttlHours, it fetches the RSS feed fresh
 *    and overwrites the cache.
 * 3. If the fetch fails (feed down, network issue), it falls back to the last
 *    good cache so the page never shows an empty news section.
 * 4. Everything is rendered server side in PHP before the page reaches the browser.
 */

function get_cached_news($feeds, $cacheFile, $count = 6, $ttlHours = 6) {
    // $feeds is an associative array like ['Economic Times' => 'https://...', ...]
    // Accept a plain URL string too, for backwards compatibility.
    if (!is_array($feeds)) {
        $feeds = ['News' => $feeds];
    }

    $cacheDir = dirname($cacheFile);
    if (!is_dir($cacheDir)) {
        @mkdir($cacheDir, 0755, true);
    }

    $needsRefresh = true;
    if (file_exists($cacheFile)) {
        $age = time() - filemtime($cacheFile);
        if ($age < $ttlHours * 3600) {
            $needsRefresh = false;
        }
    }

    if ($needsRefresh) {
        foreach ($feeds as $sourceName => $feedUrl) {
            $items = fetch_rss_items($feedUrl, $count, $sourceName);
            if (!empty($items)) {
                @file_put_contents($cacheFile, json_encode($items));
                return $items;
            }
            // This source failed or returned nothing usable, try the next one.
        }
        // All sources failed this round, fall back to the last good cache if we have one.
        if (file_exists($cacheFile)) {
            $old = json_decode(@file_get_contents($cacheFile), true);
            if (is_array($old) && !empty($old)) {
                return $old;
            }
        }
        return [];
    }

    $data = json_decode(@file_get_contents($cacheFile), true);
    return is_array($data) ? $data : [];
}

function fetch_rss_items($feedUrl, $count, $sourceName = '') {
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36';
    $xmlStr = false;

    // Try file_get_contents first (works if allow_url_fopen is on, which it is on most Hostinger plans).
    if (ini_get('allow_url_fopen')) {
        $context = stream_context_create([
            'http' => [
                'timeout'    => 8,
                'user_agent' => $userAgent,
                'header'     => "Accept: application/rss+xml, application/xml, text/xml, */*\r\n",
            ],
        ]);
        $xmlStr = @file_get_contents($feedUrl, false, $context);
    }

    // Fallback to curl if file_get_contents didn't work.
    if (!$xmlStr && function_exists('curl_init')) {
        $ch = curl_init($feedUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_USERAGENT      => $userAgent,
            CURLOPT_HTTPHEADER     => ['Accept: application/rss+xml, application/xml, text/xml, */*'],
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $xmlStr = curl_exec($ch);
        curl_close($ch);
    }

    if (!$xmlStr) return [];

    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($xmlStr);
    if (!$xml || !isset($xml->channel->item)) return [];

    $items = [];
    $i = 0;
    foreach ($xml->channel->item as $item) {
        if ($i >= $count) break;

        $title = trim((string) $item->title);
        $link  = trim((string) $item->link);
        $pubDate = trim((string) $item->pubDate);

        $desc = trim((string) $item->description);
        $desc = strip_tags($desc);
        $desc = preg_replace('/\s+/', ' ', $desc);
        if (strlen($desc) > 140) {
            $desc = substr($desc, 0, 140) . '...';
        }

        $items[] = [
            'title'  => $title,
            'link'   => $link,
            'date'   => $pubDate ? date('d M Y', strtotime($pubDate)) : '',
            'desc'   => $desc,
            'source' => $sourceName,
        ];
        $i++;
    }

    return $items;
}