<?php
/*
	======================
	   AJAX FUNCTIONS
	======================
*/
add_action( 'wp_ajax_nopriv_growup_load_more','growup_load_more');
add_action( 'wp_ajax_growup_load_more','growup_load_more');

// Contact Form Ajax 
add_action( 'wp_ajax_nopriv_growup_save_user_contact_form','growup_save_contact');
add_action( 'wp_ajax_growup_save_user_contact_form','growup_save_contact');

function growup_load_more(){
    
	$paged = $_POST["page"]+1;
	$prev = $_POST["prev"];
	$archive = $_POST["archive"];
	
	if( $prev == 1 && $_POST["page"] != 1 ){
		$paged = $_POST["page"]-1;
	}
	
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged
	);

    if( $archive != '0' ){
		
        $archVal = explode( '/', $archive );
        /*
        $flipped = array_flip( $archVal );
        
        switch( isset( $flipped ) ){
            case $flipped["category"] :
                 $type = "category_name";
                 $key = "category";
            break;
            
            case $flipped["tag"] :
                 $type = "tag";
                 $key = $type;
            break;

            case $flipped["author"] :
                 $type = "author";
                 $key = $type;
            break;
        }*/
        /* if( isset( $flipped["category"] ) || isset( $flipped["tag"] ) || isset( $flipped["author"] ) ) {

            if( isset( $flipped["category"] ) ){
                $type = "category_name";
                $key = "category";
            } else if( isset( $flipped["tag"] ) ){
                $type = "tag";
                $key = $type;
            } else if( isset( $flipped["author"] ) ){
                $type = "author";
                $key = $type;
            }
        }*/
        /*
        $currentKey = array_keys( $archVal, $key  );
        $nextKey = $currentKey[0] + 1 ;
        $value = $archVal[ $nextKey ];

        $args[ $type ] = $value; 
        */
        if( in_array( 'category', $archVal ) ){

            $type = 'category_name';
            $currentKey = array_keys( $archVal, 'category' );
            $nextKey = $currentKey[0] + 1 ;
            $value = $archVal[ $nextKey ];

            $args[ $type ] = $value;
        }

        if( in_array( 'tag', $archVal ) ){

            $type = 'tag';
            $currentKey = array_keys( $archVal, 'tag' );
            $nextKey = $currentKey[0] + 1 ;
            $value = $archVal[ $nextKey ];

            $args[ $type ] = $value;
        }

        if( in_array( 'author', $archVal ) ){

            $type = 'author';
            $currentKey = array_keys( $archVal, 'author' );
            $nextKey = $currentKey[0] + 1 ;
            $value = $archVal[ $nextKey ];

            $args[ $type ] = $value;
        }

        // check Page trail and remove 'page' value 
        if( in_array( 'page', $archVal ) ){

            $pageVal = explode( 'page', $archive );
            $page_trail = $pageVal[0];

        }else{
            $page_trail = $archive;
        }
        
	}else {
		$page_trail = '/';
    }
    
    $query = new WP_Query( $args );

    if( $query->have_posts() ):
        echo '<div class="page-limit" data-page="' . $page_trail . 'page/' . $paged . '/">';

        while( $query->have_posts() ): $query->the_post();
            get_template_part('template-parts/content', get_post_format() );
        endwhile;

        echo '</div>';
    else:
        echo 0;

    endif;

    wp_reset_postdata();
    die();
 
}

function growup_check_paged( $num = null ){
    $output  = '';

    if( is_paged() ){
        $output = 'page/' . get_query_var( 'paged' );
    }
    if( $num == 1 ){
        $paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) );
        return $paged;
    }else{
        return $output;
    }
}

function growup_save_contact(){
    $title = wp_strip_all_tags( $_POST['name'] );
    $email = wp_strip_all_tags( $_POST['email'] );
    $message = wp_strip_all_tags( $_POST['message'] );

    $args = array(
        'post_title'        => $title,
        'post_content'      => $message,
        'post_author'       => 1,
        'post_status'       => 'publish',
        'post_type'         => 'growup-contact',
        'meta_input'        => array(
            '_contact_email_value_key'    => $email
        )
    );

    $postID = wp_insert_post( $args );

    if ($postID !== 0) {
        $to = get_bloginfo('admin_email');
        $subject = 'Growup Contact Form - '.$title;
    
        $headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; 
        $headers[] = 'Reply-To: '.$title.' <'.$email.'>';
        $headers[] = 'Content-Type: text/html: charset=UTF-8';
    
        wp_mail($to, $subject, $message, $headers);
    }
    
    echo $postID;
   
    die();
}

