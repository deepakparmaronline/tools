<?php

function get_email_register_rest_route() {
	register_rest_route( 'hostinger-blog-theme/v1', '/get-admin-email', array(
		'methods'             => WP_REST_Server::READABLE,
		'callback'            => 'hostinger_get_admin_email',
		'permission_callback' => '__return_true',
	) );
}

add_action( 'rest_api_init', 'get_email_register_rest_route' );

function hostinger_get_admin_email() {
	$admin_email       = get_option( 'admin_email' );
	$valid_admin_email = is_email( $admin_email );

	if ( $valid_admin_email ) {
		return $admin_email;
	}

	return '';
}

// Get image url rom ID.

function hostinger_register_custom_rest_route() {
	register_rest_route( 'hostinger-blog-theme/v1', '/image/(?P<id>\d+)', array(
		'methods'  => 'GET',
		'callback' => 'hostinger_get_image_url_callback',
		'permission_callback' => '__return_true',
	) );
}

function hostinger_get_image_url_callback( $request ) {
	$image_id = $request->get_param( 'id' );

	$image_url = wp_get_attachment_image_url( $image_id, 'full' );

	if ( $image_url ) {
		return rest_ensure_response( array( 'url' => $image_url ) );
	} else {
		return new WP_Error( 'image_not_found', 'Image not found', array( 'status' => 404 ) );
	}
}

add_action( 'rest_api_init', 'hostinger_register_custom_rest_route' );
