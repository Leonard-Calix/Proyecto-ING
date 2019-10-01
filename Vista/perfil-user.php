<?php 
	session_start();

	if (isset($_SESSION["usuario"]) && $_SESSION["tipo"]==2 ) {
		$usr = $_SESSION["usuario"];
	}else {
    	 header('Location: index.php');    	 
	} 

 	include_once ('Layouts/headerTurist.php'); 
 	include_once ('Layouts/navbarTurist.php');
?>

<br><br><br>
<div class="container-fluid p-2">
	<div class="card">
		<input type="hidden" id="idTurista" value=" <?php echo $usr ?> ">
		<div class="p-3 card-header text-uppercase text-info">Details Tour Purchased</div>
		<div class="card-body">
			<div  class="container" id="res-tours-turista">
			</div>	
				
		</div>
	</div>
</div>


<?php include_once ('Layouts/footer.php'); ?>


