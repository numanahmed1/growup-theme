<nav class="comment-navigation" role="navigation">

    <h3><?php esc_html_e( 'Comments Navigation', 'growuptheme' ); ?></h3>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="post-nav-link">
                <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                <?php previous_comments_link( esc_html__( 'Older Comments', 'growuptheme' ) ) ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 text-right">
            <div class="post-nav-link">
                <?php next_comments_link( esc_html__( 'Newer Comments', 'growuptheme' ) ) ?>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </div>
        </div>
    </div><!-- .row -->

</nav>