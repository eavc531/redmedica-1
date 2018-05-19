@extends('layouts.app')

@section('content')


<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Crear nota para: {{$patient->name}} {{$patient->lastName}} </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
@include('medico.includes.main_medico_patients')

<ul>
@foreach ($notes_pre as $note)
  <li>{{$note->title}}
    @if($note->title == 'Nota Médica Inicial')
    <a href="{{route('note_medic_ini_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @elseif($note->title == 'Nota Médica de Evolucion')
    <a href="{{route('note_evo_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @elseif($note->title == 'Nota de Interconsulta')
    <a href="{{route('note_inter_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @elseif($note->title == 'Nota médica de Urgencias')
    <a href="{{route('note_urgencias_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @elseif($note->title == 'Nota médica de Egreso')
      <a href="{{route('note_egreso_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @elseif($note->title == 'Nota de Referencia o traslado')
      <a href="{{route('note_referencia_create',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-primary">Crear</a>
    @endif
    xx
    <a href="{{route('note_config',['m_id'=>$medico->id,'p_id'=>$patient->id,'n_id'=>$note->id ])}}" class="btn btn-warning">Configurar</a></li>
@endforeach
</ul>


@endsection
