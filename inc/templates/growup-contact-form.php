<h1>Growup Contact Form</h1>
<?php settings_errors(); ?>

<p>Use this <strong>Shortcode</strong> to activate the Contact Form inside a Page or a Post.</p>
<code>[contact_form]</code>

<form method="post" action="options.php" class="growup-general-form">
	<?php settings_fields( 'growup-contact-options' ); ?>
	<?php do_settings_sections( 'wpliveware_growup_theme_contact' );?>
	<?php submit_button(); ?>
</form>