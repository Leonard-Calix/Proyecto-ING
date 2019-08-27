$(document).ready(function($) {
	
	$.ajax({
		url:"../Controlador/ajax/gestion-guia.php?accion=toursPorGuia",
		method:'POST',
		dataType:'json',
		data: { idguia : $("#guia_registrado").val() },
		success:function(res){
			//console.log(res);
			for (var i = 0; i < res.length; i++) {
				$("#res-tours-Guide").append(`<div class="card">
  												<div class="card-body">
										    		<h5 class="card-title">${res[i].nombre}</h5>
										    		<p class="card-text"><span class="text-primary" >Descripcion</span> ${res[i].descripcion}</p>
										    		<p class="card-text"><span class="text-primary" >Fecha</span> ${res[i].fechaInicio}</p>
										    		<button onclick="getTuristas(${res[i].idtours});" class="btn btn-outline-primary">List turist</button>
										 	 	</div>
											</div>`);
			}
		}
	});

	$.ajax({
		url:"../Controlador/ajax/gestion-guia.php?accion=informacionGuia",
		method:'POST',
		dataType:'json',
		data: { idguia : $("#guia_registrado").val() },
		success:function(res){
			//console.log(res);

			$("#input-username").val(res[0].nombreUsuario);
			$("#input-email").val(res[0].email);
			$("#input-first-name").val(res[0].nombreCompleto);
			$("#input-last-name").val(res[0].Apellidos);
			$("#input-address").val(res[0].direccion);
			$("#input-phone").val(res[0].telefono);
			$("#input-id").val(res[0].numeroIdentidad);

			$("#nombreUsuario").html(`<h1 class="display-3 text-white"> Hello ${res[0].nombreUsuario} </h1>`);

			$("#usuario").html(res[0].nombreUsuario);
			$("#direccion").html(res[0].direccion);
			$("#correo").html(res[0].email);



		


			if(res[0].genero=='M'){
				$("#input-genero").val(1);
			}
			if (res[0].genero=='F') {
				$("#input-genero").val(2);
			}


			
		}
	});



});

function getTuristas(id) {
	//alert(id);
	$("#table-turis").html("");
	$('#exampleModalCenter').modal('show');

	$.ajax({
		url:"../Controlador/ajax/gestion-turista.php?accion=turistaPorTours",
		method:'POST',
		dataType:'json',
		data: { idTors : id },
		success:function(res){
			//console.log(res[0].email);

			for (var i = 0; i < res.length; i++) {

				$("#table-turis").append(`<tr>
											<td>${ i+1 }</td>
											<td>${ res[i].nombreCompleto }</td>
											<td>${ res[i].Apellidos }</td>
											<td>${ res[i].email }</td>
										</tr>`);	
	
			}
					
		}
	});

}