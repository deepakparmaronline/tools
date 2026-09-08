document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
  const raw=H.v('terms').trim();
  const mode=H.v('match');
  const dimension=H.v('dimension');
  const grouped=H.checked('group');
  const caseSensitive=H.checked('case_sensitive');
  if(!raw) return H.err('Add at least one keyword, phrase, URL or value.');

  const values=[...new Set(raw.split(/[\n,]+/).map(v=>v.trim()).filter(Boolean))];
  if(!values.length) return H.err('Add at least one keyword, phrase, URL or value.');

  const escapeRE2=s=>s.replace(/[\\^$.*+?()[\]{}|]/g,'\\$&');
  const escaped=values.map(escapeRE2);
  const body=escaped.map(v=>{
    if(mode==='starts') return '^'+v;
    if(mode==='ends') return v+'$';
    if(mode==='exact') return '^'+v+'$';
    return v;
  }).join('|');

  const pattern=(caseSensitive?'(?-i)':'')+(grouped && escaped.length>1 ? '(?:'+body+')' : body);
  H.code(pattern);
  const dimLabel=dimension==='page'?'Page':'Query';
  H.note(`${values.length} value${values.length===1?'':'s'} · ${dimLabel} filter · ${pattern.length} characters`);
}));
