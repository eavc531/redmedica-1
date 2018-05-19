@extends('layouts.app-panel')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
{{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-12">

        <div class="register">
          <div class="row">
            <div class="col-12">
              <h2 class="text-center font-title">Configurar Formato: {{$note->title}}</h2>
              <hr>
            </div>
          </div>


          {!!Form::open(['route'=>'note_config_store','method'=>'POST'])!!}

          <div class="form-inline">
            <label for="">Titulo de la Nota: </label>
            {!!Form::text('title',$note->title,['class'=>'form-control'])!!}
            <label for="">Fecha: </label>
            {!!Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
          </div>

          {!!Form::textarea('content',$note->content,['id'=>'editor1'])!!}

          {!!Form::hidden('medico_id',$medico->id)!!}
          {!!Form::hidden('note_id',$note->id)!!}
          {!!Form::hidden('patient_id',$patient->id)!!}
          <div class="form-inline">
            <label for="">Médico Tratante: </label>
            {!!Form::text('name_medico',$medico->name.' '.$medico->lastName,['class'=>'form-control'])!!}

          </div>
          {!!Form::submit('Guardar')!!}
          {!!Form::close()!!}
          {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
          </div>
        <div class="col-12 col-lg-3">



        </div>
      </div>
    </div>
  </div>




  @endsection
  {{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('scriptJS')
  {{-- <script src="{{asset('fullcalendar/lib/jquery.min.js')}}"></script> --}}
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  <script>
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace( 'editor1' );
  </script>





  @endsection
