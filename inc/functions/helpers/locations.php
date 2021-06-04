<?php 

add_action('wp_ajax_search_locations', 'search_locations');
add_action('wp_ajax_nopriv_search_locations', 'search_locations');

function search_locations() {
    $posted_search_term = (isset($_POST['search_term'])) ? $_POST['search_term'] : null;
    $search_term = filter_var($posted_search_term, FILTER_SANITIZE_STRING);
    $api_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
    $api_key = get_field('google_maps_api_key', 'option');
    
    // If no search term retrieved, just display all locations in name order
    if ($search_term == 'all' || $search_term == null || ! $api_key) {
        render_locations();
        wp_die();
    }
    
    // Get searched location data from Google Maps API
    $curl_url = $api_url . urlencode($search_term) . '&key=' . $api_key;
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_RETURNTRANSFER => 1,
	  CURLOPT_URL => $curl_url,
	));
	$response = json_decode(curl_exec($curl));
	curl_close($curl);

    $search_lat = $response->results[0]->geometry->location->lat;
	$search_lng	= $response->results[0]->geometry->location->lng;

    $closest_locations = array();
    $all_locations = get_posts(array(
        'post_type' => 'location',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ));

    // Foreach location, get locations within 200 miles of user.
    foreach($all_locations as $loc) {
        $map_data = get_field('google_map', $loc);
        if ($map_data) {
            $distance = get_distance_between_coords($search_lat, $search_lng, $map_data['lat'], $map_data['lng']);
    
            if ($distance < 200) {
                $closest_locations[] = array(
                    'id' => $loc,
                    'distance' => $distance,
                );
            }
        }
    }

    // Sort locations by proximity
    function compare_distance($a, $b) {
        return $a['distance'] - $b['distance'];
    }
    usort($closest_locations, 'compare_distance');
    
    // Echo out locations
    if (empty($closest_locations)) {
        echo get_no_locations_html();
    } else {
        render_locations($closest_locations);
    }

    wp_die();
}


/**
 * Gets and echoes location cards
 */
function render_locations($locations = null) {
    $html = '';

    // If no locations specified, get all locations in alphabetical order.
    if ($locations == null) {
        $location_ids = get_posts(array(
            'post_type' => 'location',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'fields' => 'ids',
        ));

        foreach($location_ids as $loc) {
            $html .= get_location_card($loc);
        }

        echo $html;
    } else {
        foreach($locations as $loc) {
            $html .= get_location_card($loc['id'], $loc['distance']);
        }

        echo $html;
    }

    return;
}


/**
 * Gets single location card html
 */
function get_location_card($location_id = null, $distance = null) {
    $html = '';
    
    if ($location_id) {
        $img = get_field('mobile_image', $location_id) ? get_field('mobile_image', $location_id) : get_field('image', $location_id);
        $is_coming_soon = (get_field('location_status', $location_id) == 'coming_soon') ? true : false;
        ob_start();
        ?>
            <a class="location-card <?php if ($is_coming_soon) { echo 'is-coming-soon'; } ?> d-block" href="<?php echo get_the_permalink($location_id); ?>" title="<?php echo get_the_title($location_id); ?>">
                <div class="location-card__inner u-rel">
                    <div class="u-border-img">
                        <div class="u-border-img__img-container">
                            <img class="location-card__img" src="<?php echo $img['sizes']['medium']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                        </div>
                        <div class="location-card__img-gradient"></div>
                        <span class="line-border"></span>
                    </div>
                    
                    <h2><span class="title-bg"><?php echo get_the_title($location_id); ?>&nbsp; &nbsp;
                        <div class="arrow d-inline-block u-rel">
                            <img class="arrow-1" src="<?php echo get_icon('arrow--red.svg'); ?>" alt="Arrow">
                            <img class="arrow-2" src="<?php echo get_icon('arrow--red.svg'); ?>" alt="Arrow">
                        </div>
                    </h2>
                    <h2><span class="title-text"><?php echo get_the_title($location_id); ?>&nbsp; &nbsp;
                        <div class="arrow d-inline-block u-rel">
                            <img class="arrow-1" src="<?php echo get_icon('arrow--red.svg'); ?>" alt="Arrow">
                            <img class="arrow-2" src="<?php echo get_icon('arrow--red.svg'); ?>" alt="Arrow">
                        </div>
                    </h2>
    
                    <?php if ($is_coming_soon) : ?>
                        <span class="location-card__overlay | u-fluid d-flex flex-center">
                            <p class="location-card__overlay__text d-flex flex-center t-center"><?php echo $coming_soon_text = (get_field('coming_soon_text', $location_id)) ? get_field('coming_soon_text', $location_id) : 'Coming Soon'; ?></p>
                        </span>
                    <?php endif; ?>

                    <?php if ($distance && ! $is_coming_soon) : 
                        $distance_text = ($distance < 1) ? round($distance, 1) : round($distance, 0);
                        $distance_text .= ($distance < 1.5) ? ' mile away' : ' miles away'
                        ?>
                        <p class="location-card__distance"><?php echo $distance_text; ?></p>
                    <?php endif; ?>
                </div>
            </a>
        <?php
        $html = ob_get_clean();
    }

    return $html;
}


/**
 * @link https://thisinterestsme.com/php-haversine-formula-function/
 */
function get_distance_between_coords($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 3959; // Use 6371 instead to return distance in kilometres.
    
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lng2 - $lng1);
    
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;
    
    return $d;
}


/**
 * Gets html for if a location search return no locations
 */

function get_no_locations_html() {
    ob_start();
    ?>
        <div class="locations__grid__no-locations">
            <h2 class="t-subheading t-black">There are currently no locations near you.</h1>
            <a class="c-btn js-show-all-locations" href="#">View all locations</a>
        </div>
    <?php
    echo ob_get_clean();
}

?>