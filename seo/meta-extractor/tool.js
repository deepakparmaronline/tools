document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
  const source=H.v('html').trim();
  if(!source) return H.err('Paste HTML source to analyze.');

  const doc=new DOMParser().parseFromString(source,'text/html');
  const title=doc.querySelector('title')?.textContent?.trim()||'';
  const meta=[...doc.querySelectorAll('meta')].map(el=>({
    key:el.getAttribute('name')||el.getAttribute('property')||el.getAttribute('http-equiv')||'charset',
    content:el.getAttribute('content')??el.getAttribute('charset')??''
  }));
  const canonical=[...doc.querySelectorAll('link[rel~="canonical"]')].map(el=>el.getAttribute('href')||'').filter(Boolean);
  const headings=[...doc.querySelectorAll('h1,h2,h3,h4,h5,h6')].map(el=>({level:el.tagName.toLowerCase(),text:el.textContent.replace(/\s+/g,' ').trim()})).filter(x=>x.text);
  const description=meta.find(x=>x.key.toLowerCase()==='description')?.content||'';
  const robots=meta.find(x=>x.key.toLowerCase()==='robots')?.content||'';
  const og=meta.filter(x=>x.key.toLowerCase().startsWith('og:'));
  const twitter=meta.filter(x=>x.key.toLowerCase().startsWith('twitter:'));
  const report=[
    `Title: ${title||'(missing)'}`,
    `Title length: ${title.length}`,
    `Meta description: ${description||'(missing)'}`,
    `Description length: ${description.length}`,
    `Canonical: ${canonical.join(' | ')||'(missing)'}`,
    `Robots: ${robots||'(missing)'}`,
    `Meta tags: ${meta.length}`,
    `Open Graph tags: ${og.length}`,
    `Twitter Card tags: ${twitter.length}`,
    `Headings: ${headings.length}`,
    '',
    'Metadata:',
    ...meta.map(x=>`${x.key}: ${x.content}`),
    '',
    'Canonical URLs:',
    ...(canonical.length?canonical:['(none)']),
    '',
    'Headings:',
    ...(headings.length?headings.map(x=>`${x.level.toUpperCase()}: ${x.text}`):['(none)'])
  ].join('\n');

  const esc=H.escape;
  const metaRows=meta.map(x=>`<tr><td>${esc(x.key)}</td><td>${esc(x.content)}</td><td>${x.key.toLowerCase().startsWith('og:')?'Open Graph':x.key.toLowerCase().startsWith('twitter:')?'Twitter Card':'Meta'}</td></tr>`).join('');
  const headingRows=headings.map(x=>`<tr><td>${esc(x.level.toUpperCase())}</td><td>${esc(x.text)}</td></tr>`).join('');
  const canonicalRows=canonical.map(x=>`<tr><td>${esc(x)}</td></tr>`).join('');

  H.clear();
  $('tool-result').innerHTML=`
    <div class="result-cards">
      <div class="metric"><span>Title</span><strong>${esc(title||'Missing')}</strong></div>
      <div class="metric"><span>Description</span><strong>${description?`${description.length} chars`:'Missing'}</strong></div>
      <div class="metric"><span>Meta tags</span><strong>${meta.length}</strong></div>
      <div class="metric"><span>Headings</span><strong>${headings.length}</strong></div>
    </div>
    <div class="result-table-wrap"><table class="result-table"><thead><tr><th>Meta attribute</th><th>Content</th><th>Group</th></tr></thead><tbody>${metaRows||'<tr><td colspan="3">No meta tags found.</td></tr>'}</tbody></table></div>
    <div class="result-table-wrap"><table class="result-table"><thead><tr><th>Canonical URL</th></tr></thead><tbody>${canonicalRows||'<tr><td>None found.</td></tr>'}</tbody></table></div>
    <div class="result-table-wrap"><table class="result-table"><thead><tr><th>Level</th><th>Heading</th></tr></thead><tbody>${headingRows||'<tr><td colspan="2">No headings found.</td></tr>'}</tbody></table></div>
    <div class="code-actions"><button type="button" class="mini-btn" data-copy>Copy report</button></div>
    <pre class="code-output"><code>${esc(report)}</code></pre>`;
  H.bindOutput(report);
}));
