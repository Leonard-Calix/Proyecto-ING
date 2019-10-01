$(document).ready(function(){	
	/*Detalle de tour*/
	if ($('#tour').val()!=null) {

		var id = $('#tour').val();
		var param = 'id='+$('#tour').val();
		var img = "../Public/img/tours/"+id+"_01.png";
		/*Obtener los tours*/
		getTours(param);
		/*Obtener las imagenes por tours*/
		getImages(param);

	}else{
		/*obtener tours*/
		showTours();
	}
	/*obtener estados*/
	getEstados();
	/*===============================================================*/
	/*Consulta para la informaciond del perfil*/
	if ( $('#usuario_registrado').val()!=null) {
		var usuario_registrado = $('#usuario_registrado').val();
		infoPerfil(usuario_registrado);
	}

}); // fin de la funcion principal

//Funcion para obtener Tours
function getTours(param){
	$.ajax({
		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerTour",
		method:'POST',
		dataType:'json',
		data: param ,
		success:function(res){
			//console.log("imf");
			console.log(res);
			$('#nombre_tour').append(`<h2  class="text-center mb-4">${res[0].nombre}</h2>`);

			$('#descripcion').append(`<p class="card-text text-muted">${res[0].descripcion}</p><br><br>`);
		}

	});
}

//Funcion para obtener imagenes
function getImages(param){
	$.ajax({
		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerImagenes",
		method:'POST',
		dataType:'json',
		data: param,
		success:function(res){
			//console.log(res[0].ruta);
			$('#img-p').append(`<img style="width: 100%;" src="${res[0].ruta}" alt="Img tours" class="img-fluid">`);

		}
	});
}

//Funcion para mostrar los tours
function showTours(){
	$.ajax({
		url:"../Controlador/ajax/gestion-Tours.php?accion=mostrar",
		dataType:'json',
		success:function(res){
		//console.log(res);
		var estrella='';
		var img = '';
		for (var i = 0; i < res.length; i++) {
			img = '../Public/img/tours/' + res[i].idTours + '_01.png';

			for (var j = 0; j < res[i].calificacion; j++) {
				estrella+='<i class="text-primary fas fa-star"></i> ';
			}

			$('#respuesta').append(`
				<div class="col-md-4">
				<!-- Item -->
				<a  href="detalle.php?id=${res[i].idTours}" class="card border-0 mb-3 mb-md-0">
				<!-- Image -->
				<div class="card-img-top">
				<img src="${img}" alt="App landing" class="img-fluid">
				</div>

				<!-- Body -->
				<div class="card-body">

				<!-- Title -->
				<h4 class="card-title">${res[i].nombre}</h4>

				<!-- Body -->
				<p style="color: black;" >${res[i].descripcion}</p>
				<p class="card-text text-muted">Calificacion ${estrella}</p>

				</div>

				</a> <!-- / .card -->

				</div>`);
			estrella='';
			img='';
		}
	}
});
}

//Funcion para obtener estados
function getEstados(){
	$.ajax({
		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerEstado",
		dataType:'json',
		success:function(res){
			//console.log(res);
			for (var i = 0; i < res.length; i++) {
				$('#estados').append(`<option value="${res[i].idEstados}" >${res[i].nombre}</option>`)
			}
		}

	});
}

//Funcion para obtener informacion de perfil
function infoPerfil(usuario_registrado){	
	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=obtenerUsuario",
		method: 'POST',
		data: "id="+usuario_registrado,
		dataType:'json',
		success:function(res){
			//console.log('Respuesta del servidor para el perfil');
			//console.log(res);
			$('#nombreUsuario').append(`<h3 class="display-3 text-white">Hello ${res[0].nombreUsuario}</h3>`);
			$('#usuario').append(`<h5 class="h3">${res[0].nombreUsuario}<span class="font-weight-light"></span></p>`);

		}
	});
}

/*===============================================================*/
/*Registrar usuarios al sistema*/

function redireccionar(tipo){
	
	if(tipo == 1){
		document.location.href='main.php';
	}else if(tipo == 2){
		//Turista
		document.location.href='perfil-user.php';
	}else if(tipo == 3){
		//GUIA
		document.location.href='perfil-guide.php';
	}else{
		document.location.href='index.php';
	}
	
}

