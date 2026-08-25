/* Tool Box Kart — shared generator engine for metadata and Schema.org tools. */
(function(){
  const root=document.getElementById('generator-app'); if(!root) return;
  const cfg=window.TBK_TOOL_CONFIG||{}; const fields=cfg.fields||[]; const state={};
  const esc=s=>String(s??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  function render(){
    root.innerHTML=`<div class="tool-card"><form id="tbk-form">${fields.map(f=>`<div class="field"><label for="${f.id}">${esc(f.label)}${f.required?' <span>*</span>':''}</label>${f.type==='textarea'?`<textarea id="${f.id}" placeholder="${esc(f.placeholder||'')}" rows="4"></textarea>`:f.type==='select'?`<select id="${f.id}">${(f.options||[]).map(o=>`<option value="${esc(o[0])}">${esc(o[1])}</option>`).join('')}</select>`:`<input id="${f.id}" type="${f.type||'text'}" placeholder="${esc(f.placeholder||'')}" ${f.required?'required':''}>`}<small>${esc(f.help||'')}</small></div>`).join('')}<button class="btn-primary" type="submit">${esc(cfg.button||'Generate')}</button></form><div id="result" class="result" hidden><div class="result-head"><strong>${esc(cfg.resultTitle||'Generated output')}</strong><button type="button" id="copy">Copy</button></div><pre id="output"></pre><div id="status" class="status"></div></div></div>`;
    root.querySelector('form').addEventListener('submit',e=>{e.preventDefault();generate();});
    root.querySelector('#copy').addEventListener('click',()=>navigator.clipboard.writeText(root.querySelector('#output').textContent).then(()=>{root.querySelector('#copy').textContent='Copied';setTimeout(()=>root.querySelector('#copy').textContent='Copy',1200);}));
  }
  function values(){fields.forEach(f=>state[f.id]=root.querySelector('#'+f.id).value.trim());return state;}
  function required(){const m=fields.filter(f=>f.required&&!state[f.id]);if(m.length){status('Please complete: '+m.map(f=>f.label).join(', '),'error');return false;}return true;}
  function cleanUrl(v){return v?( /^https?:\/\//i.test(v)?v:'https://'+v ):'';}
  function buildSchema(v){
    const s={'@type':cfg.schemaType};
    (cfg.map||[]).forEach(([k,id])=>{if(v[id])s[k]=v[id];});
    (cfg.nested||[]).forEach(([k,typ,items])=>{const o={'@type':typ};items.forEach(([p,id])=>{if(v[id])o[p]=v[id];});if(Object.keys(o).length>1)s[k]=o;});
    if(cfg.customSameAs){const sameAs=cfg.customSameAs.map(id=>cleanUrl(v[id])).filter(Boolean);if(sameAs.length)s.sameAs=sameAs;}
    if(cfg.schemaType==='FAQPage')s.mainEntity=(cfg.counts||3).map((_,i)=>({"@type":"Question",name:v['q'+i],acceptedAnswer:{"@type":"Answer",text:v['a'+i]}})).filter(x=>x.name&&x.acceptedAnswer.text);
    if(cfg.schemaType==='HowTo'){
      s.step=(cfg.counts||3).map((_,i)=>({"@type":"HowToStep",position:i+1,name:v['sn'+i],text:v['st'+i]})).filter(x=>x.name&&x.text);
      if(v.name)s.name=v.name;
      if(v.description)s.description=v.description;
      if(v.totalTime)s.totalTime=v.totalTime;
    }
    if(cfg.schemaType==='BreadcrumbList')s.itemListElement=(cfg.counts||6).map((_,i)=>({"@type":"ListItem",position:i+1,name:v['n'+i],item:cleanUrl(v['u'+i])})).filter(x=>x.name&&x.item);
    return {'@context':'https://schema.org','@graph':[s]};
  }
  function generate(){const v=values();if(!required())return;let out='';if(cfg.mode==='meta')out=`<title>${v.title||''}</title>\n<meta name="description" content="${v.description||''}">\n<link rel="canonical" href="${cleanUrl(v.canonical)}">`;else if(cfg.mode==='og')out=`<meta property="og:title" content="${v.title||''}">\n<meta property="og:description" content="${v.description||''}">\n<meta property="og:url" content="${cleanUrl(v.url)}">\n<meta property="og:type" content="${v.type||'website'}">\n${v.image?`<meta property="og:image" content="${cleanUrl(v.image)}">`:''}`;else if(cfg.mode==='twitter')out=`<meta name="twitter:card" content="${v.card||'summary_large_image'}">\n<meta name="twitter:title" content="${v.title||''}">\n<meta name="twitter:description" content="${v.description||''}">\n${v.image?`<meta name="twitter:image" content="${cleanUrl(v.image)}">`:''}`;else out=`<script type="application/ld+json">\n${JSON.stringify(buildSchema(v),null,2)}\n<\/script>`;root.querySelector('#output').textContent=out;root.querySelector('#result').hidden=false;status(cfg.success||'Your output is ready.','ok');}
  function status(msg,type){const s=root.querySelector('#status');if(s){s.textContent=msg;s.className='status '+type;}}
  render();
})();
