<?php 
/*
    @package growuptheme
    ---------------- Link POST FORMAT -------------------
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'growup-link-format', $class) ); ?>>
    <header class="entry-header text-center">
        <?php 
            $link = growup_grab_url();
            the_title( '<h1 class="entry-title"><a href="' .$link. '" target="_blank">', '<div class="link-icon"><i class="fa fa-link" aria-hidden="true"></i></div></a></h1>');
        ?>
    </header>
</article>