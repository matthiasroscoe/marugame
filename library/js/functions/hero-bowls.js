function heroBowlAnimations(rotate) {
	// Transform in the bowl
	$(".js-hero-bowls-images").addClass("is-active");

	
	if (rotate) {
		// Fade in/out between different bowls.
		let counter = 1;
		const animDuration = "600";
		
		window.setInterval(function() {
			bowlSlider(counter++);
		}, 1800);
	
		function bowlSlider() {
			if (counter > 1 && counter < 5) {
				$(`.js-bowl-${counter}`).fadeTo(animDuration, 1);
			} else {
				$(".js-bowl:not(.js-bowl-1)").fadeTo(animDuration, 0);
				counter = 1;
			}
		}
	}
}
