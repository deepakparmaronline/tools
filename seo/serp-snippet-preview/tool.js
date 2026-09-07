document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const site=H.v('site')||'Example', url=H.v('url')||'https://example.com/', title=H.v('title')||'Untitled page', d=H.v('description')||''; H.serp({site,url,title,description:d,device:H.v('device')}); H.note(`Title ${title.length} chars · Description ${d.length} chars. Search engines may rewrite snippets.`);
}));
