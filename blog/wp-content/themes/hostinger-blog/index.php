<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hostinger_blog_theme
 */

get_header();


$categories = get_categories( array(
	'orderby'    => 'name',
	'order'      => 'ASC',
	'hide_empty' => true,
) );

$blog_page_id    = get_option( 'page_for_posts' );
$blogDescription = get_option( 'hostinger_blog_description', '' );
$blog_page       = get_post( $blog_page_id );
$content         = $blog_page->post_content;
$post_count      = $wp_query->post_count;

?>
	<section class="hts-section hts-posts">
		<div class="hts-posts-header">
			<div>
				<h1>
					<?php _e( 'All blog posts', 'hostinger-blog-theme' ); ?>
				</h1>
				<p class="hts-description">
					<?php if ( isset( $blogDescription ) && ! empty( $blogDescription ) ): ?>
						<?= $blogDescription ?>
					<?php else: ?>
						<?php _e( 'Explore the world of design and learn how to create visually stunning
					artwork.', 'hostinger-blog-theme' ); ?>
					<?php endif; ?>
				</p>
			</div>
		</div>
		<div class="hts-posts-categories">
			<div class="hts-capsules light">
				<?php
				if ( ! empty( $categories ) ) {
					echo '<ul class="post-categories-list">';
					foreach ( $categories as $category ) {
						$category_link = get_category_link( $category->term_id );
						echo '<div>';
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
	<div class="hts-section hts-no-border">
		<?php
		echo apply_filters( 'the_content', $content );
		?>
	</div>
<?php
get_footer();
