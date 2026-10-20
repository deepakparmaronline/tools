
</main><footer id="site-footer" class="site-footer"></footer>
<noscript><nav class="site-nav-fallback" aria-label="Footer navigation"><a href="/content/">All articles</a><a href="/about">About</a><a href="/contact">Contact</a><a href="/privacy">Privacy</a><a href="/terms">Terms</a><a href="/disclaimer">Disclaimer</a></nav></noscript>
<div class="search-modal" role="dialog" aria-modal="true" aria-label="Search tools" hidden><div class="search-panel"><div class="search-row"><span>⌕</span><input id="siteSearch" type="search" placeholder="Search 20 tools…" autocomplete="off"><button type="button" class="search-close">Esc</button></div><div id="searchResults" class="search-results"></div></div></div>
<script>window.TOOLBOXKART_TOOLS=<?=json_encode(array_map(fn($t)=>['name'=>$t['name'],'description'=>$t['description'],'url'=>'/'.$t['category'].'/'.$t['slug']],$catalog['tools']),JSON_UNESCAPED_SLASHES)?>;</script>
</body></html>
