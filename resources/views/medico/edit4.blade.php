@extends('layouts.app')

@section('content')
2222222222222222222222222222
@if(Auth::check() and Auth::user()->role != 'medico')
<button onclick="volver()" type="button" name="button" class="btn btn-secondary">Volver</button>
@elseif(Auth::check() and Auth::user()->role == 'medico' and Auth::user()->medico_id != $medico->id)
<button onclick="volver()" type="button" name="button" class="btn btn-secondary">Volver</button>
@endif


<div class="row">
  <div class="col-12">
    <h2 class="font-title text-center" id="title">Perfil Profesional Médico</h2>
  </div>
</div>
@if(Session::Has('successComplete'))
<div class="div-alert" style="padding:20px; max-width: 100%;">
 <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="row mt-4">
   <div class="col-12 mb-3">
    {{-- <h5 class="text-center font-title">Ya eres miembro de la mejor red de médicos y profesionales de la salud</h5> --}}
  </div>
</div>
<h5>Registro Completado. Le invitamos a completar de forma (opcional),los datos de su perfil, para poder brindar la mayor información a sus clientes. </h5>
</div>
</div>
@endif

<div class="col-12">
  <h4 class="font-title-blue">Datos del Profesional: {{$medico->name}} {{$medico->lastName}}</h4>
