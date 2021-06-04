<?php
/* Enquiry post type */
add_action( 'init', 'enquiry_post_type' );

function enquiry_post_type() {
    $labels = array(
        'name'               => _x( 'Enquiries', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Enquiry', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Enquiries', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Enquiry', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Enquiry', 'clockwise' ),
        'new_item'           => __( 'New Enquiry', 'clockwise' ),
        'edit_item'          => __( 'Edit Enquiry', 'clockwise' ),
        'view_item'          => __( 'View Enquiry', 'clockwise' ),
        'all_items'          => __( 'All Enquiries', 'clockwise' ),
        'search_items'       => __( 'Search Enquiries', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Enquiries:', 'clockwise' ),
        'not_found'          => __( 'No Enquiries found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No Enquiries found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Enquiries', 'clockwise' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'enquiry' ),
        'capability_type'    => 'post',
        'capabilities'       => array( 'create_posts' => 'do_not_allow' ),
        'map_meta_cap'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-testimonial',
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title' )
    );

    register_post_type( 'enquiry', $args );
}

?>