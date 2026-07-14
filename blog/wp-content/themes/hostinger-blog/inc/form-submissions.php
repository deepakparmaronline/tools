<?php

/**
 * Handle newsletter form
 */

function hts_submit_newsletter() {
	check_ajax_referer( 'submit_newsletter', 'nonce' );
	$email          = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
	$privacy_policy = isset( $_POST['privacy_policy'] ) ? sanitize_text_field( $_POST['privacy_policy'] ) : '';

	if ( $privacy_policy !== 'on' ) {
		wp_send_json_error( array( 'message' => __( 'Please agree with privacy policy.', 'hostinger-blog-theme' ) ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'hostinger-blog-theme' ) ) );
	}

	// Set email subject, body, and headers
	$subject   = 'New Newsletter Subscription';
	$message   = 'Email: ' . $email;
	$headers   = array();
	$headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <info@' . parse_url( home_url(), PHP_URL_HOST ) . '>';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	// Send email to admin
	$newsletter_form_email = get_option( 'hostinger_contacts_newsletter_email' );
	$admin_email           = get_option( 'admin_email' );

	if ( ! empty( $newsletter_form_email ) ) {
		$send_to = $newsletter_form_email;
	} else {
		$send_to = $admin_email;
	}

	if ( is_email( $send_to ) ) {
		wp_mail( $send_to, $subject, $message, $headers );
	} else {
		wp_send_json_error( array( 'message' => __( 'Not valid recipient email.', 'hostinger-blog-theme' ) ) );
	}


	// Send a success response
	wp_send_json_success( array( 'message' => __( 'Successfully subscribed!', 'hostinger-blog-theme' ) ) );
}

add_action( 'wp_ajax_submit_newsletter', 'hts_submit_newsletter' );
add_action( 'wp_ajax_nopriv_submit_newsletter', 'hts_submit_newsletter' );

/**
 * Handle contact form
 */

function hts_submit_contactform() {
	check_ajax_referer( 'submit_contactform', 'nonce' );
	$name           = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
	$email          = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
	$privacy_policy = isset( $_POST['privacy_policy'] ) ? sanitize_text_field( $_POST['privacy_policy'] ) : '';
	$form_message   = isset( $_POST['message'] ) ? sanitize_text_field( $_POST['message'] ) : '';
	$message        = '';

	if ( $privacy_policy !== 'on' ) {
		wp_send_json_error( array( 'message' => __( 'Please agree with privacy policy.', 'hostinger-blog-theme' ) ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'hostinger-blog-theme' ) ) );
	}

	// Set email subject, body, and headers
	$subject   = __( 'New Newsletter Subscription', 'hostinger-blog-theme' );
	$message   .= 'Name: ' . $name;
	$message   .= "\n";
	$message   .= 'Email: ' . $email;
	$message   .= "\n";
	$message   .= 'Message: ' . $form_message;
	$headers   = array();
	$headers[] = 'From: ' . get_bloginfo( 'name' ) . ' <info@' . parse_url( home_url(), PHP_URL_HOST ) . '>';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	// Send email to admin
	$contact_form_email = get_option( 'hostinger_contacts_form_email' );
	$admin_email        = get_option( 'admin_email' );

	if ( ! empty( $contact_form_email ) ) {
		$send_to = $contact_form_email;
	} else {
		$send_to = $admin_email;
	}

	if ( is_email( $send_to ) ) {
		wp_mail( $send_to, $subject, $message, $headers );
	} else {
		wp_send_json_error( array( 'message' => __( 'Not valid recipient email.', 'hostinger-blog-theme' ) ) );
	}

	// Send a success response
	wp_send_json_success( array( 'message' => __( 'Successfully submitted!', 'hostinger-blog-theme' ) ) );
}

add_action( 'wp_ajax_submit_contactform', 'hts_submit_contactform' );
add_action( 'wp_ajax_nopriv_submit_contactform', 'hts_submit_contactform' );
