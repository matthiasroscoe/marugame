<div class="hero-video js-hero-video | module module-<?php echo $mod_num; ?> u-rel">
    <div class="hero-video__inner u-fluid d-flex flex-column flex-center">
        <video 
            src="<?php echo $m['mobile_video']; ?>" 
            class="hero-video__video d-sm-none u-fluid" 
            preload="metadata" 
            poster="<?php echo $m['mobile_image']['url']; ?>"
            loop autoplay muted playsinline disableremoteplayback>
        </video>
        <video 
            src="<?php echo $m['desktop_video']; ?>" 
            class="hero-video__video d-none d-sm-block u-fluid" 
            preload="metadata" 
            poster="<?php echo $m['desktop_image']['url']; ?>"
            loop autoplay muted playsinline disableremoteplayback>
        </video>

        <div class="hero-video__content | col-auto t-center u-rel">
            <h1 class="t-white"><?php echo $m['heading']; ?></h1>
            <p class="t-white"><?php echo $m['text']; ?></p>
            <?php 
                if ($m['button']) {
                    echo get_arrow_button($m['button']);
                }
            ?>
        </div>

        <div class="hero-video__scroll js-scroll-below-video | t-center u-pointer">
            <p>Discover Marugame</p>
            <img src="<?php echo get_icon('hero-scroll-down.svg'); ?>" alt="Scroll Down">
        </div>
    </div>
</div>