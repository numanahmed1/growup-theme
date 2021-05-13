<?php
/*
	================
	   Admin Page
	================
*/
function growup_add_admin_page(){
	
	//generate growup admin page 
	add_menu_page( 'Growup Theme Options', 'Growup', 'manage_options', 'wpliveware_growup', 'growup_theme_create_page', 
	'dashicons-admin-generic', 110 );
	
	//generate growup admin sub pages
	add_submenu_page( 'wpliveware_growup', 'Growup sidebar Options', 'Sidebar', 'manage_options', 'wpliveware_growup',
    'growup_theme_create_page' );	
	
	add_submenu_page( 'wpliveware_growup','Growup Theme Options','Theme Options','manage_options','wpliveware_growup_theme',
	'growup_theme_support_page' );
	
	add_submenu_page( 'wpliveware_growup','Growup Contact Form','Contact Form','manage_options','wpliveware_growup_theme_contact',
	'growup_contact_form_page' );
	
	add_submenu_page( 'wpliveware_growup', 'Growup CSS Options', 'Custom CSS', 'manage_options', 'wpliveware_growup_css',
    'growup_theme_settings_page' );
	
	//activate custom settings
	add_action( 'admin_init','growup_custom_settings' );
}
add_action( 'admin_menu', 'growup_add_admin_page' ); 

function growup_custom_settings(){
	// Sidebar Options
	register_setting( 'growup-settings-group','profile_picture' );
	register_setting( 'growup-settings-group','first_name' );
	register_setting( 'growup-settings-group','last_name' );
	register_setting( 'growup-settings-group','user_description' );
	register_setting( 'growup-settings-group','twitter_handler','growup_sanitize_twitter_handler' );
	register_setting( 'growup-settings-group','facebook_handler' );
	register_setting( 'growup-settings-group','instragram_handler' );
	
	add_settings_section( 'growup-sidebar-options','Sidebar Options','growup_sidebar_options','wpliveware_growup' );
	
	add_settings_field( 'sidebar-profile-picture','Profile Picture','growup_sidebar_profile','wpliveware_growup','growup-sidebar-options' );
	add_settings_field( 'sidebar-name','Full Name','growup_sidebar_name','wpliveware_growup','growup-sidebar-options' );
	add_settings_field( 'sidebar-description','Description','growup_sidebar_description','wpliveware_growup','growup-sidebar-options' );
	add_settings_field( 'sidebar-twitter','Twitter Handler','growup_sidebar_twitter','wpliveware_growup','growup-sidebar-options' );
	add_settings_field( 'sidebar-facebook','Facebook Handler','growup_sidebar_facebook','wpliveware_growup','growup-sidebar-options' );
	add_settings_field( 'sidebar-instragram','Instragram Handler','growup_sidebar_instragram','wpliveware_growup','growup-sidebar-options' );
	// Theme Support Options
	register_setting( 'growup-theme-support','post_formats' );
	register_setting( 'growup-theme-support','custom_header' );
	register_setting( 'growup-theme-support','custom_background' );
	
	add_settings_section( 'growup-theme-options','Theme Options','growup_theme_options','wpliveware_growup_theme' );
	
	add_settings_field( 'post-formats','Post Formats','growup_post_formats','wpliveware_growup_theme','growup-theme-options' );
	add_settings_field( 'custom-header','Custom Header','growup_custom_header','wpliveware_growup_theme','growup-theme-options' );
	add_settings_field( 'custom-background','Custom Background','growup_custom_background','wpliveware_growup_theme','growup-theme-options' );
	// Contact Form Options
	register_setting( 'growup-contact-options','activate_contact' );
	
	add_settings_section( 'growup-contact-section','Contact Form','growup_contact_section','wpliveware_growup_theme_contact' );
	
	add_settings_field( 'activate-form','Activate Contact Form','growup_activate_contact','wpliveware_growup_theme_contact','growup-contact-section' );
	
	// Custom Css Options
	register_setting( 'growup-custom-css-options','growup_css','growup_sanitize_custom_css' );
	
	add_settings_section( 'growup-custom-css-section','Custom CSS','growup_custom_css_section_callback','wpliveware_growup_css' );
	
	add_settings_field( 'custom-css','Insert Your Custom CSS','growup_custom_css_callback','wpliveware_growup_css','growup-custom-css-section' );
}
// Custom Css Callback Functions
function growup_custom_css_section_callback(){
	echo 'Customize The Theme with your own CSS';
}
function growup_custom_css_callback(){
	$css =  get_option( 'growup_css' );
	$css =( empty($css) ? '/* Growup Theme Custom CSS */' : $css );
	echo '<div id="customCss">'.$css.'</div><textarea name="growup_css" id="growup_css" style="display:none; visibility:hidden;">
	'.$css.'</textarea>';
}
// Custom Contact Form Functions
function growup_contact_section(){
	echo 'Activate And Deactivate the Built-in Contact Form';
}
function growup_activate_contact(){
	$options =  get_option( 'activate_contact' );
		$checked =( @$options == 1 ? 'checked' : '' );
		echo '<input type="checkbox" id="activate_contact" name="activate_contact"
		value="1" '.$checked.' />';
}
// Post Formats Callback Functions

