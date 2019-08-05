
<?php include_once('Layouts/header_2.php'); ?>


<div class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-user">
				<div class="image">
					
				</div>
				<div class="card-body">
					<div class="author">
						<img class="avata border-gray" src="../Public/img/1.jpg" alt="..."><br><br>
						
						<p class="description">
							@chetfaker
						</p>
					</div>
					<p class="description text-center">
						"I like the way you work it
						<br> No diggity
						<br> I wanna bag it up"
					</p>
				</div>
				<div class="card-footer">
					<hr>
					
				</div>
			</div>

		</div>
		<div class="col-md-8">
			<div class="card card-user">
				<div class="card-header">
					<h5 class="card-title">Edit Profile</h5>
				</div>
				<div class="card-body">
					<form>
						<div class="row">
							<div class="col-md-5 pr-1">
								<div class="form-group">
									<label>Company (disabled)</label>
									<input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
								</div>
							</div>
							<div class="col-md-3 px-1">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" placeholder="Username" value="michael23">
								</div>
							</div>
							<div class="col-md-4 pl-1">
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
		</div>
	</div>
</div>


<?php include_once('Layouts/footer.php'); ?>
</div>
</div>
