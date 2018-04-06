inverse-background

de esta forma puedo crear horario ////
[
{
  title  : 'event1',
  start  : '10:00',
  end  : '11:00',
  color: 'orange',
  rendering: 'background',
  dow: [ 1, 2, 3 ],
},

]
////////////////////////////////////////

[
{
  title  : 'event1',
  start  : '10:00',
  end  : '11:00',
  color: 'orange',
  rendering: 'background',
  dow: [ 1, 2, 3 ],
},
{
  title  : 'event2',
  start  : '2018-03-19',
  end    : '2010-01-07'
},
{
  title  : 'event3',
  start  : '2010-01-09T12:30:00',
  allDay : false // will make the time show
}
],


@extends('layouts.app')

@section('content')

@if(Session::Has('confirmMedico'))
<div class="div-alert" style="padding:20px">
 <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="row mt-4">
   <div class="col-12 mb-3">
    <h5 class="text-center font-title">Ya eres miembro de la mejor red de médicos y profesionales de la salud</h5>
  </div>
</div>
<p>Le invitamos a ingresar los siguientes datos, para poder brindar la mayor información posible a sus clientes.</p>
</div>
</div>
@endif

<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">
     <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-config-blue">3</button>
      </div>
    </div>
  </div>
  <div class="row mt-3">
   <div class="col-lg-6 col-12">
    @isset($photo)
    <img src="{{asset($photo->path)}}" width="120px" height="80px" alt="" id="img">
    @endisset

    {!!Form::open(['route'=>'photo.store','method'=>'POST','files'=>true])!!}
    {!!Form::hidden('email',$medico->email)!!}
    {!!Form::hidden('medico_id',$medico->id)!!}
    {!!Form::file('image')!!}
    {!!Form::submit('Subir')!!}
    {!!Form::close()!!}
  </div>
  <div class="col-lg-6 col-12">
    <label for="">Barra de progreso</label>
    <div class="progress">
      <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>
</div>
<hr>
{!!Form::model($medico,['route'=>['medico.update',$medico],'method'=>'PUT','id'=>'person'])!!}

