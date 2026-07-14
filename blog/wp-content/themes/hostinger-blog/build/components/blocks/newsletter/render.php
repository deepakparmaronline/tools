<?php
$title         = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Newsletter', 'hostinger-blog-theme' );
$description   = isset( $attributes['description'] ) ? $attributes['description'] : __( 'Subscribe to stay up-to-date with my latest creative projects, insights, and tips.', 'hostinger-blog-theme' );
$privacyPolicy = isset( $attributes['privacyPolicy'] ) && ! empty( $attributes['privacyPolicy'] ) ? $attributes['privacyPolicy'] : __( 'I consent to use of my email address for the purpose of receiving newsletters as described in', 'hostinger-blog-theme' ) . ' ' . '<a href="' . esc_url( get_privacy_policy_url() ) . '" target="_blank">' . __( 'Privacy Policy', 'hostinger-blog-theme' ) . '</a>' . ', ' . __( 'which I have read. I may withdraw my consent at any time.', 'hostinger-blog-theme' );
?>
<section class="hts-section hts-newsletter">
	<hr class="full">
	<div class="wrapper">
	<div>
		<h3 class="hts-title"><?= $title ?></h3>
		<p><?= $description ?></p>
	</div>
	<div class="hts-newsletter-block">
		<form>
			<?php wp_nonce_field( 'submit_newsletter', 'newsletter_nonce' ); ?>
			<label for="hts-newsletter-email"><?= __( 'Email', 'hostinger-blog-theme' ) ?></label>
			<input type="email"
			       id="hts-newsletter-email"
			       name="newsletter_email"
			       placeholder="<?= __( 'What’s your email?', 'hostinger-blog-theme' ) ?>">
			<div class="validate-message"></div>
			<div class="hts-privacy-agree">
				<label class="hts-form-control">
				<input type="checkbox" id="privacy-policy-checkbox" name="privacy_policy" required>
				</label>
				<span>
					<?= $privacyPolicy ?>
				</span>
			</div>
			<input type="submit" class="btn primary" value="<?= __( 'Subscribe', 'hostinger-blog-theme' ) ?>"/>
		</form>
	</div>
	</div>
</section>