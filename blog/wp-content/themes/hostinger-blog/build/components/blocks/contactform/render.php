<?php
$title                = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Let’s get in touch', 'hostinger-blog-theme' );
$description          = isset( $attributes['description'] ) ? $attributes['description'] : __( 'Feel free to reach out to me through any of the following ways.', 'hostinger-blog-theme' );
$privacyPolicy        = isset( $attributes['privacyPolicy'] ) && ! empty( $attributes['privacyPolicy'] ) ? $attributes['privacyPolicy'] : __( 'I consent to use of provided personal data for the purpose of responding to the request as described in', 'hostinger-blog-theme' ) . ' ' . '<a href="' . esc_url( get_privacy_policy_url() ) . '" target="_blank">' . __( 'Privacy Policy', 'hostinger-blog-theme' ) . '</a>' . ', ' . __( 'which I have read. I may withdraw my consent at any time.', 'hostinger-blog-theme' );
$contactsEmail        = get_option( 'hostinger_contacts_email' ) ?? '';
$contactsPhone        = get_option( 'hostinger_contacts_phone' ) ?? '';
$contactsAddress      = get_option( 'hostinger_contacts_address' ) ?? '';
$templateDirectoryUri = get_template_directory_uri();
?>
<section class="hts-section hts-page hts-contact-form">
	<div class="hts-header">
		<div>
			<h1><?= $title ?></h1>
			<p class="hts-description"><?= $description ?></p>
		</div>
	</div>
	<div class="hts-details">
		<div class="hts-contact-details hts-contacts">
			<form>
				<?php wp_nonce_field( 'submit_contactform', 'contactform_nonce' ); ?>
				<label for="contact-name"><?= __( 'Name', 'hostinger-blog-theme' ) ?></label>
				<input type="text"
				       id="contact-name" name="contact-name"
				       placeholder="<?= __( 'What’s your name?', 'hostinger-blog-theme' ) ?>">
				<label for="contact-email"><?= __( 'Email', 'hostinger-blog-theme' ) ?></label>
				<input type="email"
				       id="contact-email" name="contact-email"
				       placeholder="<?= __( 'What’s your email?', 'hostinger-blog-theme' ) ?>">
				<label for="contact-message"><?= __( 'Message', 'hostinger-blog-theme' ) ?></label>
				<textarea id="contact-message" name="contact-message"
				          placeholder="<?= __( 'Write your message...', 'hostinger-blog-theme' ) ?>"></textarea>
				<div class="validate-message"></div>
				<div class="hts-privacy-agree">
					<label class="hts-form-control">
					<input type="checkbox" id="privacy-policy-checkbox" name="privacy_policy" required>
					</label>
					<span>
						<?= $privacyPolicy ?>
					</span>
				</div>
				<input type="submit" class="btn primary" value="<?= __( 'Send Message', 'hostinger-blog-theme' ) ?>"/>
			</form>
			<div class="hts-info">
				<?php if ( $contactsEmail ) : ?>
					<div>
						<div class="hts-title"><?= __( 'Email', 'hostinger-blog-theme' ) ?></div>
						<div class="description">
							<a href="mailto:<?= $contactsEmail ?>">
								<img src="<?= $templateDirectoryUri . '/build/images/mail.svg' ?>" alt="email"/>
								<?= $contactsEmail ?>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $contactsPhone ) : ?>
					<div>
						<div class="hts-title"><?= __( 'Phone', 'hostinger-blog-theme' ) ?></div>
						<div class="description">
							<a href="tel:<?= $contactsPhone ?>">
								<img src="<?= $templateDirectoryUri . '/build/images/call.svg' ?>" alt="Call"/>
								<p><?= $contactsPhone ?></p>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $contactsAddress ) : ?>
					<div>
						<div class="hts-title"><?= __( 'Address', 'hostinger-blog-theme' ) ?></div>
						<div class="description">
							<img src="<?= $templateDirectoryUri . '/build/images/location_on.svg' ?>" alt="Location"/>
							<p><?= $contactsAddress ?></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>