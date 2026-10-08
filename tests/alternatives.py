"""Integration checks with temporary editorial fixtures; no articles are published."""
import json
from pathlib import Path
import socket
import subprocess
import time
import urllib.request
import urllib.error
from html.parser import HTMLParser

ROOT = Path(__file__).resolve().parents[1]


class Page(HTMLParser):
    def __init__(self, html):
        super().__init__()
        self.meta, self.canonical, self.schemas, self.h1 = {}, None, [], 0
        self.in_schema, self.schema_text = False, ''
        self.feed(html)

    def handle_starttag(self, tag, attrs):
        attrs = dict(attrs)
        if tag == 'meta':
            self.meta[attrs.get('name', attrs.get('property'))] = attrs.get('content')
        if tag == 'link' and attrs.get('rel') == 'canonical':
            self.canonical = attrs['href']
        if tag == 'h1':
            self.h1 += 1
        if tag == 'script' and attrs.get('type') == 'application/ld+json':
            self.in_schema, self.schema_text = True, ''

    def handle_data(self, data):
        if self.in_schema:
            self.schema_text += data

    def handle_endtag(self, tag):
        if tag == 'script' and self.in_schema:
            self.schemas.append(json.loads(self.schema_text))
            self.in_schema = False


class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args):
        return None


def main():
    paths = []
    with socket.socket() as sock:
        sock.bind(('127.0.0.1', 0))
        port = sock.getsockname()[1]
    server = subprocess.Popen(['php', '-S', f'127.0.0.1:{port}', 'preview-router.php'], cwd=ROOT,
                              stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
    opener = urllib.request.build_opener(NoRedirect)

    def get(path):
        try:
            result = opener.open(f'http://127.0.0.1:{port}{path}', timeout=5)
        except urllib.error.HTTPError as error:
            result = error
        return result.code, result.headers, result.read().decode()

    try:
        for _ in range(50):
            try:
                get('/alternatives/')
                break
            except urllib.error.URLError:
                time.sleep(.1)
        assert get('/alternatives/')[0] == 200
        for path, content_type in [('/assets/css/app.css', 'text/css'),
                                   ('/assets/css/article-overflow-fixes.css', 'text/css'),
                                   ('/assets/js/app.js', 'javascript')]:
            code, headers, body = get(path)
            assert code == 200 and content_type in headers.get('Content-Type', ''), path
            assert len(body) > 100, f'Empty or incomplete asset: {path}'
        for record in (ROOT / 'alternatives/articles').glob('*.php'):
            if "'status' => 'published'" not in record.read_text():
                continue
            path = f'/alternatives/{record.stem}/'
            code, _, html = get(path)
            assert code == 200 and Page(html).h1 == 1, path
            assert f'href="{path}"' in get('/alternatives/')[2], path
        for slug, status, date in [('qa-alternative-one', 'published', '2026-01-01'),
                                   ('qa-alternative-two', 'published', '2026-01-02'),
                                   ('qa-alternative-draft', 'draft', '2026-01-01'),
                                   ('qa-alternative-future', 'published', '2099-01-01')]:
            path = ROOT / 'alternatives/articles' / f'{slug}.php'
            assert not path.exists(), f'Refusing to overwrite {path}'
            path.write_text("<?php return " + "[" +
                            f"'status'=>'{status}','title'=>'{slug}','date'=>'{date}'," +
                            "'updated'=>'2026-02-01','description'=>'A comparison & workflow.'," +
                            "'seo_title'=>'Comparison search title','image'=>'/assets/favicon.svg'," +
                            "'image_alt'=>'Comparison illustration','tag'=>'Productivity'," +
                            "'content'=>'<p>Comparison introduction.</p><h2>Options</h2><h3>Details</h3><p>Useful details.</p>'];")
            paths.append(path)
        code, _, listing = get('/alternatives/')
        assert code == 200 and 'qa-alternative-one' in listing and 'qa-alternative-two' in listing
        assert 'href="/alternatives/qa-alternative-one/"' in listing
        assert 'href="https://toolboxkart.tech/alternatives/qa-alternative-one/"' not in listing
        assert listing.index('qa-alternative-two') < listing.index('qa-alternative-one')
        assert 'qa-alternative-draft' not in listing and 'qa-alternative-future' not in listing
        code, _, article = get('/alternatives/qa-alternative-one/')
        assert code == 200 and 'qa-alternative-two' in article
        assert 'href="/alternatives/qa-alternative-two/"' in article
        parsed = Page(article)
        assert parsed.h1 == 1
        assert parsed.canonical == 'https://toolboxkart.tech/alternatives/qa-alternative-one/'
        assert parsed.meta['description'] == 'A comparison & workflow.'
        assert parsed.meta['og:image'] == 'https://toolboxkart.tech/assets/favicon.svg'
        assert parsed.meta['twitter:card'] == 'summary_large_image'
        assert parsed.meta['twitter:image:alt'] == 'Comparison illustration'
        graph = next(item['@graph'] for item in parsed.schemas if '@graph' in item)
        schema = next(item for item in graph if item['@type'] == 'Article')
        assert schema['headline'] == 'qa-alternative-one' and schema['dateModified'] == '2026-02-01'
        assert any(item['@type'] == 'BreadcrumbList' for item in graph)
        for path in ['/alternatives/qa-alternative-one', '/alternatives/qa-alternative-one.php']:
            code, headers, _ = get(path)
            assert code == 301 and headers['Location'] == '/alternatives/qa-alternative-one/'
        for path in ['/alternatives/qa-alternative-draft/', '/alternatives/qa-alternative-future/',
                     '/alternatives/missing/', '/alternatives/articles/qa-alternative-one.php']:
            assert get(path)[0] == 404
        assert get('/alternatives')[0] == 301
        code, _, sitemap = get('/sitemap.xml')
        assert code == 200 and parsed.canonical in sitemap
        assert 'qa-alternative-draft' not in sitemap and 'qa-alternative-future' not in sitemap
        for path in ['/', '/seo/', '/seo/serp-preview', '/chatgpt/', '/all-tools']:
            code, _, html = get(path)
            assert code == 200, path
            assert html.count('<a href="/alternatives/">Alternatives</a>') >= 3, path
            assert '<a href="https://toolboxkart.tech/' not in html, path
        print('PASS: CSS/JS content and MIME types, published article links, site-wide navigation, draft/future exclusion, related cards, SEO/schema, redirects, sitemap, existing routes')
    finally:
        for path in paths:
            path.unlink(missing_ok=True)
        server.terminate()
        server.wait(timeout=5)


if __name__ == '__main__':
    main()
