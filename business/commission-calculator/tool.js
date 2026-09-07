document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const s=H.n('sales'),r=H.n('rate'),b=H.n('bonus'),base=H.n('base'); if(s<0||r<0)return H.err('Sales and rate cannot be negative.'); const commission=s*r/100+b; H.cards([['Commission',H.money(commission)],['Commission %',H.pct(r)],['Total pay incl. base',H.money(base+commission)]]);
}));
