<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Hostinger_blog_theme
 */

/**
 *
 *  Add theme pallet and fonts.
 */

add_action( 'wp_head', function () { ?>
	<style>
		<?php require_once 'theme-styles/palettes.php'?>
		<?php require_once 'theme-styles/fonts.php'?>
	</style>
<?php } );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function hostinger_blog_theme_body_classes( $classes ) {
	$layout = get_option( 'hostinger_theme_layout', 'layout1' );

	switch ( $layout ) :
		case 'layout2':
			$classes[] = 'hts-body hts-posts-sharp hts-hero-type-2 hts-about-type-2 hts-blog-type-2';
			break;
		case 'layout3':
			$classes[] = 'hts-body hts-posts-sharp hts-featured-type-3 hts-hero-type-3 hts-gallery hts-about-type-3 hts-blog-type-3';
			break;
		default:
			$classes[] = 'hts-body';
	endswitch;

	return $classes;
}

add_filter( 'body_class', 'hostinger_blog_theme_body_classes' );

/**
 *
 * Disable gutenberg autosave
 */
add_action( 'admin_init', 'disable_autosave' );
function disable_autosave() {
	wp_deregister_script( 'autosave' );
}

/**
 *
 * Allow SVG upload
 **/

function allow_svg_upload( $allowed_mime_types ) {
	$allowed_mime_types['svg']  = 'image/svg+xml';
	$allowed_mime_types['svgz'] = 'image/svg+xml';

	return $allowed_mime_types;
}

add_filter( 'upload_mimes', 'allow_svg_upload', 10, 1 );

add_filter( 'wp_check_filetype_and_ext', function ( $filetype_ext_data, $file, $filename, $mimes ) {
	if ( substr( $filename, - 4 ) === '.svg' ) {
		$filetype_ext_data['ext']  = 'svg';
		$filetype_ext_data['type'] = 'image/svg+xml';
	}

	return $filetype_ext_data;
}, 100, 4 );

/**
 *
 * Generate post html
 **/
function get_gallery_post_class($key, $numberOfPosts) {
	if(!$numberOfPosts){
		return '';
	}
	$postSplitThreshold = ceil($numberOfPosts / 2);

	if($key < $postSplitThreshold){
		if($key == 0 || $key % 3 == 0){
			return 'hts-large';
		}
		return '';
	}
	else {
		if(($key - $postSplitThreshold + 1) % 3 == 0){
			return 'hts-large';
		}
		return '';
	}
}

function hostinger_render_post($key, $post_count) {
	$post              = get_post( get_the_ID() );
	$image             = get_the_post_thumbnail_url( get_the_ID() );
	$link              = get_permalink( get_the_ID() );
	$categories        = get_the_category( get_the_ID() );
	$date              = get_the_date( 'F j, Y', get_the_ID() );
	$author            = get_the_author_meta( 'display_name', $post->post_author );
	$featured_image_id = get_post_thumbnail_id( get_the_ID() );
	$gallery_class 	   = get_gallery_post_class($key, $post_count);
?>

	<div class="hts-post <?= $gallery_class ?>">
		<div class="hts-image-wrapper">
			<?php if ( hts_print_unsplash_image( $featured_image_id ) ): ?>
				<a href="<?= $link ?>" class="hts-featured-post-link">
					<?= hts_print_unsplash_image( $featured_image_id ); ?>
				</a>
			<?php elseif ( ! empty( $image ) ): ?>
				<a href="<?= $link ?>" class="hts-featured-post-link">
					<img src="<?= $image ?>" alt="featured">
				</a>
			<?php else : ?>
				<a href="<?= $link ?>" class="hts-featured-post-link">
					<img src="<?= get_template_directory_uri() . '/build/images/placeholder.jpg'; ?>"
					     alt="featured">
				</a>
			<?php endif; ?>
			<?php echo hts_print_unsplash_author_credentials( $featured_image_id ); ?>
		</div>
		<div class="hts-post-details">
			<div class="hts-capsules">
				<?php if ( ! empty( $categories ) ): ?>
					<?php foreach ( $categories as $cat ): ?>
						<?php $category_url = get_term_link( $cat->term_id, 'category' ); ?>
						<?php if ( ! is_wp_error( $category_url ) ): ?>
							<a href="<?= $category_url ?>">
								<div><?= $cat->name ?></div>
							</a>
						<?php else: ?>
							<div><?= $cat->name ?></div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<h3 class="hts-title"><a href="<?= get_permalink() ?>"><?php the_title(); ?></a></h3>
			<?php if ( ! empty( $date ) ): ?>
				<p class="small"><?= $date ?> | by <?= $author ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

function hostinger_load_posts_by_ajax_callback() {
	check_ajax_referer( 'load_posts_nonce', 'security' );
	$paged = isset( $_POST['page'] ) ? sanitize_text_field( $_POST['page'] ) : 1;

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged'          => $paged,
	];

	$posts_query = new WP_Query( $args );

	if ( $posts_query->have_posts() ) :
		while ( $posts_query->have_posts() ) : $posts_query->the_post();
		 	// update with default values
			hostinger_render_post(null, null);
		endwhile;
	endif;

	wp_reset_postdata();

	wp_die();
}

