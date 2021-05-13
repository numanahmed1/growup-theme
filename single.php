<?php 
/*
    @package growuptheme
*/
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" roll="main">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-10 col-md-10 col-lg-10 offset-sm-1 offset-md-1 offset-lg-1">

                        <?php  
                        if( have_posts() ):

                            while( have_posts() ): the_post();
                                growup_save_post_views( get_the_ID() );
                                get_template_part('template-parts/single', get_post_format() );

                                echo growup_post_navigation();

                                if( comments_open() ):
                                    comments_template();
                                endif;
                                
                            endwhile;

                        endif;
                        ?>

                </div><!-- .col-lg-9 -->
                </div><!-- .row -->
            </div><!-- .container -->

        </main>
    </div> <!-- #primary -->

<?php get_footer(); ?>