document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const x=H.n('x'),y=H.n('y'),m=H.v('mode'); let result,label;if(m==='of'){result=x/100*y;label=`${x}% of ${y}`;}else if(m==='what'){if(y===0)return H.err('Y cannot be zero for this calculation.');result=x/y*100;label=`${x} is this percent of ${y}`;}else{if(x===0)return H.err('Starting value X cannot be zero for percentage change.');result=(y-x)/Math.abs(x)*100;label=`Change from ${x} to ${y}`;} H.cards([[label,m==='of'?H.num(result):H.pct(result)]]);
}));
