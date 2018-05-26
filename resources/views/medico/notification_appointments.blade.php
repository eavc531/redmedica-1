@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Notificaciones de Citas Pendientes</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

@if($appointments->first() != Null)
<div class="row">
  @foreach ($appointments as $app)
  <div class="col-lg-12">
    <div class="card date-card my-2">
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-12">
         <div class="p-2">
          <label for="" class="font-title-grey"> Medico:</label> <p><a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p>
          <label for="" class="font-title-grey">Tipo de Cita:</label> <p>{{$app->title}}</p>
          {{-- <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->scpecialty}}</p> --}}
          @isset($app->descriptión)
          Mensaje o descripción: <p>{{$app->descriptión}}</p>
          @else
          Mensaje o descripción:  <p style="color:rgb(153, 153, 158)">"No Aplica"</p>
          @endisset

        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-12">
        <div class="p-2">
          <label for="" class="font-title-grey">Fecha:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
          <label for="" class="font-title-grey">Hora:</label> <p>{{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
          <label for="" class="font-title-grey">Estado:</label> <p>{{$app->state}}</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-12">
        <div class="p-2">
          <label for="" class="font-title-grey">Fecha de Creacion:</label> <p>{{\Carbon\Carbon::parse($app->created_at)->format('d-m-Y')}}</p>

            <label for="" class="font-title-grey">Solicitada Por:</label> <p>@if($app->stipulated == 'Paciente') Paciente: {{$app->patient->name}} {{$app->patient->lastName}}@else Medico: {{$app->medico->name}} {{$app->medico->lastName}}

            @endif
          {{-- <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p>{{$app->score}}</p>
          <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p> --}}
          {{-- <label for="" class="font-title-grey">Comentario:</label> <p>{{$app->comentary}}</p> --}}


        </p>
        <div class="form-inline">
          <a href="{{route('marcar_como_vista_redirect',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Cita"><i class="far fa-edit"></i></a>


          <a href="{{route('marcar_como_vista',$app->id)}}" class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="Marcar como vista"><i class="fas fa-check"></i></a>


        </div>
        </div>
      </div>
    </div>



  </div>
</div>
@endforeach
  <div class="card-heading">
    {{$appointments->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi Notificaciones de Nuevas Citas por el Momento</h4>
</div>


{{-- <!-- Modal -->
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
</div> --}}

@endif

@endsection
