@extends('layouts.app')

@section('content')
	<h3>Datos del Profesional: {{$medico->name}} {{$medico->lastName}}</h3>

@if(Session::Has('successComplete'))
<div class="div-alert" style="padding:20px">
 <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="row mt-4">
   <div class="col-12 mb-3">
    {{-- <h5 class="text-center font-title">Ya eres miembro de la mejor red de médicos y profesionales de la salud</h5> --}}
  </div>
</div>
<h5>Le invitamos a ingresar los siguientes datos(Opcional), para poder brindar la mayor información posible a sus clientes. </h5>
</div>
</div>
@endif
<p>La información que se registra en su cuenta,le permite ser ubicado con mayor facilidad por sus clientes a travez del sistema, ademas le permite brindar, una mejor descripción de su profesión.</p>

<section class="box-register">
  <div class="container">
   <div class="register">
    <div class="row">

     {{-- <div class="col-12 text-right">
      <div class="btn-group " role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">1</button>
        <button type="button" class="btn btn-secondary">2</button>
        <button type="button" class="btn btn-config-blue">3</button>
      </div>
    </div> --}}

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
    <label for="">Estado</label>
    <div class="form-group">
      {!!Form::select('state_id',$states,null,['class'=>'form-control','id'=>'stateMedic'])!!}
    </div>
  </div>
	<div class="col-6">
		<div class="form-group">
			<label for="">Sexo</label>
			{!!Form::select('gender',['Masculino','Femenino'],null,['class'=>'form-control','id'=>'genderMedic'])!!}
		</div>
	</div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
     <label for="">Ciudad</label>
     {!!Form::select('city_id',$cities,null,['class'=>'form-control','id'=>'cityMedic'])!!}
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
	<div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="">Especialidad</label>
      {!!Form::select('specialty',$specialties,null,['placeholder'=>'seleccione una Especialidad','class'=>'form-control','id'=>'specialtyMedic'])!!}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
      <label for="">sub-Especialidad(Opcional)</label>
      {!!Form::select('sub_specialty',$specialties,null,['placeholder'=>'seleccione una opción','class'=>'form-control','id'=>'sub_specialtyMedic'])!!}
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
    {{-- <button type="submit" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
    <button onclick="updateMedic()" type="button" name="button">test</button> --}}
  </div>
