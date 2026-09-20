<?php

require __DIR__.'/../includes/bootstrap.php';
$tool=tool_by_path('writing-publishing','readability-checker');
ob_start();
?>

<h2>Check English readability with Flesch metrics</h2>
<p class="lead">Analyze words, sentences, estimated syllables, Flesch Reading Ease and Flesch-Kincaid Grade Level for an English draft.</p>
<div class="field"><label for="text">Text to analyze</label><textarea id="text" rows="12">Clear writing helps readers understand an idea quickly. Shorter sentences and familiar words often make practical instructions easier to follow.</textarea></div>
<div class="tool-actions"><button class="btn btn-primary" id="calc" type="button">Analyze readability</button><button class="btn btn-secondary" id="reset" type="button">Reset</button></div>
<div class="result-box"><div class="result-grid">
 <div class="metric"><span>Words</span><strong id="words">—</strong></div><div class="metric"><span>Sentences</span><strong id="sentences">—</strong></div>
 <div class="metric"><span>Estimated syllables</span><strong id="syllables">—</strong></div><div class="metric"><span>Avg. words / sentence</span><strong id="wps">—</strong></div>
 <div class="metric"><span>Flesch Reading Ease</span><strong id="fre">—</strong></div><div class="metric"><span>Flesch-Kincaid grade</span><strong id="fk">—</strong></div>
 </div><div id="note" class="helper" style="margin-top:12px"></div></div>
<script>
(()=>{
const $=id=>document.getElementById(id);
function syllables(word){
 let w=word.toLowerCase().replace(/[^a-z]/g,'');if(!w)return 0;if(w.length<=3)return 1;
 w=w.replace(/(?:[^laeiouy]es|ed|[^laeiouy]e)$/,'').replace(/^y/,'');
 const m=w.match(/[aeiouy]{1,2}/g);return Math.max(1,m?m.length:1);
}
function go(){
 const t=$('text').value.trim(),ws=t.match(/[A-Za-z]+(?:['’-][A-Za-z]+)*/g)||[],parts=t.split(/[.!?]+(?:\s+|$)/).map(s=>s.trim()).filter(Boolean),s=Math.max(1,parts.length),w=ws.length,sy=ws.reduce((a,x)=>a+syllables(x),0);
 $('words').textContent=w;$('sentences').textContent=t?s:0;$('syllables').textContent=sy;
 if(!w||!t){['wps','fre','fk'].forEach(id=>$(id).textContent='—');$('note').textContent='Enter English prose to calculate readability.';return;}
 const asl=w/s,asw=sy/w,fre=206.835-1.015*asl-84.6*asw,fk=0.39*asl+11.8*asw-15.59;
 $('wps').textContent=asl.toFixed(1);$('fre').textContent=fre.toFixed(1);$('fk').textContent=Math.max(0,fk).toFixed(1);
 const label=fre>=90?'very easy':fre>=80?'easy':fre>=70?'fairly easy':fre>=60?'standard':fre>=50?'fairly difficult':fre>=30?'difficult':'very difficult';
 $('note').textContent='Estimated Flesch Reading Ease: '+label+'. Syllable counting is heuristic, so unusual names, abbreviations and technical terms can shift the score.';
}
$('calc').addEventListener('click',go);$('reset').addEventListener('click',()=>{$('text').value=$('text').defaultValue;go();});$('text').addEventListener('input',go);go();
})();
</script>

<?php
$toolBody=ob_get_clean();
ob_start();
?>

<h2>How the readability checker calculates scores</h2>
<p>The calculator uses the classic English-language Flesch Reading Ease and Flesch-Kincaid Grade Level formulas. Both depend on average sentence length and average syllables per word, but their scales are interpreted differently.</p>
<h3>Flesch Reading Ease</h3>
<p>Reading Ease is calculated as 206.835 − 1.015 × average sentence length − 84.6 × average syllables per word. Higher scores generally indicate easier English prose. The score is a writing diagnostic, not a quality score: specialist material may appropriately require technical vocabulary.</p>
<h3>Flesch-Kincaid Grade Level</h3>
<p>Grade Level is calculated as 0.39 × average sentence length + 11.8 × average syllables per word − 15.59. It estimates the U.S. school-grade level associated with the text's sentence and word complexity.</p>
<h3>Why online readability tools can disagree</h3>
<p>The formulas are fixed, but automated tokenization and syllable counting differ. Names, acronyms, URLs, numbers, hyphenated terms and domain vocabulary can produce different counts. This calculator uses a practical heuristic, so treat small score differences as approximate.</p>

<?php
$toolContent=ob_get_clean();
$faqs=[['Is a higher Flesch Reading Ease score always better?','No. The right reading level depends on the audience, purpose and subject. Accuracy and necessary technical terminology should not be sacrificed simply to maximize a score.'],['Why is the grade level only an estimate?','The formula uses sentence length and syllable density, not reader knowledge, document structure, typography or conceptual difficulty.'],['Does this work well for languages other than English?','No. These formulas and the syllable estimator are designed for English.'],['Why might another readability tool show a different score?','Tools can split sentences and words differently and may use different syllable dictionaries or heuristics.']];
require __DIR__.'/../includes/tool-template.php';
