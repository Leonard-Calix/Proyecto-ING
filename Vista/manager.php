
<?php include_once('Layouts/header_2.php'); ?>
<!-- Button trigger modal -->
<br><br><br>
<button type="button" class=" ml-3 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  New
</button>

<!-- Page content -->

<div class="container mt-3">
  
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First name</th>
      <th scope="col">Last</th>
      <th scope="col">User name</th>
      <th scope="col">email</th>
      <th scope="col">Address</th>
      <th scope="col">Action</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="res">
    
  </tbody>
</table>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="info">

        </div>

        <div id="registro_profiles">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
               <label>First Name</label>
               <input type="text" id="nameUser" data-validation="alphanumeric" class="form-control">
               <input type="hidden" name="" id="idUser">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <label>Last Name</label>
               <input type="text" id="apellidoUser" data-validation="alphanumeric" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>User name</label>
               <input type="text" id="username" data-validation="alphanumeric" class="form-control">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <label>ID</label>
               <input type="text" id="identidad" data-validation="alphanumeric" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Phone</label>
               <input type="text" id="phone" data-validation="alphanumeric" class="form-control">
             </div>
          </div>
        
        <div class="col-md-6">
             <div class="form-group">
               <label>Gender</label>
               <input type="text" id="genero" data-validation="alphanumeric" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Address</label>
               <input type="text" id="direccion" data-validation="alphanumeric" class="form-control">
             </div>
          </div>
        <div class="col-md-6">
             <div class="form-group">
               <label>Email</label>
               <input type="email" id="correo" data-validation="email" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Password</label>
               <input type="password" id="contrasenia" data-validation="alphanumeric" class="form-control">
             </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>Select your type User..</label> <br>
                <input type="radio" name="typeUser" class="radio-inline" value=1>Admin
                <input type="radio" name="typeUser" class="radio-inline" value=2>Turista
                <input type="radio" name="typeUser" class="radio-inline" value=3>Guia
            </div>
          </div>
          <br>
      </div> 
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  id="btn-add" onclick="agregarUser();" class="btn btn-primary">Save changes</button>
        <button id="btn-edit" onclick="editarUser();" data-dismiss="modal" type="button" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </div>
</div>
</div>

        

<?php include_once('Layouts/footer.php'); ?>
</div>
</div>