$('#mensaje').hide();
$('#btn-registro').click(function () {
	
	var nombre = $('#nombre').val();
	var apellido = $('#apellido').val();
	var correo = $('#correo').val();
	var usuario = $('#usuario').val();
	var contrasenia = $('#contrasenia').val();

	var parametros = "nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&usuario="+usuario+"&contrasenia="+contrasenia+"&genero="+"M";
	//console.log(parametros);

	if (nombre==" " || apellido=="" || correo==" " || usuario==" " || contrasenia==" ") {
		$('#error-login').fadeIn(500);
	}else{

		$.ajax({
			url:"../Controlador/ajax/gestion-Usuario.php?accion=agregar",
			dataType:'json',
			method: 'POST',
			data: parametros,
			success:function(respuesta){
				console.log(respuesta);

				if(respuesta.error_nombre != null 
					|| respuesta.error_apellido != null 
					|| respuesta.error_nombreUsuario != null
					|| respuesta.error_correo != null 
					|| respuesta.error_contrasena != null
					|| respuesta.error_typeUser != null){

					$("#nombre").val(respuesta.error_nombre);
					$('#apellido').val(respuesta.error_apellido);
					$('#correo').val(respuesta.error_correo);
					$('#usuario').val(respuesta.error_nombreUsuario);
					$('#contrasenia').attr('type', 'text');
					$('#contrasenia').val(respuesta.error_contrasena);

				}else{
					$('#nombre').val("");
					$('#apellido').val("");
					$('#nombre').val("");
					$('#correo').val("");
					$('#usuario').val("");
					$('#contrasenia').val("");

					$('#mensaje').fadeIn(500);
				//setTimeout(redireccionar(document.location.href ="sing-in.php"), 5000);         
			}			
		}
	});
	}	
});

$('#error-login').hide();

$('#btn-sing-in').click(function () {
	
	var correo = $('#correo').val();
	var contrasenia = $('#contrasenia').val();

	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};

	if(correo==" " && contrasenia==" "){
		alert('Datos vacios');
		return;
	}

	var idTour = getUrlParameter('idTour');
	
	var parametros = "correo="+correo+"&contrasenia="+contrasenia+'&idTour='+idTour;
	//console.log(parametros);

	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=login",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log("resp success "+respuesta.usuario);
			if(respuesta.usuario != null){
				let tour = respuesta.idTour;
				if(tour > 0){
					let url = 'detalle.php?id='+tour;
					setTimeout(window.location=url, 3000);
				}else{
					setTimeout(redireccionar(respuesta.tipo), 3000);
				}
				
			}else{
				//alert('Datos incorrectos');
				$('#error-login').fadeIn(500);
			}

		}
	});
});

/*================================================================================*/

function selecionarEstado(){

	console.log("estado  => ", $("#estados").val());

	$('#resEstados').html("");

	if ($("#estados").val()==0) {

		$("#comenta").fadeIn(500);
		$("#resEstados").fadeOut(500);

		$("#respuesta").fadeIn(500);

	}else{

		$("#comenta").fadeOut(500);
		$("#respuesta").fadeOut(500);

		$("#esta").html($("#estados").val());


		$("#resEstados").fadeOut(500);
		$("#resEstados").fadeIn(500);
	}


	$.ajax({
		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerTourEstado",
		method: "POST",
		data : {idEstados: $("#estados").val() },
		dataType:'json',
		success:function(res){
		console.log(res);

		if (res.length > 0) {
			var estrella='';
			var img = '';

		
			img = '../Public/img/tours/' + res[0].idTours + '_01.png';

			for (var j = 0; j < res[0].calificacion; j++) {
				estrella+='<i class="text-primary fas fa-star"></i> ';
			}

			$('#resEstados').append(`
				<div class="col-md-4">
				<!-- Item -->
				<a  href="detalle.php?id=${res[0].idTours}" class="card border-0 mb-3 mb-md-0">
				<!-- Image -->
				<div class="card-img-top">
				<img src="${img}" alt="App landing" class="img-fluid">
				</div>

				<!-- Body -->
				<div class="card-body">

				<!-- Title -->
				<h4 class="card-title">${res[0].nombre}</h4>

				<!-- Body -->
				<p style="color: black;" >${res[0].descripcion}</p>
				<p class="card-text text-muted">Calificacion ${estrella}</p>

				</div>

				</a> <!-- / .card -->

				</div>`);
			estrella='';
			img=''; 

		} else {    
                  
			$('#resEstados').html(` <h5 class="text-primary text-uppercase">No existe tour registrado</h5>  `);

		}		
	}
});

} 