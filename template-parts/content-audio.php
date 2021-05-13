<?php 
/*
    @package growuptheme
    ---- Audio Post Format
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'growup-audio-format',$class ) ); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h1>') ?>
        <div class="entry-meta">
            <?php echo growup_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content">
        
        <?php echo growup_get_embedded_media( array( 'audio', 'iframe' ) ); ?>

    </div> <!-- .entry-content -->
    <footer class="entry-footer">
        <?php echo growup_posted_footer(); ?>
    </footer>
</article>