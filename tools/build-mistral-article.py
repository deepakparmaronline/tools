from pathlib import Path
import json, subprocess, sys, re, html
import markdown
ROOT=Path(__file__).resolve().parents[1]
SLUG='mistral-large-4-api-routes'
TITLE='Mistral Large 4: API Routes, Pricing, and Limits'
DESCRIPTION='Mistral Large 4 is in public preview. Compare API context limits, launch prices, regional restrictions, and the checks to make before switching your workflow.'
STAMP=sys.argv[1]
CANONICAL='https://toolboxkart.tech/tech/'+SLUG+'/'
IMAGE='/images/'+SLUG+'.svg'
ALT='Mistral Large 4 API routes compared by context window and regional feature checks'
INTRO='''Mistral Large 4 entered public preview on October 6, 2026. Its launch gives developers a new model to evaluate for coding, document analysis, and tool-based workflows, while downloadable weights remain planned for later in October. The immediate decision is which API route fits your application. Mistral’s model page lists a one-million-token context window; OpenRouter lists 524,288 tokens for its route. That difference matters when moving a large document workflow or an existing agent.'''
ANSWER='''Evaluate Mistral Large 4 through the exact endpoint you expect to deploy, checking its context budget, features, and full-price costs. Wait for the published weights and deployment terms if self-hosting is a requirement.'''
BODY='''## What is available today?

The hosted preview API is available, while the downloadable weights are still a announced future release. Mistral’s [October 6 announcement](https://mistral.ai/news/mistral-large-4/) says the weights will arrive by the end of the month. Its [changelog](https://docs.mistral.ai/resources/changelogs) identifies the API model as `mistral-large-4` and labels it Public Preview.

“Open weights” means access to the model’s learned parameters for deployment under the release’s terms. A preview API gives access to a hosted service. Treat those as separate milestones, and check the eventual license and deployment documentation before making a self-hosting commitment.

Mistral reports coding, visual understanding, and agent-workflow evaluations in the announcement. These are useful shortlist signals, but the company’s reported results do not establish reliability on your documents, integrations, or acceptance criteria. This guide uses documentation; it does not report hands-on model testing.

## Which context limit should you plan around?

Use the limit published for the route your application will call. On October 8, Mistral’s [version-specific model card](https://docs.mistral.ai/models/mistral-large-4-0) lists 1M tokens, while [OpenRouter’s model page](https://openrouter.ai/mistralai/mistral-large-4-0) lists 524,288 tokens and up to 262,144 completion tokens.

| Route | Model identifier | Published context |
|---|---|---|
| Mistral API | `mistral-large-4` | 1M tokens on the model card |
| OpenRouter | `mistralai/mistral-large-4-0` | 524,288 tokens on its listing |

A context window is the working budget for the request and response. It is not a promise of accurate recall across every token. Large prompts also need room for instructions, tool messages, and the answer you expect.

For example, a workflow designed around a roughly 700,000-token request should not be moved unchanged to the listed OpenRouter route. Reduce the material, retrieve relevant sections, or evaluate the direct route. Confirm your account and request settings before relying on either advertised ceiling.

Record the endpoint, model identifier, and documentation date with your evaluation. A saved model name alone is insufficient to explain a later capacity error.

## How much does the preview cost?

Mistral’s current standard API sale rate is $0.68 per million input tokens and $2.09 per million output tokens. Its [API price sheet](https://docs.mistral.ai/inference/pricing) shows the undiscounted rates alongside the sale, and the changelog describes a two-week, 50% launch offer.

| Token type | Launch sale, USD per million | Listed undiscounted rate |
|---|---|---|
| Input | $0.68 | $1.36 |
| Cached input | $0.07 | $0.14 |
| Output | $2.09 | $4.18 |

As a worked example, 10 million uncached input tokens and one million output tokens cost $8.89 at these sale rates, versus $17.78 at the listed rates. This arithmetic excludes taxes, extra services, and route-specific charges. It is a scenario, not an observed monthly bill.

Budget using the undiscounted rates as well. Agent retries and repeated document submissions can change total consumption even when the per-token price is attractive. Compare cost per accepted task, including human review, rather than the price of one successful-looking response.

## Does a regional endpoint change the feature set?

Yes. Mistral’s [regional inference documentation](https://docs.mistral.ai/inference/regional-inference) lists restrictions beyond geography. Regional endpoints support function calling, but stateful Agents, Batch, and the Files API are unavailable there; model availability also varies by region.

The EU and US endpoints apply a 10% regional surcharge. The documentation describes this as 1.1 times standard list pricing, so confirm the applicable regional quote instead of applying the launch sale automatically.

Regional inference controls where eligible inference is processed. It does not localize every account, billing, or operational record, and it is separate from zero data retention. Check these controls independently before deciding that a deployment meets your data requirements.

Before a migration, list the models available on your intended regional endpoint. A global model card does not confirm availability or feature parity for that endpoint.

## What should a useful pilot check?

Start with a small set of representative tasks and written acceptance criteria. Include ordinary cases, missing information, a long document, and a malformed tool response. Keep the current working model available for comparison and rollback.

### Structured output and application checks

Mistral documents [custom structured outputs and JSON mode](https://docs.mistral.ai/studio/conversations/structured-output). A format constraint helps an application parse an answer; it does not prove that the extracted values are true.

Use ToolboxKart’s [JSON Formatter & Validator](/developer/json-formatter) to inspect a sanitized sample for syntax. Then check it against your application schema and source document. A syntactically valid amount can still reference the wrong invoice.

### Tool actions and failure handling

Separate proposed actions from executed actions. During the pilot, use a test environment, inspect tool arguments, and require review for changes that affect customers or production systems. Record failures and retries alongside accepted outputs.

Our [AI agent approval policy guide](/ai-news/ai-agent-approval-policy-template) provides a starting point for deciding which actions need review. Adapt that policy to the permissions your application actually grants.

## Mistral Large 4 FAQ

### Can I download Mistral Large 4 now?

The sources checked on October 8 describe hosted public preview access and weights planned by the end of October. Verify the official release before planning a downloadable deployment.

### Why does OpenRouter list a smaller context window?

Its listing publishes a different allowance for its API route. Use that route’s documented limit; the pages reviewed do not establish the reason for the difference.

### Is the launch price permanent?

No. Mistral’s changelog describes a two-week launch discount. Confirm current pricing before purchase and model your ongoing costs at the undiscounted rates too.

### Does EU inference mean all account data stays in the EU?

No. Mistral says regional inference does not provide regional storage for all control-plane data, including billing and account configuration.

## Make the endpoint part of the decision

Shortlist Large 4 when its documented capabilities fit a real task. Choose an API route, check the features and limits on that route, then run a controlled pilot against explicit acceptance criteria. If downloadable deployment is essential, make the final decision after the weights, terms, and operating requirements are available.
'''.replace('still a announced','still an announced')
SOURCES=[
('Mistral Large 4 announcement','https://mistral.ai/news/mistral-large-4/','October 6 public preview; planned end-of-month weights; vendor benchmark claims qualified.'),
('Mistral changelog','https://docs.mistral.ai/resources/changelogs','Model identifier, preview status, two-week 50% launch discount.'),
('Mistral Large 4 model card','https://docs.mistral.ai/models/mistral-large-4-0','Current direct API identifier and 1M context; extracted current page lists 52B active, while cached search showed 49B. Active count omitted because it is not needed for the decision.'),
('Mistral API pricing','https://docs.mistral.ai/inference/pricing','Standard USD input 0.68 sale/1.36 list, cached 0.07/0.14, output 2.09/4.18 per million tokens. Arithmetic scenario explicitly not a benchmark or actual bill.'),
('Mistral regional inference','https://docs.mistral.ai/inference/regional-inference','Regional 1.1x standard list surcharge, regional model listing required, unsupported stateful Agents/Batch/Files, control-plane and retention qualifications.'),
('Mistral structured outputs','https://docs.mistral.ai/studio/conversations/structured-output','JSON mode and custom schema formats; formatting support is distinguished from correctness.'),
('OpenRouter Large 4 route','https://openrouter.ai/mistralai/mistral-large-4-0','Gateway identifier, 524288 context and 262144 max completion tokens; primary for its own service, not an explanation of the direct route’s limits.')]
def e(s):return html.escape(str(s),quote=True)
toc=[]
content=markdown.markdown(BODY,extensions=['tables'])
def heading(match):
 text=match.group(1);ident=re.sub(r'[^a-z0-9]+','-',html.unescape(re.sub('<[^>]+>','',text)).lower()).strip('-')
 if text=='Mistral Large 4 FAQ':ident='faq'
 toc.append((ident,html.unescape(re.sub('<[^>]+>','',text))))
 return '<h2 id="'+ident+'">'+text+'</h2>'
