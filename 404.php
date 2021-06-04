<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();

// Hero
$mod_num = 1;
$m = array();
$m['image'] = array(
    'url' => get_site_url() . '/wp-content/uploads/2021/04/About-us-header-image@2x.jpg',
    'title' => '404 Error',
    'alt' => '404 Error',
);
$m['title'] = 'Error 404: Page could not be found.';
include(get_stylesheet_directory() . '/modules/hero.php');

echo '<br><br>';
	
get_footer();