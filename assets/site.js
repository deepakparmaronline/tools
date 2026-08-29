// Tool Box Kart — site-wide header and footer navigation only.
(function () {
  'use strict';

  function injectStyles() {
    if (document.getElementById('tbk-site-nav-styles')) return;
    const style = document.createElement('style');
    style.id = 'tbk-site-nav-styles';
    style.textContent = `
      .tbk-site-header{position:sticky;top:0;z-index:1000;background:#14171c;border-bottom:3px solid #ffc23a}
      .tbk-site-header-inner{max-width:1240px;margin:auto;min-height:68px;padding:12px 20px;display:flex;align-items:center;justify-content:space-between;gap:20px}
      .tbk-site-brand{color:#fff!important;font:800 1.02rem system-ui,sans-serif;text-decoration:none;white-space:nowrap}
      .tbk-site-brand span{display:inline-block;background:#ffc23a;color:#14171c;padding:4px 7px;border-radius:4px;margin-right:7px}
      .tbk-site-nav{display:flex;gap:16px;flex-wrap:wrap;justify-content:flex-end}
      .tbk-site-nav a{color:#fff!important;font:700 .86rem system-ui,sans-serif;text-decoration:none}
      .tbk-site-nav a:hover{color:#ffc23a!important}
      .tbk-site-footer{background:#14171c;border-top:3px solid #ffc23a;margin-top:40px}
      .tbk-site-footer-inner{max-width:1240px;margin:auto;padding:42px 20px 28px}
      .tbk-site-footer-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:28px}
      .tbk-site-footer-group h2{color:#fff;font-size:.95rem;margin:0 0 12px}
      .tbk-site-footer-group a{display:block;color:#cfcfcf!important;font-size:.86rem;padding:5px 0;text-decoration:none}
      .tbk-site-footer-group a:hover{color:#ffc23a!important}
      .tbk-site-footer-bottom{border-top:1px solid #292d33;margin-top:28px;padding-top:18px;text-align:center;color:#7e8490;font-size:.8rem}
      @media(max-width:760px){
        .tbk-site-header{position:static}
        .tbk-site-header-inner{align-items:flex-start;flex-direction:column;padding:12px 14px}
        .tbk-site-nav{justify-content:flex-start;gap:9px 14px}
        .tbk-site-nav a{font-size:.76rem}
        .tbk-site-footer-grid{grid-template-columns:1fr 1fr}
      }
      @media(max-width:480px){
        .tbk-site-footer-grid{grid-template-columns:1fr}
      }
    `;
    document.head.appendChild(style);
  }

  function renderHeader() {
    if (document.querySelector('.tbk-site-header')) return;

    const header = document.createElement('header');
    header.className = 'tbk-site-header';
    header.innerHTML = `
      <div class="tbk-site-header-inner">
        <a class="tbk-site-brand" href="/"><span>TBK</span>Tool Box Kart</a>
        <nav class="tbk-site-nav" aria-label="Primary navigation">
          <a href="/seo/">SEO Tools</a>
          <a href="/finance/">Finance Tools</a>
          <a href="/image-tools/">Image Tools</a>
          <a href="/seo-guide/">SEO Guides</a>
          <a href="/tools-guide/">Tool Guides</a>
          <a href="/explainers/">Explainers</a>
          <a href="/tech/">Tech</a>
        </nav>
      </div>`;

    document.body.prepend(header);
  }

  function renderFooter() {
    if (document.querySelector('.tbk-site-footer')) return;

    const footer = document.createElement('footer');
    footer.className = 'tbk-site-footer';
    footer.innerHTML = `
      <div class="tbk-site-footer-inner">
        <div class="tbk-site-footer-grid">
          <div class="tbk-site-footer-group">
            <h2>Tools</h2>
            <a href="/seo/">SEO Tools</a>
            <a href="/finance/">Finance Tools</a>
            <a href="/image-tools/">Image Tools</a>
          </div>
          <div class="tbk-site-footer-group">
            <h2>Guides</h2>
            <a href="/seo-guide/">SEO Guides</a>
            <a href="/tools-guide/">Tool Guides</a>
            <a href="/explainers/">Explainers</a>
            <a href="/tech/">Tech</a>
          </div>
          <div class="tbk-site-footer-group">
            <h2>Site</h2>
            <a href="/about-deepak-parmar/">About</a>
            <a href="/transparency/">Transparency</a>
            <a href="/security/">Security</a>
          </div>
          <div class="tbk-site-footer-group">
            <h2>Legal</h2>
            <a href="/privacy-policy/">Privacy Policy</a>
            <a href="/terms-of-service/">Terms of Service</a>
          </div>
        </div>
        <div class="tbk-site-footer-bottom">© ${new Date().getFullYear()} Tool Box Kart. Built for privacy, efficiency, and speed.</div>
      </div>`;

    document.body.appendChild(footer);
  }

  function boot() {
    injectStyles();
    renderHeader();
    renderFooter();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
  } else {
    boot();
  }
})();