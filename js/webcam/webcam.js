/* JPEGCam v1.0.9 */
/* Webcam library for capturing JPEG images and submitting to a server */
/* Copyright (c) 2008 - 2009 Joseph Huckaby <jhuckaby@goldcartridge.com> */
/* Licensed under the GNU Lesser Public License */
/* http://www.gnu.org/licenses/lgpl.html */

/* Usage:
	<script language="JavaScript">
		document.write( webcam.get_html(320, 240) );
		webcam.set_api_url( 'test.php' );
		webcam.set_hook( 'onComplete', 'my_callback_function' );
		function my_callback_function(response) {
			alert("Success! PHP returned: " + response);
		}
	</script>
	<a href="javascript:void(webcam.snap())">Take Snapshot</a>
*/

// Everything is under a 'webcam' Namespace
window.webcam = {
	version: '1.0.9',

	// globals
	ie: !!navigator.userAgent.match(/MSIE/),
	protocol: location.protocol.match(/https/i) ? 'https' : 'http',
	callback: null, // user callback for completed uploads
	swf_url: '/js/webcam/webcam.swf', // URI to webcam.swf movie (defaults to cwd)
	shutter_url: '', // URI to shutter.mp3 sound
	api_url: '', // URL to upload script
	loaded: false, // true when webcam movie finishes loading
	quality: 90, // JPEG quality (1 - 100)
	shutter_sound: true, // shutter sound effect on/off
        lat: '',
        lon: '',
	stealth: false, // stealth mode (do not freeze image upon capture)
	hooks: {
		onLoad: null,
		onComplete: null,
		onError: null
	}, // callback hook functions

	set_hook: function(name, callback) {
		// set callback hook
		// supported hooks: onLoad, onComplete, onError
		if (typeof(this.hooks[name]) == 'undefined')
			return alert("Hook type not supported: " + name);

		this.hooks[name] = callback;
	},

	fire_hook: function(name, value) {
		// fire hook callback, passing optional value to it
		if (this.hooks[name]) {
			if (typeof(this.hooks[name]) == 'function') {
				// callback is function reference, call directly
				this.hooks[name](value);
			}
			else if (typeof(this.hooks[name]) == 'array') {
				// callback is PHP-style object instance method
				this.hooks[name][0][this.hooks[name][1]](value);
			}
			else if (window[this.hooks[name]]) {
				// callback is global function name
				window[ this.hooks[name] ](value);
			}
			return true;
		}
		return false; // no hook defined
	},

	set_api_url: function(url) {
		// set location of upload API script
		this.api_url = url;
	},

	set_swf_url: function(url) {
		// set location of SWF movie (defaults to webcam.swf in cwd)
		this.swf_url = url;
	},

	get_html: function(width, height, server_width, server_height) {
		// Return HTML for embedding webcam capture movie
		// Specify pixel width and height (640x480, 320x240, etc.)
		// Server width and height are optional, and default to movie width/height
		if (!server_width) server_width = width;
		if (!server_height) server_height = height;

		var html = '';
		var flashvars = 'shutter_enabled=' + (this.shutter_sound ? 1 : 0) +
			'&shutter_url=' + escape(this.shutter_url) +
			'&width=' + width +
			'&height=' + height +
			'&server_width=' + server_width +
			'&server_height=' + server_height;

		if (this.ie) {
			html += '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="'+this.protocol+'://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="'+width+'" height="'+height+'" id="webcam_movie" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+this.swf_url+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+flashvars+'"/></object>';
		}
		else {
			html += '<embed id="webcam_movie" src="'+this.swf_url+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+width+'" height="'+height+'" name="webcam_movie" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashvars+'" />';
		}

		this.loaded = false;
		return html;
	},

	get_movie: function() {
		// get reference to movie object/embed in DOM
		if (!this.loaded) return alert("ERROR: Movie is not loaded yet");
		var movie = document.getElementById('webcam_movie');
		if (!movie) alert("ERROR: Cannot locate movie 'webcam_movie' in DOM");
		return movie;
	},

	set_stealth: function(stealth) {
		// set or disable stealth mode
		this.stealth = stealth;
	},

        get_lat: function(){
            var lat = document.getElementById('lat');
            return lat;
        },

        get_lon: function(){
            var lon = document.getElementById('lon');
            return lon;
        },

	snap: function(url, callback, stealth) {
		// take snapshot and send to server
		// specify fully-qualified URL to server API script
		// and callback function (string or function object)
		if (callback) this.set_hook('onComplete', callback);
		if (url) this.set_api_url(url);
		if (typeof(stealth) != 'undefined') this.set_stealth( stealth );

		this.get_movie()._snap( this.api_url, this.quality, this.shutter_sound ? 1 : 0, this.stealth ? 1 : 0);
	},

	freeze: function() {
		// freeze webcam image (capture but do not upload)
		this.get_movie()._snap('', this.quality, this.shutter_sound ? 1 : 0, 0 );
	},

	upload: function(url, callback) {
		// upload image to server after taking snapshot
		// specify fully-qualified URL to server API script
		// and callback function (string or function object)
		if (callback) this.set_hook('onComplete', callback);
		if (url) this.set_api_url(url);

		this.get_movie()._upload( this.api_url );
	},

	reset: function() {
		// reset movie after taking snapshot
		this.get_movie()._reset();
	},

	configure: function(panel) {
		// open flash configuration panel -- specify tab name:
		// "camera", "privacy", "default", "localStorage", "microphone", "settingsManager"
		if (!panel) panel = "camera";
		this.get_movie()._configure(panel);
	},

	set_quality: function(new_quality) {
		// set the JPEG quality (1 - 100)
		// default is 90
		this.quality = new_quality;
	},

	set_shutter_sound: function(enabled, url) {
		// enable or disable the shutter sound effect
		// defaults to enabled
		this.shutter_sound = enabled;
		this.shutter_url = url ? url : 'shutter.mp3';
	},

        set_lat: function(lat){
          this.lat = lat;
        },

	flash_notify: function(type, msg) {
		// receive notification from flash about event
		switch (type) {
			case 'flashLoadComplete':
				// movie loaded successfully
				this.loaded = true;
				this.fire_hook('onLoad');
				break;

			case 'error':
				// HTTP POST error most likely
				if (!this.fire_hook('onError', msg)) {
					alert("JPEGCam Flash Error: " + msg);
				}
				break;

			case 'success':
				// upload complete, execute user callback function
				// and pass raw API script results to function
				this.fire_hook('onComplete', msg.toString());
				break;

			default:
				// catch-all, just in case
				alert("jpegcam flash_notify: " + type + ": " + msg);
				break;
		}
	}
};




