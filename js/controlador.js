$(document).ready(function(){
	
	// cargar el detalle del tour

	if ($('#tour').val()!=null) {

		var param = 'id='+$('#tour').val();

		$.ajax({
			url:"ajax/gestion-Tours.php?accion=obtenerTour",
			method:'POST',
			dataType:'json',
			data: param ,
			success:function(res){
				console.log(res);
			}
		});

	}else{

		$.ajax({
			url:"ajax/gestion-Tours.php?accion=mostrar",
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
                  				<img src="img/01.jpg" alt="App landing" class="img-fluid">
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

		url:"ajax/gestion-Tours.php?accion=obtenerEstado",
		dataType:'json',
		success:function(res){
			for (var i = 0; i < res.length; i++) {
				$('#estados').append(`<option>${res[i].nombre}</option>`)
			}
		}

	});

	
}); // fin de la funcion principal


function detalles(id) {

	var param = 'id='+id;

	console.log(param);

	$.ajax({
		url:"ajax/gestion-Tours.php?accion=obtenerTour",
		method:'POST',
		dataType:'json',
		data: param ,
		success:function(res){
			console.log(res);
		}
	});
}



$('#btn-registro').click(function () {
	
	var nombre = $('#nombre').val();
	var apellido = $('#apellido').val();
	var correo = $('#correo').val();
	var usuario = $('#usuario').val();
	var contrasenia = $('#contrasenia').val();

	var parametros = "nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&usuario="+usuario+"&contrasenia="+contrasenia;

	$.ajax({
		url:"ajax/gestion-Usuario.php?accion=agregar",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log(respuesta);
		}
	});
});

$('#btn-sing-in').click(function () {
	
	var correo = $('#correo').val();
	var contrasenia = $('#contrasenia').val();

	var parametros = "correo="+correo+"&contrasenia="+contrasenia;

	console.log(parametros);

	$.ajax({
		url:"ajax/gestion-Usuario.php?accion=login",
		dataType:'json',
		method: 'POST',
		data: parametros,
		success:function(respuesta){
			console.log(respuesta);
		}
	});
});