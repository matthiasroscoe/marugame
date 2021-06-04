function handleOverlays() {
	// Open overlay
	$(".js-open-overlay").on("click", function(e) {
		e.preventDefault();
		const overlay = $(this).data("overlay");
		openOverlay(overlay);
	});

	// Close overlays
	$(".js-close-overlay").on("click", function(e) {
		e.preventDefault();
		const overlay = $(this)
			.closest(".c-overlay")
			.data("overlay");

		closeOverlay(overlay);
	});
}

function openOverlay(overlay) {
	$(`.c-overlay[data-overlay=${overlay}`).addClass("is-active is-animated");
	$("body").addClass("no-scroll");
}

function closeOverlay(overlay) {
	if (overlay != undefined) {
		$(`.c-overlay[data-overlay=${overlay}]`).removeClass("is-animated");
		$("body").removeClass("no-scroll");
		setTimeout(() => {
			$(`.c-overlay[data-overlay=${overlay}]`).removeClass("is-active");
		}, 1000);
	}
}
