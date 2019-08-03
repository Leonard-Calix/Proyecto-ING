
<?php include_once('Layouts/header_2.php'); ?>


<br><br><br>
<button class="btn btn-secondary m-2" id="new-div" >New</button>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="card-title">Tours</h5>
        <h5 class="text-dark card-title">Descripcion</h5>
        <h5 class="text-dark card-title">Guia</h5>
        <h5 class="text-dark card-title">Estado</h5>
        <h5 class="text-dark card-title">Precio</h5>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include_once('Layouts/footer.php'); ?>
