const assert = require('node:assert/strict');

const parseFixture = html => {
  const title = html.match(/<title[^>]*>([\s\S]*?)<\/title>/i)?.[1].trim() || '';
  const meta = [...html.matchAll(/<meta\b([^>]*)>/gi)].map(m => {
    const attrs = {};
    for (const a of m[1].matchAll(/([\w:-]+)\s*=\s*["']([^"']*)["']/g)) attrs[a[1].toLowerCase()] = a[2];
    return {key: attrs.name || attrs.property || attrs['http-equiv'] || 'charset', content: attrs.content || attrs.charset || ''};
  });
  const canonical = [...html.matchAll(/<link\b([^>]*)>/gi)].map(m => {
    const rel = m[1].match(/\brel\s*=\s*["']([^"']*)["']/i)?.[1] || '';
    return rel.split(/\s+/i).includes('canonical') ? (m[1].match(/\bhref\s*=\s*["']([^"']*)["']/i)?.[1] || '') : '';
  }).filter(Boolean);
  const headings = [...html.matchAll(/<(h[1-6])\b[^>]*>([\s\S]*?)<\/\1>/gi)].map(m => ({level:m[1].toLowerCase(), text:m[2].replace(/<[^>]+>/g,'').replace(/\s+/g,' ').trim()})).filter(x=>x.text);
  return {title, meta, canonical, headings};
};

const normal = parseFixture(`<!doctype html><html><head><title>Example Page</title><meta name="description" content="A useful page"><meta property="og:title" content="Example Social"><meta name="twitter:card" content="summary"><link rel="canonical" href="https://example.com/page/"></head><body><h1>Main heading</h1><h2>Details</h2></body></html>`);
assert.equal(normal.title, 'Example Page');
assert.equal(normal.meta.length, 3);
assert.equal(normal.meta.find(x => x.key === 'description').content, 'A useful page');
assert.deepEqual(normal.canonical, ['https://example.com/page/']);
assert.deepEqual(normal.headings.map(x => x.level), ['h1','h2']);

const boundary = parseFixture('<html><head><title></title></head><body></body></html>');
assert.equal(boundary.title, '');
assert.equal(boundary.meta.length, 0);
assert.equal(boundary.canonical.length, 0);
assert.equal(boundary.headings.length, 0);

const invalid = parseFixture('<title>Broken<meta name="description" content="Still readable">');
assert.equal(invalid.title, '');
assert.equal(invalid.meta.length, 1);

console.log('Meta Extractor smoke tests passed.');
