document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
let bal=H.n('initial'), contrib=H.n('monthly'), years=H.n('years'), annual=H.n('rate')/100, c=H.n('compound'); if(years<0||c<=0) return H.err('Enter valid values.'); const months=Math.round(years*12); for(let m=1;m<=months;m++){bal+=contrib; if(m%(12/c)===0) bal*=1+annual/c;} const paid=H.n('initial')+contrib*months; H.cards([['Future balance',H.money(bal)],['Total contributed',H.money(paid)],['Estimated interest',H.money(bal-paid)]]);
}));
