<?php 
/*
    @package growuptheme
    ---------------- SINGLE POST TEMPLAE -------------------
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array( $class )); ?>>

    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title">', '</h1>') ?>

        <div class="entry-meta">
            <?php echo growup_posted_meta(); ?>
        </div>

    </header>

    <div class="entry-content clearfix">

        <?php the_content() ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo growup_posted_footer(); ?>
    </footer>

</article>