</div>
{{--/////////////////////// ALERTS --}}
<div id="alert_error_update" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
		<button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
	<p id="text_error_medic"></p>
</div>

<div id="alert_success_update" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none">
 <button type="button" class="close" onclick="cerrar()"><span >&times;</span></button>
 <p id="text_success_service"></p>
</div>

		 <div class="row">
			 <div class="col-6">
				 <button onclick="updateMedic()" type="button" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
			 </div>
			 {!!Form::close()!!}
	 </div>
<hr>

<div class="row my-4">
	<div class="col-12">
		<h4 class="font-title-blue text-center">Dirección de Trabajo Principal</h4>
	</div>
</div>
<div class="row text-left">
	<div class="col-6">
		<ul>
			<li><strong>Pais:</strong> {{$medico->country}}</li>
			<li><strong>Estado:</strong> {{$medico->state}}</li>
			<li><strong>Ciudad:</strong> {{$medico->city}}</li>
			<li><strong>Codigo Postal:</strong> {{$medico->postal_code}}</li>
		</ul>
	</div>
	<div class="col-6">
		<ul>
			<li><strong>Colonia:</strong>
				{{$medico->colony}}
			</li>
				<li><strong>Calle/av:</strong>{{$medico->street}}</li>
			<li><strong>Numero Externo:</strong> {{$medico->number_ext}}</li>
			<li><strong>Numero Interno:</strong> {{$medico->number_int}}</li>
		</ul>

		<a class="btn btn-success btn-block"href="{{route('medico_edit_address',$medico->id)}}">Editar</a>
	</div>
</div>
<hr>
{{-- section mapa --}}



<div class="row my-4">
	<div class="col-12">
		<h4 class="font-title-blue text-center">Ubicacion en el mapa</h4>
	</div>
	<p class="text-justify">La Ubicación exacta permite que el usuario pueda ubicar su Centro Medico, o institución con mayor facilidad, a travez de las busquedas de filtros, en el menu principal</p>

	<p class="text-justify">Cuando añade los datos de Dirección, automaticamente el sistema ubicara esta direccion en el mapa sin embargo, muchas veces no suele ser preciso, debido a que la dirección registrada,no concuerda con la base de datos de google maps, esto se puede corregir manualmente.</p>

	<p><strong>Ubicar dirección Manualmente.</strong></p>

	<p class="text-justify">acceda al mapa a continuacion, realize la busqueda rellenado el campo 'direccion/ciudad/pais' y/o arrastre el marcador al punto de la dirección deseada, luego presione el boton "Guardar Ubicacion"</p>
</div>
<div class="m-2">
	<div class="form-inline">
			<input type="text" name="" value="" id="address">
			<button onclick="searchInMap()" type="button" name="button">Buscar</button>
	</div>

</div>
<div class="mt-3">
	{{-- //div que muestra el mapa --}}
	<div class="m-1" id="map" style="height:300px;width:auto">

	</div>
	<button id="store_coordinates"type="button" name="button" onclick="store_coordinates()" disabled>Guardar Ubicacion</button>
	<button type="button" name="button" onclick="show_map()">Restablecer Marcador</button>
	<input type="hidden" name="latitudSave" value="" id="latitudSave">
	<input type="hidden" name="longitudSave" value="" id="longitudSave">
</div>
</div>
<hr>
<div class="row">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Consultorios</h4>

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
          @isset($consulting_room->name)
          <td>{{$consulting_room->name}}</td>
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
        <td colspan="12">{{$medico_specialty->links()}}</td>
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
       @foreach ($medico_specialty as $info)
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
       <td colspan="12">{{$medico_specialty->links()}}</td>
     </tfoot>
   </table>
 </div>
</div>

<div class="row">
 <div class="col-12 text-right">
   <a href="{{route('medico_specialty_create',$medico->id)}}" class="btn btn-success">Agregar Especialidad/Estudios Realizados</a>
 </div>
</div>
<hr>
<div class="row">
  <div class="col-12 mb-1">
   <h4 class="font-title-blue text-center">Servicios otorgados</h4>
 </div>
</div>

<div id="list_service_ajax" style="text-align:justify">
</div>

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
<div id="medico_experience_ajax" style="text-align:justify">

</div>
<div class="row my-3">
  <div class="col-lg-12 col-12 text-right">
    <div class="form-group">
      <a href="" data-toggle="modal" data-target="#modal-experience" class="btn btn-success">Agregar Experiencia</a>
    </div>
  </div>
</div>

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

<hr>
<div class="row mt-3">
  <div class="col-12">
    <h4 class="font-title-blue text-center">Aseguradoras(no funciona)</h4>
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
        {{-- <input type="radio" id="show-question4" name="customRadioInline1" class="custom-control-input"> --}}
				{{Form::radio('aseguradora1')}}
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
					</div>
						<div class="col-6">

					<div class="custom-control custom-radio">
            <input type="radio" id="customRadio12" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio12">Met Life</label>
          </div>

				</div>
				<div class="col-6">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio13" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="customRadio13">Seguros monterrey</label>
					</div>


		   </div>
			 <div class="col-6">
				 <div class="custom-control custom-radio">
					 <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
					 <label class="custom-control-label" for="customRadio2">Gnp Grupo Provincial</label>
				 </div>
			</div>
				<div class="col-6">
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
				</div>
				<div class="col-6">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio17" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="customRadio17">Seguros Atlas</label>
					</div>
				</div>
				<div class="col-6">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio18" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="customRadio18">Alianz</label>
					</div>
				</div>
				<div class="col-6">
					<div class="custom-control custom-radio">
						<input type="radio" id="customRadio19" name="customRadio" class="custom-control-input">
						<label class="custom-control-label" for="customRadio19">Zurich</label>
					</div>
				</div>
				@foreach ($insurance_carriers as $insurance_carrier)
					<div class="col-6">
						<div class="custom-control custom-radio">
							{{Form::radio($insurance_carrier)}}<label for="">{{$insurance_carrier}}</label>
							<label class="custom-control-label" for="customRadio19">Zurich</label>
						</div>
					</div>

				@endforeach
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
		<a href="{{route('medico_diary',$medico->id)}}" class="btn btn-primary">Ir a Panel de Control</a>

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
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>

  <script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>
<script type="text/javascript">

	$(document).ready(function() {
		list_social();
		list_service();
		list_experience();
  });

		$('#stateMedic').on('change', function() {
			state_id = $('#stateMedic').val();

			route = "{{route('inner_cities_select')}}";
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'post',
				url: route,
				data:{state_id:state_id},
				success:function(result){
				$("#cityMedic").empty();
						$('#cityMedic').append($('<option>', {
							 value: null,
							 text: 'Ciudad'
					 }));
							 $.each(result,function(key, val){
								 $('#cityMedic').append($('<option>', {
                    value: key,
                    text: val
                }));
							 });
				},
				error:function(error){
					console.log(error);
				},
			});
	   })

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
    list_experience();
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
	specialtyMedic = $('#specialtyMedic').val();
	sub_specialtyMedic = $('#sub_specialtyMedic').val();
	errormsj = '';

	route = "{{route('medico.update',$medico->id)}}";

	$.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		 method:'put',
		 url:route,
		 data:{name:nameMedic,lastName:lastNameMedic,gender:genderMedic,city_id:cityMedic,state_id:stateMedic,phone:phoneMedic,phoneOffice1:phoneOffice1Medic,phoneOffice2:phoneOffice2Medic,identification:identificationMedic,specialty:specialtyMedic,sub_specialty:sub_specialtyMedic},
		 error:function(error){
			 $.each(error.responseJSON.errors, function(index, val){
			 errormsj+='<li>'+val+'</li>';
			 });
			 $('#alert_success_update').fadeOut();
			 $('#text_error_medic').html('<ul>'+errormsj+'</ul>');
			 $('#alert_error_update').fadeIn();
			 console.log(errormsj);
			 },
		 success:function(result){
				console.log(result);
				$('#alert_error_update').fadeOut();
				$('#text_success_service').html('Cambios Guardados con Exito');
				$('#alert_success_update').fadeIn();

		 }
	});

}

