getUbicaciones();
$("#container_ubicaciones").css("max-height",($(document).height()-160))
function getUbicaciones() {
	$.ajax({
		url: APP_URL+'/ubicacion/getUbicaciones',
		type: "post",
		data: {'_token': $('#token').val()},
		success: function(data){  
			updateDivUbicacioes(data);		          
		}
	}); 
}
function updateDivUbicacioes(ubs){
	var container_modules = $('#container_ubicaciones');
	container_modules.empty();
	for (var i = 0; i <= ubs.length -1;i++) {

		var ubi = $(document.createElement('div'));
		ubi.attr('class','col-xs-12 col-sm-12 col-md-12');

		var ubiDiv1 = $(document.createElement('div'));
		ubiDiv1.attr('class','panel panel-default');
		var ubiDiv2 = $(document.createElement('div'));
		ubiDiv2.attr('class','panel-body');
		var ubiDiv3 = $(document.createElement('div'));
		ubiDiv3.attr('class','col-xs-12 text-center');


		var link = $(document.createElement('a'));
		link.attr("href", '#');
		link.attr("onClick", 'loadUbicacion("'+ubs[i].lat+'","'+ubs[i].long+'")');
		link.append("<i class='glyphicon glyphicon-record'>"+ubs[i].direccion+"</i>");
		
		ubiDiv3.append(link);
		ubiDiv2.append(ubiDiv3);
		ubiDiv1.append(ubiDiv2);
		ubi.append(ubiDiv1);
		
		container_modules.append(ubi);
	};
}
function loadUbicacion(lat,long) {
	var alert = $("#alert_model");	
	alert.css('display','none');
	alert.empty();
	var myLatlng = new google.maps.LatLng(parseFloat(lat),parseFloat(long));

	var marker = new google.maps.Marker({
		position: myLatlng,
		map:map,
		draggable:true
	});
	map.setCenter(myLatlng);
}
function saveUbicacion() {
	var codPostal = $('#codPostal');
	var pais = $('#pais');
	var comunidad = $('#comunidad');
	var ciudad = $('#ciudad');
	var direccion = $('#direccion');
	var num = $('#num');
	var piso = $('#piso');
	var esc = $('#esc');
	var puerta = $('#puerta');
	var token = $('#token');
	var lat = $('#lat');
	var lng = $('#lng');

	$.ajax({
		url: APP_URL+'/ubicacion/new',
		type: "post",
		data: {
			'codPostal' : codPostal.val(),
			'pais' : pais.val(),
			'comunidad' : comunidad.val(),
			'ciudad' : ciudad.val(),
			'direccion' : direccion.val(),
			'num' : num.val(),
			'piso' : piso.val(),
			'esc' : esc.val(),
			'puerta' : puerta.val(),
			'_token' : token.val(),
			'lat' : lat.val(),
			'lng' : lng.val(),
		},
		success: function(data){
			console.log(data);
			var alert = $("#alert_model");
			var content = $(document.createElement('ul'));
			var msj = $(document.createElement('li'));

			msj.append('La ubicación fue guardada exitosamente');
			content.append(msj);
			alert.append(content);
			alert.css('display','block');
			getUbicaciones(); 			             
		}
	}); 	
}
$("#ubicacionForm").submit(function( event ) {
	saveUbicacion();
	$("#formUbicacion").modal('toggle');;
	event.preventDefault();
});