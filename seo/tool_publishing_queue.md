# ToolBoxKart Fixed Publishing Queue

> This is the only tool-selection source for the daily ToolBoxKart schedule. The schedule must follow this file in order and must not choose a different tool from the broader keyword list.

## Queue rules

- At the start of a run, resume the first row marked `in_progress`. If none exists, take the lowest Order row marked `queued`.
- Do not recalculate, reorder, or replace the queue during a daily publishing run.
- Change the selected row to `in_progress` before content work. Change it to `published` only after the complete cluster is committed to `main`, all finished pages are registered and present in public indexes/sitemaps, and the ToolboxKart quality workflow passes for the exact content commit. Hostinger auto-deploys from `main`; live HTTP verification is the owner's step and is not a commit gate.
- Use public SERPs to fill search-intent gaps when committed evidence is incomplete. Do not invent metrics or exact PAA questions. If a price, limit or feature cannot be verified, omit the claim or say public details were not found and continue. Mark `needs_review` only when product identity, safety, or a material core fact remains genuinely unresolved.
- `new cluster` means create the complete cluster. `expand live alternative` means preserve the existing Alternatives URL and add or improve its missing sibling pages and internal links.
- Preserve committed Semrush metrics exactly and follow seo/search_research_snapshot.md. Do not open Semrush. Public SERP research is allowed for intent and competitor coverage, but never invent Semrush metrics or undocumented PAA questions.
- Never add AI news, ChatGPT news, Claude news, general technology news, piracy, paywall bypass, or non-software topics to this queue.
- The separate `deepakparmaronline/tech-updates` repository and its ChatGPT schedule are outside this file and must not be changed.

## How this order was prepared

The order was prepared on 2026-10-24 from the Semrush US snapshot in `alternatives list.md`. It combines search volume, lower keyword difficulty, intent, CPC, trend, and useful SERP features. Existing published Alternatives pages receive a small cluster-leverage bonus because adding their missing hub, review, pricing, how-to, comparison, and category links can strengthen an already indexed URL. The score is a planning aid, not a ranking guarantee.

Full-queue metrics may be reviewed only in a separate owner-authorized research task after the first 60 completed rows or after 90 days, whichever comes first. Daily runs may not refresh the selected tool or reorder the remaining queue.

## Ordered queue

