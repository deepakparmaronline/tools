<?php
$mediaId              = $attributes['mediaId'] ?? '';
$title                = $attributes['title'] ?? __( 'I’m Shawn — a designer and creator 👋', 'hostinger-blog-theme' );
$description          = $attributes['description'] ?? __( 'From visual design to media production, my passion for creating has led me on a journey of exploration and innovation.', 'hostinger-blog-theme' );
$url                  = $attributes['url'] ?? '';
$buttonTitle          = $attributes['buttonTitle'] ?? __( 'Learn About Me', 'hostinger-blog-theme' );
$urlNewTab            = $attributes['urlNewTab'] ?? '';
$bottomTitle          = $attributes['bottomTitle'] ?? __( 'Let’s stay connected', 'hostinger-blog-theme' );
$target               = $urlNewTab ? 'target="_blank"' : '';
$templateDirectoryUri = get_template_directory_uri();
$facebookUrl          = get_option( 'hostinger_facebook_url', '' );
$instagramUrl         = get_option( 'hostinger_instagram_url', '' );
$twitterUrl           = get_option( 'hostinger_twitter_url', '' );
$youtubeUrl           = get_option( 'hostinger_youtube_url', '' );
$unsplashUrl          = get_post_meta( $mediaId, 'unsplash_url', true ) ?? '';

if ( $mediaId && $unsplashUrl ) {
	$bgImg = $unsplashUrl;
} elseif ( $mediaId ) {
	$bgImg = wp_get_attachment_image_src( $attributes['mediaId'], 'full' )[0];
} else {
	$bgImg = $templateDirectoryUri . '/build/images/heroimage.jpeg';
}

if ( filter_var( $url, FILTER_VALIDATE_URL ) !== false ) {
	$buttonLink = $url;
} else {
	$buttonLink = get_permalink( get_page_by_path( 'about' ) );
}
?>
<section class="hts-section hts-hero">
    <div class="hts-hero-spacer"></div>
    <div class="hts-hero-content">
        <div class="hts-hero-image">
            <img src="<?= $bgImg ?>" alt="background" />
        </div>
        <div class="hts-hero-block">
            <div class="hts-hero-body">
                <div class="hts-hero-details">
                    <div>
                        <h1><?= $title ?></h1>
                        <p><?= $description ?></p>
                        <a href="<?= $buttonLink ?>" class="btn primary" <?= $target ?>><?= $buttonTitle ?></a>
                    </div>
                    <div class="hts-hero-body-image">
                        <img src="<?= $bgImg ?>" alt="background" />
                    </div>
                    <div class="hts-hero-footer">
                        <div class="hts-social">
                            <?php if ( ! empty( $facebookUrl ) ): ?>
                            <a href="<?= $facebookUrl ?>" target="_blank">
                                <img class="light" src="<?= $templateDirectoryUri . '/build/images/facebook.svg' ?>"
                                    alt="facebook" />
                                <img class="dark" src="<?= $templateDirectoryUri . '/build/images/facebook-dark.svg' ?>"
                                    alt="facebook" />
                                <img class="mono" src="<?= $templateDirectoryUri . '/build/images/facebook-mono.svg' ?>"
                                    alt="facebook" />
                            </a>
                            <?php endif; ?>
                            <?php if ( ! empty( $instagramUrl ) ): ?>
                            <a href="<?= $instagramUrl ?>" target="_blank">
                                <img class="light" src="<?= $templateDirectoryUri . '/build/images/instagram.svg' ?>"
                                    alt="instagram" />
                                <img class="dark"
                                    src="<?= $templateDirectoryUri . '/build/images/instagram-dark.svg' ?>"
                                    alt="instagram" />
                                <img class="mono"
                                    src="<?= $templateDirectoryUri . '/build/images/instagram-mono.svg' ?>"
                                    alt="instagram" />
                            </a>
                            <?php endif; ?>
                            <?php if ( ! empty( $twitterUrl ) ): ?>
                            <a href="<?= $twitterUrl ?>" target="_blank">
                                <img class="light" src="<?= $templateDirectoryUri . '/build/images/twitter.svg' ?>"
                                    alt="twitter" />
                                <img class="dark" src="<?= $templateDirectoryUri . '/build/images/twitter-dark.svg' ?>"
                                    alt="twitter" />
                                <img class="mono" src="<?= $templateDirectoryUri . '/build/images/twitter-mono.svg' ?>"
                                    alt="twitter" />
                            </a>
                            <?php endif; ?>
                            <?php if ( ! empty( $youtubeUrl ) ): ?>
                            <a href="<?= $youtubeUrl ?>" target="_blank">
                                <img class="light" src="<?= $templateDirectoryUri . '/build/images/youtube.svg' ?>"
                                    alt="youtube" />
                                <img class="dark" src="<?= $templateDirectoryUri . '/build/images/youtube-dark.svg' ?>"
                                    alt="youtube" />
                                <img class="mono" src="<?= $templateDirectoryUri . '/build/images/youtube-mono.svg' ?>"
                                    alt="youtube" />
                            </a>
                            <?php endif; ?>
                        </div>
                        <p class="hts-title"><?= $bottomTitle ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>