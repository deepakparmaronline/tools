document.addEventListener('DOMContentLoaded',()=>TBKTool.init(async H=>{
const file=H.file('file'); if(!file)return H.err('Choose an image first.'); const img=await H.loadImage(file), c=document.createElement('canvas');c.width=img.width;c.height=img.height;c.getContext('2d').drawImage(img,0,0); const type=H.v('format'), q=H.n('quality')/100, blob=await new Promise(r=>c.toBlob(r,type,q)); H.imageResult(blob,{original:file.size,width:img.width,height:img.height,filename:'converted.'+(type==='image/png'?'png':type==='image/jpeg'?'jpg':'webp')});
}));
