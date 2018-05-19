@extends('layouts.app')
@section('css')
  <style media="screen">
    textarea.form-control{
      height: 100px;
    }
  </style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-3">
    <h2 class="text-center font-title">Editar Nota: "{{$note->title}}" {{$note->created_at}}</h2>

  </div>
</div>
{{-- MENU DE PACIENTES --}}
{{-- @include('medico.includes.main_medico_patients') --}}

<div class="card">
  <div class="card-header">
  {{$note->title}}
  </div>
  <div class="card-body">
    {!!Form::model($note,['route'=>['note_update',$note],'method'=>'POST'])!!}
      {!!Form::hidden('note_id',$note->id)!!}
      {!!Form::hidden('title',$note->title)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
        {!!Form::hidden('patient_id',$patient->id)!!}
        <div class="row">
          <div class="col-6">
            <h5>Fecha de ingreso</h5>
            {{Form::date('fecha_ingreso',null,['class'=>'form-control','id'=>'signos_vitales'])}}
          </div>
          <div class="col-6">
            <h5>Fecha de egreso</h5>
            {{Form::date('fecha_egreso',null,['class'=>'form-control','id'=>'signos_vitales'])}}
          </div>
        </div>
        <div class="form-group">
          <h5>Motivo del egreso</h5>
          {{Form::textarea('Motivo_del_egreso',null,['class'=>'form-control textar','id'=>'signos_vitales'])}}
        </div>
        <div class="form-group">
          <h5>Diagnosticos finales</h5>
          {{Form::textarea('Diagnosticos_finales',null,['class'=>'form-control','id'=>'pruebas_labs'])}}
        </div>

        <div class="form-group">
          <h5>Resumen de evolucion y estado actual</h5>
          {{Form::textarea('Resumen_de_evolucion_y_estado_actual',null,['class'=>'form-control','id'=>'pruebas_labs'])}}
        </div>

        <div class="form-group">
          <h5>Manejo durante la estancia hospitalaria</h5>
          {{Form::textarea('Manejo_durante_la_estancia_hospitalaria',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

        <div class="form-group">
          <h5>Problemas clinicos pendientes</h5>
          {{Form::textarea('Problemas_clinicos_pendientes',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

        <div class="form-group">
          <h5>Plan de manejo y tratamiento</h5>
          {{Form::textarea('Plan_de_manejo_y_tratamiento',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

        <div class="form-group">
          <h5>Recomendaciones para vigilancia ambulatoira</h5>
          {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

        <div class="form-group">
          <h5>Otros Datos</h5>
          {{Form::textarea('Recomendaciones_para_vigilancia_ambulatoira',null,['class'=>'form-control','id'=>'Exploracion Fisica'])}}
        </div>

      <input type="submit" name="" value="Guardar">
      <a href="{{route('notes_patient',['m_id'=>$medico->id,'p_id'=>$patient->id])}}" class="btn btn-secondary">Cancelar</a>
      {!!Form::close()!!}
      </div>
      </div>



      @endsection

      @section('scriptJS')
      <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
      <script type="text/javascript">

        $(document).ready(function(){

          // CKEDITOR.replace('Signos_vitales');
          // CKEDITOR.replace('Pruebas_de_laboratorio');
        });


      </script>

      @endsection
