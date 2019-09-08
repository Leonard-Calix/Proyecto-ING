$(document).ready(function(){
	ComentariosporTour();
	obtenerTours( $("#tour").val() );
});

function obtenerTours(id){
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=detalle",
		dataType: 'json',
		method: 'POST',
		data: { idTours : id },
		success: function(response){
			//console.log(response);
			let fechaInicio = new Date(response[0].fecha1);
			let fechaFin =  new Date(response[0].fecha2);
			var duration = fechaFin.getTime() - fechaInicio.getTime();
			duration = duration / (1000*60*60*24);

			let options = {weekday: "long", month: "long", day: "numeric"};
			fechaInicio = fechaInicio.toLocaleDateString("es-ES", options);
			fechaFin = fechaFin.toLocaleDateString("es-ES", options);

			let template = `
				<div class="col-md-4">
					<div class="price-box popular">
						<input type="hidden" id="idTour" value="${response[0].idtours}">
						<input type="hidden" id="idHotel" value="${response[0].idHotel}"> 
						<h2 class="pricing-plan">${response[0].tours}</h2>
						<div class="price"><sup class="currency">$</sup>${response[0].precio}</div>
							<p id="descripcion"></p>
						<hr>
						<ul class="pricing-info">
							<li><strong>Date init</strong> ${fechaInicio}</li>
							<li><strong>Date Finish</strong> ${fechaFin}</li>
							<li><strong>Hotel</strong> ${response[0].nombreHotel}</li>
							<li><strong>Guide</strong> ${response[0].nombreGuia}  ${response[0].Apellidos}</li>
							<li><strong>Duration</strong> ${duration} days</li>
						</ul>
					</div>
				</div>`;
			
			$("#info").append(template);	
			$("#nombre").html(response[0].tours);
			$("#descripcion").append(`<button class="btn btn-primary" data-toggle="modal" data-target="#compraModal">Buy</button> `);
		}		
	});
}

//Funcion para validar el formato de la fecha
function validarFormatoFecha(fecha) {
	let RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
	if ((fecha.match(RegExPattern)) && (fecha!='')) {
		  return true;
	} else {
		  return false;
	}
}

// Función para validar si la fecha introducida es real, es decir, que corresponde al calendario
function existeFecha(fecha){
	let fechaf = fecha.split("/");
	let day = fechaf[0];
	let month = fechaf[1];
	let year = fechaf[2];
	let date = new Date(year,month,'0');
	if((day-0)>(date.getDate()-0)){
		  return false;
	}
	return true;
}

//Funcion para validar si la fecha introducida es anterior o menor a la actual
function validarFechaMenorActual(date){
	let x = new Date();
	let fecha = date.split("/");
	x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
	let today = new Date();
	
	if (x >= today)
	  return false;
	else
	  return true;
}

//Funcion para cambiar el formato de la fecha
function DateInputs(fecha) { 
	date = fecha.split('-');
	dia = date[2];
	mes = date[1];
	year = date[0];

	date = dia+'/'+mes+'/'+year;
	return date;
}

function comprobarPago(){
	let nameTarjeta = $('#nameTarjeta').val();
	let numeroTarjeta = $('#numeroTarjeta').val();
	let cvc = $('#cvc').val();
	let fechaCaducidad = $('#fechaCaducidad').val();
	let pais = $('#pais').val();
	let codigoPostal = $('#codigoPostal').val();
	let numeroTuristas = $('#numTuristas').val();
	let usuario = $('#sesion').val();
	let idTour = $('#idTour').val();
	let idHotel = $('#idHotel').val();

	let parametros = "nameTarjeta="+nameTarjeta+"&numeroTarjeta="+numeroTarjeta+"&fechaCaduridad="+"&cvc="+cvc
						+fechaCaducidad+"&pais="+pais+"&codigoPostal="+codigoPostal+"&numeroTuristas="+numeroTuristas
						+"&usuario="+usuario+"&idTour="+idTour+"&idHotel="+idHotel;

	if(usuario > 0){
		//console.log(parametros);
		let error = [];
		fechaCaducidad = DateInputs(fechaCaducidad);	
		
		if(nameTarjeta == ""){
			error.push(1); //error de nombre de tarjeta
		}

		if(numeroTarjeta < 16){
			error.push(2); //para error de tarjeta
		}

		if(codigoPostal < 5){
			error.push(3); //error para codigo postal
		}

		if(validarFormatoFecha(fechaCaducidad) == false){
			error.push(4); //mal formato de fecha
		}

		if(existeFecha(fechaCaducidad) == false){
			error.push(5); //fecha no existe
		}

		if(validarFechaMenorActual(fechaCaducidad) == true){
			error.push(6); //fecha menor a la actual
		}

		if(numeroTuristas == 0){	
			error.push(7); //error turistas
		}

		if(pais == ""){
			error.push(8);
		}

		if(cvc < 3){
			error.push(9);
		}
		console.log(error); 

		if(error.length > 0){
			limpiarInputs();
			error.forEach(function(err){
				if(err == 1){ $('#nameTarjeta').attr('placeholder', 'Campo nombre Vacío'); }
				if(err == 2){ $('#numeroTarjeta').attr('placeholder', 'Mínimo 16 dígitos'); }
				if(err == 3){ $('#codigoPostal').attr('placeholder', 'Mínimo 5 dígitos'); }
				if(err == 4){ $('#fechaCaducidad').attr('placeholder', 'Mal formato de fecha'); }
				if(err == 5){ $('#fechaCaducidad').attr('placeholder', 'La fecha no existe'); }
				if(err == 6){ $('#fechaCaducidad').attr('placeholder', 'Fecha menor a la actual'); }
				if(err == 7){ $("#numTuristas").attr('placeholder', 'Turista mayor a 0'); }
				if(err == 8){ $("#pais").attr('placeholder', 'Campo país vacío'); }
				if(err == 9){ $("#cvc").attr('placeholder', 'Mínimo 3 dígitos'); }
			});
			limpiarInputs();
		}else{
			$.ajax({
				url: '../Controlador/ajax/gestionComentarios.php?accion=comprarTour',
				dataType: 'json',
				method: 'POST',
				data: parametros,
				success: function(response){
					console.log(response);
					if(response.resultado == 1){
						let monto = response.monto;
						//console.log(monto);
						limpiarInputs();
						$('#compraModal').modal('hide');
						comprar(monto);
					}
				}
			});
		}
	}else{
		alert('Debes iniciar sesion para poder comprar');
	}
}

