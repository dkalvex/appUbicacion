var map = new google.maps.Map(document.getElementById('map'), {
	center: {lat: -33.8688, lng: 151.2195},
	zoom: 13,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
		var pos = {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		};		
		
		map.setCenter(pos);
	});
} 

var marker = new google.maps.Marker({
	map:map,
	draggable:true
});

// Se crea el input y se configura como el buscar 
var input = document.getElementById('search_box');
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

google.maps.event.addListener(searchBox,'places_changed', function() {
	var places = searchBox.getPlaces();
	var bounds = new google.maps.LatLngBounds();
	var i, place;

	for (i = 0; place=places[i]; i++) {
		bounds.extend(place.geometry.location);
		marker.setPosition(place.geometry.location);
	}

	map.fitBounds(bounds);
	map.setZoom(13);
});	  

google.maps.event.addListener(marker,'position_changed', function() {
	var alert = $("#alert_model");
	alert.css('display','none');
	var lat =	marker.getPosition().lat();
	var lng =	marker.getPosition().lng();

	//alert("Desea guardar la ubicacion");
	$('#confirModal').modal('show');
	$('#lat').val(lat);
	$('#lng').val(lng);
});

