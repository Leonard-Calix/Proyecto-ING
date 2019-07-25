$(document).ready(function(){
	
	/*===============================================================*/
		/*Detalle de tour*/

	if ($('#tour').val()!=null) {

		var param = 'id='+$('#tour').val();

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerTour",
			method:'POST',
			dataType:'json',
			data: param ,
			success:function(res){
				console.log(res);
				$('#nombre_tour').append(`<h2  class="text-center mb-4">${res[0].nombre}</h2>`);

				$('#descripcion').append(`<p class="card-text text-muted">${res[0].descripcion}</p><br><br>`)
			}

		});

		/*===============================================================*/
		/*Obtener las imgenes por tours*/

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerImagenes",
			method:'POST',
			dataType:'json',
			data: param ,
			success:function(res){
				console.log(res);
				$('#img-p').append(`<img style="width: 100%;" src="${res[0].ruta}" alt="App landing" class="img-fluid">`);

						
				
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
			for (var i = 0; i < res.length; i++) {

				for (var j = 0; j < res[i].calificacion; j++) {
					estrella+='<i class="text-primary fas fa-star"></i> ';
				}

				$('#respuesta').append(`
					<div class="col-md-4">
						<!-- Item -->
              			<a  href="detalle.php?id=${res[i].idTours}" class="card border-0 mb-3 mb-md-0">

                			<!-- Image -->
                			<div class="card-img-top">
                  				<img src="../Public/img/01.jpg" alt="App landing" class="img-fluid">
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
				console.log('Respuesta del servidor para el perfil');
				console.log(res);
				$('#nombreUsuario').append(`<h1 class="display-2 text-white">Hello ${res[0].nombreUsuario}</h1>`);
			}

		});
	}
	
	

	
}); // fin de la funcion principal


/*===============================================================*/
	/*Registrar usuarios al sistema*/

function redireccionar(id, tipo){
	/*switch(tipo){
		case 1:
			document.location.href='admin.php?id='+id;
			break;
		case 2:
			document.location.href='perfil.php?id='+id;
			break;
		case 3:
			document.location.href='perfil.php?id='+id;
			break;
		default:
			document.location.href='perfil.php?id='+id;
			break;
	}*/
	if(tipo == 1){
		document.location.href='perfil.php?id='+id;
	}else if(tipo == 2){
		document.location.href='perfil.php?id='+id;
	}else if(tipo == 3){
		document.location.href='perfil.php?id='+id;
	}else{
		document.location.href='perfil.php?id='+id;
	}
	
	
}

$('#btn-registro').click(function () {
	
	var nombre = $('#nombre').val();
	var apellido = $('#apellido').val();
	var correo = $('#correo').val();
	var usuario = $('#usuario').val();
	var contrasenia = $('#contrasenia').val();

	var parametros = "nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&usuario="+usuario+"&contrasenia="+contrasenia;
	console.log(parametros);

	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=agregar",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log(respuesta);
			if(respuesta.codigo != 0){
				$('#resp').append(
					`<div class="alert alert-primary" role="alert">
						${respuesta.resultado}
					</div>`
				);
				$('#nombre').val("");
				$('#apellido').val("");
				$('#nombre').val("");
				$('#correo').val("");
				$('#usuario').val("");
				$('#contrasenia').val("");

				setTimeout(redireccionar(respuesta.codigo), 4000);
			}else{
				$('#resp').append(
					`<div class="alert alert-danger" role="alert">
						${respuesta.resultado}
					</div>`
				);
			}
		}
	});
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

	console.log(parametros);

	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=login",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log(respuesta);
			if(respuesta.usuario!=null){
				setTimeout(redireccionar(respuesta.usuario, respuesta.tipo), 3000);
			}else{
				//alert('Datos incorrectos');
				$('#error-login').show();

			}

		}
	});
});

$('#btn-comentar').click(function () {
	
	alert('Funciona');
});

