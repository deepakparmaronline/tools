document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const c=H.n('cost'),m=H.n('markup'),u=Math.max(1,H.n('units')||1); if(c<0)return H.err('Cost cannot be negative.'); const price=c*(1+m/100),profit=price-c,margin=price?profit/price*100:0; H.cards([['Selling price',H.money(price)],['Profit / unit',H.money(profit)],['Gross margin',H.pct(margin)],['Total profit',H.money(profit*u)]]);
}));
