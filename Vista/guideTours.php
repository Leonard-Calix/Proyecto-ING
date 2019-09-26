<?php 
session_start();

if(isset($_SESSION["usuario"]) && $_SESSION["tipo"]==3) {
	$usr = $_SESSION["usuario"];
}else {
	header('Location: index.php');
}

include_once('Layouts/headerGuide.php');
include_once('Layouts/navbarGuide.php');
?>
<input type="hidden" id="idGuia" value=" <?php echo $usr ?> " >
<br>
<br>
<br>
<div class="container mt-3">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name Tour</th>
          <th scope="col">Name Hotel</th>
          <th scope="col">Stage</th>
          <th scope="col">Price</th>
          <th scope="col">Duration</th>
        </tr>
      </thead>
      <tbody id="tourGuide">

      </tbody>
    </table>
</div>

<?php include_once('Layouts/footer.php'); ?>
