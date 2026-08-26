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
      @media (max-width: 600px) { .tbk-shared-nav { padding: 0.75rem 1rem; gap: 0.75rem; } .tbk-shared-nav .nav-links { gap: 0.65rem; flex-wrap: wrap; justify-content: flex-end; } .tbk-shared-nav .nav-links a { font-size: 0.72rem; } }
    `;
    document.head.appendChild(style);

    const navHTML = '<a class="nav-brand" href="/"><span>TBK</span> Tool Box Kart</a><div class="nav-links"><a href="/seo/">SEO Tools</a><a href="/finance/">Finance Tools</a><a href="/image-tools/">Image Tools</a><a href="/seo-guide/">SEO Guides</a><a href="/tech/">Tech Guides</a></div>';
    let nav = document.querySelector('nav');
    if (!nav) {
      nav = document.createElement('nav');
      document.body.prepend(nav);
    }
    nav.className = 'tbk-shared-nav';
    nav.innerHTML = navHTML;
  }

  async function renderGuideIndex() {
    if (window.location.pathname !== '/seo-guide/' && window.location.pathname !== '/seo-guide/index.html') return;
    const grid = document.querySelector('.grid');
    if (!grid) return;
    try {
      const response = await fetch('/assets/seo-guide-manifest.php', { cache: 'no-store' });
      if (!response.ok) throw new Error('Guide manifest request failed: ' + response.status);
      const guides = await response.json();
      grid.innerHTML = guides.map(guide => `<article class="card"><p class="meta">SEO Guide · Updated ${escapeHTML(guide.modified)}</p><a href="${escapeHTML(guide.url)}">${escapeHTML(guide.title)}</a><p>${escapeHTML(guide.description)}</p></article>`).join('');
    } catch (err) {
      console.error('Guide manifest load failed.', err);
    }
  }

  async function renderTechIndex() {
    if (window.location.pathname !== '/tech/' && window.location.pathname !== '/tech/index.html') return;
    const grid = document.querySelector('.grid');
    if (!grid) return;
    try {
      const response = await fetch('/assets/tech-manifest.php', { cache: 'no-store' });
      if (!response.ok) throw new Error('Tech manifest request failed: ' + response.status);
      const posts = await response.json();
      grid.innerHTML = posts.length
        ? posts.map(post => `<article class="card"><p class="meta">Tech Guide · Updated ${escapeHTML(post.modified)}</p><a href="${escapeHTML(post.url)}">${escapeHTML(post.title)}</a><p>${escapeHTML(post.description)}</p></article>`).join('')
        : '<p class="empty">Tech guides will appear here as they are published.</p>';
    } catch (err) {
      console.error('Tech manifest load failed.', err);
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

  function renderFooter(niches) {
    injectFooterStyles();

    const toolLinksHTML = (niches || [])
      .map(n => `<a href="${escapeHTML(n.path)}">${escapeHTML(niceLabel(n.label))}</a>`)
      .join('');

    const legalLinksHTML = FOOTER_LEGAL_LINKS
      .map(l => `<a href="${l.href}">${l.label}</a>`)
      .concat('<a href="/seo-guide/">SEO Guides</a>')
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
  renderGuideIndex();
  renderTechIndex();
})();