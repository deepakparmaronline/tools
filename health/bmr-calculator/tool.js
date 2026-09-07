document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const sex=H.v('sex'), age=H.n('age'); let w=H.n('weight'), h=H.n('height'); if(age<=0||w<=0||h<=0)return H.err('Enter valid values.'); if(H.v('unit')==='imperial'){w*=0.45359237;h*=2.54;} const b=10*w+6.25*h-5*age+(sex==='male'?5:-161); H.cards([['Estimated BMR',Math.round(b)+' kcal/day']]); H.note('Estimate using Mifflin–St Jeor. Individual energy needs vary.');
}));
