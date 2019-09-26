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
<input type="hidden" id="idGuia" value="<?php echo $usr ?>">
<button type="button" class="ml-3 btn btn-primary" data-toggle="modal" data-target="#msgModal">
  New
</button>

<div class="container mt-3">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Name</th>
          <th scope="col">Message</th>
          <th scope="col">Action</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="messagesAdd">

      </tbody>
    </table>
</div>


<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="sendMsg">
          <div class="row">
            <div class="col-md-6">
              <h5>Para</h5>
              <select class="form-control" id="asigEmail">
                  <option value="0">Select</option>
              </select>
              <br>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Asunto" name="asunt" id="asunto">
              </div> 
            </div>
            <br>
            <div class="col-md-6">
              <div class="form-group">
                <textarea name="message" id="message" placeholder="  message" cols="55" rows="5"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button  type="button" onclick="limpiarInputs();"class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn-send" onclick="enviarEmail();" class="btn btn-primary">Send Email</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('Layouts/footer.php'); ?>
