<?php 

   session_start();
   
    if (isset($_SESSION["usuario"]) ) {
    
     $usr = $_SESSION["usuario"];

    }else {
      header('Location: index.php');
  }

  include_once('Layouts/header_2.php'); 

?>

<!-- Page content -->
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
      <th scope="col">Name Guide</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="res-guide">
    
  </tbody>
</table>

</div>
<br>
<br>
<br>
        
<div class="modal fade" id="modal-notific" tabindex="-1" role="dialog" aria-labelledby="modal-notific" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Email Notifications</h5>
        <button class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
          <div class="form-group">
            <label for="email-guias" class="col-form-label">Email del Guia:</label>
            <input type="text" class="form-control" id="emailguia">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="info-tourguia"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  onClick="sendEmail();"  class="btn btn-primary">Send notifications</button>
      </div>
    </div>
  </div>
</div>


<?php include_once ('Layouts/footer.php'); ?>
</div>
</div>