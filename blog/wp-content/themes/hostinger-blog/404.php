<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hostinger_blog_theme
 */

get_header();
?>
	<div class="hts-page">
	<div class="hts-content hts-404">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hostinger-blog-theme' ); ?></h1>
					</header>
					<div class="page-content">
						<p><?php printf(
								esc_html__(
								/* translators: This string is used to indicate going back to the home page. The placeholder %s will be replaced with a link to the home page. */
									'Go back to the %s',
									'hostinger-blog-theme'
								),
								'<a href="' . esc_url( home_url( '/' ) ) . '"><b>' . esc_html__( 'Home', 'hostinger-blog-theme' ) . '</b></a>'
							); ?></p>
					</div>
				</section>
			</main>
		</div>
	</div>
	</div>

<?php
get_footer();
