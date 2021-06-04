<?php

/**
 * Pulls in menu items allergen data from KitchenCut
 * and stores data in WooCommerce product ACF fields
 */

function sync_kitchencut_with_woocommerce() {
    // Get all KC items & WC products
    $kc_items = get_all_kitchencut_items();
    $woo_products = get_all_woocommerce_products();

    // Loop through all products
    foreach($woo_products as $product_id) {
        // Wipe any existing tags from the product
        wp_delete_object_term_relationships($product_id, array('allergens-does-contain', 'allergens-may-contain'));

        // See if the Bistro PLU matches a KitchenCut item code
        $plu = get_field('delivery_and_packaging', $product_id);

        foreach($kc_items as $item) {
            $code = $item->code;

            if ($code == $plu) {
                $does_contain = $item->allergens->does_contain;
                $does_contain_tags = get_allergens_tags($does_contain);
                wp_set_post_terms($product_id, $does_contain_tags, 'allergens-does-contain', false);
                
                $may_contain = $item->allergens->may_contain;
                $may_contain_tags = get_allergens_tags($may_contain);
                wp_set_post_terms($product_id, $may_contain_tags, 'allergens-may-contain', false);
            }
        }
    }
}

function get_allergens_tags($allergens = null) {
    $allergens_arr = array();

    foreach($allergens as $allergen) {
        $allergens_arr[] = $allergen->name;
    }

    return $allergens_arr;
}

/**
 * Set up CRON actions
 */

if (! wp_next_scheduled('daily_kc_sync')) {
    wp_schedule_event('1621404000', 'daily', 'daily_kc_sync');
}

add_action('daily_kc_sync', 'sync_kitchencut_with_woocommerce');

function print_cron_tasks() {
    echo '<pre>'; print_r( _get_cron_array() ); echo '</pre>';
}