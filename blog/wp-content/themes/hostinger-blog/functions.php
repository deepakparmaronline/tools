<?php
/**
 * Hostinger blog theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hostinger_blog_theme
 */

if ( file_exists( $autoloadFile = __DIR__ . '/vendor/autoload.php' ) ) {
    require_once $autoloadFile;
}

if ( ! defined( '_THEME_VERSION' ) ) {
	$theme = wp_get_theme();
	define( '_THEME_VERSION', $theme->Version );
}

/**
 * Define theme updater URI
 */

if ( file_exists( $updates = get_template_directory() . '/inc/updates.php' ) ) {
    require_once $updates;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hostinger_blog_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Hostinger blog theme, use a find and replace
		* to change 'hostinger-blog-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hostinger-blog-theme', get_template_directory() . '/languages' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'hostinger-blog-theme' ),
		)
	);

	register_nav_menus(
		array(
			'quick-links' => esc_html__( 'Quick links', 'hostinger-blog-theme' ),
		)
	);

	register_nav_menus(
		array(
			'terms-and-policy' => esc_html__( 'Terms & policy', 'hostinger-blog-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size( 'single-post-featured', 1110, 540, true );
	add_image_size( 'single-post-featured@2x', 2220, 1080, true );
	add_image_size( 'about-bottom', 540, 360, true );
	add_image_size( 'about-bottom@2x', 1080, 720, true );
	add_image_size( 'about-hero', 1110, 740, true );
	add_image_size( 'about-hero@2x', 2220, 1480, true );

}

add_action( 'after_setup_theme', 'hostinger_blog_theme_setup' );

function hostinger_get_retina_srcset( int $image_id, string $size, string $retina_size ) {
	$src    = wp_get_attachment_image_url( $image_id, $size );
	$src_2x = wp_get_attachment_image_url( $image_id, $retina_size );

	return sprintf( '%s 1x, %s 2x', esc_url( $src ), esc_url( $src_2x ) );
}

function hostinger_print_retina_img( int $imgId, string $imgSize, string $imgSrcset ) {
	return sprintf( '<img src="%s" srcset="%s" alt="%s">', esc_url( wp_get_attachment_image_url( $imgId, $imgSize ) ), esc_attr( $imgSrcset ), esc_attr( get_the_title( $imgId ) ) );
}

/**
 * Enqueue scripts and styles.
 */
function hostinger_blog_theme_scripts() {
	wp_enqueue_style( 'hostinger-blog-theme-style', get_stylesheet_directory_uri() . '/build/styles/main.css', [], _THEME_VERSION );
	wp_enqueue_script( 'hostinger-blog-theme-scripts', get_stylesheet_directory_uri() . '/build/scripts/main.js', [ 'jquery' ], _THEME_VERSION, true );
	wp_localize_script( 'hostinger-blog-theme-scripts', 'hts_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script(
		'hostinger-blog-theme-scripts',
		'hts_ajax_object',
		[
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'load_posts_nonce' ),
		]
	);

}

add_action( 'wp_enqueue_scripts', 'hostinger_blog_theme_scripts' );

/**
 * Enqueue admin scripts
 */
function hts_admin_enqueue_scripts() {
	wp_enqueue_script( 'hts-admin-script', get_stylesheet_directory_uri() . '/build/scripts/admin-script.js', [ 'jquery' ], _THEME_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'hts_admin_enqueue_scripts' );

function hostinger_blog_theme_block_editor_assets() {
	wp_enqueue_style( 'wp-block-library' );
	wp_enqueue_style(
		'hostinger-admin-block-styles',
		get_template_directory_uri() . '/build/styles/blocks/general-styles.css',
		array( 'wp-edit-blocks' )
	);
}

add_action( 'enqueue_block_editor_assets', 'hostinger_blog_theme_block_editor_assets' );


function hostinger_blog_theme_enqueue_admin_styles() {
	wp_enqueue_style( 'hostinger-blog-theme-admin-styles', get_template_directory_uri() . '/build/styles/admin/admin-styles.css', [], _THEME_VERSION, 'all' );
}

add_action( 'admin_enqueue_scripts', 'hostinger_blog_theme_enqueue_admin_styles' );


/**
 * Add rest API functions
 */
require get_template_directory() . '/inc/rest-api-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Additional settings.
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Form submissions
 */
require get_template_directory() . '/inc/form-submissions.php';

/**
 * Add theme blocks
 */
require get_template_directory() . '/inc/theme-blocks.php';

function register_custom_blocks() {
	$blocks = [
		'herosection',
		'featuredpost',
		'latestposts',
		'newsletter',
		'aboutsection',
		'disclaimersection',
		'contactform'
	];

	foreach ( $blocks as $block ) {
		register_block_type( __DIR__ . '/build/components/blocks/' . $block );
	}

}

add_action( 'init', 'register_custom_blocks' );

function flush_theme_settings_cache(): void {
    $options_to_cache = [
        'hostinger_theme_layout',
        'hostinger_theme_font',
        'hostinger_theme_palette',
        'hostinger_blog_description',
        'hostinger_contacts_email',
        'hostinger_contacts_form_email',
        'hostinger_contacts_newsletter_email',
        'hostinger_contacts_phone',
        'hostinger_contacts_address',
        'hostinger_footer_description',
        'hostinger_footer_copyright',
        'hostinger_facebook_url',
        'hostinger_twitter_url',
        'hostinger_instagram_url',
        'hostinger_youtube_url',
    ];

    foreach ( $options_to_cache as $option_name ) {
        add_action( "update_option_{$option_name}", function () {
            if ( has_action( 'litespeed_purge_all' ) ) {
                do_action( 'litespeed_purge_all' );
            }
        } );
    }
}

add_action( 'admin_init', 'flush_theme_settings_cache' );
