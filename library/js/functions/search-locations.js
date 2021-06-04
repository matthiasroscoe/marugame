function locationsSearch() {
	if (!$(".js-search-locations").length) {
		return;
	}

	$(".js-show-text-search").on("click", function(e) {
		e.preventDefault();

		$(".js-search-buttons").removeClass("is-active");
		$(".js-search-locations").addClass("is-active");
	});

	// Search locations using browser geolocation
	$(".js-geolocate-locations").on("click", function(e) {
		e.preventDefault();

		$(this).addClass("is-loading");

		if (navigator.geolocation) {
			var options = {
				enableHighAccuracy: true,
				timeout: 5000,
				maximumAge: 0
			};

			navigator.geolocation.getCurrentPosition(handleLocation, handleFailure, options);
		} else {
			handleFailure();
		}
	});
	function handleFailure() {
		console.warn("Geo location failed/timed out");
		$(".js-geolocate-locations").removeClass('is-loading');
		alert("Your browser is unable to detect your location, please search manually.");
	}
	function handleLocation(pos) {
		const searchTerm = pos.coords.latitude + "," + pos.coords.longitude;
		searchLocations(searchTerm);
	}

	// Search locations using text field
	$(".js-search-locations").on("submit", function(e) {
		e.preventDefault();
		textSearchForLocations();
	});
	$(".js-search-locations-submit").on("click", function(e) {
		e.preventDefault();
		textSearchForLocations();
	});
	function textSearchForLocations() {
		const searchTerm = $(".js-text-search-locations").val();
		$(".js-search-locations-submit").addClass("is-loading");
		searchLocations(searchTerm);
	}

	// Reset/View all locations
	$(document).on("click", ".js-show-all-locations", function(e) {
		e.preventDefault();
		$(".js-search-locations").removeClass("is-active");
		$(".js-search-buttons").addClass("is-active");
		searchLocations("all");
	});

	function searchLocations(searchTerm) {
		if (searchTerm == undefined || searchTerm == "") {
			searchTerm = "all";
		}

		$.ajax({
			type: "POST",
			url: scriptVars.ajaxUrl,
			dataType: "html",
			data: {
				action: "search_locations",
				search_term: searchTerm
			},
			success: function(response) {
				console.log(response);
				$(".js-locations-grid").fadeTo("400", 0);
				setTimeout(function() {
					$(".js-locations-grid")
						.empty()
						.append(response)
						.fadeTo("400", 1);
					$(".js-geolocate-locations").removeClass("is-loading");
					$(".js-search-locations-submit").removeClass("is-loading");

					if (searchTerm == 'all') {
						$('.location-card__distance').hide();
					} else {
						$('.location-card__distance').show();
					}
				}, "450");
			},
			error: function(xhr, textStatus, errorThrown) {
				console.error("error in AJAX");
			}
		});
	}
}
