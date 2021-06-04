// Slick arrow navigation
function initSlickArrowNavigation() {
	$(".js-slick-next").on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest("section")
			.find(".slick-initialized")
			.slick("slickNext");
	});
	$(".js-slick-prev").on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest("section")
			.find(".slick-initialized")
			.slick("slickPrev");
	});
}

// Slider module
function initSliderModuleSlick() {
	if ($(".js-slider").length) {
		$(".js-slider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 1600,
					settings: {
						slidesToShow: 4
					}
				}
			]
		});
	}
}

// News Events module
function initNewsEventsSlick() {
	if ($(".js-news-events-slider").length) {
		$(".js-news-events-slider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false,
			arrows: false,
			mobileFirst: true,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 992,
					settings: "unslick"
				}
			]
		});
	}
}
