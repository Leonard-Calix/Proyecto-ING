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
              <h4 class="card-title"></h4> 
              <!-- Body -->
              <div id="descripcion"></div>

              <!-- / .Input Comentarios -->
              <div class="row" id="imput-cometarios" >
               <div class="col-md-1 col-sm-1 col-xs-1 col-1">
                <span><img class="rounded-circle foto-perfil" src="../Public/img/1.jpg"></span>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-10 col-10">
               <div class="row">
                 <div class="col-md-9 col-sm-12 m-2 ">
                   <input type="text" class="input-comentari form-control" id="comentario" placeholder="Escribe un comentario...">
                 </div>
                 <div class="col-md-2 col-sm-12 m-2">
                 <input type="hidden" id="sesion" value="<?php echo $usr ?> ">
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
         
         <!-- / .Comentarios -->
       </div>
     </div>
   </div> <!-- / .row -->
 </div> <!-- / .container -->
</section>
<?php include_once('Layouts/footer.php');?>