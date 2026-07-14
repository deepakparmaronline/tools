<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hostinger_blog_theme
 */

$templateDirectoryUri = get_template_directory_uri();
$facebookUrl          = get_option( 'hostinger_facebook_url', '' );
$instagramUrl         = get_option( 'hostinger_instagram_url', '' );
$twitterUrl           = get_option( 'hostinger_twitter_url', '' );
$youtubeUrl           = get_option( 'hostinger_youtube_url', '' );
$footerDescription    = get_option( 'hostinger_footer_description', '' );
$footerCopyRight      = get_option( 'hostinger_footer_copyright', '© ' . get_bloginfo( 'name' ) );


$custom_logo_id  = get_theme_mod( 'custom_logo' );
$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );

$locations               = get_nav_menu_locations();
$quickLinksmenuId        = isset( $locations['quick-links'] ) ? $locations['quick-links'] : 0;
$termsAndPolicymenuId    = isset( $locations['terms-and-policy'] ) ? $locations['terms-and-policy'] : 0;
$quickLinksMenuItems     = wp_get_nav_menu_items( $quickLinksmenuId );
$termsAndPolicyMenuItems = wp_get_nav_menu_items( $termsAndPolicymenuId );
?>
</main><!-- #main -->
<footer class="hts-footer">
    <div>
        <div class="hts-footer-block">
            <div class="hts-logo">
                <?php
			if ( $custom_logo_id ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php echo esc_url( $custom_logo_url ); ?>"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
                <?php else : ?>
                <h2><?= get_bloginfo( 'name' ) ?></h2>
                <?php endif; ?>
                <?php if ( $footerDescription ) : ?>
                <p><?= $footerDescription ?></p>
                <?php endif; ?>
            </div>
            <?php if ( $quickLinksMenuItems ): ?>
	            <div class="hts-links">
		            <div><?= __( 'Quick links', 'hostinger-blog-theme' ) ?></div>
		            <?php
		            foreach ( $quickLinksMenuItems as $menu_item ) {
			            $target = isset( $menu_item->target ) ? esc_attr( $menu_item->target ) : '_self';
			            ?>
			            <a href="<?= esc_url( $menu_item->url ) ?>" target="<?= $target ?>">
				            <p class="small"><?= esc_html( $menu_item->title ) ?></p>
			            </a>
			            <?php
		            }
		            ?>
	            </div>
            <?php endif; ?>
            <?php if ( $termsAndPolicyMenuItems ): ?>
            <div class="hts-links">
                <div><?= __( 'Terms &amp; policy', 'hostinger-blog-theme' ) ?></div>
                <?php
				foreach ( $termsAndPolicyMenuItems as $menu_item ) {
					$target = isset( $menu_item->target ) ? esc_attr( $menu_item->target ) : '_self';
					?>
                <a href="<?= esc_url( $menu_item->url ) ?>" target="<?= $target ?>">
                    <p class="small"><?= esc_html( $menu_item->title ) ?></p>
                </a>
                <?php
				}
				?>
            </div>
            <?php endif; ?>
        </div>
        <hr class="small" />
        <div class="hts-footer-block-2">
            <div class="hts-social">
                <?php if ( ! empty( $facebookUrl ) ): ?>
                <a href="<?= $facebookUrl ?>" target="_blank">
                    <img src="<?php echo $templateDirectoryUri . '/build/images/facebook-dark.svg' ?>" alt="facebook">
                </a>
                <?php endif; ?>
                <?php if ( ! empty( $instagramUrl ) ): ?>
                <a href="<?= $instagramUrl ?>" target="_blank">
                    <img src="<?php echo $templateDirectoryUri . '/build/images/instagram-dark.svg' ?>" alt="instagram">
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $twitterUrl ) ): ?>
                <a href="<?= $twitterUrl ?>" target="_blank">
                    <img src="<?php echo $templateDirectoryUri . '/build/images/twitter-dark.svg' ?>" alt="twitter">
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $youtubeUrl ) ): ?>
                <a href="<?= $youtubeUrl ?>" target="_blank">
                    <img src="<?php echo $templateDirectoryUri . '/build/images/youtube-dark.svg' ?>" alt="youtube">
                </a>
                <?php endif; ?>
            </div>
            <?php if ( $footerCopyRight ) : ?>
            <p class="hts-copyright"><?= $footerCopyRight ?></p>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>