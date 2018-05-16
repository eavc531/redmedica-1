<div class="card p-2" id="card_edit" style="display:none">
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
        <label for="" class="font-title">Paciente</label>

        {{Form::text('namePatient',null,['id'=>'namePatient','class'=>'form-control','disabled'])}}
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="form-group">
          <label for="" class="font-title">Tipo de Cita</label>
          {!!Form::select('title',['Ambulatoria'=>'Ambulatoria','Externa o a Domicilio'=>'Externa o a Domicilio','Urgencias'=>'Urgencias','Cita por Internet'=>'Cita por Internet'],null,['class'=>'form-control','id'=>'titleUp1','placeholder'=>'Tipo de Cita'])!!}
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
    <div class="col-lg-4">
      <div class="form-group text-center">
        <label for="" class="font-title">Fecha de Culminación</label>
        {!!Form::date('date_End',null,['class'=>'form-control','id'=>'dateEndUp1'])!!}
      </div>
    </div>
    <div class="col-lg-4 col-12 col-sm-5 m-sm-auto">
      <div class="form-group text-center">
        <label for="" class="font-title" class="mx-3">Hora de Culminación</label>
        <div class="row">
          <div class="col-lg-6 my-1">{!!Form::select('hourEnd',['--'=>'--','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourEndUp1'])!!}</div>
          <div class="col-lg-6 my-1"> {!!Form::select('minsEnd',['--'=>'--','00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsEndUp1'])!!}</div>
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
      <button onclick="delete_event()" type="button" class="btn-block btn btn-danger my-1">Eliminar</button>
    </div>
    <div class="col-lg-4 col-sm-4 col-12">
      <button onclick="close_edit()" type="button" class="btn-block btn btn-secondary my-1">Cancelar</button>
      {!!Form::close()!!}
    </div>
   <div class="col-lg-4 col-sm-4 col-12">
     <button onclick="update_event()" type="button" class="btn-block btn btn-primary my-1">Guardar</button>
   </div>
</div>
{!!Form::close()!!}
</div>
