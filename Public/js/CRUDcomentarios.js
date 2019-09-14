$(document).ready(function(){
    fetchComments();
});

//Funcion keyup para realizar la busqueda de comentarios
$(document).on('keyup', '#search', function(){
    let search = $(this).val();

    if(search != ""){
        searchComment(search);
    }else{
        fetchComments();
    }
});

//Funcion para obtener los comentarios
function fetchComments(){
    $.ajax({
        url: '../Controlador/ajax/gestionComentarios.php?accion=getComentarios',
        method: 'POST',
        dataType: 'json',
        success: function(response){
            let template = '';
            //console.log(response)
            for(let i=0; i<response.length;i++){
                template += `
                    <tr>
                        <th idcomentario="${response[i].idComentarios}" scope="row">${response[i].idComentarios}</th>
                        <td>${response[i].nombreUsuario}</td>
                        <td>${response[i].nombre}</td>
                        <td>${response[i].Comentario}</td>
                        <td>
                            <button onclick="deleteComment(${response[i].idComentarios});" type="button" class="btn btn-outline-danger" data-toggle="modal"
                            data-target="#commentModal">Delete</button>
                        </td>
                    </tr>
                `
            }
            $('#comments').empty();
            $('#comments').append(template);
        }
    });
}

//Funcion para buscar comentarios en tiempo real
function searchComment(search){
    console.log(search);
    $.ajax({
        url: '../Controlador/ajax/gestionComentarios.php?accion=buscar',
        method: 'POST',
        dataType: 'json',
        data: {search: search},
        success: function(response){
            let template = '';
            
            for(let i=0; i<response.length; i++){
                template += `
                    <tr>
                        <th idcomentario="${response[i].idComentarios}" scope="row">${response[i].idComentarios}</th>
                        <td>${response[i].nombreUsuario}</td>
                        <td>${response[i].nombre}</td>
                        <td>${response[i].Comentario}</td>
                        <td>
                            <button onclick="deleteComment(${response[i].idComentarios});" type="button" class="btn btn-outline-danger"
                            >Delete</button>
                        </td>
                    </tr>
                `
            }
            $('#comments').empty();
            $('#comments').append(template);
        }
    });
}

//Funcion para borrar comentarios
function deleteComment(idComment){
    console.log(idComment);
    $.ajax({
        url: '../Controlador/ajax/gestionComentarios.php?accion=borrar',
        method: 'POST',
        dataType: 'json',
        data: {idComment: idComment},
        success: function(response){
            console.log(response);
            if(response.resp==1){
                
                $("#"+idComment).remove();
                alert("The Comment has been deleted successfully");
                $(document).ajaxStop(function(){ window.location.reload(); }); 
            }
        }
    });

}

