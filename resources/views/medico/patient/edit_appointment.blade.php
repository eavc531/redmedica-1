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
              <h2 class="text-center font-title">Editar Cita: {{$app->title}},Paciente: {{$patient->name}} {{$patient->lastName}}</h2>

            </div>
          </div>

          </div>
          {{-- MENU DE PACIENTES --}}
          {{-- @include('medico.includes.main_medico_patients') --}}
          <div class="alert-info p-3 m-2" style="display:none" id="alert_carga5">
            Procesando...
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
                {!!Form::model($app,['route'=>'update_event','method'=>'POST'])!!}
                {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id4'])!!}
                {!!Form::hidden('event_id',$app->id,['id'=>'event_id2'])!!}
                <div class="form-group">
                  <label for="" class="font-title">Paciente</label>
                  {{Form::text('namePatient',null,['id'=>'namePatient','class'=>'form-control','disabled'])}}
                </div>
              </div>
              <div class="col-lg-4 col-12">
                <div class="form-group">
                  <label for="" class="font-title">Tipo de evento</label>
                  {!!Form::text('title',null,['class'=>'form-control','id'=>'titleUp1'])!!}
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
                  {!!Form::date('date_start',\Carbon\Carbon::parse($app->start),['class'=>'form-control','id'=>'dateStartUp1'])!!}
                </div>
              </div>
              <div class="col-lg-4 col-12">
                <div class="form-group">
                  <label for="" class="font-title">Hora de Inicio</label>

                  <div class="row">
                    <div class="col">{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23'],\Carbon\Carbon::parse($app->start)->format('H'),['class'=>'form-control','id'=>'hourStartUp1'])!!}</div>
                    <div class="col">
                      {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],\Carbon\Carbon::parse($app->start)->format('i'),['class'=>'form-control','id'=>'minsStartUp1'])!!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              {{-- <div class="col-lg-4">
                <div class="form-group text-center">
                  <label for="" class="font-title">Fecha de Culminación</label>
                  {!!Form::date('date_End',null,['class'=>'form-control','id'=>'dateEndUp1'])!!}
                </div>
              </div> --}}
              <div class="col-lg-4 col-12 col-sm-5 m-sm-auto">
                <div class="form-group text-center">
                  <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
                  <div class="row">
                    <div class="col-lg-6 my-1">{!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],\Carbon\Carbon::parse($app->end)->format('H'),['class'=>'form-control','id'=>'hourEndUp1'])!!}</div>
                    <div class="col-lg-6 my-1"> {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],\Carbon\Carbon::parse($app->end)->format('i'),['class'=>'form-control','id'=>'minsEndUp1'])!!}</div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <label for="Estado" class="font-title">Estado:</label>
                {{Form::select('state',['Pendiente'=>'Pendiente','Cancelada'=>'Cancelada','Pagada'=>'Pagada','Cerrada y Cobrada'=>'Cerrada y Cobrada'],null,['class'=>'form-control','id'=>'state'])}}
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-4 col-12">
                <a href="{{route('delete_event2',$app->id)}}" class="btn btn-danger btn-block">Eliminar</a>
              </div>
              <div class="col-lg-4 col-sm-4 col-12">
                <a href="{{route('medico_app_details',['m_id'=>$app->medico_id,'p_id'=>$app->patient_id,'app_id'=>$app->id])}}" class="btn-block btn btn-secondary my-1">Cancelar</a>

              </div>
             <div class="col-lg-4 col-sm-4 col-12">
                <button type="submit" name="button" class="btn btn-success btn-block" id="guardar">Guardar</button>
               {{-- <button onclick="update_event()" type="button" class="btn-block btn btn-primary my-1">Guardar</button> --}}
             </div>
          </div>
          {!!Form::close()!!}
          </div>


        @include('medico.includes.alert_calendar')
        @include('medico.includes.card_edit')
          <hr>
          <div class="" id="example">
            {{-- //////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT//////////////ALERT --}}
					<div id="alert_success_1" class="alert alert-success alert-dismissible fade show text-left" role="alert" style="display:none">
					  <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
					  <p id="text_success_1" style="font-size:12px"></p>
						<a href="{{route('home')}}" class="btn btn-outline-primary">volver a inicio</a>

						<a class="btn btn-outline-success" href="">Tus Citas Pendientes</a>
					</div>
          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
          {{-- IF SHOW CALENDAR --}}


          <div id='calendar' style=""></div>


          {{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}

        {{-- IF SHOW CALENDAR --}}
            </div>



          </div>
        <div class="col-12 col-lg-3">

      </div>
    </div>
  </div>

{{-- <button onclick="filtrar()" type="button" name="button">Filtrar</button> --}}

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

<input type="hidden" name="" value="{{\Carbon\Carbon::parse($app->start)->format('m-d-Y')}}" id="date_edit">

@endisset


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
      date_edit = $('#date_edit').val();
      date_ini_format = moment(date_edit).format('YYYY-MM-DD');
      // alert(date_ini_format);
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
        defaultDate: date_ini_format,

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
      $('#alert_success_1').fadeOut();


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
      title = $('#title4').val();
      description = $('#description2').val();
      date_start = $('#date_start2').val();
      hourStart = $('#hourStart2').val();
      minsStart = $('#minsStart2').val();
      dateEnd = $('#date_end3').val();
      hourEnd = $('#hourEnd2').val();
      minsEnd = $('#minsEnd2').val();

      patient_id = "{{$patient->id}}";
			medico_id = "{{$medico->id}}";
      route = "{{route('appointment_store')}}";
      errormsj = '';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       data:{title:title,description:description,date_start:date_start,hourStart:hourStart,minsStart:minsStart,dateEnd:dateEnd,hourEnd:hourEnd,minsEnd:minsEnd,medico_id:medico_id,patient_id:patient_id},
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
				console.log(result);
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
					$('#text_success_1').html(result);
					$('#alert_success_1').fadeIn();
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

    // function cargando(){
    //   $( "#guardar" ).prop( "disabled", true );
    //   $( "#alert" ).fadeIn();
    //   confirm('si');
    // }

  </script>





  @endsection
