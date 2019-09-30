<?php 

session_start();
   
if (isset($_SESSION["usuario"]) ) {
  $usr = $_SESSION["usuario"];
}else{
  $usr = null;
}

include_once ('Layouts/header.php');
include_once ('Layouts/navbar.php');
?>

<br><br><br><br><br>
<div class="container">
  <div class="card text-white">
    <div id="nombre_tour" class="mt-5"></div>
    <div id="foto_tour" ></div>
    <ul class="nav justify-content-center ">
      <li class="nav-item">
        <button id="btn-details" class="nav-link btn btn-defaul text-secondary" onclick="details();">Details</button>
      </li>
      <li class="nav-item">
        <button id="btn-commets" class="nav-link active btn btn-defaul text-secondary" onclick="commets();">Commets</button>
      </li>
    </ul>
  </div>
</div>

<section id="information" class="p-2">
  <input type="hidden" id="tour" value=" <?php echo $_GET["id"] ?> ">
  <div class="container-fluid p-2">
    <div class="card">
      <div class="p-3 card-header text-uppercase text-info">
        Details Tour
      </div>
      <div class="card-body">
        <div class="container" id="infoTour"></div>
        
      </div>
    </div>
  </div>
</section>


<section id="view-commets" class="p-2" style="display: none;">
  <div class="container">
    <div class="card">
      
      <div class="p-3 card-header text-uppercase text-info">
        Comments
      </div>
			<div class="col contenido-principal">
				<div class="publicar">
					<div class="row justify-content-center">
						<div class="col-auto foto">
							<a href="#">
								<img src="../Public/img/user.jpg" alt="user">
							</a>
						</div>
						<div class="col">
              <form>
                <input type="hidden" id="sesion" value="<?php echo $usr ?> ">
                <textarea name="mensaje" id="comentario" placeholder="Comentarios sobre el tour"></textarea>
                <br>
								<button id="btn-comentar" class="btn btn-outline-primary">Comment</button>
              </form>
						</div>
					</div>
				</div>
        <hr>
        <div class="row justify-content-center" id="comentarios">

        </div> 
        </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="compraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Additional Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="info">

        </div>

        <div id="registro_compra">
        <div class="row">
          <div class="col-md-6">
              <span class="list-inline">
                 <img src="../Public/img/tarjetas/cards-cc_diners_club.svg" alt="">
                 <img src="../Public/img/tarjetas/cards-cc_master_card.svg" alt="">
                 <img src="../Public/img/tarjetas/cards-cc_visa.svg" alt="">
              </span>
              <hr>
          </div>
          <br>
          <div class="col-md-6">
            <input type="hidden" name="" id="idUser">
              <div class="form-group">
               <input type="text" id="nameTarjeta" data-validation="alphanumeric" class="form-control"
               placeholder="Nombre en la tarjeta">
             </div>
          </div>
          
          <div class="col-md-6">
             <div class="form-group">
               <input type="text" id="numeroTarjeta" data-validation="alphanumeric" class="form-control"
               placeholder="Numero de Tarjeta">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <input type="date" id="fechaCaducidad" data-date-format="DD MMMM YYYY" class="form-control"
               placeholder="Fecha de Caducidad">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <input type="number" id="cvc" class="form-control" placeholder="CVC">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <input type="text" id="pais" class="form-control" placeholder="País">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <input type="text" id="codigoPostal" class="form-control" placeholder="Código Postal">
             </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
               <input type="number" id="numTuristas" class="form-control" placeholder="Numero de Turistas">
             </div>
          </div>

      </div> 
      <div class="modal-footer">
        <button  type="button" onclick="limpiarInputs();"class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  id="btn-add" onclick="comprobarPago();" class="btn btn-primary">Pay Tour</button>
      </div>
    </div>
  </div>
</div>
</div>


<?php include_once('Layouts/footer.php');?>