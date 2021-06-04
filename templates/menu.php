<?php 
/* Template Name: Menu Template */
get_header();

$temp_img = array(
    'url' => 'https://marugame-full.local/wp-content/uploads/2021/05/Our-Menus-header-image@2x.jpg',
    'alt' => 'Temp Image',
    'title' => 'Temp Image',
);

$m = get_field('hero');
$mod_num = 1;
include(get_stylesheet_directory() . '/modules/hero.php');

// sync_kitchencut_with_woocommerce();
?>


<div class="menu-filter-popup">
    <div class="menu-filter-popup__bg | u-fluid"></div>
    <div class="menu-filter-popup__inner">
        <h1 class="t-heading t-white">Nutritional Filter</h1>
        <div class="menu-filter-popup__allergens pt-3">
            <p class="t-white">Hide items that contain:</p>
            <?php 
                $does_contain_terms = get_terms('allergens-does-contain', array(
                    'hide_empty' => true,
                ));
                $may_contain_terms = get_terms('allergens-does-contain', array(
                    'hide_empty' => true,
                ));
                if ($terms) : ?>
                    <div class="menu-filter-popup__buttons | d-flex align-items-center flex-wrap">
                        <?php foreach($does_contain_terms as $term) : 
                            
                            if ($term->slug) {

                            }
                            ?>
                            <a href="#" class="menu-filter-popup__button js-allergen-filter-btn" data-term-slug="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif;
            ?>
        </div>
        <a href="#" class="menu-filter-popup__submit js-menu-filter-submit">Save Changes</a>
    </div>
</div>

<section class="menu-filter | module module-2">
    <div class="container-xxl">
        <div class="row">

            <div class="col-xl-10 offset-xl-1">
                <div class="menu-filter__top | d-flex align-items-lg-center justify-content-between mb-5">
                    <h1 class="t-heading mb-0">Explore the menu</h1>
                    <div class="actions">
                        <a href="#" class="js-view-full-menu c-btn c-btn--outline c-btn--outline--red">View Full Menu</a>
                        <a href="#" class="js-open-menu-filter-popup c-btn c-btn--red ml-3">Dietary Requirements</a>
                    </div>
                </div>

                <p class="menu-filter__subtitle">Search by category</p>

                <div class="menu-filter__categories d-flex flex-wrap">
                <?php // TODO update $cats once live
                    $cats = get_term_children('225', 'product_cat');
                    
                    $featured_cats = array(226, 227, 228, 229);
                    foreach($cats as $cat_id) : 
                        $cat = get_term_by('id', $cat_id, 'product_cat');
                        // $img = get_field('')
                        $cat_class = (in_array($cat->term_id, $featured_cats)) ? '' : 'menu-filter__cat--small'; ?>
                        <div class="menu-filter__cat <?php echo $cat_class; ?> | u-pointer" data-cat-id="<?php echo $cat->term_id; ?>">
                            <div class="inner | d-flex flex-center u-rel">
                                <div class="u-border-img">
                                    <div class="u-border-img__img-container">
                                        <img src="<?php echo $temp_img['url']; ?>" srcset="<?php echo generate_srcset($temp_img['sizes']); ?>" alt="<?php echo $temp_img['alt']; ?>" loading="lazy">
                                    </div>
                                    <span class="line-border"></span>
                                </div>
                                <h2 class="title | u-rel mb-0"><?php echo $cat->name; ?></h2>
                            </div>
                        </div>
                    <?php endforeach; 
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="menu | module-3">
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <div class="menu__items-container js-menu-items-container">
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$m = array(
    'module_design' => 'red',
    'heading' => get_field('signup_title'),
    'text' => get_field('signup_text'),
);
$module_count = 4; $mod_num = 4;
include(get_stylesheet_directory() . '/modules/club_signup.php');
?>

<?php get_footer(); ?>