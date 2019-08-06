$(document).ready(function(){
    fetchProfiles();

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
                        <button onclick="editarUser();" type="button" class="btn btn-secondary" data-toggle="modal" 
                        data-target="#exampleModal">Edit</button>
                      </td>
                      <td>
                        <button onclick="EliminarUser();" type="button" class="btn btn-danger" data-toggle="modal"
                         data-target="#exampleModal2" id="delete">Delete</button>
                      </td>
                    </tr>
                    `
            });
            $('#res').html(template + '<br>');
          }
        });
    }

    function editarUser($id){
        
    }
    
    function EliminarUser(){
        let id = $('idUser').val();

        if(confirm('Are you sure you want to delete it?')) {
              $.post('../Controlador/gestion-Usuario.php?accion=detete', {id}, (response) => {
                fetchProfiles();
              });
        }
    }
   

});