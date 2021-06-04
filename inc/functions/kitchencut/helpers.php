<?php 
/**
 * Gets all kitchen cut menu items as a big php arr
 * Allergen data is included in a sub-array for each item
 */

function get_all_kitchencut_items() {
    $data = get_kitchencut_items_by_page(1);
    $kc_items = $data->data;
    
    // API call only returns first 100 menu items, 
    // so if there are more pages we need to retrieve rest of the items.
    $total_pages = $data->meta->pagination->total_pages;
    if ($total_pages > 1) {
        for ($i=2; $i <= $total_pages; $i++) { 
            $next_page_items = get_kitchencut_items_by_page($i, 'items');
            $kc_items = array_merge($kc_items, $next_page_items);
        }
    }

    return $kc_items;
}

function get_kitchencut_items_by_page($page_num = 1, $return_type = 'all') {
    $curl = curl_init();
    $access_token = 'x2RigPWvtqoqF8SlEMihESQYFffhwHEoFZ1JRVSz';
        
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://marugame.kitchencut.com/kc-api/menu-items?per_page=100&page=' . $page_num,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $access_token,
            "cache-control: no-cache",
            "content-type: application/json",
        ),
    ));
        
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($return_type == 'items') {
        return json_decode($response)->data;
    }

    return json_decode($response);
}


/**
 * Gets all data for a single kitchencut item.
 */
function get_single_kitchencut_item($item_id = null) {
    if ($item_id == null) {
        return;
    }

    $curl = curl_init();
    $access_token = 'x2RigPWvtqoqF8SlEMihESQYFffhwHEoFZ1JRVSz';
        
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://marugame.kitchencut.com/kc-api/menu-items/' . $item_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $access_token,
            "cache-control: no-cache",
            "content-type: application/json",
        ),
    ));
        
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    return json_decode($response)->data;
}


/**
 * Returns all woocommerce products
 */

function get_all_woocommerce_products() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => array('draft', 'private', 'publish'),
        'fields' => 'ids',
    );

    return get_posts($args);
}