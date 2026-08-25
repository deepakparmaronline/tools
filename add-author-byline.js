const fs = require('fs');
const path = require('path');

const roots = ['finance', 'seo'];
const byline = (color) => `<p class="author-byline" style="margin: 1rem 0 0; color: ${color}; font-size: 0.875rem;">Reviewed by <a href="/about-deepak-parmar/">Deepak Parmar</a>, SEO and AI search specialist</p>`;
const changed = [];

function scan(directory) {
  for (const entry of fs.readdirSync(directory, { withFileTypes: true })) {
    const filePath = path.join(directory, entry.name);
    if (entry.isDirectory()) {
      scan(filePath);
      continue;
    }
    if (entry.name !== 'index.html') continue;

    const original = fs.readFileSync(filePath, 'utf8');
    if (original.includes('/about-deepak-parmar/')) continue;

    const heroPattern = /<(header|div)\b[^>]*\bclass=["'][^"']*\bhero\b[^"']*["'][^>]*>/i;
    const insertionPattern = heroPattern.test(original) ? heroPattern : /<main\b[^>]*>/i;
    if (!insertionPattern.test(original)) continue;

    const isDark = /background(?:-color)?\s*:\s*#0d0d0d/i.test(original);
    const updated = original.replace(insertionPattern, (tag) => `${tag}${byline(isDark ? '#999' : '#5b6472')}`);
    fs.writeFileSync(filePath, updated);
    changed.push(path.relative(__dirname, filePath));
  }
}

for (const root of roots) {
  const rootPath = path.join(__dirname, root);
  if (fs.existsSync(rootPath)) scan(rootPath);
}

console.log(`Changed count: ${changed.length}`);
for (const filePath of changed) console.log(`CHANGED ${filePath}`);