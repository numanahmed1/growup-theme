<?php 
/*
    @package growuptheme
*/

if( ! is_active_sidebar( 'growup-sidebar' ) ){
    return;
}
?>

<aside id="secondary" class="widget-area" roll="complementary">
    <div class="responsive-nav">

    <?php 
		wp_nav_menu( array(
			'theme_location'=>'header_menu',
			'container' 	=>false,
			'menu_class' 	=>'nav navbar-nav navbar-collapse',
			'walker' => new Growup_Walker_Nav_Primary()
		));
	?>

    </div>


    <?php dynamic_sidebar( 'growup-sidebar' ); ?>
    
</aside>