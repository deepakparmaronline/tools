document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const agent=H.v('agent').trim()||'*', allows=H.v('allow').split(/\n+/).map(x=>x.trim()).filter(Boolean), dis=H.v('disallow').split(/\n+/).map(x=>x.trim()).filter(Boolean), sm=H.v('sitemap').trim(); let lines=[`User-agent: ${agent}`]; allows.forEach(x=>lines.push(`Allow: ${x}`)); dis.forEach(x=>lines.push(`Disallow: ${x}`)); if(sm) lines.push('',`Sitemap: ${sm}`); H.code(lines.join('\n'));
}));
