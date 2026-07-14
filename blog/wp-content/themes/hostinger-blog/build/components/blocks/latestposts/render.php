<?php
$numberOfPosts        = isset( $attributes['numberOfPosts'] ) ? $attributes['numberOfPosts'] : 6;
$templateDirectoryUri = get_template_directory_uri();
$title                = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Latest Posts', 'hostinger-blog-theme' );
$posts                = get_posts(
	array(
		'numberposts' => $numberOfPosts,
		'orderby'     => 'date',
		'order'       => 'DESC',
	)
);
$blogPageUrl          = get_post_type_archive_link( 'post' );
$post_count           = count($posts)
?>
<section class="hts-section hts-posts">
    <hr class="full">
    <div>
        <div class="hts-posts-header">
            <h2 class="hts-title"><?= $title ?></h2>
            <a href="<?= $blogPageUrl ?>" class="hts-posts-action">
                <p><?= __( 'View all', 'hostigner-blog-theme' ) ?></p>
                <img src="<?= $templateDirectoryUri . '/build/images/icon-arrow-right.svg' ?>" alt="view all">
            </a>
        </div>
        <div class="hts-posts-list">
            <?php foreach ( $posts as $key=>$post ) : ?>
            <div class="hts-post <?= get_gallery_post_class($key, $post_count) ?>">
                <?php
				$image             = get_the_post_thumbnail_url( $post->ID );
				$link              = get_permalink( $post->ID );
				$categories        = get_the_category( $post->ID );
				$date              = get_the_date( 'F j, Y', $post->ID );
				$author            = get_the_author_meta( 'display_name', $post->post_author );
				$featured_image_id = get_post_thumbnail_id( $post->ID );
				?>
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
                        <img src="<?= get_template_directory_uri() . '/build/images/placeholder'.rand(2,3) .'.jpg'; ?>"
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
                    <a href="<?= $link ?>">
                        <h3 class="hts-title"><?= get_the_title( $post->ID ) ?></h3>
                    </a>
                    <?php if ( ! empty( $date ) ): ?>
                    <p class="small"><?= $date ?> | by <?= $author ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>