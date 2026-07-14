<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hostinger_blog_theme
 */

get_header();
?>

	<section class="hts-section hts-posts">
		<?php if ( have_posts() ) : ?>
			<div class="hts-posts-header">
				<header class="page-header">
					<h1 class="page-title">
						<?php
						printf( esc_html__( 'Search Results for: %s', 'hostinger-blog-theme' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header>
			</div>
			<div class="wrapper">
				<div class="loader-wrappe">
					<div class="loading-animation" style="display: none;">
						<div class="spinner"></div>
					</div>
				</div>
				<div class="hts-posts-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php hostinger_render_post( null, null ); ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php else : ?>
			<h1><?php _e( 'Sorry, no posts matched your criteria.', 'hostinger-blog-theme' ); ?></h1>
		<?php endif; ?>

		<?php custom_posts_navigation(); ?>

	</section>

<?php

get_footer();
