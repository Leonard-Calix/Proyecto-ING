$(document).ready(function(){
	
});

function removeFavorites(id) {
	
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=removeFavoritos",
		dataType: 'json',
		method: 'POST',
		data: { idTours: id },
		success: function(response){
			console.log(response);
			
				
		}		
	});
}

function obtenerTours(argument) {

	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=obtenerToursFavoritos",
		dataType: 'json',
		method: 'POST',
		data: { idTours: id },
		success: function(response){
			console.log(response);
			
				
		}		
	});
}

function addFavorites(id) {
	
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=agregarFavoritos",
		dataType: 'json',
		method: 'POST',
		data: { idTours: id },
		success: function(response){
			console.log(response);
			
				
		}		
	});


}