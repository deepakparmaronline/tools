// Toolbox Kart — shared dynamic nav / homepage grid / related-tools engine.
(function () {
  const COLORS = ['indigo', 'amber', 'emerald', 'rose', 'sky', 'violet', 'cyan', 'fuchsia'];

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
            ${niche.label} ▾
          </button>
          <div class="absolute hidden group-hover:block bg-white border border-gray-100 shadow-xl rounded-xl py-2 w-72 mt-0 transition-all z-50">
            ${niche.tools.map(t => `<a href="${t.path}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">${t.name}</a>`).join('')}
          </div>
        </div>
      `).join('') + '<a href="/blog/" class="nav-link py-6 font-medium text-gray-600 hover:text-indigo-600">Blog</a>';
    }

    // 2. Mobile Dropdown Nav (For Homepage)
    const mobEl = document.getElementById('mobile-menu');
    if (mobEl) {
      mobEl.innerHTML = niches.map(niche => `
        <div class="py-2">
          <div class="font-bold text-gray-900 mb-1">${niche.label}</div>
          <div class="pl-4 border-l-2 border-indigo-100 flex flex-col gap-2 mt-2">
            ${niche.tools.map(t => `<a href="${t.path}" class="text-sm text-gray-600 hover:text-indigo-600">${t.name}</a>`).join('')}
          </div>
        </div>
      `).join('');
    }
  }

  function renderHomepageCategories(niches) {
    const el = document.getElementById('dynamic-categories');
    if (!el) return;
    el.innerHTML = niches.map((niche, i) => {
      const c = COLORS[i % COLORS.length];
      return `
        <section id="${niche.key}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="bg-${c}-100 text-${c}-600 p-2 rounded-lg font-bold">#</div>
            <h2 class="text-xl font-bold text-gray-900">${niche.label} Tools</h2>
          </div>
          <div class="flex flex-col gap-3">
            ${niche.tools.map(t => `
              <a href="${t.path}" class="group block p-3 rounded-xl hover:bg-${c}-50 transition">
                <h3 class="font-semibold text-gray-800 group-hover:text-${c}-700 text-sm">➔ ${t.name}</h3>
              </a>`).join('')}
          </div>
        </section>`;
    }).join('');
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
          <h2 style="color: #fff; font-size: 1.4rem; font-weight: 700; margin-bottom: 1.25rem;">More ${niche.label} Tools</h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
            ${others.map(t => `
              <a href="${t.path}" style="display: flex; align-items: center; background: #111; border: 1px solid #222; border-radius: 10px; padding: 1rem; text-decoration: none; color: #ddd; font-weight: 600; font-size: 0.95rem; transition: border-color 0.2s;">
                <span style="color: #7c6fcd; margin-right: 10px;">➔</span> ${t.name}
              </a>`).join('')}
          </div>
        </div>`;
      return;
    }
  }

  loadManifest().then(data => {
    if(data.niches && data.niches.length > 0) {
      renderNav(data.niches);
      renderHomepageCategories(data.niches);
      renderRelatedTools(data.niches);
    }
  });
})();