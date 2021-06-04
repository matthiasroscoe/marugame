<?php
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'enqueue_css_js' );
function enqueue_css_js() {
	// Remove default outdated jquery (updated version re-added in vendors folder)
	wp_deregister_script('jquery');

	// Enqueue main stylesheet.
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/library/dist/css/styles.min.css?debug='.date('U') );

	// Enqueue gsap.
	wp_enqueue_script('gsap-core', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js', '', '', true);

	// Enqueue main js file.
	wp_enqueue_script( 'main', get_template_directory_uri() . '/library/dist/js/main.min.js?debug='.date('U'), '', '', true );
	wp_localize_script( 'main', 'scriptVars', array(
		'ajaxUrl'  => admin_url('admin-ajax.php'),
		'siteUrl'  => get_site_url(),
		) 
	);
}

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */

function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' );
} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );


?>
