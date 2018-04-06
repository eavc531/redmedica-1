@extends('layouts.app')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('fullcalendar\tema_boostrap_descargado\tema_boostrap.css')}}">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css"> --}}
  {{-- <link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' /> --}}

@endsection
{{-- ///////////////////////////////////////////////////////CONTENIDO//////////////////// --}}

  @section('content')


{{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}
              <div id='calendar' style=""></div>
{{-- ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR  ////////////////////FULLCALENDAR --}}

<!-- ///////////////////////////Modal CREATE-Modal CREATE-Modal CREATE-Modal CREATE-Modal CREATE-->
<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align:justify">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary" style="color:white">
        <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'medico_diary.store','method'=>'POST'])!!}
        {!!Form::hidden('medico_id',$medico->id)!!}
        <div class="form-group">
          <label for="">Titulo</label>
          {!!Form::text('title',null,['class'=>'form-control','id'=>'title'])!!}
        </div>
        <div class="form-group">
          <label for="">Tipo de Evento</label>
          {!!Form::select('eventType',['Normal'=>'Normal','Importante'=>'Importante','Recordatorio'=>'Recordatorio'],null,['class'=>'form-control','id'=>'title'])!!}
        </div>
        <div class="form-group">
          <label for="">Fecha de inicio</label>
          {!!Form::date('date_start',null,['class'=>'form-control','id'=>'date_start'])!!}
        </div>
        <div class="form-group">
          <div class="form-inline">
          <label for="">Hora de Inicio</label>
            {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStart'])!!}
              {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStart'])!!}
            </div>
        </div>
        <div class="form-group">
          <label for="">Fecha de Culminación (Opcional)</label>
          {!!Form::date('date_End',null,['class'=>'form-control','id'=>'date_start'])!!}
        </div>
        <div class="form-group">
          <div class="form-inline">
          <label for="">Hora de Culminación (Opcional)</label>
            {!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'date_start'])!!}
              {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'date_start'])!!}
            </div>
        </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
        {!!Form::close()!!}
      </div>
    </div>
    </div>
  </div>


  <!-- /////////Modal EDITARRRR-Modal EDITARRRR-Modal EDITARRRR-///////////////////Modal EDITARRRR-->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align:justify">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white">Editar Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!!Form::open(['route'=>['medico_diary.update',$medico->id],'method'=>'PUT'])!!}
          {!!Form::hidden('medico_id',$medico->id)!!}
          {!!Form::hidden('event_id',null,['id'=>'event_id'])!!}
          <div class="form-group">
            <label for="">Titulo</label>
            {!!Form::text('title',null,['class'=>'form-control','id'=>'titleUp'])!!}
          </div>
          <div class="form-group">
            <label for="">Tipo de Evento</label>
            {!!Form::select('eventType',['Normal'=>'Normal','Importante'=>'Importante','Recordatorio'=>'Recordatorio'],null,['class'=>'form-control','id'=>'eventTypeUp'])!!}
          </div>
          <div class="form-group">
            <label for="">Fecha de inicio</label>
            {!!Form::date('date_start',null,['class'=>'form-control','id'=>'dateStartUp'])!!}
          </div>
          <div class="form-group">
            <div class="form-inline">
            <label for="">Hora de Inicio:</label>
              {!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStartUp'])!!}
                {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStartUp'])!!}
              </div>
          </div>
          <div class="form-group">
            <label for="">Fecha de Culminación (Opcional)</label>
            {!!Form::date('date_End',null,['class'=>'form-control','id'=>'dateEndUp'])!!}
          </div>
          <div class="form-group">
            <div class="form-inline">
            <label for="">Hora de Culminación (Opcional): </label>
              {!!Form::select('hourEnd',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp'])!!}
                {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEndUp'])!!}
              </div>
          </div>

          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>

          {!!Form::close()!!}
          {!!Form::open(['route'=>['medico_diary.destroy',$medico->id],'method'=>'DELETE'])!!}
          {!!Form::hidden('event_id',null,['id'=>'event_id_destroy'])!!}

            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estas Segur@ de querer Eliminar este Evento?')">Eliminar</button>
          {!!Form::close()!!}
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

          $('#calendar').fullCalendar({
            String, default: 'jquery-ui',
            customButtons: {
            myCustomButton: {
            text: 'Pantalla Completa',
            click: function() {
          window.location.href = '{{route("medico_diary",$medico->id)}}';
          }
        }
      },

        header: {
          left: 'prev,next today myCustomButton',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listWeek'
        },
        // defaultDate: '2018-03-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true, //permite seleccionar campos
        selectHelper: true, //permite agregar nuevos eventos

        select:function(start,end){
         start = moment(start);

         $('#hourStart').val(start.format('HH'));
         $('#minsStart').val(start.format('mm'));
         $('#date_start').val(start.format('YYYY-MM-DD'));
         $('#ModalCreate').modal('show');
        },

        events: "{{route('medico_diary_events',$medico->id)}}",

        eventClick: function(event, jsEvent, view){
            var start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
            var end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD');
            $('#ModalEdit').modal('show');
            $('#titleUp').val(event.title);
            $('#eventTypeUp').val(event.eventType);
            $('#dateStartUp').val(start);
            $('#hourStartUp').val(event.hourStart);
            $('#minsStartUp').val(event.minsStart);
            $('#dateEndUp').val(end);
            $('#hourEndUp').val(event.hourEnd);
            $('#minsEndUp').val(event.minsEnd);
            $('#event_id').val(event.id);
            $('#event_id_destroy').val(event.id);

        },
        // horario de trabajo
        businessHours:
  {
          start: '3:00',
          end: '6:00',
          dow: [ 1,2,3,4,5],

  }

      });

    });


  
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


  </script>
@endsection
