function mobileNav() {
	// Mobile Nav Items fade effect
	let animating = false;
	const navItemsFadeIn = new TimelineLite();
	$(".js-nav-anim-elem").css("opacity", "0");
	navItemsFadeIn.staggerTo(
		".js-nav-anim-elem",
		1,
		{
			duration: 0.75,
			opacity: 1,
			y: 0,
			ease: "power4.out"
		},
		0.075
	);

	// Open nav
	$(".js-open-nav").on("click", () => {
		console.log(animating);
		$(".js-nav-anim-elem").css("opacity", "0");
		if (!animating) {
			animating = true;
			$(".nav__inner, .nav").addClass("is-active");
			setTimeout(() => {
				$(".nav__video").addClass("is-active");
				navItemsFadeIn.restart();
				navItemsFadeIn.play();
				setTimeout(() => {
					$(".nav__desktop-logo").addClass("is-active");
					animating = false;
				}, 500);
			}, 350);
		}
	});

	// Close nav
	$(".js-close-nav").on("click", () => {
		if (!animating) {
			animating = true;
			gsap.to(".js-nav-anim-elem", {
				duration: 0.75,
				opacity: 0,
				y: 30,
				ease: "power4.out"
			});
			$(".nav__video, .nav__desktop-logo").removeClass("is-active");
			$(".nav .dropdown-container").slideUp();
			setTimeout(() => {
				$(".nav__inner").removeClass("is-active");
				setTimeout(() => {
					$(".nav").removeClass("is-active");
					animating = false;
				}, 550);
			}, 200);
		}
	});

	// Dropdown menus
	$(".js-nav-link-parent").on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest(".nav__link")
			.toggleClass("is-active");
		$(this)
			.siblings(".dropdown-container")
			.slideToggle();
	});
}
