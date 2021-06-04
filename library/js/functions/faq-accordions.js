function faqAccordions() {
    if ($('.faqs').length) {
        $('.js-faq-question').on('click', function(e) {
            e.preventDefault();

            // Hide other questions
            $('.js-faq-question').not(this).removeClass('is-active');
            $('.js-faq-answer').hide();
            
            // Show question clicked
            $(this).toggleClass('is-active');
            if ($(this).hasClass('is-active')) {
                $(this).find('.js-faq-answer').slideDown('400');
            }
        })
    }
}