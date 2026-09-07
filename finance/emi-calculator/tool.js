document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const P=H.n('principal'), annual=H.n('rate'), n=H.n('months'); if(P<=0||n<=0) return H.err('Enter a positive loan amount and tenure.'); const r=annual/1200; const emi=r===0?P/n:P*r*Math.pow(1+r,n)/(Math.pow(1+r,n)-1); const total=emi*n, interest=total-P; H.cards([['Monthly EMI',H.money(emi)],['Total interest',H.money(interest)],['Total repayment',H.money(total)]]); H.note('Formula: P × r × (1+r)^n ÷ ((1+r)^n − 1).');
}));
