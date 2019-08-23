
<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>
<?php 
if (isset($_SESSION["usuario"]) ) {
	$usr = $_SESSION["usuario"];
}else {
        //header('Location: index.php');
} 
?>
<br><br>
<div class="content container">
	<div class="row">
		<div class="col-xl-3 col-md-3 col-sm-12 mt-5 mb-5 p-0 " style="border : 1px solid gray; border-radius: 5px;">
			<div class="card-user">
				<div class=" card-header d-flex align-items-center p-2  mt-0 text-white-50 bg-secondary rounded box-shadow"  >
					<p class="text-uppercase text-center text-white pt-1"><b>Turiste</b></p>
				</div>
				<div class="card-body">
					<div class="author text-center">
						<img class="avata border-gray rounded-circle" style="width: 140px; height: 140px;" src="../Public/img/user.jpg" alt="..."><br><br>
						<input type="hidden" id="idt" name="" value="7" >
						
						<p id="nombre"></p>
						<p id="apellidos"></p>
						<p id="correo" ></p>
						
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-md-9 col-sm-12 mt-5 mb-5">
			<main role="main" class="container">
				<div class="d-flex align-items-center p-3 text-white-50 bg-secondary box-shadow" style="border-radius: 5px">
					<div class="lh-100">
						<h6 class="mb-0 text-white lh-100">My Trours</h6>
						
					</div>
				</div>

				<div class="my-3 p-3 bg-white rounded box-shadow">
					<h6 class="border-bottom border-gray pb-2 mb-0">Tours updates</h6>
					<div class="media text-muted pt-3">
						<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
						<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<strong class="d-block text-gray-dark">@Nombre Tours</strong>
							<strong class="d-block text-gray-dark">@Guia</strong>
							Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
						</p>
					</div>
					<small class="d-block text-secundario mt-3">
						<a class="text-secundario" href="#">All updates</a>
					</small>
				</div>
			</div>
		</div>
	</div> 



	<?php include_once ('Layouts/footer.php'); ?>


