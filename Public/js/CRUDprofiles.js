
$(document).ready(function(){
    fetchProfiles();
});

function cambioprofiles() {
	$(".detalle").hide(); 
	$(".edite").hide();
	$("#info").hide();
	$(".new").show();
	$("#registro_profiles").show();
	$("#btn-edit").hide();
	$("#btn-add").show();

    $('#nameUser').val("");
}

function fetchProfiles() {
    $.ajax({
      url: '../Controlador/ajax/gestion-Usuario.php?accion=getProfiles',
      method: 'POST',
      dataType:'json',
      success: function(response) {
        //const profiles = JSON.parse(response);
        let template = '';
        console.log(response[0].idUsuario);

        for (var i=0; i<response.length; i++){
            template += `
            <tr>
              <th idUser="${response[i].idUsuario}" scope="row">${response[i].idUsuario}</th>
              <td>${response[i].nombreCompleto}</td>
              <td>${response[i].Apellidos}</td>
              <td>${response[i].nombreUsuario}</td>
              <td>${response[i].email}</td>
              <td>${response[i].direccion}</td>
              <td>
                <button onclick="fetchEditar(${response[i].idUsuario});" type="button" class="btn btn-secondary" data-toggle="modal" 
                data-target="#exampleModal">Edit</button>
              </td>
              <td>
                <button onclick="EliminarUser(${response[i].idUsuario});" type="button" class="btn btn-danger" data-toggle="modal"
                 data-target="#exampleModal2">Delete</button>
              </td>
            </tr>
            `
        }
        $('#res').append(template);
      }
    });
}    

function agregarUser(){
    
    $("#btn-edit").hide();
    
    var nombre = $('#nameUser').val();
    var apellido = $('#apellidoUser').val();
    var correo = $('#correo').val();
    var usuario = $('#username').val();
    var identidadUser = $('#identidad').val();
    var phone = $('#phone').val();
    var genero = $('#genero').val();
    var direccion = $('#direccion').val();
    var contrasenia = $('#contrasenia').val();

    if ($('input[name="typeUser"]').is(':checked')) {
        var typeUser = $('input[name="typeUser"]:checked').val();
    } else {
        alert('Se debe seleccionar un tipo de usuario');
    }

    
    var parametros = "nombre="+nombre+"&apellido="+apellido+"&identidad="+identidadUser+
                    "&phone="+phone+"&genero="+genero+"&direccion="+direccion+"&usuario="+usuario+
                    "&correo="+correo+"&contrasenia="+contrasenia+"&typeUser="+typeUser;
    
    //console.log(parametros);
    
    if (nombre==" " || apellido=="" || correo==" " || usuario==" " || contrasenia==" ") {
        alert('Datos Vacios');
    }else{
    
        $.ajax({
            url:"../Controlador/ajax/gestion-Usuario.php?accion=agregar",
            dataType:'json',
            method: 'POST',
            data: parametros,
            success:function(respuesta){
                console.log(respuesta);
    
                if(respuesta.codigo != 0){
    
                    $('#nameUser').val("");
                    $('#apellidoUser').val("");
                    $('#correo').val("");
                    $('#username').val("");
                    $('#identidad').val("");
                    $('#phone').val("");
                    $('#genero').val("");
                    $('#direccion').val("");
                    $('#contrasenia').val("");
                    
                    alert("The user profile has been add successfully");
                    $(document).ajaxStop(function(){ window.location.reload(); });
                }
            }
        });
    
    }
}

function EliminarUser(idUser){
    console.log(idUser);

    $.ajax({
        url: '../Controlador/ajax/gestion-Usuario.php?accion=delete',
        method: 'POST',
        dataType: 'json',
        data: {idUser: idUser},
        success:function(res){
            console.log(res.resp);
            if(res.resp==1){
                $("#"+idUser).remove();
                alert("The user profile has been deleted successfully");
                $(document).ajaxStop(function(){ window.location.reload(); }); 
            }
            
        }
    });

}

function fetchEditar(idEdit){
    $("#info").hide();
    $("#registro_profiles").show();
    $("#idUser").val(idEdit);
    $("#btn-add").hide();
    $("#btn-edit").show();
    //console.log("ID = " + idEdit );

    $.ajax({
        url: '../Controlador/ajax/gestion-Usuario.php?accion=infoProfiles',
        method: 'POST',
        dataType: 'json',
        data: { idEdit: idEdit },
        success:function(resp){
            console.log(resp);
            $("#idUser").val(resp[0].idUsuario);
            $("#nameUser").val(resp[0].nombreCompleto);
            $("#apellidoUser").val(resp[0].Apellidos);
            $("#username").val(resp[0].nombreUsuario);
            $("#identidad").val(resp[0].numeroIdentidad);
            $("#phone").val(resp[0].telefono);
            $("#genero").val(resp[0].genero);
            $("#direccion").val(resp[0].direccion);
            $("#correo").val(resp[0].email);
            $("contrasenia").val(resp[0].contrasena);
        }

    });
    
}

function editarUser(){

    $("#btn-add").hide();
    $("#btn-edit").show();
    
    var datos = {
        idUpdate: $('#idUser').val(),
        nombre : $('#nameUser').val(),
        apellido : $('#apellidoUser').val(),
        correo : $('#correo').val(),
        usuario : $('#username').val(),
        identidadUser : $('#identidad').val(),
        phone : $('#phone').val(),
        genero : $('#genero').val(),
        direccion : $('#direccion').val(),
        contrasenia : $('#contrasenia').val(),
        typeUser : $('input[name="typeUser"]:checked').val()
    }
    
    //console.log(datos);

    $.ajax({
		url: '../Controlador/ajax/gestion-Usuario.php?accion=update',
		method: 'POST',
		dataType: 'json',
		data: datos,
		success:function(res){
            console.log(res);
			if (res.respuesta==1) {
				$("#"+datos.idUpdate).html(`
				<th scope="row">${datos.idUpdate}</th>
          		<td>${ $("#nameUser").val() }</td>
                <td>${ $("#apellidoUser").val() }</td>
                <td>${ $("#correo").val() }</td>
                <td>${ $("#username").val() }</td>
                <td>${ $("#identidad").val() }</td>
                <td>${ $("#phone").val() }</td>
                <td>${ $("#genero").val() }</td>  
                <td>${ $("#direccion").val() }</td>
                <td>${ $("#contrasenia").val() }</td>
                <td>${ $("input[name='typeUser']:checked").val() }</td>
          		<td scope="col"> <button onclick="editarUser(${datos.idUpdate});" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-video" >Edit</button> </td>
          		<td scope="col"> <button onclick="EliminarUser(${datos.idUpdate})";" class="btn btn-outline-danger" >Remove</button> </td>
                `);
                alert("The user profile has been updated successfully");
                $(document).ajaxStop(function(){ window.location.reload(); }); 
			}
            
		}
	});

}
