# Mistral article deployment package

State: local QA complete; GitHub authentication required for push; not live verified.

Incremental update for the existing PHP/Apache Hostinger site. Back up these files on the host, then upload the ZIP contents to the existing public_html root, keeping relative paths and the hidden .htaccess file. This package includes all new public assets and shared navigation dependencies. Editorial files, build tools, tests, and unrelated environment files are excluded.

Verify /tech/mistral-large-4-api-routes/, /tech/, /content/, the homepage and tool-page navigation, author profile, and /sitemap.xml after deployment. The article must load its image, both author photos, header/footer, static TOCs, recent links, and metadata/schema. No breadcrumbs should appear on this new article. Apache redirects remain to be checked on the host.

## SHA-256 manifest

```
8f0f174c6f7b85688697579d56273b6178750b8a30ff657a2f70c35a94b646ad  .htaccess
dd4092dfcabe04d4d4412a65d847ed43e6a954cddca5a1c60ee17c4df4b559df  assets/css/app.css
0a5b58a2b6d4a457c4004ce2b17f487150507906b298cd225b7628cef824fd12  assets/css/publication.css
39967969b4b1b8257ed4d5fe623074e0e2ed756e1f99c94f07fbcd068496c868  assets/site.js
956fad2dda379ddb63526992a74d27428bfddde6f65e81adf5b8126829f65764  includes/header.php
a1a483f25eae38b4b11cf720879c1a5845dde5dd69c2595666c318fefa03446f  includes/footer.php
d17f8ea98acd276af5c0797643c00fc30159de5eee20e9f4518c847b25fc0ccc  includes/functions.php
34a84e9805b7d51e2a22902689f6b0021bd205a8ea9b9ff717d9b08204424545  includes/editorial-index.php
538f220db4cab88d7338b199ec71ea6eb420088791bd32511cf394ac95159a0e  router.php
724ba51e829ebef5ffdc8951217f3908df180c7ae60dcd21b65d4422991c7fc1  sitemap.php
7ab29aa5b67f9e7667a2f0a03ba10e9891193326e911f3a94b646cef7b4b3dd2  sitemap.xml
70a6f743df431d1cc51766b6ea2fece9bd1d5c4bad4625199b12b9150b1fb209  tech/index.php
5b454395a6511d7eb4611ba2c81a23bae0ce22e47c26df810e89ad21eae56e39  tech/mistral-large-4-api-routes/index.html
7582d1f2a4c0ee34f041bd21e2f14dd07872bf815f57a236ab0c1cd948d5ecd5  content/index.php
898238d6c29718139a69cf8823ff5c2893207e4a1fbb0df1b12ae5ad7df3f5bd  about-deepak-parmar/index.php
fbee4f5e0919f7e4ab9de97aef647360a1ff20fb21d1eccc1fafdb0e44954142  images/deepak-parmar.jpeg
02d4aa3c8c9d33b9171a6c10d1fc64a3f71b3bbc60f7f7eeecefc5b942d599cb  images/mistral-large-4-api-routes.svg
268501e9ae011078c8160100c1c967d918753ce87f0c63583c1fc66e33e0b428  data/post-2026-10-08-mistral-large-4.php
```
