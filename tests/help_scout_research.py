"""Help Scout research and saved-metric checks."""
import re
from pathlib import Path
R=Path(__file__).resolve().parents[1]
q=(R/"seo/tool_publishing_queue.md").read_text(encoding="utf-8")
s=(R/"alternatives list.md").read_text(encoding="utf-8")
x=(R/"articles/help-scout-cluster-research.md").read_text(encoding="utf-8")
row=next((z for z in q.splitlines() if re.search(r"\|\s*8\s*\|\s*Help Scout\s*\|",z)),"")
assert row and all(v in row for v in ["260","16","46.62","I/C"]),row
assert "in_progress" in row or "published" in row,row
saved=[z for z in s.splitlines() if "HelpScout alternative" in z or "Help Scout alternative" in z]
assert saved and any(all(v in z for v in ["260","16","46.62"]) for z in saved),saved
assert "November 22, 2026" in x
for v in ["US$25","US$30","US$45","US$54","US$75","US$90","US$0.75","three months"]:assert v.lower() in x.lower(),v
assert "No Semrush data was refreshed" in x
print("Help Scout research and saved-metric checks passed.")
