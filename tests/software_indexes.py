"""Checks the software cluster indexes, navigation, schemas and sitemap discovery."""
import json
from html.parser import HTMLParser
from pathlib import Path
import socket
import subprocess
import time
import urllib.error
import urllib.request
import xml.etree.ElementTree as ET

ROOT = Path(__file__).resolve().parents[1]


class Page(HTMLParser):
    def __init__(self, html):
        super().__init__()
        self.h1 = 0
        self.canonical = None
        self.description = None
        self.schemas = []
        self.in_schema = False
        self.schema_text = ''
        self.feed(html)

    def handle_starttag(self, tag, attrs):
        attrs = dict(attrs)
        if tag == 'h1':
            self.h1 += 1
        if tag == 'link' and attrs.get('rel') == 'canonical':
            self.canonical = attrs.get('href')
        if tag == 'meta' and attrs.get('name') == 'description':
            self.description = attrs.get('content')
        if tag == 'script' and attrs.get('type') == 'application/ld+json':
            self.in_schema = True
            self.schema_text = ''

    def handle_data(self, data):
        if self.in_schema:
            self.schema_text += data

    def handle_endtag(self, tag):
        if tag == 'script' and self.in_schema:
            self.schemas.append(json.loads(self.schema_text))
            self.in_schema = False


def main():
    with socket.socket() as sock:
        sock.bind(('127.0.0.1', 0))
        port = sock.getsockname()[1]
    server = subprocess.Popen(['php', '-S', f'127.0.0.1:{port}', 'preview-router.php'], cwd=ROOT,
                              stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)

    def get(path):
        return urllib.request.urlopen(f'http://127.0.0.1:{port}{path}', timeout=5).read().decode()

    indexes = ['/tools/', '/pricing/', '/how-to-use/', '/compare/', '/best/']
    try:
        for _ in range(50):
            try:
                get('/tools/')
                break
            except urllib.error.URLError:
                time.sleep(.1)
        for path in indexes:
            html = get(path)
            page = Page(html)
            assert page.h1 == 1, path
            assert page.canonical == f'https://toolboxkart.tech{path}', path
            assert 140 <= len(page.description) <= 160, path
            assert 'Last updated' in html, path
            graph = next(schema['@graph'] for schema in page.schemas if '@graph' in schema)
            assert any(item['@type'] == 'CollectionPage' for item in graph), path
            assert any(item['@type'] == 'BreadcrumbList' for item in graph), path
            assert any(item['@type'] == 'ItemList' for item in graph), path
        compare = get('/compare/')
        assert '/versus/freedom-vs-cold-turkey/' in compare
        sitemap = get('/sitemap.xml')
        ET.fromstring(sitemap)
        for path in indexes:
            assert f'https://toolboxkart.tech{path}' in sitemap, path
        navigation = (ROOT / 'assets/site.js').read_text()
        fallback = (ROOT / 'includes/header.php').read_text()
        for path in indexes + ['/alternatives/', '/reviews/', '/browse-tools-by-niche']:
            assert path in navigation, path
            assert path in fallback, path
        print('PASS: software indexes, registry, navigation, metadata, schemas and sitemap discovery')
    finally:
        server.terminate()
        server.wait(timeout=5)


if __name__ == '__main__':
    main()
