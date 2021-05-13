<h1>Growup Sidebar Options</h1>
<?php settings_errors(); ?>
<?php 
	$profile = esc_attr( get_option( 'profile_picture' ) );
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$fullName = $firstName. ' '.$lastName;
	$description = esc_attr( get_option( 'user_description' ) );

	$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
	$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
	$instagram_icon = esc_attr( get_option( 'instragram_handler' ) );
?>
<div class="growup-sidebar-preview">
	<div class="growup-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php echo $profile; ?>);"></div>
		</div>
		<h1 class="growup-username"><?php echo $fullName; ?></h1>
		<h2 class="growup-description"><?php echo $description; ?></h2>
		<div class="icons-wrapper">

			<?php if( !empty( $twitter_icon ) ): ?>
				<i class="fa fa-twitter growup-icon-sidebar" aria-hidden="true"></i>
			<?php endif; 
			if( !empty( $facebook_icon ) ): ?>
				<i class="fa fa-facebook growup-icon-sidebar" aria-hidden="true"></i>
			<?php endif; 
			if( !empty( $instagram_icon ) ): ?>
				<i class="fa fa-instagram growup-icon-sidebar" aria-hidden="true"></i>
			<?php endif; ?>

		</div>
	</div>
</div><!-- .growup-sidebar-preview -->

<form method="post" action="options.php" class="growup-general-form">
	<?php settings_fields( 'growup-settings-group' ); ?>
	<?php do_settings_sections( 'wpliveware_growup' );?>
	<?php submit_button('Save Changes','primary','btnSubmit'); ?>
</form>