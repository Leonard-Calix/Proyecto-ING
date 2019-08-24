$(document).ready(function($) {
	

	$.ajax({
		url:"../Controlador/ajax/gestion-turista.php?accion=tours_turista",
		method:'POST',
		dataType:'json',
		data: { id : $("#idt").val() },
		success:function(res){
			//console.log("respuesta de la tabla de tours");
			console.log(res);
			for (var i = 0; i < res.length; i++) {
				$("#res-tours-turista").append(`
					<div class="media text-muted p-2">
						<p class="media-body mb-3 mb-0 small lh-125 border-bottom border-gray">
							<strong class="d-block"><span class="text-info">Tour Name :</span> ${res[i].nombreTours} </strong>
							<strong class="d-block"><span class="text-info">Price :</span> ${res[i].precio}</strong>
							<strong class="d-block"><span class="text-info">Date :</span> ${res[i].fechaInicio} - ${res[i].fechaFin}</strong>
							<strong class="d-block"><span class="text-info">Days :</span> ${res[i].dias}</strong>
							<strong class="d-block"><span class="text-info">Description :</span> ${res[i].descripcion}</strong>
							${res[i].descripcion}
						</p>
					</div>`);
			}

		}

	});

	$.ajax({
		url:"../Controlador/ajax/gestion-turista.php?accion=informacion",
		method:'POST',
		dataType:'json',
		data: { id : $("#idt").val() },
		success:function(res){
			//console.log("respuesta de la tabla de tours");
			console.log(res);
			$("#nombre").html(res[0].nombreCompleto);
			$("#apellidos").html(res[0].Apellidos);
			$("#correo").html(res[0].email);


		}

	});


	$("#informacion").show();
	//$("#vista-tours").hide();
	$("#btn-i").addClass('text-info');


});


function informacion() {
	$("#vista-tours").hide(500);
	$("#informacion").fadeIn(500);
	$("#btn-i").addClass('text-info');
	$("#btn-t").removeClass('text-info');


}

function tours() {
	$("#informacion").hide(500);
	$("#vista-tours").fadeIn(500);
	$("#btn-i").removeClass('text-info');
	$("#btn-t").addClass('text-info');

}