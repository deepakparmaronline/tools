"""Help Scout cluster rendering, registry and sitemap checks."""
import json,re,subprocess,time,urllib.request,xml.etree.ElementTree as ET
from html import unescape
from html.parser import HTMLParser
from pathlib import Path
R=Path(__file__).resolve().parents[1];B="http://127.0.0.1:8876";S="https://toolboxkart.tech"
P={"help-scout-hub":("/help-scout/","tools",(500,900),6),"help-scout-pricing":("/help-scout/pricing/","pricing",(800,1400),7),"help-scout-review":("/help-scout/review/","reviews",(1500,2200),7),"help-scout-how-to-use":("/help-scout/how-to-use/","how-to-use",(1200,2000),7),"help-scout-alternatives":("/help-scout/alternatives/","alternatives",(1800,2800),8),"help-scout-vs-zendesk":("/compare/help-scout-vs-zendesk/","compare",(1500,2200),8)}
M={"tools":"sitemap-tools.xml","pricing":"sitemap-pricing.xml","reviews":"sitemap-reviews.xml","how-to-use":"sitemap-how-to-use.xml","alternatives":"sitemap-alternatives.xml","compare":"sitemap-compare.xml","pages":"sitemap-pages.xml","categories":"sitemap-categories.xml"}
class H(HTMLParser):
 def __init__(self):super().__init__();self.h1=0
 def handle_starttag(self,t,a):
  if t=="h1":self.h1+=1
def get(p):
 with urllib.request.urlopen(B+p,timeout=20) as x:return x.status,x.read().decode("utf-8","replace")
def graph(h):
 out=[]
 for x in re.findall(r'<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>',h,re.I|re.S):
  v=json.loads(unescape(x.strip()));out.extend(v.get("@graph",[v]) if isinstance(v,dict) else v)
 return out
def locs(x):return [n.text.strip() for n in ET.fromstring(x).findall(".//{*}loc") if n.text]
def words(s):return len(re.findall(r"\b[\w’'-]+\b",re.sub(r"[#*|]"," ",re.sub(r"\[([^\]]+)\]\([^)]+\)",r"\1",s))))
def main():
 srv=subprocess.Popen(["php","-S","127.0.0.1:8876","preview-router.php"],cwd=R,stdout=subprocess.DEVNULL,stderr=subprocess.DEVNULL)
 try:
  for _ in range(40):
   try:get("/help-scout/");break
   except Exception:time.sleep(.25)
  else:raise AssertionError("PHP preview did not start")
  routes={}
  for n,(p,child,limits,links) in P.items():
   st,h=get(p);assert st==200,(p,st);u=S+p
   can=re.findall(r'<link[^>]+rel=["\']canonical["\'][^>]+href=["\']([^"\']+)',h,re.I);assert can==[u],(p,can)
   d=re.search(r'<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']+)',h,re.I);rb=re.search(r'<meta[^>]+name=["\']robots["\'][^>]+content=["\']([^"\']+)',h,re.I);t=re.search(r'<title>(.*?)</title>',h,re.I|re.S)
   assert d and 140<=len(unescape(d.group(1)))<=160,(p,d.group(1) if d else None)
   assert rb and "index" in rb.group(1).lower() and "follow" in rb.group(1).lower(),p
   assert t and len(re.sub(r"<[^>]+>","",unescape(t.group(1))))<=60,p
   hp=H();hp.feed(h);assert hp.h1==1,(p,hp.h1)
   g=graph(h);types=[x.get("@type") for x in g];assert all(x in types for x in ["Article","BreadcrumbList","FAQPage"]),(p,types)
   bc=next(x for x in g if x.get("@type")=="BreadcrumbList");assert bc["itemListElement"][-1]["item"]==u
   fq=next(x for x in g if x.get("@type")=="FAQPage");visible=unescape(re.sub(r"<[^>]+>"," ",h))
   for q in fq["mainEntity"]:assert q["name"] in visible,(p,q["name"])
   if n=="help-scout-hub":
    app=next(x for x in g if x.get("@type")=="SoftwareApplication");assert "aggregateRating" not in app
   if n=="help-scout-alternatives":assert next(x for x in g if x.get("@type")=="ItemList")["numberOfItems"]==7
   if n=="help-scout-review":assert "Review" not in types and h.count("Written by")==2 and "Review methodology" in h and "Sources" in h
   routes[n]=(p,child)
   md=(R/"articles"/n/"article.md").read_text(encoding="utf-8");seo=(R/"articles"/n/"seo.md").read_text(encoding="utf-8");src=(R/"articles"/n/"sources.md").read_text(encoding="utf-8");note=(R/"articles"/n/"notes.md").read_text(encoding="utf-8")
   assert limits[0]<=words(md)<=limits[1],(n,words(md));assert len(re.findall(r"\]\((/[^)]+)\)",md))==links,(n,links)
   assert "index,follow" in seo and u in seo and "November 22, 2026" in src
   for url in re.findall(r"\]\((https?://[^)]+)\)",md):assert url in src,(n,url)
   assert "Quality gate: pending" in note
  sw=(R/"data/software-pages.php").read_text(encoding="utf-8")
  for p in ["/help-scout/","/help-scout/pricing/","/help-scout/how-to-use/","/compare/help-scout-vs-zendesk/"]:assert len(re.findall(r"'url'\s*=>\s*'"+re.escape(p)+r"'",sw))==1,p
  assert (R/"alternatives/articles/help-scout-alternatives.php").is_file() and "'help-scout-alternatives'" in (R/"includes/alternatives.php").read_text(encoding="utf-8")
  assert (R/"data/post-2026-11-22-help-scout-review.php").is_file() and (R/"reviews/help-scout-review/index.php").is_file()
  for p,needle in [("/tools/","Help Scout"),("/pricing/","Help Scout"),("/how-to-use/","Help Scout"),("/compare/","Help Scout vs Zendesk"),("/alternatives/","Help Scout"),("/reviews/","Help Scout Review"),("/content/","Help Scout Review")]:
   _,h=get(p);assert needle.lower() in h.lower(),(p,needle)
  for p in ["/freshdesk/alternatives/","/zendesk/alternatives/"]:
   _,h=get(p);assert 'href="/help-scout/review/"' in h and 'href="/help-scout/alternatives/"' in h,p
  _,fc=get("/compare/freshdesk-vs-help-scout/");assert 'href="/help-scout/pricing/"' in fc and 'href="/help-scout/review/"' in fc and "US$30 monthly" in fc
  maps={k:locs(get("/"+v)[1]) for k,v in M.items()}
  for n,(p,c) in routes.items():
   u=S+p;assert sum(x.count(u) for x in maps.values())==1,(u,maps);assert maps[c].count(u)==1,(u,c)
  assert S+"/help-scout/review/" not in maps["pages"]
  root=locs(get("/sitemap.xml")[1]);expected={S+"/"+v for v in M.values()};assert set(root)==expected and len(root)==len(expected)
  robots=(R/"robots.txt").read_text(encoding="utf-8");assert robots.count("Sitemap: "+S+"/sitemap.xml")==1
  for u in expected:assert robots.count("Sitemap: "+u)==1,u
  assert not any("customer-service-help-desk-software" in x for x in maps["categories"])
  print("Help Scout: six canonical routes, schema, registry, internal links and sitemap discovery passed.")
 finally:
  srv.terminate()
  try:srv.wait(timeout=5)
  except subprocess.TimeoutExpired:srv.kill()
if __name__=="__main__":main()
