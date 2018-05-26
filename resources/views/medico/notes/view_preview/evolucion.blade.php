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
    <h2 class="text-center font-title">Crear Nota: "{{$note->title}}" para el Paciente: {{$patient->name}} {{$patient->lastName}}</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header">
  {{$note->title}}
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>'note_store','method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
        {!!Form::hidden('patient_id',$patient->id)!!}
        @include('medico.notes.view_preview.datos_paciente')
<hr>
        <div class="form-group">
          <h5>Exploracion fisica</h5>
          <p>{!!$note->Exploracion_fisica!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Signos vitales</h5>
          <p>{!!$note->Signos_vitales!!}</p>
        </div>
        <hr>
        <div class="form-group">
          <h5>Pruebas de laboratorio</h5>
          <p>{!!$note->Pruebas_de_laboratorio!!}</p>

        </div>
<hr>
        <div class="form-group">
          <h5>Evolucion y actualizacion del cuadro clinico</h5>
          <p>{!!$note->Evolucion_y_actualizacion_del_cuadro_clinico!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Diagnostico</h5>
          <p>{!!$note->Diagnostico!!}</p>

        </div>

<hr>
        <div class="form-group">
          <h5>Afección principal o motivo de consulta</h5>
          <p>{!!$note->Afeccion_principal_o_motivo_de_consulta!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Afeccion secundaria</h5>
          <p>{!!$note->Afeccion_secundaria!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Pronostico</h5>
          <p>{!!$note->Pronostico!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Tratamiento y o receta</h5>
          <p>{!!$note->Tratamiento_y_o_recetas!!}</p>

        </div>
        <hr>
        <div class="form-group">
          <h5>Indicaciones terapeuticas</h5>
          <p>{!!$note->Indicaciones_terapeuticas!!}</p>
        </div>
          @include('medico.notes.view_preview.data_medic')







  </div>
</div>



@endsection

@section('scriptJS')
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script type="text/javascript">

        $(document).ready(function(){

          CKEDITOR.replace('Signos_vitales');
          CKEDITOR.replace('Pruebas_de_laboratorio');
        });


  </script>

@endsection
