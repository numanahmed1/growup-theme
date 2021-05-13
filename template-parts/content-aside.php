<?php 
/*
    @package growuptheme
    ---------------- ASIDE POST FORMAT -------------------
*/
$class = get_query_var('post-class');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array('growup-aside-format',$class ) ); ?>>
    <div class="aside-container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 text-center">
                <?php if( growup_get_attachment() ): ?>
                    <div class="aside-featured background-image" style="background-image: url( <?php echo growup_get_attachment(); ?>); "></div><!-- .aside-featured -->
                <?php endif; ?>
            </div><!-- .col-md-2 -->
            <div class="col-xs-12 col-sm-12 col-md-10">

                <div class="aside-main-area">
                
                    <header class="entry-header">
                        <div class="entry-meta">
                            <?php echo growup_posted_meta(); ?>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <div class="entry-excerpt">
                            <?php the_content() ?>
                        </div>
                    </div><!-- .entry-content -->

                </div><!-- .aside-main-area -->
            </div><!-- .col-md-10 -->
        </div><!-- .row -->

        <footer class="entry-footer">
            <div class="row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <?php echo growup_posted_footer(); ?>
                </div><!-- .col-md-10 -->
            </div><!-- .row -->
        </footer>
        
    </div><!-- .aside-container -->
</article>