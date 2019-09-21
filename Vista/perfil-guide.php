<?php 
session_start();

if (isset($_SESSION["usuario"]) && $_SESSION["tipo"]==3) {
	$usr = $_SESSION["usuario"];
}else {
	header('Location: index.php');
}

include_once('Layouts/headerGuide.php');
include_once('Layouts/navbarGuide.php');
?>
<br>
<br>
<br>
<div class="container mt-3">
	<div class="card" style="width: 18rem;">
		<img src="../Public/img/tours/1_01.png" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">Taj Majal</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			<a href="#" class="btn btn-primary">Details</a>
		</div>
	</div>
	
</div>
		
<?php include_once('Layouts/footer.php'); ?>