add_action( 'wp_ajax_load_posts_by_ajax', 'hostinger_load_posts_by_ajax_callback' );
add_action( 'wp_ajax_nopriv_load_posts_by_ajax', 'hostinger_load_posts_by_ajax_callback' );

function custom_posts_navigation() {
	$templateDirectoryUri = get_template_directory_uri();
	$prev_link            = get_previous_posts_link( '&laquo; Newer Posts' );
	$next_link            = get_next_posts_link( 'Older Posts &raquo;' );

	if ( $prev_link || $next_link ) : ?>
		<div class="hts-posts-footer">
			<?php if ( $prev_link ) : ?>
				<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" class="hts-posts-action newer">
					<img src="<?php echo esc_url( $templateDirectoryUri . '/build/images/icon-arrow-left.svg' ); ?>"
					     alt="Newer posts">
					<p><?= esc_html( 'Newer posts', 'hostinger-blog-theme' ) ?></p>
				</a>
			<?php endif; ?>
			<?php if ( $next_link ) : ?>
				<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" class="hts-posts-action older">
					<p><?= esc_html( 'Older posts', 'hostinger-blog-theme' ) ?></p>
					<img src="<?php echo esc_url( $templateDirectoryUri . '/build/images/icon-arrow-right.svg' ); ?>"
					     alt="Older posts">
				</a>
			<?php endif; ?>
		</div>
	<?php endif;
}

function hts_get_random_post_id() {
	global $wpdb;
	$post_type = 'post';
	$table     = $wpdb->posts;

	$query = "SELECT `ID` FROM " . $table . " WHERE `post_type` = '" . $post_type . "' AND `post_status` = 'publish' ORDER BY RAND() LIMIT 1";

	$post = $wpdb->get_row( $query );

	if ( ! empty( $post ) ) {
		return $post->ID;
	}
}

function hts_print_unsplash_image( $image_id ) {
	$unsplash_url = get_post_meta( $image_id, 'unsplash_url', true ) ?? '';
	$image_alt    = get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?? '';
	$image_title  = get_the_title( $image_id ) ?? '';

	if ( empty( $unsplash_url ) ) {
		return '';
	}

	$image_tag = '<img src="' . $unsplash_url . '"';

	if ( ! empty( $image_title ) ) {
		$image_tag .= ' title="' . $image_title . '"';
	}

	if ( ! empty( $image_alt ) ) {
		$image_tag .= ' alt="' . $image_alt . '"';
	}

	$image_tag .= '>';

	return $image_tag;
}

function hts_print_unsplash_author_credentials( $image_id ) {
	$author_profile = get_post_meta( $image_id, 'unsplash_author_profile', true ) ?? '';
	$author_name    = get_post_meta( $image_id, 'unsplash_author_name', true ) ?? '';
	$referral_link  = get_post_meta( $image_id, 'unsplash_referral_link', true ) ?? '';

	if ( ! empty( $author_name ) && ! empty( $author_profile ) ) {
		$author_link   = '<a href="' . $author_profile . '" rel="nofollow">' . $author_name . '</a>';
		$unsplash_link = '<a href="' . $referral_link . '" rel="nofollow">Unsplash</a>';

		return '<span class="hts-unsplash-data">Photo by ' . $author_link . ' on ' . $unsplash_link . '</span>';
	}

	return '';
}

/**
 *
 * Add theme settings admin notice
 **/

function hts_add_admin_notice() {
	$dismissed = get_user_meta( get_current_user_id(), 'hostinger_theme_settings_notice_dismissed', true );
	if ( $dismissed ) {
		return;
	}
	?>

	<div class="notice notice-error is-dismissible hts-theme-settings">
		<p>
			<strong><?= __( 'Attention:', 'hostinger-blog-theme' ) ?></strong> <?= __( 'Please adjust your <a href="?page=hostinger-additional-settings">theme settings</a> to personalize your website.', 'hostinger-blog-theme' ) ?>
		</p>
		<p><?= __( 'Your website currently lacks essential information such as social links and contact details.', 'hostinger-blog-theme' ) ?></p>
		<p><?= __( 'To enhance your site\'s functionality and user experience, ensure that you fill in the theme settings with accurate information.', 'hostinger-blog-theme' ) ?></p>
		<p><?= __( 'Key areas that require attention include:', 'hostinger-blog-theme' ) ?></p>
		<ul>
			<li><b><?= __( 'Color scheme', 'hostinger-blog-theme' ) ?></b></li>
			<li><b><?= __( 'Social media links', 'hostinger-blog-theme' ) ?></b></li>
			<li><b><?= __( 'Contact information', 'hostinger-blog-theme' ) ?></b></li>
		</ul>
	</div>

<?php }

add_action( 'admin_notices', 'hts_add_admin_notice' );

function hts_dismiss_admin_notice() {
	if ( isset( $_GET['notice_dismissed'] ) && $_GET['notice_dismissed'] === 'true' ) {
		update_user_meta( get_current_user_id(), 'hostinger_theme_settings_notice_dismissed', true );
	}
	wp_die();
}

add_action( 'wp_ajax_hts_dismiss_admin_notice', 'hts_dismiss_admin_notice' );
