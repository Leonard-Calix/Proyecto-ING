$(document).ready(function($) {


		$.ajax({
			url:"../Controlador/ajax/gestion-Tours.php?accion=tours",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de la tabla de tours");
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$('#t-res').append(` 
					<tr id="${res[i].id}" >
          				<th scope="row">${res[i].id}</th>
          				<td>${res[i].Nombre_Tour}</td>
          				<td>${res[i].Nombre_Estado}</td>
          				<td>${res[i].Nombre_Hotel}</td>
          				<td>${res[i].Precio_Tours}</td>
          				<td scope="col"> <button onclick="detalles(${res[i].id});" class="btn btn-outline-warning"  data-toggle="modal" data-target="#modal-video">Detalle</button> </td>
          				<td scope="col"> <button onclick="editar(${res[i].id});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          				<td scope="col"> <button onclick="eliminar(${res[i].id})";" class="btn btn-outline-danger" >Remove</button> </td>
        			</tr>`);
				}
				
			}

		});

		$.ajax({
			url:"../Controlador/ajax/gestion-Usuario.php?accion=obtenerGuias",
			method:'POST',
			dataType:'json',
			success:function(res){
				console.log("respuesta de Guias");
				console.log(res);
				for (var i = 0; i < res.length; i++) {
					$("#guia").append(`<option value="${res[i].idguia}" >${res[i].nombreCompleto}</option>`);
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


function eliminar(id) {
	console.log(id);

	$("#"+id).remove();
	
	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=eliminarTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			console.log(res);	
		}
	});
}

function editar(id) {
	$("#info").hide();
	$(".new").hide();
	$(".detalle").hide();
	$(".edite").show();
	$("#registro_tours").show();
	$("#idT").val(id);

	var data = {
		id 	   : $("#idT").val(),
		nombre : $("#nombre").val(),
		precio : $("#precio").val(),
		guia   : $("#guia").val(),
		estado : $("#estado").val(),
		fechaI : $("#fechaI").val(),
		fechaf : $("#fechaF").val(),
		calificacion : $("#calificacion").val(),
		cupos : $("#cupos").val()
	};


	console.log(id);
	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=editarTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			console.log(res);	
		}
	});
}


function detalles(id) {
	$("#info").html(" ");
	$(".detalle").show(); 
	$(".new").hide();
	$("#info").show();
	$("#registro_tours").hide();

	$("#header").html('<h4 class="modal-title" id="modal-video-header"></h4>');

	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=detalleTours',
		method: 'post',
		dataType: 'json',
		data: {id: id },
		success:function(res){
			console.log(res);	
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Tours</span> ${res[0].Nombre_Tour} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Descripcion</span> ${res[0].descripcion} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Hotel</span> ${res[0].Nombre_Hotel} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Precio</span> ${res[0].Precio_Tours} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Guia</span> ${res[0].Usuario} </h5>`);
			$("#info").append(`<h5 class="card-title"> <span class="text-primary font-weight-bold">Cupos</span> ${res[0].cupos} </h5>`);
		}
	});
	
}

function cambio() {
	$(".detalle").hide(); 
	$(".edite").hide();
	$("#info").hide();
	$(".new").show();
	$("#registro_tours").show();
	//$("#fechaI").val("2019-07-20");
	//$("#estado").val('2');

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

	console.log(data);

	$.ajax({
		url: '../Controlador/ajax/gestion-Tours.php?accion=agregarTours',
		method: 'post',
		//dataType: 'json',
		data: data,
		success:function(res){
			console.log(res);	
		}
	});
	//$("#fechaI").val("2019-07-20");
}

/*?=======================GUIAS=====================================*/

function editarGuia(id) {
	console.log(id);
	
}

function agregarGuia(id) {
	console.log(id);
}