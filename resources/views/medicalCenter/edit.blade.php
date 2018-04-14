@extends('layouts.app')

@section('content')
  <section class="section-dashboard">
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
                {{-- @foreach ($lunes as $day)
                  {{$day->hour_ini}}
                          a
                  {{$day->hour_end}}
                @endforeach --}}
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
        <input type="text" class="form-control" placeholder="Detalle de breve descripción del centro medico y/o hospital">
      </div>
    </div>
    <hr>
    <div class="row my-3">
      <div class="col-12 mb-1">
       <h4 class="font-title-blue text-center">Especialides</h4>
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
  <div class="col-lg-9 col-12 m-auto">
    <form class="form-inline">
      <input class="form-control w-100 col-lg-10 col-12" type="search" placeholder="Search" aria-label="Buscar">
      <button class="btn btn-outline-primary my-2 my-sm-2 col-lg-2 col-12" type="submit">Buscar</button>
    </form>
    <ul class="list-group mt-3">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Agregar medico nuevo a la red afiliado a este centro
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Agregar medico nuevo a la red afiliado a este centro
        <button class="btn badge badge-danger"><i class="fas fa-ban fa-2x"></i></button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Agregar medico nuevo a la red afiliado a este centro
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
      <input type="radio" id="show-question1" name="customRadioInline1" class="custom-control-input">
      <label class="custom-control-label" for="show-question1">Solo pacientes privados</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="show-question2" name="customRadioInline1" class="custom-control-input">
      <label class="custom-control-label" for="show-question2">Pacientes por aseguradoras, convenios y privados</label>
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


@endsection