var _bwH5_version = "1.1.3";

// useful for finding elements
var element = function(id) {return document.getElementById(id);}
var errorMessage = undefined;
var elStatus;

function getOpenDatabase() {
    try {
        if( !! window.openDatabase ) return window.openDatabase;
        else return undefined;
    } catch(e) {
        return undefined;
    }
}

function getLocalStorage() {
    try {
        if( !! window.localStorage ) return window.localStorage;
        else return undefined;
    } catch(e) {
        return undefined;
    }
}

function getSessionStorage() {
    try {
        if( !! window.sessionStorage ) return window.sessionStorage;
        else return undefined;
    } catch(e) {
        return undefined;
    }
}

function dispError( message ) {
    errorMessage = '<p class="error">' + message + '</p>';
    haveError = true;
}

function statusMessage(s) {
    if(!elStatus) elStatus = element('statusMessage');
    if(!elStatus) return;
    elStatus.innerHTML = s;
    if(s) elStatus.innerHTML = s;
    else elStatus.innerHTML = '&nbsp;';
}


function bwTable( wrap ) {
    this.wrap = ( wrap == undefined ) ? true : wrap;    // default to true
    this.rows = new Array();
    this.header = [];

    this.setHeader = function( row ) {
        this.header = row;
    }

    this.addRow = function( row ) {
        this.rows.push(row);
    }

    this.updateRow = function( index, row ) {
        this.rows[index] = row;
    }

    this.getRow = function ( index ) {
        return this.rows[index];
    }

    this.countRows = function () {
        return this.rows.length;
    }

    this.getTableHTML = function () {
        var a = '';
        if(this.wrap) a += '<table class="bwTable">\n';
        a += this.getHeaderHTML();
        for(var row in this.rows) {
            a += this.getRowHTML(this.rows[row]);
        }
        if(this.wrap) a += '</table>\n';
        return a;
    }

    this.getHeaderHTML = function () {
        if( this.header.length == 0 ) return '';
        var a = '<tr>';
        for( var cell in this.header ) {
            a += '<th>' + this.header[cell] + '</th>';
        }
        a += '</tr>\n';
        return a;
    }

    this.getRowHTML = function (row ) {
        var a = '<tr>';
        for( var cell in row ) {
            var v= row[cell];
            if(v == null) v = '<span class="red">NULL</span>';
            a += '<td>' + v + '</td>';
        }
        a += '</tr>\n';
        return a;
    }

    this.writeTable = function () {
        document.write(this.getTableHTML());
    }

}

