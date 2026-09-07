document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const c=H.n('cost'),p=H.n('price'),u=Math.max(1,H.n('units')||1),t=H.v('target').trim(); if(c<0||p<=0)return H.err('Enter valid cost and selling price.'); const profit=p-c,margin=profit/p*100,markup=c?profit/c*100:Infinity; const cards=[['Profit / unit',H.money(profit)],['Margin',H.pct(margin)],['Markup',Number.isFinite(markup)?H.pct(markup):'—'],['Total profit',H.money(profit*u)]]; if(t!==''&&Number(t)<100)cards.push(['Price for target margin',H.money(c/(1-Number(t)/100))]); H.cards(cards);
}));
