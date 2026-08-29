#!/usr/bin/env python3
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SCRIPT_TAG = '<script src="/assets/site.js" defer></script>'
SKIP_DIRS = {".git", "node_modules", "vendor", "_site"}

changed = []

for html_file in sorted(ROOT.rglob("index.html")):
    if any(part in SKIP_DIRS for part in html_file.parts):
        continue

    text = html_file.read_text(encoding="utf-8", errors="ignore")
    if SCRIPT_TAG in text:
        continue

    updated = text.replace("</body>", f"{SCRIPT_TAG}\n</body>", 1) if "</body>" in text else text + f"\n{SCRIPT_TAG}\n"
    html_file.write_text(updated, encoding="utf-8")
    changed.append(str(html_file.relative_to(ROOT)))

print(f"Shared script injected into {len(changed)} HTML files.")
for item in changed:
    print(item)
