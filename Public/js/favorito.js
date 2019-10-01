$(document).ready(function(){

	obtenerToursF();
	
});

function removeFavorites(id) {
	
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=removeFavoritos",
		dataType: 'json',
		method: 'POST',
		data: { id : id },
		success: function(response){
			console.log(response.mensaje);

			if (response.resultado==1) {
				$("#res-remove-1").html(`<p>${response.mensaje}</p>`);
				$("#alert-remove").fadeIn(500);
				setTimeout(function(){ $("#alert-remove").fadeOut(500); }, 2000);

			} else {
				$("#res-add-1").html(`<p>${response.mensaje}</p>`);
				$("#alert-add").fadeIn(500);
				setTimeout(function(){ $("#alert-add").fadeOut(500);  }, 2000);

			}

			
			
				
		}		
	});
}



function addFavorites(id) {
	
	//console.log(id);

	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=addFavoritos",
		dataType: 'json',
		method: 'POST',
		data: { id : id },
		success: function(response){
			console.log(response);

			if (response.resultado==1) {
				$("#res-add-1").html(`<p>${response.mensaje}</p>`);
				$("#alert-add").fadeIn(500);
				setTimeout(function(){ $("#alert-add").fadeOut(500); }, 2000);

			} else {
				$("#res-remove-1").html(`<p>${response.mensaje}</p>`);
				$("#alert-remove").fadeIn(500);
				setTimeout(function(){ $("#alert-remove").fadeOut(500);  }, 2000);

			}
		}		
	});

}

function obtenerToursF() {
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=obtenerToursFavoritos",
		dataType: 'json',
		method: 'POST',
		success: function(res){
			console.log(res);

			$('#toursF').html(" ");
			for (var i = 0; i < res.length; i++) {
				$('#toursF').append(` 
				<tr id="${res[i].idtours}" >
        			<td>${i +1 }</td>
        			<td>${res[i].nombre}</td>
        			<td scope="col"><button onclick="addFavorites(${res[i].idtours});" class="btn btn-outline-primary">Add</button> </td>
          			<td scope="col"> <button onclick="removeFavorites(${res[i].idtours});" class="btn btn-outline-danger">remove</button> </td>
        		</tr>`);
			}
			
				
		}		
	});
}















