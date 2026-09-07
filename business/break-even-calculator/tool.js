document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const f=H.n('fixed'),p=H.n('price'),v=H.n('variable'),t=H.n('target'); const cm=p-v; if(f<0||p<=0||v<0||cm<=0)return H.err('Selling price must be greater than variable cost.'); const exact=f/cm, units=Math.ceil(exact), target=Math.ceil((f+t)/cm); H.cards([['Break-even units',H.num(units)],['Break-even revenue',H.money(units*p)],['Contribution / unit',H.money(cm)],['Contribution margin',H.pct(cm/p*100)],['Units for target profit',H.num(target)]]);
}));
