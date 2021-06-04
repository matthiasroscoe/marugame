function barbaInit() {
    
    barba.init({
        debug: true,
        sync: true,
        timeout: 5000,
        preventRunning: true,
        prevent: ({href}) => href == '#' || href == window.location.href,
        
        transitions: [
            {
                name: 'default',
                leave(data) {
                    const done = this.async();
                    
                    
                    // Fade in page transition anim
                    $('.c-page-transition').addClass('leave');
                    setTimeout(function() {
                        // Destroy lottie anims
                        lottie.destroy();
                        
                        done();
                    }, 1200);
                },
                after() {
                    // Re-init lottie anims
                    lottieScrollAnimations();

                    // Fade out page transition anim
                    $('.c-page-transition').addClass('enter');
                    
                    setTimeout(function() {
                        $('.c-page-transition').removeClass('leave');
                        $('.c-page-transition').removeClass('enter');
                    }, 800);
                }
            },
        ],
        views: [{
            namespace: 'default',
            beforeEnter() {                
                // Reset body
                $('body').removeClass('no-scroll');

                // Reset scroll
                $('html, body').animate({
                    scrollTop: 0
                }, 0);

                // Reset nav

                // Destroy slick
                $('.slick-initialized').slick('unslick');

                // Reset modals

                // Restart autoplaying videos
                $('video[autoplay]').each(function(i, item) {
                    $(item).get(0).play();
                });
                
                // Re-init js
                init();                    
            },
        }]
    })
}