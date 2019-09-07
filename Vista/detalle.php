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
    <div id="nombre_tour" ></div>
    <img class="img-fluid card-img" id="img-p" alt="...">
    <ul class="nav justify-content-center ">
      <li class="nav-item">
        <button id="btn-i" class="nav-link btn btn-defaul text-secondary" onclick="informacion();">Details</button>
      </li>
      <li class="nav-item">
        <button id="btn-t" class="nav-link active btn btn-defaul text-secondary" onclick="tours();">Commets</button>
      </li>
    </ul>
  </div>
</div>

<section id="informacion" class="p-2">
  <input type="hidden" id="tour" value=" <?php echo $_GET["id"] ?> ">
  <div class="container">
    <div class="card">
      <div class="p-3 card-header text-uppercase text-info">
        Details Tour
      </div>
      <div class="card-body">
        <div class="container p-4" id="info"></div>
        
      </div>
    </div>
  </div>
</section>

<section id="vista-tours" class="p-2" style="display: none;">
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
								<img src="../Public/img/user.jpg" alt="">
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

<?php include_once('Layouts/footer.php');?>