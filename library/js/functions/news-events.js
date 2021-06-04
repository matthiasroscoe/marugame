function getFullNewsEventsFeed() {
    if ($('.js-news-events-container').length) {
        const postsPerPage = ($(window).innerWidth() >= 992) ? 10 : 5,
              postType = $(this).data('post-type'),
              container = $('.js-news-events-container');
              
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: {
                action: 'get_news_events_feed',
                post_type: postType,
                posts_per_page: postsPerPage,
            },
            success: function(response) {
                container.fadeTo('400', 0);
                setTimeout(() => {
                    container.empty().append(response).fadeTo('400', 1);
                });
            },
            error: function(response) {
                console.log(response);
            }
        })
    }
}