</div>
{{-- <p>La información que se registra en su cuenta,le permite ser ubicado con mayor facilidad por sus clientes a travez del sistema, ademas le permite brindar, una mejor descripción de su profesión.</p> --}}
<section class="box-register">
  <div class="container">
   <div class="register">

    <div class="row mt-3">
     <div class="col-lg-6 col-12">

      @isset($photo->path)
      <div class="cont-img my-2">
        <img src="{{asset($photo->path)}}" class="prof-img" alt="" id="img">
      </div>
      @else
      <div class="cont-img my-2">
        <img src="{{asset('img/profile.png')}}" class="prof-img" alt="" id="img">
      </div>
      @endisset

      {!!Form::open(['route'=>'photo.store','method'=>'POST','files'=>true])!!}
      {!!Form::hidden('email',$medico->email)!!}
      {!!Form::hidden('medico_id',$medico->id)!!}
      {!!Form::file('image')!!}
      {!!Form::submit('Subir')!!}
      {!!Form::close()!!}
    </div>
    @if(Auth::check() and Auth::user()->role == 'medico' and Auth::user()->medico_id = $medico->id)
    <div class="col-lg-6">
      <h3>Calificación:</h3>
      <span class="">@include('home.star_rate')</span>
      <h3><span> de "{{$medico['votes']}}" voto(s).</span></h3>
      @if($medico->plan == 'plan_profesional' or $medico->plan == 'plan_platino')
      <div class="">
        <h4>
          <a href="{{route('calification_medic',$medico->id)}}" class="btn btn-primary mt-2">Opinion de los Usuarios</a>
        </h4>
        <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p>
      </div>
      @else
      <div class="">
        <h4>
          <a href="{{route('calification_medic',$medico->id)}}" class="btn btn-primary mt-2 disabled">Opinion de los Usuarios</a>
        </h4>
        <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p>
      </div>
      @endif
    </div>
    @else
    <div class="col-lg-6">
      <h3>Calificación:</h3>
      <span class="">@include('home.star_rate')</span>
      <h3><span> de "{{$medico['votes']}}" voto(s).</span></h3>
      <div class="">
        <h4>
          <button class="btn btn-success" type="button" name="button" onclick="calification_medic_show_patient()">Calificaciones y Comentarios</button>
        </h4>
      </div>
    </div>
    @endif

  </div>
  <hr>

  <div class="m-2">
    <div class="row my-2">
      <div class="col-12">
        <h4 class="font-title-blue text-center">Datos personales:</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <ul>
          <li><b>Nombres</b>:{{$medico->name}}</li>
          <li><b>Apellidos</b>:{{$medico->lastName}}</li>
          <li><b>Cedula</b>:{{$medico->identification}}</li>
          <li><b>Sexo</b>:{{$medico->gender}}</li>

        </ul>
      </div>
      <div class="col-6">
        <ul>
          <li><b>Especialidad:</b>{{$medico->specialty}}</li>
          @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          @if ($medico->showNumber == 'si')
          <li><b>Telefono celular</b>: {{$medico->phone}}</li>
          @endif
          @endif

          @if (Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          @if ($medico->showNumberOffice == 'si' and $medico->phoneOffice1 != Null)
          <li><b>Telefono de oficina 1:</b>{{$medico->phoneOffice1}}</li>
          @endif
          @if ($medico->showNumberOffice == 'si' and $medico->phoneOffice2 != Null)
          <li><b>Telefono de oficina 2:</b>{{$medico->phoneOffice2}}</li>
          @endif
          @endif

          <li><b>Mostrar Numero Personal:</b><span style="color:rgb(215, 141, 15)">{{$medico->showNumber}}</span></li>
          <li><b>Mostrar Numeros de officina:</b><span style="color:rgb(215,141,15)">{{$medico->showNumberOffice}}</span></li>
        </ul>
        <a href="{{route('data_primordial_medico',$medico->id)}}" class="btn btn-block btn-success">Editar</a>
      </div>
    </div>
  </div>
  <hr>
  <div class="row mt-3">
    <div class="col-12">
     <h4 class="font-title-blue text-center">Redes sociales</h4>

     <hr>
   </div>
 </div>
 @if(Auth::user()->medico->plan != 'plan_profesional' and Auth::user()->medico->plan != 'plan_platino')
 <div class="text-center">
  <p style="color:rgb(156, 141, 146)">Sección Disponible para los planes Profesional o Platino</p>
</div>
@endif
<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-12">
        <div class="form-group">
          @if(Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social'])!!}
          @else
          {!!Form::select('name',['Facebook'=>'Facebook','Twiter'=>'Twiter','Instagram'=>'Instagram'],null,['class'=>'form-control','placeholder'=>'Red Social','id'=>'name_social','disabled'])!!}
          @endif
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="form-group">
          @if(Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
          @else
          {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Dirección Url del perfil de su Red Social','id'=>'link_social','disabled'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
          @endif

        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="form-group">
          @if(Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
          <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button>
          @else
          <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success" disabled>Agregar</button>
          @endif

        </div>
      </div>
      {{-- alert error  --}}
      <div class="col-12">
        <div id="alert_error_s" class="alert alert-warning  alert-dismissible fade show" role="alert" style="display:none">
          <button type="button" name="button" class="close" onclick="cerrar_alert()">x</button>
          <p id="text_error_s"></p>
        </div>
      </div>
      {{-- {!! $errors->first('name','<span class="help-block">:message</span>') !!} --}}
    </div>
    {{-- BOTONES QUE SE MUESTRAN CON AJAX DESDE LISTA-Social --}}
    @if(Auth::user()->medico->plan == 'plan_profesional' or Auth::user()->medico->plan == 'plan_platino')
    <div id="list_social_ajax">
    </div>
    @endif
  </div>
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
   <input type="text" name="" value="" class="form-control" id="address">
   <button onclick="searchInMap()" type="button" class="btn btn-primary" name="button">Buscar</button>
 </div>

</div>
<div class="mt-3">
  {{-- //div que muestra el mapa --}}
  <div class="m-1" id="map" style="height:300px;width:auto">

  </div>
  <button id="store_coordinates" type="button" name="button" class="btn btn-primary" onclick="store_coordinates()" disabled>Guardar Ubicacion</button>
  <button type="button" name="button"  class="btn btn-secondary" onclick="show_map()">Restablecer Marcador</button>
  <input type="hidden" name="latitudSave" value="" id="latitudSave">
  <input type="hidden" name="longitudSave" value="" id="longitudSave">
</div>
</div>
<hr>
<div class="row">
  <div class="col-12">
    <h4 class="font-title-blue text-center" id="consul">Consultorios</h4>

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
          {{-- @isset($consulting_room->passwordUnique)
            <td>{{$consulting_room->passwordUnique}}</td>
            @else
            <td style="color:rgb(173, 173, 173)">N.P.</td>
            @endisset --}}
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
   <button onclick="modal_service2()" class="btn btn-success">Agregar servicio</button>
   <hr>
 </div>
</div>
<div class="roww">
  <div class="col-12">
    <h4 class="font-title-blue text-center mb-3">Experiencia en transtornos o enfermedades</h4>
  </div>
</div>
<div id="medico_experience_ajax" style="text-align:justify">

</div>
<div class="row my-3">
  <div class="col-lg-12 col-12 text-right">
    <div class="form-group">
      <button onclick="modal_experience()" type="button" href="" class="btn btn-success">Agregar Experiencia</button>
    </div>
  </div>
</div>

<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Imagenes</h4>
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
        <img id="myImg" src="{{asset($image->path)}}" width="auto" height="80px" alt="">
        <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')"href="{{route('photo_delete',$image->id)}}">x</a>
      </div>
      <!-- The Modal -->
      <div id="myModal" class="modal">
        <span class="cerrar">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>
      @endforeach
    </div>
    <hr>
    {!!Form::open(['route'=>'image_store','method'=>'POST','files'=>true])!!}
    {!!Form::file('image')!!}
    {!!Form::hidden('medico_id',$medico->id)!!}
    {!!Form::hidden('email',$medico->email)!!}
    {!!Form::submit('Subir imagen',['class'=>'btn btn-success'])!!}
    {!!Form::close()!!}
  </div>
</div>
</div>
{{-- //videos --}}
<hr>
<div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Videos</h4>
 </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-3 col-12">
        {!!Form::open(['route'=>'video_store','method'=>'POST','id'=>'form_video'])!!}
        <div class="form-group">
          {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del video','id'=>'name_video'])!!}
        </div>
      </div>
      <div class="col-lg-7 col-12">
        <div class="form-group">
          {!!Form::text('link',null,['class'=>'form-control','placeholder'=>'Ingrese la Url del video de youtube ejemplo: https://www.youtube.com/watch?v=Xwm5xoGo','id'=>'link_social'])!!}
          {!!Form::hidden('medico_id',$medico->id,['id'=>'medico_id'])!!}
        </div>
      </div>
      <div class="col-lg-2 col-12">
        <div class="form-group">
          {{-- <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button> --}}
          <button type="submit" name="button" class="btn btn-block btn-success">Agregar</button>
        </div>
      </div>
      {!!Form::close()!!}
      {{-- alert error  --}}

    </div>
  </div>
</div>
<div id="alert_error_video" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
  <button type="button" name="button" class="close" onclick="cerrar()">x</button>
  <p id="text_error_video"></p>
</div>
<div class="row mt-5" id="list_videos">

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

<div class="row my-3">
  <div class="col-lg-9 col-12 m-auto">
    <div class="custom-control custom-radio">
      {{-- {{Form::radio('type_patient_service','Solo pacientes privados',['class'=>'custom-control-input','id'=>'radio'])}} --}}

      @if($medico->type_patient_service == "Solo pacientes privados")
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="solo medicos privados" checked="checked" id="radio" onclick="hide_aseguradoras()">
      @else
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Solo pacientes privados" id="radio" onclick="hide_aseguradoras()">
      @endif
      <label class="" for="show-question1" id="radio"  >Solo pacientes privados</label>
    </div>
    <div class="custom-control custom-radio">

      @if($medico->type_patient_service == "Pacientes por aseguradoras, convenios y privados")

      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" checked="checked" id="radio2" onclick="show_aseguradoras()">
      @else
      <input style="margin-top: 6px;margin-right: 6px;" type="radio" name="type_patient_service" value="Pacientes por aseguradoras, convenios y privados" id="radio2" onclick="show_aseguradoras()">
      @endif
      <label class="" for="show-question1" id="radioxxx"  >Pacientes por aseguradoras, convenios y privados</label>
      <label class="" for="show-question2"></label>
    </div>
    <div class= "p-3 mt-3" id="panel-insurance" style="display:none;">
      <a href="{{route('create_add_insurrances',$medico->id)}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
    </div>
    <div class="aseguradoras" id="aseguradoras" style="display:none">
      <div class="card">
        <div class="card-body">
          <div class="row">
            @foreach ($insurance_carrier as $key => $value)
            <div class="col-6">
              <li>{{$value->name}}</li>
            </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6 mt-2">
              <a href="{{route('medico_create_add_insurrances',$medico->id)}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<div class="row my-2">
  <div class="col-12 text-center">
    <a href="#title" class="btn btn-primary">Ir a Inicio de Pagina</a>

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


       {!!Form::text('name',null,['class'=>'form-control','id'=>'input_service'])!!}
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


<!-- Modal calification-->
<div class="modal fade" id="modal-calification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="" id="content_calification">

        </div>
        <div class="card-footer">
          <button class="btn btn-secondary" type="button" name="button" onclick="cerrar_calificaciones()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scriptJS')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>
<script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>
<script type="text/javascript">

// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cerrar")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

  function cerrar_calificaciones(){
    $('#modal-calification').modal('hide');
  }

  function calification_medic_show_patient(){

   route = "{{route('calification_medic_show_patient')}}";
   medico_id = $('#medico_id').val();

   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medico_id:medico_id},
     success:function(result){
       $('#modal-calification').modal('show');
       $('#content_calification').empty().html(result);
       console.log(result);

     },
     error:function(error){
       console.log(error);
     },
   });
 }
  // calification_medic_show_patient();

  function paginate_calification(result){
   page = result;
   page1 = $('#page_calificatione_exp').val();
   route = "{{route('calification_medic_show_patient')}}";
   medico_id = $('#medico_id').val();
   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medico_id:medico_id,page:page,page1:page1},
     success:function(result){
       if(result == 'limite'){
         return false;
       }
       $('#content_calification').empty().html(result);
         // $('#div_calification').empty().html(result);
         console.log(result);

       },
       error:function(error){
         console.log(error);
       },
     });

 }
 function paginate_experience(result){
   page = result;
   page1 = $('#page_exp').val();
   route = "{{route('medico_experience_list')}}";
   medico_id = $('#medico_id').val();
   $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url: route,
     data:{medico_id:medico_id,page:page,page1:page1},
     success:function(result){
       if(result == 'limite'){
         return false;
       }
       $('#medico_experience_ajax').empty().html(result);
       // $('#div_calification').empty().html(result);
       console.log(result);
       $('.bd-example-modal-lg').modal('show');
     },
     error:function(error){
       console.log(error);
     },
   });

 }

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


 function volver(){
  window.history.back();
}

function delete_video(request){
  question = confirm('¿Esta segur@ de Eliminar este video?')
  if(question == false){
    return false;
  }
  video_id = request;
  route = "{{route('delete_video')}}";
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url:route,
   data:{video_id:video_id},
   error:function(error){
     console.log(error);
   },
   success:function(result){
    cerrar();
    list_videos();
  }
});
}