function cerrar(){
	$('#alert_error_update').fadeOut();
	$('#alert_success_update').fadeOut();
}


//mapa
$('document').ready(function(){
	show_map();

});

function show_map(){
	$('#store_coordinates').attr('disabled', false);
	lat = '{{$medico->latitud}}';
	lng = '{{$medico->longitud}}';
	var map = new GMaps({
		el: '#map',
		lat: lat,
		lng: lng,
		zoom: 5,
	});
	map.addMarker({
		lat: lat,
		lng: lng,
		title: 'Tu Ubicacion',
		icon: "{{asset('img/marker-icon.png')}}",
		draggable: true,
			 dragend: function(event) {
				 var lat = event.latLng.lat();
				 var lng = event.latLng.lng();
				 $('#latitudSave').val(lat);
				 $('#longitudSave').val(lng);
				  $('#store_coordinates').attr('disabled', false);

			 },

});//fin marker
}

	function searchInMap(){
		$('#store_coordinates').attr('disabled', false);
		var map = new GMaps({
			el: '#map',
			zoom: 5,

		});

		GMaps.geocode({
		address: $('#address').val(),
		callback: function(results, status) {
			if (status == 'OK') {
				var latlng = results[0].geometry.location;
				var lat = latlng.lat();
				var lng = latlng.lng();
				$('#latitudSave').val(lat);
				$('#longitudSave').val(lng);
				map.  setCenter(latlng.lat(), latlng.lng());
				map.addMarker({
					lat: latlng.lat(),
					lng: latlng.lng(),

					title: 'Tu Ubicacion',
					icon: "{{asset('img/marker-icon.png')}}",
					draggable: true,
						 dragend: function(event) {
								 var lat = event.latLng.lat();
								 var lng = event.latLng.lng();
								 $('#latitudSave').val(lat);
								 $('#longitudSave').val(lng);
								  $('#store_coordinates').attr('disabled', false);
						 },

						 // infoWindow: {
						 //     content: content
						 // }
			});//fin marker
			}
		}
	});
}//fin searchInMap

function store_coordinates(){
	route = '{{route('medico_store_coordinates',$medico->id)}}';
	latitud = $('#latitudSave').val();
	longitud = $('#longitudSave').val();

		$.ajax({
			 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			 type:'post',
			 url:route,
			 data:{latitud:latitud,longitud:longitud},
			 error:function(error){
				console.log(error);
			},
			success:function(result){

				console.log(result);
				// //$('#input_descripion').val(result);
				// $('#div_descripion').html(result);
				// decription = $('#description_text').html();
				// $('#input_description').val(decription);
			}
		});
}
</script>

@endsection
