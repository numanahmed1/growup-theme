<?php 
/*
    @package growuptheme
    ---- Gallery Post Format
*/
//$detect = new Mobile_Detect;
global $detect;

$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'growup-gallery-format', $class) ); ?>>

    <?php if( growup_get_attachment() && !$detect->isMobile() && !$detect->isTablet() ): ?>

    <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide growup-carousel-thumb" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
                $attachments = growup_get_bs_slides( growup_get_attachment(7) );

                foreach( $attachments as $attachment ):
            ?>

            <div class="carousel-item <?php echo $attachment['class']; ?> background-image gallery-featured" 
            style="background-image: url( <?php echo  $attachment['url']; ?> )">
                <div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
                <div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>

                <div class="entry-excerpt image-caption">
                    <p><?php echo $attachment['caption']; ?></p>
                </div>
            </div>

                <?php  endforeach; ?>
        </div><!-- .carousel-inner -->
        <a class="carousel-control-prev show-preview" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
            <div class="preview-container">
                <span class="thumbnail-container background-image"></span>
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </div><!-- .preview-container -->
        </a>
        <a class="carousel-control-next show-preview" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
            <div class="preview-container">
                <span class="thumbnail-container background-image"></span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </div><!-- .preview-container -->
        </a>
    </div><!-- .carousel -->
    <?php endif; ?>

    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h1>') ?>
        <div class="entry-meta">
            <?php echo growup_posted_meta(); ?>
        </div>
    </header>

    <div class="entry-content">
        
        <?php if( growup_get_attachment() && ( $detect->isMobile() || $detect->isTablet() ) ): ?>
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