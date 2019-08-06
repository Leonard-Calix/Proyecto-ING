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

function agregar(){

    $('#agregar').click(function () {
	
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

    
        var parametros = "nombre="+nombre+"&apellido="+apellido+"&usuario="+usuario+"&identidad="+identidadUser+
                         "&phone="+phone+"&genero="+genero+"&direccion="+direccion+"&correo="+correo+
                         "&contrasenia="+contrasenia+"&typeUser="+typeUser;
        console.log(parametros);
    
        if (nombre==" " || apellido=="" || correo==" " || usuario==" " || contrasenia==" ") {
            $('#error-login').fadeIn(500);
        }else{
    
            $.ajax({
            url:"../Controlador/ajax/gestion-Usuario.php?accion=agregar",
            dataType:'json',
            method: 'POST',
            data: parametros,
            success:function(respuesta){
                console.log(respuesta);
    
                if(respuesta.codigo != 0){
    
                    $('#nombre').val("");
                    $('#apellido').val("");
                    $('#nombre').val("");
                    $('#correo').val("");
                    $('#usuario').val("");
                    $('#contrasenia').val("");
                    
                    fetchProfiles();
                }
            }
            });
    
        }
    
        
    });

}

function EliminarUser(idUser){
    console.log(idUser);

    var id = $("#"+idUser).remove();

    $.ajax({
        url: '../Controlador/ajax/gestion-Usuario.php?accion=delete',
        method: 'POST',
        dataType: 'json',
        data: {id: id},
        success:function(res){
            console.log(res);
            fetchProfiles();
        }
    });

}

function editarUser(idUpdate){
    console.log(idUpdate);    
}
