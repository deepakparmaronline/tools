const fs = require('fs');
const path = require('path');

const seoRoot = path.join(__dirname, 'seo');
const run = process.argv.includes('--run');
const acronyms = new Set(['SEO', 'AI', 'URL', 'GSC', 'FAQ', 'UTM', 'CTR', 'ROI', 'NAP', 'EEAT']);

function toToolName(slug) {
  return slug
    .split('-')
    .filter(Boolean)
    .map((word) => {
      const upperWord = word.toUpperCase();
      if (acronyms.has(upperWord)) return upperWord;
      return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
    })
    .join(' ');
}

function toTask(slug) {
  const words = slug.replace(/-/g, ' ').replace(/\btool\b/gi, '').replace(/\s+/g, ' ').trim();
  const actions = [
    ['checker', 'check'],
    ['analyzer', 'analyze'],
    ['analyser', 'analyze'],
    ['generator', 'generate'],
    ['calculator', 'calculate'],
    ['simulator', 'simulate'],
    ['extractor', 'extract'],
    ['validator', 'validate'],
    ['grader', 'grade'],
    ['finder', 'find'],
    ['preview', 'preview'],
  ];

  for (const [suffix, action] of actions) {
    if (words.endsWith(suffix)) {
      const subject = words.slice(0, -suffix.length).trim();
      return `${action} ${subject || words}`;
    }
  }
  return `use ${words}`;
}

function replaceOnce(text, pattern, replacement, label, filePath) {
  if (!pattern.test(text)) {
    throw new Error(`Could not find ${label} in ${filePath}`);
  }
  return text.replace(pattern, replacement);
}

const changed = [];
const skipped = [];

for (const entry of fs.readdirSync(seoRoot, { withFileTypes: true })) {
  if (!entry.isDirectory()) continue;

  const slug = entry.name;
  const filePath = path.join(seoRoot, slug, 'index.html');
  if (!fs.existsSync(filePath)) continue;

  const original = fs.readFileSync(filePath, 'utf8');
  const titleMatch = original.match(/<title>([^<]*)<\/title>/i);
  if (!titleMatch || titleMatch[1] !== 'Free SEO Tool | Tool Box Kart') {
    skipped.push(path.relative(__dirname, filePath));
    continue;
  }

  const toolName = toToolName(slug);
  const description = `Use the free ${toolName} to ${toTask(slug)}. Runs in your browser. No signup, no API required.`;
  let updated = original;

  updated = replaceOnce(updated, /<title>Free SEO Tool \| Tool Box Kart<\/title>/i, `<title>${toolName} | Free SEO Tool - Tool Box Kart</title>`, 'title', filePath);
  updated = replaceOnce(updated, /(<meta\s+name=["']description["']\s+content=["'])[^"']*(["'])/i, `$1${description}$2`, 'meta description', filePath);
  updated = replaceOnce(updated, /(<link\s+rel=["']canonical["']\s+href=["'])[^"']*(["'])/i, `$1https://toolboxkart.tech/seo/${slug}/$2`, 'canonical', filePath);
  updated = replaceOnce(updated, /<h1>[^<]*<\/h1>/i, `<h1>${toolName}</h1>`, 'h1', filePath);
  updated = replaceOnce(updated, /("name"\s*:\s*)"Free SEO Tool"/i, `$1"${toolName}","description":"${description}"`, 'JSON-LD name', filePath);
  updated = replaceOnce(updated, /<b>Is this SEO tool free\?<\/b>/i, `<b>Is the ${toolName} free to use?</b>`, 'first FAQ question', filePath);
  updated = replaceOnce(updated, /<b>Does the tool upload my SEO data\?<\/b>/i, `<b>Does the ${toolName} upload my data?</b>`, 'second FAQ question', filePath);

  changed.push(path.relative(__dirname, filePath));
  if (run) fs.writeFileSync(filePath, updated);
}

console.log(run ? 'Changed files:' : 'Files that would change (run with --run):');
for (const filePath of changed) console.log(`CHANGED ${filePath}`);
console.log(`Changed count: ${changed.length}`);
console.log('Skipped files:');
for (const filePath of skipped) console.log(`SKIPPED ${filePath}`);
console.log(`Skipped count: ${skipped.length}`);