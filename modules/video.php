<section class="video js-video | u-rel module module-<?php echo $mod_num; ?>">
    <?php // Show stars svg illustration before module
    if (is_page('414')) : ?>
        <img src="<?php echo get_icon('kids-stars.svg'); ?>" alt="Stars" class="video__stars">
        <div class="video__stars-spacer"></div>
    <?php endif; ?>

    <div class="video__inner | u-rel">
        <div class="container-fluid">
            <div class="js-hidden | row">
                <div class="video__video-container | u-rel col-12">
                    <?php $video_poster = ($m['cover_image']) ? 'poster="' . $m['cover_image']['sizes']['large'] . '"' : ''; ?>
                    <video 
                        src="<?php echo $m['desktop_video']; ?>" 
                        <?php echo $intro_poster; ?>
                        class="videoEl videoEl--desktop <?php if ($m['mobile_video']) { echo 'd-none d-md-block'; } else { echo 'd-block'; } ?> u-fluid" preload="metadata" loop muted playsinline disableremoteplayback>
                    </video>
                    <?php if ($m['mobile_video']) : ?>
                        <video 
                            src="<?php echo $m['mobile_video']; ?>" 
                            <?php echo $intro_poster; ?>
                            class="videoEl videoEl--mobile d-block d-md-none u-fluid" preload="metadata" loop muted playsinline disableremoteplayback>
                        </video>
                    <?php endif; ?>
                    <div class="video__close js-video-close u-pointer">
                        <img src="<?php echo get_icon('close-icon.svg'); ?>" alt="Close Video">
                    </div>
                </div>
            </div>
            <div class="video__content js-video-title is-active | row align-items-center">
                <div class="video__title-container col-md-8 col-lg-6 offset-lg-1">
                    <h1 class="t-heading t-white mb-0 u-pointer"><?php echo $m['title']; ?></h1>
                </div>
                <div class="video__play-icon | col-auto d-lg-none">
                    <img class="u-pointer" src="<?php echo get_icon('play-video.svg'); ?>" alt="Play Video">
                </div>
            </div>
        </div>
    </div>
</section>