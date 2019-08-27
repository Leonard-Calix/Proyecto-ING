<?php 
session_start();
   
if (isset($_SESSION["usuario"]) ) {
  $usr = $_SESSION["usuario"];
}else{
  $usr = null;
}

?>
<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>
    <!-- SECTIONS
    	================================================== -->
    <!-- PAGINA DE DETALLES DE CADA TOURS
    	================================================== -->
      <section class="section" id="pages">
        <input type="hidden" id="tour" value=" <?php echo $_GET["id"] ?> ">
        <!-- Content -->
        <div class="container">
          <div class="row justify-content-center">
           <div class="col-md-8 col-lg-6">
             <!-- Heading -->
             <div id="nombre_tour" ></div>
           </div>
         </div> <!-- / .row -->

         <div class="row">

          <div  class="col-md-12">
            <!-- Image -->
            <div class="card-img-top" id="img-p"></div>
            <!-- Body -->
            <div class="card-body">
              <!-- Title -->
              <h4 class="card-title text-info" id="nombre"></h4>
              <div id="estrellas"></div> 
              <div id="info"></div>
              <!-- Body -->
              <div id="descripcion" ></div>



              <!-- / .Input Comentarios -->
              <div class="row mt-5" id="imput-cometarios" >
               <div class="col-md-1 col-sm-1 col-xs-1 col-1">
                <span><img class="rounded-circle foto-perfil" src="../Public/img/1.jpg"></span>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10 col-10">
               <div class="row">
                 <div class="col-md-9 col-sm-12 m-2 ">
                   <input type="text" class="input-comentari form-control" id="comentario" placeholder="Escribe un comentario...">
                 </div>
                 <div class="col-md-2 col-sm-12 m-2">
                 <input type="hidden" id="sesion" value="<?php echo $usr ?>">
                   <button id="btn-comentar" class="btn btn-outline-primary btn-comentar" type="button">Comentar</button>
                 </div>
               </div>
             </div>
           </div>
           <!-- / .Imput Comentarios -->
           <hr>
           <!-- / .Comentarios -->
            <div class="row" id="comentarios">   
            </div>

           <button  type="button" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#galeria">
            Galeria
          </button>

         
         <!-- / .Comentarios -->
       </div>
     </div>
   </div> <!-- / .row -->
 </div> <!-- / .container -->
</section>

<div class="modal fade" id="galeria" tabindex="-1" role="dialog" aria-labelledby="modal-video-header" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header" >

        <!-- Title -->
        <h4 class="modal-title text-uppercase" id="modal-video-header"> <span id="detalle-tour" >Galeria</span> </h4>
        <!-- Close -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" id="carousel">
            
          </div>
      </div>


      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </div>
      </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
<?php include_once('Layouts/footer.php');?>