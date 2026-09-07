const fs=require('fs'),vm=require('vm'),path=require('path');
async function run(rel,values){let captured=null;const document={addEventListener:(e,cb)=>cb(),getElementById:(id)=>({value:values[id]??'',checked:!!values[id],files:[]})};const TBKTool={init:fn=>captured=fn};vm.runInNewContext(fs.readFileSync(path.join(__dirname,'..',rel),'utf8'),{document,TBKTool,crypto,TextEncoder,TextDecoder,URL,Blob,atob,btoa,console});let cards=[];let error='';const H={v:id=>String(values[id]??''),n:id=>Number(values[id]??0),optN:id=>(values[id]===undefined||values[id]===''?null:Number(values[id])),checked:id=>!!values[id],file:id=>null,num:x=>Number(x),money:x=>Number(x),pct:x=>Number(x),eng:(x,u)=>Number(x),cards:x=>{cards=x},note:()=>{},err:m=>{error=m},ok:()=>{},table:()=>{},code:()=>{},dualCode:()=>{},diff:()=>{},serp:()=>{}};if(!captured)throw new Error('No tool initializer '+rel);await captured(H);if(error)throw new Error(error);return cards}
const approx=(a,b,t=1e-6)=>Math.abs(Number(a)-b)<=t*Math.max(1,Math.abs(b));
const tests=[
['EMI','finance/emi-calculator/tool.js',{principal:100000,rate:12,months:12},c=>approx(c[0][1],8884.8788678,1e-8)],
['GST add','finance/gst-calculator/tool.js',{amount:1000,rate:18,mode:'add'},c=>approx(c[2][1],1180)],
['ROI','finance/roi-calculator/tool.js',{invested:100,returned:120,years:1},c=>approx(c[0][1],20)],
['BMI','health/bmi-calculator/tool.js',{unit:'metric',weight:70,height:175},c=>String(c[0][1])==='22.9'],
['BMR metric','health/bmr-calculator/tool.js',{unit:'metric',sex:'male',age:30,weight:70,height:175},c=>String(c[0][1]).startsWith('1649')],
['BMR imperial','health/bmr-calculator/tool.js',{unit:'imperial',sex:'male',age:30,weight:154.324,height:68.8976},c=>String(c[0][1]).startsWith('1649')],
['Profit margin','business/profit-margin-calculator/tool.js',{cost:60,price:100,units:1,target:''},c=>approx(c[1][1],40)],
['Break even','business/break-even-calculator/tool.js',{fixed:5000,price:50,variable:20,target:0},c=>Number(c[0][1])===167],
['Commission','business/commission-calculator/tool.js',{sales:10000,rate:5,bonus:100,base:0},c=>approx(c[0][1],600)],
['AI cost','ai-agents/ai-api-cost-calculator/tool.js',{input_price:1,output_price:5,input_tokens:2000,output_tokens:500,requests:10000,cached_pct:0,cache_mult:.1},c=>approx(Number(String(c[1][1]).replace('$','')),45)],
['Ohms law','engineering/ohms-law-calculator/tool.js',{voltage:12,current:2,resistance:'',power:''},c=>String(c[2][1]).startsWith('6')&&String(c[3][1]).startsWith('24')],
['Voltage divider','engineering/voltage-divider-calculator/tool.js',{vin:12,r1:10000,r2:10000,load:''},c=>String(c[0][1]).startsWith('6')],
['Electrical power','engineering/electrical-power-calculator/tool.js',{voltage:230,current:2,pf:.8,hours:3},c=>String(c[0][1]).startsWith('368')],
];
(async()=>{let fail=0;for(const [name,file,vals,check] of tests){try{const c=await run(file,vals);if(!check(c))throw new Error('unexpected '+JSON.stringify(c));console.log('PASS',name)}catch(e){fail++;console.error('FAIL',name,e.message)}}console.log(`Summary: ${tests.length-fail}/${tests.length} passed`);process.exit(fail?1:0)})();
