@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Citas con Paciente: {{$patient->name}} {{$patient->lastName}} </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')

@if($appointments->first() != Null)
<div class="row">
  @foreach ($appointments as $app)
    <div class="card mb-2" style="width:100%">
      <div class="card-body">
        <p>Tipo de Cita: {{$app->title}}</p>
        <p>Paciente: <a href="{{route('medico.edit',$app->patient->id)}}"><strong>{{$app->patient->name}} {{$app->patient->lastName}}</strong></a></p>
        @isset($app->descriptión)
        <p>Mensaje o descriptión: {{$app->descriptión}}</p>
        @endisset
        <p>Fecha: {{\Carbon\Carbon::parse($app->hour_start)->format('d-m-Y')}}</p>
        <p>Hora: {{\Carbon\Carbon::parse($app->hour_start)->format('H:i')}}</p>
        <p>Estado: {{$app->state}}</p>
        @isset($app->score)
          <p>Estrellas Otorgadas: {{$app->score}}</p>
        @endisset
        @isset($app->calification)
          <p>Calificación: {{$app->calification}}</p>
        @endisset
        @isset($app->comentary)
            <p>Comentario al Respecto: {{$app->comentary}}</p>
        @endisset


      </div>
      <div class="card-footer">
        <a href="{{route('edit_appointment',['m_id'=>$medico,'p_id'=>$patient->id,'app_id'=>$app->id])}}" class="btn btn-success">Editar</a>

      </div>
    </div>
  @endforeach
  <div class="card-heading">
    {{$appointments->appends(Request::all())->links()}}
  </div>
</div>
@else
<div class="text-center">
  <h4 class="text-primary">No ahi registro de Citas Agendadas</h4>
</div>

@endif

@endsection
