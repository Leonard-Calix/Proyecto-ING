$(document).ready(function () {
	fetchGuides();
});

function fetchGuides() {
    $.ajax({
      url: '../Controlador/ajax/gestion-guia.php?accion=obtener',
      method: 'POST',
      dataType:'json',
      success: function(response) {
        //console.log(response);
        let template = '';
        console.log(response[0].idTours);

        for (var i=0; i<response.length; i++){
            template += `
            <tr>
              <th idTours="${response[i].idTours}" scope="row">${response[i].idTours}</th>
              <td>${response[i].nombre}</td>
              <td>${response[i].nombreHotel}</td>
              <td>${response[i].nombreGuia}</td>
              <td>${response[i].email}</td>
              <td>
                <button onclick="editarGuide(${response[i].idTours});" type="button" class="btn btn-secondary" data-toggle="modal" 
                data-target="#exampleModal">Edit</button>
              </td>
              <td>
                <button onclick="EliminarGuia(${response[i].idTours});" type="button" class="btn btn-info" data-toggle="modal"
                 data-target="#exampleModal2">Notificar</button>
              </td>
            </tr>
            `
        }
        $('#res-guide').append(template);
      }
    });
}    

