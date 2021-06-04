<?php

/**
 * Gets the user's location from co-ordinates passed from JS
 * Uses Google's Geolocation API
 */

add_action('wp_ajax_nopriv_get_current_user_location', 'get_current_user_location');
add_action('wp_ajax_get_current_user_location', 'get_current_user_location');

function get_current_user_location() {
    if ($_POST['long'] != '' && isset($_POST['long']) ) {
        $long = $_POST['long'];
    }
    if ($_POST['lat'] != '' && isset($_POST['lat']) ) {
        $lat = $_POST['lat'];
    }

    $api_key = get_field('google_api_key', 'option');

    if ($api_key && $long && $lat) {
        
        // Get json data
        $ch = curl_init();
        $request_url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key='.$api_key;
    
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    }
    
    wp_die();
}


/**
 * Get flexible content field, and display all modules
 */
function render_flexible_content_modules($field = NULL, $subdirectory = NULL) {
	if ($field == NULL) {
		$field = 'modules';
	}

	$queried_obj = get_queried_object();
	$modules = get_field($field, $queried_obj);
	$module_count = count($modules);
	$mod_num = 1;

	if ($modules) {
		foreach($modules as $m) {

			$layout = $m['acf_fc_layout'];
			$directory = '/modules/';
			if ($subdirectory != null) {
				$directory .= $subdirectory . '/';
			}

			$filepath = get_stylesheet_directory() . $directory . $layout . '.php';
			if (file_exists($filepath)) {
				include($filepath);
			} else {
				echo "No module exists at: $filepath";
			}

			$mod_num++;
		}
	}
}


/**
 * Get time since any specified post
 */

function get_time_since_published($post_id = null) {
	if ($post_id == null) {
		return;
	}

	$time_posted = get_post_time('U', $post_id);
	$time_diff = human_time_diff($time_posted);

    // Replace 'weeks', 'days'... with just 'w, d' and so on
    $time_diff = str_replace(' years', 'y ago', $time_diff);
    $time_diff = str_replace(' year', 'y ago', $time_diff);
    $time_diff = str_replace(' months', 'm ago', $time_diff);
    $time_diff = str_replace(' month', 'm ago', $time_diff);
    $time_diff = str_replace(' weeks', 'w ago', $time_diff);
    $time_diff = str_replace(' week', 'w ago', $time_diff);
    $time_diff = str_replace(' days', 'd ago', $time_diff);
    $time_diff = str_replace(' day', 'd ago', $time_diff);
    $time_diff = str_replace(' hours', 'h ago', $time_diff);
    $time_diff = str_replace(' hour', 'h ago', $time_diff);
    $time_diff = str_replace(' seconds', 's ago', $time_diff);
    $time_diff = str_replace(' second', 's ago', $time_diff); 

    return $time_diff;
}


/**
 * Adds custom classes to the array of body classes.
 */
function custom_body_classes( $classes ) {
	return $classes;
}
// add_filter( 'body_class', 'custom_body_classes' );


/**
 * Return image/icons filepaths
 * @return string
 */

function get_icon($icon = NULL) {
	if ($icon == NULL) {
		return;
	}
	return get_stylesheet_directory_uri() . '/library/images/icons/' . $icon;
}

function get_image($image = NULL) {
	if ($image == NULL) {
		return;
	}
	return get_stylesheet_directory_uri() . '/library/images/' . $image;
};


/**
 * Get 'back' link for Articles/Events/Team Member pages
 */

function get_back_link() {

	if (is_single()) {
		if (get_post_type() == 'event' || get_post_type() == 'article') {
			$community_page_id = 490;
			$post = pll_get_post($community_page_id, pll_current_language());
			return '<a class="hero__back-link | d-block text-white text-upper" href="' . get_the_permalink($post) . '">< ' . pll__('Back') . '</a>';
		}
		if (get_post_type() == 'career_case_study') {
			$team_page_id = 665;
			$post = pll_get_post($team_page_id, pll_current_language());
			return '<a class="hero__back-link | d-block text-white text-upper" href="' . get_the_permalink($post) . '">< ' . pll__('Back') . '</a>';
		}
		if (get_post_type() == 'job_vacancy') {
			$careers_page_id = 681;
			$post = pll_get_post($careers_page_id, pll_current_language());
			return '<a class="hero__back-link | d-block text-white text-upper" href="' . get_the_permalink($post) . '">< ' . pll__('Back') . '</a>';
		}
		if (get_post_type() == 'membership-plans') {
			$membership_page_id = 112;
			$post = pll_get_post($membership_page_id, pll_current_language());
			return '<a class="hero__back-link hero__back-link--memb-plan | d-block text-white text-upper" href="' . get_the_permalink($post) . '">< ' . pll__('All memberships') . '</a>';
		}
	}

	return false;
}


/**
 * Get sharing links for article/event/team member posts
 */

