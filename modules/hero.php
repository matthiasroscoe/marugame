<?php 
    $content_col_class = 'col-lg-7';
    if (is_page_template('templates/legal.php')) {
        $content_col_class = 'col-lg-10 col-xl-8';
    } else if (is_page_template('templates/contact.php')) {
        $content_col_class = 'col-lg-8';
    }
?>

<section class="hero | u-rel module module-<?php echo $mod_num; ?>">
    <?php 
    $desk_image_class = ($m['mobile_image']) ? 'd-none d-md-block' : '';
    if ($m['mobile_image']) { ?>
        <img class="hero__img | u-fluid d-md-none" src="<?php echo $m['mobile_image']['url']; ?>" alt="<?php echo $m['mobile_image']['alt']; ?>">
    <?php } ?>
    <img class="hero__img | u-fluid <?php echo $desk_image_class; ?>" src="<?php echo $m['image']['url']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>">
    <div class="hero__gradient | u-fluid"></div>

    <div class="container-xxl">
        <div class="row">
            <div class="hero__top | <?php echo $content_col_class; ?>">
                <?php if (get_post_type() == 'location' && is_single()) : ?>
                    <a class="back-link | u-rel d-none d-lg-block" href="<?php echo get_permalink(135); ?>">Back to all kitchens</a>
                <?php endif; ?>
            </div>
            <div class="hero__content | <?php echo $content_col_class; ?>">
                <div class="hero__content__inner">
                    <?php if (get_post_type() == 'location' && is_single()) : ?>
                        <a class="back-link | u-rel d-inline-block d-lg-none" href="<?php echo get_permalink(135); ?>">Back to all kitchens</a>
                    <?php endif; ?>

                    <h1 class="t-heading"><?php echo $m['title']; ?></h1>
                    <?php if ($m['subheading']) : ?>
                        <h3 class="t-subheading t-red"><?php echo $m['subheading']; ?></h3>
                    <?php endif; ?>
                    
                    <?php // If location, include address
                    if (is_single() && get_post_type() == 'location') : 
                        if (get_field('address')) : ?>
                        <p class="hero__address-title">Address</p>
                        <img class="hero__stars d-md-none" src="<?php echo get_icon('hero-stars.svg'); ?>" alt="Stars">
                        <p class="hero__address"><?php the_field('address'); ?></p>
                        <?php if (get_field('google_maps_link')) : ?>
                            <p><a class="hero__google-maps-link" href="<?php the_field('google_maps_link'); ?>" title="Google Maps Link" target="_blank">View in Google Maps</a></p>
                        <?php endif;
                        endif;
                    endif; ?>

                    <?php if ($m['text']) : ?>
                        <p><?php echo $m['text']; ?></p>
                    <?php endif; ?>

                    <?php // On legal template, output wysiwyg content
                        if (is_page_template('templates/legal.php')) : ?>
                            <div class="c-wysiwyg">
                                <?php echo $m['page_content']; ?>
                            </div>
                        <?php endif;
                    ?>

                    <?php // On contact page, output buttons
                        if (is_page_template('templates/contact.php')) : ?>
                            <div class="hero__buttons mt-4">
                                <a href="#" class="js-cf-button c-btn c-btn--small mb-2 mr-2" title="General Enquiry" data-enquiry-type="General Enquiry">General Enquiry</a>
                                <a href="#" class="js-cf-button c-btn c-btn--small c-btn--outline c-btn--outline--red mb-2 mr-2" title="Press Enquiry" data-enquiry-type="Press Enquiry">Press Enquiry</a>
                                <a href="#" class="js-cf-button c-btn c-btn--small c-btn--outline c-btn--outline--red mb-2 mr-2" title="Feedback" data-enquiry-type="Feedback">Feedback</a>
                            </div>
                        <?php endif;

                        // 404 page home button
                        if (is_404()) : ?>
                            <div class="hero__buttons mt-4">
                                <?php 
                                    $btn_data = array(
                                        'url' => get_site_url(),
                                        'title' => 'Return Home',
                                        'target' => '_self',
                                    );
                                    echo get_arrow_button($btn_data); 
                                ?>
                            </div>
                        <?php endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</section>