"""Verify the standalone publishing contract using raw responses, without JavaScript."""
import json
import re
import urllib.request
import urllib.error
import xml.etree.ElementTree as ET
from pathlib import Path
from html.parser import HTMLParser

ROOT=Path(__file__).resolve().parents[1]
BASE='http://127.0.0.1:8765'
PATH='/tech/mistral-large-4-api-routes/'
CANONICAL='https://toolboxkart.tech'+PATH

class Page(HTMLParser):
    def __init__(self,html):
        super().__init__(); self.tags=[];self.meta={};self.scripts=[];self.buffer='';self.capture=False
        self.feed(html)
    def handle_starttag(self,tag,attrs):
        a=dict(attrs);self.tags.append((tag,a))
        if tag=='meta':self.meta[a.get('name',a.get('property'))]=a.get('content')
        if tag=='script' and a.get('type')=='application/ld+json':self.capture=True;self.buffer=''
    def handle_data(self,data):
        if self.capture:self.buffer+=data
    def handle_endtag(self,tag):
        if tag=='script' and self.capture:self.scripts.append(json.loads(self.buffer));self.capture=False

class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self,*args):return None

def get(path):
    r=urllib.request.urlopen(BASE+path,timeout=5)
    return r,r.read()

r,body=get(PATH); text=body.decode();page=Page(text)
assert r.status==200 and text.lower().startswith('<!doctype html>')
assert sum(tag=='h1' for tag,a in page.tags)==1
assert sum(tag=='time' for tag,a in page.tags)==1
assert text.count('Written by ')==2
assert 'BreadcrumbList' not in text and 'class="crumbs"' not in text
assert any(tag=='section' and a.get('class')=='answer' for tag,a in page.tags)
ids=[a['id'] for tag,a in page.tags if 'id' in a];assert len(ids)==len(set(ids))
for tag,a in page.tags:
    if tag=='a' and a.get('href','').startswith('#'):assert a['href'][1:] in ids
assert any(tag=='link' and a.get('rel')=='canonical' and a.get('href')==CANONICAL for tag,a in page.tags)
assert len(page.meta['description'])<160
schema=json.loads((ROOT/'articles/mistral-large-4-api-routes/schema.json').read_text())
assert page.scripts==[schema]
graph=schema['@graph']; article=next(x for x in graph if x['@type']=='Article')
assert article['url']==CANONICAL and article['description']==page.meta['description']
for key in ['datePublished','dateModified']:assert re.fullmatch(r'2026-10-08T\d{2}:\d{2}:\d{2}\+05:30',article[key])
image=article['image'];assert image==page.meta['og:image']==page.meta['twitter:image']
assert any(tag=='img' and 'https://toolboxkart.tech'+a.get('src','')==image for tag,a in page.tags)
assert next(x for x in graph if x['@type']=='Person')['name']=='Deepak Parmar'
faq=next(x for x in graph if x['@type']=='FAQPage')
for item in faq['mainEntity']:
    assert item['name'] in text and item['acceptedAnswer']['text'] in text
recent=text.split('<aside class="publication-recent"',1)[1].split('</aside>',1)[0]
recent_urls=re.findall(r'href="([^"]+)"',recent)
assert len(recent_urls)==5 and len(set(recent_urls))==5
for path in recent_urls+['/developer/json-formatter','/ai-news/ai-agent-approval-policy-template','/about-deepak-parmar/']:
    assert get(path)[0].status==200,path
for path in ['/tech/','/content/','/']:
    r,data=get(path);assert PATH.encode() in data,path
_,sitemap=get('/sitemap.xml')
ET.fromstring(sitemap);assert sitemap.count(CANONICAL.encode())==1
for path,kind in [('/assets/css/app.css','text/css'),('/assets/css/publication.css','text/css'),('/assets/site.js','javascript'),('/images/deepak-parmar.jpeg','image/jpeg'),('/images/mistral-large-4-api-routes.svg','image/svg+xml')]:
    r,data=get(path);assert kind in r.headers['Content-Type'] and len(data)>100,path
svg=ET.fromstring((ROOT/'images/mistral-large-4-api-routes.svg').read_text());assert svg.tag=='{http://www.w3.org/2000/svg}svg'
for path in [PATH.rstrip('/'),PATH+'index.html']:
    try:urllib.request.build_opener(NoRedirect).open(BASE+path)
    except urllib.error.HTTPError as error:assert error.code==301 and error.headers['Location']==PATH
    else:raise AssertionError('Expected canonical redirect: '+path)
print('PASS: complete static HTML, author/date, image and social metadata, Article/Person/FAQ schema, TOCs, five recent links, internal destinations, category/central/home discovery, sitemap, assets, canonical redirects')
