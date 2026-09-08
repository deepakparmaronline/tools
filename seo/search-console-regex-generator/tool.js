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
  const alternatives=values.map(escapeRE2).join('|');
  let pattern;
  if(mode==='starts') pattern=grouped && values.length>1 ? '^(?:'+alternatives+')' : '^'+alternatives;
  else if(mode==='ends') pattern=grouped && values.length>1 ? '(?:'+alternatives+')$' : alternatives+'$';
  else if(mode==='exact') pattern=grouped && values.length>1 ? '^(?:'+alternatives+')$' : '^'+alternatives+'$';
  else pattern=grouped && values.length>1 ? '(?:'+alternatives+')' : alternatives;

  if(caseSensitive) pattern='(?-i)'+pattern;

  H.code(pattern);
  const dimLabel=dimension==='page'?'Page':'Query';
  H.note(`${values.length} value${values.length===1?'':'s'} · ${dimLabel} filter · ${pattern.length} characters`);
}));
