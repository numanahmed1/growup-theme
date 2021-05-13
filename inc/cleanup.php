<?php
/*
	@package growuptheme
	============================
	REMOVE GENARETOR VERSION NUMBER
 	============================
*/
/*Remove Version Strings From css and js*/
function growup_remove_wp_strings( $src ) {
	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query );
	if( !empty( $query['ver'] ) && $query['ver'] === $wp_version ){
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'script_loader_src','growup_remove_wp_strings' );
add_filter( 'style_loader_src','growup_remove_wp_strings' );
/* Remove Metatag Generator from Header*/
function growup_remove_meta_version(){
	return '';
}
add_filter( 'the_generator','growup_remove_meta_version' );