<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="">Nombres</label>
      {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre','id'=>'nameMedic'])!!}
    </div>
  </div>
  <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="">Apellidos</label>
      {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido','id'=>'lastNameMedic'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <div class="form-group">
      <label for="">Sexo</label>
      {!!Form::select('gender',['Masculino','Femenino'],null,['class'=>'form-control','id'=>'genderMedic'])!!}
    </div>
  </div>
  <div class="col-6">
    <label for="">Ciudad</label>
    <div class="form-group">
      {!!Form::select('city',$cities,null,['class'=>'form-control','id'=>'cityMedic'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
     <label for="">Estado</label>
     {!!Form::select('state',$cities,null,['class'=>'form-control','id'=>'stateMedic'])!!}
   </div>
 </div>
 <div class="col-lg-6 col-12">
  <div class="form-group">
   <label for="">Teléfono celular</label>
   {!!Form::number('phone',null,['class'=>'form-control','id'=>'phoneMedic'])!!}
 </div>
</div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
     <label for="">Teléfono de Oficina 1</label>
     {!!Form::number('phoneOffice1',null,['class'=>'form-control','id'=>'phoneOffice1Medic'])!!}
   </div>
 </div>
 <div class="col-lg-6 col-12">
  <div class="form-group">
    <label for="">Teléfono de Oficina 2</label>
    {!!Form::number('phoneOffice2',null,['class'=>'form-control','id'=>'phoneOffice2Medic'])!!}
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="">Cedula</label>
      {!!Form::text('identification',null,['class'=>'form-control','id'=>'identificationMedic'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-8">
          <p for="">¿Desea que su numero celular aparezca visible en formatos e información a pacientes?</p>
        </div>
        <div class="col-4">
         {{Form::select('showNumber',['si'=>'Si','no'=>'No'],null,['class'=>'form-control'])}}
       </div>
     </div>
   </div>
 </div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <button type="submit" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
    <button onclick="updateMedic()" type="button" name="button">test</button>
  </div>
</div>
{!!Form::close()!!}
</div>
<hr>
<div class="row">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Consultorios</h4>
    <hr>
  </div>
</div>
<div class="row">
  <div class="col-12 scroll-table">
    <table class="table table-config">
      <thead class="thead-color">
        <th>Nombre Comercial</th>
        <th>Tipo</th>
        <th>Numero Ext.</th>
        <th>Numero Int.</th>
        <th>Ciudad</th>
        <th>Estado</th>
        <th>Clave Unica</th>
        <th>Dirección</th>
      </thead>
      <tbody>
        @foreach ($consulting_rooms as $consulting_room)
        <tr>
          @isset($consulting_room->tradeName)
          <td>{{$consulting_room->tradeName}}</td>
          @else
          <td style="color:rgb(173, 173, 173)">N.P.</td>
          @endisset
          <td>{{$consulting_room->type}}</td>

          @isset($consulting_room->numberExt)
          <td>{{$consulting_room->numberExt}}</td>
          @else
          <td style="color:rgb(173, 173, 173)">N.P.</td>
          @endisset

          @isset($consulting_room->numberInt)
          <td>{{$consulting_room->numberInt}}</td>
          @else
          <td style="color:rgb(173, 173, 173)">N.P.</td>
          @endisset

          <td>{{$consulting_room->city}}</td>
          <td>{{$consulting_room->state}}</td>
          @isset($consulting_room->passwordUnique)
          <td>{{$consulting_room->passwordUnique}}</td>
          @else
          <td style="color:rgb(173, 173, 173)">N.P.</td>
          @endisset
          <td>{{$consulting_room->addres}}</td>
        </tr>
      </tbody>
      @endforeach
      <tfoot>
        <td colspan="12">{{$info_medico->links()}}</td>
      </tfoot>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-12 col-lg-12 text-right">
   <a href="{{route('consulting_room_create',$medico->id)}}" class="btn btn-success">Agregar Consultorio</a>
 </div>
</div>
@if($consultingIsset == 0)

@endif
<hr>
<div class="row mt-3">
 <div class="col-12">
   <h4 class="font-title-blue text-center">Especialidad/Estudios Realizados</h4>
   <hr>
 </div>
</div>
<div class="row">
 <div class="col-12 scroll-table">
   <table class="table table-config">
     <thead class="thead-color">
       <th>Tipo</th>
       <th>Especialidad</th>
       <th>Institución</th>
       <th>Desde</th>
       <th>Hasta</th>
       <th>Estado</th>
       <th>información Adicional</th>
     </thead>
     <tbody>
       @foreach ($info_medico as $info)
       <tr>
         <td>{{$info->type}}</td>
         <td>{{$info->specialty}}</td>
         <td>{{$info->institution}}</td>
         <td>{{\Carbon\Carbon::parse($info->from)->format('m-d-Y')}}</td>
         <td>{{\Carbon\Carbon::parse($info->until)->format('m-d-Y')}}</td>
         <td>{{$info->state}}</td>
         @isset($info->aditional)
         <td>{{$info->aditional}}</td>
         @else
         <td style="color:rgb(173, 173, 173)">N.P.</td>
         @endisset

       </tr>
       @endforeach
     </tbody>
     <tfoot>
       <td colspan="12">{{$info_medico->links()}}</td>
     </tfoot>
   </table>
 </div>
</div>

<div class="row">
 <div class="col-12 text-right">
   <a href="{{route('info_medicoCreate',$medico->id)}}" class="btn btn-success">Agregar Especialidad/Estudios Realizados</a>
 </div>
</div>
<hr>
<div class="row">
  <div class="col-12 mb-1">
   <h4 class="font-title-blue text-center">Servicios otorgados</h4>
 </div>
</div>
<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Cras justo odio
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Dapibus ac facilisis in
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Morbi leo risus
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
    </ul>
  </div>
</div>
<!-- <div id="list_service_ajax" style="text-align:justify">
</div> -->
<div class="row my-3">
  <div class="col-12 text-right">
   <a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-success">Agregar servicio</a>
   <hr>
 </div>
</div>
<div class="roww">
  <div class="col-12">
    <h4 class="font-title-blue text-center mb-3">Experiencia en transtornos mentales</h4>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 col-12 m-auto">
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Cras justo odio
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Dapibus ac facilisis in
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Morbi leo risus
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
    </ul>
  </div>
</div>
<div class="row my-3">
  <div class="col-lg-12 col-12 text-right">
    <div class="form-group">
      <a href="" data-toggle="modal" data-target="#modal-experience" class="btn btn-success">Agregar Experiencia</a>
    </div>
  </div>
</div>
<!-- <div id="medico_experience_ajax" style="text-align:justify">

</div> -->
<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Agrega videos y fotos</h4>
   <hr>
 </div>
</div>
<div class="row">
  <div class="col-12">
   <div class="form-group">
     @include('medico.alert2.alert2')
     <div class="row" id="">
      @foreach ($images as $image)
      {{-- div que encierra cada imagen --}}
      <div class="col my-2">
        <img src="{{asset($image->path)}}" width="auto" height="80px" alt="">
        <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')"href="{{route('photo_delete',$image->id)}}">x</a>
      </div>
      @endforeach
    </div>
    <hr>
    {!!Form::open(['route'=>'image_store','method'=>'POST','files'=>true])!!}
    {!!Form::file('image')!!}
    {!!Form::hidden('medico_id',$medico->id)!!}
    {!!Form::hidden('email',$medico->email)!!}
    {!!Form::submit('Subir Imagen',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
</div>
</div>
<hr>
<div class="row mt-3">
  <div class="col-12">
   <h4 class="font-title-blue text-center">Mis redes sociales</h4>
   <hr>
 </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-12">
        <div class="form-group">
          {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social'])!!}
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="form-group">
          {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="form-group">
          <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button>

        </div>
      </div>

      {{-- alert error  --}}
      <div id="alert_error_s" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
        <p id="text_error_s"></p>
      </div>

      {{-- {!! $errors->first('name','<span class="help-block">:message</span>') !!} --}}
    </div>

    {{-- BOTONES QUE SE MUESTRAN CON AJAX DESDE LISTA-Social --}}
    <div id="list_social_ajax">

    </div>

  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-12">
    <div class="list-group" id="list-tab" role="tablist">
      <a href="btn" class="btn btn-primary my-2" id="facebook"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
      <a href="btn" class="btn btn-light my-2" id="instagram"><i class="fab fa-instagram mr-2"></i>Instagram</a>
      <a href="btn" class="btn btn-danger my-2" id="google"><i class="fab fa-google-plus-g mr-2"></i>Google+</a>
    </div>
  </div>
</div>
<hr>
<div class="row mt-3">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Aseguradoras</h4>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-12 my-3">
   <label><b>Clasificación de servicios profesionales otorgados</b></label>
 </div>
</div>
<div class="row mb-3" >
  <div class="col-12">
    <div class="col-lg-8 col-12 m-auto">
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="show-question4" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="show-question4">Solo pacientes privados</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="show-question5" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="show-question5">Pacientes por aseguradoras, convenios y privados</label>
      </div>
      <div class="card border-primary p-3 mt-3" id="panel-insurance" style="display: none;">
        <div class="row">
          <div class="col-6">
           <div class="custom-control custom-radio">
            <input type="radio" id="customRadio11" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio11">AXA</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio12" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio12">Met Life</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio13" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio13">Seguros monterrey</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2">Gnp Grupo Provincial</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio14" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio14">Mapfre Seguros Tepeyac</label>
          </div>
        </div>
        <div class="col-6">
          <div class="custom-control custom-radio">
           <input type="radio" id="customRadio16" name="customRadio" class="custom-control-input">
           <label class="custom-control-label" for="customRadio16">ING</label>
         </div>
         <div class="custom-control custom-radio">
           <input type="radio" id="customRadio17" name="customRadio" class="custom-control-input">
           <label class="custom-control-label" for="customRadio17">Seguros Atlas</label>
         </div>
         <div class="custom-control custom-radio">
           <input type="radio" id="customRadio18" name="customRadio" class="custom-control-input">
           <label class="custom-control-label" for="customRadio18">Alianz</label>
         </div>
         <div class="custom-control custom-radio">
           <input type="radio" id="customRadio19" name="customRadio" class="custom-control-input">
           <label class="custom-control-label" for="customRadio19">Zurich</label>
         </div>
       </div>
     </div>
     <hr>
     <div class="text-center">
       <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-insurance"><i class="fas fa-plus mr-2"></i>Agregar otro seguro</a>
     </div>
   </div>
 </div>
</div>
</div>
<div class="row my-2">
  <div class="col-12 text-center">
    <button class="btn btn-success" type="buton">Guardar</button>
  </div>
</div>



</section>

{{-- //////////////////Modals///////////////////////////////////////MODALS//////////////// --}}


<!-- Modal insurance-->
<div class="modal fade" id="modal-insurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header col-12">
        <h4 class="modal-title font-title text-center" id="exampleModalLabel">Agregar una aseguradora</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal add experience-->
<div class="modal fade" id="modal-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_experience" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_experience"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agrega el nombre del trastorno o enfermedad, en la que tengas mas experiencia.</h4>
     </div>

     <div class="col-12 mt-3">


      {!!Form::text('name',null,['class'=>'form-control','id'=>'name_experience'])!!}
      {!!Form::hidden('medico_id',$medico->id,['class'=>'form-control','id'=>'medico_id'])!!}

    </div>

  </div>
  <div class="row mt-3">
    <div class="col-12">

      <button onclick="service_medico_experience()" name="button" class="btn btn-block btn-primary">Agregar</button>
    </div>
  </div>
</div>
</div>
</div>
</div>

<!-- Modal add service-->
<div class="modal fade" id="modal-service2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     {{-- alert error  --}}
     <div id="alert_error_service" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin:10px">
      <p id="text_error_service"></p>
    </div>

    <div class="modal-body">
     <div class="row">

      <div class="col-12 text-center">
       <h4>Agregar Servicio o Terapia que atiendas</h4>
     </div>

     <div class="col-12 mt-3">


       {!!Form::text('name',null,['class'=>'form-control','id'=>'name_service'])!!}
       {!!Form::hidden('medico_id',$medico->id,['class'=>'form-control','id'=>'medico_id'])!!}

     </div>

   </div>
   <div class="row mt-3">
    <div class="col-12">

     <button onclick="service_medico_store()" name="button" class="btn btn-block btn-primary">Agregar</button>
   </div>
 </div>
</div>
</div>
</div>
</div>


@endsection

@section('scriptJS')
<script type="text/javascript">

	$(document).ready(function() {
		list_social();
		list_service();
		list_experience();
  });

  function list_experience(){
   route = "{{route('medico_experience_list')}}";
   medico_id = $('#medico_id').val();

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medico_id:medico_id},
     success:function(result){
       $('#medico_experience_ajax').empty().html(result);
       console.log(result);
       list_experience();
     },
     error:function(error){
       console.log(error);
     },
   });
 }

 function list_social(){
  route = "{{route('social_network_list')}}";

  medico_id = $('#medico_id').val();

  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'post',
    url: route,
    data:{medico_id:medico_id},
    success:function(result){
      $('#list_social_ajax').empty().html(result);
      console.log(result);

    },
    error:function(error){
      console.log(error);
    },
  });
}

function list_service(){
  route = "{{route('medico_service_list')}}";

  medico_id = $('#medico_id').val();

  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'post',
    url: route,
    data:{medico_id:medico_id},
    success:function(result){
      $('#list_service_ajax').empty().html(result);
      console.log(result);

    },
    error:function(error){
      console.log(error);
    },
  });
}

function storeSocial(){
  medico_id = $('#medico_id').val();
  name = $('#name_social').val();
  link = $('#link_social').val();
  route = "{{route('medico_social_network_store')}}";
  errormsj = '';

  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type:'post',
    url:route,
    data:{name:name,link:link,medico_id:medico_id},
    error:function(error){
     $.each(error.responseJSON.errors, function(index, val){
       errormsj+='<li>'+val+'</li>';
     });
     $('#text_error_s').html('<ul>'+errormsj+'</ul>');
     $('#alert_error_s').fadeIn();
     console.log(errormsj);
   },
   success:function(result){
     console.log(result);
     $('#alert_error_s').fadeOut();
     name = $('#name_social').val('');
     link = $('#link_social').val('');
     list_social();
   }
 });
}


function medico_experience_delete(service_id){
  id = service_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar este Servicio?');
  if(question == false){
   exit();
 }
 route = "{{route('medico_experience_delete')}}";
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'post',
  url:route,
  data:{medico_id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   console.log(errormsj);
 },
 success:function(result){
   console.log(result);
   list_experience();
 },
});
}

function medico_service_delete(service_id){
  id = service_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar este Servicio?');
  if(question == false){
   exit();
 }
 route = "{{route('medicoBorrar')}}";
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'post',
  url:route,
  data:{medico_id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   $('#text_error_s').html('<ul>'+errormsj+'</ul>');
   $('#alert_error_s').fadeIn();
   console.log(errormsj);
 },
 success:function(result){
   console.log(result);
   list_service();
 },
});
}

function social_network_delete(social_id){
  id = social_id;
  errormsj = '';
  question = confirm('¿Esta seguro de Borrar esta Red Social?');
  if(question == false){
   exit();
 }
 route = "{{route('borrar_social')}}";
 $.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  method:'post',
  url:route,
  data:{id:id},
  error:function(error){
   $.each(error.responseJSON.errors, function(index, val){
     errormsj+='<li>'+val+'</li>';
   });
   $('#text_error_s').html('<ul>'+errormsj+'</ul>');
   $('#alert_error_s').fadeIn();
   console.log(errormsj);
 },
 success:function(result){
   console.log(result);
   list_social();

 },
});

}

