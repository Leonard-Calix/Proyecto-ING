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
	<div class="row">
		<div class="col-lg-5">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5 col-md-4">
              				<div class="icon-big text-center icon-warning">
                				<i class="nc-icon nc-globe text-warning"></i>
              				</div>
            			</div>
            			<div class="col-6 col-md-6">
              				<div class="numbers">
                				<p class="card-category">Tours Asign</p>
                				<p class="card-title">20<p>
              				</div>
            			</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
              		<div class="stats">
                		<i class="fa fa-refresh"></i> Update Now
              		</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="card card-stats">
				<div class="card-body">
					<div class="row">
						<div class="col-5 col-md-4">
              				<div class="icon-big text-center icon-warning">
                				<i class="nc-icon nc-globe text-warning"></i>
              				</div>
            			</div>
            			<div class="col-6 col-md-6">
              				<div class="numbers">
                				<p class="card-category">Turist Asign</p>
                				<p class="card-title">20<p>
              				</div>
            			</div>
					</div>
				</div>
				<div class="card-footer">
					<hr>
              		<div class="stats">
                		<i class="fa fa-refresh"></i> Update Now
              		</div>
				</div>
			</div>
		</div>
</div>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<?php include_once('Layouts/footer.php'); ?>

