/**
 * Gets all menu items via AJAX call
 */

function initMenu() {
    if ($('.js-menu-items-container').length) {
        get_menu_items(false, false);
        menuScrollingLinks();
        menuFilter();
    }
}

function get_menu_items(dietaryReqs, allergens) {

    const container = $('.js-menu-items-container');
    
    let data = {
        action: 'get_menu',
    }
    if (dietaryReqs) {
        data.dietary_reqs = dietaryReqs;
    }
    if (allergens) {
        data.allergens = allergens;
    }

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: scriptVars.ajaxUrl,
        data: data,
        success: function(response) {
            container.fadeTo('400', 0);
            setTimeout(() => {
                container.empty().append(response);
                $('.menu__category__item').matchHeight();
                $('.menu-filter-popup').removeClass('is-active');
                container.fadeTo('400', 1);
            }, 400);
        },
        error: function(response) {
            console.log(response);
        }
    })
}

function menuFilter() {
    $('.js-allergen-filter-btn').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('is-active');
    })
    
    $('.js-menu-filter-submit').on('click', function(e) {
        e.preventDefault();
        const activeAllergens = $('.js-allergen-filter-btn.is-active');
        const activeAllergenIds = [];
        activeAllergens.each(function(i, item) {
            activeAllergenIds.push($(item).data('term-slug'));
        })

        console.log(activeAllergenIds);
        get_menu_items(false, activeAllergenIds);
    })
}

function menuScrollingLinks() {
    $('.js-view-full-menu').on('click', function(e) {
        e.preventDefault();
        scrollToEl(".menu", 60, 900);
    })

    $('.js-open-menu-filter-popup').on('click', function(e) {
        e.preventDefault();
        $('.menu-filter-popup').addClass('is-active');
    })
    
    $('.menu-filter__cat').on('click', function(e) {
        e.preventDefault();
        const catID = $(this).data('cat-id');
        if (catID) {
            scrollToEl('.menu__category[data-cat-id="' + catID + '"]', -30, 1200);
        } else {
            scrollToEl(".menu", 60, 900);
        }
    })
}