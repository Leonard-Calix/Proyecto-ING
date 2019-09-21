$(document).ready(function(){
	getGuideID();
	getTours();
	getTurist();
});


function getGuideID(){	
	let idguia = $("#idGuia").val();

	$.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=informacionGuia',
		method: 'POST',
	  	dataType: 'json',
	  	data: {idguia: idguia},
	  	success:function(resp){
			console.log(resp);
			$('#input-username').val(resp[0].nombreUsuario);
			$('#input-email').val(resp[0].email);
			$('#input-first-name').val(resp[0].nombreCompleto);
			$('#input-last-name').val(resp[0].Apellidos);
			$('#direccion').val(resp[0].direccion);
			$('#input-phone').val(resp[0].telefono);
			$('#input-id').val(resp[0].numeroIdentidad);

			$('#guide-usuario').append(resp[0].nombreUsuario);
			$('#guide-usuario-email').append(resp[0].email);	
		}
	});
}


function getTours(){
	let idguia = $("#idGuia").val();
	//console.log(idguia);
	$.ajax({
		url:'../Controlador/ajax/gestion-guia.php?accion=toursPorGuia',
		method: 'POST',
		dataType: 'json',
		data: {idguia: idguia},
		success: function(response){
			console.log(response);
			let template = '';
			for (var i=0; i<response.length; i++){
				template += `
				<tr>
				  <th idUser="${response[i].idtours}" scope="row">${i+1}</th>
				  <td>${response[i].nombre}</td>
				  <td>${response[i].nombreHotel}</td>
				  <td>${response[i].estado}</td>
				  <td>${response[i].precio} $</td>
				  <td>${response[i].dias} days</td>  
				`
			}
			$('#tourGuide').append(template);
			
		}
	});
}

function getTurist(){
	let idguia = $('#idGuia').val();

	$.ajax({
		url:'../Controlador/ajax/gestion-turista.php?accion=turistaPorTours',
		method: 'POST',
		dataType: 'json',
		data: {idguia: idguia},
		success: function(response){
			console.log(response);
			let template = '';
			for (var i=0; i<response.length; i++){
				template += `
				<tr>
				  <th idUser="${response[i].idtours}" scope="row">${i+1}</th>
				  <td>${response[i].nombre}</td>
				  <td>${response[i].nombreHotel}</td>
				  <td>${response[i].nombreCompleto}  ${response[i].Apellidos}</td>		   
				`
			}
			$('#turistGuide').append(template);	
		}
	});
}

