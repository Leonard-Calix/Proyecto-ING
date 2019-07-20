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
                	<h2 class="text-center mb-4">
                  		Detalle
              		</h2>
              	<!-- Subheading -->
              		<p class="text-muted text-center mb-5">
                  	Incline comes with several professionally designed landing pages that can be easily adapted for any project.
              		</p>
          		</div>
      		</div> <!-- / .row -->
			  
			<div class="row">
        		<div  class="col-md-12">
         	<!-- Image -->
         	<div class="card-img-top">
          		<img src="../Public/img/02.jpg" alt="App landing" class="img-fluid">
      		</div>
      		<!-- Body -->
      		<div class="card-body">
          		<!-- Title -->
          		<h4 class="card-title">Company landing <span class="badge badge-danger">New!</span></h4>
       		<!-- Body -->
       			<p class="card-text text-muted">You can use this page to promote your company.</p>
       		<!-- / .Imput Comentarios -->
       		<div class="row" >
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
    	<div class="row">
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

	<div class="row">
   		<div class="col-md-1 col-1 mr-1">
    		<span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/2.jpg"></span>
		</div>
		<div class="col-md-10  col-10">
    		<div class="p-2 mb-2 color-comentario" >
     			<small class="text-muted">
      			<span class="text-primary"><b>Cristiano Ronaldo</b></span> 
      				Excelente, mis mejores vacaciones
  				</small>			
			</div>
		</div>
	</div>

	<div class="row">
   		<div class="col-md-1 col-1 mr-1">
    		<span><img class="rounded-circle foto-perfil mr-2" src="../Public/img/1.jpg"></span>
		</div>
		<div class="col-md-10  col-10">
    		<div class="p-2 mb-2 color-comentario" >
     			<small class="text-muted">
      			<span class="text-primary"><b>Neymar Jr.</b></span> 
      				Es otro pedo jajaja
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