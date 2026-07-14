<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hostinger_blog_theme
 */

get_header();
$postId               = get_the_ID();
$post                 = get_post( $postId );
$image                = get_the_post_thumbnail_url( $postId );
$link                 = get_permalink( $postId );
$categories           = get_the_category( $postId );
$date                 = get_the_date( 'F j, Y', $postId );
$author               = get_the_author_meta( 'display_name', $post->post_author );
$featuredImgId        = get_post_thumbnail_id( $postId );
$featuredImg          = hostinger_get_retina_srcset( $featuredImgId, 'single-post-featured', 'single-post-featured@2x' );
$templateDirectoryUri = get_template_directory_uri();
$blogPageUrl          = get_post_type_archive_link( 'post' );
?>
<section class="hts-section hts-no-border hts-blog-post">
    <div class="hts-header"></div>
    <div class="hts-content">
        <div class="hts-header">
            <div>
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
                <h1><?= get_the_title() ?></h1>
                <?php if ( ! empty( $date ) ): ?>
                <p class="small"><?= $date ?> | by <?= $author ?></p>
                <?php endif; ?>
            </div>
            <div class="hts-image-wrapper">
                <?php if ( hts_print_unsplash_image( $featuredImgId ) ) {
				echo hts_print_unsplash_image( $featuredImgId );
			} elseif ( $featuredImgId ) {
				echo hostinger_print_retina_img( $featuredImgId, 'single-post-featured', $featuredImg );
			} else {
				$heroPlaceholder = $templateDirectoryUri . '/build/images/postplaceholder.png';
				echo '<img src="' . $heroPlaceholder . '">';
			} ?>
                <?= hts_print_unsplash_author_credentials($featuredImgId) ?>
            </div>
        </div>

        <div class="hts-body">
            <?php the_content(); ?>
        </div>
    </div>

</section>
<?php

$categories   = get_the_category( $post->ID );
$category_ids = array();

foreach ( $categories as $category ) {
	$category_ids[] = $category->term_id;
}

$related_posts_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'category__in'   => $category_ids,
		'post__not_in'   => array( $post->ID ),
		'posts_per_page' => 3,
		'orderby'        => 'rand',
	)
);

?>
<?php if ( $related_posts_query->have_posts() ) : ?>
<section class="hts-section hts-posts">
    <div class="hts-posts-header">
        <h2 class="hts-title"><?= __( 'RELATED POSTS', 'hostinger-blog-theme' ) ?></h2>
        <a href="<?= $blogPageUrl ?>" class="hts-posts-action">
            <p><?= __( 'View all', 'hostigner-blog-theme' ) ?></p>
            <img src="<?= $templateDirectoryUri . '/build/images/icon-arrow-right.svg' ?>" alt="view all">
        </a>
    </div>
    <div class="hts-posts-list hts-related">
        <?php
			while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post();
                // update with default values
				hostinger_render_post(null,null);
			endwhile;
			wp_reset_postdata();
			?>
    </div>
</section>
<?php endif; ?>
<?php
get_footer();