<?php require __DIR__.'/../includes/bootstrap.php';$post=post_by_slug('open-graph-metadata-audit-workflow');ob_start(); ?>
<p>An Open Graph audit checks whether a page exposes the metadata that social and messaging platforms use to build link previews. The core properties are <code>og:title</code>, <code>og:type</code>, <code>og:image</code> and <code>og:url</code>; the protocol also supports <code>og:description</code> and image details such as dimensions and alt text. A page can have valid HTML and still produce a poor preview if the image URL is inaccessible, the values describe a different page or a platform is showing cached metadata.</p>
<figure><img src="/assets/images/blog/open-graph-metadata-audit-workflow.svg" alt="Illustration comparing Open Graph title, type, URL and image tags with a social link preview card" width="1600" height="900" loading="lazy"><figcaption>Audit both the source tags and the preview generated from them.</figcaption></figure>
<h2>1. Define the expected preview for each page type</h2>
<p>Before crawling a site, decide what a good preview should contain for articles, product pages, category pages and landing pages. The title should identify the page, the description should summarize the actual content, the image should be relevant, and the URL should represent the intended public address. Do not reuse one generic image or title across pages simply to fill the fields.</p>
<p>For an article, for example, keep the social title consistent with the headline without requiring it to be character-for-character identical. Use a concise description that gives readers a reason to open the page, and choose an image that remains understandable when cropped to a small card. The exact crop and rendering can vary by platform and placement.</p>
<h2>2. Check the core Open Graph properties</h2>
<p>The Open Graph protocol defines four required properties for every object:</p>
<ul>
<li><strong><code>og:title</code>:</strong> the title that should represent the page when shared.</li>
<li><strong><code>og:type</code>:</strong> the object type, such as <code>website</code> or <code>article</code>, selected to match the content.</li>
<li><strong><code>og:url</code>:</strong> the permanent URL that identifies the object in the graph.</li>
<li><strong><code>og:image</code>:</strong> the image URL that represents the object.</li>
</ul>
<p>Also check <code>og:description</code>, and where an image is specified, consider <code>og:image:alt</code>, <code>og:image:width</code>, <code>og:image:height</code> and <code>og:image:type</code>. The protocol documents these as structured image properties. Use absolute HTTPS URLs for production assets and ensure the declared values match what a visitor sees on the page.</p>
<h2>3. Compare the URL with canonical and page identity</h2>
<p>Compare <code>og:url</code> with the page's preferred canonical URL. Look for hostname differences, HTTP versus HTTPS, parameters that should not be shared, duplicate slash variants or old URLs left behind after a migration. Open Graph identity and search canonicalization are related but not identical concepts; they should not point to unrelated destinations.</p>
<p>For pages with several URL variants, choose the preferred public URL deliberately and keep internal links, canonical markup and Open Graph values consistent. Do not assume that a correct canonical tag automatically fixes a stale or incorrect <code>og:url</code>.</p>
<h2>4. Verify the image as a crawler would see it</h2>
<p>Fetch each image URL directly. Confirm it returns a successful response, serves an image content type, does not require a logged-in session and is not blocked by access rules. Check the actual image dimensions and file size, and verify that the important subject remains visible after common social-card crops. An image that works only in a browser session may fail when a platform crawler requests it.</p>
<p>Do not rely on a local file path such as <code>/assets/share.jpg</code> as the final metadata value unless the page's rendered output resolves it to a full public URL. The protocol uses an image URL; a complete absolute URL is the clearest way to make that destination unambiguous.</p>
<h2>5. Run a crawl and group the failures</h2>
<p>Export the page URL, title, meta description, canonical, <code>og:title</code>, <code>og:description</code>, <code>og:type</code>, <code>og:url</code>, <code>og:image</code> and image response status. Then group issues by type rather than reviewing every URL manually.</p>
<ul>
<li><strong>Missing fields:</strong> required properties absent from the page head.</li>
<li><strong>Identity mismatch:</strong> Open Graph URL and canonical refer to different page variants.</li>
<li><strong>Duplicate metadata:</strong> many unrelated pages use the same title, description or image.</li>
<li><strong>Broken image:</strong> the URL fails, redirects unexpectedly or returns non-image content.</li>
<li><strong>Content mismatch:</strong> preview text or artwork belongs to a different page.</li>
<li><strong>Stale preview:</strong> source markup is correct, but a platform still displays an older card.</li>
</ul>
<p>Prioritize broken images and wrong destinations first, then fix missing and duplicated metadata. After changes, recrawl the affected URLs and inspect the rendered head, not only the template or CMS fields.</p>
<h2>6. Separate source errors from cache behavior</h2>
<p>If the HTML contains the correct tags but a social preview is old, first verify the public response and image URL from outside your logged-in browser. Then use the relevant platform's official sharing debugger or preview refresh mechanism, if available, to request a new fetch. Do not keep changing correct metadata in an attempt to fix a cached result.</p>
<p>Keep a record of the URL tested, timestamp, returned status, current metadata and preview result. This makes it easier to distinguish a deployment issue from platform caching. Different platforms can fetch at different times and render the same metadata differently.</p>
<h2>7. Validate changes before publishing</h2>
<p>For a template-level fix, test a representative article, product page and landing page before rolling it across the site. Confirm that values are escaped correctly, no tags are duplicated, and page-specific metadata is not replaced by a global default. ToolBoxKart's <a href="/seo/meta-tag-generator">Meta Tag Generator</a> can help draft the tag markup, but you should still verify the final rendered HTML and live image URL.</p>
<h2>Sources</h2>
<ul>
<li><a href="https://ogp.me/">The Open Graph protocol: properties and structured image metadata</a></li>
<li><a href="https://toolboxkart.tech/seo/meta-tag-generator">ToolBoxKart Meta Tag Generator</a></li>
</ul>
<?php $articleHtml=ob_get_clean();require __DIR__.'/../includes/blog-template.php';
