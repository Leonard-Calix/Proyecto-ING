$(document).ready(function(){
    fetchProfiles();

    function agregar(){


    }

    function EliminarUser(idUser){
        console.log(idUser);

        var id = $('#'+idUser).remove();
        
        if(confirm('Are you sure you want to delete it?')) {
            $.ajax({
                url: '../Controlador/ajax/gestion-Usuario.php?accion=delete',
                method: 'post',
                dataType: 'json',
                data: {id: id },
                success:function(res){
                    console.log(res)

                }


            });
        }
    }
    
    function editarUser(id){
        
    }
    

    function fetchProfiles() {
        $.ajax({
          url: '../Controlador/ajax/gestion-Usuario.php?accion=getProfiles',
          type: 'GET',
          success: function(response) {
            const profiles = JSON.parse(response);
            let template = '';
            console.log(profiles);
            profiles.forEach(profiles => {
                template += `
                    <tr>
                      <th idUser = "${profiles.idUsuario}" scope="row">${profiles.idUsuario}</th>
                      <td>${profiles.nombreCompleto}</td>
                      <td>${profiles.Apellidos}</td>
                      <td>${profiles.nombreUsuario}</td>
                      <td>${profiles.email}</td>
                      <td>${profiles.direccion}</td>
                      <td>
                        <button onclick="editarUser(${profiles.idUsuario});" type="button" class="btn btn-secondary" data-toggle="modal" 
                        data-target="#exampleModal">Edit</button>
                      </td>
                      <td>
                        <button onclick="EliminarUser(${profiles.idUsuario});" type="button" class="btn btn-danger" data-toggle="modal"
                         data-target="#exampleModal2">Delete</button>
                      </td>
                    </tr>
                    `
            });
            $('#res').html(template + '<br>');
          }
        });
    }

    
});