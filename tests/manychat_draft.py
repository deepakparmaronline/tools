"""Manychat research checkpoint and draft validation."""
import json
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]

def words(text):
    text = re.sub(r"\[([^\]]+)\]\([^)]+\)", r"\1", text)
    text = re.sub(r"[#*|]", " ", text)
    return len(re.findall(r"\b[\w’'-]+\b", text))

def check_page(slug, limits, canonical):
    folder = ROOT / "articles" / slug
    article = (folder / "article.md").read_text(encoding="utf-8")
    seo = (folder / "seo.md").read_text(encoding="utf-8")
    sources = (folder / "sources.md").read_text(encoding="utf-8")
    notes = (folder / "notes.md").read_text(encoding="utf-8")
    schema = json.loads((folder / "schema.json").read_text(encoding="utf-8"))
    title = re.search(r"(?m)^Title: (.+)$", seo).group(1)
    description = re.search(r"(?m)^Meta description: (.+)$", seo).group(1)
    canon = re.search(r"(?m)^Canonical: (.+)$", seo).group(1)
    assert len(title) <= 60, (slug, title)
    assert 140 <= len(description) <= 160, (slug, len(description), description)
    assert canon == canonical, (slug, canon)
    assert "Robots: index,follow" in seo
    assert "Checked on November 23, 2026" in article
    assert "Quality gate: pending" in notes
    assert limits[0] <= words(article) <= limits[1], (slug, words(article))
    for url in re.findall(r"https?://[^\s)>]+", article):
        assert url.rstrip(".,") in sources, (slug, url)
    assert "—" not in article
    graph = schema["@graph"]
    types = {item.get("@type") for item in graph}
    assert {"Article", "BreadcrumbList", "FAQPage"}.issubset(types), (slug, types)
    breadcrumb = next(item for item in graph if item.get("@type") == "BreadcrumbList")
    assert breadcrumb["itemListElement"][-1]["item"] == canonical
    faq = next(item for item in graph if item.get("@type") == "FAQPage")
    for item in faq["mainEntity"]:
        assert item["name"] in article, (slug, item["name"])
    if slug == "manychat-hub":
        app = next(item for item in graph if item.get("@type") == "SoftwareApplication")
        assert "aggregateRating" not in app and "review" not in app

def main():
    research = (ROOT / "articles/manychat-cluster-research.md").read_text(encoding="utf-8")
    assert "ManyChat alternative" in research
    assert "260" in research and "13" in research and "US$8.57" in research
    assert "No Semrush refresh, login or query was performed" in research
    assert "Advanced overage" in research
    queue = (ROOT / "seo/tool_publishing_queue.md").read_text(encoding="utf-8")
    assert re.search(r"(?m)^\|\s*9\s*\|\s*ManyChat\s*\|[^\n]*\|\s*in_progress\s*\|$", queue)
    manifest = json.loads((ROOT / "seo/publication-manifest.json").read_text(encoding="utf-8"))
    assert manifest["order"] == 9 and manifest["tool"] == "ManyChat"
    assert manifest["publish_ready"] is False
    check_page("manychat-hub", (500, 900), "https://toolboxkart.tech/manychat/")
    check_page("manychat-pricing", (800, 1400), "https://toolboxkart.tech/manychat/pricing/")
    print("Manychat research, metadata, word counts and draft schemas passed.")

if __name__ == "__main__":
    main()