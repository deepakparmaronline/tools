document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const a=H.n('amount'), r=H.n('rate')/100, mode=H.v('mode'); if(a<0) return H.err('Amount cannot be negative.'); let base,tax,total; if(mode==='add'){base=a;tax=a*r;total=a+tax;}else{total=a;base=r===0?a:a/(1+r);tax=total-base;} H.cards([['Base amount',H.money(base)],['GST',H.money(tax)],['Total',H.money(total)]]);
}));