$('#form_video').submit(function(){
  errormsj = '';
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url: $(this).attr('action'),
   data: $(this).serialize(),
   error:function(error){
     cerrar();
     console.log(error);
     $.each(error.responseJSON.errors, function(index, val){
       errormsj+='<li>'+val+'</li>';
     });
     $('#text_error_video').html('<ul>'+errormsj+'</ul>');
     $('#alert_error_video').fadeIn();
     console.log(errormsj);
   },
   success:function(result){
    cerrar();
    console.log(result);
    if(result == 'invalida'){
      $('#text_error_video').html('La Url es invalida, o esta mal escrita, solo puede ingresar urls de videos de youtube,para realizar esta opcion, busque en la pagina de youtube el video que desea insertar, etando en la ventana de reproduccion del mismo, seleccione la url de youtube en ese momento: ejemplo: https://www.youtube.com/watch?v=YxC9UB49x04');
      $('#alert_error_video').fadeIn();
    }else if(result == 'limite'){
      $('#text_error_video').html('imposible realizar acción,Haz agregado el numero maximo de videos admitidos.');
      $('#alert_error_video').fadeIn();

    }else if(result == 'ok'){
      cerrar();
      list_videos();
      $("#form_video")[0].reset();
    }


  }

});
  return false;
});

$(document).ready(function() {
  list_social();
  list_service();
  list_experience();
  list_videos();
  comprueba_checkbox();
});

