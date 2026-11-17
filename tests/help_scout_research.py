"""Source-led Help Scout research checkpoint checks."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
LEDGER = ROOT / "articles" / "help-scout-cluster-research.md"
QUEUE = ROOT / "seo" / "tool_publishing_queue.md"

def main():
    text = LEDGER.read_text()
    required = [
        "US$0.75 per resolution",
        "100 contacts per month",
        "knowledge-base/help-center articles",
        "sitemap-tools.xml",
        "Help Scout vs Zendesk",
        "actual PAA question wording",
    ]
    for phrase in required:
        assert phrase in text, f"Missing research evidence: {phrase}"
    queue = QUEUE.read_text()
    rows = [line for line in queue.splitlines() if line.startswith("|") and "Help Scout" in line]
    assert len(rows) == 1 and rows[0].rstrip().endswith("| in_progress |"), rows
    print("Help Scout research checkpoint valid.")

if __name__ == "__main__":
    main()
