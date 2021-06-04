<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();

// TODO remove when live
if (is_single() && get_post_type() == 'location' && get_the_ID() != 148) {
    wp_redirect(get_the_permalink(148));
}

// Output flexible content modules
render_flexible_content_modules('modules');

get_footer();
