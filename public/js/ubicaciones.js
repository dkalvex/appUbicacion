//Busca las ubicaciones guardadas por el usuario
validateSession();
var ubicaciones = new Array();
var idUsuario ;
//getUbicacionesCercanas(14,true);
// Configura el tamaño del div para las ubicaciones
$("#container_ubicaciones").css("max-height",(($(document).height()- $("#user_content").height() - 150)))
$("#container_ubicaciones").css("min-height",(($(document).height()- $("#user_content").height() - 150)))

var onloadCallback = function() {
	widgetId1 = grecaptcha.render('html_element', {
		'sitekey' : '6Ldg7RkUAAAAAAMqUqy6UVhb3qRwg1d6WyYTBNDm',
		'callback' : verifyCallback,
	});
	widgetId1 = grecaptcha.render('html_element2', {
		'sitekey' : '6Ldg7RkUAAAAAAMqUqy6UVhb3qRwg1d6WyYTBNDm',
		'callback' : verifyCallback2,
	});
};

function verifyCallback(response){
	$("#btnGuardarUser").removeAttr("disabled");
}
function verifyCallback2(response){
	$("#btnResetPsd").removeAttr("disabled");
}

function getUbicacionesCercanas(id,form){
	if(id == null || id ==''){
		return false;
	}
	$.ajax({
		url: APP_URL+'/ubicacion/ubicacionesCercanas',
		type: "post",
		data: {
			"idUbicacion":id,
			'_token': $('#token').val()
		},
		success: function(data){
			if(form==true){
				if(idUsuario != "" && idUsuario != undefined)
				{
					updateDivUbicacionesCercanas(idUsuario,data); 
					$('#formUbicacion-cercanas').modal('show');
				}else{		
					updateDivUbicacionesCercanas(idUsuario,data);
					$('#formUbicacion-cercanas').modal('show');
				}
			}else{
				if(idUsuario != "" && idUsuario != undefined)
				{
					updateDivUbicaciones(idUsuario,data,true);          
				}else{		
					updateDivUbicaciones(0,data,false);
				}     	
			}
		}
	});
}
function updateDivUbicacionesCercanas(id,ubs){
	var container_modules = $('#content-ubicaciones-cercanas');
	var ubiValues;
	var distancia;
	container_modules.empty();
	if(ubs == undefined && ubs.length > 0){
		return false;
	}
	for (var i = 0; i <= ubs.length -1;i++) {
		
		distancia = ubs[i].distancia;
		if(distancia > 1000){
			distancia = distancia / 1000
			distancia = parseFloat(distancia).toFixed(2) +" KM ";
		}else{
			distancia = parseFloat(distancia).toFixed(2) +" M ";
		}

		var ubi = $(document.createElement('div'));
		ubi.attr('class','col-xs-12 col-sm-12 col-md-12');

		var ubiDiv1 = $(document.createElement('div'));
		ubiDiv1.attr('class','panel panel-default');
		var ubiDiv2 = $(document.createElement('div'));
		ubiDiv2.attr('class','panel-body');

		var ubiDiv3 = $(document.createElement('div'));
		ubiDiv3.attr('class','col-xs-12 col-sm-12 col-md-12 text-center');
		var link = $(document.createElement('a'));
		link.attr("href", '#');
		
		link.append("<i class='glyphicon glyphicon-record'> "+ubs[i].direccion+" , "+ubs[i].num+" , "+ubs[i].ciudad+" , "+ubs[i].pais+" - "+distancia+"</i>");
		ubiDiv3.append(link);		
		
		ubiDiv2.append(ubiDiv3);
		ubiDiv1.append(ubiDiv2);
		ubi.append(ubiDiv1);
		
		container_modules.append(ubi);
	};
}
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

$("#NewUser-form").submit(function( event ) {
	event.preventDefault();
	var valueForm = $("#NewUser-form").serializeArray();
	
	$.ajax({
		url: APP_URL+'/user/newSave',
		type: "post",
		data: valueForm,
		success: function(data){
			if(data == "true"){
				alertShow("#alert_model","El usuario fue creado correctamente");
				location.reload();
				$("#formUsuario").modal('toggle');
			}else if(data == "false"){
				alertShow("#alert_model_register","El usuario ya esta registrado");
			}else if(data == "error"){
				alertShow("#alert_model_register","Error al tratar de procesar la informacion");
			}			
		},
		error: function(xhr, textStatus, errorThrown){
			alertShow("#alert_model_register","Error al tratar de procesar la informacion");
		}
	});
	
});

