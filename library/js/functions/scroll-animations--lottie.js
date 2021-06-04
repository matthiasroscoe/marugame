function lottieScrollAnimations() {
	let lottieScrollTop = 0;

	// Create Frontpage line animation
	const homeLineContainer = $(".js-lottie-home-line");
	let homeLineAnim = false;
	if (homeLineContainer.length) {
		homeLineAnim = bodymovin.loadAnimation({
			container: homeLineContainer.get(0),
			path: "/wp-content/themes/marugame/library/images/lottie/home-line.json",
			renderer: "svg",
			loop: false,
			autoplay: false,
			name: "home-line"
		});
	}

	// Create Hand Bowl animation
	const handBowlContainer = $(".js-lottie-hand-bowl");
	let handBowlAnim = false;
	if (handBowlContainer.length) {
		handBowlAnim = bodymovin.loadAnimation({
			container: handBowlContainer.get(0),
			path: "/wp-content/themes/marugame/library/images/lottie/hand-bowl.json",
			renderer: "svg",
			loop: false,
			autoplay: false,
			name: 'hand-bowl'
		});
		handBowlAnim.goToAndStop(1, true);
	}

	// Create Noodle Bowl animation
	const noodleBowlContainer = $(".js-lottie-noodle-bowl");
	let noodleBowlAnim = false;
	if (noodleBowlContainer.length) {
		noodleBowlAnim = bodymovin.loadAnimation({
			container: noodleBowlContainer.get(0),
			path: "/wp-content/themes/marugame/library/images/lottie/noodle-bowl.json",
			renderer: "svg",
			loop: false,
			autoplay: false,
			name: 'noodle-bowl'
		});
		noodleBowlAnim.goToAndStop(1, true);
	}

	// Create Club Sign-up line animation
	const clubSignupLineContainer = $(".js-lottie-club-signup-line");
	let clubSignupLineAnim = false;
	if (clubSignupLineContainer.length) {
		clubSignupLineAnim = bodymovin.loadAnimation({
			container: clubSignupLineContainer.get(0),
			path: "/wp-content/themes/marugame/library/images/lottie/club-signup-line.json",
			renderer: "svg",
			loop: false,
			autoplay: false,
			name: 'club-signup-line'
		});
	}

	// Trigger animations on scroll
	$(window).on("scroll resize load", function() {
		lottieScrollTop = $(window).scrollTop() + window.innerHeight;

		if (homeLineContainer.length) {
			triggerAnimationOnScroll(lottieScrollTop, homeLineAnim);
		}

		if (handBowlContainer.length) {
			triggerAnimationOnScroll(lottieScrollTop, handBowlAnim);
		}

		if (noodleBowlContainer.length) {
			triggerAnimationOnScroll(lottieScrollTop, noodleBowlAnim);
		}

		if (clubSignupLineContainer.length) {
			triggerAnimationOnScroll(lottieScrollTop, clubSignupLineAnim);
		}
	});

	// Compare window scrollTop with animation container scrollTop.
	function triggerAnimationOnScroll(lottieScrollTop, anim) {
		let animContainerOffset;
		if (anim.name == "home-line") {
			animContainerOffset = $(window).innerHeight() * 1.65;
		} else {
			animContainerOffset = $(anim.wrapper).offset().top;
		}

		if (lottieScrollTop > animContainerOffset) {
			if (anim.name == "home-line" && $('body').hasClass('home')) {
				heroBowlAnimations(true);
				setTimeout(() => {
					anim.play();
				},1000)
			} else {
				// console.log(anim.name);
				anim.play();
			}
		}
	}
}
