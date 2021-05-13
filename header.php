<?php
	/*
	This is the template for header
	@package growuptheme
	*/
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?> >
<head>
	<title><?php bloginfo( 'name' ); wp_title(); ?></title>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" >
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_uri' ); ?>" />
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

	<div class="growup-sidebar sidebar-closed">
		<div class="growup-sidebar-container">
			
			<a class="js-toggleSidebar close-sidebar">
				<i class="fa fa-times" aria-hidden="true"></i>
			</a>

			<div class="growup-scroll">
				<?php get_sidebar(); ?>
			</div><!-- .growup-scroll -->

		</div><!-- .growup-sidebar-container -->
	</div><!-- .growup-sidebar -->
	
	<div class="sidebar-overlay js-toggleSidebar"></div>

	<div class="container-fluid">
		<div class="row">	
			<header class="header-container background-image text-center" style="background-image: url( <?php header_image(); ?>);">

				<a class="js-toggleSidebar open-sidebar">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</a>

				<div class="header-content table">
					<div class="table-cell">
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div><!--table-cell-->
				</div><!--.header-content-->
				<div class="nav-container">
					<nav class="navbar navbar-expand-lg growup-navbar">
						<?php 
							wp_nav_menu( array(
								'theme_location'=>'header_menu',
								'container' 	=>false,
								'menu_class' 	=>'nav navbar-nav',
								'walker' => new Growup_Walker_Nav_Primary()
							));
						?>
					</nav>
				</div><!--.nav-container-->
			</header><!--.header-container-->
		</div><!--.row-->
	</div><!--.container-fluid-->

