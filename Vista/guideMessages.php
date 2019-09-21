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
<br>
<br>
<br>
<input type="hidden" id="idGuia" value="<?php echo $usr ?> " >
<div class="container mt-3">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Message</th>
          <th scope="col">Action</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="">

      </tbody>
    </table>
</div>

<?php include_once('Layouts/footer.php'); ?>
