<?php
$title                = $attributes['title'] ?? __( 'A bit about me ✌️', 'hostinger-blog-theme' );
$subtitle             = $attributes['subtitle'] ?? __( 'A designer, creator, and lifelong learner with a passion for bringing ideas to life through creative problem-solving and collaboration.', 'hostinger-blog-theme' );
$description          = $attributes['description'] ?? __( '<p>As a designer, creator, and lifelong learner, I am driven by a passion for bringing ideas to life through creative problem-solving and collaboration. With a background in visual design, I have expanded my skillset to encompass a variety of creative and technical disciplines, including media production and web development. I approach each project with a dedication to quality and a commitment to delivering results that exceed expectations.</p>', 'hostinger-blog-theme' );
$heroImgId            = $attributes['heroImgId'] ?? '';
$bottomImgLeftId      = $attributes['bottomImgLeftId'] ?? '';
$bottomImgRightId     = $attributes['bottomImgRightId'] ?? '';
$templateDirectoryUri = get_template_directory_uri();

if ( $heroImgId ) {
	$heroImg = hostinger_get_retina_srcset( $heroImgId, 'about-hero', 'about-hero@2x' );
}

if ( $bottomImgLeftId ) {
	$bottomImgLeft = hostinger_get_retina_srcset( $bottomImgLeftId, 'about-bottom', 'about-bottom@2x' );
}

if ( $bottomImgRightId ) {
	$bottomImgRight = hostinger_get_retina_srcset( $bottomImgRightId, 'about-bottom', 'about-bottom@2x' );
}
?>

<section class="hts-section hts-page hts-about">
    <div class="hts-about-header">
        <div class="hts-about-header-content">
            <div class="hts-about-body">
                <div>
                    <h1><?= $title ?></h1>
                    <p><?= $subtitle ?></p>
                </div>
            </div>
            <div class="hts-about-image">
                <div class="hts-image-wrapper">
                    <?php if ( hts_print_unsplash_image( $heroImgId ) ) {
						echo hts_print_unsplash_image( $heroImgId );
					} elseif ( $heroImgId ) {
						echo hostinger_print_retina_img( $heroImgId, 'about-hero', $heroImg );
					} else {
						$heroPlaceholder = $templateDirectoryUri . '/build/images/placeholder2.jpg';
						echo '<img src="' . $heroPlaceholder . '">';
					} ?>
                    <?= hts_print_unsplash_author_credentials( $heroImgId ) ?>
                </div>
            </div>
        </div>
    </div>
    <hr class="full">
    <div class="hts-details">
        <?php if ( $description ) : ?>
        <div class="hts-about-story">
            <h2 class="hts-title">MY STORY</h2>
            <div class="hts-description">
                <?= $description; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="hts-gallery">
            <div class="hts-image-wrapper hts-bottom">
                <?php if ( hts_print_unsplash_image( $bottomImgLeftId ) ) {
					echo hts_print_unsplash_image( $bottomImgLeftId );
				} elseif ( $bottomImgLeftId ) {
					echo hostinger_print_retina_img( $bottomImgLeftId, 'about-hero', $bottomImgLeft );
				} else {
					$bottomPlaceholder = $templateDirectoryUri . '/build/images/placeholder2.jpg';
					echo '<img src="' . $bottomPlaceholder . '">';
				}
				echo hts_print_unsplash_author_credentials( $bottomImgLeftId ) ?>
            </div>
            <div class="hts-image-wrapper hts-bottom">
                <?php
				if ( hts_print_unsplash_image( $bottomImgRightId ) ) {
					echo hts_print_unsplash_image( $bottomImgRightId );
				} elseif ( $bottomImgRightId ) {
					echo hostinger_print_retina_img( $bottomImgRightId, 'about-hero', $bottomImgRight );
				} else {
					$bottomPlaceholder = $templateDirectoryUri . '/build/images/placeholder2.jpg';
					echo '<img src="' . $bottomPlaceholder . '">';
				}
				echo hts_print_unsplash_author_credentials( $bottomImgRightId ) ?>
            </div>
        </div>
    </div>
</section>