content=re.sub(r'<h2>(.*?)</h2>',heading,content)
content=content.replace('<table>','<div class="publication-table"><table>').replace('</table>','</table></div>')
toc_html=''.join('<a href="#'+ident+'">'+e(text)+'</a>' for ident,text in toc)
data=json.loads(subprocess.check_output(['php','-r','require "includes/bootstrap.php"; echo json_encode(["posts"=>$posts,"tools"=>array_map(fn($t)=>["name"=>$t["name"],"description"=>$t["description"],"url"=>"/".$t["category"]."/".$t["slug"]],$catalog["tools"])]);'],cwd=ROOT))
posts=sorted(data['posts'],key=lambda p:p['date'],reverse=True)
recent=[];seen=set()
for p in posts:
 if p['slug']==SLUG or p['date']>'2026-10-08' or p['title'] in seen or not (ROOT/'blog'/(p['slug']+'.php')).exists():continue
 seen.add(p['title']);recent.append(p)
 if len(recent)==5:break
assert len(recent)==5
recent_html=''.join('<li><a href="'+e(subprocess.check_output(['php','-r','require "includes/bootstrap.php"; echo parse_url(post_url(post_by_slug($argv[1])),PHP_URL_PATH);',p['slug']],cwd=ROOT,text=True))+'">'+e(p['title'])+'</a></li>' for p in recent)
author_id='https://toolboxkart.tech/about-deepak-parmar/#person'
person={'@type':'Person','@id':author_id,'name':'Deepak Parmar','url':'https://toolboxkart.tech/about-deepak-parmar/','image':'https://toolboxkart.tech/images/deepak-parmar.jpeg','sameAs':['https://www.linkedin.com/in/deepakparmaronline/','https://www.youtube.com/@deepakparmaronline'],'jobTitle':'Technology writer','worksFor':{'@id':'https://toolboxkart.tech/#organization'}}
organization={'@type':'Organization','@id':'https://toolboxkart.tech/#organization','name':'Tool Box Kart','url':'https://toolboxkart.tech/','logo':{'@type':'ImageObject','url':'https://toolboxkart.tech/assets/favicon.svg'}}
article={'@type':'Article','@id':CANONICAL+'#article','url':CANONICAL,'mainEntityOfPage':CANONICAL,'headline':TITLE,'description':DESCRIPTION,'image':'https://toolboxkart.tech'+IMAGE,'datePublished':STAMP,'dateModified':STAMP,'author':{'@id':author_id},'publisher':{'@id':organization['@id']}}
faq_sections=BODY.split('## Mistral Large 4 FAQ',1)[1].split('## Make the endpoint',1)[0]
faqs=re.findall(r'### ([^\n]+)\n\n([^\n]+)',faq_sections)
faq={'@type':'FAQPage','@id':CANONICAL+'#faq','mainEntity':[{'@type':'Question','name':q,'acceptedAnswer':{'@type':'Answer','text':a}} for q,a in faqs]}
schema={'@context':'https://schema.org','@graph':[article,person,organization,faq]}
author='''<div class="publication-author"><a href="/about-deepak-parmar/"><img src="/images/deepak-parmar.jpeg" alt="Deepak Parmar" width="54" height="54"></a><div><strong>Written by <a href="/about-deepak-parmar/">Deepak Parmar</a></strong><div class="publication-author-links"><a href="https://www.linkedin.com/in/deepakparmaronline/">LinkedIn</a><a href="https://www.youtube.com/@deepakparmaronline">YouTube</a></div></div></div>'''
sources_html=''.join('<li><a href="'+e(url)+'">'+e(name)+'</a></li>' for name,url,note in SOURCES)
fallback='<noscript><nav class="publication-fallback" aria-label="Site navigation"><a href="/">ToolboxKart</a><a href="/tech/">Tech</a><a href="/tools-guide/">Tool guides</a><a href="/alternatives/">Alternatives</a><a href="/content/">All articles</a></nav></noscript>'
page=f'''<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{e(TITLE)} | ToolboxKart</title><meta name="description" content="{e(DESCRIPTION)}"><meta name="robots" content="index,follow,max-image-preview:large"><link rel="canonical" href="{CANONICAL}">
<meta property="og:title" content="{e(TITLE)}"><meta property="og:description" content="{e(DESCRIPTION)}"><meta property="og:type" content="article"><meta property="og:url" content="{CANONICAL}"><meta property="og:image" content="https://toolboxkart.tech{IMAGE}"><meta property="og:image:alt" content="{e(ALT)}"><meta property="article:published_time" content="{STAMP}">
<meta name="twitter:card" content="summary_large_image"><meta name="twitter:title" content="{e(TITLE)}"><meta name="twitter:description" content="{e(DESCRIPTION)}"><meta name="twitter:image" content="https://toolboxkart.tech{IMAGE}"><meta name="twitter:image:alt" content="{e(ALT)}">
<link rel="icon" href="/assets/favicon.svg"><link rel="stylesheet" href="/assets/css/app.css"><link rel="stylesheet" href="/assets/css/publication.css">
<script type="application/ld+json">{json.dumps(schema,ensure_ascii=False).replace('</','<\\/')}</script>
<script src="/assets/site.js" defer></script><script src="/assets/js/app.js" defer></script></head>
<body><a class="skip-link" href="#main">Skip to content</a><header id="site-header" class="site-header"></header>{fallback}
<main id="main"><div class="container publication-head"><a class="eyebrow" href="/tech/">Tech analysis</a><h1>{e(TITLE)}</h1><time class="publication-date" datetime="{STAMP}">Published October 8, 2026</time>{author}</div>
<div class="container publication-layout"><nav class="publication-toc" aria-label="Table of contents"><h2>On this page</h2>{toc_html}</nav>
<article class="publication-body"><p>{e(INTRO)}</p><figure class="publication-feature"><img src="{IMAGE}" alt="{e(ALT)}" width="1200" height="630" fetchpriority="high"><figcaption>Check the API route as well as the model. Published context limits differ between services.</figcaption></figure>
<section class="answer"><strong>Short answer:</strong> {e(ANSWER)}</section>
<details class="publication-mobile-toc"><summary>On this page</summary><nav aria-label="Mobile table of contents">{toc_html}</nav></details>
{content}
<section class="publication-end-author" aria-label="About the author">{author}<p>Deepak Parmar writes about SEO, AI, automation, and practical digital workflows at ToolboxKart. His guides distinguish verified documentation from editorial analysis and explain limitations alongside potential benefits.</p></section>
<section class="publication-sources" id="sources"><h2>Sources</h2><ul>{sources_html}</ul><p>Sources checked October 8, 2026. Pricing and endpoint features can change.</p></section>
</article><aside class="publication-recent" aria-label="Recent published articles"><h2>Recent Published Articles</h2><ol>{recent_html}</ol></aside></div></main>
<footer id="site-footer" class="site-footer"></footer>
<div class="search-modal" role="dialog" aria-modal="true" aria-label="Search tools" hidden><div class="search-panel"><div class="search-row"><span>⌕</span><input id="siteSearch" type="search" placeholder="Search tools…" autocomplete="off" aria-label="Search tools"><button type="button" class="search-close">Esc</button></div><div id="searchResults" class="search-results"></div></div></div>
<script>window.TOOLBOXKART_TOOLS={json.dumps(data['tools'],ensure_ascii=False).replace('</','<\\/')};</script>
</body></html>
'''
folder=ROOT/'tech'/SLUG;folder.mkdir(parents=True,exist_ok=True);(folder/'index.html').write_text(page)
editorial=ROOT/'articles'/SLUG;editorial.mkdir(parents=True,exist_ok=True)
sources_md='\n'.join('- ['+name+']('+url+')' for name,url,note in SOURCES)
(editorial/'article.md').write_text('# '+TITLE+'\n\nPublished October 8, 2026. Written by Deepak Parmar.\n\n'+INTRO+'\n\n!['+ALT+']('+IMAGE+')\n\n**Short answer:** '+ANSWER+'\n\n'+BODY+'\n\n## Sources\n\n'+sources_md+'\n')
(editorial/'schema.json').write_text(json.dumps(schema,ensure_ascii=False,indent=2)+'\n')
(editorial/'seo.md').write_text(f'# SEO brief\n\nPrimary query: Mistral Large 4 API\nSecondary queries: Mistral Large 4 context window; pricing; OpenRouter context limit; regional inference\nIntent: evaluate API route and migration fit.\nReader: developers and teams evaluating long document or tool workflows.\nCategory: tech\nTitle: {TITLE}\nDescription ({len(DESCRIPTION)} characters): {DESCRIPTION}\nCanonical: {CANONICAL}\nFeatured image: {IMAGE} (1200 × 630, original standalone SVG).\nAlt: {ALT}\n')
(editorial/'sources.md').write_text('# Evidence ledger\n\nChecked 2026-10-08, Asia/Kolkata. Primary sources support product facts. No hands-on model tests.\n\n| Source | Official URL | Evidence and qualification |\n|---|---|---|\n'+'\n'.join('| '+name+' | '+url+' | '+note+' |' for name,url,note in SOURCES)+'\n\nCoverage discovery: reviewed current October 6–7 coverage at mistrallarge4.org/api-pricing, omidsaffari.com/blog/mistral-large-4, mercatus-ai.com/blog/mistral-large-4-api-pricing, and highcircl.com/en/blog/mistral-large-4. Many explain promotional pricing and future weights. The useful added angle is the endpoint-specific context difference and regional feature exclusions, verified against the services’ own documentation. No competitor wording or performance claims copied.\n\nAuthor image: public GitHub profile API identifies Deepak Parmar and avatar https://avatars.githubusercontent.com/u/231306918?v=4; downloaded unchanged JPEG for the author asset requested by the site owner.\n')
(editorial/'notes.md').write_text('# Publishing notes\n\nOne new story under the user’s attached standard. Existing article URLs are retained. The article is complete HTML, with direct metadata, static readable heading IDs and TOCs, exactly two author blocks, one publication date, five recent links, FAQ matching schema, and no breadcrumbs. site.js supplies header/footer navigation only; shared app.js handles existing search/theme/menu interactions and does not generate this page’s article elements. A noscript site navigation fallback is present.\n\nLimits: no model calls, benchmark reproduction, or region account availability tests performed. No absolute reason for the differing context limits is asserted. Current primary pages replaced stale cached parameter counts; active count omitted. Launch offer and full prices are separated; regional discount eligibility not inferred. SVG is an original route illustration, not a screenshot. Author photo was copied from the repository owner’s existing public avatar without generating or altering a face.\n\nInternal links: JSON Formatter validates syntax only; approval policy supports permission decisions. Recent articles use verified registry/source files. Optional unrelated tool links omitted.\n\nPublication: prepared locally; QA and GitHub push pending. Live verification requires deployment evidence.\n')
words=len(re.findall(r'\b[\w’]+\b',INTRO+' '+ANSWER+' '+BODY))
print(json.dumps({'slug':SLUG,'words':words,'description_characters':len(DESCRIPTION),'recent':len(recent),'timestamp':STAMP}))
