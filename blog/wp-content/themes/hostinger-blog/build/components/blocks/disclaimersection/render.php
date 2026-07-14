<?php
$title                = $attributes['title'] ?? __('Disclaimer', 'hostinger-blog-theme');
$description          = $attributes['description'] ?? __('<p>The information contained in this website is for general information purposes only. The information is provided by [website name] and while we endeavor to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>', 'hostinger-blog-theme');
?>

<section class="hts-section hts-page hts-disclaimer">
	<div class="hts-header">
		<div>
			<?php if ( $title ) : ?>
				<h1><?= $title ?> </h1>
			<?php endif; ?>
		</div>
	</div>
	<div class="hts-details">
		<?php if ( $description ) : ?>
			<?php echo $description; ?>
		<?php endif; ?>
	</div>
</section>
