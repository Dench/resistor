var N = 35.0457574;
var E = 33.2241134;
var zoom = 10;
var gps = jQuery('#sale-gps,#object-gps').val();
if (gps != '') {
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
	markersArray.push(marker);
	getLatlng(pos);
	jQuery('#sale-gps,#object-gps').val(N+','+E);
	google.maps.event.addListener(marker, "dragend", function() {
		getLatlng(marker.getPosition());
		jQuery('#sale-gps,#object-gps').val(N+','+E);
	});
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
	if (markersArray) {
		for (i in markersArray) {
			markersArray[i].setMap(null);
		}
	}
}

function codeAddress(zoom) {
	var address = $('#region_id option:selected').text() + ' ' + jQuery('#district_id option:selected').text() + ' ' + jQuery('#sale-address').val();
	clearOverlays();
	geocoder.geocode({'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			setMarker(results[0].geometry.location);
			map.setZoom(zoom);
		}
	});
}

jQuery('#sale-address, #object-address').change(function(){
	codeAddress(17);
});
jQuery('#district_id, #region_id').change(function(){
	jQuery('#sale-gps, #object-gps, #sale-address, #object-address').val('');
	codeAddress(12);
});