$("#resetPsdForm").submit(function( event ) {
	event.preventDefault();
	var valueForm = $("#resetPsdForm").serializeArray();
	
	if(valueForm[2].value == valueForm[1].value){
		$.ajax({
			url: APP_URL+'/user/resetPsd',
			type: "post",
			data: {
				"_token":valueForm[3].value,
				"password":valueForm[1].value,
				"email":valueForm[0].value
			},
			success: function(data){
				if(data){
					alertShow("#alert_model","La contraseña fue editada correctamente");
				}else{
					alertShow("#alert_model","El usuario no esta registrado");
				}
				$("#formUsuarioPsd").modal('toggle');
			},
			error: function(xhr, textStatus, errorThrown){
				alertShow("#alert_model_rest_psd","Error al tratar de procesar la informacion");
			}
		});

	}else{
		alertShow("#alert_model_rest_psd","Las contraseñas no coinciden");
	}
});

$("#ubicacionForm").submit(function( event ) {
	event.preventDefault();
	var valueForm = $("#ubicacionForm").serializeArray();
	saveUbicacion(valueForm);
	$("#formUbicacion").modal('toggle');

});

$("#ubicacionForm-edit").submit(function( event ) {
	event.preventDefault();
	editMap = false;
	var valueForm = $("#ubicacionForm-edit").serializeArray();
	saveUbicacion(valueForm);
	$("#formUbicacion-edit").modal('toggle');

});

$('#formUbicacion-edit').on('hidden.bs.modal', function () {
   editMap = false;
})

function getUbicaciones(idUser) {
	if(idUser != "" && idUser != undefined)
	{
		$.ajax({
			url: APP_URL+'/ubicacion/getUbicaciones',
			type: "post",
			data: {'_token': $('#token').val()},
			success: function(data){
				updateDivUbicaciones(idUser,data,true);          
			}
		}); 	
	}else{		
		updateDivUbicaciones(0,ubicaciones,false);
	}

}

$('#btnConfirm').click(function () {
	var l = new google.maps.LatLng($('#lat').val(), $('#lng').val());
	map.setCenter(l);
	map.panBy(0, -150);
})

