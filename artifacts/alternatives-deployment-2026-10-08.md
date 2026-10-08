# Alternatives deployment package

Status: local QA passed; not deployed or live verified.

Upload the ZIP contents to the existing toolboxkart.tech Hostinger public_html directory, retaining relative paths and the hidden .htaccess file. Back up the existing files listed below before replacing them. This is an incremental update for the existing PHP 8+ / Apache site, not a complete standalone site. No credentials, private editorial notes, tests, or environment files are included.

The package adds ten published article records, shared Alternatives templates and discovery, navigation, styles, routing, and dynamic sitemap entries. After upload, clear the hosting/page cache if necessary and verify /alternatives/, all ten canonical article URLs listed in articles/progress.md, and /sitemap.xml. Confirm one H1, canonical/description/schema, related links, and mobile tables. Apache rewrite behavior and live URLs still require host verification.

## SHA-256 file manifest

```
2bc095271438de6270a2bb105f2e00cb04b5fdca586a726d9545842d7ec04aae  .htaccess
52fadbc6fcda2c3c023c3ba7bd70a0771aec422457e5cde272df2d73896ed1ae  assets/css/app.css
853bbe402e9f9f668987bb8ba13cf7bbb63447181e55124720ffa9acca86d72c  includes/bootstrap.php
b449d8d4f1e993e3f01ec4a66639fb96842111ad58e8faa7007a7bc11bb7b862  includes/footer.php
45355d6e755b0c304082b67177bd956a509f99e654d2fa4f8113995bc05c9c9a  includes/header.php
4949738c086b2a2d79ac217dae57c24a16724f2109952a2eef9c21516979e8e3  router.php
b30701e4cb3bebebb698cc856e1271ba6e09ecbcb3184d8894305736098a5705  sitemap.php
05e3b1418c48b5d5925fcef7f921893712799562a52b72c9b584926af1a2739a  includes/alternatives.php
cd4737a51c8c0dbb07131cfe9094248978d7528c93854284cc42375099d00197  includes/alternative-template.php
404f01e9e7bf8559de2f01d65a73edf6d895b576e94d59b8e58ad371563e8a84  alternatives/index.php
a34b598b4d610dc39d944c6b6a5c1807aa69d6a26928c634c0c9997d0460a55b  alternatives/article.php
0a1b87b560ce3a7f7079754e216acbc41ed9ce936faf3759136b42f6d0f40076  alternatives/articles/arc-search-alternatives.php
adee549837783d2ca39948eb24d442ef6b16daadd12ce96a6a2efa6c8a6be09a  alternatives/articles/updf-alternatives.php
e6e2f565877c47e1406170cf3be45e4f2508b80e1376e9d0e57045129b63ed53  alternatives/articles/hera-alternatives.php
a3ec30934cadf04ef3c8a8df8d00f2b101e4e2b3f25598faf2eab017207162b1  alternatives/articles/pearl-alternatives.php
522366683973fc95e39c911a55e835d3ee29ae468658b1cbe8c233893ff3c943  alternatives/articles/orion-browser-alternatives.php
15ba15954eb4dd2e0127a72aea97e5fd47594cb51eab8180ade9708db4763175  alternatives/articles/shadow-alternatives.php
eb7026620d6b2b9d4337675e52f42118b3c5cb2358a162e422d2b66f88c9acfa  alternatives/articles/vector-alternatives.php
030215de13c9091e2a69e852b01fabbadfee237841367ff0d391dfc111eeb62e  alternatives/articles/freedom-alternatives.php
96f9b9294c89f0af1aebc8f842a4c3345a81250e73bde7f14de8f725d4964fa7  alternatives/articles/leave-me-alone-alternatives.php
583bba239c6c64ae138ddab329a2bad646fb7212bd10db61b6cb50bc6d473f71  alternatives/articles/ghostery-alternatives.php
```
