"""Checks for Versus, Reviews, trust pages, discovery and legacy redirects."""
import json
from html.parser import HTMLParser
from pathlib import Path
import socket
import subprocess
import time
import urllib.error
import urllib.request

ROOT=Path(__file__).resolve().parents[1]

class Page(HTMLParser):
    def __init__(self,html):
        super().__init__();self.h1=0;self.title='';self.in_title=False;self.canonical=None;self.schemas=[];self.in_schema=False;self.schema_text='';self.text=[]
        self.feed(html)
    def handle_starttag(self,tag,attrs):
        attrs=dict(attrs)
        if tag=='h1': self.h1+=1
        if tag=='title': self.in_title=True
        if tag=='link' and attrs.get('rel')=='canonical': self.canonical=attrs.get('href')
        if tag=='script' and attrs.get('type')=='application/ld+json': self.in_schema=True;self.schema_text=''
    def handle_endtag(self,tag):
        if tag=='title': self.in_title=False
        if tag=='script' and self.in_schema:
            self.schemas.append(json.loads(self.schema_text));self.in_schema=False
    def handle_data(self,data):
        if self.in_title:self.title+=data
        if self.in_schema:self.schema_text+=data
        self.text.append(data)

class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self,*args): return None

def main():
    with socket.socket() as sock:sock.bind(('127.0.0.1',0));port=sock.getsockname()[1]
    server=subprocess.Popen(['php','-S',f'127.0.0.1:{port}','preview-router.php'],cwd=ROOT,stdout=subprocess.DEVNULL,stderr=subprocess.DEVNULL)
    opener=urllib.request.build_opener(NoRedirect)
    def get(path):
        try:r=opener.open(f'http://127.0.0.1:{port}{path}',timeout=5)
        except urllib.error.HTTPError as error:r=error
        return r.code,r.headers,r.read().decode()
    try:
        for _ in range(50):
            try:get('/reviews/');break
            except urllib.error.URLError:time.sleep(.1)
        pages={
            '/versus/freedom-vs-cold-turkey/':('https://toolboxkart.tech/versus/freedom-vs-cold-turkey/','October 20, 2026'),
            '/reviews/taskade-review/':('https://toolboxkart.tech/reviews/taskade-review/','October 20, 2026'),
            '/drift/review/':('https://toolboxkart.tech/drift/review/','October 30, 2026'),
            '/fiverr/review/':('https://toolboxkart.tech/fiverr/review/','October 31, 2026'),
        }
        for path,(canonical,published_date) in pages.items():
            code,_,html=get(path);assert code==200,path
            page=Page(html);visible=' '.join(page.text)
            assert page.h1==1 and page.canonical==canonical,path
            assert visible.count(f'Published {published_date}')==1,path
            assert html.count('<strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong>')==2,path
            assert 'BreadcrumbList' in html,path
            assert '<nav class="crumbs" aria-label="Breadcrumb">' in html,path
            graph=next(schema['@graph'] for schema in page.schemas if '@graph' in schema)
            crumb=next(item for item in graph if item.get('@type')=='BreadcrumbList')
            assert crumb['itemListElement'][-1]['item']==canonical,path
            if path in ['/drift/review/', '/fiverr/review/']:
                parent = 'fiverr' if path == '/fiverr/review/' else 'drift'
                assert [item['item'] for item in crumb['itemListElement']] == ['https://toolboxkart.tech/', f'https://toolboxkart.tech/{parent}/', canonical], path
            assert any('@graph' in schema for schema in page.schemas),path
            assert 'Review methodology' in visible and 'Sources' in visible,path
        for index,slug in [('/versus/','freedom-vs-cold-turkey'),('/reviews/','taskade-review'),('/reviews/','Drift Review'),('/reviews/','Fiverr Review'),('/content/','taskade-review')]:
            code,_,html=get(index);assert code==200 and slug in html,index
        for path in ['/about-deepak-parmar/','/editorial-policy','/review-methodology','/advertising-disclosure','/corrections-policy']:
            code,_,html=get(path);assert code==200 and Page(html).h1==1,path
        _,_,sitemap=get('/sitemap.xml')
        assert 'https://toolboxkart.tech/sitemap-reviews.xml' in sitemap
        assert 'https://toolboxkart.tech/sitemap-compare.xml' in sitemap
        _,_,review_sitemap=get('/sitemap-reviews.xml')
        _,_,compare_sitemap=get('/sitemap-compare.xml')
        assert pages['/reviews/taskade-review/'][0] in review_sitemap
        assert pages['/drift/review/'][0] in review_sitemap
        assert pages['/fiverr/review/'][0] in review_sitemap
        assert pages['/versus/freedom-vs-cold-turkey/'][0] in compare_sitemap
        _,_,alt_sitemap=get('/sitemap-alternatives.xml')
        assert '/alternatives/freedom-alternatives/' in alt_sitemap and '/reviews/' not in alt_sitemap
        redirects={
            '/blog/gpt-6-astra-chatgpt-new-capabilities/':'/chatgpt/chatgpt-gpt6-astra-workflow-guide',
            '/seo-guide/robots-meta-tags-guide/':'/ai-news/google-search-robots-meta-tags-outside-head',
        }
        for source,target in redirects.items():
            code,headers,_=get(source);assert code==301 and headers['Location']==target,source
        print('PASS: Versus/Reviews pages, trust pages, schema, author/date counts, discovery, sitemaps and legacy redirects')
    finally:
        server.terminate();server.wait(timeout=5)

if __name__=='__main__':main()
