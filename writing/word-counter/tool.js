document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const t=H.v('text'), words=t.trim()?t.trim().split(/\s+/):[], chars=t.length, noSpaces=t.replace(/\s/g,'').length, sentences=(t.match(/[.!?]+(?:\s|$)/g)||[]).length, paras=t.trim()?t.trim().split(/\n\s*\n/).length:0, lines=t? t.split(/\n/).length:0; H.cards([['Words',H.num(words.length)],['Characters',H.num(chars)],['No spaces',H.num(noSpaces)],['Sentences',H.num(sentences)],['Paragraphs',H.num(paras)],['Lines',H.num(lines)],['Reading time',Math.max(1,Math.ceil(words.length/200))+' min']]);
}));
