<?php

/**
 * Allergens (Does Contain) taxonomy for products
 */

add_action( 'init', 'allergens_does_contain_setup', 0 );

function allergens_does_contain_setup() {
  $labels = array(
    'name'              => _x( 'Allergens (Does Contain)', 'taxonomy general name', 'marugame' ),
    'singular_name'     => _x( 'Allergen', 'taxonomy singular name', 'marugame' ),
    'search_items'      => __( 'Search Allergens', 'marugame' ),
    'all_items'         => __( 'All Allergens', 'marugame' ),
    'edit_item'         => __( 'Edit Allergen', 'marugame' ),
    'parent_item'       => __( 'Allergen', 'marugame' ),
    'parent_item_colon' => __( 'Allergen:', 'marugame' ),
    'update_item'       => __( 'Update Allergen', 'marugame' ),
    'add_new_item'      => __( 'Add New Allergen', 'marugame' ),
    'new_item_name'     => __( 'New Allergen Name', 'marugame' ),
    'menu_name'         => __( 'Allergens (Does Contain)', 'marugame' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'public'            => false,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'allergens-does-contain' ),
  );

  register_taxonomy( 'allergens-does-contain', array( 'product' ), $args );
}


/**
 * Allergens (May Contain) taxonomy for products
 */

add_action( 'init', 'allergens_may_contain_setup', 0 );

function allergens_may_contain_setup() {
  $labels = array(
    'name'              => _x( 'Allergens (May Contain)', 'taxonomy general name', 'marugame' ),
    'singular_name'     => _x( 'Allergen', 'taxonomy singular name', 'marugame' ),
    'search_items'      => __( 'Search Allergens', 'marugame' ),
    'all_items'         => __( 'All Allergens', 'marugame' ),
    'edit_item'         => __( 'Edit Allergen', 'marugame' ),
    'parent_item'       => __( 'Allergen', 'marugame' ),
    'parent_item_colon' => __( 'Allergen:', 'marugame' ),
    'update_item'       => __( 'Update Allergen', 'marugame' ),
    'add_new_item'      => __( 'Add New Allergen', 'marugame' ),
    'new_item_name'     => __( 'New Allergen Name', 'marugame' ),
    'menu_name'         => __( 'Allergens (May Contain)', 'marugame' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'public'            => false,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'allergens-may-contain' ),
  );

  register_taxonomy( 'allergens-may-contain', array( 'product' ), $args );
}