<?php 
    get_header(); 
    $product = wc_get_product(get_the_ID());
    $bistro_plu = get_field('delivery_and_packaging');
    if ($bistro_plu) {
        $kc_data = get_single_kitchencut_item($bistro_plu)->allergens;
    }
?>
<section class="product-summary">
    <div class="container-xxl">
        <a class="product-summary__back-link | d-inline-block u-rel" href="/menu">Back to Menu</a>
        <div class="row">
            <div class="img-col | order-lg-2 col-lg-5">
                <div class="u-border-img u-rel">
                    <div class="u-border-img__img-container">
                        <img src="https://marugame-full.local/wp-content/uploads/2021/05/Our-Menus-header-image@2x.jpg" alt="" loading="lazy">
                    </div>
                    <span class="line-border"></span>
                </div>
            </div>
            <div class="content-col | order-lg-1 col-lg-5 offset-xl-1">
                <h1 class="t-heading mb-1"><?php the_title(); ?></h1>
                <!-- <p class="japanese-text">名前はここに行きます</p> -->
                <div class="tags"></div>
                <p class="description"><?php the_content(); ?></p>
                <p class="price mt-4"><?php echo $product->get_price(); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- <section class="nutritional-info">
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-9 offset-xl-1">
                <h1>Nutritional Information</h1>
                <h3 class="t-subheading">Sub title will go here</h3>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                <div class="nutritional-info__boxes">
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                    <div class="nutritional-info__box">
                        <p class="label">Calories</p>
                        <p class="value">528 kcal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<?php if ($kc_data) : 
    if (!empty($kc_data->does_contain) && !empty($kc_data->may_contain)) : ?>
<section class="product-allergens | bg-red">
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-6 offset-xl-1">
                <h1 class="t-white">Allergens</h1>
                
                <?php if (! empty($kc_data->does_contain)) : ?>
                    <p class="t-white"><?php echo get_field('allergens_does_contain_text', 'option'); ?></p>
                    <div class="product-allergens__list | mt-2">
                        <?php foreach($kc_data->does_contain as $item) : ?>
                            <div class="item | d-inline-block t-white"><?php echo $item->name; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (! empty($kc_data->may_contain)) : ?>
                    <p class="t-white"><?php echo get_field('allergens_may_contain_text', 'option'); ?></p>
                    <div class="product-allergens__list | mt-2">
                        <?php foreach($kc_data->may_contain as $item) : ?>
                            <div class="item | d-inline-block t-white"><?php echo $item->name; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <p class="t-white"><?php echo get_field('allergens_small_text', 'option'); ?></p>
            </div>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<?php get_footer(); ?>