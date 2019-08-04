<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>

    <!-- SECTIONS
    	================================================== -->
    <!-- PAGINA DE DETALLES DE CADA TOURS
    	================================================== -->
      
      <section class="section section-top section-full" id="pages">
        <input type="hidden" id="tour" value=" <?php echo $_GET["id"] ?> ">

        
      <div class="bg-slider">
        <div class="slider slider-no-controls slider-no-draggable slider-fade" id="hero-slider-bg">
            <div class="slider-item">
              <!-- Cover Imagen fondo-->
              <div id="imagenFondo" class="bg-cover" style="background-image: url(../Public/img/tours/t1_01.jpg)"></div>
            </div>
        </div>
      </div>

        
      <div class="bg-overlay"></div>

        
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

        
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-8 col-lg-7 order-md-2">
            <div id="hero-slider" class="slider slider-no-controls slider-no-draggable slider-fade mb-5 mb-md-0"      data-bind="slider" data-target="#hero-slider-bg">
              <div class="slider-item">

                  <!-- nombre -->
                  <h1 class="text-white text-center mb-4" id= "nombreTour">
                    Nombre
                  </h1>

                  <!-- descripcion -->
                  <p class="lead text-white text-muted text-center mb-5" id="descripcion">
                    Incline is set of landing and support pages aimed at helping companies promote new products and business launches.
                  </p>

                  <!-- Button Comprar -->
                  <p class="text-center mb-0">
                    <a href="#" class="btn btn-outline-primary text-white" id="comprar">
                      Comprar 
                    </a>
                  </p>
                </div>
            </div>
        </div>
      </div> <!-- / .row -->
        </div> <!-- / .container -->
      </section>
       <!-- Tabla de datos --> 
      <table class="table" id=tablaDatos>
        <thead>
          <tr><td>Precio</td><td>Cupos</td> <td>Calificacion</td> <td>Guia</td></tr>
              
        </thead> 
        <tbody>
            <tr><td>15$</td><td >30</td><label for="calificacion"></label><td></td>
              <td>Pancho</td> 
        </tbody>

          </table>

          

      <section class="section" >
        
        <!-- Content -->

        <div class="container">

          <div class="row justify-content-center">

           <div class="col-md-8 col-lg-6">
             <!-- Heading -->
             
             <!-- Subheading -->
            
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

              <div id="res" class="slider slider-hightlight slider-no-controls" data-slider-binded=".slider">
                
                 <div class="slider-item col-lg-3 col-6 col-md-3">
                  <img src="../Public/img/tours/t1_01.jpg" class="img-fluid" alt="...">
                </div>
                 <div class="slider-item col-lg-3 col-6 col-md-3">
                  <img src="../Public/img/tours/t1_02.jpg" class="img-fluid" alt="...">
                </div>
                 <div class="slider-item col-lg-3 col-6 col-md-3">
                  <img src="../Public/img/tours/t1_03.png" class="img-fluid" alt="...">
                </div>
                 <div class="slider-item col-lg-3 col-6 col-md-3">
                  <img src="../Public/img/tours/t1_04.jpg" class="img-fluid" alt="...">
                </div>
                 <div class="slider-item col-lg-3 col-6 col-md-3">
                  <img src="../Public/img/tours/t1_05.jpg" class="img-fluid" alt="...">
                </div>
                
              </div>

              <br><br>
              
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
                   <button id="btn-comentar" class="btn btn-outline-primary btn-comentar" type="button">Comentar</button>
                 </div>
               </div>
             </div>
           </div>
           <!-- / .Imput Comentarios -->
           <hr>
           <!-- / .Comentarios -->
           <div class="row" id="comentarios">
             <div class="col-md-1 col-1 mr-1">
              <span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/1.jpg"></span>
            </div>
            <div class="col-md-10  col-10">
              <div class="p-2 mb-2 color-comentario" >
                <small class="text-muted">
                 <span class="text-primary"><b>Lio Messi</b></span> 
                 Muy buen sitio
               </small>			
             </div>
           </div>
         </div>
         <!-- / .Comentarios -->
       </div>
     </div>
   </div> <!-- / .row -->
 </div> <!-- / .container -->
</section>
<?php include_once('Layouts/footer.php');?>
