var map2 = new google.maps.Map(document.getElementById('conten_map_edit'), {
	center: {lat: -33.8688, lng: 151.2195},
	zoom: 12,
	mapTypeId: google.maps.MapTypeId.ROADMAP
});

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
var marker2 = new google.maps.Marker({
	map:map2,
	draggable:true
});

map.addListener('click', function(event) {
	addMarker(event.latLng);
});


function addMarker(location) {	
	marker.setPosition(location);
}

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
	alert.empty();
	
	var lat =	marker.getPosition().lat();
	var lng =	marker.getPosition().lng();

	//alert("Desea guardar la ubicacion");
	$('#confirModal').modal('show');
	$('#lat').val(lat);
	$('#lng').val(lng);
	var geocoder = new google.maps.Geocoder();
	var yourLocation = new google.maps.LatLng(lat, lng);
	geocoder.geocode({ 'latLng': yourLocation },processGeocoder);
});

function processGeocoder(results, status){
	$('#ubicacionForm').trigger("reset");
	var ciudad = $("#ciudad") ;
	var comunidad = $("#comunidad") ;
	var pais = $("#pais") ;
	var numero = $("#num") ;

	if (status == google.maps.GeocoderStatus.OK) {				
		if (results[0]) {
			var postal = results[0].address_components[(results[0].address_components.length - 1)].long_name;
			var dirComponent = results[0].address_components;
			for (var i = (dirComponent.length - 1); i >= 0; i--) {
				if(dirComponent[i].types[0] == "locality"){
					ciudad.val(dirComponent[i].long_name);
				}
				if(dirComponent[i].types[0] == "country"){
					pais.val(dirComponent[i].long_name);
				}
				if(dirComponent[i].types[0] == "neighborhood"){
					comunidad.val(dirComponent[i].long_name);
				}
				if(dirComponent[i].types[0] == "street_number"){
					numero.val(dirComponent[i].long_name);
				}

			}
			var ub = results[0].formatted_address.split(",");
			$("#direccion").val(ub[0]);
			$("#codPostal").val(postal);
		} 
	}
}
function error(msg) {
	alert(msg);
}