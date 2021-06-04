<?php 
/**
 * Create the admin page in wordpress dashboard
 */
add_action('admin_menu', 'create_admin_page');
function create_admin_page() {
    add_menu_page('KitchenCut Sync', 'KitchenCut API', 'manage_options', 'kitchencut-sync', 'kitchencut_admin_page', 'dashicons-analytics');
}

/**
 * Enqueue stylesheet and scripts
 */
add_action( 'admin_enqueue_scripts', 'load_kitchencut_page_assets' );
function load_kitchencut_page_assets() {
    if (isset($_GET['page']) && $_GET['page'] == 'kitchencut-sync') {
        wp_enqueue_script( 'kitchencut-sync-js', get_template_directory_uri() . '/library/dist/js//kitchencut-admin.js', array('jquery'), '1.0', true );
    }
    wp_enqueue_style( 'kitchencut-sync-css', get_template_directory_uri() . '/library/dist/css/kitchencut-admin.css', false, '1.0.0' );
}

/**
 * Output content for the admin page
 */
function kitchencut_admin_page() {
    ?>
        <div class="kc-admin-page">
            <div class="intro">
                <h1>Synchronise WooCommerce with KitchenCut</h1>
                <?php // TODO display number of products not yet synced. ?>
            </div>
                
            <div class="sync">
                <form method="post" name="kitchencut_sync" enctype="multipart/form-data">
                    <input type="submit" name="submit_sync" value="Synchronise" class="btn">
                </form>
            </div>

            <img class="logo" src="<?php echo get_icon('logo-symbol--black.svg'); ?>" alt="Marugame">

            <div class="loading js-loading">
                <div class="loading__inner">
                    <img src="<?php echo get_icon('loading.svg'); ?>">
                    <h3>Synchronising...</h3>
                    <p>Please wait a few moments for the operation to complete.</p>
                </div>
            </div>
        </div>
    <?php
}