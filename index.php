<?php 
/*
    @package growuptheme
*/
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" roll="main">

            <?php if( is_paged() ): ?>
            <div class="container text-center load-previous-container">
                <div class="load-btn-container">
                  <a class="growup-load-btn growup-load-more" data-prev="1" data-page="<?php echo growup_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                    <span class="growup-load-icon"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                    <span class="text"> Load Previous</span>
                  </a>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="container growup-posts-container">
                <?php  
                  if( have_posts() ):

                    echo '<div class="page-limit" data-page="/' . growup_check_paged() . '" >';

                    while( have_posts() ): the_post();
                        $class = 'reveal';
                        set_query_var('post-class', $class);
                        get_template_part('template-parts/content', get_post_format() );
                    endwhile;

                    echo '</div>';
                  endif;
                ?>
            </div><!-- .container -->
            <div class="container text-center">
                  <div class="load-btn-container">
                    <a class="growup-load-btn growup-load-more" data-page="<?php echo growup_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                      <span class="growup-load-icon"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                      <span class="text"> Load More</span>
                    </a>
                  </div>
            </div>
        </main>
    </div> <!-- #primary -->

<?php get_footer(); ?>