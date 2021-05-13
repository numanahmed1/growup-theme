<h1>Growup Theme Options</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="growup-general-form">
	<?php settings_fields( 'growup-theme-support' ); ?>
	<?php do_settings_sections( 'wpliveware_growup_theme' );?>
	<?php submit_button(); ?>
</form>