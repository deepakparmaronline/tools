const fs = require('fs');
const path = require('path');

const roots = ['finance', 'seo', 'image-tools', 'post'];
const faviconLink = '<link rel="icon" type="image/jpeg" href="/images/deepak-parmar.jpeg">';
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
    if (/<link\b[^>]*\brel=["'][^"']*icon[^"']*["'][^>]*>/i.test(original)) continue;

    const descriptionPattern = /<meta\b[^>]*\bname=["']description["'][^>]*>/i;
    if (!descriptionPattern.test(original)) continue;

    const updated = original.replace(descriptionPattern, (tag) => `${tag}${faviconLink}`);
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