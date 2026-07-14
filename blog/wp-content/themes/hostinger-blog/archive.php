<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hostinger_blog_theme
 */

get_header();

$categories           = get_categories( array(
	'orderby'    => 'name',
	'order'      => 'ASC',
	'hide_empty' => true,
) );
$current_category     = get_queried_object();
$category_name        = $current_category->name ?? '';
$category_description = $current_category->description ?? '';
$post_count	          = $wp_query->post_count;

?>
	<section class="hts-section hts-posts">
		<div class="hts-posts-header">
			<div>
				<?php if ( $category_name ) : ?>
					<h1><?= $category_name ?></h1>
				<?php endif; ?>
				<?php if ( $category_description ) : ?>
					<p class="hts-description"><?= esc_html($category_description) ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="hts-posts-categories">
			<div class="hts-capsules light">
				<?php
				if ( ! empty( $categories ) ) {
					echo '<ul class="post-categories-list">';
					foreach ( $categories as $category ) {
						$category_link = get_category_link( $category->term_id );
						$active_class  = $current_category->term_id == $category->term_id ? 'active' : '';
						echo '<div class="' . esc_attr( $active_class ) . '">';
						echo '<a href="' . esc_url( $category_link ) . '">' . esc_html( $category->name ) . '</a>';
						echo '</div>';
					}
					echo '</ul>';
				} else {
					echo '<p>' . _e( 'No categories found.', 'hostinger-blog-theme' ) . '</p>';
				}
				?>
			</div>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="wrapper">
				<div class="loader-wrappe">
					<div class="loading-animation" style="display: none;">
						<div class="spinner"></div>
					</div>
				</div>
				<div class="hts-posts-list">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php hostinger_render_post($wp_query->current_post, $post_count); ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'hostinger-blog-theme' ); ?></p>
		<?php endif; ?>
		<?php custom_posts_navigation(); ?>
	</section>
	<section class="hts-section hts-newsletter">
		<hr class="full">
		<div class="wrapper">
			<div>
				<h3 class="hts-title"><?= __( 'Newsletter', 'hostinger-blog-theme' ) ?></h3>
				<p><?= __( 'Subscribe to stay up-to-date with my latest creative projects, insights, and tips.', 'hostinger-blog-theme' ) ?></p>
			</div>
			<div class="hts-newsletter-block">
				<form>
					<?php wp_nonce_field( 'submit_newsletter', 'newsletter_nonce' ); ?>
					<label for="hts-newsletter-email"><?= __( 'Email', 'hostinger-blog-theme' ) ?></label>
					<input type="email"
					       id="hts-newsletter-email"
					       name="newsletter_email"
					       placeholder="<?= __( 'What’s your email?', 'hostinger-blog-theme' ) ?>">
					<div class="validate-message"></div>
					<div class="hts-privacy-agree">
						<label class="hts-form-control">
							<input type="checkbox" id="privacy-policy-checkbox" name="privacy_policy" required>
						</label>
						<span>
					<?= __( 'I consent to use of my email address for the purpose of receiving newsletters as described in', 'hostinger-blog-theme' ) ?>
				</span>
					</div>
					<input type="submit" class="btn primary" value="<?= __( 'Subscribe', 'hostinger-blog-theme' ) ?>"/>
				</form>
			</div>
		</div>
	</section>
<?php

get_footer();


