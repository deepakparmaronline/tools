const assert = require('node:assert/strict');

const escapeRE2 = s => String(s).replace(/[\\^$.*+?()[\]{}|]/g, '\\$&');
const build = (raw, mode = 'contains', grouped = true, caseSensitive = false) => {
  const values = [...new Set(raw.split(/[\n,]+/).map(v => v.trim()).filter(Boolean))];
  const alternatives = values.map(escapeRE2).join('|');
  let pattern;
  if (mode === 'starts') pattern = grouped && values.length > 1 ? '^(?:' + alternatives + ')' : '^' + alternatives;
  else if (mode === 'ends') pattern = grouped && values.length > 1 ? '(?:' + alternatives + ')$' : alternatives + '$';
  else if (mode === 'exact') pattern = grouped && values.length > 1 ? '^(?:' + alternatives + ')$' : '^' + alternatives + '$';
  else pattern = grouped && values.length > 1 ? '(?:' + alternatives + ')' : alternatives;
  return (caseSensitive ? '(?-i)' : '') + pattern;
};

assert.equal(build('seo,technical seo'), '(?:seo|technical seo)');
assert.equal(build('foo.bar,foo+baz'), '(?:foo\\.bar|foo\\+baz)');
assert.equal(build('brand,product', 'exact'), '^(?:brand|product)$');
assert.equal(build('how to,what is', 'starts', true, true), '(?-i)^(?:how to|what is)');
assert.equal(build('one,two', 'ends'), '(?:one|two)$');
console.log('Search Console Regex Generator smoke tests passed.');
