function customCursors() {
    
    const cursor = $('.c-cursor');

    // Init cursor
    $(document).on({
        mouseover: function(e) {
            cursor.css({
                'left': '-12px',
                'top': '-12px',
            }).show();
            $('body').addClass('no-cursor');

            gsap.to('.js-cursor-play', {
                duration: .5,
                scale: 2,
            })

            $(document).on('mousemove', function(e) {
                gsap.set('.js-cursor-wrap', {
                    x: e.clientX,
                    y: e.clientY,
                })
            })
        }, 
        mouseleave: function(e) {
            $('body').removeClass('no-cursor');
            cursor.hide().css({
                'left': '-100px',
                'top': '-100px',
            });
            cursor
            $(document).off('mousemove');
        },
    }, '.js-video');

    // Hero video hover effect.
    // const playIconHoverElems = '.js-hero-video, .js-hero-overlay';
    // $(playIconHoverElems).on('mouseenter', function() {
    //     if ($('.hero').hasClass('has-video')) {
    //         $('.js-cursor-wrap').addClass('close-cursor');
    //     } else {
    //         $('.js-cursor-wrap').addClass('play-cursor');
    //     }
    // })
    // $(playIconHoverElems).on('mouseleave', function() {
    //     $('.js-cursor-wrap').removeClass('play-cursor close-cursor');
    // })
        
}
