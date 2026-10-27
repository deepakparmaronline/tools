"""Checks the software cluster indexes, navigation, schemas and sitemap discovery."""
import base64
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
        self.title = ''
        self.in_title = False
        self.text = []
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
        if tag == 'title':
            self.in_title = True
        if tag == 'link' and attrs.get('rel') == 'canonical':
            self.canonical = attrs.get('href')
        if tag == 'meta' and attrs.get('name') == 'description':
            self.description = attrs.get('content')
        if tag == 'script' and attrs.get('type') == 'application/ld+json':
            self.in_schema = True
            self.schema_text = ''

    def handle_data(self, data):
        self.text.append(data)
        if self.in_title:
            self.title += data
        if self.in_schema:
            self.schema_text += data

    def handle_endtag(self, tag):
        if tag == 'title':
            self.in_title = False
        if tag == 'script' and self.in_schema:
            self.schemas.append(json.loads(self.schema_text))
            self.in_schema = False


def run_php(code):
    result = subprocess.run(['php', '-r', code], cwd=ROOT, text=True, capture_output=True)
    assert result.returncode == 0, result.stderr
    return result.stdout


def test_software_detail_renderer():
    sample = {
        'status': 'published',
        'title': 'Fixture Software Detail',
        'seo_title': 'Fixture Software Detail',
        'description': 'A sample description for shared software detail rendering.',
        'url': '/fixture-tool/',
        'tool_name': 'Fixture Tool',
        'additional_schema': [{'@type': 'SoftwareApplication', 'name': 'Fixture Tool'}],
        'date': '2026-10-26',
        'content': '<h2 id="overview">Overview</h2><p>Fixture body text.</p>',
    }
    encoded = base64.b64encode(json.dumps(sample).encode()).decode()
    html = run_php(
        "require 'includes/bootstrap.php'; "
        "require 'includes/software-detail.php'; "
        f"$page = json_decode(base64_decode('{encoded}'), true); "
        "echo render_software_detail_page($page, 'tool_hubs');"
    )
    page = Page(html)
    assert page.h1 == 1
    assert page.title == 'Fixture Software Detail | ToolboxKart'
    assert page.canonical == 'https://toolboxkart.tech/fixture-tool/'
    assert page.description == sample['description']
    assert 'Fixture body text.' in ' '.join(page.text)
    assert 'software-detail.css' in html
    graphs = [schema['@graph'] for schema in page.schemas if '@graph' in schema]
    graph = next(graph for graph in graphs if any(item.get('@type') == 'Article' for item in graph))
    article = next(item for item in graph if item.get('@type') == 'Article')
    assert article['datePublished'] == '2026-10-26T00:00:00+05:30'
    assert article['dateModified'] == '2026-10-26T00:00:00+05:30'
    assert any(item.get('@type') == 'BreadcrumbList' for item in graph)
    assert any(item.get('@type') == 'SoftwareApplication' for item in graph)

    records = {
        'incomplete': {'url': '/hidden-tool/'},
        'complete': {'url': '/visible-tool/', 'content': '<h2>Overview</h2><p>Ready.</p>'},
        'duplicate_h1': {'url': '/bad-tool/', 'content': '<h1>Second heading</h1><p>Body.</p>'},
        'bad_path': {'url': '/nested/path/', 'content': '<h2>Overview</h2><p>Body.</p>'},
        'wrong_prefix': {'url': '/pricing/visible-tool/', 'content': '<h2>Overview</h2><p>Body.</p>'},
        'legacy_versus': {'url': '/versus/freedom-vs-cold-turkey/'},
    }
    encoded_records = base64.b64encode(json.dumps(records).encode()).decode()
    result = run_php(
        "require 'includes/bootstrap.php'; "
        f"$r = json_decode(base64_decode('{encoded_records}'), true); "
        "echo json_encode(["
        "'incomplete' => software_page_has_detail_content('tool_hubs', $r['incomplete']),"
        "'complete' => software_page_has_detail_content('tool_hubs', $r['complete']),"
        "'duplicate_h1' => software_page_has_detail_content('tool_hubs', $r['duplicate_h1']),"
        "'bad_path' => software_page_has_detail_content('tool_hubs', $r['bad_path']),"
        "'wrong_prefix' => software_page_has_detail_content('tool_hubs', $r['wrong_prefix']),"
        "'legacy_versus' => software_page_has_detail_content('comparisons', $r['legacy_versus'])"
        "]);"
    )
    assert json.loads(result) == {
        'incomplete': False,
        'complete': True,
        'duplicate_h1': False,
        'bad_path': False,
        'wrong_prefix': False,
        'legacy_versus': True,
    }


