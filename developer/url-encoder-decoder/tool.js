document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const s=H.v('input'); try{let o=H.v('mode')==='decode'?decodeURIComponent(s):(H.v('mode')==='encodeurl'?encodeURI(s):encodeURIComponent(s)); H.code(o,'url.txt');}catch(e){H.err('Invalid encoded input: '+e.message);}
}));
