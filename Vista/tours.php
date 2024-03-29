
<?php 

session_start();

if (isset($_SESSION["usuario"]) ) {

 $usr = $_SESSION["usuario"];

}else {
  //header('Location: index.php');
}



include_once('Layouts/header_2.php'); 

?>


<br><br><br>

<button onclick="cambio();" type="button" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#modal-video">
  New
</button>
<button type="button" onclick="AsignarHotel();" class="ml-4 btn btn-primary" data-toggle="modal" data-target="#modal-video">
  Asignar Hotel
</button>

<div class="container" id="alert-agregarTours" style="display: none;" >
  <div class="alert alert-success" >
    Tours added successfully
  </div>
</div>

<div class="container" id="alert-asignaHotel" style="display: none;" >
  <div class="alert alert-primary" >  
    tours assigned correctly
  </div>
</div>

<div class="container" id="alert-editarTours" style="display: none;" >
  <div class="alert alert-info" >
    Tours edited successfully
  </div>
</div>

<div class="container" id="alert-eliminarTours" style="display: none;" >
  <div class="alert alert-danger" >
    Tours removed successfully
  </div>
</div>

<div class="container-fluid mt-5 mb-5">
  <div class="table-responsive">

    <table class="table table-sm">
      <thead class="thead-dark">
        <tr>
          <th  scope="col">#</th>
          <th scope="col">Name</th>
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
        <h4 class="modal-title text-uppercase" id="modal-video-header"> <span id="detalle-tour" >Detalle Tours</span> </h4>
        <h4 class="modal-title text-uppercase" id="modal-video-header"><span id="new-tour" >New Tours</span> </h4>
        <h4 class="modal-title text-uppercase" id="modal-video-header"><span id="edite-tour" >Edite Tours</span> </h4>


        <!-- Close -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body ">

        <div id="info" class="p-3">


        </div>

        <div id="div-asignaHotel" >
          <div class="row">
            <div class="col-6">
              <h5>Select Tours</h5>
              <select class="form-control" onchange="obtenerHoteles();" id="asignarTours">
                <option value="0">Select</option>
              </select>
              <br>
            <button onclick="asignaHotel()" class="btn btn-outline-info" >Asign hotel</button>

          </div>
          <div class="col-6">
           <h5>Select Hotel </h5>
           <select class="form-control" id="asignarHoteles" >
           </select>
           <br>

         </div>


       </div>
     </div>

     <div id="registro_tours" >
      <div class="container-fluid">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="nombre">Name</label>
            <input type="email" class="form-control" id="nombre" placeholder="tours name">
            <input type="hidden" name="" id="idtours" >
          </div>
          <div class="form-group col-md-3">
            <label for="inputPassword4">Price</label>
            <input type="text" class="form-control" id="precio" placeholder="price">
          </div>
          <div class="form-group col-md-3">
            <label for="inputPassword4">Guide</label>
            <select id="guiaOpt" class="form-control">

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
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
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
        <button id="btn-G" onclick="agregar();" type="button" class="btn btn-primary">Add</button>
        <button id="btn-E" onclick="editarReguistro();" type="button" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->