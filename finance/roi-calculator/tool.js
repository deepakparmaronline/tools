document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const i=H.n('invested'), r=H.n('returned'), y=H.n('years'); if(i<=0||y<=0) return H.err('Investment and holding period must be positive.'); const gain=r-i, roi=gain/i, annual=Math.pow(r/i,1/y)-1; H.cards([['ROI',H.pct(roi*100)],['Gain / loss',H.money(gain)],['Annualized ROI',Number.isFinite(annual)?H.pct(annual*100):'—']]);
}));
