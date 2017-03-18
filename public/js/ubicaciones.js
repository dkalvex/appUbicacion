//Busca las ubicaciones guardadas por el usuario
validateSession();
var ubicaciones = new Array();
var idUsuario ;

// Configura el tamaño del div para las ubicaciones
$("#container_ubicaciones").css("max-height",(($(document).height()- $("#user_content").height() - 150)))
$("#container_ubicaciones").css("min-height",(($(document).height()- $("#user_content").height() - 150)))

function validateSession() {
	$.ajax({
		url: APP_URL+'/user_login',
		type: "get",
		success: function(data){ 
			window.idUsuario = data;
			getUbicaciones(data);
		}
	}); 
}

$("#ubicacionForm").submit(function( event ) {
	event.preventDefault();
	saveUbicacion();
	$("#formUbicacion").modal('toggle');;
	
});

function getUbicaciones(idUser) {
	if(idUser != "" && idUser != undefined)
	{
		$.ajax({
			url: APP_URL+'/ubicacion/getUbicaciones',
			type: "post",
			data: {'_token': $('#token').val()},
			success: function(data){
				updateDivUbicacioes(data,true);          
			}
		}); 	
	}else{		
		updateDivUbicacioes(ubicaciones,false);
	}
	
}

$('#btnConfirm').click(function () {
	map.panBy(0, -150);
})

function updateDivUbicacioes(ubs,buttons){
	var container_modules = $('#container_ubicaciones');
	container_modules.empty();
	if(ubs == undefined){
		return false;
	}
	for (var i = 0; i <= ubs.length -1;i++) {

		var ubi = $(document.createElement('div'));
		ubi.attr('class','col-xs-12 col-sm-12 col-md-12');

		var ubiDiv1 = $(document.createElement('div'));
		ubiDiv1.attr('class','panel panel-default');
		var ubiDiv2 = $(document.createElement('div'));
		ubiDiv2.attr('class','panel-body');

		var ubiDiv3 = $(document.createElement('div'));
		ubiDiv3.attr('class','col-xs-7 col-sm-7 col-md-7 text-center');
		var link = $(document.createElement('a'));
		link.attr("href", '#');
		link.attr("onClick", 'loadUbicacion("'+ubs[i].lat+'","'+ubs[i].long+'")');
		link.append("<i class='glyphicon glyphicon-record'>"+ubs[i].direccion+"</i>");
		ubiDiv3.append(link);
		
		var ubiDivEdit = $(document.createElement('div'));
		ubiDivEdit.attr('class','col-xs-1 col-sm-1 col-md-1 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 text-center');

		if(buttons){
			var link = $(document.createElement('a'));
			link.attr("href", '#');
			link.attr("onClick", 'editUbicacion("'+ubs[i].id+'")');
			link.append("<i class='glyphicon glyphicon-pencil'></i>");
			ubiDivEdit.append(link);
		}

		var link = $(document.createElement('a'));
		link.attr("href", '#');
		link.attr("onClick", 'deleteUbicacion("'+ubs[i].id+'")');
		link.append("<i class='glyphicon glyphicon-remove'></i>");
		ubiDivEdit.append(link);
		
		ubiDiv2.append(ubiDiv3);
		ubiDiv2.append(ubiDivEdit);
		ubiDiv1.append(ubiDiv2);
		ubi.append(ubiDiv1);
		
		container_modules.append(ubi);
	};
}
function loadUbicacion(lat,long) {
	var alert = $("#alert_model");	
	alert.css('display','none');
	alert.empty();
	var alert = $("#alert_model1");	
	alert.css('display','none');
	alert.empty();
	var alert = $("#alert_model2");	
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
	console.log("guardando");
	if(idUsuario != null && idUsuario != "")
	{
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
				var alert = $("#alert_model");
				var content = $(document.createElement('ul'));
				var msj = $(document.createElement('li'));

				msj.append('La ubicación fue guardada exitosamente');
				content.append(msj);
				alert.append(content);
				alert.css('display','block');
				validateSession(); 			             
			}
		}); 	
	}else{
		var ubi = {
			codPostal : codPostal.val(),
			pais : pais.val(),
			comunidad : comunidad.val(),
			ciudad : ciudad.val(),
			direccion : direccion.val(),
			num : num.val(),
			piso : piso.val(),
			esc : esc.val(),
			puerta : puerta.val(),
			lat : lat.val(),
			long : lng.val(),
		};
		window.ubicaciones.push(ubi);
		validateSession();

	}
}


(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1781023458590327";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
	t = window.twttr || {};
	if (d.getElementById(id)) return t;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js, fjs);

	t._e = [];
	t.ready = function(f) {
		t._e.push(f);
	};

	return t;
}(document, "script", "twitter-wjs"));

FB.init({
	appId  : '1781023458590327',
	status : true, 
	cookie : true, 
	xfbml  : true,
});

FB.getLoginStatus(function(response) {
	if (response.status=='connected') {

		FB.api("/me/likes/"+344130499316279,function (response) {
			if (response && !response.error) {						
				$('#btnConfirm').attr('disabled','disabled');
				if(response.data!=''){
					$('#btnConfirm').removeAttr('disabled');
				}										
			}
		});
	}else{
		$('#btnConfirm').attr('disabled','disabled');
	}
});


FB.Event.subscribe('edge.create', function(response) {
	$('#btnConfirm').removeAttr('disabled');	
});

FB.Event.subscribe('edge.remove', function (response) {
	$('#btnConfirm').attr('disabled','disabled');
});

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		if (response.status=='connected') {
			FB.api("/me?fields=id,name,email",function (response) {
				if (response && !response.error) {						
					console.log(response);
					var token = $('#token');
					$.ajax({
						url: APP_URL+'/user/faceboock',
						type: "post",
						data: {
							'nombre' : response.name,
							'id' : response.id,
							'email' : response.email,
							'_token': token.val(),
						},
						success: function(data){							
							location.reload();			             
						}
					}); 	
				}
			});
		}else{
			$('#btnConfirm').attr('disabled','disabled');
		}
	});
}