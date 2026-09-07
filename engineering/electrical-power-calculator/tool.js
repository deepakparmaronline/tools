document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const V=H.n('voltage'),I=H.n('current'),pf=H.n('pf'),h=H.n('hours'); if(V<0||I<0||pf<0||pf>1||h<0)return H.err('Enter valid electrical values.'); const apparent=V*I, real=apparent*pf, kwh=real*h/1000; H.cards([['Real power',H.num(real,4)+' W'],['Apparent power',H.num(apparent,4)+' VA'],['Energy',H.num(kwh,6)+' kWh']]); H.note('Single-phase estimate. Three-phase systems require a different formula.');
}));
