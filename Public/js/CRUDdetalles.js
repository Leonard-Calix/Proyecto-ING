$(document).ready(function(){
	ComentariosporTour();
	obtenerTours( $("#tour").val() );
});

function obtenerOfertas(){
	
}

function obtenerTours(id){
	$.ajax({
		url: "../Controlador/ajax/gestion-Tours.php?accion=detalle",
		dataType: 'json',
		method: 'POST',
		data: { idTours : id },
		success: function(response){
			//console.log(response);
			let fechaInicio = new Date(response[0].fecha1);
			let fechaFin =  new Date(response[0].fecha2);
			var duration = fechaFin.getTime() - fechaInicio.getTime();
			duration = duration / (1000*60*60*24);

			let options = {weekday: "long", month: "long", day: "numeric"};
			fechaInicio = fechaInicio.toLocaleDateString("es-ES", options);
			fechaFin = fechaFin.toLocaleDateString("es-ES", options);

			let template = `
				<div class="col-md-4">
					<div class="price-box popular">
						<h2 class="pricing-plan">${response[0].tours}</h2>
						<div class="price"><sup class="currency">$</sup>${response[0].precio}</div>
							<p id="descripcion"></p>
						<hr>
						<ul class="pricing-info">
							<li><strong>Date init</strong> ${fechaInicio}</li>
							<li><strong>Date Finish</strong> ${fechaFin}</li>
							<li><strong>Guide</strong> ${response[0].nombreGuia}  ${response[0].Apellidos}</li>
							<li><strong>Duration</strong> ${duration} days</li>
						</ul>
					</div>
				</div>`;
			
			$("#info").append(template);	
			$("#nombre").html(response[0].tours);
			$("#descripcion").append(` <button class="btn btn-primary" onclick="comprar( ${response[0].idtours});" >Buy</button> `);
		}		
	});
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
        	console.log(response);
            let template = '';
            console.log(response);
            for(let i=0; i<response.length; i++){
				template += `
				<input type="hidden" id="idComment" value="${response[i].idComentarios}">
				<div class="col-md-1 col-1 mr-1">
              		<span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/user.jpg"></span>
            	</div>
            	<div class="col-md-10  col-10">
              		<div class="p-2 mb-2 color-comentario">
                		<small class="text-muted">
                 			<span class="text-primary"><b>${response[i].nombreUsuario}</b></span> 
							 ${response[i].Comentario} <span style="font-size: 14px;" class="float-right mr-2" onclick="deleteCommentDetalles(${response[i].idComentarios});" ><i class="fas fa-trash text-danger "></i></span>

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


//Funcion para borrar comentarios
function deleteCommentDetalles(idComment){
    console.log($('#sesion').val());

	let usuario = $('#sesion').val();
    if (usuario != null) {

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
    } else {
        alert("Cannot be deleted");

    }

}
