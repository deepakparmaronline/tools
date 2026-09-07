document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
let w=H.n('weight'),h=H.n('height'); if(w<=0||h<=0)return H.err('Enter positive height and weight.'); let bmi;if(H.v('unit')==='metric')bmi=w/Math.pow(h/100,2);else bmi=703*w/(h*h); const cat=bmi<18.5?'Underweight':bmi<25?'Healthy range':bmi<30?'Overweight':'Obesity range'; H.cards([['BMI',bmi.toFixed(1)],['Adult category',cat]]); H.note('BMI is a screening estimate and is not medical advice or a diagnosis.');
}));
