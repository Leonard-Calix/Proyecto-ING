
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
      <th scope="col">Type User</th>
      <th scope="col">Action</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="res">
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>
          
      </td>
      <td><button onclick="editarUser();" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Edit</button></td>
      <td><button onclick="EliminarUser();" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2">Delete</button></td>
    </tr>
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

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
               <label>First Name</label>
               <input type="text" id="nameguide" class="form-control">
             </div>
          </div>
            <div class="col-md-6">
             <div class="form-group">
               <label>Last Name</label>
               <input type="text" id="apellido" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>User name</label>
               <input type="text" id="usarname" class="form-control">
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
               <label>ID</label>
               <input type="text" id="identidad" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Phone</label>
               <input type="text" id="phone" class="form-control">
             </div>
          </div>
        
        <div class="col-md-6">
             <div class="form-group">
               <label>Gender</label>
               <input type="text" id="genero" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Address</label>
               <input type="text" id="direccion" class="form-control">
             </div>
          </div>
        <div class="col-md-6">
             <div class="form-group">
               <label>Email</label>
               <input type="text" id="correo" class="form-control">
             </div>
          </div>

          <div class="col-md-6">
             <div class="form-group">
               <label>Password</label>
               <input type="text" id="contrasenia" class="form-control">
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
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('Layouts/footer.php'); ?>
</div>
</div>