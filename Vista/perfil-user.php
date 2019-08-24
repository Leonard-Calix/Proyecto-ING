<?php 

	session_start();


	if ( isset($_SESSION["usuario"]) && $_SESSION["tipo"]==2 ) {
		$usr = $_SESSION["usuario"];
	}else {
    	 header('Location: index.php');
    	 
	} 


 	include_once ('Layouts/header.php'); 
 	include_once ('Layouts/navbar.php');

?>

<br><br><br><br><br>
<div class="container">
	<div class="card text-white">
		<img src="../Public/img/portada.jpeg" class="img-fluid card-img" alt="...">
		<div class="card-img-overlay">
			<img src="../Public/img/user.jpg" class="card-img-top img-fluid rounded-circle " alt="..." style="width: 150px; height: 150px; margin-top: 260px;" >
		</div>
		<ul class="nav justify-content-center ">
			<li class="nav-item">
				<button id="btn-i" class="nav-link btn btn-defaul text-secondary" onclick="informacion();">Informacion</button>
			</li>
			<li class="nav-item">
				<button id="btn-t" class="nav-link active btn btn-defaul text-secondary" onclick="tours();">My Tours</button>
			</li>
		</ul>
	</div>
</div>

<section id="informacion" class="p-2">
	<div class="container">
		<div class="card">
			<div class="p-3 card-header text-uppercase text-info">
				Informacion
			</div>
			<div class="card-body">
				
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
				MY Tours
			</div>
			<div class="card-body">
				<div class="rounded box-shadow m-0" id="res-tours-turista">
				
				</div>
			</div>
		</div>
	</div>
</section>




<?php include_once ('Layouts/footer.php'); ?>


