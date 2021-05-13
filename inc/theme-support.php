<?php
/*
	===========================
	   Theme support Options
	===========================
*/

$options =  get_option( 'post_formats' );
$formats = array( 'aside','gallery','link','image','quote','status','video','audio','chat' );
$output = array();
foreach ( $formats as $format ){
		  $output[] =( @$options[$format] == 1 ? $format : '' );
}

if ( !empty( $options )){
	add_theme_support( 'post-formats', $output );
}

$header =  get_option( 'custom_header' );
if( @$header == 1 ){
	add_theme_support( 'custom-header' );
}

$background =  get_option( 'custom_background' );
if( @$background == 1 ){
	add_theme_support( 'custom-background' );
}
add_theme_support( 'post-thumbnails' );

/*Activate Nav Menu Option*/
function growup_nav_menu_option() {
	register_nav_menu( 'header_menu','Header Navigation Menu' );
}
add_action( 'after_setup_theme','growup_nav_menu_option' );

/*Activate HTML5 Features*/

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/*
	===========================
	  Sidebar Options
	===========================
*/
function growup_sidebar_init(){
	register_sidebar(
		array(
			'name' => esc_html__( 'Growup Sidebar', 'growuptheme'),
			'id' => 'growup-sidebar',
			'description' => 'Dynamic Right Sidebar',
			'before_widget' => '<section id="%1$s" class="growup-widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="growup-widget-title">',
			'after_title' => '</h2>'
		)
	);
}
add_action( 'widgets_init', 'growup_sidebar_init');
/* 
	==============================
	  Blog Loop Custom Functions
	==============================
*/
function growup_posted_meta(){
	$posted_on = human_time_diff( get_the_time('U'), current_time( 'timestamp' ) );

	$categories = get_the_category();
	$separetor = ', ';
	$output = '';
	$i = 1;
	if( !empty($categories) ):
		foreach ( $categories as $category ):
		if( $i > 1): $output .= $separetor; endif;
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" 
			alt="' . esc_attr( 'View all post in%s', $category -> name ) . '">
			' . esc_html( $category -> name ) . '</a>';
		$i++;
		endforeach;
	endif;

	return '<span class="posted-on"> Posted <a href="' . esc_url( get_permalink() ) . '" >' . $posted_on . '</span></a> ago / <span class="posted-in">' . $output . '</span>';
}

function growup_posted_footer( $onlyComments = false ){

	$comments_num = get_comments_number();

	if( comments_open() ){
		if( $comments_num == 0 ) {
			$comments = __('No Comments');
		}elseif( $comments_num > 1 ) {
			$comments = $comments_num . __(' Comments ');
		}else{
			$comments = __(' 1 Comment ');
		}
		$comments = '<a class="comments-link" href="' . get_comments_link() . '">' . $comments . '<i class="fa fa-comment" aria-hidden="true"></i></a>';
	}else{
		$comments = __(' Comments are Closed.');
	}

	if ($onlyComments) {
		return $comments;
	}

	return '<div class="post-footer-container"><div class="row">
	<div class="col-xs-12 col-sm-6"> ' . get_the_tag_list( '<div class="tags-list" ><i class="fa fa-tags" aria-hidden="true"></i>', ' ', '</div>') . ' </div>
	<div class="col-xs-12 col-sm-6 text-right"> ' . $comments . ' </div>
	</div></div>';
}

function growup_get_attachment( $num = 1 ){
	
	$output = '';
	if( has_post_thumbnail() && $num == 1 ): 
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	else:
		$attachments = get_posts( array( 
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' => get_the_ID()
		) );
		if( $attachments && $num == 1 ):
			foreach ( $attachments as $attachment ):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif( $attachments && $num > 1 ):
			$output = $attachments;
		endif;
		
		wp_reset_postdata();
		
	endif;
	
	return $output;
}

function growup_get_embedded_media( $type=array() ){
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content,  $type );

	if( in_array( 'audio', $type)):
		$output = str_replace( '?/visual=true', '?/visual=false', $embed[0] );
	else:
		$output = $embed[0];
	endif;
	return $output;
}

function growup_get_bs_slides( $attachments ){
	$output = array();
	$count =  count($attachments) -1;

	for ($i = 0; $i <= $count; $i++ ): 
	$active = ( $i == 0 ? 'active' : '' );
   
	$prevImgI = ( $i == 0 ? $count: $i-1 );
	$prevImg = wp_get_attachment_thumb_url( $attachments[$prevImgI]->ID );
	$nextImgI = ( $i == $count ? 0 : $i+1 );
	$nextImg = wp_get_attachment_thumb_url( $attachments[$nextImgI]->ID );

	$output[$i] = array(
		'class' 	=> $active,
		'url'		=> wp_get_attachment_url( $attachments[$i]->ID ),
		'prev_img' 	=> $prevImg,
		'next_img' 	=> $nextImg,
		'caption'	=> $attachments[$i]->post_excerpt
	);

   endfor;
   return $output;
}
function growup_grab_url() {
	if( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ){
		return false;
	}
	return esc_url_raw( $links[1] );
}

function growup_grab_current_uri(){
	
	$http = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://' );
    $referer = ( isset( $_SERVER["HTTP_REFERER"] ) ? rtrim( $_SERVER["HTTP_REFERER"] , "/" ) : $http . $_SERVER["HTTP_HOST"] );
	$archive_url = $referer .  $_SERVER["REQUEST_URI"];
	
	return $archive_url;
}
/*
	===========================
	   Single Post Custom Options
	===========================
*/
function growup_post_navigation(){

	$nav = '<div class="row" >';

	$prev = get_previous_post_link( '<div class="post-nav-link"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> %link</div>', '%title' );
	$nav .= '<div class="col-xs-12 col-sm-6">' . $prev . '</div>';

	$next = get_next_post_link( '<div class="post-nav-link">%link<i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>', '%title' );
	$nav .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';

	$nav .= '</div>';
	return $nav;

}

function growup_share_options( $content ){

	if( is_single() ){
		$content .= '<div class="growup-share"><h4>Sharing is Caring...</h4>';

		$title = get_the_title();
		$permalink = get_permalink();

		$twitterHandler = ( get_option( 'twitter_handler' ) ? '&amp;via='.esc_attr( get_option( 'twitter_handler' ) ) : '' );

		$twitter = 'https://twitter.com/intent/tweet?text='. $title .'&amp;url=' . $permalink . $twitterHandler . '';
		$facebook = 'https://facebook.com/sharer/sharer.php?u='. $permalink;
		$linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $permalink;
		$tumblr = 'https://www.tumblr.com/widgets/share/tool/preview?posttype=link&canonicalUrl=' . $permalink . '&amp;title=' . $title;

		$content .= '<ul>';
		$content .= '<li><a href="' .$twitter. '" rel="nofollow" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>';
		$content .= '<li><a href="' .$facebook. '" rel="nofollow" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>';
		$content .= '<li><a href="' .$linkedin. '" rel="nofollow" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>';
		$content .= '<li><a href="' .$tumblr. '" rel="nofollow" target="_blank"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>';
		$content .= '</ul></div><!-- .growup-share -->';

		return $content;
	} else {
		return $content;
	}
}

add_filter('the_content','growup_share_options');

function growup_get_post_comments_nav(){

	if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
		
		require( get_template_directory(). '/inc/templates/growup-comment-nav.php' );

	endif;
}

// Initialize Global Mobile Detect
function mobileDetectGlobal(){
	global $detect;
	$detect = new Mobile_Detect;
}
add_action('after_setup_theme','mobileDetectGlobal');
