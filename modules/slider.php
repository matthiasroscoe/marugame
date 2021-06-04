<section class="slider | module module-<?php echo $mod_num; ?>">
    <div class="container-xxl">
        <div class="js-hidden | row">
            <div class="slider__intro | col-lg-6 col-xl-5 offset-xl-1">
                <h1 class="t-heading t-white"><?php echo $m['title']; ?></h1>
                <?php if ($m['subheading']) : ?>
                    <h3 class="t-subheading t-black"><?php echo $m['subheading']; ?></h3>
                <?php endif; ?>
                <?php if ($m['introduction']) : ?>
                    <p class="t-white"><?php echo $m['introduction']; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="js-hidden | row">
            <div class="col-auto offset-xl-1 offset-xxl-0 px-0">
                <div class="slider__slides js-slider">
                    <?php foreach($m['slides'] as $s) : ?>
                        <div class="slider__slide js-matchHeight">
                            <?php if ($s['image']) : ?>
                                <img src="<?php echo $s['image']['sizes']['medium']; ?>" alt="<?php echo $s['image']['alt']; ?>">
                            <?php endif; ?>
                            <h3><?php echo $s['title']; ?></h3>
                            <p class="mb-0"><?php echo $s['text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" class="c-slider-arrow c-slider-arrow--next js-slick-next"></a>
                <a href="#" class="c-slider-arrow c-slider-arrow--prev js-slick-prev"></a>
            </div>
        </div>
    </div>
</section>