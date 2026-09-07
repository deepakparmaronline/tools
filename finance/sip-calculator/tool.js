document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const p=H.n('sip'), annual=H.n('return')/100, years=H.n('years'), freq=H.n('frequency'); if(p<0||years<=0||freq<=0) return H.err('Enter valid investment values.'); const periods=Math.round(years*freq), r=annual/freq; const future=r===0?p*periods:p*((Math.pow(1+r,periods)-1)/r)*(1+r); const invested=p*periods; H.cards([['Estimated value',H.money(future)],['Amount invested',H.money(invested)],['Estimated growth',H.money(future-invested)]]); H.note('This is an estimate, not a guaranteed investment return.');
}));
