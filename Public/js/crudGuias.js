$(document).ready(function () {
  fetchGuides();
  fetchGuiaOpt();
});

function limpiarInput(){
  $("#idTours").val("");
  $("#nameTour").val("");
  $("#hotel").val("");
  $("#nameguide").val("");
  $("#correo").val("");
  $("#guiasOption").val("");
  $("#idGuia").val("");
  $("#idUsuario").val("");
  $("#idPersona").val("");
}

function fetchGuiaOpt(){
  $.ajax({
    url:"../Controlador/ajax/gestion-guia.php?accion=obtenerGuias",
    method:'POST',
    dataType:'json',
    success:function(res){
      //console.log("respuesta de Guias");
      //console.log(res);
      for (var i = 0; i < res.length; i++) {
        $("#guiasOption").append(`<option value="${res[i].idGuia}">${res[i].nombreCompleto}</option>`);
      }		
    }
  });
}

function fetchGuides() {
    $.ajax({
      url: '../Controlador/ajax/gestion-guia.php?accion=obtener',
      method: 'POST',
      dataType:'json',
      success: function(response) {
        let template = '';
        for (var i=0; i<response.length; i++){
            template += `
            <tr>
              <th idTours="${response[i].idTours}" scope="row">${response[i].idTours}</th>
              <td>${response[i].nombre}</td>
              <td>${response[i].nombreHotel}</td>
              <td>${response[i].nombreGuia}</td>
              <td>${response[i].email}</td>
              <td>
                <button onclick="NotificarGuia(${response[i].idGuia});" type="button" class="btn btn-info" data-toggle="modal"
                 data-target="#modal-notific">Notificar</button>
              </td>
            </tr>
            `
        }
        $('#res-guide').append(template);
      }
    });
} 


function fetchGuideID(idguia){
  $("#infoGuia").hide();
  $("#btn-addGuia").hide();
  $("#btn-editGuia").show();

  //console.log(idguia);

  $.ajax({
    url: '../Controlador/ajax/gestion-guia.php?accion=tours_id',
    method: 'POST',
    dataType: 'json',
    data: {idguia: idguia},
    success:function(resp){
      //console.log(resp);
      $("#idTours").val(resp[0].idTour);
      $("#nameTour").val(resp[0].nombre);
      $("#hotel").val(resp[0].nombreHotel);
      $("#nameguide").val(resp[0].nombreGuia);
      $("#correo").val(resp[0].email);
      $("#guiasOption").val(resp[0].idGuia);
      $("#idGuia").val(resp[0].idGuia);
      $("#idUsuario").val(resp[0].idUsuario);
      $("#idPersona").val(resp[0].idPersona);
      
    }

  });
}

function editarGuia(){
  var datos = {
    idPersona: $("#idPersona").val(),
    idGuia: $("#idGuia").val(),
    idUsuario: $("#idUsuario").val(),
    guiaCambio: $("#guiasOption").val()
  };

  //console.log(datos);
  $.ajax({
		url: '../Controlador/ajax/gestion-guia.php?accion=update',
		method: 'POST',
		dataType: 'json',
		data: datos,
		success:function(res){
      //console.log(res);
			if (res.respuesta==1) {
				$("#"+datos.idGuia).html(`
				<th scope="row">${datos.idTours}</th>
          		<td>${ $("#nameTour").val() }</td>
                <td>${ $("#hotel").val() }</td>
                <td>${ $("#nameguide").val() }</td>
                <td>${ $("#correo").val() }</td>      
              <td scope="col"> <button onclick="NotificarGuia(${datos.idGuia})";" 
              class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-notific" >Notificar</button> </td>
        `);
              
        limpiarInput();
        alert("The user profile has been updated successfully");
        $(document).ajaxStop(function(){ window.location.reload(); }); 
			}
            
		}
	});

}

function NotificarGuia(guiaid){

  //console.log(guiaid +" id del guia a enviar correo para notificar");
  
  $.ajax({
    url: '../Controlador/ajax/gestion-guia.php?accion=obtenerguia_id',
    method: 'POST',
    dataType: 'json',
    data: { guia: guiaid },
    success:function(resp){
      //console.log(resp);
      $("#emailguia").val(resp[0].email);
      $("#info-tourguia").val('Name Tour: '+resp[0].nombre + '\n'+
                              'Name Hotel: '+resp[0].nombreHotel);
    }

  });
  
}

function sendEmail(){
  var datos = { email: $("#emailguia").val(), info: $("#info-tourguia").val() };
  
  $.ajax({
    url: '../Controlador/ajax/gestion-guia.php?accion=datosCorreo',
    method: 'POST',
    dataType: 'json',
    data: datos,
    success:function(response){
      //console.log(response);
      if(response.codigo == 1){
        console.log(response.mensaje);
      }else{
        console.log(response.mensaje);
      }
    }
  });
  
}
