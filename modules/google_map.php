<section class="google-map | u-rel module module-<?php echo $mod_num; ?>">
    <?php 
        $map = get_field('google_map', $m['location']); 
        $map_icon = (get_field('map_icon', $m['location'])) ? get_field('map_icon', $m['location'])['url'] : get_icon('map-icon-kitchen.svg');
    ?>        
    <div id="map-container" data-map='<?php echo json_encode($map); ?>' data-map-icon="<?php echo $map_icon; ?>"></div>

    <div class="google-map__content js-hidden | container-xxl">
        <div class="row">
            <div class="google-map__content__inner | col-lg-6 col-xl-5 offset-lg-1">
                <h1 class="t-heading"><?php echo $m['map_heading']; ?></h1>
                <?php if (get_field('address', $m['location'])) : ?>
                    <p class="google-map__subtitle">Address</p>
                    <p class="google-map__address"><?php the_field('address', $m['location']); ?></p>
                <?php endif; ?>

                <?php if (get_field('google_maps_link', $m['location'])) {
                    $btn_data = array(
                        'url' => get_field('google_maps_link', $m['location']),
                        'title' => 'View in Google Maps',
                        'target' => '_blank',
                    );
                    echo get_button($btn_data, 'mt-2 mb-4');
                } ?>

                <?php if (get_field('nearest_tube', $m['location'])) : ?>
                    <p class="google-map__subtitle">Nearest tube station</p>
                    <p><?php the_field('nearest_tube', $m['location']); ?></p>
                <?php endif; ?>
                    
                <?php if (get_field('nearest_station', $m['location'])) : ?>
                    <p class="google-map__subtitle">Nearest station</p>
                    <p><?php the_field('nearest_station', $m['location']); ?></p>    
                <?php endif; ?>
                
                <?php $opening_times = get_field('opening_times', $m['location']);
                if (!empty($opening_times)) : ?>
                    <div class="google-map__opening-times">
                        <p class="google-map__subtitle">Opening times</p>
                        <?php foreach(get_field('opening_times', $m['location']) as $key => $value) : ?>
                            <p><span class="t-black"><?php echo ucwords($key); ?></span>&nbsp;&nbsp;<?php echo $value; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>        
        </div>
    </div>
</section>