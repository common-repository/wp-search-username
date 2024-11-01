<?php
/*
Plugin Name: WP Search Username
Plugin URI: https://www.wordpress.org/plugins/wp-search-username/
Description: Find the username from the author in your WordPress site.
Version: 1.0
Author: Robin Grasmeijer
Author URI: http://wordpress.com/
Text Domain: WP Search Username
*/

add_action( 'wp_enqueue_scripts', 'wp_search_username_scripts' );

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'wpsu_searchusernamewidget_register_widgets' );
 //register our widget
 // constructor
    function wpsu_searchusernamewidget_register_widgets() {
    register_widget( 'wpsu_searchusername_widget' );
}

//wpsu_searchusername_widget class
class wpsu_searchusername_widget extends WP_Widget {
    //process the new wp search username widget
    // new constructor
    function __construct() {
        $widget_ops = array( 
			'classname' => 'wpsu_searchusernamewidget_widget_class', 
			'description' => ' ' 
			); 
        parent::__construct( 'wpsu_searchusername_widget', 'WP Search Username Widget', $widget_ops );
    }
 
     //build the wp search username widget settings form
    function form($instance) {
        $defaults = array( 'title' => 'Search Username' ); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        ?>
            <p>Title: <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"  type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <?php
    }
 
    //save the wp search username widget settings
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
 
        return $instance;
    }
 
    //display wp search username the widget
    function widget($args, $instance) {
        extract($args);
 
        echo $before_widget;
        $title = apply_filters( 'widget_title', $instance['title'] );
 
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		//display search username form
		wpsu_search_form();
        echo $after_widget;
    }
}

add_action( 'pre_get_posts', 'wpsu_searchusername_query' );
//Builds the wp search username form
function wpsu_search_form(){ 
?>

                <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="s"><h2><?php _x( 'Search Username', 'label' ); ?></h2></label>
                <input type="text" id="author" name="q=author&author_name" value="" placeholder="Search for ...">		
		<input type="submit" value="Search" />
	</form>
<?php
}


// WP Shortcode to display WP search username form on any page or post.
function wpsu_form_creation(){

?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>"><br>
		<label class="screen-reader-text" for="s">Search Username: </label>
                <input type="text" id="author" name="q=author&author_name" value="" placeholder="Search for ...">		
		<input type="submit" value="Search" />
</form><br>

<?php
}

add_shortcode('search-username', 'wpsu_form_creation');

