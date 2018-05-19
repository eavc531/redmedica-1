@extends('layouts.app')
@section('css')
  <style media="screen">
    .form-control{
      height: 100px;
    }
  </style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Configurar Nota: "{{$note->title}}" </h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header">
  {{$note->title}}
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_config_store','method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      <div class="form-group">
        <h5>Motivo de envio</h5>
        {{Form::textarea('Motivo_de_envio',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
      </div>

      <div class="form-group">
        <h5>Establecimiento que envia</h5>
        {{Form::textarea('Establecimiento_que_envia',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
      </div>
      <div class="form-group">
        <h5>Establecimiento receptor</h5>
        {{Form::textarea('Establecimiento_receptor',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
      </div>

    <div class="form-group">
      <h5>Diagnostico</h5>
      {{Form::textarea('Diagnostico',null,['class'=>'form-control','id'=>'pruebas_labs'])}}
    </div>
  <input type="submit" name="" value="Guardar">
  <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
  {!!Form::close()!!}

    {!!Form::close()!!}

</div>
</div>

@endsection
