$(document).ready(function(){
	
	/*===============================================================*/
		/*Detalle de tour*/

	if ($('#tour').val()!=null) {

		var id = $('#tour').val();
		var param = 'id='+$('#tour').val();
		var img = "../Public/img/tours/"+id+"_01.png";

		///console.log(img + " " + id)

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerTour",
			method:'POST',
			dataType:'json',
			data: param ,
			success:function(res){
			console.log("imf");
				console.log(res);
				$('#nombre_tour').append(`<h2  class="text-center mb-4">${res[0].nombre}</h2>`);

				$('#descripcion').append(`<p class="card-text text-muted">${res[0].descripcion}</p><br><br>`);
			}

		});

		/*===============================================================*/
		/*Obtener las imagenes por tours*/

		

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerImagenes",
			method:'POST',
			dataType:'json',
			data: param ,
			success:function(res){

				
				console.log(res[0].ruta);
				$('#img-p').append(`<img style="width: 100%;" src="${res[0].ruta}" alt="Img tours" class="img-fluid">`);

			}
		});

	}else{

		/*===============================================================*/
		/*obtener tours*/

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=mostrar",
			dataType:'json',
			success:function(res){
			console.log(res);
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

	/*===============================================================*/
	/*obtener estados*/

	$.ajax({

		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerEstado",
		dataType:'json',
		success:function(res){
			for (var i = 0; i < res.length; i++) {
				$('#estados').append(`<option>${res[i].nombre}</option>`)
			}
		}

	});

	/*===============================================================*/
	/*Consulta para la informaciond del perfil*/

	if ( $('#usuario_registrado').val()!=null) {
		
		$.ajax({
			url:"../Controlador/ajax/gestion-Usuario.php?accion=obtenerUsuario",
			method: 'POST',
			data: "id="+$('#usuario_registrado').val(),
			dataType:'json',
			success:function(res){
				//console.log('Respuesta del servidor para el perfil');
				//console.log(res);
				$('#nombreUsuario').append(`<h1 class="display-2 text-white">Hello ${res[0].nombreUsuario}</h1>`);
				$('#usuario').append(`<h5 class="h3">${res[0].nombreUsuario}<span class="font-weight-light"></span></p>`);
                
			}

		});
	}
	
	

	
}); // fin de la funcion principal


/*===============================================================*/
	/*Registrar usuarios al sistema*/

function redireccionar(tipo){
	
	if(tipo == 1){
		document.location.href='main.php';
	}else if(tipo == 2){
		document.location.href='perfil.php';
	}else if(tipo == 3){
		document.location.href='perfil.php';
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

	var parametros = "nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&usuario="+usuario+"&contrasenia="+contrasenia;
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

			if(respuesta.codigo != 0){

				$('#nombre').val("");
				$('#apellido').val("");
				$('#nombre').val("");
				$('#correo').val("");
				$('#usuario').val("");
				$('#contrasenia').val("");

				//setTimeout(redireccionar(respuesta.codigo), 3000);
				$('#mensaje').fadeIn(500);

			}
		}
		});

	}

	
});

$('#error-login').hide();

$('#btn-sing-in').click(function () {
	
	var correo = $('#correo').val();
	var contrasenia = $('#contrasenia').val();

	if(correo==" " && contrasenia==" "){
		alert('Datos vacios');
		return;
	}


	var parametros = "correo="+correo+"&contrasenia="+contrasenia;

	//console.log(parametros);

	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=login",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log("resp success "+respuesta);
			if(respuesta.usuario != null){
				setTimeout(redireccionar(respuesta.tipo), 3000);
			}else{
				//alert('Datos incorrectos');
				$('#error-login').fadeIn(500);

			}

		}
	});
});


$('#btn-comentar').click(function () {
	
	alert('Funciona');
});

