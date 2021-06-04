/**
 * Maps for Google Maps module
 */

const mapStyles = [
	{
		elementType: "geometry",
		stylers: [
			{
				color: "#efeeea"
			}
		]
	},
	{
		elementType: "labels.icon",
		stylers: [
			{
				color: "#cac9c5"
			}
		]
	},
	{
		elementType: "labels.text",
		stylers: [
			{
				color: "#bdbcb7"
			}
		]
	},
	{
		elementType: "labels.text.fill",
		stylers: [
			{
				weight: 1
			}
		]
	},
	{
		elementType: "labels.text.stroke",
		stylers: [
			{
				visibility: "off"
			}
		]
	},
	{
		featureType: "road",
		elementType: "geometry.stroke",
		stylers: [
			{
				color: "#e2e0da"
			}
		]
	},
	{
		featureType: "transit",
		elementType: "geometry",
		stylers: [
			{
				color: "#cac9c5"
			}
		]
	},
	{
		featureType: "transit",
		elementType: "geometry.fill",
		stylers: [
			{
				color: "#cac9c5"
			}
		]
	},
	{
		featureType: "transit",
		elementType: "labels.icon",
		stylers: [
			{
				color: "#cac9c5"
			},
			{
				saturation: -100
			}
		]
	}
];

function initGoogleMap() {
	if (document.getElementById("map-container")) {
	
		const mapContainer = document.getElementById("map-container"),
			mapIcon = mapContainer.getAttribute("data-map-icon"),
			mapData = JSON.parse(mapContainer.getAttribute("data-map"));
	
		const center = {
			lat: mapData.lat,
			lng: mapData.lng
		};

		let map = new google.maps.Map(mapContainer, {
			center: center,
			zoom: mapData.zoom < 15 ? 15 : mapData.zoom,
			zoomControl: false,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			rotateControl: false,
			fullscreenControl: false,
			styles: mapStyles
			// gestureHandling: "none"
		});

		// Set center icon
		var icon = {
			url: mapIcon,
			scaledSize: new google.maps.Size(230, 63),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(115, 63)
		};
		var marker = new google.maps.Marker({
			position: center,
			map: map,
			icon: icon
		});
	}
}
