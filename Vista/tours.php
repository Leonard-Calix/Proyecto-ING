
<?php include_once('Layouts/header_2.php'); ?>


<br><br><br>

<button type="button" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#modal-video">
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
      <div class="modal-header" id="header">

        <!-- Title -->
        <h4 class="modal-title" id="modal-video-header"></h4>

        <!-- Close -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">

        <div id="info" style="display: none;"  >
          <h5 class="card-title">Tours</h5><div id="d_nombre"></div>
          <h5 class="text-dark card-title">Descripcion</h5><div id="d_descripcion"></div>
          <h5 class="text-dark card-title">Guia</h5><div id="d_guia"></div>
          <h5 class="text-dark card-title">Estado</h5><div id="d_estado"></div><div id="prueba"></div>
          <h5 class="text-dark card-title">Precio</h5><div id="d_precio"></div>
          <h5 class="text-dark card-title">Cupos</h5><div id="d_cupos"></div>
          <h5 class="text-dark card-title">Calificacion</h5><div id="d_calficacion"></div>
          <hr style="color: black solid 1px;">
        </div>

        <div id="registro_tours" >
          <div class="container-fluid">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="nombre">Name</label>
                <input type="email" class="form-control" id="nombre" placeholder="tours name">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Guide</label>
                <select class="form-control">
                  <option>Carlos</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">state</label>
                <select class="form-control">
                  <option>state</option>
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
                <input type="date" class="form-control" id="cu|pos">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
          </div>

        </div>
      </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->