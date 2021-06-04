function thumbnailHoverEffect() {
	$(document).on({
		mouseenter: function() {
			if ($(window).innerWidth() >= 992) {
				const thumb = $(this),
					description = thumb.find(".description"),
					title = thumb.find("h2");

				title.css("transform", `translateY(-${description.outerHeight() + 10}px)`);
			}
		},
		mouseleave: function() {
			if ($(window).innerWidth() >= 992) {
				const title = $(this).find("h2");
				title.css("transform", `translateY(0px)`);
			}
		}
	}, '.js-thumb-hover');
}
