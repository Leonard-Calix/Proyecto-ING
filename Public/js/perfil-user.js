$(document).ready(function($) {
	console.log("listo");

	$.ajax({
		url:"../Controlador/ajax/gestion-turista.php?accion=tours_turista",
		method:'POST',
		dataType:'json',
		data: { id : $("#idt").val() },
		success:function(res){
			//console.log("respuesta de la tabla de tours");
			//console.log(res);

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