def main():
    test_software_detail_renderer()
    with socket.socket() as sock:
        sock.bind(('127.0.0.1', 0))
        port = sock.getsockname()[1]
    server = subprocess.Popen(['php', '-S', f'127.0.0.1:{port}', 'preview-router.php'], cwd=ROOT,
                              stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)

    def get_response(path):
        try:
            response = urllib.request.urlopen(f'http://127.0.0.1:{port}{path}', timeout=5)
        except urllib.error.HTTPError as error:
            return error.code, error.headers, error.read().decode()
        return response.status, response.headers, response.read().decode()

    def get(path):
        status, _, body = get_response(path)
        assert status == 200, f'{path}: HTTP {status}'
        return body

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

        # The complete Zendesk cluster is now published. Unknown detail routes must remain unavailable.
        unknown_detail_routes = ['/best/customer-service-help-desk-software/']
        for path in unknown_detail_routes:
            status, _, _ = get_response(path)
            assert status == 404, f'{path}: expected 404, got {status}'

        published_details = {
            '/zendesk/': ('https://toolboxkart.tech/zendesk/', 'zendesk'),
            '/zendesk/pricing/': ('https://toolboxkart.tech/zendesk/pricing/', 'zendesk'),
            '/zendesk/how-to-use/': ('https://toolboxkart.tech/zendesk/how-to-use/', 'zendesk'),
            '/zendesk/alternatives/': ('https://toolboxkart.tech/zendesk/alternatives/', 'zendesk'),
            '/freshdesk/': ('https://toolboxkart.tech/freshdesk/', 'freshdesk'),
            '/freshdesk/pricing/': ('https://toolboxkart.tech/freshdesk/pricing/', 'freshdesk'),
            '/freshdesk/how-to-use/': ('https://toolboxkart.tech/freshdesk/how-to-use/', 'freshdesk'),
            '/freshdesk/alternatives/': ('https://toolboxkart.tech/freshdesk/alternatives/', 'freshdesk'),
            '/compare/zendesk-vs-freshdesk/': ('https://toolboxkart.tech/compare/zendesk-vs-freshdesk/', 'zendesk'),
        }
        for path, (canonical, expected_text) in published_details.items():
            html = get(path)
            page = Page(html)
            assert page.h1 == 1, path
            assert page.canonical == canonical, path
            assert expected_text in ' '.join(page.text).lower(), path
            graph = next(schema['@graph'] for schema in page.schemas if '@graph' in schema)
            assert any(item.get('@type') == 'BreadcrumbList' for item in graph), path
            breadcrumb = next(item for item in graph if item.get('@type') == 'BreadcrumbList')
            crumb_names = [item['name'] for item in breadcrumb['itemListElement']]
            if path == '/freshdesk/':
                assert crumb_names == ['Home', 'Freshdesk'], path
                assert 150 <= len(page.description) <= 155, path
                app = next(item for item in graph if item.get('@type') == 'SoftwareApplication')
                assert app['name'] == 'Freshdesk' and 'aggregateRating' not in app, path
            if path == '/freshdesk/pricing/':
                assert crumb_names == ['Home', 'Freshdesk', 'Pricing'], path
                assert 150 <= len(page.description) <= 155, path
            if path == '/freshdesk/how-to-use/':
                assert crumb_names == ['Home', 'Freshdesk', 'How to Use'], path
                assert 150 <= len(page.description) <= 155, path
                assert any(item.get('@type') == 'HowTo' for item in graph), path
            if path.endswith('/alternatives/'):
                assert any(item.get('@type') == 'ItemList' for item in graph), path
                assert crumb_names == ['Home', 'Zendesk' if 'zendesk' in path else 'Freshdesk', 'Alternatives'], path
            if path == '/compare/zendesk-vs-freshdesk/':
                assert crumb_names == ['Home', 'Comparisons', 'Zendesk vs Freshdesk: Which Help Desk Fits?'], path
                assert 150 <= len(page.description) <= 155, path

        for path in ['/tools/', '/pricing/', '/how-to-use/', '/compare/']:
            listing = get(path).lower()
            assert 'zendesk' in listing, path
            if path != '/compare/': assert 'freshdesk' in listing, path
        assert 'freshdesk' in get('/compare/').lower()
        assert 'zendesk' not in get('/best/').lower() and 'freshdesk' not in get('/best/').lower()

        expected_sitemap_urls = {
            '/sitemap-tools.xml': 'https://toolboxkart.tech/zendesk/',
            '/sitemap-pricing.xml': 'https://toolboxkart.tech/zendesk/pricing/',
            '/sitemap-how-to-use.xml': 'https://toolboxkart.tech/zendesk/how-to-use/',
            '/sitemap-compare.xml': 'https://toolboxkart.tech/compare/zendesk-vs-freshdesk/',
            '/sitemap-alternatives.xml': 'https://toolboxkart.tech/zendesk/alternatives/',
            '/sitemap-reviews.xml': 'https://toolboxkart.tech/zendesk/review/',
        }
        for path, url in expected_sitemap_urls.items():
            assert url in get(path), f'{url} missing from {path}'
        for path, url in [('/sitemap-tools.xml','https://toolboxkart.tech/freshdesk/'),('/sitemap-pricing.xml','https://toolboxkart.tech/freshdesk/pricing/'),('/sitemap-how-to-use.xml','https://toolboxkart.tech/freshdesk/how-to-use/'),('/sitemap-alternatives.xml','https://toolboxkart.tech/freshdesk/alternatives/'),('/sitemap-reviews.xml','https://toolboxkart.tech/freshdesk/review/')]:
            assert url in get(path), f'{url} missing from {path}'

        rewrite_rules = (ROOT / '.htaccess').read_text()
        assert 'RewriteRule ^(tools|pricing|how-to-use|compare|best)/([a-z0-9-]+)/?$ router.php [L,QSA]' in rewrite_rules
        sitemap = get('/sitemap.xml')
        root = ET.fromstring(sitemap)
        assert root.tag.endswith('sitemapindex')
        child_maps = {
            '/tools/': '/sitemap-tools.xml',
            '/pricing/': '/sitemap-pricing.xml',
            '/how-to-use/': '/sitemap-how-to-use.xml',
            '/compare/': '/sitemap-compare.xml',
            '/best/': '/sitemap-categories.xml',
        }
        required_maps = list(child_maps.values()) + ['/sitemap-alternatives.xml', '/sitemap-reviews.xml', '/sitemap-pages.xml']
        for child in required_maps:
            assert f'https://toolboxkart.tech{child}' in sitemap, child
            ET.fromstring(get(child))
        for path, child in child_maps.items():
            assert f'https://toolboxkart.tech{path}' in get(child), path
        assert '/versus/freedom-vs-cold-turkey/' in get('/sitemap-compare.xml')
        navigation = (ROOT / 'assets/site.js').read_text()
        fallback = (ROOT / 'includes/header.php').read_text()
        for path in indexes + ['/alternatives/', '/reviews/', '/browse-tools-by-niche']:
            assert path in navigation, path
            assert path in fallback, path
        print('PASS: software indexes, registry, navigation, metadata, schemas and type-specific sitemap discovery')
    finally:
        server.terminate()
        server.wait(timeout=5)


if __name__ == '__main__':
    main()