function service_medico_store(){
	name = $('#name_service').val();
	medico_id = $('#medico_id').val();
	route = "{{route('service_medico_store')}}";
	errormsj = '';
	$.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url:route,
   data:{name:name,medico_id:medico_id},
   error:function(error){
    $.each(error.responseJSON.errors, function(index, val){
      errormsj+='<li>'+val+'</li>';
    });
    $('#text_error_service').html('<ul>'+errormsj+'</ul>');
    $('#alert_error_service').fadeIn();
    console.log(errormsj);
  },
  success:function(result){
    console.log(result);
    $('#modal-service2').modal('toggle');
    list_service();
  }
});

}

function service_medico_experience(){
	name = $('#name_experience').val();
	medico_id = $('#medico_id').val();
	route = "{{route('medico_experience_store')}}";
	errormsj = '';
	$.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url:route,
   data:{name:name,medico_id:medico_id},
   error:function(error){
    $.each(error.responseJSON.errors, function(index, val){
      errormsj+='<li>'+val+'</li>';
    });
    $('#text_error_experience').html('<ul>'+errormsj+'</ul>');
    $('#alert_error_experience').fadeIn();
    console.log(errormsj);
  },
  success:function(result){
    console.log(result);
    $('#modal-experience').modal('toggle');
    list_service();
  }
});

}

