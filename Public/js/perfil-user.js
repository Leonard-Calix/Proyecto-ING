$(document).ready(function() {
	tourTurist();
	getTuristID();
});

function getTuristID(){	
	let idTurista = $("#idTurista").val();

	$.ajax({
		url: '../Controlador/ajax/gestion-turista.php?accion=informacion',
		method: 'POST',
	  	dataType: 'json',
	  	data: {idTurista: idTurista},
	  	success:function(resp){
			console.log(resp);
			$('#input-username').val(resp[0].nombreUsuario);
			$('#input-email').val(resp[0].email);
			$('#input-first-name').val(resp[0].nombreCompleto);
			$('#input-last-name').val(resp[0].Apellidos);
			$('#direccion').val(resp[0].direccion);
			$('#input-phone').val(resp[0].telefono);
			$('#input-id').val(resp[0].numeroIdentidad);

			$('#turist-usuario').append(resp[0].nombreUsuario);
			$('#turist-usuario-email').append(resp[0].email);	
		}
	});
}


function tourTurist(){
	$.ajax({
		url:"../Controlador/ajax/gestion-turista.php?accion=tours_turista",
		method:'POST',
		dataType:'json',
		data: { id : $("#idTurista").val() },
		success:function(res){
			//console.log("respuesta de la tabla de tours");
			console.log(res);

			let fechaInicio = new Date(res[0].fechaInicio);
			let fechaFin =  new Date(res[0].fechaFin);
			var duration = fechaFin.getTime() - fechaInicio.getTime();
			duration = duration / (1000*60*60*24);

			let options = {weekday: "long", month: "long", day: "numeric"};
			fechaInicio = fechaInicio.toLocaleDateString("es-ES", options);
			fechaFin = fechaFin.toLocaleDateString("es-ES", options);

			
			for (var i = 0; i < res.length; i++) {
				$("#res-tours-turista").append(`
					<div class="col-xl-4 col-md-6 col-xs-12 col-12">
						<div class="price-box popular">
							<input type="hidden" id="idTour" value="${res[i].idtours}"> 
							<h2 class="pricing-plan">${res[i].nombreTours}</h2>
							<div class="price"><sup class="currency">$</sup>${res[i].precio}</div>
								<p id="descripcion">
									${res[i].descripcion}
								</p>
							<hr>
							<ul class="pricing-info">
								<li><strong>Date init</strong> ${fechaInicio}</li>
								<li><strong>Date Finish</strong> ${fechaFin}</li>
								<li><strong>Duration</strong> ${duration} days</li>
							</ul>
						</div>
					</div>				
				`);
			}
		}
	});
}
