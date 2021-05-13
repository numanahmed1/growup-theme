<?php
/*
	===========================
	  Theme Custom Post Types
	===========================
*/

$contact =  get_option( 'activate_contact' );
if( @$contact == 1 ){
	
	add_action( 'init','growup_contact_custom_post_type' );
	
	add_filter( 'manage_growup-contact_posts_columns','growup_set_contact_columns' );
	
	add_action( 'manage_growup-contact_posts_custom_column','growup_contact_custom_column',10,2 );
	
	add_action( 'add_meta_boxes','growup_contact_add_meta_box' );
	
	add_action( 'save_post','growup_save_contact_email_data' );
}

/* Contact Custom Post Type  */
function growup_contact_custom_post_type(){
	$labels = array(
		'name' 				=> 'Messages',
		'singular_name' 	=> 'Message',
		'menu_name' 		=> 'Messages',
		'name_admin_bar' 	=> 'Message'
	);
	$args = array(
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-buddicons-pm',
		'supports' 			=> array( 'title','editor','author')
	);
	register_post_type( 'growup-contact', $args );
}

function growup_set_contact_columns( $columns ){
	$newColums = array();
	$newColums['title'] 	= 'Full Name';
	$newColums['message'] 	= 'Message';
	$newColums['email'] 	= 'Email';
	$newColums['date'] 		= 'Date';
	return $newColums;
}

function growup_contact_custom_column( $column, $post_id ){
	switch( $column ){
		case 'message' :
			echo get_the_excerpt();
			break;
		case 'email' :
			$email = get_post_meta( $post_id,'_contact_email_value_key',true );
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}
}
/*Contact Meta Boxes*/

function growup_contact_add_meta_box(){
	add_meta_box( 'contact_email','User Email','growup_contact_email_callback','growup-contact','side' );
}

function growup_contact_email_callback( $post ){
	wp_nonce_field( 'growup_save_contact_email_data','growup_contact_email_meta_box_nonce' );
	
	$value = get_post_meta( $post->ID,'_contact_email_value_key',true );
	
	echo '<label for="growup_contact_email_field">User Email Address: </label>';
	
	echo '<input type="email" id="growup_contact_email_field" name="growup_contact_email_field" value="' .esc_attr( $value ). '" size="25"/>';
}

function growup_save_contact_email_data( $post_id ){
	if( !isset( $_POST['growup_contact_email_meta_box_nonce'] ) ){
		return;
	}
	if( ! wp_verify_nonce( $_POST['growup_contact_email_meta_box_nonce'],'growup_save_contact_email_data' )){
		return;
	}
	if( define('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	if( ! current_user_can('edit_post', $post_id) ){
		return;
	}
	
	if( ! isset( $_POST['growup_contact_email_field'] ) ){
		return;
	}
	$my_data = sanitize_text_field( $_POST['growup_contact_email_field'] );
	
	update_post_meta( $post_id,'_contact_email_value_key',$my_data );
}





