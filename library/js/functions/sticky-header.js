/**
 * Sticky header scroll toggle
 */

function stickyHeader() {
	let scrollTop;

	$(window).on("load resize scroll", function() {
		scrollTop = $(window).scrollTop();

		if (scrollTop > 0) {
			$(".header-inner").addClass("is-scrolled");
			$(".header-inner .socials").fadeOut("400");
		} else {
			$(".header-inner").removeClass("is-scrolled");
			$(".header-inner .socials").fadeIn("400");
		}
	});
}
