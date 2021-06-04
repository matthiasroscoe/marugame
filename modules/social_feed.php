<section class="social-feed | u-rel module module-<?php echo $mod_num; ?>">
    <div class="js-hidden | container-xxl">
        <div class="row">
            <div class="social-feed__intro | col-xl-10 offset-xl-1 u-px-mob-15 mb-lg-4 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between">
                <h1 class="t-heading">Social Feeds</h1>
                <div class="social-feed__follow | d-flex align-items-center">
                    <span>Follow us on</span>
                    <?php if (get_field('instagram', 'option')) : ?>
                        <a class="d-flex flex-center" href="<?php echo get_field('instagram', 'option'); ?>" target="_blank">
                            <img src="<?php echo get_icon('insta-no-bg--white.svg'); ?>" alt="Instagram">
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('facebook', 'option')) : ?>
                        <a class="d-flex flex-center" href="<?php echo get_field('facebook', 'option'); ?>" target="_blank">
                            <img src="<?php echo get_icon('facebook-no-bg--white.svg'); ?>" alt="Facebook">
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('twitter', 'option')) : ?>
                        <a class="d-flex flex-center" href="<?php echo get_field('twitter', 'option'); ?>" target="_blank">
                            <img src="<?php echo get_icon('twitter-no-bg--white.svg'); ?>" alt="Twitter">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 offset-xl-1 u-px-15">
                <div class="social-feed__images | d-flex flex-wrap">
                    <?php $images = get_field('social_feed', 'option');
                    foreach($images as $image) : $img = $image['image'];?>
                        <div class="social-feed__image | px-2" href="<?php echo get_field('instagram','option'); ?>" target="_blank" title="Instagram">
                            <div class="social-feed__image__inner u-border-img">
                                <div class="u-border-img__img-container">
                                    <img src="<?php echo $img['sizes']['medium']; ?>" src="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                                </div>
                                <span class="line-border"></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>