function initHeaderDropdowns() {
    $('.js-menu-link-parent').hover(function() {
        $(this).find('.js-menu-links-dropdown').toggleClass('is-active');
    })
}