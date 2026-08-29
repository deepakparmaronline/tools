#!/usr/bin/env python3
from __future__ import annotations

import json
import re
from pathlib import Path
from typing import Any

CATEGORIES = ("seo-guide", "tech", "tools-guide", "explainers")
ROOT = Path(__file__).resolve().parents[1]
OUTPUT = ROOT / "assets" / "content-index.json"


def value(pattern: str, html: str) -> str:
    match = re.search(pattern, html, re.I | re.S)
    return match.group(1).strip() if match else ""


def read_post(path: Path, category: str) -> dict[str, Any] | None:
    html = path.read_text(encoding="utf-8", errors="ignore")
    title = value(r"<title>(.*?)</title>", html)
    description = value(
        r'<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']',
        html,
    )
    canonical = value(
        r'<link\s+rel=["\']canonical["\']\s+href=["\'](.*?)["\']',
        html,
    )
    if not canonical or path.parent.name == category:
        return None

    schema_type = value(r'"@type"\s*:\s*"([^"]+)"', html)
    content_type = {
        "FAQPage": "explainer",
        "HowTo": "how-to",
        "ItemList": "ranking",
    }.get(schema_type, "news" if category in {"seo-guide", "tech"} else "guide")

    return {
        "url": canonical,
        "title": title,
        "description": description,
        "category": category,
        "type": content_type,
        "path": "/" + str(path.relative_to(ROOT)).replace("\\", "/"),
    }


def main() -> None:
    content: list[dict[str, Any]] = []
    categories: dict[str, list[dict[str, Any]]] = {c: [] for c in CATEGORIES}

    for category in CATEGORIES:
        folder = ROOT / category
        if not folder.exists():
            continue
        for post in sorted(folder.glob("*/index.html")):
            item = read_post(post, category)
            if item:
                categories[category].append(item)
                content.append(item)

    content.sort(key=lambda x: (x["category"], x["title"].lower()))

    OUTPUT.write_text(
        json.dumps({"categories": categories, "posts": content}, indent=2, ensure_ascii=False) + "\n",
        encoding="utf-8",
    )
    print(f"Wrote {OUTPUT.relative_to(ROOT)} with {len(content)} posts.")


if __name__ == "__main__":
    main()
