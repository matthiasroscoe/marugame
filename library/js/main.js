jQueryTouchEvents();

if (! isBrowserIE()) {
	let lottieScrollTop;
	lottieScrollAnimations();
	
	barbaInit();
} else {
	init();
}

function init() {
	// Global
	scrollAnimations();
	handleOverlays();
	stickyHeader();
	scrollTo();
	initSelectric();
	initCookieBanner();
	matchHeight();
	mobileNav();
	initHeaderDropdowns();
	thumbnailHoverEffect();
	faqAccordions();

	// Forms
	setupFormFields();
	submitContactForm();
	clubSignUpForm();

	// Locations module
	locationsSearch();

	// Video module
	playVideosOnScroll();
	toggleVideo();
	customCursors();

	// Menu page
	initMenu();

	// News/Events full feed
	getFullNewsEventsFeed();
	
	// Various slick sliders
	initSlickArrowNavigation();
	initSliderModuleSlick();
	initNewsEventsSlick();

	// Google Map module
	initGoogleMap();
}