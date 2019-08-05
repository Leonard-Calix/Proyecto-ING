
<?php include_once('Layouts/header_2.php'); ?>


<br><br><br>

<button onclick="cambio();" type="button" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#modal-video">
  New
</button>

<div class="container-fluid mt-5 mb-5">
  <div class="table-responsive">

    <table class="table table-sm">
      <thead class="thead-dark">
        <tr>
          <th  scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Estate</th>
          <th scope="col">Hotel</th>
          <th scope="col">Price</th>
          <th scope="col">Detall</th>
          <th scope="col">Edite</th>
          <th scope="col">Remove</th>
        </tr>
      </thead>
      <tbody id="t-res">

      </tbody>
    </table>

  </div> 
</div>




<?php include_once('Layouts/footer.php'); ?>
</div>
</div>



<!-- Modal 2 -->

<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="modal-video-header" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header" >

        <!-- Title -->
        <h4 class="modal-title detalle text-uppercase" id="modal-video-header">Detalle Tours</h4>
        <h4 class="modal-title new text-uppercase" id="modal-video-header">New Tours</h4>
        <h4 class="modal-title edite text-uppercase" id="modal-video-header">Edite Tours</h4>


        <!-- Close -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">

        <div id="info">


        </div>

        <div id="registro_tours" >
          <div class="container-fluid">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="nombre">Name</label>
                <input type="email" class="form-control" id="nombre" placeholder="tours name">
                <input type="hidden" name="" id="idT" >
              </div>
              <div class="form-group col-md-3">
                <label for="inputPassword4">Price</label>
                <input type="text" class="form-control" id="precio" placeholder="price">
              </div>
              <div class="form-group col-md-3">
                <label for="inputPassword4">Guide</label>
                <select id="guia" class="form-control">
                  
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputPassword4">state</label>
                <select id="estado" class="form-control">
                  
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <textarea class="form-control" name="textarea" id="descripcion" rows="10" cols="50">Write something here</textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputCity">Date Star</label>
                <input type="date" class="form-control" id="fechaI">
              </div>
              <div class="form-group col-md-3">
                <label for="inputState">Date End</label>
                <input type="date" class="form-control" id="fechaF">
              </div>
              <div class="form-group col-md-3">
                <label for="calificacion">Calificacion</label>
                <select id="calificacion" class="form-control">
                  <option>1</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="cupos">Cupos</label>
                <input type="text" class="form-control" id="cupos">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button onclick="agregar();" type="button" class="btn btn-primary">Save</button>
          </div>

        </div>
      </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->