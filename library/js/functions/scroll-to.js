function scrollTo() {
	$(".js-scroll-below-video").on("click", function(e) {
		e.preventDefault();
		const nextModule = $(this)
			.closest(".module")
			.next();
		scrollToEl($(nextModule), 0, 1200);
	});

	$(".js-sign-up-scroll").on("click", e => {
		e.preventDefault();
		scrollToEl(".club-signup", 60, 2000);
	});
}

function scrollToEl(el, offset = 0, speed = 2000) {
	let scrollTop;
	if (el instanceof jQuery) {
		scrollTop = offset ? el.offset().top + offset : el.offset().top;
	} else {
		scrollTop = offset ? $(el).offset().top + offset : $(el).offset().top;
	}

	$([document.documentElement, document.body]).animate(
		{
			scrollTop: scrollTop
		},
		speed
	);
}
