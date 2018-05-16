@extends('layouts.app')

@section('content')
<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
     <div class="col-12">
      <h2 class="text-center font-title">Citas Médicas @if(isset($pending)){{$pending}}@elseif(isset($unrated)){{$unrated}}@endif</h2>
      <hr>
    </div>
  </div>
  <div class="mb-3">
    <a href="{{route('patient_appointments',$patient->id)}}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="<em>Todas</em>"><i class="fas fa-bars"></i></a>
    <a href="{{route('patient_appointments_pending',$patient->id)}}" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="<em>Pendientes</em>"><i class="fas fa-exclamation-triangle"></i></a>
    <a href="{{route('patient_appointments_unrated',$patient->id)}}" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="<em>Sin calificar</em>"><i class="fas fa-ban"></i></a>
  </div>
  @if($appointments->first() != Null)
  <div class="row mb-3">
    @foreach ($appointments as $app)
    <div class="col-lg-12">
      <div class="card date-card my-2">
        <div class="row">
          <div class="col-lg-4 col-sm-4 col-12">
           <div class="p-2">
            <label for="" class="font-title-grey"> Medico:</label> <p><a href="{{route('medico.edit',$app->medico->id)}}"><strong>{{$app->medico->name}} {{$app->medico->lastName}}</strong></a></p>
            <label for="" class="font-title-grey">Tipo de Cita:</label> <p>{{$app->title}}</p>
            <label for="" class="font-title-grey">Especialidad del Medico:</label> <p>{{$app->medico->scpecialty}}</p>
            @isset($app->descriptión)
            Mensaje o descriptión: <p>{{$app->descriptión}}</p>
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
            <label for="" class="font-title-grey">Estrellas Otorgadas:</label> <p>{{$app->score}}</p>
            <label for="" class="font-title-grey">Calificación:</label> <p>{{$app->calification}}</p>
            <label for="" class="font-title-grey">Comentario al Respecto:</label> <p>{{$app->comentary}}</p>
          </div>
        </div>
      </div>
      <a href="{{route('rate_appointment',$app->id)}}" class="btn btn-primary">Calificar Cita</a>
    </div>
  </div>
  @endforeach
  <div class="card-heading">
    {{$appointments->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No hay registro de citas agendadas</h4>
</div>
@endif
</div>
</div>
</section>
@endsection
