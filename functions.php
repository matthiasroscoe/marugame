<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// General theme setup
require('inc/setup/theme-setup.php');
include('inc/functions/contact-form.php');

// Acteol related function
include('inc/functions/acteol/add-contact.php');
include('inc/functions/acteol/update-contact.php');

// Menu related functions
include('inc/functions/kitchencut/product-sync.php');
include('inc/functions/kitchencut/admin-page.php');
include('inc/functions/kitchencut/helpers.php');
include('inc/functions/menu/get-menu.php');

// Helpers
include('inc/functions/helpers/news-events.php');
include('inc/functions/helpers/locations.php');

// Enqueue styles/scripts
require('inc/setup/enqueues.php');

// Custom post types & taxonomies
require('inc/cpt/location.php');
require('inc/cpt/enquiries.php');
require('inc/cpt/wc-product.php');

// Functions
require('inc/functions/misc.php');