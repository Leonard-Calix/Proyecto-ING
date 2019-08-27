<?php 

session_start();


if ( isset($_SESSION["usuario"]) && $_SESSION["tipo"]==3  ) {
	$usr = $_SESSION["usuario"];
}else {
	header('Location: index.php');
} 


include_once ('Layouts/header.php'); 
include_once ('Layouts/navbar.php');

?>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<div class="main-content" id="panel">
	<!-- Topnav -->

	<!-- Header -->
	<!-- Header -->
	<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(profile-cover.jpg); background-size: cover; background-position: center top;">
		<!-- Mask -->
		<span class="mask bg-dark opacity-8"></span>
		<!-- Header container -->
		<div class="container-fluid d-flex align-items-center">
			<div class="row">
				<div class="col-lg-7 col-md-10">
					<div id="nombreUsuario"></div>
					<p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Page content -->
	<div class="container-fluid mt--6">
		<div class="row">
			<div class="col-xl-4 order-xl-2">
				<div class="card card-profile">
					<img src="perfil/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
					<div class="row justify-content-center">
						<div class="col-lg-3 order-lg-2">
							<div class="card-profile-image text-center mt-5">
								<a href="">
									<img src="perfil/perfil.png" style="width: 150px; height: 150px;" class="rounded-circle" alt="foto-perfil">
								</a>
							</div>
						</div>
					</div>
					<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

					</div>
					<div class="card-body pt-0">
						<div class="row">
							<div class="col">
								<div class="card-profile-stats d-flex justify-content-center">
									<div>
										<input type="hidden" id="guia_registrado" value="<?php echo $usr; ?>">
									</div>
								</div>
							</div>
						</div>



						<div class="text-center">
							<div class="h5 font-weight-300" id="usuario">
							
						</div>
						</h5>
						<div class="h5 font-weight-300" id="direccion">
							
						</div>
						<div class="h5 mt-4" id="correo">
							
						</div>
					</div>
					<div class="d-flex justify-content-between">
						<a href="" class=""></a>
						<a href="logout.php" class="btn btn-sm btn-danger float-right">Logout</a>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-xl-8 order-xl-1">
			<div class="row">
				<div class="col-lg-6">
					<div class="card bg-gradient-info border-0">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card bg-gradient-danger border-0">
					</div>
				</div>
			</div>
			<br><br>
			<div class="row text-center">
				<ul class="nav justify-content-center">
					<li class="nav-item">
						<button id="btn-i" class="nav-link btn btn-defaul text-secondary" onclick="informacion();">Informacion</button>
					</li>
					<li class="nav-item">
						<button id="btn-t" class="nav-link active btn btn-defaul text-secondary" onclick="tours();">My Tours</button>
					</li>
				</ul>
			</div>
			
			<div id="informacion"  class="card">
				<div class="card-body">
					<form>
						<h6 class="heading-small text-muted mb-4">User information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-username">Username</label>
										<input type="text" id="input-username" class="form-control" placeholder="Username" value="lucky.jesse">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-email">Email address</label>
										<input type="email" id="input-email" class="form-control" placeholder="jesse@example.com">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-first-name">First name</label>
										<input type="text" id="input-first-name" class="form-control" placeholder="First name" value="Lucky">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-last-name">Last name</label>
										<input type="text" id="input-last-name" class="form-control" placeholder="Last name" value="Jesse">
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4">
						<!-- Address -->
						<h6 class="heading-small text-muted mb-4">Contact information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label" for="input-address">Address</label>
										<input id="input-address" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="input-phone">Phone</label>
										<input type="text" id="input-phone" class="form-control" placeholder="City" value="+504 0000-0000">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="input-id">Id</label>
										<input type="text" id="input-id" class="form-control" placeholder="Country" value="0801-0000-0000">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label class="form-control-label" for="input-genero">Gender</label>
										<select class="form-control" placeholder="Genere"  id="input-genero">
											<option value="M" >Select gender</option>
											<option value="1" >M</option>
											<option value="2" >F</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4">
					</form>
				</div>
			</div> 

			<section id="vista-tours" class="p-2" style="display: none;">
				<div class="container-fluid">
					<div class="card">
						<div class="card-header text-uppercase text-info">
							MY Tours
						</div>
						<div class="card-body">
							<div class="box-shadow m-0" id="res-tours-Guide">
								
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	
	
</div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">List of tourists</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First namne</th>
							<th scope="col">Last name</th>
							<th scope="col">Email</th>
						</tr>
					</thead>
					<tbody id="table-turis">
						<tr>
							<td></td>
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>



<?php include_once ('Layouts/footer.php'); ?>


