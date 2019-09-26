
<?php 

	session_start();
   
  	if (isset($_SESSION["usuario"]) ) {
    
    	$usr = $_SESSION["usuario"];

    }else {
      header('Location: index.php');
  	}

	include_once('Layouts/header_2.php'); 

?>

<div class="content">
	<div class="row">
		<div class="col-xl-4 col-md-4 col-sm-12">
			<div class="card card-user">
				<div class="image">
					
				</div>
				<div class="card-body">
					<div class="author">
						<img class="avata border-gray" style="width: 140px; height: 140px;" src="../Public/img/perfil.jpg" alt="..."><br><br>
						<input type="hidden" id="idUsuario" name="" value=" <?php echo $usr ?> " >
						
						<div id="div-usuario-email"></div>
						<div id="div-usuario"></div> 

					</div>
					
				</div>
				<div class="card-footer">
					<hr>
					
				</div>
			</div>

		</div>
		<div class="col-xl-8 col-md-8 col-sm-12">
			<div class="card card-user">
				<div class="card-header">
					<h5 class="card-title text-primary text-center font-weight-bold">Info Profile</h5>
				</div>
				<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" id="username" class="form-control" placeholder="Username" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<input type="email" id="email" class="form-control" placeholder="Email">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" id="nombre" class="form-control" placeholder="Company" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" id="apellido" class="form-control" placeholder="Last Name" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Address</label>
									<input type="text" id="direccion" class="form-control" placeholder="Home Address" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone</label>
									<input type="text" id="telefono" class="form-control" placeholder="City" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>ID</label>
									<input type="text" id="identidad" class="form-control" placeholder="Country" value="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="update ml-auto mr-auto">
								<button type="button" class="btn btn-primary btn-round">Update Profile</button>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include_once('Layouts/footer.php'); ?>
</div>
</div>

