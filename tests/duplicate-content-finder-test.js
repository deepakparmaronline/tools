const assert = require('node:assert/strict');

const normalize = (text, ignoreCase = true) => {
  let s = String(text).replace(/\u00a0/g, ' ').replace(/\s+/g, ' ').trim();
  return ignoreCase ? s.toLowerCase() : s;
};
const words = text => normalize(text).match(/[\p{L}\p{N}]+(?:['’-][\p{L}\p{N}]+)*/gu) || [];
const ngrams = (list, n) => new Set(Array.from({length: Math.max(0, list.length - n + 1)}, (_, i) => list.slice(i, i+n).join(' ')));
const similarity = (a,b,n) => {
  const ga = ngrams(words(a), n), gb = ngrams(words(b), n);
  const shared = new Set([...ga].filter(x => gb.has(x)));
  const union = new Set([...ga, ...gb]);
  return union.size ? shared.size / union.size * 100 : 0;
};

assert.equal(similarity('Search engine optimization improves visibility.', 'Search engine optimization improves visibility.', 3), 100);
assert.equal(similarity('apple banana cherry', 'apple banana', 3), 0);
assert.equal(Number(similarity('Red green blue yellow', 'red green black white', 2).toFixed(1)), 25.0);
assert.equal(words('Hello, hello! SEO tools').length, 4);
assert.equal(ngrams(words('one two three four'), 5).size, 0);
console.log('Duplicate Content Finder smoke tests passed.');
