<?php

/* Locations post type */
add_action( 'init', 'location_post_type' );

function location_post_type() {
    $labels = array(
        'name'               => _x( 'Locations', 'post type general name', 'marugame' ),
        'singular_name'      => _x( 'Location', 'post type singular name', 'marugame' ),
        'menu_name'          => _x( 'Locations', 'admin menu', 'marugame' ),
        'name_admin_bar'     => _x( 'Location', 'add new on admin bar', 'marugame' ),
        'add_new'            => _x( 'Add New', 'menu', 'marugame' ),
        'add_new_item'       => __( 'Add New Location', 'marugame' ),
        'new_item'           => __( 'New Location', 'marugame' ),
        'edit_item'          => __( 'Edit Location', 'marugame' ),
        'view_item'          => __( 'View Location', 'marugame' ),
        'all_items'          => __( 'All Locations', 'marugame' ),
        'search_items'       => __( 'Search Locations', 'marugame' ),
        'parent_item_colon'  => __( 'Parent Locations:', 'marugame' ),
        'not_found'          => __( 'No locations found.', 'marugame' ),
        'not_found_in_trash' => __( 'No locations found in Trash.', 'marugame' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Locations', 'marugame' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'location' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-building',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'location', $args );
}


?>