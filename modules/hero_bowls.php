<?php $module_appearance = ($m['appearance'] == 'large') ? 'large' : 'normal'; ?>
<section class="hero-bowls hero-bowls--<?php echo $module_appearance; ?> | module module-<?php echo $mod_num; ?> u-rel">

    <div class="hero-bowls__inner hero-bowls__inner--<?php echo $module_appearance; ?> | container-xxl u-h100 u-rel">
        
        <?php // If large design of module, show title and subheading above images on mobile only
        if ($m['appearance'] == 'large') : ?>
            <div class="row d-lg-none">
                <div class="hero-bowls__content js-hidden | col">
                    <h1 class="t-heading d-lg-none"><?php echo $m['heading']; ?></h1>
                    <?php if ($m['subheading']) : ?>
                        <h3 class="t-subheading d-lg-none"><?php echo $m['subheading']; ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="hero-bowls__images-container">
            <div class="hero-bowls__images hero-bowls__images--<?php echo $module_appearance; ?> js-hero-bowls-images">
                <picture class="shadow is-active">
                    <img class="shadow is-active" src="<?php echo get_image('Shadow.png'); ?>">
                </picture>
                <?php if ($module_appearance == 'large') : ?>
                    <picture class="bowl js-bowl js-bowl-1 is-active">
                        <source srcset="<?php echo get_image('Bowl-Above-NoShaddow-1.webp'); ?>" type="image/webp">
                        <img class="shadow is-active" src="<?php echo get_image('Bowl-Above-NoShaddow-1.png'); ?>">
                    </picture>
                    <picture class="bowl js-bowl js-bowl-2">
                        <source srcset="<?php echo get_image('Bowl-Above-NoShaddow-3.webp'); ?>" type="image/webp">
                        <img class="shadow is-active" src="<?php echo get_image('Bowl-Above-NoShaddow-3.png'); ?>">
                    </picture>
                    <picture class="bowl js-bowl js-bowl-3">
                        <source srcset="<?php echo get_image('Bowl-Above-NoShaddow-4.webp'); ?>" type="image/webp">
                        <img class="shadow is-active" src="<?php echo get_image('Bowl-Above-NoShaddow-4.png'); ?>">
                    </picture>
                    <picture class="bowl js-bowl js-bowl-4">
                        <source srcset="<?php echo get_image('Bowl-Above-NoShaddow-5.webp'); ?>" type="image/webp">
                        <img class="shadow is-active" src="<?php echo get_image('Bowl-Above-NoShaddow-5.png'); ?>">
                    </picture>
                <?php else : ?>
                    <img class="bowl js-bowl js-bowl-1 is-active" src="<?php echo $m['image']['url']; ?>" alt="<?php echo $m['image']['alt']; ?>">
                <?php endif; ?>
            </div>
        </div>

        <div class="row u-h100 align-items-end align-items-lg-center">
            <div class="hero-bowls__content js-hidden | col-md-8 col-lg-5 offset-lg-6">
                <h1 class="t-heading <?php if ($module_appearance == 'large') { echo 'd-none d-lg-block'; } ?>"><?php echo $m['heading']; ?></h1>
                <?php if ($m['subheading']) : ?>
                    <h3 class="t-subheading <?php if ($module_appearance == 'large') { echo 'd-none d-lg-block'; } ?>"><?php echo $m['subheading']; ?></h3>
                <?php endif; ?>
                <?php if ($m['text']) : ?>
                    <p class="hero-bowls__text <?php if ($module_appearance == 'large') { echo 'hero-bowls__text--large'; } ?>"><?php echo $m['text']; ?></p>
                <?php endif; ?>
                <?php 
                    if ($m['button']) {
                        echo get_arrow_button($m['button'], 'c-btn--large');
                    }
                ?>
            </div>
        </div>
    </div>

    <?php // Noodle bowl svg illustration
    if ($mod_num == 2 && is_page('213')) : ?>
        <img src="<?php echo get_icon('noodle-pile.svg'); ?>" alt="Noodles" class="hero-bowls__noodle-pile" loading="lazy">
        <div class="hero-bowls__noodle-pile-spacer d-md-none"></div>
    <?php endif; ?>
</section>