function get_sharing_link_data() {
	if (! is_single()) {
		return false;
	}

	$post_types = array('event', 'article', 'team_member', 'job_vacancy', 'career_case_study');
	if (in_array(get_post_type(), $post_types)) {
		$data = array(
			'Linkedin' => array(
				'url' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . get_permalink(),
				'icon_circle' => get_icon('linkedin--cream.svg'),
				'icon_small' => get_icon('linkedin-small--white.svg'),
			),
			'Twitter' => array(
				'url' => 'https://twitter.com/intent/tweet?url=' . get_permalink(),
				'icon_circle' => get_icon('twitter--cream.svg'),
				'icon_small' => get_icon('twitter-small--white.svg'),
			),
			'Facebook' => array(
				'url' => 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink(),
				'icon_circle' => get_icon('facebook--cream.svg'),
				'icon_small' => get_icon('facebook-small--white.svg'),
			)
		);

		return $data;
	}

	return false;
}


/**
 * Get button html
 */

function get_button($data=null, $classlist=null) {
	if ($data == null) {
		return;
	}

	ob_start();
	?>	
		<a href="<?php echo $data['url']; ?>" class="c-btn <?php if ($classlist) { echo $classlist; } ?>" target="<?php echo $data['target']; ?>" title="<?php echo $data['title']; ?>"><?php echo $data['title']; ?></a>
	<?php

	return ob_get_clean();
}


/**
 * Get arrow button html
 */

function get_arrow_button($data=null, $classlist=null) {
	if ($data == null) {
		return;
	}

	$icon_url = get_icon('arrow--white.svg');

	ob_start();
	?>	
		<a href="<?php echo $data['url']; ?>" class="c-btn c-btn--arrow <?php if ($classlist) { echo $classlist; } ?>" target="<?php echo $data['target']; ?>" title="<?php echo $data['title']; ?>"><?php echo $data['title']; ?></a>
	<?php

	return ob_get_clean();
}


/**
 * Get user's nearest marugame location
 * Uses Haversine formula to get distance between two sets of coords: https://thisinterestsme.com/php-haversine-formula-function/
 */

add_action('wp_ajax_nopriv_get_user_nearest_location', 'get_user_nearest_location');
add_action('wp_ajax_get_user_nearest_location', 'get_user_nearest_location');

function get_user_nearest_location() {

	function getDistance($lat1, $lng1, $lat2, $lng2) {
		$earth_radius = 6371;
	 
		$dLat = deg2rad($lat2 - $lat1);
		$dLon = deg2rad($lng2 - $lng1);
	 
		$a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
		$c = 2 * asin(sqrt($a));
		$d = $earth_radius * $c;
	 
		return $d;
	}

	// User's lat/lng
	$lat = (isset($_POST['lat'])) ? $_POST['lat'] : null;
	$lng = (isset($_POST['lng'])) ? $_POST['lng'] : null;
	$region = (isset($_POST['region'])) ? $_POST['region'] : null;
	
	$locations = get_locations_by_region($region);

	$distances = array();
	foreach($locations as $loc){
		if (get_field('google_maps', $loc)) {
			$map = get_field('google_maps', $loc);
			$distances[$loc] = getDistance($lat, $lng, $map['lat'], $map['lng']);
		}
	}

	// Sort with nearest location first
	asort($distances);

	// Get ID of nearest location
	$nearest_id = key($distances);

	echo $nearest_id;
	wp_die();

}



/**
 * Generate image srcset from ACF image array
 */

//Generate image srcset from ACF image
function generate_srcset($sizes, $max_width=NULL) {
    if ( is_null($sizes) || strpos($sizes['thumbnail'], '.svg') !== false ) {
      	return;
	}

    $wp_image_sizes = get_intermediate_image_sizes();
    $excluded_sizes = array('thumbnail', 'medium_large', 'large', '1536x1536', '2048x2048');
    $srcset_image_sizes = array();
    $output = '';
    $has_max_width = false;

    if ( !is_null($max_width) ) {
		$has_max_width = true;
		$max_width = intval($max_width);
    }

    $i = 0; foreach ($wp_image_sizes as $image) {
		if ( !in_array($image, $excluded_sizes) ) {
			
			if ( !in_array_r($sizes[$image.'-width'], $srcset_image_sizes) ) {
				if ( $has_max_width ) {
					if ( $sizes[$image.'-width'] <= $max_width ) {
						$srcset_image_sizes[$i]['url'] = $sizes[$image];
						$srcset_image_sizes[$i]['width'] = $sizes[$image.'-width'];
					}
				} else {
						$srcset_image_sizes[$i]['url'] = $sizes[$image];
						$srcset_image_sizes[$i]['width'] = $sizes[$image.'-width'];
				}
			}

			$i++;
		}
    }

    usort($srcset_image_sizes, function($a, $b) {
        return $a['width'] - $b['width'];
    });   

    $i = 1; foreach($srcset_image_sizes as $image_size) {
      	$output .= $image_size['url'] . ' ' . $image_size['width'] . 'w';

      	if ( $i != count($srcset_image_sizes) ) {
        	$output .= ', ';
		  }
		  
		$i++; 
	}

    return $output;
}

function in_array_r($needle, $haystack, $strict = false) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
			return true;
		}
	}

	return false;
}