@extends('layouts.app')

@section('content')
  <section class="box-register">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8 col-12 box-mesage">
          <div class="container">

          <div class="row mt-3">
           <div class="col-lg-6 col-sm-6 col-12">
            <img src="" width="120px" height="80px" alt="" id="img">
          </div>
          <div class="col-lg-6 col-sm-6 col-12">
            <label for="">Barra de progreso</label>
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row my-4">
          <div class="col-12">
            <h4 class="font-title-blue text-center">Datos de la institución o Centro Médico</h4>
          </div>
        </div>

      <div class="row text-left">
        <div class="col-6">
          <ul>
            <li><strong>Nombre de la Institución:</strong> {{$medicalCenter->name}}</li>
            <li><strong>Nombre del Administrador:</strong> {{$medicalCenter->nameAdmin}}</li>
            <li><strong>Licencia Sanitaria:</strong> {{$medicalCenter->sanitary_license}}</li>
            <li><strong>Telefono de Oficina 1:</strong> {{$medicalCenter->phone}}</li>
          </ul>
        </div>
        <div class="col-6">
          <ul>
            <li><strong>Email de la institución:</strong> @isset($medicalCenter->email_institution)
              {{$medicalCenter->email_institution}}
            @else <span style="color:green">No especificado</span>@endisset</li>
              <li><strong>Teléfono del Administrador:</strong>{{$medicalCenter->phone_admin}}</li>
            <li><strong>Id del Centro Medico:</strong> {{$medicalCenter->id_medicalCenter}}</li>
            <li><strong>Telefono de Oficina 2:</strong> {{$medicalCenter->phone2}}</li>
          </ul>

          <a class="btn btn-success btn-block"href="{{route('medical_center_edit_data',$medicalCenter->id)}}">Editar</a>
        </div>
      </div>
      <hr>
      <div class="row my-4">
        <div class="col-12">
          <h4 class="font-title-blue text-center">Dirección</h4>
        </div>
      </div>

      <div class="row text-left">
        <div class="col-6">
          <ul>
            <li><strong>Pais:</strong> {{$medicalCenter->country}}</li>
            <li><strong>Estado:</strong> {{$medicalCenter->state}}</li>
            <li><strong>Ciudad:</strong> {{$medicalCenter->city}}</li>
            <li><strong>Codigo Postal:</strong> {{$medicalCenter->postal_code}}</li>
          </ul>
        </div>
        <div class="col-6">
          <ul>
            <li><strong>Colonia:</strong>
              {{$medicalCenter->colony}}
            </li>
              <li><strong>Calle/av:</strong>{{$medicalCenter->street}}</li>
            <li><strong>Numero Externo:</strong> {{$medicalCenter->number_ext}}</li>
            <li><strong>Numero Interno:</strong> {{$medicalCenter->number_int}}</li>
          </ul>

          <a class="btn btn-success btn-block"href="{{route('medical_center_edit_address',$medicalCenter->id)}}">Editar</a>
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
        <button id="store_coordinates"type="button" name="button" onclick="store_coordinates()" disabled>Guardar Ubicacion </button>
        <button type="button" name="button" onclick="show_map()">Restablecer Marcador</button>
        <input type="hidden" name="latitudSave" value="" id="latitudSave">
        <input type="hidden" name="longitudSave" value="" id="longitudSave">
      </div>
      </div>

      <hr>
      <div class="row my-4">
        <div class="col-12">
          <h4 class="font-title-blue text-center">Horario de atención</h4>
        </div>
      </div>
      <div class=" mt-3">
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
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($martes as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($miercoles as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($jueves as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($viernes as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($sabado as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

                    </li>

                      <hr>
                  </ul>
                @endforeach
              </td>
              <td>
                @foreach ($domingo as $day)
                  <ul>
                    <li>
                      {{$day->hour_ini}}
                              a
                      {{$day->hour_end}}

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
      </div>
        <div class="row">
          <div class="col-6">

          </div>
          <div class="col-6">
              <a class="btn btn-success btn-block"href="{{route('medical_center_edit_schedule',$medicalCenter->id)}}">Editar Horario</a>
          </div>
        </div>
      <hr>
      <div class="row my-3">
       <div class="col-12">
         <h4 class="font-title-blue text-center">Descripción</h4>
       </div>

     </div>
     <div class="row mb-3">
      <div class="col-lg-8 col-12 m-lg-auto ">

        <div id="div_descripion">

        </div>
      </div>
    </div>
    <hr>
    <div class="row my-3">
      <div class="col-12 mb-1">
       <h4 class="font-title-blue text-center">Especialidades</h4>
     </div>
   </div>
   <div class="row">
    <div class="col-lg-9 col-12 m-auto">
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
    <div class="col-12 text-right">
     <a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-success"><i class="fas fa-plus"></i>Agregar</a>
     <hr>
   </div>
  </div>
  <div class="row">
  <div class="col-12">
    <h4 class="font-title-blue text-center mb-3">Profesionales de la salud</h4>
  </div>
  </div>
  <div class="row">
  <div class=" m-auto">
    {{-- <form class="form-inline">
      <input class="form-control w-100 col-lg-10 col-12" type="search" placeholder="Search" aria-label="Buscar">
      <button class="btn btn-outline-primary my-2 my-sm-2 col-lg-2 col-12" type="submit">Buscar</button>
    </form> --}}
    <table class="table table-bordered">
      <thead>
          <th>Cedula</th>
          <th>Nombre Completo</th>
          <th>correo</th>
          <th>Especialidad</th>
      </thead>
      @foreach ($medicos as $medico)
        <tbody>
            <td>{{$medico->identification}}</td>
            <td>{{$medico->name}} {{$medico->lastName}}</td>
            <td>{{$medico->email}}</td>
            <td>{{$medico->specialty}}</td>
        </tbody>
      @endforeach

    </table>
  </div>
  </div>
  <div class="row my-3">
  <div class="col-12 text-right">
    <a href="{{route('medical_center_manage_medicos',$medicalCenter->id)}}" data-target="#modal-service2" class="btn btn-primary">Administrar</a>
   <a href="{{route('medical_center_manage_medicos',$medicalCenter->id)}}" data-target="#modal-service2" class="btn btn-success ">Agregar</a>
   <hr>
  </div>
  </div>
  <!-- <div id="medico_experience_ajax" style="text-align:justify">
  </div> -->
  <div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Experiencias en trastornos o enfermedades</h4>
   <hr>
  </div>
  </div>
  <div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Ingresa aqui el nombre del trastorno o enfermedad en la que tengas mas experiencia o por el que te busquen mas.">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Ingresa aqui el nombre del trastorno o enfermedad en la que tengas mas experiencia o por el que te busquen mas.">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Ingresa aqui el nombre del trastorno o enfermedad en la que tengas mas experiencia o por el que te busquen mas.">
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 text-center">
    <button class="btn btn-success">Guardar</button>
  </div>
  </div>
  <hr>
  <div class="row">
  <div class="col-12">
   <h4 id="imgs" class="font-title-blue text-center">Imagenes o videos</h4>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-6 col-md-6 col-12">
    <div class="form-group">
      <input type="file" name="img[]" class="file">
      <div class="input-group col-xs-12">
        <span class="btn btn-config-blue"><i class="fas fa-images"></i></span>
        <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
        <span class="input-group-btn">
          <button class="browse btn btn-config-blue input-lg" type="button"> Agrega una imagen</button>
        </span>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-12">
    <div class="form-group">
      <input type="file" name="img[]" class="file">
      <div class="input-group col-xs-12">
        <span class="btn btn-config-blue"><i class="fas fa-video"></i></span>
        <input type="text" class="form-control input-lg" disabled placeholder="Upload Video">
        <span class="input-group-btn">
          <button class="browse btn btn-config-blue input-lg" type="button"> Agrega un video</button>
        </span>
      </div>
    </div>
  </div>
  <!--   <div class="col-12">
   <div class="form-group">
     <div class="row" id="">


      <div class="col my-2">
        <img src="" width="auto" height="80px" alt="">
        <a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')">x</a>
      </div>
    </div>
    <hr>
  </div>
  </div> -->
  </div>
  <hr>
  <div class="row my-3">
  <div class="col-12">
   <h4 class="font-title-blue text-center">Mis redes sociales</h4>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-3 col-md-4 col-12">
    <div class="form-group">
      <select name="" class="form-control" id="">
        <option value="">Facebook</option>
        <option value="">Twitter</option>
        <option value="">Google+</option>
      </select>
    </div>
  </div>
  <div class="col-lg-7 col-md-4 col-12">
    <div class="form-group">
     <input type="text" class="form-control" placeholder="Agrega Url de tu red social">
   </div>
  </div>
  <div class="col-lg-2 col-md-4 col-12">
  <div class="form-group">
    <button onclick="storeSocial()" type="button" name="button" class="btn btn-block btn-success">Agregar</button>
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
  <div class="row">
  <div class="col-12 my-3">
   <label><b>Clasificación de servicios profesionales otorgados</b></label>
  </div>
  </div>
  <div class="row my-3">
  <div class="col-lg-9 col-12 m-auto">
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="show-question1" name="customRadioInline1">
      <label class="custom-control-label" for="show-question1">Solo pacientes privados</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="show-question2" name="customRadioInline1">
      <label class="custom-control-label" for="show-question2">Pacientes por aseguradoras, convenios y privados</label>
    </div>
    <div class="card border-primary p-3 mt-3" id="panel-insurance" style="display:none;">
      <a href="{{route('create_add_insurrances',$medicalCenter->id)}}" class="btn btn-success btn-block">Agregar Aseguradoras</a>
      <div class="row">

      </div>

   </div>
   <hr>
   <div class="text-center">
     {{-- <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-insurance"><i class="fas fa-plus mr-2"></i>Agregar otro seguro</a> --}}
   </div>
  </div>
  </div>
  </div>
  <div class="row">
  <div class="col-12 text-center">
    <button class="btn btn-success" type="buton">Guardar</button>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>


  <!-- Modal note medic -->
  <div class="modal fade bd-example-modal-lg" id="add-pad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-title text-center" id="exampleModalLabel">Configura las que utilices</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row align-self-center">
          <div class="col-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck2">
              <label class="custom-control-label" for="customCheck2">Altura</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck3">
              <label class="custom-control-label" for="customCheck3">Peso</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck4">
              <label class="custom-control-label" for="customCheck4">Teperatura</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck5">
              <label class="custom-control-label" for="customCheck5">Frecuencia cardiaca</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck6">
              <label class="custom-control-label" for="customCheck6">Frecuencia respiratoria</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck7">
              <label class="custom-control-label" for="customCheck7">Oxigenación</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck8">
              <label class="custom-control-label" for="customCheck8">Indice de masa corporal</label>
            </div>
          </div>
          <div class="col-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck9">
              <label class="custom-control-label" for="customCheck9">Perimetro cefalico</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck10">
              <label class="custom-control-label" for="customCheck10">Porcentaje de masa muscular</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck11">
              <label class="custom-control-label" for="customCheck11">Cintura</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck12">
              <label class="custom-control-label" for="customCheck12">Cadera</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck13">
              <label class="custom-control-label" for="customCheck13">Pierna</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck14">
              <label class="custom-control-label" for="customCheck14">Brazo</label>
            </div>
          </div>
          <hr>
        </div>
        <div class="row mt-3">
          <div class="col-8">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Escriba aquí si quiere agregar mas">
            </div>
          </div>
          <div class="col-4">
            <a href="" class="btn btn-primary"><i class="fas fa-plus"></i></a>
            <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-config-green" data-dismiss="modal">Atras</button>
        <button type="button" class="btn btn-config-blue">Agregar</button>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal test-laboratory-->
  <div class="modal fade bd-example-modal-lg" id="test-laboratory2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-title text-center" id="exampleModalLabel">Configura las que utilices</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row align-self-center">
          <div class="col-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck15">
              <label class="custom-control-label" for="customCheck15">Altura</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck16">
              <label class="custom-control-label" for="customCheck16">Peso</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck17">
              <label class="custom-control-label" for="customCheck17">Teperatura</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck18">
              <label class="custom-control-label" for="customCheck18">Frecuencia cardiaca</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck19">
              <label class="custom-control-label" for="customCheck19">Frecuencia respiratoria</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck20">
              <label class="custom-control-label" for="customCheck20">Oxigenación</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck21">
              <label class="custom-control-label" for="customCheck21">Indice de masa corporal</label>
            </div>
          </div>
          <div class="col-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck22">
              <label class="custom-control-label" for="customCheck22">Perimetro cefalico</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck23">
              <label class="custom-control-label" for="customCheck23">Porcentaje de masa muscular</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck24">
              <label class="custom-control-label" for="customCheck24">Cadera</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck25">
              <label class="custom-control-label" for="customCheck25">Pierna</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck26">
              <label class="custom-control-label" for="customCheck26">Brazo</label>
            </div>
          </div>
          <hr>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <a href="">Mis parametros de monitoreo</a>
          </div>
          <div class="col-lg-6 col-12">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nombre de mis parametros de laboratorio">
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <input type="text" class="form-control" placeholder="Abreviatura">
          </div>
          <div class="col-lg-3 col-6">
            <a href="" class="btn btn-primary"><i class="fas fa-plus"></i></a>
            <a href="" class="btn btn-danger"><i class="fas fa-ban"></i></a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-config-green" data-dismiss="modal">Atras</button>
        <button type="button" class="btn btn-config-blue">Agregar</button>
      </div>
    </div>
  </div>
  </div>


  {{-- //modal description --}}
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
         <h4>Descripción del Centro Médico</h4>
       </div>

       <div class="col-12 mt-3">

         {!!Form::text('description',null,['class'=>'form-control','id'=>'input_description'])!!}
         {{-- {!!Form::hidden('medicalCenter_id',$medicalCenter->id,['class'=>'form-control','id'=>'medicalCenter_id'])!!} --}}

       </div>

     </div>
     <div class="row mt-3">
      <div class="col-12">
        <div class="row">
          <div class="col-6">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
          </div>
          <div class="col-6">
            <button onclick="store_description()" name="button" class="btn btn-block btn-primary">Guardar</button>
          </div>
        </div>

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

    // function show_insurance(){
    //   $('#panel-insurance').show();
    // }


    $('document').ready(function(){
      show_description();
      show_map();

    });

    function show_map(){
      $('#store_coordinates').attr('disabled', true);
      lat = '{{$medicalCenter->latitud}}';
      lng = '{{$medicalCenter->longitud}}';
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
        var map = new GMaps({
          el: '#map',
          zoom: 5,

        });
        $('#store_coordinates').attr('disabled', false);

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
      route = '{{route('medicalCenter_store_coordinates',$medicalCenter->id)}}';
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


    function show_description(){
      route = '{{route('medicalCenter_description_show',$medicalCenter->id)}}';
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       type:'post',
       url:route,
       // data:{},
       error:function(error){

        console.log(error);
      },
      success:function(result){
        console.log(result);
        //$('#input_descripion').val(result);
        $('#div_descripion').html(result);
        decription = $('#description_text').html();
        $('#input_description').val(decription);
      }
    });

    }
  function store_description(){

    description = $('#input_description').val();
    //medicalCenter_id = 'xxssd';
    route = "{{route('medicalCenter_description_update',$medicalCenter->id)}}";
    errormsj = '';
    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type:'post',
     url:route,
     data:{description:description},
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
      show_description();
    }
  });

  }
  </script>
@endsection
