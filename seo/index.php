<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/news-fetch.php';

$news = get_cached_news(
    [
        'Search Engine Journal' => 'https://www.searchenginejournal.com/feed/',
        'Search Engine Land'    => 'https://searchengineland.com/feed',
    ],
    $_SERVER['DOCUMENT_ROOT'] . '/assets/cache/seo-news.json',
    6,
    6
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free SEO Tools | Tool Box Kart</title>
  <meta name="description" content="All SEO tools in one place. Schema generator, robots.txt generator, keyword tools, sitemap builder and more. Free, fast, and private. Plus the latest SEO news updated daily.">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background-color: #f8fafc;
      color: #334155;
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      min-height: 100vh;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }
    nav {
      background: #ffffff;
      border-bottom: 1px solid #e2e8f0;
      padding: 0 2rem;
      display: flex;
      align-items: center;
      height: 64px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .nav-brand { font-weight: 800; font-size: 1.25rem; color: #0f172a; text-decoration: none; letter-spacing: 0.5px; display: flex; align-items: center; }
    .nav-brand span { color: #ffffff; background: #6366f1; padding: 0.2rem 0.6rem; border-radius: 6px; margin-right: 8px; font-size: 1.1rem; }

    .hero { text-align: center; padding: 5rem 1rem 4rem; background: #ffffff; border-bottom: 1px solid #e2e8f0; }
    .hero h1 { font-size: 2.6rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem; line-height: 1.15; letter-spacing: -1px; }
    .hero h1 span { color: #6366f1; }
    .hero p { color: #475569; font-size: 1.1rem; max-width: 700px; margin: 0 auto; }

    .container { max-width: 1100px; margin: 0 auto; padding: 4rem 1rem; }
    .section-title { text-align: center; margin-bottom: 2.5rem; }
    .section-title h2 { font-size: 1.9rem; color: #0f172a; margin-bottom: 0.5rem; font-weight: 700; }
    .section-title p { color: #64748b; font-size: 1rem; }

    #tools-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1rem;
      margin-bottom: 5rem;
    }
    .tool-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      padding: 1rem 1.2rem;
      border-radius: 10px;
      text-decoration: none;
      color: #475569;
      font-weight: 600;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .tool-card:hover { border-color: #6366f1; color: #0f172a; background: #f8fafc; transform: translateX(4px); }
    .tool-card span { color: #6366f1; font-size: 1.1rem; }
    #tools-grid.loading::before { content: "Loading tools..."; color: #94a3b8; grid-column: 1 / -1; text-align: center; padding: 2rem 0; }

    .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; }
    .news-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 1.25rem 1.4rem;
      text-decoration: none;
      color: #334155;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      transition: all 0.2s ease;
    }
    .news-card:hover { border-color: #6366f1; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transform: translateY(-2px); }
    .news-date { font-size: 0.8rem; color: #94a3b8; font-weight: 600; }
    .news-title { font-size: 1.05rem; font-weight: 700; color: #0f172a; line-height: 1.35; }
    .news-desc { font-size: 0.9rem; color: #64748b; }
    .news-source { text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 2rem; }

    footer { text-align: center; padding: 2.5rem 2rem; border-top: 1px solid #e2e8f0; color: #64748b; margin-top: 2rem; background: #ffffff; font-size: 0.95rem; }

    @media (max-width: 600px) {
      .hero h1 { font-size: 2rem; }
      .container { padding: 3rem 1rem; }
    }
  </style>
</head>
<body>
  <nav>
    <a class="nav-brand" href="/"><span>TBK</span> Tool Box Kart</a>
  </nav>

  <header class="hero">
    <h1>Free <span>SEO Tools</span></h1>
    <p>Schema generator, robots.txt generator, keyword tools, sitemap builder and every other SEO tool you need. No signup, no ads, everything runs in your browser.</p>
  </header>

  <main class="container">
    <div class="section-title">
      <h2>All SEO Tools</h2>
      <p>Updates automatically the moment a new tool is published.</p>
    </div>
    <div id="tools-grid" class="loading"></div>

    <div class="section-title">
      <h2>Latest SEO News</h2>
      <p>From top SEO publications, updated automatically</p>
    </div>
    <div class="news-grid">
      <?php if (empty($news)): ?>
        <p style="text-align:center;color:#94a3b8;grid-column:1/-1;">News is updating, please check back shortly.</p>
      <?php else: ?>
        <?php foreach ($news as $item): ?>
          <a class="news-card" href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank" rel="noopener noreferrer">
            <span class="news-date"><?php echo htmlspecialchars($item['date']); ?><?php if (!empty($item['source'])): ?> · <?php echo htmlspecialchars($item['source']); ?><?php endif; ?></span>
            <span class="news-title"><?php echo htmlspecialchars($item['title']); ?></span>
            <?php if (!empty($item['desc'])): ?>
              <span class="news-desc"><?php echo htmlspecialchars($item['desc']); ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    <p>&copy; 2026 Tool Box Kart. Built for privacy, efficiency, and speed.</p>
  </footer>

  <script>
    fetch('/assets/manifest.php', { cache: 'no-store' })
      .then(res => res.json())
      .then(data => {
        const grid = document.getElementById('tools-grid');
        grid.classList.remove('loading');
        const niche = (data.niches || []).find(n => n.key === 'seo');
        if (!niche || !niche.tools.length) {
          grid.innerHTML = '<p style="color:#94a3b8;grid-column:1/-1;text-align:center;">No SEO tools found yet.</p>';
          return;
        }
        grid.innerHTML = niche.tools.map(t =>
          `<a href="${t.path}" class="tool-card"><span>➔</span> ${t.name}</a>`
        ).join('');
      })
      .catch(() => {
        const grid = document.getElementById('tools-grid');
        grid.classList.remove('loading');
        grid.innerHTML = '<p style="color:#94a3b8;grid-column:1/-1;text-align:center;">Could not load tools right now.</p>';
      });
  </script>
  <script src="/assets/site.js" defer></script>
</body>
</html>