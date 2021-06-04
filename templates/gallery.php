<?php 
/* Template Name: Gallery Template */
get_header();

$m = get_field('hero');
$mod_num = 1;
include(get_stylesheet_directory() . '/modules/hero.php');

?>

<section class="gallery | module module-2">
    <div class="container-xxl">
        <div class="js-hidden row">
            <div class="col-xl-10 offset-xl-1">
                <div class="row mx-0 no-gutters">
                    <?php $img_count = 1; foreach(get_field('images') as $img) : ?>
                        <div class="gallery__img-container | col-lg-4 col-xl-3 p-1">
                            <div class="gallery__img u-border-img">
                                <div class="u-border-img__img-container">
                                    <img src="<?php echo $img['sizes']['medium']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>">
                                </div>
                                <span class="line-border"></span>
                            </div>
                        </div>
                    <?php $img_count++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include(get_stylesheet_directory() . '/modules/social_feed.php');


get_footer(); ?>

