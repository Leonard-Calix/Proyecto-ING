<?php 
// Manejo de la sesiones
   session_start();
   
    if (isset($_SESSION["usuario"]) ) {
    
     $usr = $_SESSION["usuario"];

    }else {
      header('Location: index.php');
  }

  include_once('Layouts/header_2.php'); 

?>

<br><br><br>

<!-- Page Comentarios -->
<div class="container mt-3">
    <div class="col-md-6">
        <input name="search" id="search" class="form-control mb-2" type="text" placeholder="Search">
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User name</th>
                <th scope="col">Tour name</th>
                <th scope="col">Comment</th>
                <th scope="col">Action</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="comments">
    
        </tbody>
    </table>
</div>

<?php include_once('Layouts/footer.php'); ?>
</div>
</div>