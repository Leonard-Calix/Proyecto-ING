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
        <div id="info"></div>
        
      </div>
    </div>
  </div>
</section>

<section id="vista-tours" class="p-2" style="display: none;">
  <div class="container">
    <div class="card">
      <input type="hidden" id="idt" value=" <?php echo $usr ?> ">
      <input type="hidden" id="userGuide" value=" <?php echo $usr ?> ">

      <div class="p-3 card-header text-uppercase text-info">
        Comments
      </div>
      <div class="card-body">
        <div class="row mt-5">
          <div class="col-md-1 col-1 mr-1">
            <span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/user.jpg"></span>
          </div>
          <div class="col-md-10 col-10">
            <div class="row">
              <div class="col-md-9 col-sm-12">
                <input type="text" class="form-control" id="comentario" placeholder="Escribe un comentario...">
              </div>
              <div class="col-md-2 col-sm-12">
                <input type="hidden" id="sesion" value="<?php echo $usr ?>">
                <button id="btn-comentar" class="btn btn-outline-primary btn-comentar" type="button">Comentar</button>
              </div>
            </div>
            <hr>
            <div class="row mt-5" id="comentarios"></div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once('Layouts/footer.php');?>