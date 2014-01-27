
	<table><tr><td valign=top>
	<h1>Webcam Test Page</h1>
	<h3>Work, you fucktard</h3>

	<!-- First, include the JPEGCam JavaScript Library -->
	<script type="text/javascript" src="/js/webcam/webcam.js"></script>
	<script type="text/javascript" src="/js/bwH5.js"></script>
        <!-- Start Geolocation Attempt -->
        <script type="text/javascript">
        var t = new bwTable();
        var geo;

        function getGeoLocation() {
            try {
                if( !! navigator.geolocation ) return navigator.geolocation;
                else return undefined;
            } catch(e) {
                return undefined;
            }
        }

        function show_coords(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            t.updateRow(0, [ lat.toString(), lon.toString() ] );
            dispResults();
        }

        function dispResults() {
            element('results').innerHTML = t.getTableHTML();
        }

        function init() {
            if((geo = getGeoLocation())) {
                statusMessage('Using HTML5 Geolocation')
                t.setHeader( [ 'Latitude', 'Longitude' ] );
                t.addRow( [ '&nbsp;', '&nbsp;' ] );
            } else {
                statusMessage('HTML5 Geolocation is not supported.')
            }
            geo.getCurrentPosition(show_coords);
        }

        window.onload = function() {
            init();
        }
    </script>
    <div id="results"></div>
    <!-- End Geolocation attempt -->
	<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( 'webcam/test' );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true, '/js/webcam/shutter.mp3' ); // play shutter click sound
	</script>

	<!-- Next, write the movie to the page at 320x240 -->
	<script language="JavaScript">
		document.write( webcam.get_html(640, 480) );
	</script>

	<!-- Some buttons for controlling things -->
	<br/><form>
		<input type=button value="Configure..." onClick="webcam.configure()">
		&nbsp;&nbsp;
		<input type=button value="Take Snapshot" onClick="take_snapshot()">

	</form>

	<!-- Code to handle the server response (see test.php) -->
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );

		function take_snapshot() {
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
		}

		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML =
					'<h1>Upload Worked</h1>' +
					'<h3>URL: ' + image_url + '</h3>' +
					'<img src="' + image_url + '">';

				// reset camera for another shot
				webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}
	</script>

	</td><td width=50>&nbsp;</td><td valign=top>
		<div id="upload_results" style="background-color:#eee;"></div>
	</td></tr></table>
