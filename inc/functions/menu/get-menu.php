<?php

/**
 * Returns HTML for the complete menu, broken into category
 * Can be filtered by allergens or dietary-reqs
 */
add_action('wp_ajax_nopriv_get_menu', 'get_menu');
add_action('wp_ajax_get_menu', 'get_menu');

function get_menu() {
    $allergens = (isset($_POST['allergens'])) ? $_POST['allergens'] : false;
    $dietary_reqs = (isset($_POST['dietary_reqs'])) ? $_POST['dietary_reqs'] : false;

    // Get menu items for each category
    $cats = get_term_children('225', 'product_cat');
    $html = '';
    if ($cats) : foreach($cats as $cat_id) {
        $cat = get_term_by('id', $cat_id, 'product_cat');
        $html .= get_menu_category($cat, $allergens, $dietary_reqs);
    } endif;

    echo $html;
    wp_die();
}


/**
 * Returns HTML for a menu category
 */

function get_menu_category($cat, $allergens = false, $dietary_reqs = false) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids',
    );

    $args['tax_query'] = array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $cat->term_id,
        )
    );
        
    if ($allergens) {
        // tax_query for taxonomies NOT in Allergens
        $args['tax_query'][] = array(
            'taxonomy' => 'allergens-does-contain',
            'field' => 'slug',
            'terms' => $allergens,
        );
        $args['tax_query'][] = array(
            'taxonomy' => 'allergens-may-contain',
            'field' => 'slug',
            'terms' => $allergens,
        );
    }
    if ($dietary_reqs) {
        // tax_query for taxonomies in Dietary Reqs
        // $args['tax_query'] = array(
        // );
    }
    
    $menu_items = get_posts($args);
    

    $html = '';
    if (! empty($menu_items)) {
        $html = '<div class="menu__category" data-cat-id="' . $cat->term_id . '">';
        $html .= '<h1 class="menu__category__title">' . $cat->name . '</h1>';
        $html .= '<p class="menu__category__description">' . $cat->description . '</p>';
        $html .= '<div class="menu__category__items | d-flex flex-wrap align-items-start">';
            
        foreach($menu_items as $item) {
            $html .= get_menu_item($item);
        }

        $html .= '</div></div>';
    }

    return $html;
}


/**
 * Return HTML for a menu item
 */

function get_menu_item($item_id = null) {
    if ($item_id == null) {
        return '';
    }
    $product = wc_get_product($item_id);
    $img = (get_the_post_thumbnail_url($item_id, 'small')) ? get_the_post_thumbnail_url($item_id, 'small') : 'https://marugame-full.local/wp-content/uploads/2021/05/Our-Menus-header-image@2x.jpg';
    ob_start();
    ?>
    <div class="menu__category__item js-matchHeight">
        <a href="<?php echo get_permalink($item_id); ?>" class="inner | d-flex flex-column u-rel u-pointer" data-item="<?php echo $item_id; ?>">
            <img class="d-block u-rel" src="<?php echo $img; ?>" alt="<?php echo get_the_title($item_id); ?>">
            <p class="japanese mb-1"><?php // echo get_japanese_text($item_id); ?></p>
            <h2><?php echo get_the_title($item_id); ?></h2>
            <!-- <p></p> -->
            <div class="tags">
                <span class="price"><?php echo $product->get_price(); ?></span>
            </div>
        </a>
    </div>
    <?php
    return ob_get_clean();
}