| Order | Tool | Primary keyword | Action | Volume | KD | CPC | Intent | Status |
| ---: | --- | --- | --- | ---: | ---: | ---: | --- | --- |
| 1 | Zendesk | Zendesk alternative | new cluster | 880 | 22 | $64.61 | C | published |
| 2 | Freshdesk | Freshdesk alternative | new cluster | 480 | 16 | $46.98 | C | in_progress |
| 3 | Drift | Drift alternative | new cluster | 320 | 8 | $36.12 | I/C | queued |
| 4 | Fiverr | Fiverr alternative | new cluster | 1900 | 29 | $4.30 | n/a | queued |
| 5 | Gmail | Gmail alternative | new cluster | 1300 | 38 | $2.10 | I/C | queued |
| 6 | n8n | n8n alternative | new cluster | 720 | 20 | $6.88 | C | queued |
| 7 | Notion | Notion alternative | new cluster | 1000 | 34 | $4.60 | C | queued |
| 8 | Help Scout | HelpScout alternative | new cluster | 260 | 16 | $46.62 | I/C | queued |
| 9 | ManyChat | ManyChat alternative | new cluster | 260 | 13 | $8.57 | I/C | queued |
| 10 | Mailgun | Mailgun alternative | new cluster | 210 | 11 | $11.86 | I/C | queued |
| 11 | Plex | Plex alternative | new cluster | 1600 | 29 | $0.00 | I | queued |
| 12 | Gainsight | Gainsight alternative | expand live alternative | 50 | 3 | $41.89 | I/C | queued |
| 13 | Front | Front alternative | new cluster | 320 | 15 | $31.26 | I | queued |
| 14 | HubSpot | HubSpot alternative | new cluster | 480 | 24 | $32.16 | I | queued |
| 15 | Wati | Wati alternative | expand live alternative | 90 | 4 | $14.04 | C | queued |
| 16 | Gong | Gong alternative | new cluster | 90 | 10 | $40.45 | I/C | queued |
| 17 | Zapier | Zapier alternative | new cluster | 390 | 27 | $8.36 | I/C | queued |
| 18 | PandaDoc | PandaDoc alternative | new cluster | 390 | 17 | $26.73 | I | queued |
| 19 | WeTransfer | WeTransfer alternative | new cluster | 880 | 24 | $5.64 | I | queued |
| 20 | Klaviyo | Klaviyo alternative | new cluster | 210 | 24 | $41.89 | I/C | queued |
| 21 | LinkedIn | LinkedIn alternative | new cluster | 320 | 19 | $4.85 | I | queued |
| 22 | Tidio | Tidio alternative | new cluster | 210 | 20 | $23.10 | C | queued |
| 23 | Zoho | Zoho alternative | new cluster | 390 | 25 | $14.79 | I | queued |
| 24 | Rippling | Rippling alternative | new cluster | 90 | 9 | $90.92 | I/C | queued |
| 25 | Basecamp | Basecamp alternative | new cluster | 320 | 20 | $11.06 | I/C | queued |
| 26 | RocketReach | RocketReach alternative | new cluster | 170 | 15 | $15.80 | C | queued |
| 27 | Dropbox | Dropbox alternative | new cluster | 590 | 35 | $4.61 | C | queued |
| 28 | CoSchedule | CoSchedule alternative | new cluster | 210 | 14 | $7.58 | I/C | queued |
| 29 | Todoist | Todoist alternative | new cluster | 320 | 17 | $3.98 | I/C | queued |
| 30 | Aircall | Aircall alternative | new cluster | 210 | 15 | $52.81 | I | queued |
| 31 | Okta | Okta alternative | new cluster | 110 | 13 | $18.08 | I/C | queued |
| 32 | LiveChat | LiveChat alternative | new cluster | 110 | 9 | $14.08 | I/C | queued |
| 33 | Vanta | Vanta alternative | expand live alternative | 110 | 10 | $158.79 | I | queued |
| 34 | Proton Mail | ProtonMail alternative | new cluster | 390 | 30 | $3.85 | I | queued |
| 35 | Dialpad | Dialpad alternative | new cluster | 90 | 20 | $48.00 | C | queued |
| 36 | Zoho Desk | Zoho Desk alternative | new cluster | 90 | 11 | $25.62 | I | queued |
| 37 | UserTesting | UserTesting alternative | new cluster | 50 | 6 | $16.41 | I/C | queued |
| 38 | Sunsama | Sunsama alternative | expand live alternative | 110 | 7 | $3.48 | C | queued |
| 39 | Sanity.io | Sanity.io alternative | new cluster | 210 | 14 | $0.00 | I/C | queued |
| 40 | Granola | Granola alternative | new cluster | 210 | 21 | $8.75 | I | queued |
| 41 | Kayako | Kayako alternative | new cluster | 70 | 9 | $46.22 | I/C | queued |
| 42 | Microsoft 365 | Microsoft 365 alternative | new cluster | 210 | 33 | $7.96 | I/C | queued |
| 43 | Webflow | Webflow alternative | new cluster | 210 | 20 | $4.90 | I | queued |
| 44 | Gorgias | Gorgias alternative | new cluster | 90 | 15 | $30.82 | I | queued |
| 45 | Cloudinary | Cloudinary alternative | new cluster | 110 | 11 | $8.19 | I | queued |
| 46 | iMazing | iMazing alternative | new cluster | 260 | 17 | $1.51 | I | queued |
| 47 | Brandfolder | Brandfolder alternative | new cluster | 50 | 9 | $55.33 | I | queued |
| 48 | Dropbox Sign (HelloSign) | HelloSign alternative | new cluster | 90 | 18 | $6.57 | C | queued |
| 49 | Ghost | Ghost alternative | new cluster | 50 | 10 | $3.44 | C | queued |
| 50 | Google Calendar | Google Calendar alternative | new cluster | 260 | 34 | $2.46 | I | queued |
| 51 | GitBook | GitBook alternative | new cluster | 140 | 20 | $13.86 | C | queued |
| 52 | CloudTalk | CloudTalk alternative | new cluster | 50 | 4 | $49.81 | I/C | queued |
| 53 | Contentful | Contentful alternative | new cluster | 140 | 17 | $14.22 | I | queued |
| 54 | Stonly | Stonly alternative | expand live alternative | 40 | 3 | $39.53 | I/C | queued |
| 55 | Gusto | Gusto alternative | new cluster | 70 | 26 | $67.86 | I | queued |
| 56 | Gamma | Gamma alternative | new cluster | 40 | 13 | $4.52 | C | queued |
| 57 | Nylas | Nylas alternative | expand live alternative | 30 | 3 | $8.32 | I/C | queued |
| 58 | Postmark | Postmark alternative | new cluster | 70 | 13 | $8.55 | I/C | queued |
| 59 | Mintlify | Mintlify alternative | expand live alternative | 40 | 12 | $8.47 | I | queued |
| 60 | Resend | Resend alternative | new cluster | 70 | 15 | $5.76 | I | queued |
| 61 | Magento | Magento alternative | new cluster | 70 | 10 | $9.81 | I | queued |
| 62 | Slite | Slite alternative | new cluster | 90 | 2 | $17.90 | I/C | queued |
| 63 | Krisp | Krisp alternative | new cluster | 70 | 20 | $5.50 | I/C | queued |
| 64 | NoteGPT | NoteGPT alternative | expand live alternative | 50 | 4 | $2.72 | I/C | queued |
| 65 | Google Sites | Google Sites alternative | new cluster | 140 | 6 | $3.65 | I | queued |
| 66 | Akiflow | Akiflow alternative | expand live alternative | 70 | 9 | $3.44 | I | queued |
| 67 | Google Tasks | Google Tasks alternative | new cluster | 50 | 13 | $3.45 | I/C | queued |
| 68 | iCloud | iCloud alternative | new cluster | 210 | 20 | $1.59 | I | queued |
| 69 | Syncthing | Syncthing alternative | new cluster | 110 | 13 | $5.12 | I | queued |
| 70 | WhatsApp Business | WhatsApp Business alternative | new cluster | 50 | 8 | $8.14 | I | queued |
| 71 | Later | Later alternative | new cluster | 50 | 19 | $8.41 | I | queued |
| 72 | Proposify | Proposify alternative | new cluster | 70 | 21 | $19.72 | I/N | queued |
| 73 | Fireflies.ai | Fireflies.ai alternative | new cluster | 40 | 23 | $5.14 | I/C | queued |
| 74 | Superhuman | Superhuman alternative | new cluster | 40 | 13 | $8.76 | I | queued |
| 75 | Coda | Coda alternative | new cluster | 70 | 5 | $7.89 | I | queued |
| 76 | Taskade | Taskade alternative | expand live alternative | 30 | 10 | $9.19 | C | queued |
| 77 | Pushbullet | Pushbullet alternative | new cluster | 140 | 8 | $0.00 | I | queued |
| 78 | Microsoft To Do | Microsoft To Do alternative | new cluster | 50 | 14 | $4.05 | I/C | queued |
| 79 | ruttl | ruttl alternative | expand live alternative | 50 | 0 | $0.00 | C | queued |
| 80 | CallPage | CallPage alternative | expand live alternative | 50 | 0 | $0.00 | I/C | queued |
| 81 | Jumpshare | Jumpshare alternative | new cluster | 30 | 8 | $6.16 | I/C | queued |
| 82 | Raycast | Raycast alternative | new cluster | 70 | 11 | $0.00 | I | queued |
| 83 | Cyberduck | Cyberduck alternative | new cluster | 40 | 13 | $7.74 | I | queued |
| 84 | Statuspage | Statuspage alternative | new cluster | 70 | 14 | $9.45 | I | queued |
| 85 | Drupal | Drupal alternative | new cluster | 40 | 18 | $8.27 | I | queued |
| 86 | DocHub | DocHub alternative | new cluster | 30 | 7 | $4.60 | I | queued |
| 87 | Google Contacts | Google Contacts alternative | new cluster | 90 | 9 | $0.00 | I | queued |
| 88 | Chatwoot | Chatwoot alternative | new cluster | 40 | 8 | $10.61 | I | queued |
| 89 | Strapi | Strapi alternative | new cluster | 70 | 10 | $6.08 | I | queued |
| 90 | Survicate | Survicate alternative | expand live alternative | 40 | 12 | $0.00 | I/C | queued |
| 91 | GetAccept | GetAccept alternative | new cluster | 50 | 2 | $0.00 | I/C | queued |
| 92 | Bubble | Bubble alternative | new cluster | 30 | 8 | $7.31 | I | queued |
| 93 | odrive | odrive alternative | expand live alternative | 70 | 4 | $0.00 | I | queued |
| 94 | TidyCal | TidyCal alternative | expand live alternative | 50 | 11 | $0.00 | I | queued |
| 95 | Fantastical | Fantastical alternative | expand live alternative | 30 | 6 | $2.42 | I | queued |
| 96 | Alfred | Alfred alternative | new cluster | 70 | 26 | $0.00 | I/C | queued |
| 97 | Toast | Toast alternative | new cluster | 70 | 24 | $3.21 | I | queued |
| 98 | Instawork | Instawork alternative | new cluster | 40 | 19 | $1.75 | I | queued |
| 99 | MobiLoud | MobiLoud alternative | expand live alternative | 50 | 8 | $0.00 | I | queued |
| 100 | LiveAgent | LiveAgent alternative | new cluster | 40 | 13 | $0.00 | I/C | queued |
| 101 | Arc Search | Arc Search alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 102 | Freedom | Freedom alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 103 | Ghostery | Ghostery alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 104 | Leave Me Alone | Leave Me Alone alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 105 | Pearl | Pearl alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 106 | Shadow | Shadow alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 107 | UPDF | UPDF alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 108 | Vector | Vector alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 109 | Hera | Hera alternative | expand live alternative | 20 | n/a | $0.00 | n/a | queued |
| 110 | Orion Browser | Orion Browser ✴︎ alternative | expand live alternative | n/a | n/a | n/a | n/a | queued |

