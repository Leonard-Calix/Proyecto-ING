$(document).ready(function($) {


		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=tours",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$('#t-res').append(` 
					<tr>
          				<th scope="row">${res[i].id}</th>
          				<td>${res[i].Nombre_Tour}</td>
          				<td>${res[i].Nombre_Estado}</td>
          				<td>${res[i].Nombre_Hotel}</td>
          				<td>${res[i].Precio_Tours}</td>
          				<td scope="col"> <button onclick="detalles(${res[i].id});" class="btn btn-outline-warning"  data-toggle="modal" data-target="#modal-video">Detalle</button> </td>
          				<td scope="col"> <button onclick="editar(${res[i].id});" class="btn btn-outline-success" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${res[i].id})";" class="btn btn-outline-danger" >Remove</button> </td>
        			</tr>`);
				}
				
			}

		});


});

function eliminar(id) {
	console.log(id);
	$("#prueba").append('<h1>'+ id +'<h1/>');
}

function editar(id) {
	console.log(id);
}

function detalles(id) {
	console.log(id);
	//$("#prueba").html('<h1>'+ id +'<h1/>');   
	$("#header").html('<h4 class="modal-title" id="modal-video-header"></h4>');

}