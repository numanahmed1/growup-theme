<?php
/*
    @package growuptheme
    
	===========================
	   Widget Class
	===========================
*/
class Growup_Profile_widget extends WP_Widget{
    // Setup the widget name, description etc
    public function __construct(){
        $widget_ops = array(
            'classname'    => 'growup_profile_widget',
            'description'   => 'Custom Growup Widget Profile',
        );
        parent:: __construct( 'growup_profile', 'Growup Profile', $widget_ops );
    }

    //Back-end dispaly of widgets
    public function form( $instance ){
        echo '<p><strong>No options for this widgets!</strong><br>You can control the fields of this widget from <a href="./admin.php?page=wpliveware_growup">This page</a></p>';
    }

    // Front-end dispaly of widgets
    public function widget( $args, $instance ){
        $profile = esc_attr( get_option( 'profile_picture' ) );
        $firstName = esc_attr( get_option( 'first_name' ) );
        $lastName = esc_attr( get_option( 'last_name' ) );
        $fullName = $firstName. ' '.$lastName;
        $description = esc_attr( get_option( 'user_description' ) );
    
        $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
        $facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
        $instagram_icon = esc_attr( get_option( 'instragram_handler' ) );

        echo $args['before_widget'];
        ?>
            <div class="text-center">
                <div class="image-container">
                    <div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php echo $profile; ?>);"></div>
                </div>
                <h1 class="growup-username"><?php echo $fullName; ?></h1>
                <h2 class="growup-description"><?php echo $description; ?></h2>
                <div class="icons-wrapper">

                    <?php if( !empty( $twitter_icon ) ): ?>
                       <a href="https://twitter.com/<?php echo $twitter_icon; ?>" target="_blank"><i class="fa fa-twitter growup-icon-sidebar" aria-hidden="true"></i></a>
                    <?php endif; 
                    if( !empty( $facebook_icon ) ): ?>
                      <a href="https://facebook.com/<?php echo $facebook_icon; ?>" target="_blank"><i class="fa fa-facebook growup-icon-sidebar" aria-hidden="true"></i></a> 
                    <?php endif; 
                    if( !empty( $instagram_icon ) ): ?>
                       <a href="https://instagram.com/<?php echo $instagram_icon; ?>" target="_blank"><i class="fa fa-instagram growup-icon-sidebar" aria-hidden="true"></i></a>
                    <?php endif; ?>

                </div>
            </div>
        <?php
        echo $args['after_widget'];
    }
}
add_action( 'widgets_init', function(){
    register_widget( 'Growup_Profile_widget' );
});

/* Edit Default Wordpres Widget */
 function growup_tag_cloud_font_change( $args ){

    $args['smallest'] = 8;
    $args['largest'] = 8;

    return $args;
 }
 add_filter( 'widget_tag_cloud_args', 'growup_tag_cloud_font_change' );

 function sunset_list_categories_output_change( $links ) {
	
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	
	return $links;
	
}
add_filter( 'wp_list_categories', 'sunset_list_categories_output_change' );

/*  Save Posts views  */
function growup_save_post_views( $postID ){
    $metaKey = 'growup_post_views';
    $views = get_post_meta( $postID, $metaKey, true );

    $count = ( empty( $views ) ? '0' : $views );
    $count++;

    update_post_meta( $postID, $metaKey, $count );
}
remove_action( 'wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );

/*  Popular Post Widget  */

class growup_Popular_Posts_Widget extends WP_Widget{
        // Setup the widget name, description etc
        public function __construct(){
            $widget_ops = array(
                'classname'    => 'growup-popular-posts-widget',
                'description'   => 'Popular Posts Widget',
            );
            parent:: __construct( 'growup_popular_posts', 'Growup Popular Posts', $widget_ops );
        }

        // Back-end Display of widget
        public function form( $instance ){
            $title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Popular Posts' );
            $tot = ( !empty( $instance[ 'tot' ] ) ? absint( $instance[ 'tot' ] ) : 4 );

            $output = '<p>';
            $output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
            $output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" 
            name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"/>';
            $output .= '</p>';

            $output .= '<p>';
            $output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts:</label>';
            $output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" 
            name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '"/>';
            $output .= '</p>';

            echo $output;
        }
        // Update Widget
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
            $instance[ 'tot' ] = ( !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 );

            return $instance;
        }

        // Front-end display of widget
        public function widget( $args, $instance ){

            $tot = absint( $instance[ 'tot' ] );

            $posts_args = array(
                'post_type'             => 'post',
                'posts_per_page'        => $tot,
                'meta_key'              => 'growup_post_views',
                'orderby'               => 'meta_value_num',
                'order'                 => 'DESC'
            );

            $posts_query = new WP_Query( $posts_args );

            echo $args[ 'before_widget' ];

                if( !empty( $instance[ 'title' ] ) ):
                    echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
                endif;

                if( $posts_query->have_posts() ):
                    //echo '<ul>';
                        while( $posts_query->have_posts() ) : $posts_query->the_post();
                            echo '<div class="media mb-2">';
                            echo '<img class="mr-3" src="' . get_template_directory_uri() . '/image/post-' . ( get_post_format() ? get_post_format() : 'standard' ) . '.png" alt="' . get_the_title() . '"/>';
                            echo '<div class="media-body">';
                            echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
                            echo '<div class="row"><div class="col-xs-12 sidebar-comments">'. growup_posted_footer( true ) .'</div></div>';
                            echo '</div>';
                            echo '</div>';
                        endwhile;
                    //echo '</ul>';
                endif;

            echo $args[ 'after_widget' ];
        }
}
add_action( 'widgets_init',function() {
    register_widget( 'growup_Popular_Posts_Widget' );
} );