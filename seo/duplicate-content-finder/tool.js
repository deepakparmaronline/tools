document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
  const aRaw=H.v('text_a').trim();
  const bRaw=H.v('text_b').trim();
  if(!aRaw||!bRaw) return H.err('Paste content into both text boxes.');

  const n=H.n('ngram');
  const ignoreCase=H.checked('ignore_case');
  const strip=H.checked('strip_html');
  const clean=s=>{
    let x=String(s).replace(/\u00a0/g,' ');
    if(strip) x=x.replace(/<[^>]*>/g,' ').replace(/`{1,3}/g,' ').replace(/[#*_~>]/g,' ');
    x=x.replace(/\s+/g,' ').trim();
    return ignoreCase?x.toLowerCase():x;
  };
  const tokenize=s=>clean(s).match(/[\p{L}\p{N}]+(?:['’-][\p{L}\p{N}]+)*/gu)||[];
  const grams=words=>new Set(Array.from({length:Math.max(0,words.length-n+1)},(_,i)=>words.slice(i,i+n).join(' ')));
  const sentences=s=>clean(s).split(/(?<=[.!?])\s+/).map(x=>x.trim()).filter(x=>x.length>=20);
  const intersection=(x,y)=>new Set([...x].filter(v=>y.has(v)));
  const aw=tokenize(aRaw), bw=tokenize(bRaw);
  if(aw.length<3||bw.length<3) return H.err('Each text should contain at least 3 words.');
  if(![3,4,5,6,7].includes(n)) return H.err('Choose a valid phrase size.');

  const ag=grams(aw), bg=grams(bw), shared=intersection(ag,bg);
  const union=new Set([...ag,...bg]);
  const similarity=union.size?shared.size/union.size*100:0;
  const as=sentences(aRaw), bs=sentences(bRaw);
  const aSet=new Set(as), exact=bs.filter(x=>aSet.has(x));
  const sharedPhrases=[...shared].sort((x,y)=>y.length-x.length||x.localeCompare(y)).slice(0,20);
  const verdict=similarity>=70?'High overlap':similarity>=40?'Moderate overlap':similarity>=20?'Some overlap':'Low overlap';
  const esc=H.escape;
  const report=[
    `Similarity: ${similarity.toFixed(1)}%`,
    `Verdict: ${verdict}`,
    `Words in text A: ${aw.length}`,
    `Words in text B: ${bw.length}`,
    `Shared ${n}-word phrases: ${shared.size}`,
    `Exact sentence matches: ${exact.length}`,
    '',
    `Shared ${n}-word phrases:`,
    ...(sharedPhrases.length?sharedPhrases.map(x=>`- ${x}`):['(none)']),
    '',
    'Exact sentence matches:',
    ...(exact.length?exact.slice(0,20).map(x=>`- ${x}`):['(none)'])
  ].join('\n');

  const phraseRows=sharedPhrases.map(x=>`<tr><td>${esc(x)}</td></tr>`).join('');
  const sentenceRows=exact.slice(0,20).map(x=>`<tr><td>${esc(x)}</td></tr>`).join('');
  H.clear();
  document.getElementById('tool-result').innerHTML=`
    <div class="result-cards">
      <div class="metric"><span>Similarity</span><strong>${similarity.toFixed(1)}%</strong></div>
      <div class="metric"><span>Result</span><strong>${esc(verdict)}</strong></div>
      <div class="metric"><span>Shared phrases</span><strong>${shared.size}</strong></div>
      <div class="metric"><span>Exact sentences</span><strong>${exact.length}</strong></div>
    </div>
    <div class="result-table-wrap"><table class="result-table"><thead><tr><th>Shared ${n}-word phrases</th></tr></thead><tbody>${phraseRows||'<tr><td>No shared phrases found.</td></tr>'}</tbody></table></div>
    <div class="result-table-wrap"><table class="result-table"><thead><tr><th>Exact sentence matches</th></tr></thead><tbody>${sentenceRows||'<tr><td>No exact sentence matches found.</td></tr>'}</tbody></table></div>
    <div class="code-actions"><button type="button" class="mini-btn" data-copy>Copy report</button></div>
    <pre class="code-output"><code>${esc(report)}</code></pre>`;
  H.bindOutput(report);
}));
