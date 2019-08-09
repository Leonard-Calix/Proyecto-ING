$(document).ready(function($) {

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=tours",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de la tabla de tours");
				console.log(res);
				$('#t-res').html(" ");
				for (var i = 0; i < res.length; i++) {
					$('#t-res').append(` 
					<tr id="${res[i].id}" >
          				<th scope="row">${res[i].id}</th>
          				<td>${res[i].Nombre_Tour}</td>
          				<td>${res[i].Precio_Tours}</td>
          				<td scope="col"> <button onclick="detalles(${res[i].id});" class="btn btn-outline-warning"  data-toggle="modal" data-target="#modal-video">Detalle</button> </td>
          				<td scope="col"> <button onclick="editar(${res[i].id});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${res[i].id})";" class="btn btn-outline-danger" >Remove</button> </td>
        			</tr>`);
				}
				
			}

		});

/*INFORMACION DE PERFIL DE GUIA*/

	$.ajax({
		url: '../Controlador/ajax/gestion-Usuario.php?accion=infoProfiles',
		method: 'post',
		dataType: 'json',
		data: { idEdit : $("#idUsuario").val() },
		success:function(res){
			//console.log("Usuario");
			//console.log(res);
			$("#username").val(res[0].nombreUsuario);
			$("#email").val(res[0].email);
			$("#nombre").val(res[0].nombreCompleto);
			$("#apellido").val(res[0].Apellidos);
			$("#direccion").val(res[0].direccion);
			$("#telefono").val(res[0].telefono);
			$("#identidad").val(res[0].numeroIdentidad);

            $("#div-usuario-email").html(`<p class="description" > <span class="text-primary">Email :</span> ${res[0].email}</p>`);
            $("#div-usuario").html(`<p class="description" > <span class="text-primary">Username :</span> ${res[0].nombreUsuario}</p>`);

		}
	});


		
		$.ajax({
			url:"../Controlador/ajax/gestion-Usuario.php?accion=getGuias",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de Guias");
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$("#guiaOpt").append(`<option value="${res[i].idGuia}" >${res[i].nombreCompleto}</option>`);
				}		
			}
		});

		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=obtenerEstado",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de Estados");
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$("#estado").append(`<option value="${res[i].idEstados}" >${res[i].nombre}</option>`);
				}		
			}
		});


});

function cambio() {
	$("#new-tour").show();
	$("#registro_tours").show();

	$("#detalle-tour").hide(); 
	$("#info").hide();

	$("#edite-tour").hide();
	
	$("#btn-E").hide();
	$("#btn-G").show();
	//$("#fechaI").val("2019-07-20");
	//$("#estado").val('2');
	$("#idtours").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#precio").val("");
	$("#guia").val("");
	$("#estado").val("");
	$("#fechaI").val("");
	$("#fechaF").val("");
	$("#calificacion").val("");
	$("#cupos").val("");
}


function eliminar(id) {
	console.log(id);
	
	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=eliminarTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			console.log(res);	

			if (res.respuesta==1) {
				$("#"+id).remove();
			}
		}
	});
}

function editar(id) { // solo muestra informacion
	$("#info").hide();
	$("#new-tour").hide();
	$("#detalle-tour").hide();
	$("#edite-tour").show();
	$("#registro_tours").show();
	$("#idT").val(id);
	$("#btn-G").hide();
	$("#btn-E").show();
	
	//console.log(id);

	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=infoTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			console.log(res);
			$("#idtours").val(res[0].id);
			$("#calificacion").val(res[0].calificacion);
			$("#nombre").val(res[0].Nombre_Tour);
			$("#descripcion").val(res[0].descripcion);
			$("#precio").val(res[0].Precio_Tours);
			$("#guia").val(res[0].idGuia);
			$("#estado").val(res[0].idEstados);
			$("#fechaI").val(res[0].fechaInicio);
			$("#fechaF").val(res[0].fechaFin);
			$("#cupos").val(res[0].calificacion);	
		}
	});
}

function detalles(id) {
	$("#info").html(" ");
	$("#info").show();
	$("#detalle-tour").show(); 
	$("#new-tour").hide();
	$("#edite-tour").hide();
	$("#registro_tours").hide();


	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=detalleTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			
			console.log(res);	
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Tours</span> ${res[0].Nombre_Tour} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Estado</span> ${res[0].Nombre_Estado} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Descripcion</span> ${res[0].descripcion} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Precio</span> ${res[0].Precio_Tours} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Guia</span> ${res[0].Usuario} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Cupos</span> ${res[0].cupos} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Calificacion</span> ${res[0].calificacion} </h5>`);

		}
	});
	
}

function agregar() {

	var data = {
		nombre : $("#nombre").val(),
		descripcion : $("#descripcion").val(),
		precio : $("#precio").val(),
		guia   : $("#guia").val(),
		estado : $("#estado").val(),
		fechaI : $("#fechaI").val(),
		fechaF : $("#fechaF").val(),
		calificacion : $("#calificacion").val(),
		cupos : $("#cupos").val()
	};

	//console.log(data);

	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=agregarTours',
		method: 'post',
		dataType: 'json',
		data: data,
		success:function(res){
			console.log(res);
			if (res.respuesta!=0) {
				$("#t-res").append(`
				<tr id="${res.respuesta}" >
					<th scope="row">${res.respuesta}</th>
          			<td>${ $("#nombre").val() }</td>
          			<td>${ $("#precio").val() }</td>
          			<td scope="col"> <button onclick="detalles(${res.respuesta});" class="btn btn-outline-warning"  data-toggle="modal" data-target="#modal-video">Detalle</button> </td>
          			<td scope="col"> <button onclick="editar(${res.respuesta});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          			<td scope="col"> <button onclick="eliminar(${res.respuesta})";" class="btn btn-outline-danger" >Remove</button> </td>
				</tr>`);

			}else{

			}	
		}
	});
	//$("#fechaI").val("2019-07-20");
}
function editarReguistro(){
	//console.log("Funciona")

		var data = {
		id : $("#idtours").val(),
		nombre : $("#nombre").val(),
		descripcion : $("#descripcion").val(),
		precio : $("#precio").val(),
		guia   : $("#guia").val(),
		estado : $("#estado").val(),
		fechaI : $("#fechaI").val(),
		fechaF : $("#fechaF").val(),
		calificacion : $("#calificacion").val(),
		cupos : $("#cupos").val()
};

	//console.log(data);

	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=editarTours',
		method: 'post',
		dataType: 'json',
		data: data,
		success:function(res){
			console.log(res);
			if (res.respuesta==1) {
				$("#"+data.id).html(`
				<th scope="row">${data.id}</th>
          		<td>${ $("#nombre").val() }</td>
          		<td>${ $("#precio").val() }</td>
          		<td scope="col"> <button onclick="detalles(${data.id});" class="btn btn-outline-warning"  data-toggle="modal" data-target="#modal-video">Detalle</button> </td>
          		<td scope="col"> <button onclick="editar(${data.id});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          		<td scope="col"> <button onclick="eliminar(${data.id})";" class="btn btn-outline-danger" >Remove</button> </td>
				`);
			}
		}
	});
}


/*?=======================GUIAS=====================================*/

