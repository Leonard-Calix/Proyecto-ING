$(document).ready(function () {
	$.ajax({
			url:"../Controlador/ajax/gestion-guia.php?accion=obtener",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de la tabla de guias");
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$('#t-res').append(` 
					<tr id="${res[i].idGuia}" >
          				<th scope="row">${res[i].id}</th>
          				<td>${res[i].nombreCompleto}</td>
          				<td>${res[i].Apellidos}</td>
          				<td>${res[i].nombreUsuario}</td>
          				<td>${res[i].email}</td>
          				<td>${res[i].direccion}</td>
          				<td scope="col"> <button onclick="infoGuia(${res[i].idPersona}, ${res[i].idUsuario});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${res[i].idPersona}, ${res[i].idUsuario},${res[i].idGuia} )";" class="btn btn-outline-danger" >Remove</button> </td>
        			</tr>`);
				}
				
			}

		});
});


function infoGuia(idPersona, idUsuario, idGuia){

	var dato = {
		idPersona : idPersona,
		idUsuario : idUsuario,
		idGuia : idGuia

	};

	$(".update").show();
	$(".save").hide();

	$.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=infoGuia',
		method: 'post',
		dataType: 'json',
		data: data,
		success:function(res){
			console.log(res);
			if (res.respuesta==1) {
				$("#idGuia").val(idGuia);
				$("#idPersona").val(idPersona);
				$("#idUsuario").val(idUsuario);
				$("#nameguide").val();
				$("#apellido").val();
				$("#username").val();
				$("#identidad").val();
				$("#phone").val();
				$("#genero").val();
				$("#direccion").val();
				$("#correo").val();
				$("#contrasenia").val();

			}

		}
	});

}

function editarGuia(){
	var data = {
		idGuia : $("#idGuia").val(),
		idPersona : $("#idPersona").val(),
		idUsuario : $("#idUsuario").val(),
		nombre : $("#nameguide").val(),
		apellido : $("#apellido").val(),
		username : $("#username").val(),
		identidad   : $("#identidad").val(),
		telefono : $("#phone").val(),
		genero : $("#genero").val(),
		direccion : $("#direccion").val(),
		email : $("#correo").val(),
		contrasenia : $("#contrasenia").val()
	};

	console.log(data);

	$.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=editarGuia',
		method: 'post',
		//dataType: 'json',
		//data: data,
		success:function(res){
			console.log(res);
			if (res.respuesta==1) {
					$('#'+id).html(` 
          				<th scope="row">${res[i].id}</th>
          				<td>${res[i].nombreCompleto}</td>
          				<td>${res[i].Apellidos}</td>
          				<td>${res[i].nombreUsuario}</td>
          				<td>${res[i].email}</td>
          				<td>${res[i].direccion}</td>
          				<td scope="col"> <button onclick="infoGuia(${$("#idPersona").val()}, ${$("#idUsuario").val()}, ${$("#idGuia").val()});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${$("#idPersona").val()}, ${$("#idUsuario").val()}, ${$("#idGuia").val()} )";" class="btn btn-outline-danger" >Remove</button> </td>
        			`);

			}		
		}
	});
}

function agregarGuia() {

	var data = {
		nombre : $("#nameguide").val(),
		apellido : $("#apellido").val(),
		username : $("#username").val(),
		identidad   : $("#identidad").val(),
		telefono : $("#phone").val(),
		genero : $("#genero").val(),
		direccion : $("#direccion").val(),
		email : $("#correo").val(),
		contrasenia : $("#contrasenia").val()
	};

	console.log(data);
	
	$.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=agregarGuias',
		method: 'post',
		//dataType: 'json',
		data: data,
		success:function(res){
			console.log(res);
			if (res.respuesta==1) {
				$('#t-res').append(` 
					<tr id="${res[i].idGuia}" >
          				<th scope="row">${res[i].id}</th>
          				<td>${$("#nameguide").val()}</td>
          				<td>${$("#apellido").val()}</td>
          				<td>${$("#username").val()}</td>
          				<td>${$("#correo").val()}</td>
          				<td>${$("#direccion").val()}</td>
          				<td scope="col"> <button onclick="infoGuia(${res[i].idPersona}, ${res[i].idUsuario});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${res[i].idPersona}, ${res[i].idUsuario},${res[i].idGuia} )";" class="btn btn-outline-danger" >Remove</button> </td>
        			</tr>`);
			}


		}
	});

}


function cambio(){

	$(".update").hide();
	$(".save").show();

}

