<?php include_once('Layouts/header.php'); ?>


<head>
	<div >
		<nav class="navbar navbar-light bg-light">
  			<span class="navbar-text">
    		<H1>WELCOME! </H1>
  			</span>
		</nav>
		<br>
	</div>
	
</head>
<div class="container">

	<div class="row">
		<div class="col-md-4">

			<!--INFORMACION PERSONAL-->
			<div class="card ">
				<div class="card-header">
					Username
				</div>
				
				<div class="card-body">
					<!--IMAGEN-->
					<div class="imgProfile" align="center">
						<img  class="img-fluid" src="../Public/img/1.jpg" alt="Responsive image" >
						<br>
						<br>
					</div>
					<div align="center">
						<p >Name <br></p>
						<p >Tegucigalpa</p>
					</div>
				</div>
				
			</div>

		</div>

		<div class="col-md-8">

			<!-- Tab Nav, Opciones-->
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#Edit" role="tab" aria-controls=	"home" aria-selected="true">Edit</a>
 				</li>
  				<li class="nav-item">
 					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Tours" role="tab" aria-controls="		profile" aria-selected="false">Tours</a>
 				</li>
  
			</ul>
						<!--PESTAÑAS DEL NAV-->
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="Edit" role="tabpanel" aria-labelledby="home-tab">
					<div class="card">
						
						<!--INFORMACION PERSONAL, PESTAÑA 1-->
						<div class="card-body">
							<form>
								<div class="row">
									<div class="col-md-6 pr-1">
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" placeholder="Username" value="michael23">
										</div>
									</div>
										<div class="col-md-6 pl-1">
											<div class="form-group">
												<label for="exampleInputEmail1">Email address</label>
												<input type="email" class="form-control" placeholder="Email">
											</div>
										</div>
								</div>
								<div class="row">
									<div class="col-md-6 pr-1">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" class="form-control" placeholder="Company" value="Chet">
										</div>
									</div>
									<div class="col-md-6 pl-1">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" class="form-control" placeholder="Last Name" value="Faker">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Address</label>
											<input type="text" class="form-control" placeholder="Home Address" value="Melbourne, Australia">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 pr-1">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control" placeholder="City" value="Melbourne">
										</div>
									</div>
									<div class="col-md-4 px-1">
										<div class="form-group">
											<label>Country</label>
											<input type="text" class="form-control" placeholder="Country" value="Australia">
										</div>
									</div>
									<div class="col-md-4 pl-1">
										<div class="form-group">
											<label>Postal Code</label>
											<input type="number" class="form-control" placeholder="ZIP Code">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>About Me</label>
											<textarea class="form-control textarea">Oh so, your weak rhyme You doubt I'll bother, reading into it</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="update ml-auto mr-auto">
									<button type="submit" class="btn btn-primary btn-round">Update Profile</button>
									</div>
								</div>
							</form>
						</div>
					</div>

					<!--INFORMACION DE LOS TOURS , PESTAÑA 2-->
				</div>
				<div class="tab-pane fade" id="Tours" role="tabpanel" aria-labelledby="profile-tab">
					<table class="table">
  						<thead class="thead-dark">
    						<tr>
      							<th scope="col">Nombre Tour</th>
      							<th scope="col">Estado</th>
      							<th scope="col">Fecha Inicio</th>
      							<th scope="col">Fecha Final</th>
    							</tr>
  						</thead>
  						<tbody>
    						<tr>
    							<td>Mark</td>
      							<td>Otto</td>
      							<td>@mdo</td>
      							<td>@mdo</td>
    						</tr>
   							<tr>
   
      							<td>Jacob</td>
      							<td>Thornton</td>
      							<td>@fat</td>
      							<td>@fat</td>
      						</tr>
  						</tbody>
					</table>



				</div>
			</div>
		</div>
	</div>
</div>


<?php include_once('Layouts/footer.php'); ?>


