document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const t=H.v('text'); H.cards([['Characters',t.length],['Without spaces',t.replace(/\s/g,'').length],['Letters',(t.match(/\p{L}/gu)||[]).length],['Digits',(t.match(/\p{N}/gu)||[]).length],['Spaces',(t.match(/\s/g)||[]).length],['Words',t.trim()?t.trim().split(/\s+/).length:0],['Lines',t? t.split(/\n/).length:0]]);
}));
