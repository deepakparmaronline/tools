<?php
require __DIR__.'/includes/bootstrap.php';
require_once __DIR__.'/includes/sitemap-output.php';
sitemap_emit_urlset(sitemap_software_entries('how-to-use', 'how_to_use'));
