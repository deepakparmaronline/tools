#!/usr/bin/env python3
from pathlib import Path
import re, html

ROOT = Path(__file__).resolve().parents[1]
START = "<!-- TOOLBOXKART-CONTENT-LIST:START -->"
END = "<!-- TOOLBOXKART-CONTENT-LIST:END -->"
CATEGORIES = {
    "seo-guide": "SEO Guide",
    "tech": "Tech Guide",
    "tools-guide": "Tool Guide",
    "explainers": "Explainer",
}

def get(pattern, text):
    m = re.search(pattern, text, re.I | re.S)
    return html.unescape(m.group(1).strip()) if m else ""

for category, label in CATEGORIES.items():
    folder = ROOT / category
    index = folder / "index.html"
    if not index.exists():
        continue
    posts = []
    for p in folder.glob("*/index.html"):
        if p.resolve() == index.resolve():
            continue
        text = p.read_text(encoding="utf-8", errors="ignore")
        url = get(r'<link\s+rel=["\']canonical["\']\s+href=["\'](.*?)["\']', text)
        title = get(r'<title>(.*?)</title>', text)
        desc = get(r'<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']', text)
        if url and title:
            posts.append((title, desc, url))
    posts.sort(key=lambda x: x[0].lower())
    cards = "".join(
        f'<article class="card"><p class="meta">{html.escape(label)}</p>'
        f'<a href="{html.escape(u, quote=True)}">{html.escape(t)}</a>'
        f'<p>{html.escape(d)}</p></article>'
        for t, d, u in posts
    )
    block = f'{START}<section class="grid">{cards}</section>{END}'
    content = index.read_text(encoding="utf-8")
    pattern = re.escape(START) + r".*?" + re.escape(END)
    if re.search(pattern, content, re.S):
        content = re.sub(pattern, block, content, count=1, flags=re.S)
    else:
        pos = content.find("</main>")
        if pos >= 0:
            content = content[:pos] + block + content[pos:]
    index.write_text(content, encoding="utf-8")
