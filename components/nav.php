<div class="nav">
    <div class="nav__video-container | d-none d-lg-inline-flex u-rel">
        <a href="<?php echo get_site_url(); ?>" class="nav__desktop-logo c-logo">
            <img class="c-logo__symbol" src="<?php echo get_icon('logo-symbol.svg'); ?>" alt="Marugame Logo">
            <img class="c-logo__text" src="<?php echo get_icon('logo-text--white.svg'); ?>" alt="Marugame">
        </a>    
        <video 
            src="<?php echo get_site_url() . '/wp-content/uploads/2021/03/LandingPage-Mobile-3mbps.mp4'; ?>" 
            class="nav__video u-fluid"
            preload="metadata"
            loop autoplay muted playsinline disableremoteplayback>
        </video>
    </div>
    <div class="nav__inner | u-rel container-fluid d-flex flex-column">
        <div class="row u-rel">
            <div class="nav__top js-nav-anim-elem | col d-flex align-items-center justify-content-lg-end mr-lg-8">
                <img class="nav__mobile-logo d-lg-none" src="<?php echo get_icon('logo-symbol--black.svg'); ?>" alt="Marugame">
                
                <?php if (get_field('order_online_link', 'option')) : $btn = get_field('order_online_link', 'option'); ?>
                    <a href="<?php echo $btn['url']; ?>" class="c-btn c-btn--arrow c-btn--white | mr-3" target="<?php echo $btn['target']; ?>" title="<?php echo $btn['title']; ?>"><?php echo $btn['title']; ?></a>
                <?php endif; ?>

                <?php if (get_field('marugame_club_sign_in', 'option')) : $btn = get_field('marugame_club_sign_in', 'option'); ?>
                    <a href="<?php echo $btn['url']; ?>" class="c-btn c-btn--arrow c-btn--white | mr-3" target="<?php echo $btn['target']; ?>" title="<?php echo $btn['title']; ?>"><?php echo $btn['title']; ?></a>
                <?php endif; ?>

                <img class="nav__close js-close-nav d-lg-none" src="<?php echo get_icon('close-icon.svg'); ?>" alt="Close Menu">
                <div class="nav__close nav__close--desktop js-close-nav | d-none d-lg-flex flex-center">
                    <img src="<?php echo get_icon('close-icon-no-box.svg'); ?>" alt="Close Navigation">
                </div>
            </div>
        </div>
        <div class="row u-rel">
            <div class="nav__primary-menu | col">
                <?php 
                    $links = get_field('menu_links', 'option');
                    foreach($links as $link) : ?>
                        <div class="nav__link js-nav-anim-elem">
                            <?php if ($link['add_dropdown_menu']) : ?>
                                <a class="parent-link d-inline-block u-rel has-dropdown js-nav-link-parent" data-barba-prevent href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                                <div class="dropdown-container js-nav-dropdown">
                                    <?php foreach($link['dropdown_links'] as $link) : ?>
                                        <a class="dropdown-link d-block" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <a class="parent-link d-inline-block u-rel" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach;
                ?>
            </div>
        </div>
        <div class="row u-rel flex-grow-1">
            <div class="nav__bottom | col d-flex flex-column justify-content-end">
                <div class="nav__socials js-nav-anim-elem">
                    <?php if (get_field('instagram', 'option')) : ?>
                        <a class="d-inline-block" href="<?php the_field('instagram', 'option'); ?>" target="_blank" title="Instagram">
                            <img class="d-block" src="<?php echo get_icon('instagram.svg'); ?>" alt="Instagram">
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('facebook', 'option')) : ?>
                        <a class="d-inline-block" href="<?php the_field('facebook', 'option'); ?>" target="_blank" title="Facebook">
                            <img class="d-block" src="<?php echo get_icon('facebook.svg'); ?>" alt="Facebook">
                        </a>
                    <?php endif; ?>
                    <?php if (get_field('twitter', 'option')) : ?>
                        <a class="d-inline-block" href="<?php the_field('twitter', 'option'); ?>" target="_blank" title="Twitter">
                            <img class="d-block" src="<?php echo get_icon('twitter.svg'); ?>" alt="Twitter">
                        </a>
                    <?php endif; ?>
                </div>
                <div class="nav__secondary-menu js-nav-anim-elem">
                    <?php 
                        $links = get_field('mobile_menu_secondary_links', 'option');
                        foreach($links as $link) : ?>
                            <a class="nav__secondary-menu__link d-inline-block" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                        <?php endforeach;
                    ?>
                </div>
                <div class="nav__credits d-flex justify-content-between js-nav-anim-elem">
                    <span>Website by <a href="https://ignitecreates.com" target="_blank" title="Ignite">Ignite</a></span>
                    <span>&copy; Marugame <?php echo date('Y'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>