function limpiarInputs(){
	$('#nameTarjeta').val("");
	$('#numeroTarjeta').val("");
	$('#fechaCaducidad').val("");
	$('#pais').val("");
	$('#codigoPostal').val("");
	$('#numTuristas').val("");
	$("#cvc").val("");
}

function comprar(monto){
	alert('Compra del tour por '+monto);	
}

//Agregar Comentarios 
$('#btn-comentar').click(function(e) {

	let sesion = $('#sesion').val();
	e.preventDefault();
	let comentario = $('#comentario').val();
	let tour = $('#tour').val();
	let parametros = "idusuario="+sesion+"&tour="+tour+"&comentario="+comentario;

	if(comentario=='' || tour==''){
		alert('Debes comentar algo');
	}else{
		
		$.ajax({
			url: "../Controlador/ajax/gestionComentarios.php?accion=agregarComentarios",
			dataType: 'json',
			method: 'POST',
			data: parametros,
			success: function(response){
				console.log(response);
				if(response.resp == 1){
					ComentariosporTour();
				}else{
					alert('Debes iniciar sesion para poder comentar');
					document.location.href='sign-in.php';
				}
			}		
		});
	}	
});

//Funcion para obtener el comentario por tour
function ComentariosporTour(){
	let tourID = $('#tour').val();
	console.log(tourID);

	$.ajax({
        url: '../Controlador/ajax/gestionComentarios.php?accion=ComentarioporTour',
        method: 'POST',
		dataType: 'json',
		data: {tourID: tourID},
        success: function(response){
        	console.log(response);
            let template = '';
            console.log(response);
            for(let i=0; i<response.length; i++){
				template += `
				<input type="hidden" id="idComment" value="${response[i].idComentarios}">
				<input type="hidden" id="idUser" value="${response[i].idUsuario}">
				<div class="col-md-1 col-1 mr-1">
              		<span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/user.jpg"></span>
            	</div>
            	<div class="col-md-10  col-10">
              		<div class="p-2 mb-2 color-comentario">
                		<small class="text-muted">
                 			<span class="text-primary"><b>${response[i].nombreUsuario}</b></span> 
							 ${response[i].Comentario} 
							 <span style="font-size: 14px;" class="float-right mr-2" id="btn-delete" onclick="deleteCommentDetalles(${response[i].idComentarios});" ><i class="fas fa-trash text-danger "></i></span>

               			</small>			
             		</div>
				</div>	
                `
			}
			$('#comentario').val('');
			$('#comentarios').empty();
			$('#comentarios').append(template);
			
        }
    });
}

//Funcion para borrar comentarios
function deleteCommentDetalles(idComment){
	let usuarioSesion = $('#sesion').val();
	let usuarioComment = $('#idUser').val();

	console.log('usuario comentario: '+usuarioComment);
	console.log("usuario sesion: " + usuarioSesion);
	console.log(typeof usuarioSesion === 'string');
	console.log(typeof usuarioComment === 'string');
	console.log(usuarioSesion.trim() == usuarioComment.trim());

	usuarioSesion = usuarioSesion.trim();
	usuarioComment = usuarioComment.trim();

    if (usuarioComment === usuarioSesion) {

    	$.ajax({
        	url: '../Controlador/ajax/gestionComentarios.php?accion=borrar',
        	method: 'POST',
        	dataType: 'json',
        	data: {idComment: idComment},
        	success: function(response){
        	    //console.log(response);
        	    if(response.resp == 1){
				
        	        $("#"+idComment).remove();
        	        alert("The Comment has been deleted successfully");
        	        $(document).ajaxStop(function(){ window.location.reload(); }); 
        	    }
        	}
    	});
    } else {
        alert("Cannot be deleted");
    }

}
