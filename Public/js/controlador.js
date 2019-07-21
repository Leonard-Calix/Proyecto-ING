$(document).ready(function(){
	
	// cargar el detalle del tour

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

	$.ajax({

		url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerEstado",
		dataType:'json',
		success:function(res){
			for (var i = 0; i < res.length; i++) {
				$('#estados').append(`<option>${res[i].nombre}</option>`)
			}
		}

	});

	
}); // fin de la funcion principal



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

$('#btn-sing-in').click(function () {
	
	var correo = $('#correo').val();
	var contrasenia = $('#contrasenia').val();

	var parametros = "correo="+correo+"&contrasenia="+contrasenia;

	console.log(parametros);

	$.ajax({
		url:"../Controlador/ajax/gestion-Usuario.php?accion=login",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log(respuesta);
		}
	});
});

$('#btn-comentar').click(function () {
	
	alert('Funciona');
});

