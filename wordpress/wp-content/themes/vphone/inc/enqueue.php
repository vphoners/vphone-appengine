<?php
/**
 * understrap enqueue scripts
 *
 * @package understrap
 */

function understrap_scripts() {
    if ( !is_page_template('page-templates/fronpage.php') ) {
      wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), '0.4.3');
      wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), '0.4.3', true );
    } else {
      wp_enqueue_style( 'frontpage-styles', get_stylesheet_directory_uri() . '/css/frontpage.min.css', array(), '0.4.3');
      wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '0.4.3');
      wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array(), '0.4.3');
    }
    wp_enqueue_script('jquery');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );

/**
*Loading slider script conditionally
**/

if ( is_active_sidebar( 'hero' ) ):
add_action("wp_enqueue_scripts","understrap_slider");

function understrap_slider(){
    if ( is_front_page() ) {
    $data = array(
    	"timeout"=>get_theme_mod( 'understrap_theme_slider_time_setting', 5000 ),
    	"items"=>get_theme_mod( 'understrap_theme_slider_count_setting', 1 )
    	);

    wp_enqueue_script("understrap-slider-script", get_stylesheet_directory_uri() . '/js/slider_settings.js', array(), '0.4.3');
    wp_localize_script( "understrap-slider-script", "understrap_slider_variables", $data );
    }
}
endif;
