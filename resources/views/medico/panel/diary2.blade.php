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
    <div class="col-12 col-sm-5 col-lg-3">
      <div id="dashboard">
        <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
        <div class="col-12 border-head-panel text-center">
          <span>Usuario firmado:</span>
          <span>{{$medico->email}}</span>
        </div>
        <div class="col-12 border-panel-green text-center my-1">
          <a href="{{route('medico_schedule',$medico->id)}}">
            <span class="font-title ">Otorgar horario de consulta</span>
          </a>
        </div>
        <div class="border-panel-blue my-1">
          <div class="form-group text-center p-2">
            <div class="form-group">
              <label for="" class="font-title-blue" style="font-size: 20px;">Crear consulta</label>
            </div>
            {!!Form::open(['route'=>'medico_diary.store','method'=>'POST'])!!}
            <input class="form-control my-2" type="text" placeholder="Titulo" id="title2">
            {!!Form::select('eventType',['Cita Medica'=>'Cita Médica','Cita Medica Importante'=>'Cita Médica Importante','Consulta Medica'=>'Consulta Médica','Consulta Medica Importante'=>'Consulta Médica Importante','Recordatorio'=>'Recordatorio'],'Consulta Medica',['class'=>'form-control','id'=>'eventType2'])!!}
            <input class="form-control my-2" type="text" placeholder="Descripción (Opcional)" id="description2">
            <input class="form-control my-2" type="text" placeholder="Precio (Opcional)" id="price2">
            <div class="row">
              <div class="col-lg-3 col-12">
                <label for="" class="font-title ml-2 col-form-label">Inicio</label>
              </div>
              <div class="col-lg-9 col-12">
               {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start2'])!!}
             </div>
           </div>
           <div class="row mt-1">
            <div class="col-lg-3 col-12">
              <label for="" class="font-title ml-3">Hora</label>
            </div>
          </div>
          <div class="row">
            <div class="col-lg col-12 ">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStart2','placeholder'=>'--'])!!}</div>

            <div class="col-lg col-12 nopadding ">{!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStart2','placeholder'=>'--'])!!}</div>
            <div class="col-lg col-12 ">
              {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control'])!!}</div>
            </div>
            <label for="" class="font-title-blue mt-2">Datos de Culminacion(opcional)</label>
            <div class="row">
              <div class="col-lg-4 col-12">
                <label for="" class="font-title ml-3">Fecha</label>
              </div>
              <div class="col-8">
               {!!Form::date('date_end',null,['class'=>'form-control','id'=>'date_end3'])!!}
             </div>
           </div>
           <div class="row mt-1">
            <div class="col-3">
              <label for="" class="font-title ml-3">Hora</label>
            </div>
          </div>
          <div class="row">
            <div class="col">{!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEnd2','placeholder'=>'--'])!!}</div>

            <div class="col nopadding">{!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEnd2','placeholder'=>'--'])!!}</div>

            <div class="col">{!!Form::select('endformatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'endFormatHour2','class'=>'form-control  mb-1'])!!}</div>
          </div>

          <div id="alert_error" class="alert alert-warning alert-dismissible fade show text-left" role="alert" style="display:none">
            <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
            <p id="text_error" style="font-size:12px"></p>
          </div>

          <div id="alert_success" class="alert alert-success alert-dismissible fade show text-left" role="alert" style="display:none">
            <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
            <p id="text_success" style="font-size:12px"></p>
          </div>

          <div class="col-12 text-center mt-2 row">
            <div class="col-lg-6 col-12">
              <button onclick="store_event()" type="button" class="btn btn-config-blue btn-block my-1">Guardar</button>
              {{-- <button type="submit" class="btn btn-config-blue btn-block">Guardar</button> --}}
            </div>
            <div class="col-lg-6 col-12">
              <button onclick="vaciar()" type="button" class="btn btn-config-secondary btn-block my-1">Cancelar</button>
            </div>
            {!!Form::close()!!}
          </div>
        </div>
        <hr>
        <div class="col-12 box-control-panel text-center p-0">
          <a href="" id="green">
            <i class="fas fa-plus"></i>
            <h5>Dar un paciente de alta</h5>
          </a>
        </div>
        <hr>
        <div class="col-12">
          <div class="">
            <div class="card-body p-2 text-center p-0">
              <h5>Paciente ya registrado</h5>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
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
          <div class="row">
            <div class="col-12 box-control-panel text-center p-0">
              <a href="">
                <i class="fas fa-user-md"></i>
                <h5>Mis calificaciones<i class="fas fa-bell icon-notification"></i></h5>
              </a>
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
        <div class="col-12 box-control-panel text-center p-0">
          <a href="
          "><label class="filebutton">
            <img src="img/botones-medicossi-31.png" alt="">
            <span><input type="file" id="myfile" name="myfile"></span>
            <h5>Respaldar mi información</h5>
          </label>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="" class="btn-config-green btn btn-block">Configuración</a>
        <a href="" class="btn-config-green btn btn-block">Atras</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-9 col-sm-7 col-12">
  <div class="register">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center font-title">Profesionales</h2>
        <hr>
      </div>
    </div>
    <div class="row justify-content-center mb-2">
      <div class="col-lg-8 m-lg-auto col-12">
        <div class="row">
          <div class="col-lg-4 text-center col-6">
            <a href="#" onclick="calendario()"><img src="{{asset('img/botones-medicossi-26.png')}}" alt=""></a>
          </div>
          <div class="col-lg-4 text-center col-6">
            <img src="{{asset('img/botones-medicossi-27.png')}}" alt="">
          </div>
          <div class="col-lg-4 text-center col-6 m-auto mt-3">
            <a href=""><img src="{{asset('img/botones-medicossi-32.png')}}" alt=""></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12">
        {{-- <div class="align-items-center d-flex">
          <span>Ver: </span>
          <select class="custom-select">
            <option selected>Dias/Mes/Semana/Año</option>
            <option value="1">Día</option>
            <option value="2">Mes</option>
            <option value="3">Semana</option>
            <option value="4">Año</option>
            <option value="5">Fecha</option>
          </select>
        </div> --}}
      </div>
      <div class="col-12">
        <div class="row text-center">
          {{-- <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="" class="mx-2"> Disponible </label>
          </div>
          <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Cita por internet</label>
          </div>
          <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Confirmada con paciente</label>
          </div>
          <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Paciente valorado</label>
          </div>
          <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Cita cerrada y cobrada</label>
          </div> --}}
          {{-- <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Pendiente por cobrar o aseguradora</label>
          </div> --}}
          {{-- <div class="col">
            <span class="checkbox-wrapper">
              <input type="checkbox">
            </span>
            <label for="">Paciente cancelo</label> --}}
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div id="alert_danger_up1" class="alert alert-danger alert-dismissible fade show text-left" role="alert" style="display:none">
      <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
      <p id="text_danger_up1" style="font-size:12px"></p>
    </div>

    <div id="alert_error_up1" class="alert alert-warning alert-dismissible fade show text-left" role="alert" style="display:none">
      <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
      <p id="text_error_up1" style="font-size:12px"></p>
    </div>

    <div id="alert_success_up1" class="alert alert-success alert-dismissible fade show text-left" role="alert" style="display:none">
      <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
      <p id="text_success_up1" style="font-size:12px"></p>
    </div>

    <div class="card p-2" id="card_edit">
      <div class="row">
        <div class="col-12">
          <button type="button" name="button" class="close" onclick="close_edit()">
            &times;
          </button>
          <h3 class="font-title-blue text-center my-2">Editar</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-12">
          <input name="medico_id" type="hidden" value="1">
          {!!Form::open(['route'=>'medico_diary.store','method'=>'POST'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id4'])!!}
          {!!Form::hidden('event_id2',null,['id'=>'event_id2'])!!}
          <div class="form-group">
            <label for="" class="font-title">Titulo</label>
            {!!Form::text('title',null,['class'=>'form-control','id'=>'titleUp1'])!!}
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="" class="font-title">Tipo de Evento</label>
            {!!Form::select('eventType',['Cita Medica'=>'Cita Médica','Cita Medica Importante'=>'Cita Médica Importante','Consulta Medica'=>'Consulta Médica','Consulta Medica Importante'=>'Consulta Médica Importante','Recordatorio'=>'Recordatorio'],null,['class'=>'form-control','id'=>'eventTypeUp1'])!!}
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="" class="font-title">Descripción (Opcional)</label>
            {!!Form::text('description',null,['class'=>'form-control','id'=>'descriptionUp4'])!!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="" class="font-title">Precio</label>
            {!!Form::text('price',null,['class'=>'form-control','id'=>'priceUp1'])!!}
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="" class="font-title">Fecha de inicio</label>
            {!!Form::date('date_start',null,['class'=>'form-control','id'=>'dateStartUp1'])!!}
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="" class="font-title">Hora de Inicio</label>
            <div class="row">
              <div class="col">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStartUp1'])!!}</div>
              <div class="col">
                {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStartUp1'])!!}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5 m-lg-auto">
          <div class="form-group text-center">
            <label for="" class="font-title">Fecha de Culminación (Opcional)</label>
            {!!Form::date('date_End',null,['class'=>'form-control','id'=>'dateEndUp1'])!!}
          </div>
        </div>
        <div class="col-lg-5 m-lg-auto col-12 col-sm-5 m-sm-auto">
          <div class="form-group text-center">
            <label for="" class="font-title" class="mx-3">Hora de Culminación (Opcional)</label>
            <div class="row">
              <div class="col-lg-6 text-right my-1">{!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp1'])!!}</div>
              <div class="col-lg-6 text-left my-1"> {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEndUp1'])!!}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-12">
          <button onclick="close_edit()" type="button" class="btn-block btn btn-secondary my-1">Cancelar</button>
          {!!Form::close()!!}
        </div>
        <div class="col-lg-4 col-sm-4 col-12">
         <button onclick="delete_event()" type="button" class="btn-block btn btn-danger my-1">Eliminar</button>
       </div>
       <div class="col-lg-4 col-sm-4 col-12">
        <button onclick="update_event()" type="button" class="btn-block btn btn-primary my-1">Guardar</button>
      </div>
    </div>
    {!!Form::close()!!}
  </div>
  <hr>
  <div class="col-12" id="example">
    {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}
    @if(Session::Has('success2'))
    <div class="div-alert" style="padding:20px" id="alert-success2">
      <div class="alert alert-success alert-dismissible" role="alert" style="">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       {{Session::get('success2')}}
     </div>
   </div>
   @section('scriptJS')
   <script type="text/javascript">


    var new_position = $('#calendar').offset();
    window.scrollTo(new_position.left,new_position.top);

  </script>
  @endsection

  @endif

  {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}

  <div id='calendar' style=""></div>
  {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
  <div class="row">
    <div class="col-12">
      <h4 class="font-title-blue mt-5">Horario de trabajo</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table table-responsive table-config">
        <thead>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miércoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
          <th>Sábado</th>
          <th>Domingo</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <ul style="list-style:none">
                @foreach ($lunes as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style:none">
                @foreach ($martes as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style:none">
                @foreach ($miercoles as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style:none">
                @foreach ($jueves as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style:none">
                @foreach ($viernes as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <td>
              <ul style="list-style:none">
                @foreach ($sabado as $l)
                <li>{{$l->start}} a {{$l->end}}</li>
                @endforeach
              </ul>
            </td>
            <ul style="list-style:none">
              @foreach ($domingo as $l)
              <li>{{$l->start}} a {{$l->end}}</li>
              @endforeach
            </ul>
            <td>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
          <!-- <table class="table table-bordered" style="text-align:left">
            <thead>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miércoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
              <th>Sábado</th>
              <th>Domingo</th>
            </thead>
            <tbody>
              <tr>
                <td>
                  <ul style="list-style:none">
                    @foreach ($lunes as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none">
                    @foreach ($martes as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none">
                    @foreach ($miercoles as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none">
                    @foreach ($jueves as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none">
                    @foreach ($viernes as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul style="list-style:none">
                    @foreach ($sabado as $l)
                    <li>{{$l->start}} a {{$l->end}}</li>
                    @endforeach
                  </ul>
                </td>
                <ul style="list-style:none">
                  @foreach ($domingo as $l)
                  <li>{{$l->start}} a {{$l->end}}</li>
                  @endforeach
                </ul>
                <td>

                </td>
              </tr>
            </tbody>
          </table> -->

  <!--            <div id="team-schedule">
                <div id="people">
                  <input checked type="checkbox" id="alex" aria-label="Alex" value="1">
                  <input checked type="checkbox" id="bob" aria-label="Bob" value="2">
                  <input type="checkbox" id="charlie" aria-label="Charlie" value="3">
                </div>
              </div> -->
              {{-- <div id="scheduler"></div> --}}
            </div>
            <div class="row">
              <div class="col-lg-10 col-12 align-items-center">
                <h6>¿Dese que se mande un mensaje de recordatorio a su paciente con estatus de cita confirmada?</h6>
              </div>
              <div class="col-lg-2 col-12">
                <div class="radio-switch">
                  <div class="radio-switch-field">
                    <input id="switch-off" type="radio" name="radio-switch" value="off" checked>
                    <label for="switch-off">No</label>
                  </div>
                  <div class="radio-switch-field">
                    <input id="switch-on" type="radio" name="radio-switch" value="on">
                    <label for="switch-on">Si</label>
                  </div>
                </div>
              </div>
              <div class="col-12" id="open-check" style="display: none;">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline1">Una hora antes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline2">5 horas antes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline3">1 dia antes</label>
                </div>
              </div>
            </div>
            <div class="row my-5">
              <div class="col-lg-10 col-12 align-items-center">
                <h6>¿Dese que se mande un mensaje de confirmación a su paciente con estatus cita por internet?</h6>
              </div>
              <div class="col-lg-2 col-12">
                <div class="radio-switch">
                  <div class="radio-switch-field">
                    <input id="switch-off1" type="radio" name="radio-switch1" value="off" checked>
                    <label for="switch-off1">No</label>
                  </div>
                  <div class="radio-switch-field">
                    <input id="switch-on1" type="radio" name="radio-switch1" value="on">
                    <label for="switch-on1">Si</label>
                  </div>
                </div>
              </div>
              <div class="col-12" id="open-check1" style="display: none;">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline5" name="customRadioInline2" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline5">En cuanto se confirme su espacio</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline6" name="customRadioInline2" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline6">5 horas antes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline7" name="customRadioInline2" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInline7">1 dia antes</label>
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
      <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
      <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
      <script src="{{asset('fullcalendar/locale/es.js')}}"></script>
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
      <script type="text/javascript">


      </script>





      @endsection
