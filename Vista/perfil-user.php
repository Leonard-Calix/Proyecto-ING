
<?php include_once ('Layouts/header.php'); ?>
<?php include_once ('Layouts/navbar.php'); ?>
<?php 
if (isset($_SESSION["usuario"]) ) {
	$usr = $_SESSION["usuario"];
}else {
        //header('Location: index.php');
} 
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
			<div class="p-3 card-header text-uppercase text-info">
				MY Tours
			</div>
			<div class="card-body">
				<div class="my-3 p-3 rounded box-shadow">
					<div class="media text-muted">
						<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
						<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<strong class="d-block text-gray-dark">@Nombre Tours</strong>
							<strong class="d-block text-gray-dark">@Guia</strong>
							Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
						</p>
					</div>
					<div class="media text-muted">
						<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
						<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<strong class="d-block text-gray-dark">@Nombre Tours</strong>
							<strong class="d-block text-gray-dark">@Guia</strong>
							Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
						</p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>




<?php include_once ('Layouts/footer.php'); ?>


