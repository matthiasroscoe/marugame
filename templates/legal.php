<?php 
/* Template Name: Legal Template */
get_header();

$m = get_field('hero');
$m['page_content'] = get_field('page_content');
include(get_stylesheet_directory() . '/modules/hero.php');

get_footer();
?>

