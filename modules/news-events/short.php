<?php
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'fields' => 'ids',
);
$posts = get_posts($args);
if ($posts) : 
?>
    <section class="news-events-short | u-rel module module-<?php echo $mod_num; ?>">
        <div class="container-xxl">
            <div class="row">
                <div class="news-events-short__intro | col-xl-10 offset-xl-1 d-flex align-items-center justify-content-between">
                    <h1 class="t-heading mb-0"><?php echo $m['title']; ?></h1>
                    <?php 
                        $btn_data = array(
                            'url' => '/whats-new',
                            'target' => '_self',
                            'title' => 'View All',
                        );
                        echo get_arrow_button($btn_data, 'd-none d-lg-inline-block');
                    ?>
                </div>
                <div class="news-events-short__inner js-news-events-slider | col-xl-10 offset-xl-1">
                    <?php if ($posts[0]): 
                        $img = get_field('thumbnail', $posts[0]); ?>
                        <div class="news-events-short__article news-events-short__article--large js-thumb-hover">
                            <img class="news-events-short__article__img js-thumb-img" src="<?php echo $img['sizes']['large']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                            <div class="news-events-short__article__content">
                                <h2 class="t-thumb-heading t-thumb-heading--large"><?php echo get_the_title($posts[0]); ?></h2>
                                <p class="description"><?php echo get_field('description', $posts[0]); ?></p>
                                <?php 
                                    $btn_data = array(
                                        'url' => get_the_permalink($posts[0]),
                                        'title' => __('Read More'),
                                        'target' => '_self',
                                    );
                                    echo get_button($btn_data, 'd-lg-none mt-3');
                                ?>
                                <img class="arrow d-none d-lg-block" src="<?php echo get_icon('thumbnail-arrow.svg'); ?>" alt="View Article">
                            </div>
                            <a class="news-events-short__article__link d-none d-lg-block u-fluid" href="<?php the_permalink($posts[0]); ?>"></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($posts[1]): 
                        $img = get_thumbnail_image($posts[1]); ?>
                        <div>
                            <div class="news-events-short__article news-events-short__article--top-right">
                                <img class="news-events-short__article__img js-thumb-img" src="<?php echo $img['sizes']['medium']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                                <div class="news-events-short__article__content">
                                    <h2 class="t-thumb-heading"><?php echo get_the_title($posts[1]); ?></h2>
                                    <!-- <p class="description"><?php echo get_field('description', $posts[1]); ?></p> -->
                                    <?php 
                                        $btn_data = array(
                                            'url' => get_the_permalink($posts[1]),
                                            'title' => __('Read More'),
                                            'target' => '_self',
                                        );
                                        echo get_button($btn_data, 'd-lg-none mt-3');
                                    ?>
                                    <img class="arrow d-none d-lg-block" src="<?php echo get_icon('thumbnail-arrow.svg'); ?>" alt="View Article">
                                </div>
                                <a class="news-events-short__article__link d-none d-lg-block u-fluid" href="<?php the_permalink($posts[1]); ?>"></a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($posts[2]): 
                        $img = get_thumbnail_image($posts[2]); ?>
                        <div>
                            <div class="news-events-short__article">
                                <img class="news-events-short__article__img js-thumb-img" src="<?php echo $img['sizes']['medium']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                                <div class="news-events-short__article__content">
                                    <h2 class="t-thumb-heading"><?php echo get_the_title($posts[2]); ?></h2>
                                    <!-- <p class="description"><?php echo get_field('description', $posts[2]); ?></p> -->
                                    <?php 
                                        $btn_data = array(
                                            'url' => get_the_permalink($posts[2]),
                                            'title' => __('Read More'),
                                            'target' => '_self',
                                        );
                                        echo get_button($btn_data, 'd-lg-none mt-3');
                                    ?>
                                    <img class="arrow d-none d-lg-block" src="<?php echo get_icon('thumbnail-arrow.svg'); ?>" alt="View Article">
                                </div>
                                <a class="news-events-short__article__link d-none d-lg-block u-fluid" href="<?php the_permalink($posts[2]); ?>"></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="news-events-short__bottom | col-xl-10 offset-xl-1 d-lg-none">
                    <div class="slider-arrows | d-flex align-items-center justify-content-between d-lg-none">
                        <a href="#" class="c-slider-arrow c-slider-arrow--prev js-slick-prev"></a>
                        <a href="#" class="c-slider-arrow c-slider-arrow--next js-slick-next"></a>
                    </div>
                    <?php 
                        $btn_data = array(
                            'url' => get_site_url() . '/news-and-events/',
                            'title' => 'News & Events Feed',
                            'target' => '_self',
                        );
                        echo get_button($btn_data, 'c-btn--outline c-btn--outline--red mt-4 mt-lg-5');
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>