@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Mi Calificaión (aun falta por arreglar)</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  Tu Calificación: {{$medico->calification}} de {{$medico->votes}} voto(s)
  @include('medico.star_rate_calification')
</div>

<div class="row">
  <div class="col-12 mb-3">
    <h5 class="text-center">Calificación Otorgada por los Pacientes</h5>

  </div>
</div>
@foreach ($rate_medic as $value)
  <div class="card mt-2">
    <div class="card-header">
      {{$value->patient['name']}} {{$value->patient['lastName']}}
    </div>
    <div class="card-body">
      <div class="form-inline">
        Puntaje otorgado:
        @include('medico.star_rate')
      </div>
    </div>
    <div class="card-footer">
      @if(isset($value->comentary))
        Comentario: {{$value->comentary}}
      @else
        Sin Comentarios
      @endif
    </div>
  </div>
@endforeach


@endsection
