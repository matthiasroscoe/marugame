// Trigger animations on scroll
function scrollAnimations() {
    let scrollTop;

    // Check if internet explorer or mobile and turn off scrolling animations if so.
    if (isBrowserIE() || $(window).innerWidth() < 992) {
        $('.js-hidden').addClass('js-visible');
    }

    const hiddenSections = document.querySelectorAll('.js-hidden');

    function fadeInVisible() {
        hiddenSections.forEach(function(s,i) {
            if (s.getBoundingClientRect().top <= window.innerHeight - 30) {
                s.classList.add('js-visible');
            }
        })
    }

    
    $(window).on("scroll resize load", function() {

        // Fade in sections on scroll
        fadeInVisible();

        // Hero bowls module, slide in effect
        scrollTop = $(window).scrollTop() + window.innerHeight;
        if ($('.js-hero-bowls-images').length && ! $('body').hasClass('home')) {
            const heroBowlsTopOffset = $('.js-hero-bowls-images').offset().top;

            if (scrollTop > heroBowlsTopOffset) {
                heroBowlAnimations(false);
            }
        }
    });
}