$(document).ready(function(){
	getGuideID();
});

function getGuideID(){	
	let idguia = $("#idUsuario").val();
	
	console.log('usuario: '+idguia);
	$.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=informacionGuia',
		method: 'POST',
	  	dataType: 'json',
	  	data: {idguia: idguia},
	  	success:function(resp){
			console.log(resp);
			
		}
	});
}


