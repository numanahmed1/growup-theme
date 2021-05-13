<?php
/*
	@package growuptheme
	============================
	   Admin Enqueue Functions
	============================
*/

function growup_load_admin_scripts( $hook ){
	//echo $hook;
	if( 'toplevel_page_wpliveware_growup' == $hook){
		wp_register_style( 'growup_admin', get_template_directory_uri() . '/css/growup.admin.css',array(),'1.0.0','all' );
		wp_enqueue_style( 'growup_admin' );
		
		wp_enqueue_media();
		
		wp_register_script( 'growup-admin-script', get_template_directory_uri() . '/js/growup.admin.js',array('jquery'),'1.0.0',true );
		wp_enqueue_script( 'growup-admin-script' );
	}else if( 'growup_page_wpliveware_growup_css' ==$hook ){
		
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/growup.ace.css',array(),'1.0.0','all' );
		
		wp_enqueue_script( 'ace', get_template_directory_uri(). '/js/ace/ace.js', array('jquery'),'1.4.7',true );
		wp_enqueue_script( 'growup-custom-css-script', get_template_directory_uri() . '/js/growup.custom_css.js',array('jquery'),'1.0.0',true   );
	}else{
		return;
	}
}
add_action( 'admin_enqueue_scripts','growup_load_admin_scripts' );

/*
	=================================
	   Front-End Enqueue Functions
	=================================
*/

function growup_load_scripts(){
	wp_enqueue_style( 'fontawesome','https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',array(),'4.5.2','all' );
	wp_enqueue_style( 'growup', get_template_directory_uri() . '/sass/growup.css',array(),'1.0.0','all' );
	wp_enqueue_style( 'raleway','https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800;900&display=swap' );
	
	
	wp_deregister_script( 'jquery' );
	
	wp_register_script( 'jquery', get_template_directory_uri(). '/js/jquery.js',false,'3.5.1',true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'proper', get_template_directory_uri(). '/js/popper.min.js', array('jquery'),'1.16.1',true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'),'4.5.2',true );
	wp_enqueue_script( 'growup', get_template_directory_uri(). '/js/growup.js', array('jquery'),'1.0.0',true );
}
add_action( 'wp_enqueue_scripts','growup_load_scripts' );


