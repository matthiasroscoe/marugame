<?php 
    // Column alignment related vars
    $row_class = 'flex-lg-row-reverse justify-content-lg-between';
    $text_col_class = 'offset-xl-1';
    $img_col_class = 'col-lg-6';
    if ($m['flip_layout']) {
        $row_class = '';
        $text_col_class = '';
        $img_col_class .= ' offset-xl-1';
    }
    
    // Background related vars
    $bg_class = ($m['bg_colour'] == 'none') ? 'no-bg' : 'has-bg ' . $m['bg_colour'];
    $text_colour = ($m['bg_colour'] == 'red') ? 't-white' : '';
    if ($m['bg_colour'] == 'red') {
        $text_colour = 't-white';
        $btn_classes = 'c-btn--white mt-4';
    } else {
        $text_colour = '';
        $btn_classes = 'mt-4';
    }

    // Extra bottom spacing for if there is a bottom placed illustration
    $bot_spacing_class = ($mod_num == 5 && is_page('414')) ? ' has-noodle-hills' : '';
?>

<section class="content-img <?php echo $bg_class . $bot_spacing_class; ?> | d-flex flex-column flex-lg-row flex-center u-rel module module-<?php echo $mod_num; ?>">

    <div class="container-xxl">
        <div class="js-hidden | row align-items-lg-center <?php echo $row_class; ?>">
            <div class="<?php echo $img_col_class; ?>">
                <?php if ($m['image_type'] == 'image') : ?>
                    <div class="content-img__img u-border-img">
                        <div class="u-border-img__img-container">
                            <img src="<?php echo $m['image']['sizes']['large']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
                        </div>
                        <span class="line-border"></span>
                    </div>
                <?php elseif ($m['image_type'] == 'static_illustration') : ?>
                    <div class="content-img__img content-img__img--static-illustration">
                        <img class="u-fluid u-fluid--contain" src="<?php echo $m['image']['sizes']['large']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
                    </div>
                <?php else : ?>
                    <div class="content-img__lottie-container js-lottie-<?php echo $m['illustration']; ?> js-lottie-anim"></div>
                <?php endif; ?>
            </div>

            <div class="col-sm-8 col-lg-5 col-xl-4 <?php echo $text_col_class; ?>">
                <h1 class="t-heading <?php echo $text_colour; ?>"><?php echo $m['heading']; ?></h1>
                
                <?php if ($m['subheading']) : ?>
                    <h3 class="t-subheading <?php echo $text_colour; ?>"><?php echo $m['subheading'];?></h3>
                <?php endif; ?>
                
                <?php if ($m['text']) : ?>
                    <p class="<?php echo $text_colour; ?>"><?php echo $m['text']; ?></p>
                <?php endif; ?>

                <?php if ($m['button']) { echo get_arrow_button($m['button'], $btn_classes); } ?>
            </div>
        </div>
    </div>

    <?php if ($mod_num == 2 && is_single() && get_post_type() == 'location') : ?>
        <img class="content-img__stars d-none d-md-block" src="<?php echo get_icon('hero-stars.svg'); ?>" alt="Stars">
    <?php elseif ($mod_num == 5 && is_page('414')) : ?>
        <img class="content-img__noodle-hills" src="<?php echo get_icon('noodle-hills.svg'); ?>" alt="Noodles">
    <?php endif; ?>
</section>