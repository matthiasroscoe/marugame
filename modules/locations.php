<section class="locations | u-rel module module-<?php echo $mod_num; ?>">
    <div class="container-xxl">
        <div class="row">
            <div class="locations__search | col-lg-10 offset-lg-1">
                <h1 class="t-white">Find your nearest kitchen</h1>
                <a href="#" class="locations__search__all js-show-all-locations | t-white t-underline">All locations</a>
                <div class="locations__search__buttons js-search-buttons is-active">
                    <a href="#" class="locations__search__button js-show-text-search">Search for a location</a>
                    <p class="locations__search__or-text | d-md-inline t-white px-md-4 py-4 mb-0">or</p>
                    <a href="#" class="locations__search__button locations__search__button--geolocation js-geolocate-locations">Use my current location</a>
                </div>
                <form class="locations__search__form js-search-locations">
                    <input class="locations__search__text js-text-search-locations" type="text" placeholder="Enter your location or postcode">
                    <a href="#" class="locations__search__submit c-btn c-btn--arrow js-search-locations-submit | d-block d-md-inline-block">Search for a location</a>
                </form>
            </div>
        </div>
        <div class="locations__grid | row">
            <div class="locations__grid__inner js-locations-grid | d-flex flex-wrap col-lg-10 offset-lg-1">
                <?php render_locations(); ?>
            </div>
        </div>
    </div>
</section>