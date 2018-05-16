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
              <h2 class="text-center font-title">Notas de Paciente: <span>{{$patient->name }} {{$patient->lastName }}</span></h2>
              <hr>
            </div>
          </div>

          {{-- MENU DE PACIENTES --}}
          @include('medico.includes.main_medico_patients')

          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
          </div>
          <hr>
          {{-- ////////////////////////////////////////////centro de menu////////////centro de menu// --}}

          <ul>
            @foreach ($notes as $note)
                <li>{{$note->title}} <a href="{{route('medico_note_edit',['medico_id'=>$medico->id,'patient_id'=>$patient->id,'note_id'=>$note->id])}}" class="btn">Ver/editar</a>
            @endforeach
          </ul>

          {{-- //////////centro de menu////////////centro de menu////////////centro de menu////////////centro de menu// --}}
          </div>
        <div class="col-12 col-lg-3">
          <div id="dashboard">
            <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
            <div class="col-12 border-head-panel text-center">
              <span>Usuario firmado:</span>
              <span>{{$medico->email}}</span>
            </div>


              <hr>
              <div class="col-12 box-control-panel text-center p-0">
                <a href="" id="green">
                  <i class="fas fa-plus"></i>
                  <h5>Dar paciente de alta</h5>
                </a>
              </div>


              <hr>
              <div class="col-12">
                <div class="col-12 box-control-panel text-center p-0">
                  <a href="" id="green">
                    <h5>Nueva nota médica</h5>
                    <i class="fas fa-plus-circle"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="border-panel-green">
              <div class="col-12">
                <div class="row">
                  <div class="col-12 box-control-panel text-center p-0">
                    <a href="">
                      <img src="{{asset('img/botones-medicossi-26.png')}}" alt="">
                      <h5>Agrega nueva cita</h5>
                    </a>
                  </div>
                  <div class="col-12">
                    <div class="col-lg-12 col-12 mt-2">
                      <button type="submit" class="btn-config-blue btn btn-block" data-toggle="modal" data-target="#modal-end-consult">Termino de consulta</button>
                    </div>
                    <div class="col-lg-12 col-12 mt-2">
                      <button type="submit" class="btn-config-green btn btn-block">Nuevo recordatorio</button>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12">
                <div class="col-12 box-control-panel text-center p-0">
                  <a href="">
                    <i class="fas fa-chart-line"></i>
                    <h5>Mis Estadisticas</h5>
                  </a>
                </div>
              </div>
              <hr>

          </div>
          <div class="row">
            <div class="col-12">
              <a href="" class="btn-config-green btn btn-block">Configuración</a>
              <a href="" class="btn-config-green btn btn-block">Atras</a>
            </div>
          </div>
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
