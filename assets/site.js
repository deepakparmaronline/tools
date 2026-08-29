// Tool Box Kart — site-wide navigation, article layout, author blocks, TOC, related tools and footer.
(function () {
  'use strict';

  const ARTICLE_CATEGORIES = new Set(['seo-guide', 'tech', 'tools-guide', 'explainers']);
  const AUTHOR = {
    name: 'Deepak Parmar',
    profile: '/about-deepak-parmar/',
    photo: '/images/deepak-parmar.jpeg',
    linkedin: 'https://www.linkedin.com/in/deepakparmaronline/',
    youtube: 'https://www.youtube.com/@deepakparmaronline',
    bio1: 'Deepak Parmar is an SEO and AI-search specialist focused on technical SEO, content strategy, and search visibility.',
    bio2: 'He writes practical guides on Google Search, AI Search, AI tools, technology, and digital workflows.'
  };

  const esc = value => String(value).replace(/[&<>'"]/g, c => ({
    '&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'
  }[c]));

  async function loadManifest() {
    try {
      const response = await fetch('/assets/manifest.php', { cache: 'no-store' });
      if (!response.ok) throw new Error('manifest request failed: ' + response.status);
      return await response.json();
    } catch (error) {
      console.error('Tool Box Kart manifest error:', error);
      return { niches: [] };
    }
  }

  function injectStyles() {
    if (document.getElementById('tbk-site-styles')) return;
    const style = document.createElement('style');
    style.id = 'tbk-site-styles';
    style.textContent = `
      *{box-sizing:border-box}
      .tbk-shared-nav{background:#14171c;padding:0 22px;display:flex;align-items:center;justify-content:space-between;min-height:64px;position:sticky;top:0;z-index:1000;border-bottom:3px solid #ffc23a;gap:20px}
      .tbk-shared-nav .tbk-brand{color:#f5f3ec!important;display:flex;align-items:center;gap:10px;font:700 1.03rem 'Space Mono','Courier New',monospace;text-decoration:none;white-space:nowrap}
      .tbk-shared-nav .tbk-brand span{color:#14171c;background:#ffc23a;padding:5px 8px;border-radius:4px}
      .tbk-shared-nav .tbk-links{display:flex;align-items:center;justify-content:flex-end;gap:17px;flex-wrap:wrap}
      .tbk-shared-nav .tbk-links a{color:#f5f3ec!important;text-decoration:none;font:700 .84rem Inter,system-ui,sans-serif}
      .tbk-shared-nav .tbk-links a:hover{color:#ffc23a!important}
      .tbk-article-wrap{max-width:1240px;margin:0 auto;padding:34px 20px 72px}
      .tbk-article-layout{display:grid;grid-template-columns:220px minmax(0,900px) 250px;gap:30px;align-items:start}
      .tbk-toc,.tbk-tools-panel{position:sticky;top:88px;background:#151515;border:1px solid #2a2a2a;border-radius:14px;padding:18px}
      .tbk-toc h2,.tbk-tools-panel h2{color:#fff;font-size:1rem;line-height:1.3;margin:0 0 12px;font-weight:800}
      .tbk-toc a{display:block;color:#aaa0f2;text-decoration:none;font-size:.87rem;line-height:1.4;padding:7px 0}
      .tbk-toc a:hover,.tbk-tools-panel a:hover{text-decoration:underline}
      .tbk-toc .tbk-h3-link{padding-left:12px;color:#9d96c9}
      .tbk-tools-panel p{color:#999;font-size:.85rem;line-height:1.5;margin:0 0 12px}
      .tbk-tools-panel a{display:block;color:#aaa0f2;text-decoration:none;font-size:.88rem;line-height:1.4;padding:8px 0;border-top:1px solid #262626}
      .tbk-article-main{min-width:0}
      .tbk-article-main>h1{margin:0 0 10px;color:#fff;font-size:clamp(34px,5.5vw,56px);line-height:1.08}
      .tbk-post-meta{color:#888;font-size:.9rem;margin:0 0 20px}
      .tbk-author-top{display:flex;align-items:center;gap:11px;margin:0 0 24px}
      .tbk-author-top img{width:42px;height:42px;border-radius:50%;object-fit:cover;border:1px solid #333}
      .tbk-author-top .tbk-author-copy{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
      .tbk-author-top a{color:#aaa0f2;text-decoration:none;font-weight:700}
      .tbk-author-top .tbk-social{display:flex;gap:10px;margin-left:4px}
      .tbk-author-top .tbk-social a{font-size:.8rem;color:#aaa0f2}
      .tbk-hero{padding-bottom:6px}
      .tbk-hero img{width:100%;height:auto;display:block;border:1px solid #292929;border-radius:16px;margin:20px 0 30px}
      .tbk-answer{background:#171717;border:1px solid #292929;border-left:4px solid #aaa0f2;border-radius:12px;padding:18px;margin:20px 0 30px}
      .tbk-article-main h2{color:#fff;line-height:1.25;margin-top:42px}
      .tbk-article-main h3{color:#fff;line-height:1.3;margin-top:28px}
      .tbk-article-main p{margin:0 0 18px}
      .tbk-article-main ul,.tbk-article-main ol{padding-left:22px}
      .tbk-article-main a{color:#aaa0f2}
      .tbk-author-bottom{margin:44px 0 28px;padding:22px;background:#171717;border:1px solid #292929;border-radius:14px;display:grid;grid-template-columns:72px minmax(0,1fr);gap:16px}
      .tbk-author-bottom img{width:72px;height:72px;border-radius:50%;object-fit:cover;border:1px solid #333}
      .tbk-author-bottom h2{margin:0 0 9px;color:#fff;font-size:1.15rem}
      .tbk-author-bottom p{margin:5px 0;color:#aaa}
      .tbk-author-bottom .tbk-author-links{display:flex;gap:12px;flex-wrap:wrap;margin-top:12px}
      .tbk-author-bottom .tbk-author-links a{font-weight:700;color:#aaa0f2;text-decoration:none}
      .tbk-sources{margin-top:32px;padding-top:20px;border-top:1px solid #292929}
      .tbk-sources h2{margin-top:0!important}
      .tbk-footer{background:#14171c;border-top:3px solid #ffc23a;padding:38px 20px 28px;margin-top:20px}
      .tbk-footer-inner{max-width:1180px;margin:auto}
      .tbk-footer-row{display:flex;justify-content:center;flex-wrap:wrap;gap:12px 20px;margin-bottom:18px}
      .tbk-footer-row a{color:#cfcabb;text-decoration:none;font-size:.9rem;font-weight:700}
      .tbk-footer-row a:hover{color:#ffc23a}
      .tbk-footer-copy{text-align:center;color:#7c8291;font:500 .82rem 'Space Mono','Courier New',monospace}
      .tbk-mobile-tools{display:none}
      @media(max-width:1050px){
        .tbk-article-layout{grid-template-columns:200px minmax(0,1fr)}
        .tbk-tools-panel{display:none}
        .tbk-mobile-tools{display:block;background:#151515;border:1px solid #2a2a2a;border-radius:14px;padding:18px;margin:28px 0}
      }
      @media(max-width:760px){
        .tbk-shared-nav{padding:12px 14px;align-items:flex-start}
        .tbk-shared-nav .tbk-links{gap:10px 14px}
        .tbk-shared-nav .tbk-links a{font-size:.76rem}
        .tbk-article-wrap{padding:22px 14px 52px}
        .tbk-article-layout{grid-template-columns:1fr}
        .tbk-toc{position:static;order:2}
        .tbk-article-main{order:1}
        .tbk-author-bottom{grid-template-columns:1fr}
        .tbk-tools-panel{display:none}
      }
    `;
    document.head.appendChild(style);
  }

  function renderHeader() {
    let nav = document.querySelector('nav');
    if (!nav) {
      nav = document.createElement('nav');
      document.body.prepend(nav);
    }
    nav.className = 'tbk-shared-nav';
    nav.innerHTML = `
      <a class="tbk-brand" href="/"><span>TBK</span> Tool Box Kart</a>
      <div class="tbk-links">
        <a href="/seo/">SEO Tools</a>
        <a href="/finance/">Finance Tools</a>
        <a href="/image-tools/">Image Tools</a>
        <a href="/seo-guide/">SEO Guides</a>
        <a href="/tools-guide/">Tool Guides</a>
        <a href="/explainers/">Explainers</a>
        <a href="/tech/">Tech</a>
      </div>`;
  }

  function renderFooter(niches) {
    let footer = document.querySelector('footer');
    if (!footer) {
      footer = document.createElement('footer');
      document.body.appendChild(footer);
    }
    footer.className = 'tbk-footer';
    const nicheLinks = niches.map(n => `<a href="${esc(n.path)}">${esc(n.label.replace(/-/g,' '))}</a>`).join('');
    footer.innerHTML = `
      <div class="tbk-footer-inner">
        <div class="tbk-footer-row">${nicheLinks}</div>
        <div class="tbk-footer-row">
          <a href="/seo-guide/">SEO Guides</a>
          <a href="/tools-guide/">Tool Guides</a>
          <a href="/explainers/">Explainers</a>
          <a href="/tech/">Tech</a>
          <a href="/transparency/">Transparency</a>
          <a href="/security/">Security</a>
          <a href="/privacy-policy/">Privacy</a>
          <a href="/terms-of-service/">Terms</a>
        </div>
        <p class="tbk-footer-copy">© ${new Date().getFullYear()} Tool Box Kart. Built for privacy, efficiency, and speed.</p>
      </div>`;
  }

  function getArticleParts() {
    const parts = location.pathname.split('/').filter(Boolean);
    if (parts.length < 2 || !ARTICLE_CATEGORIES.has(parts[0])) return null;
    const isRoot = parts.length === 1 || parts[1] === 'index.html';
    if (isRoot) return null;
    const main = document.querySelector('main');
    const h1 = main && main.querySelector('h1');
    if (!main || !h1) return null;
    return { category: parts[0], slug: parts[1], main, h1 };
  }

  function addId(el, fallback) {
    if (!el.id) el.id = fallback;
    return el.id;
  }

  function buildToc(articleMain, host) {
    const headings = Array.from(articleMain.querySelectorAll('h2, h3'))
      .filter(h => !h.closest('.tbk-sources') && !h.classList.contains('tbk-generated'));
    if (!headings.length) return;
    const links = headings.map((h, i) => {
      const id = addId(h, 'section-' + (i + 1));
      return `<a class="${h.tagName === 'H3' ? 'tbk-h3-link' : ''}" href="#${esc(id)}">${esc(h.textContent.trim())}</a>`;
    }).join('');
    host.innerHTML = `<h2>Table of Contents</h2>${links}`;
  }

  function buildToolsPanel(article, niches, mobile) {
    const seo = niches.find(n => n.key === 'seo');
    if (!seo || !seo.tools || !seo.tools.length) return;
    const title = (article.h1.textContent || '').toLowerCase();
    const preferredTerms = ['schema','canonical','meta','internal','keyword','sitemap','robots','alt text','heading','redirect','link'];
    const scored = seo.tools.map(tool => {
      const words = (tool.name + ' ' + tool.slug).toLowerCase();
      const score = preferredTerms.reduce((sum, term, i) => sum + (words.includes(term) ? (preferredTerms.length - i) : 0), 0);
      return { tool, score };
    }).sort((a,b) => b.score - a.score || a.tool.name.localeCompare(b.tool.name));
    const picked = scored.slice(0, 8).map(x => x.tool);
    const html = `<h2>Try Our Best SEO Tools</h2><p>Useful tools from Tool Box Kart for common SEO checks and workflows.</p>${picked.map(t => `<a href="${esc(t.path)}">${esc(t.name)}</a>`).join('')}`;
    host.innerHTML = html;
    if (mobile) host.classList.add('tbk-mobile-tools');
  }

  function addAuthorTop(article) {
    if (document.querySelector('.tbk-author-top')) return;
    const top = document.createElement('div');
    top.className = 'tbk-author-top tbk-generated';
    top.innerHTML = `
      <img src="${AUTHOR.photo}" alt="Deepak Parmar">
      <div class="tbk-author-copy">
        <span>Written by <a href="${AUTHOR.profile}">${AUTHOR.name}</a></span>
        <span class="tbk-social">
          <a href="${AUTHOR.linkedin}" rel="me noopener" target="_blank">LinkedIn</a>
          <a href="${AUTHOR.youtube}" rel="me noopener" target="_blank">YouTube</a>
        </span>
      </div>`;
    article.h1.insertAdjacentElement('afterend', top);
  }

  function addAuthorBottom(article) {
    if (document.querySelector('.tbk-author-bottom')) return;
    const sources = article.main.querySelector('.sources, #sources, [data-resources], .resources');
    if (!sources) return;
    sources.classList.add('tbk-sources');
    const box = document.createElement('section');
    box.className = 'tbk-author-bottom tbk-generated';
    box.innerHTML = `
      <img src="${AUTHOR.photo}" alt="Deepak Parmar">
      <div>
        <h2>Written by <a href="${AUTHOR.profile}">${AUTHOR.name}</a></h2>
        <p>${AUTHOR.bio1}</p>
        <p>${AUTHOR.bio2}</p>
        <div class="tbk-author-links">
          <a href="${AUTHOR.linkedin}" rel="me noopener" target="_blank">LinkedIn</a>
          <a href="${AUTHOR.youtube}" rel="me noopener" target="_blank">YouTube</a>
        </div>
      </div>`;
    sources.parentNode.insertBefore(box, sources);
  }

  function addArticleLayout(article, niches) {
    if (article.main.dataset.tbkArticleReady === '1') return;
    article.main.dataset.tbkArticleReady = '1';

    injectStyles();
    addAuthorTop(article);

    const children = Array.from(article.main.children).filter(el => !el.classList.contains('tbk-generated'));
    const contentNodes = children.filter(el => el !== article.h1);

    const wrap = document.createElement('div');
    wrap.className = 'tbk-article-wrap tbk-generated';
    const layout = document.createElement('div');
    layout.className = 'tbk-article-layout';
    const toc = document.createElement('aside');
    toc.className = 'tbk-toc';
    const center = document.createElement('article');
    center.className = 'tbk-article-main';
    const tools = document.createElement('aside');
    tools.className = 'tbk-tools-panel';

    article.h1.parentNode.insertBefore(wrap, article.h1);
    center.appendChild(article.h1);

    contentNodes.forEach(node => center.appendChild(node));
    layout.appendChild(toc);
    layout.appendChild(center);
    layout.appendChild(tools);
    wrap.appendChild(layout);
    article.main.appendChild(wrap);

    buildToc(center, toc);
    buildToolsPanel(article, niches, tools);
    addAuthorBottom({ main: center });
    wrap.querySelector('img') && wrap.querySelector('img').setAttribute('loading','eager');

    const mobileTools = document.createElement('aside');
    mobileTools.className = 'tbk-mobile-tools tbk-generated';
    center.appendChild(mobileTools);
    buildToolsPanel(article, niches, mobileTools);
  }

  function renderCategoryIndex() {
    const parts = location.pathname.split('/').filter(Boolean);
    if (parts.length !== 1 || !ARTICLE_CATEGORIES.has(parts[0])) return;
    const grid = document.querySelector('.grid');
    if (!grid) return;
    fetch('/assets/content-index.json', { cache: 'no-store' })
      .then(r => r.ok ? r.json() : null)
      .then(data => {
        if (!data) return;
        const posts = (data.categories && data.categories[parts[0]]) || [];
        grid.innerHTML = posts.map(post => `
          <article class="card">
            <p class="meta">${esc(post.category)}</p>
            <a href="${esc(post.path || post.url)}">${esc(post.title)}</a>
            <p>${esc(post.description || '')}</p>
          </article>`).join('');
      })
      .catch(err => console.error('Content index error:', err));
  }

  function renderHomepage(niches) {
    const target = document.getElementById('dynamic-categories');
    if (!target) return;
    target.innerHTML = niches.map(n => `
      <section id="${esc(n.key)}" class="niche-section">
        <div class="niche-header"><div class="niche-icon">#</div><h2>${esc(n.label)}</h2></div>
        <div class="tools-grid">${(n.tools || []).map(t => `<a href="${esc(t.path)}" class="tool-card">➜ ${esc(t.name)}</a>`).join('')}</div>
      </section>`).join('');
  }

  loadManifest().then(data => {
    const niches = data.niches || [];
    injectStyles();
    renderHeader();
    renderFooter(niches);
    renderHomepage(niches);
    const article = getArticleParts();
    if (article) addArticleLayout(article, niches);
  });

  renderCategoryIndex();
})();