function growup_theme_options(){
	echo 'Activate And Deactivate Theme Support Options';
}
function growup_post_formats(){
	$options =  get_option( 'post_formats' );
	$formats = array( 'aside','gallery','link','image','quote','status','video','audio','chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked =( @$options[$format] == 1 ? 'checked' : '' );
		$output .='<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br />';
	}
	echo $output;
}
function growup_custom_header(){
	$options =  get_option( 'custom_header' );
		$checked =( @$options == 1 ? 'checked' : '' );
		echo '<label><input type="checkbox" id="custom_header" name="custom_header"
		value="1" '.$checked.' /> Activate Custom Header</label>';
}
function growup_custom_background(){
	$options =  get_option( 'custom_background' );
		$checked =( @$options == 1 ? 'checked' : '' );
		echo '<label><input type="checkbox" id="custom_background" name="custom_background"
		value="1" '.$checked.' /> Activate Custom Background</label>';
}
// Sidebar Options Functions
function growup_sidebar_options(){
	echo "Customize Your Sidebar Information";
}

function growup_sidebar_profile(){
	$profilePic = esc_attr( get_option( 'profile_picture' ) );
	if( empty($profilePic) ){
	echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"/> 
	<input type="hidden" name="profile_picture" id="profile-picture" value="" />';	
	}else{
	echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"/> 
	<input type="hidden" name="profile_picture" id="profile-picture" value="'.$profilePic.'" /> 
	<input type="button" class="button button-secondary" value="Remove" id="remove-picture"/>';	
	}
}
function growup_sidebar_name(){
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
}
function growup_sidebar_description(){
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description"/> <p class="description">Provide Description Smartly.</p>';
}

function growup_sidebar_twitter(){
		$twitter = esc_attr( get_option( 'twitter_handler' ) );
		echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler"/> 
		<p class="description">Input Your Twitter Username Without @ Character.</p>';
}
function growup_sidebar_facebook(){
		$facebook = esc_attr( get_option( 'facebook_handler' ) );
		echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler"/>';
}
function growup_sidebar_instragram(){
		$instragram = esc_attr( get_option( 'instragram_handler' ) );
		echo '<input type="text" name="instragram_handler" value="'.$instragram.'" placeholder="Instragram Handler"/>';
}

// sanitization Setting
function growup_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@','',$output);
	return $output;
}
function growup_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}
// Theme submenu functions
function growup_theme_create_page(){
	require_once( get_template_directory() . '/inc/templates/growup-admin.php' ); 
}
function growup_theme_support_page(){
	require_once( get_template_directory(). '/inc/templates/growup-theme-support.php' );
}
function growup_contact_form_page(){
	require_once( get_template_directory(). '/inc/templates/growup-contact-form.php' );
}
function growup_theme_settings_page(){
	require_once( get_template_directory(). '/inc/templates/growup-custom-css.php' );
}

