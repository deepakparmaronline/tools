<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="hts-page-header">
	<div class="hts-page-header-block">
		<?php
		$custom_logo_id  = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );

		if ( $custom_logo_id ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img id="hst-logo-img" src="<?php echo esc_url( $custom_logo_url ); ?>"
			     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">

			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<h3><?= get_bloginfo( 'name' ) ?></h3>
				</a>
			<?php endif; ?>
		</a>
		<div class="hts-menu closed">
			<div class="open">
				<img src="<?php echo get_template_directory_uri() . '/build/images/icon-menu.svg'; ?>" alt="open">
			</div>
			<div class="close">
				<img src="<?php echo get_template_directory_uri() . '/build/images/icon-close.svg' ?>" alt="close">
			</div>
			<div class="hts-menu-elements">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_class'     => 'hts-nav',
					'container'      => false
				) );
				?>
			</div>
		</div>
	</div>
</header>
<main class="hts-main">