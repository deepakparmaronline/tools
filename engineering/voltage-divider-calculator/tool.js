document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const vin=H.n('vin'),r1=H.n('r1'),r2=H.n('r2'),load=H.optN('load'); if(r1<=0||r2<=0||(load!==null&&load<=0))return H.err('Resistance values must be positive.'); const eff=load===null?r2:1/(1/r2+1/load), out=vin*eff/(r1+eff), current=vin/(r1+eff); H.cards([['Output voltage',H.num(out,6)+' V'],['Divider current',H.num(current,9)+' A'],['Effective lower resistance',H.num(eff,3)+' Ω']]);
}));
