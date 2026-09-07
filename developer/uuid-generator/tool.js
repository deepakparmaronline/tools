document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
let n=Math.max(1,Math.min(100,H.n('count')||1)); const arr=[]; for(let i=0;i<n;i++){let u=crypto.randomUUID(); if(!H.checked('hyphens'))u=u.replace(/-/g,''); if(H.checked('upper'))u=u.toUpperCase(); arr.push(u);} H.code(arr.join('\n'),'uuids.txt'); H.cards([['Generated',H.num(n)],['Version','UUID v4']]);
}));
