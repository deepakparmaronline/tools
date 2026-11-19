"""Validates the non-public Help Scout hub and pricing checkpoint drafts."""
import json
import re
from pathlib import Path
import xml.etree.ElementTree as ET

ROOT = Path(__file__).resolve().parents[1]
HUB = ROOT / "articles/help-scout-hub"
PRICING = ROOT / "articles/help-scout-pricing"
SITE = "https://toolboxkart.tech"
CHILD_MAPS = [
    "/sitemap-tools.xml", "/sitemap-alternatives.xml", "/sitemap-reviews.xml",
    "/sitemap-pricing.xml", "/sitemap-how-to-use.xml", "/sitemap-compare.xml",
    "/sitemap-categories.xml", "/sitemap-pages.xml",
]

def word_count(markdown):
    text = re.sub(r"\[([^\]]+)\]\([^)]+\)", r"\1", markdown)
    text = re.sub(r"[#*|]", " ", text)
    return len(re.findall(r"\b[\w’'-]+\b", text))

def check_page(folder, canonical, primary, low, high, schema_types, faq_questions, date_published="2026-11-18T00:00:00+05:30"):
    article = (folder / "article.md").read_text()
    seo = (folder / "seo.md").read_text()
    sources = (folder / "sources.md").read_text()
    notes = (folder / "notes.md").read_text()
    schema = json.loads((folder / "schema.json").read_text())
    count = word_count(article)
    assert low <= count <= high, f"{folder.name}: {count} words outside {low}-{high}"
    assert article.startswith("# ") and article.count("\n# ") == 0, f"{folder.name}: expected one H1"
    assert primary in seo and canonical in seo, folder.name
    seo_title = re.search(r"\*\*SEO title:\*\* (.+)", seo).group(1)
    assert len(seo_title + " | ToolboxKart") <= 60, f"{folder.name}: title too long"
    meta = re.search(r"\*\*Meta description:\*\* (.+)", seo).group(1)
    assert 140 <= len(meta) <= 160, f"{folder.name}: description {len(meta)} chars"
    graph = schema.get("@graph", [])
    types = {item.get("@type") for item in graph}
    assert schema.get("@context") == "https://schema.org", folder.name
    assert schema_types <= types, (folder.name, schema_types, types)
    article_schema = next(item for item in graph if item.get("@type") == "Article")
    assert article_schema.get("mainEntityOfPage") == canonical, folder.name
    assert article_schema.get("datePublished") == date_published, folder.name
    faq = next((item for item in graph if item.get("@type") == "FAQPage"), None)
    assert faq is not None, folder.name
    questions = {item["name"] for item in faq.get("mainEntity", [])}
    assert questions == faq_questions, folder.name
    for question in faq_questions:
        assert question in article, f"{folder.name}: FAQ not visible: {question}"
    for url in re.findall(r"https://[^\s)]+", article):
        assert url in sources, f"{folder.name}: source link missing from ledger: {url}"
    assert "Draft only" in notes and "unregistered" in notes.lower() and "unlinked" in notes.lower(), folder.name
    assert len(re.findall(r"\]\(/[^)]+\)", article)) >= 4, f"{folder.name}: too few internal links"

def main():
    check_page(
        HUB, SITE + "/help-scout/", "Help Scout", 500, 900,
        {"Article", "BreadcrumbList", "SoftwareApplication", "FAQPage"},
        {"Is Help Scout free?", "Can Help Scout replace a ticketing system?", "Can I connect an AI agent to Help Scout?"},
    )
    check_page(
        PRICING, SITE + "/help-scout/pricing/", "Help Scout pricing", 800, 1400,
        {"Article", "BreadcrumbList", "FAQPage"},
        {"Is Help Scout billed per agent or per ticket?", "Can I add more Inboxes or Docs?", "Does the annual plan cost less?", "Can I control Envoy costs?"},
    )
    check_page(
        ROOT / "articles/help-scout-review", SITE + "/help-scout/review/", "Help Scout review", 1500, 2200,
        {"Article", "BreadcrumbList", "FAQPage"},
        {"Is Help Scout good for a small business?", "Does Help Scout have a free plan?", "Does Help Scout include AI?", "Can Help Scout replace Zendesk?", "Can I export all Help Scout data?"},
        "2026-11-19T00:00:00+05:30",
    )
    check_page(
        ROOT / "articles/help-scout-how-to-use", SITE + "/help-scout/how-to-use/", "how to use Help Scout", 1200, 2000,
        {"Article", "BreadcrumbList", "FAQPage"},
        {"How do I connect my support email to Help Scout?", "How do I create a Help Scout knowledge base?", "Can I use Help Scout workflows on the Free plan?", "What does Help Scout import from another help desk?", "Can I export Help Scout conversation threads?"},
        "2026-11-19T00:00:00+05:30",
    )
    static_index = ET.fromstring((ROOT / "sitemap.xml").read_text())
    assert static_index.tag.endswith("sitemapindex")
    locations = [node.text.strip() for node in static_index.findall(".//{http://www.sitemaps.org/schemas/sitemap/0.9}loc")]
    assert locations == [SITE + child for child in CHILD_MAPS], locations
    robots = (ROOT / "robots.txt").read_text()
    assert f"Sitemap: {SITE}/sitemap.xml" in robots
    for child in CHILD_MAPS:
        assert f"Sitemap: {SITE + child}" in robots, child
    public_files = [
        ROOT / "data/software-pages.php", ROOT / "sitemap-tools.php",
        ROOT / "sitemap-pricing.php", ROOT / "sitemap-how-to-use.php",
        ROOT / "sitemap-compare.php", ROOT / "sitemap-alternatives.php",
        ROOT / "sitemap-reviews.php",
        ROOT / "alternatives/articles/freshdesk-alternatives.php",
        ROOT / "alternatives/articles/zendesk-alternatives.php",
    ]
    for path in public_files:
        assert "/help-scout/" not in path.read_text(), path
    assert not (ROOT / "alternatives/articles/help-scout-alternatives.php").exists()
    assert not (ROOT / "reviews/help-scout-review/index.php").exists()
    print(f"Help Scout draft checkpoint valid: hub {word_count((HUB / 'article.md').read_text())} words, pricing {word_count((PRICING / 'article.md').read_text())} words.")

if __name__ == "__main__":
    main()
