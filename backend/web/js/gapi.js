var N = 35.0457574;
var E = 33.2241134;
var zoom = 10;
var gps = $('#sale-gps').val();
if (gps) {
	parseLatlng(gps);
	zoom = 17;
}
var myLatlng = new google.maps.LatLng(N, E);
var myOptions = {
	zoom: zoom,
	center: myLatlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
var geocoder = new google.maps.Geocoder();
var markerArray = [];
var markersArray = [];

if (zoom == 17) {
	setMarker(myLatlng);
}

function setMarker(pos) {
	var marker = new google.maps.Marker({
		position: pos,
		map: map,
		draggable: true
	});
	markerArray.push(marker);
	getLatlng(pos);
	$('#sale-gps').val(N+','+E);
	google.maps.event.addListener(marker, "dragend", function() {
		getLatlng(marker.getPosition());
		$('#sale-gps').val(N+','+E);
	});
}

function setMarkers(pos, title, status, link) {
	var icon;
	if (status == 1)
		icon = 'http://mt.google.com/vt/icon?color=ff004C13&name=icons/spotlight/spotlight-waypoint-blue.png';
	else
		icon = 'http://mt.google.com/vt/icon/name=icons/spotlight/spotlight-ad.png';
	var marker = new google.maps.Marker({
		position: pos,
		map: map,
		title: title,
		icon: icon
	});
	google.maps.event.addListener(marker, 'click', function() {
		window.open(link);
	});
	markersArray.push(marker);
}

function parseLatlng(val) {
	var arr = val.split(',');
	N = parseFloat(arr[0]).toFixed(7);
	E = parseFloat(arr[1]).toFixed(7);
}

function getLatlng(val) {
	N = parseFloat(val.lat()).toFixed(7);
	E = parseFloat(val.lng()).toFixed(7);
}

function clearOverlays() {
	clearOverlay();
	if (markersArray) {
		for (i in markersArray) {
			markersArray[i].setMap(null);
		}
	}
}

function clearOverlay() {
	if (markerArray) {
		for (i in markerArray) {
			markerArray[i].setMap(null);
		}
	}
}

function codeAddress(zoom) {
	var address = $('#region_id option:selected').text() + ' ' + $('#district_id option:selected').text() + ' ' + $('#sale-address').val();
	clearOverlay();
	geocoder.geocode({'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			setMarker(results[0].geometry.location);
			map.setZoom(zoom);
		}
	});
}

$('#sale-address').change(function(){
	codeAddress(17);
});
$('#district_id').change(function(){
	$('#sale-gps, #sale-address').val('');
	clearOverlays();
	saleMarkers($('#district_id').val());
}).each(function(){
	saleMarkers($('#district_id').val());
});

function saleMarkers(district_id) {
	$.get('/sale/markers', { district_id: district_id }, function(data) {
		for (var key in data) {
			parseLatlng(data[key]['pos']);
			setMarkers(new google.maps.LatLng(N, E), data[key]['title'], data[key]['status'], data[key]['link']);
		}
	}, 'json');
}