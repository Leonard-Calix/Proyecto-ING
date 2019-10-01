
<?php 

session_start();

if (isset($_SESSION["usuario"]) ) {

	$usr = $_SESSION["usuario"];

}else {
  header('Location: index.php');
}

include_once('Layouts/header_2.php'); 

?>


<br><br><br>
<div class="container" id="alert-remove" style="display: none;" >
  <div class="alert alert-danger" id="res-remove-1" >
    
  </div>
</div>
<div class="container" id="alert-add" style="display: none;" >
  <div class="alert alert-primary" id="res-add-1" >
    
  </div>
</div>

<div class="container-fluid mt-5 mb-5">
	<div class="table-responsive">
		<table class="table table-sm">
			<thead class="thead-dark">
				<tr>
					<th  scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Add</th>
					<th scope="col">Remove</th>
				</tr>
			</thead>
			<tbody id="toursF">
				<tr id="${res[i].id}" >
          				<th scope="row">1</th>
          				<td>Nombre_Tour</td>
          				<td scope="col"> 
          					<button onclick="addFavorites(1);" class="btn btn-outline-primary">Add</button> 
          				</td>
          				<td scope="col"> 
          					<button onclick="removeFavorites(1);" class="btn btn-outline-danger">remove</button> 
          				</td>
        			</tr>
			</tbody>
		</table>

	</div> 
</div>




<?php include_once('Layouts/footer.php'); ?>
<script type="text/javascript" src="../public/js/favorito.js"></script>

</div>
</div>