function updateMedic(){
	nameMedic =  $('#nameMedic').val();
	lastNameMedic = $('#lastNameMedic').val();
	genderMedic = $('#genderMedic').val();
	cityMedic = $('#cityMedic').val();
	stateMedic = $('#stateMedic').val();
	phoneMedic = $('#phoneMedic').val();
	phoneOffice1Medic = $('#phoneOffice1Medic').val();
	phoneOffice2Medic = $('#phoneOffice2Medic').val();
	identificationMedic = $('#identificationMedic').val();

	errormsj = '';

	route = "{{route('medico.update',$medico->id)}}";

	$.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   method:'put',
   url:route,
   data:{name:nameMedic,lastName:lastNameMedic,gender:genderMedic,city:cityMedic,state:stateMedic,phone:phoneMedic,phoneOffice1:phoneOffice1Medic,phoneOffice2:phoneOffice2Medic,identification:identificationMedic},
   error:function(error){
    $.each(error.responseJSON.errors, function(index, val){
      errormsj+='<li>'+val+'</li>';
    });
    $('#text_error_service').html('<ul>'+errormsj+'</ul>');
    $('#alert_error_service').fadeIn();
    console.log(errormsj);
  },
  success:function(result){
    console.log(result);

    list_service();
  }
});

}

</script>


@endsection



////////////////////////////////////////
