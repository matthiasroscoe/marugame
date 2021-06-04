/**
 * Loads and plays the videos in Video module on scroll.
 * Stops the video once user has scrolled past the module.
 */
let videoActive = false;
let videoIsAnimating = false;

function playVideosOnScroll() {
	if ($(".videoEl").length) {
		let windowBottom,
			windowTop,
			videoTopOffset,
			videoBottomOffset,
			autoPlayStarted = false;
		const videos = $(".videoEl");

		$(window).on("resize load scroll", function(e) {
			windowTop = $(window).scrollTop();
			windowBottom = windowTop + $(window).height();
			
			// Play videos as muted/autoplay/loop on scroll
			if (!autoPlayStarted) {
				if ($('.video').length) {
					videoTopOffset = $(".video").offset().top;

					if (windowBottom > videoTopOffset - 300) {
						videos.each(function(i, item) {
							$(item)
								.get(0)
								.load();
							$(item).prop("autoplay", true);
							$(item)
								.get(0)
								.play();
							autoPlayStarted = true;
						});
					}
				}
			}

			// Stop videos 
			if (videoActive) {
				videoBottomOffset = $(".video").offset().top + $('.video').outerHeight() + 50;
				if (windowTop > videoBottomOffset) {
					$('.js-video').trigger('click');
				}
			}
		});
	}
}

/**
 * Opens/closes video overlay
 */
function toggleVideo() {
	if ($(".js-video").length) {

		$(".js-video").on("click", function() {
			if (videoIsAnimating) {
				return;
			}
			videoIsAnimating = true;

			$(this).toggleClass("is-active");
			$('body').toggleClass('is-playing-video');
			$('.c-cursor').toggleClass('has-close-cursor')

			let video = $(".videoEl--desktop").get(0);
			if ($(window).innerWidth() < 768 && $('.videoEl--mobile').length) {
				video = $(".videoEl--mobile").get(0);
			}

			// Activate video
			if (!videoActive) {
				videoActive = true;

				video.pause();
				video.currentTime = 0;
				$(video).prop("muted", false);
				video.play();

				setTimeout(function() {
					videoIsAnimating = false;
				}, 500);
			}
			// De-activate video
			else {
				videoActive = false;

				$(video).prop("muted", true);

				setTimeout(function() {
					videoIsAnimating = false;
				}, 500);
			}
		});

		$(document).on("keydown", function(e) {
			if (e.keyCode == 27) {
				$(".js-video").trigger("click");
			}
		});
		$('.js-video-close').on('click', function(e) {
			e.preventDefault();
			$(".js-video").trigger("click");
		})
	}
}
