<?php
$templateDirectoryUri = get_template_directory_uri();
$title                = $attributes['title'] ?? '';
$postId               = $attributes['postId'] ?? hts_get_random_post_id();
$featured_image_id    = '';

if ( $postId ) {
	$post = get_post( $postId );

	if ( $post ) {
		$post_title        = $post->post_title;
		$date              = get_the_date( 'F j, Y', $post->ID );
		$author            = get_the_author_meta( 'display_name', $post->post_author );
		$categories        = get_the_category( $postId );
		$image             = get_the_post_thumbnail_url( $postId );
		$link              = get_permalink( $postId );
		$featured_image_id = get_post_thumbnail_id( $postId );
	}
}
?>
<section class="hts-section hts-no-border hts-posts hts-featured-post-wrapper">
    <div>
        <?php if ( ! empty( $title ) ): ?>
        <div class="hts-posts-header">
            <h2 class="hts-title"><?= $title ?></h2>
        </div>
        <?php endif; ?>
        <div class="hts-featured-post">
            <!-- Post -->
            <div class="hts-post">
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
                    <div class="hts-posts-body-header">
                        <h2 class="hts-title"><?= $title ?></h2>
                    </div>
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
                    <?php if ( ! empty( $post_title ) ): ?>
                    <a href="<?= $link ?>">
                        <h3 class="hts-title"><?= $post_title ?></h3>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $date ) ): ?>
                    <p class="small"><?= $date ?> | by <?= $author ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>