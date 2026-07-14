<?php

function mytheme_create_settings_page() {
	add_menu_page(
		__( 'Theme Settings', 'hostinger-blog-theme' ),
		__( 'Theme Settings', 'hostinger-blog-theme' ),
		'edit_theme_options',
		'hostinger-additional-settings',
		'hostinger_render_settings_page',
		'dashicons-admin-generic',
		100
	);
}

add_action( 'admin_menu', 'mytheme_create_settings_page' );

function hostinger_render_settings_page() {
	?>
	<div class="wrap">
		<h1><?php _e( 'Additional Settings', 'hostinger-blog-theme' ); ?></h1>
		<form method="post" action="options.php" id="hostinger-blog-theme-settings-form">
			<?php
			settings_fields( 'hostinger_additional_settings_group' );
			do_settings_sections( 'hostinger_additional_settings_page' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 *
 *  Add social settings to the General Settings page.
 */
function settings_init() {
	/**
	 *  Add sections to additional settings page.
	 */
	add_settings_section(
		'hostinger_theme_settings_section',
		'Theme settings',
		function () {
			echo '<p>' . __( 'Edit theme settings below.', 'hostinger-blog-theme' ) . '</p>';
		},
		'hostinger_additional_settings_page'
	);

	add_settings_section(
		'hostinger_theme_blog_description',
		'Blog description',
		function () {
			echo '<p>' . __( 'Edit blog description below.', 'hostinger-blog-theme' ) . '</p>';
		},
		'hostinger_additional_settings_page'
	);

	add_settings_section(
		'social_links_section',
		'Social Media Links',
		function () {
			echo '<p>' . __( 'Enter the URLs for your social media profiles below.', 'hostinger-blog-theme' ) . '</p>';
		},
		'hostinger_additional_settings_page'
	);

	add_settings_section(
		'contacts_section',
		'Contacts section settings',
		function () {
			echo '<p>' . __( 'Enter contacts below', 'hostinger-blog-theme' ) . '</p>';
		},
		'hostinger_additional_settings_page'
	);

	add_settings_section(
		'footer_section',
		'Footer section settings',
		function () {
			echo '<p>' . __( 'Enter footer content below', 'hostinger-blog-theme' ) . '</p>';
		},
		'hostinger_additional_settings_page'
	);
	/**
	 *  Add sections fields to additional settings page.
	 */

	add_settings_field(
		'hostinger_theme_layout',
		'Theme layout',
		function () {
			$option_value = get_option( 'hostinger_theme_layout' );
			$palettes    = array(
				'layout1' => 'Default layout',
				'layout2' => 'Second layout',
				'layout3' => 'Third layout',
			);
			echo '<select name="hostinger_theme_layout">';
			foreach ( $palettes as $value => $label ) {
				echo '<option value="' . esc_attr( $value ) . '" ' . selected( $option_value, $value, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select>';
		},
		'hostinger_additional_settings_page',
		'hostinger_theme_settings_section'
	);

	add_settings_field(
		'hostinger_theme_font',
		'Theme font style',
		function () {
			$option_value = get_option( 'hostinger_theme_font' );
			$fonts = array(
				'default'      => 'Default',
				'professional' => 'Professional',
				'modern'       => 'Modern',
				'elegant'      => 'Elegant',
				'creative'     => 'Creative',
				'dynamic'      => 'Dynamic',
			);
			echo '<select name="hostinger_theme_font">';
			foreach ( $fonts as $value => $label ) {
				echo '<option value="' . esc_attr( $value ) . '" ' . selected( $option_value, $value, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select>';
		},
		'hostinger_additional_settings_page',
		'hostinger_theme_settings_section'
	);

	add_settings_field(
		'hostinger_theme_palette',
		'Theme palette',
		function () {
			$option_value = get_option( 'hostinger_theme_palette' );
			$palettes    = array(
				'palette1' => 'Default color scheme',
				'palette2' => 'Modern & Efficient',
				'palette3' => 'Active & Lively',
				'palette4' => 'Vibrant & Dynamic',
				'palette5' => 'Calm & Stylish'
			);
			echo '<select name="hostinger_theme_palette">';
			foreach ( $palettes as $value => $label ) {
				echo '<option value="' . esc_attr( $value ) . '" ' . selected( $option_value, $value, false ) . '>' . esc_html( $label ) . '</option>';
			}
			echo '</select>';
		},
		'hostinger_additional_settings_page',
		'hostinger_theme_settings_section'
	);

	add_settings_field(
		'hostinger_blog_description',
		'Blog description',
		function () {
			$name  = 'hostinger_blog_description';
			$value = esc_attr( get_option( $name ) );
			echo '<textarea id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" rows="6">' . esc_attr( $value ) . '</textarea>';
		},
		'hostinger_additional_settings_page',
		'hostinger_theme_blog_description'
	);

	add_settings_field(
		'hostinger_contacts_newsletter_email',
		'Newsletter form recipient email',
		function () {
			$name  = 'hostinger_contacts_newsletter_email';
			$value = esc_attr( get_option( $name ) );
			echo '<input type="email" id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" value="' . esc_attr( $value ) . '"/>';
		},
		'hostinger_additional_settings_page',
		'contacts_section'
	);

	add_settings_field(
		'hostinger_contacts_form_email',
		'Contact form recipient email',
		function () {
			$name  = 'hostinger_contacts_form_email';
			$value = esc_attr( get_option( $name ) );
			echo '<input type="email" id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" value="' . esc_attr( $value ) . '"/>';
		},
		'hostinger_additional_settings_page',
		'contacts_section'
	);

	add_settings_field(
		'hostinger_contacts_email',
		'Cotacts email',
		function () {
			$name  = 'hostinger_contacts_email';
			$value = esc_attr( get_option( $name ) );
			echo '<input type="email" id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" value="' . esc_attr( $value ) . '"/>';
		},
		'hostinger_additional_settings_page',
		'contacts_section'
	);

	add_settings_field(
		'hostinger_contacts_phone',
		'Cotacts phone',
		function () {
			$name  = 'hostinger_contacts_phone';
			$value = esc_attr( get_option( $name ) );
			echo '<input type="text" id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" value="' . esc_attr( $value ) . '"/>';
		},
		'hostinger_additional_settings_page',
		'contacts_section'
	);

	add_settings_field(
		'hostinger_contacts_address',
		'Contacts address',
		function () {
			$name  = 'hostinger_contacts_address';
			$value = esc_attr( get_option( $name ) );
			echo '<textarea id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" rows="6">' . esc_attr( $value ) . '</textarea>';
		},
		'hostinger_additional_settings_page',
		'contacts_section'
	);

	add_settings_field(
		'hostinger_footer_description',
		'Footer description',
		function () {
			$name  = 'hostinger_footer_description';
			$value = esc_attr( get_option( $name ) );
			echo '<textarea id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" rows="6">' . esc_attr( $value ) . '</textarea>';
		},
		'hostinger_additional_settings_page',
		'footer_section'
	);


	add_settings_field(
		'hostinger_footer_copyright',
		'Footer copyright',
		function () {
			$name  = 'hostinger_footer_copyright';
			$value = esc_attr( get_option( $name ) );
			echo '<textarea id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" rows="6">' . esc_attr( $value ) . '</textarea>';
		},
		'hostinger_additional_settings_page',
		'footer_section'
	);

	$social_settings = [
		'hostinger_facebook_url'  => 'Facebook URL',
		'hostinger_twitter_url'   => 'Twitter URL',
		'hostinger_instagram_url' => 'Instagram URL',
		'hostinger_youtube_url'   => 'YouTube URL',
	];

	foreach ( $social_settings as $name => $label ) {
		add_settings_field(
			$name,
			$label,
			function () use ( $name ) {
				$value = esc_attr( get_option( $name ) );
				echo '<input type="text" id="' . esc_html( $name ) . '" name="' . esc_html( $name ) . '" value="' . esc_attr( $value ) . '">';
			},
			'hostinger_additional_settings_page',
			'social_links_section'
		);

		register_setting( 'hostinger_additional_settings_group', esc_html( $name ), [ 'sanitize_callback' => 'sanitize_text_field' ] );
	}
	/**
	 *  Register sections fields.
	 */
	register_setting( 'hostinger_additional_settings_group', 'hostinger_theme_layout', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_theme_font', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_theme_palette', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_blog_description', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_contacts_email', [ 'sanitize_callback' => 'sanitize_email' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_contacts_form_email', [ 'sanitize_callback' => 'sanitize_email' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_contacts_newsletter_email', [ 'sanitize_callback' => 'sanitize_email' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_contacts_phone', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_contacts_address', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_footer_description', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	register_setting( 'hostinger_additional_settings_group', 'hostinger_footer_copyright', [ 'sanitize_callback' => 'sanitize_text_field' ] );
}

add_action( 'admin_init', 'settings_init' );
