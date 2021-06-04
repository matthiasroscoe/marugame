<section class="images | module module-<?php echo $mod_num; ?>">
    <div class="container-xxl">
        <div class="row">
            <?php if (! $m['has_two_images']) : ?>
                <div class="images__img-container js-hidden | col-12">
                    <div class="images__img-container__inner | u-rel">
                        <img class="images__img-container__img | u-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>">
                        <p class="images__img-container__caption | mb-0"><?php echo $m['caption']; ?></p>
                    </div>
                </div>
            <?php else : ?>
                <div class="images__img-container images__img-container--half js-hidden | col-lg-6">
                    <div class="images__img-container__inner | u-rel">
                        <img class="images__img-container__img | u-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>">
                        <p class="images__img-container__caption | mb-0"><?php echo $m['caption']; ?></p>
                    </div>
                </div>
                <div class="images__img-container images__img-container--half js-hidden | col-lg-6">
                    <div class="images__img-container__inner | u-rel">
                        <img class="images__img-container__img | u-fluid" src="<?php echo $m['second_image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($m['second_image']['sizes']); ?>" alt="<?php echo $m['second_image']['alt']; ?>">
                        <p class="images__img-container__caption | mb-0"><?php echo $m['second_caption']; ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>