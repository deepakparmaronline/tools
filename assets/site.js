// Toolbox Kart — shared dynamic nav / homepage grid / related-tools engine.
(function () {

  async function loadManifest() {
    try {
      const res = await fetch('/assets/manifest.php', { cache: 'no-store' });
      if (!res.ok) throw new Error('manifest.php request failed: ' + res.status);
      return await res.json();
    } catch (err) {
      console.error('Manifest load failed. Ensure you are running on a live/local web server.', err);
      return { niches: [] };
    }
  }

  function renderNav(niches) {
    // 1. Desktop Dropdown Nav (For Homepage)
    const el = document.getElementById('dynamic-nav');
    if (el) {
      el.innerHTML = niches.map(niche => `
        <div class="relative group">
          <button class="nav-link flex items-center gap-1 py-6 font-medium text-gray-600 hover:text-indigo-600">
            ${escapeHTML(niche.label)} ▾
          </button>
          <div class="absolute hidden group-hover:block bg-white border border-gray-100 shadow-xl rounded-xl py-2 w-72 mt-0 transition-all z-50">
            ${niche.tools.map(t => `<a href="${escapeHTML(t.path)}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">${escapeHTML(t.name)}</a>`).join('')}
          </div>
        </div>
      `).join('') + '<a href="/blog/" class="nav-link py-6 font-medium text-gray-600 hover:text-indigo-600">Blog</a>';
    }

    // 2. Mobile Dropdown Nav (For Homepage)
    const mobEl = document.getElementById('mobile-menu');
    if (mobEl) {
      mobEl.innerHTML = niches.map(niche => `
        <div class="py-2">
          <div class="font-bold text-gray-900 mb-1">${escapeHTML(niche.label)}</div>
          <div class="pl-4 border-l-2 border-indigo-100 flex flex-col gap-2 mt-2">
            ${niche.tools.map(t => `<a href="${escapeHTML(t.path)}" class="text-sm text-gray-600 hover:text-indigo-600">${escapeHTML(t.name)}</a>`).join('')}
          </div>
        </div>
      `).join('');
    }
  }

  function niceLabel(label) {
    // Avoid "Image Tools Tools" when the folder name already says Tools.
    return /tools$/i.test(label.trim()) ? label : `${label} Tools`;
  }

  function escapeHTML(value) {
    return String(value).replace(/[&<>'"]/g, character => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      "'": '&#39;',
      '"': '&quot;'
    }[character]));
  }

  function renderSharedNav() {
    if (document.getElementById('tbk-shared-nav-css')) return;

    const style = document.createElement('style');
    style.id = 'tbk-shared-nav-css';
    style.textContent = `
      .tbk-shared-nav { background: #14171c; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; min-height: 64px; position: sticky; top: 0; z-index: 100; border-bottom: 3px solid #ffc23a; }
      .tbk-shared-nav .nav-brand { color: #f5f3ec !important; display: flex; align-items: center; gap: 10px; font: 700 1.05rem 'Space Mono', 'Courier New', monospace; text-decoration: none; letter-spacing: 0.5px; }
      .tbk-shared-nav .nav-brand span { color: #14171c; background: #ffc23a; padding: 0.3rem 0.55rem; border-radius: 4px; font: 700 0.95rem 'Space Mono', 'Courier New', monospace; }
      .tbk-shared-nav .nav-links { display: flex; align-items: center; gap: 1.25rem; }
      .tbk-shared-nav .nav-links a { color: #f5f3ec !important; font: 700 0.85rem 'Inter', system-ui, sans-serif; text-decoration: none; }
      .tbk-shared-nav .nav-links a:hover, .tbk-shared-nav .nav-links a:focus-visible { color: #ffc23a !important; }
      .tbk-author-inline { display: flex; align-items: center; gap: 12px; margin: 18px 0 10px; color: #4f5864; font-size: 0.88rem; }
      .tbk-author-inline img { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid #e1ddce; background: #fff; }
      .tbk-author-inline a { color: #24537d; text-decoration: none; font-weight: 700; }
      .tbk-author-inline a:hover { text-decoration: underline; }
      .tbk-author-inline .tbk-author-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; }
      .tbk-author-inline .tbk-social-links { display: flex; gap: 10px; margin-left: 6px; }
      .tbk-author-inline .tbk-social-links a { font-size: 0.76rem; color: #365d82; }
      .tbk-author-box { margin: 44px 0 28px; padding: 22px; background: #fff; border: 1px solid #e1ddce; border-radius: 12px; }
      .tbk-author-box-inner { display: flex; align-items: center; gap: 16px; }
      .tbk-author-box img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 2px solid #e1ddce; }
      .tbk-author-box h2 { font-family: 'Space Mono','Courier New',monospace; font-size: 1.15rem; margin: 0 0 8px; }
      .tbk-author-box p { margin: 5px 0; color: #4f5864; }
      .tbk-author-links { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 12px; }
      .tbk-author-links a { font-weight: 700; color: #24537d; text-decoration: none; }
      .tbk-author-links a:hover { text-decoration: underline; }
      @media (max-width: 600px) { .tbk-shared-nav { padding: 0.75rem 1rem; gap: 0.75rem; } .tbk-shared-nav .nav-links { gap: 0.65rem; flex-wrap: wrap; justify-content: flex-end; } .tbk-shared-nav .nav-links a { font-size: 0.72rem; } .tbk-author-box-inner { flex-direction: column; align-items: flex-start; } }
    `;
    document.head.appendChild(style);

    const navHTML = '<a class="nav-brand" href="/"><span>TBK</span> Tool Box Kart</a><div class="nav-links"><a href="/seo/">SEO Tools</a><a href="/finance/">Finance Tools</a><a href="/image-tools/">Image Tools</a><a href="/seo-guide/">SEO Guides</a><a href="/tools-guide/">Tool Guides</a><a href="/explainers/">Explainers</a><a href="/tech/">Tech Guides</a></div>';
    let nav = document.querySelector('nav');
    if (!nav) {
      nav = document.createElement('nav');
      document.body.prepend(nav);
    }
    nav.className = 'tbk-shared-nav';
    nav.innerHTML = navHTML;

    const legacyStaticNav = document.querySelector('.tbk-static-nav, .tbk-static-footer');
    if (legacyStaticNav && legacyStaticNav !== nav) {
      legacyStaticNav.remove();
    }
  }

  async function renderContentCategoryIndex() {
    const category = window.location.pathname.split('/').filter(Boolean)[0];
    const supported = new Set(['seo-guide', 'tech', 'tools-guide', 'explainers']);
    if (!supported.has(category) || window.location.pathname === '/' + category + '/index.html') {
      // index.html is also a category page; continue below.
    }
    const isCategoryRoot =
      window.location.pathname === '/' + category + '/' ||
      window.location.pathname === '/' + category + '/index.html';
    if (!isCategoryRoot) return;

    const grid = document.querySelector('.grid');
    if (!grid) return;

    try {
      const response = await fetch('/assets/content-index.json', { cache: 'no-store' });
      if (!response.ok) throw new Error('content-index request failed: ' + response.status);
      const data = await response.json();
      const posts = (data.categories && data.categories[category]) || [];

      if (!posts.length) {
        grid.innerHTML = '<p class="empty">New resources will appear here as they are published.</p>';
        return;
      }

      const label = category === 'seo-guide' ? 'SEO Guide' :
        category === 'tech' ? 'Tech Guide' :
        category === 'tools-guide' ? 'Tool Guide' : 'Explainer';

      grid.innerHTML = posts.map(post => `
        <article class="card">
          <p class="meta">${escapeHTML(label)}</p>
          <a href="${escapeHTML(post.url)}">${escapeHTML(post.title)}</a>
          <p>${escapeHTML(post.description)}</p>
        </article>`
      ).join('');
    } catch (err) {
      console.error('Unified content index load failed.', err);
    }
  }

  function renderHomepageCategories(niches) {
    const el = document.getElementById('dynamic-categories');
    if (!el) return;
    el.innerHTML = niches.map(niche => `
      <section id="${niche.key}" class="niche-section">
        <div class="niche-header">
          <div class="niche-icon">#</div>
          <h2>${niceLabel(niche.label)}</h2>
        </div>
        <div class="tools-grid">
          ${niche.tools.map(t => `<a href="${escapeHTML(t.path)}" class="tool-card"><span>➔</span> ${escapeHTML(t.name)}</a>`).join('')}
        </div>
      </section>`
    ).join('');
  }

  function renderRelatedTools(niches) {
    const el = document.getElementById('related-tools');
    if (!el) return;

    const pathArray = window.location.pathname.split('/').filter(Boolean);
    if (pathArray.length < 2) return; 
    
    const currentNicheKey = pathArray[0]; 
    const currentToolSlug = pathArray[1]; 

    const niche = niches.find(n => n.key === currentNicheKey);
    if (!niche) return;

    const others = niche.tools.filter(t => t.slug !== currentToolSlug);
    if (others.length === 0) return;

    // Premium Dark Theme Engine for Tool Pages
    if (el.dataset.theme === 'dark') {
      el.innerHTML = `
        <div style="background: #161616; border: 1px solid #272727; border-radius: 14px; padding: 2rem; margin-top: 2rem;">
          <h2 style="color: #fff; font-size: 1.4rem; font-weight: 700; margin-bottom: 1.25rem;">More ${escapeHTML(niche.label)} Tools</h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
            ${others.map(t => `
              <a href="${escapeHTML(t.path)}" style="display: flex; align-items: center; background: #111; border: 1px solid #222; border-radius: 10px; padding: 1rem; text-decoration: none; color: #ddd; font-weight: 600; font-size: 0.95rem; transition: border-color 0.2s;">
                <span style="color: #7c6fcd; margin-right: 10px;">➔</span> ${escapeHTML(t.name)}
              </a>`).join('')}
          </div>
        </div>`;
      return;
    }
  }

  const FOOTER_LEGAL_LINKS = [
    { label: 'Transparency', href: '/transparency/' },
    { label: 'Security', href: '/security/' },
    { label: 'Privacy Policy', href: '/privacy-policy/' },
    { label: 'Terms of Service', href: '/terms-of-service/' },
  ];

  function injectFooterStyles() {
    if (document.getElementById('tbk-footer-css')) return;
    const style = document.createElement('style');
    style.id = 'tbk-footer-css';
    style.textContent = `
      .tbk-footer { background: #14171c; border-top: 3px solid #ffc23a; padding: 2.5rem 2rem 2rem; margin-top: 4rem; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
      .tbk-footer-inner { max-width: 1100px; margin: 0 auto; }
      .tbk-footer-row { display: flex; flex-wrap: wrap; gap: 1.2rem 1.6rem; justify-content: center; margin-bottom: 1.4rem; }
      .tbk-footer-row a, .tbk-footer-row button { color: #cfcabb; text-decoration: none; font-size: 0.9rem; font-weight: 600; background: none; border: none; cursor: pointer; padding: 0; font-family: inherit; }
      .tbk-footer-row a:hover, .tbk-footer-row button:hover { color: #ffc23a; }
      .tbk-footer-tools { border-bottom: 1px solid #272b33; padding-bottom: 1.4rem; }
      .tbk-footer-copy { text-align: center; color: #7c8291; font-size: 0.85rem; font-family: 'Space Mono', 'Courier New', monospace; }
    `;
    document.head.appendChild(style);
  }

  const AUTHOR_PROFILE = {
    name: 'Deepak Parmar',
    profile: '/about-deepak-parmar/',
    photo: '/images/deepak-parmar.jpeg',
    bio1: 'Deepak Parmar is an SEO and AI-search specialist focused on technical SEO, content strategy, and search visibility.',
    bio2: 'He writes practical guides on Google Search, AI Search, AI tools, technology, and digital workflows.',
    linkedin: 'https://www.linkedin.com/in/deepakparmaronline/',
    youtube: 'https://www.youtube.com/@deepakparmaronline'
  };

  function currentArticleInfo() {
    const parts = window.location.pathname.split('/').filter(Boolean);
    const categories = new Set(['seo-guide', 'tech', 'tools-guide', 'explainers']);
    if (parts.length < 2 || !categories.has(parts[0])) return null;
    const h1 = document.querySelector('h1');
    if (!h1) return null;
    return {
      category: parts[0],
      categoryLabel: parts[0] === 'seo-guide' ? 'SEO Guides' :
        parts[0] === 'tech' ? 'Tech' :
        parts[0] === 'tools-guide' ? 'Tool Guides' : 'Explainers',
      title: h1.textContent.trim()
    };
  }

  function ensureAuthorStyles() {
    if (document.getElementById('tbk-author-css')) return;
    const style = document.createElement('style');
    style.id = 'tbk-author-css';
    style.textContent = `
      .tbk-byline{display:flex;align-items:center;gap:8px;margin:10px 0 18px;color:#69717d;font:500 .82rem/1.4 Inter,system-ui,sans-serif}
      .tbk-byline img{width:28px;height:28px;border-radius:50%;object-fit:cover;border:1px solid #d8d3c7}
      .tbk-byline a{color:#365d82;text-decoration:none;font-weight:650}
      .tbk-byline a:hover{text-decoration:underline}
      .tbk-author-box{display:grid;grid-template-columns:72px minmax(0,1fr);gap:16px;margin:44px 0 28px;padding:22px;background:#fff;border:1px solid #e1ddce;border-radius:12px}
      .tbk-author-photo{width:72px;height:72px;border-radius:50%;object-fit:cover;border:1px solid #d8d3c7}
      .tbk-author-box h2{font:700 1.1rem/1.3 'Space Mono','Courier New',monospace;margin:0 0 8px}
      .tbk-author-box p{margin:5px 0;color:#4f5864}
      .tbk-author-links{display:flex;flex-wrap:wrap;gap:12px;margin-top:12px}
      .tbk-author-links a{font-weight:700;color:#24537d;text-decoration:none}
      .tbk-author-links a:hover{text-decoration:underline}
      @media(max-width:560px){.tbk-author-box{grid-template-columns:1fr}.tbk-author-photo{width:64px;height:64px}}
    `;
    document.head.appendChild(style);
  }

  function injectArticleBreadcrumb() {
    const info = currentArticleInfo();
    if (!info || document.querySelector('.tbk-breadcrumbs')) return;
    ensureAuthorStyles();

    const b = document.createElement('div');
    b.className = 'tbk-breadcrumbs';
    b.innerHTML = `<a href="/">Home</a><span class="sep">/</span><a href="/${info.category}/">${escapeHTML(info.categoryLabel)}</a><span class="sep">/</span><span>${escapeHTML(info.title)}</span>`;
    const main = document.querySelector('main');
    if (main) main.insertBefore(b, main.firstChild);

    let byline = document.querySelector('.tbk-byline');
    if (!byline) {
      const metaCandidates = Array.from(document.querySelectorAll('.meta, header .meta, header p'));
      const meta = metaCandidates.find(el => /^By\s+Deepak\s+Parmar/i.test(el.textContent.trim()));
      if (meta) {
        meta.innerHTML = `By <a href="${AUTHOR_PROFILE.profile}">${AUTHOR_PROFILE.name}</a>`;
        meta.classList.add('tbk-byline');
        const img = document.createElement('img');
        img.src = AUTHOR_PROFILE.photo;
        img.alt = 'Deepak Parmar';
        meta.prepend(img);
      } else {
        const header = document.querySelector('main > header, article > header, .hero');
        const h1 = header && header.querySelector('h1');
        if (h1) {
          const meta = document.createElement('p');
          meta.className = 'tbk-byline';
          meta.innerHTML = `By <a href="${AUTHOR_PROFILE.profile}">${AUTHOR_PROFILE.name}</a>`;
          const img = document.createElement('img');
          img.src = AUTHOR_PROFILE.photo;
          img.alt = 'Deepak Parmar';
          meta.prepend(img);
          h1.insertAdjacentElement('afterend', meta);
        }
      }
    }

    const sources = document.querySelector('.sources, #sources, [data-resources], .resources');
    if (sources && !document.querySelector('.tbk-author-box')) {
      const box = document.createElement('section');
      box.className = 'tbk-author-box';
      box.innerHTML = `
        <img class="tbk-author-photo" src="${AUTHOR_PROFILE.photo}" alt="Deepak Parmar">
        <div>
          <h2>Written by <a href="${AUTHOR_PROFILE.profile}">${AUTHOR_PROFILE.name}</a></h2>
          <p>${AUTHOR_PROFILE.bio1}</p>
          <p>${AUTHOR_PROFILE.bio2}</p>
          <div class="tbk-author-links">
            <a href="${AUTHOR_PROFILE.linkedin}" rel="me noopener" target="_blank">LinkedIn profile</a>
            <a href="${AUTHOR_PROFILE.youtube}" rel="me noopener" target="_blank">YouTube profile</a>
          </div>
        </div>`;
      sources.parentNode.insertBefore(box, sources);
    }
  }

  function renderFooter(niches) {
    injectFooterStyles();

    const toolLinksHTML = (niches || [])
      .map(n => `<a href="${escapeHTML(n.path)}">${escapeHTML(niceLabel(n.label))}</a>`)
      .join('');

    const legalLinksHTML = FOOTER_LEGAL_LINKS
      .map(l => `<a href="${l.href}">${l.label}</a>`)
      .concat('<a href="/seo-guide/">SEO Guides</a>')
      .concat('<a href="/tools-guide/">Tool Guides</a>')
      .concat('<a href="/explainers/">Explainers</a>')
      .concat('<a href="/tech/">Tech Guides</a>')
      .join('') + `<button type="button" id="tbk-cookie-prefs">Cookie preferences</button>`;

    const html = `
      <div class="tbk-footer-inner">
        <div class="tbk-footer-row tbk-footer-tools">${toolLinksHTML}</div>
        <div class="tbk-footer-row">${legalLinksHTML}</div>
        <p class="tbk-footer-copy">&copy; ${new Date().getFullYear()} Tool Box Kart. Built for privacy, efficiency, and speed.</p>
      </div>`;

    let footerEl = document.querySelector('footer');
    if (!footerEl) {
      footerEl = document.createElement('footer');
      document.body.appendChild(footerEl);
    }
    footerEl.className = 'tbk-footer';
    footerEl.innerHTML = html;
  }

  loadManifest().then(data => {
    const niches = data.niches || [];
    renderSharedNav();
    if (niches.length > 0) {
      renderNav(niches);
      renderHomepageCategories(niches);
      renderRelatedTools(niches);
    }
    renderFooter(niches);
  });
  renderContentCategoryIndex();
  injectAuthorByline();
  injectArticleBreadcrumb();
})();