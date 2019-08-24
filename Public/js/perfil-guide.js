$(document).ready(function($) {
	

	$.ajax({
		url:"../Controlador/ajax/gestion-guia.php?accion=toursPorGuia",
		method:'POST',
		dataType:'json',
		data: { idguia : $("#usuario_registrado").val() },
		success:function(res){
			console.log(res);
		}

	});

	


});