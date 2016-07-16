<?php
/*
Plugin Name: Messages
Plugin URI: https://vphone.io/
Description: Declares a plugin that will create a custom post type for messages
Version: 1.0
License: GPLv2
*/


add_action( 'init', 'create_message_post_type' );
add_action( 'save_post', 'add_message', 10, 2 );



function create_message_post_type() {
    register_post_type( 'message',
        array(
            'labels' => array(
                'name' => 'Messages',
                'singular_name' => 'Message',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Message',
                'edit' => 'Edit',
                'edit_item' => 'Edit Message',
                'new_item' => 'New Message',
                'view' => 'View',
                'view_item' => 'View Message',
                'search_items' => 'Search Messages',
                'not_found' => 'No Messages found',
                'not_found_in_trash' => 'No Messages found in Trash',
                'parent' => 'Parent Message'
            ),

            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
}



function add_message( $message_id, $message ) {
    // Check post type for message type
    if ( $message->post_type == 'message' ) {
        // Store data in post meta table if present in post data
        // if ( isset( $_POST['movie_review_director_name'] ) && $_POST['movie_review_director_name'] != '' ) {
        //     update_post_meta( $movie_review_id, 'movie_director', $_POST['movie_review_director_name'] );
        // }
        // if ( isset( $_POST['movie_review_rating'] ) && $_POST['movie_review_rating'] != '' ) {
        //     update_post_meta( $movie_review_id, 'movie_rating', $_POST['movie_review_rating'] );
        // }
    }
}
