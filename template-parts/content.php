<?php 
/*
    @package growuptheme
    ---------------- STANDARD POST FORMAT -------------------
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array( $class )); ?>>
    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h1>') ?>
        <div class="entry-meta">
            <?php echo growup_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content">

        <?php if( growup_get_attachment() ): ?>
            <a href="<?php the_permalink(); ?>" class="stanard-featured-link">
                <div class="standard-featured background-image" style="background-image: url( <?php echo growup_get_attachment(); ?>); "></div><!-- .standard-featured -->
            </a>
        <?php endif; ?>

        <div class="entry-excerpt">
            <?php the_excerpt() ?>
        </div>
        
        <div class="button-container text-center">
            <a href="<?php the_permalink(); ?>" class="btn growup-btn"><?php _e( 'Read More' ); ?></a>
        </div>
    </div> <!-- .entry-content -->
    <footer class="entry-footer">
        <?php echo growup_posted_footer(); ?>
    </footer>
</article>