<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBvz9_5jMMJlchz-G1HQ6RtD6M_F8_oxKY&sensor=false"></script> -->
<div id="map_canvas"></div>

<script type="text/javascript">
	var map;
	var mapOptions = {
		center: new google.maps.LatLng(38.5715765000, -121.4664652000),
		zoom: 11,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	function initialize() {
		var geocoder = new google.maps.Geocoder();
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		google.maps.event.addListener(map, 'click', function (event) {
			userMarker = new google.maps.Marker({
				map: map,
				position: event.latLng
			});

			geocoder.geocode({
				'latLng': event.latLng
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						alert(results[0].formatted_address);
					} else {
						alert("No results");
					}
				} else {
					alert("Geocoding unsuccessful: Status " + status);
				}
			});
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
