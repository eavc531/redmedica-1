@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Calificaiones otorgadas por los Pacientes</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

@if($event->first() != Null)
<div class="row">
  @foreach ($event as $app)
  <div class="col-lg-12">
    <div class="card date-card my-2">
      <div class="row">
        <div class="col-lg-3">
          <strong>Medico:</strong> <a href="{{route('medico.edit',$app->medico->id)}}">{{$app->medico->name}} {{$app->medico->lastName}}</a>
          <strong>Calificacion Sobre su Cita:</strong>
          <a href="">{{$app->title}} Fecha: {{$app->start}}</a>
        </div>
      <div class="col-lg-3 col-sm-3 col-3 mt-1">
          <label for="" class="font-title-grey ">Puntaje Otorgado:</label>
          <p>{{$app->score}}</p>
      </div>
      <div class="col-4">
        <label for="" class="font-title-grey ">Comentario:</label>
        <p>{{$app->comentary}}</p>
        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Mostrar Comentario a los visitantes">mostrar</a><a href="#" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Mantener oculto a los visitantes">no mostrar</a>
      </div>

    </div>



  </div>
</div>
@endforeach
  <div class="card-heading">
    {{$event->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi Notificaciones de Nuevas Citas por el Momento</h4>
</div>

<!-- Modal -->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Como agendar una cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="font-title-grey">Agendar Cita</h5>
        <p>Las Horas disponibles del médico, estan marcadas en el calendario como color naranja:  <div class="" style="width:30px;height:30px;background:#f9da7f">  </div></p>
        <p>Seleccione horas disponibles y rellene los campos del formulario ubicado a la derecha, a continuación presione el boton agendar cita, y listo ya habra agendado una cita con el Médico: {{$medico->name}} {{$medico->lastName}}</p>

        <p>Puede desplasarse a otras fechas en el calendario, con los botones "<",">" en la parte superior de este.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

@endif

@endsection
