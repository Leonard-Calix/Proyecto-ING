<?php include_once ('Layouts/header_2.php'); ?>

<!-- Button trigger modal -->
<br><br><br>
<button type="button" onclick="" class=" ml-3 btn btn-primary" data-toggle="modal" data-target="#modal-update">
  New
</button>

<!-- Page content -->

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
        <button type="button" id="sendemail" onClick="sendEmail();"  class="btn btn-primary">Send notifications</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="modal-update" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="infoGuia"></div>

        <div id="registro-guia">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
               <label>Name Tour</label>
               <input type="text" id="nameTour" readonly="readonly" class="form-control">
               <input type="hidden" id="idTours">
				       <input type="hidden" name="" id="idGuia">
               <input type="hidden" name="" id="idUsuario">
               <input type="hidden" name="" id="idPersona">

             </div>
          </div>
            <div class="col-md-6">
             <div class="form-group">
               <label>Name Hotel</label>
               <input type="text" id="hotel" readonly="readonly" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Name Guide</label>
               <input type="text" id="nameguide" readonly="readonly"  class="form-control">
             </div>
          </div>

        <div class="col-md-6">
             <div class="form-group">
               <label>Email</label>
               <input type="text" id="correo" readonly="readonly" class="form-control">
             </div>
          </div>
          <div class="col-md-6">
            <label for="guiasOptionx">Changes Guide</label>
            <select id="guiasOption" class="form-control">
                  
            </select>
          </div>
          <br>
      </div> 
      <div class="modal-footer">
        <button  type="button" onclick="limpiarInput();" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-addGuia"  onclick="asignarGuia();" type="button" class="btn btn-primary save">Save changes</button>
        <button id="btn-editGuia" onclick="editarGuia();" type="button" class="btn btn-primary update">Update</button>
      </div>
    </div>
  </div>
</div>     
</div>


<?php include_once ('Layouts/footer.php'); ?>
</div>
</div>