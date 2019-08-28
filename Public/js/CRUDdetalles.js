$(document).ready(function(){
	ComentariosporTour();

	console.log("tours " + $("#tour").val() );

	obtenerTours( $("#tour").val() );


});




function obtenerTours(id){
	//console.log("nhjjhk");

	$.ajax({
			url: "../Controlador/ajax/gestion-Tours.php?accion=detalle",
			dataType: 'json',
			method: 'POST',
			data: { idTours : id },
			success: function(response){
				console.log(response);
				$("#info").append( `<p>Star/End Date ${response[0].fecha1} / ${response[0].fecha2}  <br> 
						Duration  ${response[0].duration} <br> 
						Price  ${response[0].precio} <br> 
						Guide  ${response[0].nombreGuia}  ${response[0].Apellidos}
					</p>`);	
				$("#nombre").html(response[0].tours);

				$("#descripcion").append(` <button class="btn btn-primary" onclick="comprar( ${response[0].idtours});" >Buy</button> `);

			}		
		});

	for (var i = 0; i < 4 ; i++) {
		$("#carousel").append(` <div class="carousel-item active">
              <img class="d-block w-100" src="${response[0].ruta}" alt="First slide">
            </div> `);
	}
}

function comprar(id){

	alert("se va a comprar el tour " + id );




}



//Agregar Comentarios 
$('#btn-comentar').click(function() {

	let sesion = $('#sesion').val();
	console.log('sesion:'+sesion);

	let comentario = $('#comentario').val();
	let tour = $('#tour').val();
	let parametros = "idusuario="+sesion+"&tour="+tour+"&comentario="+comentario;
	if(comentario=='' || tour==''){
		alert('Debes comentar algo');
	}else{
		
		$.ajax({
			url: "../Controlador/ajax/gestionComentarios.php?accion=agregarComentarios",
			dataType: 'json',
			method: 'POST',
			data: parametros,
			success: function(response){
				console.log(response);
				if(response.resp == 1){
					ComentariosporTour();
				}else{
					alert('Debes iniciar sesion para poder comentar');
					document.location.href='sign-in.php';
				}
			}		
		});
	}	
});

//Funcion para obtener el comentario por tour
function ComentariosporTour(){
	let tourID = $('#tour').val();
	console.log(tourID);

	$.ajax({
        url: '../Controlador/ajax/gestionComentarios.php?accion=ComentarioporTour',
        method: 'POST',
		dataType: 'json',
		data: {tourID: tourID},
        success: function(response){
            let template = '';
            console.log(response);
            for(let i=0; i<response.length; i++){
				template += `
				<input type="hidden" id="idComment" value="${response[i].idComentarios}">
				<div class="col-md-1 col-1 mr-1">
              		<span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/user.jpg"></span>
            	</div>
            	<div class="col-md-10  col-10">
              		<div class="p-2 mb-2 color-comentario" id="insert_comentario">
                		<small class="text-muted">
                 			<span class="text-primary"><b>${response[i].nombreUsuario}</b></span> 
							 ${response[i].Comentario}
							 
               			</small>			
             		</div>
				</div>	
                `
			}
			$('#comentario').val('');
			$('#comentarios').empty();
			$('#comentarios').append(template);
			
        }
    });
}