function hide_aseguradoras(){
  type_patient_service = $('#radio').val();
  medico_id = "{{$medico->id}}"
  route = "{{route('select_insurrances2')}}"
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url:route,
   data:{type_patient_service:type_patient_service,medico_id:medico_id},
   error:function(error){
   },
   success:function(result){
    console.log(result);
  }
});
  $('#aseguradoras').hide();
}

function show_aseguradoras(){
  type_patient_service = $('#radio2').val();
  medico_id = "{{$medico->id}}"
  route = "{{route('select_insurrances2')}}"
  $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url:route,
   data:{type_patient_service:type_patient_service,medico_id:medico_id},
   error:function(error){
   },
   success:function(result){
    console.log(result);
  }
});
  $('#aseguradoras').show();
}

function comprueba_checkbox(){
  if($("#radio2").is(':checked')) {
    $('#aseguradoras').show();
  }
}


function modal_service2(){
  $('#modal-service2').modal('toggle');
  $('#modal-service2').on('shown.bs.modal', function() {
    $('#input_service').val('');
    $('#input_service').focus();
  });
}

function modal_experience(){
  $('#modal-experience').modal('toggle');
  $('#modal-experience').on('shown.bs.modal', function() {
    $('#name_experience').val('');
    $('#name_experience').focus();
  });
}


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

function list_videos(){
 route = "{{route('medico_list_videos')}}";
 medico_id = $('#medico_id').val();
 $.ajax({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   type:'post',
   url: route,
   data:{medico_id:medico_id},
   success:function(result){
     $('#list_videos').empty().html(result);
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
  name = $('#input_service').val();
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
  $('#alert_error_video').fadeOut();

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
function cerrar_alert(){
  $('#alert_error_s').hide();
}

</script>

@endsection
