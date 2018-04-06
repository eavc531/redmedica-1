
<!-- Modal Inicio Sesion-->
<div class="modal fade" id="modalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <a href="{{route('user.create')}}" class="btn btn-secondary">Paciente</a>
         <a href="{{route('medico.create')}}" class="btn btn-secondary">Medico</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Large modal search-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="flip">
          <div class="col-lg-12">
              <div class="input-group search">
                <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x"></i></span>
                  <label for="[object Object]"><h5>Buscar Por:</h5></label>
                  {{Form::select('search',['Centro Medico'=>'Centro Medico','Especialidad'=>'Especialidad',  'Medico'=>'Medico'],null)}}
                  <input type="text" class="form-control" placeholder="Search for..." id="searchVar">

              <button onclick="search()" type="button" class="ml-2 white" data-toggle="modal" data-target=".bd-example-modal-lg"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
              </div>
          </div>
        </div>  

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="listSearchAjax">

        </div>
      </div>

    </div>
  </div>
</div>
