<?php 
/*
    @package growuptheme
    ---------------- QUOTE POST FORMAT -------------------
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'growup-quote-format',$class) ); ?>>
    <header class="entry-header text-center">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                <h1 class="quote-content"><a href="<?php the_permalink(); ?>"><?php echo get_the_content(); ?></a></h1>
                <?php the_title( '<h2 class="quote-author">-', '-</h2>') ?>
            </div><!-- .col-md-8 -->
        </div><!-- .row -->
    </header>

    <footer class="entry-footer">
        <?php echo growup_posted_footer(); ?>
    </footer>
</article>