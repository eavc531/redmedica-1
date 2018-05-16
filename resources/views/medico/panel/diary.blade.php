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
              <h2 class="text-center font-title">Mi Agenda</h2>

            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-12">
            </div>
            </div>
          </div>

        @include('medico.includes.alert_calendar')
        @include('medico.includes.card_edit')
          <hr>
          <div class="" id="example">
            {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}






          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}
          @if($countEventSchedule != 0)

          <div id='calendar' style=""></div>


          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}


            <div class="row text-center mt-2">
              <div class="col">
                  <input type="radio" value="Disponible" name="opcion" onclick="filtroDisponible()"/><br />
                <label for="" class="mx-2"> Disponible </label>
              </div>
              <div class="col">
              <input type="radio" value="A" name="opcion" onclick="filtroCitaPorInternet()"/><br />
                <label for="">Cita por internet</label>
              </div>
              {{-- <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtrar('Cita por internet')"/><br />
                <label for="">Confirmada con paciente</label>
              </div> --}}
              {{-- <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="filtrar('Cita por internet')"/><br />
                <label for="">Paciente valorado</label>
              </div> --}}
              <div class="col">
                <input type="radio" value="A" name="opcion" onclick="CerradaYCobrada()"/><br />
                <label for="">Cita cerrada y cobrada</label>
              </div>
              <div class="col">
                  <input type="radio" value="A" name="opcion" onclick="PendientePorCobrar()"/><br />
                <label for="">Pendiente por cobrar o aseguradora</label>
              </div>
              <div class="col">
                <input type="radio" value="A" name="opcion" onclick="FiltroPacienteCancelo()"/><br />
                <label for="">Paciente cancelo</label>
              </div>
            </div>


          <div class="card mt-5 mb-5" >



          <div class="row">
            <div class="col-12 text-center">
              <h4 class="font-title-blue text-center mt-3">Horario de trabajo</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        @foreach ($lunes as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>
                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($martes as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($miercoles as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}


                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($jueves as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}


                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($viernes as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($sabado as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>

                              <hr>
                          </ul>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($domingo as $day)
                          <ul>
                            <li>
                              {{$day->start}}
                                      a
                              {{$day->end}}

                            </li>
                              <hr>
                          </ul>
                        @endforeach
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
                <div class="card-footer text-right">
                  <a href="{{route('medico_schedule',$medico->id)}}" class="btn btn-success ">Editar</a>
                </div>
              </div>
            </div>
          </div>
          </div>
        @else
          <div class="card mt-5 mb-5">
            <div class="card-header">
              <h4>Bienevenido al Panel de Control</h4>
            </div>
            <div class="card-body">
              <h5>Para poder ver el Calendario y todas sus fucniones debe Otorgar un Horario de Trabajo</h5>
              <a href="{{route('medico_schedule',$medico->id)}}" class="btn btn-primary">Otorgar un Horario de Trabajo</a>
            </div>
          </div>
        @endif
        {{-- IF SHOW CALENDAR --}}
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
        <div class="col-12 col-lg-3">
          <div id="dashboard">
            <img  class="img-dashboard" src="{{asset('img/Medicossi-Marca original-04.png')}}" alt="">
            <div class="col-12 border-head-panel text-center">
              <span>Usuario firmado:</span>
              <span>{{$medico->email}}</span>
            </div>
            <div class="col-12 border-panel-green text-center my-1">
              <a class="btn btn-block btn-config-green" href="{{route('medico_schedule',$medico->id)}}">
                Otorgar horario de consulta
              </a>
            </div>
            <div class="border-panel-blue my-1">
              <div class="form-group text-center">
                <button type="button" class="btn-info btn" data-toggle="modal" data-target="#info1"><i class="fas fa-info mr-2"></i>Ayuda</button>
                <div class="form-group" style="margin-top:35px">
                  <label for="" class="label-title ">Agendar Evento Personal</label>
                </div>

                  {!!Form::open(['route'=>'medico_diary.store','method'=>'POST'])!!}
                <input class="form-control my-2" type="text" placeholder="Titulo" id="title2">
                {!!Form::select('title',['Ambulatoria'=>'Ambulatoria','Externa o a Domicilio'=>'Externa o a Domicilio','Urgencias'=>'Urgencias','Cita por Internet'=>'Cita por Internet'],null,['class'=>'form-control','id'=>'eventType2','Tipo de Evento'=>'Tipo de Cita'])!!}
                <input class="form-control my-2" type="text" placeholder="Mensaje" id="eventType2">


                <input class="form-control my-2" type="text" placeholder="Descripción (Opcional)" id="description2">
                <input class="form-control my-2" type="text" placeholder="precio (Opcional)" id="price2">
                <div class="row">
                  <div class="col-4 font-title">
                    inicio:
                  </div>
                    <div class="col-8">
                       {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start2'])!!}
                    </div>
                </div>
                <div class="row mt-1">
                  <div class="col-3 font-title">
                    Hora

                  </div>
                  <div class="form-inline">
                    {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStart2','placeholder'=>'--'])!!}

                      {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStart2','placeholder'=>'--'])!!}

                      {{-- {!!Form::select('startFormatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'startFormatHour3','class'=>'form-control  mb-1'])!!} --}}
                  </div>

                </div>
                <label for="" class="mt-2 font-title">Datos de Culminacion(opcional)</label>
                <div class="row">
                  <div class="col-4">
                    fecha:
                  </div>
                    <div class="col-8">

                       {!!Form::date('date_end',null,['class'=>'form-control','id'=>'date_end3'])!!}
                    </div>
                </div>
                <div class="row mt-1">

                  <div class="col-3">
                    Hora

                  </div>
                  <div class="form-inline">
                    {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEnd2','placeholder'=>'--'])!!}

                      {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEnd2','placeholder'=>'--'])!!}

                      {{-- {!!Form::select('endformatHour',['am'=>'am','pm'=>'pm'],null,['id'=>'endFormatHour2','class'=>'form-control  mb-1'])!!} --}}
                  </div>

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



                  <div class="col-lg-6">
                    @if($countEventSchedule != 0)
                    <button onclick="store_event()"type="button" class="btn btn-config-blue">Guardar</button>
                    @else
                    <button onclick=""type="button" class="btn btn-config-blue" disabled>Guardar</button>
                    @endif
                    {{-- <button type="submit" class="btn btn-config-blue">Guardar</button> --}}
                  </div>
                  <div class="col-lg-6">
                    <button onclick="vaciar()" type="button"class="btn btn-config-secondary">Cancelar</button>
                  </div>
                  {!!Form::close()!!}
                </div>
              </div>
            </div>




          </div>

        </div>
      </div>
    </div>
  </div>



{{-- <button onclick="filtrar()" type="button" name="button">Filtrar</button> --}}
{{-- <input type="text" name="" value="" id="input1"> --}}

@isset($days_hide)
<input id="lunes" type="hidden" name="" value="{{$days_hide['lunes']}}">
<input id="martes" type="hidden" name="" value="{{$days_hide['martes']}}">
<input id="miercoles" type="hidden" name="" value="{{$days_hide['miercoles']}}">
<input id="jueves" type="hidden" name="" value="{{$days_hide['jueves']}}">
<input id="viernes" type="hidden" name="" value="{{$days_hide['viernes']}}">
<input id="sabado" type="hidden" name="" value="{{$days_hide['sabado']}}">
<input id="domingo" type="hidden" name="" value="{{$days_hide['domingo']}}">

<input id="max_lunes" type="hidden" name="" value="{{$lunes_libre_start = '11:30'}}">
<input id="max_lunes" type="hidden" name="" value="{{$lunes_libre_end = '13:30'}}">

<input id="max_hour" type="hidden" name="" value="{{$max_hour}}">
<input id="min_hour" type="hidden" name="" value="{{$min_hour}}">

@endisset
<div class="modal fade" id="info1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Como agendar una cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h5 class="font-title-grey">¿Como Agendar Cita con un Paciente Registrado?</h5>
        <p>Para agendar cita, debe seleccionar en la barra lateral izquierda,la opcion "Mis Pacientes",seleccionar el
        paciente al que desea agendar la consulta, y luego hacer click en el boton "Agendar cita", con esto se abrira el panel correspondiente para agendar cita con el paciente seleccionado.</p>

        <h5 class="font-title-grey">Mi Agenda</h5>
        <p>El Panel mi Agenda le permite organizar sus eventos, y filtrarlos segun su tipo, tambien puede editar los eventos creados previamente; al hacer click sobre ellos se abrira una ventana que contendra la informacion de los mismos, en esta ventana podra modificar los datos del evento seleccionado, o eliminar el evento por completo.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
  <script src='{{asset('fullcalendar/locale/es.js')}}'></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
  <script type="text/javascript">


    $(document).ready(function(){
      max_hour = $('#max_hour').val();
      min_hour = $('#min_hour').val();

      lunes = $('#lunes').val();
      martes = $('#martes').val();
      miercoles = $('#miercoles').val();
      jueves = $('#jueves').val();
      vierness = $('#vierness').val();
      sabado = $('#sabado').val();
      domingo = $('#domingo').val();

      if(lunes == 1){
        lunes = 1;
      }
      martes = $('#martes').val();
      if(martes == 2){
        martes = 2;
      }
      miercoles = $('#miercoles').val();
      if(miercoles == 3){
        miercoles = 3;
      }
      jueves = $('#jueves').val();
      if(jueves == 4){
        jueves = 4;
      }
      viernes = $('#viernes').val();
      if(viernes == 5){
        viernes = 5;
      }
      sabado = $('#sabado').val();
      if(sabado == 6){
        sabado = 6;
      }
      domingo = $('#domingo').val();
      if(domingo == 0){
        domingo = 0;
      }


    // function calendario(){
          $('#calendar').fullCalendar({

            customButtons: {
            myCustomButton: {
            text: 'Pantalla Completa',
            click: function() {
          window.location.href = '{{route("medico_diary_fullscreen",$medico->id)}}';
          }
        }
      },

        header: {
          left: 'prev,next today myCustomButton',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listWeek'
        },
        // defaultDate: '2018-03-12',
        defaultView: 'agendaWeek',
        eventStartEditable: false, //desabilita el arrastre
        eventDurationEditable: false,//desabilita el estiramiento
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true, //permite seleccionar campos
        selectHelper: true, //permite agregar nuevos eventos
        maxTime:max_hour,
        minTime:min_hour,
        hiddenDays: [lunes,martes,miercoles,jueves,viernes,sabado,domingo],


        select:function(start,end){
         start = moment(start);
         end = moment(end);
         day = start.format('d');
         hour_start = start.format('HH:mm');
         hour_end = end.format('HH:mm');
         route = "{{route('compare_hours',$medico->id)}}";

         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:'post',
          url:route,
          data:{hour_start:hour_start,hour_end:hour_end,day:day},
          error:function(error){
            console.log(error);
         },
         success:function(result){
           if(result == 'fuera de horario'){
             alert('Imposible editar campo, esta establecido como horas no laborales.')
             return;
           }else{
             $('#hourStart2').val(start.format('HH'));
             $('#minsStart2').val(start.format('mm'));
             $('#date_start2').val(start.format('YYYY-MM-DD'));
             $('#date_end3').val(end.format('YYYY-MM-DD'));
             $('#minsEnd2').val(end.format('mm'));
             $('#hourEnd2').val(end.format('HH'));
             parpadeo();
           }
         }
       });

         //$('#ModalCreate').modal('show');
         //alert(start.format('YYYY-MM-DD'));
        },

        events:"{{route('medico_diary_events',$medico->id)}}",

        eventClick: function(event, jsEvent, view){
            var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
            var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
            hour_start = $.fullCalendar.moment(event.start).format('HH');
            mins_start = $.fullCalendar.moment(event.start).format('mm');
            hour_end = $.fullCalendar.moment(event.end).format('HH');
            mins_end = $.fullCalendar.moment(event.end).format('mm');
            $('#priceUp1').val(event.price);
            $('#titleUp1').val(event.title);
            $('#state').val(event.state);
            $('#descriptionUp4').val(event.description);
            $('#eventTypeUp1').val(event.eventType);
            $('#dateStartUp1').val(start);

            $('#hourStartUp1').val(hour_start);
            $('#minsStartUp1').val(mins_start);
            $('#dateEndUp1').val(end);
            $('#hourEndUp1').val(hour_end);
            $('#minsEndUp1').val(mins_end);
            $('#event_id2').val(event.id);
            $('#event_id_destroy2').val(event.id);
            $('#namePatient').val(event.namePatient);
            $('#card_edit').fadeOut();
            $('#card_edit').fadeIn();
            vaciar();
            $('#alert_success_up1').fadeOut();
            // $('#ModalEdit').modal('show');
        },
        eventRender: function (event, element, view) {



          element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">'+event.namePatient+'</span><span style="font-size: 10px"><p style="font-size: 10px">'+event.description+'</p></span>');
        },
        //       businessHours:
        // {
        //         start: '6:00',
        //         end: '12:00',
        //         dow: [3],
        // }
      });
  });


      function newConsultation(){
        $('#eventType').val('Consulta Medica');
        $('#ModalCreate').modal('show');
      }
      function medicalAppointment(){
        $('#eventType').val('Cita Medica');
        $('#ModalCreate').modal('show');
      }

    // desactivar botones
    // ,
    //        	viewRender: function(currentView){
    //       		var minDate = moment(),
    //       		maxDate = moment().add(6,'days');
    //       		// Past
    //       		if (minDate >= currentView.start && minDate <= currentView.end) {
    //             $(".fc-prev-button").hide();
    //       			// $(".fc-prev-button").prop('disabled', true);
    //       			// $(".fc-prev-button").addClass('fc-state-disabled');
    //       		}
    //       		else {
    //       			$(".fc-prev-button").removeClass('fc-state-disabled');
    //       			$(".fc-prev-button").prop('disabled', false);
    //       		}
    //       		// Future
    //       		if (maxDate >= currentView.start && maxDate <= currentView.end) {
    //               $(".fc-next-button").hide();
    //       			// $(".fc-next-button").prop('disabled', true);
    //       			// $(".fc-next-button").addClass('fc-state-disabled');
    //       		} else {
    //       			$(".fc-next-button").removeClass('fc-state-disabled');
    //       			$(".fc-next-button").prop('disabled', false);
    //       		}
    //       	}





    function cerrar(){
      $('#alert_error').fadeOut();
      $('#alert_success').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_error_up1').fadeOut();
      $('#alert_success_up1').fadeOut();
      $('#alert_danger_up1').fadeOut();

    }

    function vaciar(){
      title = $('#title2').val("");
      eventType = $('#eventType2').val("");
      description = $('#description2').val("");
      price = $('#price2').val("");
      date_start = $('#date_start2').val("");
      hourStart = $('#hourStart2').val("");
      minsStart = $('#minsStart2').val("");
      startFormatHour = $('#startFormatHour3').val("");
      dateEnd = $('#date_end3').val("");
      hourEnd = $('#hourEnd2').val("");
      minsEnd = $('#minsEnd2').val("");
      endFormatHour = $('#endFormatHour2').val("");
      $('#alert_error').fadeOut();
    }

    function vaciar2(){
      title = $('#titleUp1').val("");
      eventType = $('#eventTypeUp1').val("");
      description = $('#descriptionUp4').val("");
      price = $('#priceUp1').val("");
      date_start = $('#dateStartUp1').val("");
      hourStart = $('#hourStartUp1').val("");
      minsStart = $('#minsStartUp1').val("");
      startFormatHour = $('#startFormatHour3').val("");
      dateEnd = $('#dateEndUp1').val("");
      hourEnd = $('#hourEndUp1').val("");
      minsEnd = $('#minsEndUp1').val("");
      endFormatHour = $('#endFormatHour2').val("");
      event_id = $('#event_id2').val("");
    }


    function store_event(){

      title = $('#title2').val();
      eventType = $('#eventType2').val();
      description = $('#description2').val();
      price = $('#price2').val();
      date_start = $('#date_start2').val();
      hourStart = $('#hourStart2').val();
      minsStart = $('#minsStart2').val();
      startFormatHour = $('#startFormatHour3').val();
      dateEnd = $('#date_end3').val();
      hourEnd = $('#hourEnd2').val();
      minsEnd = $('#minsEnd2').val();
      endFormatHour = $('#endFormatHour2').val();

      medico_id = "{{$medico->id}}";



      route = "{{route('medico_diary.store')}}";
      errormsj = '';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,eventType:eventType,description:description,price:price,date_start:date_start,hourStart:hourStart,minsStart:minsStart,startFormatHour:startFormatHour,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,endFormatHour:endFormatHour,medico_id:medico_id},
       error:function(error){
         console.log(error);
        $.each(error.responseJSON.errors, function(index, val){
          errormsj+='<li>'+val+'</li>';
        });
        $('#text_error').html('<ul style="list-style:none;">'+errormsj+'</ul>');
        $('#alert_error').fadeIn();
        $('#alert_success').fadeOut();

        console.log(errormsj);
      },
      success:function(result){
        if(result == 'fuera del horario'){
          $('#text_error').html('Imposible crear evento fuera del horario establecido');
          $('#alert_error').fadeIn();
          $('#alert_success').fadeOut();
        }else{
          console.log(result);
          $('#text_success').html('Guardado con Exito');
          $('#alert_success').fadeIn();
          $('#alert_error').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');
        }

      }
    });

    }

    function close_edit(){

      $('#card_edit').fadeOut();
      vaciar2();
    }

    function update_event(){

      title = $('#titleUp1').val();
      eventType = $('#eventTypeUp1').val();
      description = $('#descriptionUp4').val();
      price = $('#priceUp1').val();
      date_start = $('#dateStartUp1').val();
      hourStart = $('#hourStartUp1').val();
      minsStart = $('#minsStartUp1').val();
      startFormatHour = $('#startFormatHour3').val();
      dateEnd = $('#dateEndUp1').val();
      hourEnd = $('#hourEndUp1').val();
      minsEnd = $('#minsEndUp1').val();
      endFormatHour = $('#endFormatHour2').val();
      state = $('#state').val();

      medico_id = "{{$medico->id}}";
      event_id = $('#event_id2').val();


      route = "{{route('update_event')}}";
      errormsj = '';

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,eventType:eventType,description:description,price:price,date_start:date_start,hourStart:hourStart,minsStart:minsStart,startFormatHour:startFormatHour,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,endFormatHour:endFormatHour,medico_id:medico_id,event_id:event_id,state:state},
       error:function(error){

         console.log(error);
        $.each(error.responseJSON.errors, function(index, val){
          errormsj+='<li>'+val+'</li>';
        });
        $('#text_error_up1').html('<ul style="list-style:none;">'+errormsj+'</ul>');
        $('#alert_error_up1').fadeIn();
        $('#alert_success_up1').fadeOut();

        console.log(errormsj);
      },
      success:function(result){
        if(result == 'fuera del horario'){
          $('#text_error_up1').html('imposible guardar evento, fuera del horario establecido');
          $('#alert_error_up1').fadeIn();
        }else {
          console.log(result);
          $('#text_success_up1').html('Guardado con Exito');
          $('#alert_success_up1').fadeIn();
          $('#alert_error_up1').fadeOut();
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('refetchEvents');
          close_edit();
        }

      }
    });

    }

    function delete_event(){
      question = confirm('¿Esta segur@ de Borrar este Evento?');
      if(question == false){
       exit();
     }
      event_id = $('#event_id2').val();


      route = "{{route('delete_event')}}";
      errormsj = '';

      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{event_id:event_id},
       error:function(error){
         console.log(error);
      },
      success:function(result){
        console.log(result);
        $('#text_danger_up1').html(result);
        $('#alert_danger_up1').fadeIn();

        $('#alert_error_up1').fadeOut();
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('refetchEvents');
        close_edit();
      }
    });

    }




    function filtrar(filtro){
      $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
      test = 1;
      route = '{{route('medico_diary_events2',$medico->id)}}';
          $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type:'post',
           url:route,
           data:{test:test},
              error:function(error){
                 console.log(error);
              },
              success:function(result){
                $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                    if(value.eventType == 'Consulta Medica Importante' || value.rendering == 'background'){
                        $("#calendar").fullCalendar('renderEvent', value, true);
                    }
                });

          }
          });

      }

      function filtroDisponible(filtro){
        $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
        test = 1;
        route = '{{route('medico_diary_events2',$medico->id)}}';
            $.ajax({
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             type:'post',
             url:route,
             data:{test:test},
                error:function(error){
                   console.log(error);
                },
                success:function(result){
                  $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                      if(value.state != 'Cancelada' & value.state != 'Cerrada y Cobrada'){
                          $("#calendar").fullCalendar('renderEvent', value, true);
                      }
                  });

            }
            });

        }

        function filtroCitaPorInternet(){
          $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
          test = 1;
          route = '{{route('medico_diary_events2',$medico->id)}}';
              $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type:'post',
               url:route,
               data:{test:test},
                  error:function(error){
                     console.log(error);
                  },
                  success:function(result){
                    $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                        if(value.eventType == 'Cita por Internet'){
                            $("#calendar").fullCalendar('renderEvent', value, true);
                        }
                    });

              }
              });

          }


          function  CerradaYCobrada(){
            $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
            test = 1;
            route = '{{route('medico_diary_events2',$medico->id)}}';
                $.ajax({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 type:'post',
                 url:route,
                 data:{test:test},
                    error:function(error){
                       console.log(error);
                    },
                    success:function(result){
                      $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                          if(value.state == 'Cerrada y Cobrada'){
                              $("#calendar").fullCalendar('renderEvent', value, true);
                          }
                      });

                }
                });

            }



function  PendientePorCobrar(){
  $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
  test = 1;
  route = '{{route('medico_diary_events2',$medico->id)}}';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{test:test},
          error:function(error){
             console.log(error);
          },
          success:function(result){
            $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                if(value.state == 'Pendiente'){
                    $("#calendar").fullCalendar('renderEvent', value, true);
                }
            });

      }
      });

  }


  function  FiltroPacienteCancelo(){
    $("#calendar").fullCalendar('removeEvents');//remove the old filtered events
    test = 1;
    route = '{{route('medico_diary_events2',$medico->id)}}';
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'post',
         url:route,
         data:{test:test},
            error:function(error){
               console.log(error);
            },
            success:function(result){
              $.each(result,function(index,value){//for each event, I will compare the value with the filter, if true, render
                  if(value.state == 'Pagada'){
                      $("#calendar").fullCalendar('renderEvent', value, true);
                  }
              });

        }
        });

    }


    function parpadeo(){

        $("#hourStart2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#minsStart2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#date_start2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#date_end3").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#minsEnd2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
        $("#hourEnd2").fadeTo(200, .2)
        .fadeTo(200, 1).fadeTo(200, .2).fadeTo(200, 1);
    }



  </script>





  @endsection
