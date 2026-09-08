const assert = require('node:assert/strict');

const escapeRE2 = s => String(s).replace(/[\\^$.*+?()[\]{}|]/g, '\\$&');
const build = (raw, mode = 'contains', grouped = true, caseSensitive = false) => {
  const values = [...new Set(raw.split(/[\n,]+/).map(v => v.trim()).filter(Boolean))];
  const body = values.map(v => {
    const e = escapeRE2(v);
    if (mode === 'starts') return '^' + e;
    if (mode === 'ends') return e + '$';
    if (mode === 'exact') return '^' + e + '$';
    return e;
  }).join('|');
  return (caseSensitive ? '(?-i)' : '') + (grouped && values.length > 1 ? '(?:' + body + ')' : body);
};

assert.equal(build('seo,technical seo'), '(?:seo|technical seo)');
assert.equal(build('foo.bar,foo+baz'), '(?:foo\\.bar|foo\\+baz)');
assert.equal(build('brand,product', 'exact'), '(?:^brand$|^product$)');
assert.equal(build('how to,what is', 'starts', true, true), '(? -i)');
