$(document).ready(function(){
    fetchProfiles();
});

function fetchProfiles() {
    $.ajax({
      url: '../Controlador/ajax/gestion-Usuario.php?accion=getProfiles',
      method: 'POST',
      dataType:'json',
      success: function(response) {
        //const profiles = JSON.parse(response);
        let template = '';
        console.log(response);
        for (var i=0; i<response.length; i++){
            template += `
            <tr>
              <th idUser = "${response[i].idUsuario}" scope="row">${response[i].idUsuario}</th>
              <td>${response[i].nombreCompleto}</td>
              <td>${response[i].Apellidos}</td>
              <td>${response[i].nombreUsuario}</td>
              <td>${response[i].email}</td>
              <td>${response[i].direccion}</td>
              <td>
                <button onclick="editarUser(${response[i].idUsuario});" type="button" class="btn btn-secondary" data-toggle="modal" 
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
    
    console.log(parametros);
    
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
                    
                    fetchProfiles();
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
        data: {id: idUser},
        success:function(res){
            console.log(res);
            if(res == 1){
                $("#"+idUser).remove();
                fetchProfiles();
            }
            
        }
    });

}

function editarUser(idUpdate){
    console.log(idUpdate);
    
    $("#btn-add").hide();
    $("#btn-edit").show();
    
    var datos = {
        idUpdate: $('#idUpdate').val(idUpdate),
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

    $.ajax({
		url: '../Controlador/ajax/gestion-Usuario.php?accion=update',
		method: 'POST',
		dataType: 'json',
		data: {id: idUpdate},
		success:function(res){
            console.log(res);
            $('#idUpdate').val(res[0].idUsuario),
            $('#nameUser').val(res[0].nombre),
            $('#apellidoUser').val(res[0].apellido),
            $('#correo').val(),
            $('#username').val(),
            $('#identidad').val(),
            $('#phone').val(),
            $('#genero').val(),
            $('#direccion').val(),
            $('#contrasenia').val(),
            $('input[name="typeUser"]:checked').val()
	
		}
	});


}