function updateDivUbicaciones(id,ubs,buttons){
	var container_modules = $('#container_ubicaciones');
	var ubiValues;
	container_modules.empty();
	if(ubs == undefined){
		return false;
	}
	for (var i = 0; i <= ubs.length -1;i++) {
		ubiValues = JSON.stringify(ubs[i]);
		ubiValues=ubiValues.replace(/"/g,"'");
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
		link.attr("onClick", 'loadUbicacion("'+ubs[i].id+'","'+ubs[i].lat+'","'+ubs[i].long+'")');
		link.append("<i class='glyphicon glyphicon-record'>"+ubs[i].direccion+"</i>");
		ubiDiv3.append(link);

		var ubiDivEdit = $(document.createElement('div'));
		ubiDivEdit.attr('class','col-xs-1 col-sm-1 col-md-1 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 text-center');

		if(buttons){
			var link = $(document.createElement('a'));
			link.attr("href", '#');			
			link.attr("onClick", 'editUbicacion("'+ubiValues+'")');
			link.append("<i class='glyphicon glyphicon-pencil'></i>");
			ubiDivEdit.append(link);
		}

		var link = $(document.createElement('a'));
		link.attr("href", '#');
		link.attr("onClick", 'deleteUbicacion("'+ubs[i].id+'")');
		link.append("<i class='glyphicon glyphicon-remove'></i>");
		ubiDivEdit.append(link);


		ubiDiv2.append(ubiDiv3);
		if(id==ubs[i].idUsuario){
			ubiDiv2.append(ubiDivEdit);
		}
		ubiDiv1.append(ubiDiv2);
		ubi.append(ubiDiv1);

		container_modules.append(ubi);
	};
}

/*$("#formUbicacion-edit").on("shown.bs.modal", function () {
	var currentCenter = map2.getCenter();  
	google.maps.event.trigger(map2, "resize");
	map2.setCenter(currentCenter); 
});*/

$('#btUpdateL').click(function () {
	getL = true;
	$("#formUbicacion-edit").modal('toggle');
});

function editUbicacion(ubi){
	var i = 0, strLength = ubi.length;
	//Se reemplaza todas las ' por " para poder volver el string en objeto
	for(i; i < strLength; i++) {
		ubi = ubi.replace("'", '"');
	}
	ubi = JSON.parse(ubi);	

	$('#idUbicacion').val(ubi.id);
	$('#codPostal-edit').val(ubi.codPostal);
	$('#pais-edit').val(ubi.pais);
	$('#comunidad-edit').val(ubi.comunidad);
	$('#ciudad-edit').val(ubi.ciudad);
	$('#direccion-edit').val(ubi.direccion);
	$('#num-edit').val(ubi.num);
	$('#piso-edit').val(ubi.piso);
	$('#esc-edit').val(ubi.esc);
	$('#puerta-edit').val(ubi.puerta);
	$('#lat-edit').val(ubi.lat);
	$('#lng-edit').val(ubi.long);

	$('#formUbicacion-edit').modal('show');
	var myLatlng = new google.maps.LatLng(parseFloat(ubi.lat),parseFloat(ubi.long));
	editMap = true;
	marker.setPosition(myLatlng);
	map.setCenter(myLatlng);
	map.panBy(0, -150);
}

function deleteUbicacion(id){

	$('#confirm_delete').modal({
		backdrop: 'static',
		keyboard: false
	})
	.one('click', '#confirmOk', function(e) {
		$.ajax({
			url: APP_URL+'/ubicacion/daleteUbicaciones',
			type: "post",
			data: {
				"idUbicacion":id,
				'_token': $('#token').val()
			},
			success: function(data){
				validateSession();	             
			}
		});
	});

};

function loadUbicacion(id,lat,long) {
	var myLatlng = new google.maps.LatLng(parseFloat(lat),parseFloat(long));

	var marker = new google.maps.Marker({
		position: myLatlng,
		map:map,
		draggable:true
	});
	map.setCenter(myLatlng);
	getUbicacionesCercanas(id,false);
}

function saveUbicacion(data) {
	if(idUsuario != null && idUsuario != "")
	{
		$.ajax({
			url: APP_URL+'/ubicacion/new',
			type: "post",
			data: data,
			success: function(data){
				if(data == "false"){
					alertShow("#alert_model","Ha sobrepasado los limites de las ubicaciones");	
				}else if (data == "error"){
					alertShow("#alert_model","Error al guardar las ubicaciones");	
				}else{
					alertShow("#alert_model","Ubicación guardada correctamente");
					validateSession();
					getUbicacionesCercanas(data,true);	
				}

			}
		}); 	
	}else{
		var ubi = {
			idUsuario : null,
			codPostal : data[0].value,
			pais : data[1].value,
			comunidad : data[2].value,
			ciudad : data[3].value,
			direccion : data[4].value,
			num : data[5].value,
			piso : data[6].value,
			esc : data[7].value,
			puerta : data[8].value,
			lat : data[10].value,
			long : data[11].value,
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
	xfbml  : true,
});

FB.getLoginStatus(function(response) {	
	if (response.status=='connected') {
		FB.api("/me/likes/344130499316279" ,function (like) {
			if(like.error){
				return false;
			}
			if (like) {						
				$('#btnConfirm').attr('disabled','disabled');
				if(like.data!=''){
					$('#btnConfirm').removeAttr('disabled');
				}										
			}
		});
	}else if (response.status == 'not_authorized'){
		FB.login(function(like) {
			FB.api("/me/likes/344130499316279" ,function (like) {
				if(like.error){
					return false;
				}
				if (like) {						
					$('#btnConfirm').attr('disabled','disabled');
					if(like.data!=''){
						$('#btnConfirm').removeAttr('disabled');
					}										
				}
			});
		}, {
			scope : 'public_profile,email,user_likes'
		});
	}
	else{
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
		}
	});
};

function alertShow(id,mesj){
	var alert = $(id);
	var content = $(document.createElement('ul'));
	var msj = $(document.createElement('li'));
	msj.append(mesj);
	content.append(msj);
	alert.append(content);
	alert.css('display','block');
	autoClosingAlert(id,5000);
}

function autoClosingAlert(selector, delay) {
	var alert = $(selector).alert();
	window.setTimeout(function() { alert.css('display','none'); alert.empty(); }, delay);
};

$("#alert_model1").ready(function (){
	var alert = $("#alert_model1").alert();
	window.setTimeout(function() { alert.css('display','none'); alert.empty(); }, 5000);
});

$("#alert_model2").ready(function (){
	var alert = $("#alert_model2").alert();
	window.setTimeout(function() { alert.css('display','none'); alert.empty(); }, 5000);
});