## Held rows

These rows are not part of the runnable queue. A daily run must not select them.

| Keyword | Status | Reason |
| --- | --- | --- |
| Bartender alternative | needs_review | Confirm whether intent is the macOS utility or BarTender label software. |
| Brandy alternative | needs_review | The product identity and software intent need confirmation. |
| Eden alternative | needs_review | The name is ambiguous; confirm the workplace-management product and official URL. |
| Groove alternative | needs_review | The query can refer to different support and sales products. |
| Motion AI alternative | needs_review | Multiple products and a discontinued historical product can match this query. |
| MushRoom alternative | needs_review | The exact software product and official source are unclear. |
| Proton alternative | needs_review | The query may mean Proton Mail, Proton VPN, or the full Proton suite. |
| Switch alternative | needs_review | Multiple unrelated software products use this name. |
| Help Scout alternative | duplicate | Duplicate intent of the higher-volume `HelpScout alternative` row. |

## Metric notes

- `Freshdesk alternative` uses the Semrush metrics exported for the supplied `Freshdesk 🙌 alternative` query. The article must use the official product name Freshdesk without the emoji.
- `Fireflies.ai alternative` uses the Semrush metrics exported for the supplied `Fireflies.ai 👔 alternative` query. The article must use the official product name Fireflies.ai without the emoji.
- `HelpScout alternative` is the higher-volume keyword variant in the snapshot. Article copy must use the official product name Help Scout.
- `ProtonMail alternative` is the researched keyword. Article copy must use the current official product name confirmed from Proton sources.
- Metrics marked `n/a` must remain `n/a` during scheduled runs. Do not invent or refresh them. Product identity and all article facts still require current official-source verification.
