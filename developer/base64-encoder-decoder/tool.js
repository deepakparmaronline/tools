document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const x=H.v('input'); try{let out;if(H.v('mode')==='encode'){const bytes=new TextEncoder().encode(x); let bin=''; bytes.forEach(b=>bin+=String.fromCharCode(b)); out=btoa(bin);}else{const bin=atob(x.replace(/\s/g,'')); const bytes=Uint8Array.from(bin,c=>c.charCodeAt(0)); out=new TextDecoder().decode(bytes);} H.code(out,'base64.txt');}catch(e){H.err('Could not process the input: '+e.message);}
}));
