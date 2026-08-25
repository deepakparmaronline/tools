// Assets folder wali dynamic Related Tools script
(function() {
  // Saare SEO tools ka database yahan centralized rahega
  const allTools = [
    { name: "AI Meta Tags Generator", url: "/seo/ai-meta-tags-generator", category: "seo" },
    { name: "Robots.txt Validator", url: "/seo/robots-txt-validator", category: "seo" },
    { name: "Robots Txt Generator", url: "/seo/robots-txt-generator", category: "seo" },
    { name: "AI FAQ & Schema Generator", url: "/seo/ai-faq-generator", category: "seo" },
    { name: "XML Sitemap Builder", url: "/seo/xml-sitemap-builder", category: "seo" },
    { name: "HTTP Status Code Checker", url: "/seo/http-status-code-checker", category: "seo" }
  ];

  function loadRelatedTools() {
    // Check karo ki page par target container hai ya nahi
    const container = document.getElementById('dynamic-related-tools');
    if (!container) return;

    // Current page ka URL uthao taaki wahi tool list se exclude kiya ja sake
    const currentPath = window.location.pathname;

    // Same category ke tools filter karo aur current page ko hata do
    const filteredTools = allTools.filter(tool => tool.url !== currentPath);

    // HTML grid generate karo
    let html = '<h3 class="section-title">Related Technical SEO Tools</h3>';
    html += '<div class="tools-grid">';
    
    filteredTools.forEach(tool => {
      html += `<a href="${tool.url}" class="tool-card-link">${tool.name}</a>`;
    });
    
    html += '</div>';

    // Container ke andar inject kar do
    container.innerHTML = html;
  }

  // DOM load hone par run hoga
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadRelatedTools);
  } else {
    loadRelatedTools();
  }
})();