@extends('layouts.app')

@section('css')
  <style media="screen">
  .widthDiv{
    width: 400px;
    height: 400px;
  }
  </style>

@endsection
@section('content')

  @if(!isset(Auth::user()->id))
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <h5 class="font-title-index">¿Ya eres un profesional registrado?</h5>
      </div>
      <div class="col-lg-6 col-md-6 col-12 pull-right">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12 p-1">
            <a href="" data-toggle="modal" data-target="#modal-register"><img class="box-shadox" src="{{asset('img/botones-medicossi-18.png')}}"></a>
          </div>
          <div class="col-lg-6 col-md-6 col-12 p-1">
            <a href="" data-toggle="modal" data-target="#modal-login"><img class="box-shadox" src="{{asset('img/botones-medicossi-20.png')}}"></a>
          </div>
        </div>
      </div>
    </div>
  @endif
  <div class="row box-index mt-4">
    <div class="col-12">
      <div id="flip">
        <div class="col-lg-12">
          {{Form::model(Request::all(),['route'=>'tolist2','method'=>'get'])}}
          <div class="input-group search">
            <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x" data-toggle="tooltip" data-placement="top" title="Busqueda Avanzada"></i></span>
            {{Form::select('typeSearch',['Centro Medico'=>'Nombre del Centro Médico','Especialidad Medica'=>'Especialidad Médica','Nombre/Cedula del Medico'=>'Nombre/Cedula del Medico',],null,['placeholder'=>'Buscar Por:','id'=>'typeSearch'])}}
            {{Form::text('search',null,['class'=>'form-control','placeholder'=>'Ingresar termino de Busqueda','id'=>'search'])}}
            <input type="hidden" name="lat" value="" id="lat" id="lat">
            <input type="hidden" name="lng" value="" id="lng" id="lng">
            {{-- {{Form::hidden('city',null,['id'=>'city'])}}
            {{Form::hidden('state',null,['id'=>'state'])}} --}}
            <button type="submit" class="ml-2 white"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
          </div>

        </div>
      </div>
      <div id="panel">
        <div class="box-filter">



          <span class="text-left">Filtrar por:</span>
          <div class="row">
            <div class="col-4">
              <div class="col-12 mt-3">
                <div class="form-group">
                  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                    <input type="checkbox" class="custom-control-input">
                  </label>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="col-12 mt-3">
                <div class="form-group">
                  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Por cercania a mi</span>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="col-12 mt-3">

                  <ul class="nav nav-tabs" id="myTab" role="tablist">

                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ciudad</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Distancia</a>
                      </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                        {!!Form::select('state',$states,null,['class'=>'form-control','id'=>'stateMedic','placeholder'=>'estado'])!!}
                        </div>
                        <div class="form-group">
                          {!!Form::select('city',$cities,null,['class'=>'form-control','id'=>'cityMedic','placeholder'=>'ciudad'])!!}
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="form-group mt-3">
                          {{Form::select('dist',[50=>'50 Km',100=>'100 Km',200=>'200 Km',400=>'400 Km',800=>'800 Km',1000=>'1000 Km',2000=>'2000 Km',10000=>'10000 Km'],null,['class'=>'form-control','id'=>'dist','placeholder'=>'sellecione una opcion'])}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- //////////////////tableSearch MEDICOS////////tableSearch MEDICOS////////////////// --}}
      <div class="text-justify mt-3">

        {{-- BUSQUEDA DISTANCIA uLT --}}   {{-- BUSQUEDA DISTANCIA uLT --}}
        @if(isset($medicosCercCount) and $medicosCercCount != 0)
          <input type="hidden" name="" value="{{$medicosCercCount}}" id="medicosCercCount">
          <div class="card">
            <div class="card-header">
              <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
              <input type="hidden" name="" value="{{$distRequest = request()->get('dist')}}">
              <input type="hidden" name="" value="{{$typeSearch = request()->get('typeSearch')}}">
              <input type="hidden" name="" value="{{$requestCity = request()->get('city')}}">
              <input type="hidden" name="" value="{{$requestState = request()->get('state')}}">



              <h4>Busqueda de Medico: {{$search}}</h4>
              <h5>Filtros:</h5>

              @isset($typeSearch)
                <p>Tipo de Busqueda: {{$typeSearch}}</p>
              @endisset
              @isset($search)
                <p>Nombre: {{$search}}</p>
              @endisset
              @isset($distRequest)
                <p>Diametro: {{request()->get('dist')}} Km</p>
              @endisset
              @isset($requestCity)
                <p>Ciudad: {{request()->get('city')}}</p>
              @endisset
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="bg-primary text-white">
                  <tr>
                    <td>Nombre Completo</td>
                    <td>ciudad</td>
                    <td>estado</td>
                    @isset($distRequest)
                      <td>Distancia</td>
                    @endisset

                    <td>consultorio</td>
                    <td>Especialidad</td>
                    <td>Acciones</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($medicosCerc as $medico)
                    <tr>
                      <td>
                        {{$medico['name']}} {{$medico['lastName']}}
                      </td>
                      <td>
                        {{$medico['cityName']}}
                      </td>
                      <td>
                        {{$medico['stateName']}}
                      </td>
                      @isset($distRequest)
                        <td>
                          {{$medico['dist']}}
                        </td>
                      @endisset
                      <td>
                        <ul>
                        @foreach($medico['consulting_room'] as $room)
                            <li>{{$room['type']}}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>
                      <ul>
                        <li>{{$medico['specialty']}}</li>
                        <li>{{$medico['sub_specialty']}}</li>
                      </ul>

                    </td>
                      <td>
                        <a href="{{route("medico_perfil",$medico['id'])}}" class="btn btn-primary">Ver Perfil</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              {{$medicosCerc->appends(Request::all())->links()}}
            </div>
          </div>
        @elseif(isset($medicosCercCount))
          <div class="card">
            <div class="card-body">
              <h5>No se Encontraron Resultados para la Busqueda</h5>
              <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
            </div>
          </div>
        @endif

        {{-- FIN FIN BUSQUEDA DISTANCIA uLT --}}   {{-- FIN FIN BUSQUEDA DISTANCIA uLT --}}

        {{-- //PANTALLA ESPECIALIDADES POR CATEGORIA//PANTALLA ESPECIALIDADES POR CATEGORIA --}}


        @if(isset($specialtiesCount) and $specialtiesCount != 0)
          <div class="card">
            <div class="card-header">
              Especialidades de la Categoria: {{$category}}
            </div>
            <div class="card-body">
              @foreach ($specialties as $specialty)
                <div class="float-left p-3">
                  {{Form::open(['route'=>'tolist2','method'=>'get'])}}
                  {{Form::hidden('search',$specialty->name)}}

                  {{Form::hidden('typeSearch2','Especialidad Medica')}}
                  <button type="submit" class="btn-link"><strong>{{$specialty->name}}</strong></button>
                  {{Form::close()}}
                </div>
              @endforeach
            </div>

          </div>
        @endif

        {{-- //FIN PANTALLA ESPECIALIDADES POR CATEGORIA --}}
        <div id="map">

        </div>

            {{-- //map-fin  //map-fin  //map-fin  //map-fin  //map-fin --}}
            <div class="row my-5">
              <div class="col-6 col-lg-3">
                <div class="box-img">

                  {{Form::model(Request::only(['typeSearch','search']),['route'=>'tolist','method'=>'get'])}}
                  {{Form::hidden('typeSearch','Centro Medico')}}
                  <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-01.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                  {{Form::close()}}

                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">

                {{Form::open(['route'=>'specialtyList1','method'=>'post'])}}
                  {{Form::hidden('typeSearch','Medicos y Especialistas')}}
                  <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-05.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                  {{Form::close()}}

                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  {{Form::open(['route'=>'specialtyList2','method'=>'post'])}}
                  {{Form::hidden('typeSearch','Dentistas')}}
                  <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-03.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                  {{Form::close()}}

                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  {{Form::open(['route'=>'specialtyList3','method'=>'post'])}}
                  {{Form::hidden('typeSearch','Terapeutas y Nutricion')}}
                  <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-11.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                  {{Form::close()}}


                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  {{Form::open(['route'=>'specialtyList4','method'=>'post'])}}
                  {{Form::hidden('typeSearch','Medicina Alternativa')}}
                  <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-11.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                  {{Form::close()}}


                </div>
              </div>
            </div>


          </div>
          {{-- // --}}
        </div>

        <div class="row m-3">

        </div>
        <!-- Modal Login-->
        <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="alert alert-warning" role="alert" id="alert" style="display:none;margin:10px; ">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div id="text-alert">

                </div>
              </div>
              <div class="alert alert-success" role="alert" id="alert-success-confirm" style="display:none;margin:10px; ">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div >

                  <h5>Bienvenid@</h5>
                  <p id="text-success-confirm"></p>


                </div>
              </div>
              <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Ingresar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <img width="100%" height="100%" src="{{asset('img/Medicossi-Marca original-01.png')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <a href="#" class="btn btn-config-blue btn-block" style="background-color: #4267b2;">Conectarse con facebook</a>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-12">
                    <div class="form-group">
                      <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" placeholder="email" name="email">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <input type="password" class="form-control" id="passwordLogin" aria-describedby="emailHelp" placeholder="password" name="password">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Recordar contraseña</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button class="btn btn-config-blue btn-block" onclick="login()">Iniciar sesión</button>
                  </div>
                  <div class="col-12">
                    <a href="#" class=" btn btn-config-green btn-block mt-2">Olvido su contraseña</a>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>

        <!-- Modal register -->
        <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="card-body">
                  <h5 class="btn btn-success mt-1 registro-text" style="white-space: normal; color: #fff; text-transform: none;">¿Es usted un profesional de la salud o nucleo de diagnóstico?</h5>
                  <div class="d-flex justify-content-between">
                    <a href="{{route('medico.create')}}" class="btn-block btn btn-primary mt-3 registro-text" style="width:47%; white-space: normal; color: #fff;"><i class="fa fa-user-md"></i> Médico
                    </a>
                    <a href="{{route('medicalCenter.create')}}" class="btn-block btn btn-primary mt-3 registro-text" style="width:47%; white-space: normal; color: #fff;"><i class="fa fa-user"></i> Centro medico
                    </a>
                  </div>
                  <p align="center" class="mt-3" style="font-weight: 600;">Ahora sus pacientes podrán encontrarte mas fácil</p>
                  <p align="center" style="font-weight: 500;">Con nuestra plataforma web:</p>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Sus pacientes podrán agendar una cita o servicio médico, según especialidades, horarios y médicos disponibles</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Tus pacientes obtendran toda la información como núcleo de diagnóstico y/o hospital así como perfiles completos de los especialistas que colaboran en ese centro</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Encontrarán la ubicación de tu núcleo de diagnóstico o centro médico a través de geolocalización</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Podrán tener tus colaboradores sus expedientes clínicos organizados de manera cronológica, completos e inter consultas por si necesitaran compartir</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Podrán tener cada colaborador su asistente, si lo prefieren una asistente podrá administrar las agendas de varios especialistas, con opción a configurar los accesos de información para cada uno de ellos</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked"></i>
                    <p>Alertas de recordatorio de las citas confirmadas de sus profesionales en la salud, así como recordatorio a sus pacientes</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Todas tu información en el momento que quieras 24/7, reporte de estadísticas, consultas hechas por cada profesional, de manera opcional cada profesional</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Podrán si así lo prefieren respaldar y migrar la información en el momento que lo decidan mediante nuestro módulo de respaldos</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Tendrán la oportunidad de ser recomendados y así obtener mas pacientes mediante nuestro módulo califica a tu profesional</p>
                  </div>
                  <div class="d-flex justify-content-start reg-p">
                    <i class="fa fa-check-square mt-1 mr-2 modal-checked" ></i>
                    <p>Soporte telefónico y en linea</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @isset($currentPage)
            <input type="hidden" name="" value="{{$currentPage}}" id="numberPageNow">
        @endisset
        @isset($specialtiesCount)
          <input type="hidden" name="" value="{{$specialtiesCount}}" id="specialtiesCount">
        @endisset

        <input type="hidden" name="" value="{{$typeSearch2 = request()->get('typeSearch2')}}" id="typeSearch2">






        @include('home.modals')


        @section('scriptJS')
          @if(Session::Has('confirmMedico'))


            <script type="text/javascript">
            $(document).ready(function(){
              $('#modal-login').modal('show');

              $('#text-success-confirm').html('Su Cuenta ha sido Confirmada con exito, ya es posible iniciar sesión con sus Credenciales');
              $('#alert-success-confirm').fadeIn();
            });
          </script>
        @endif

        {{-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY&callback=initMap"></script> --}}
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyBAwMPmNsRoHB8CG4NLVIa_WRig9EupxNY"></script>

        <script type="text/javascript" src="{{asset('gmaps/gmaps.js')}}"></script>

        <script type="text/javascript">


        typeSearch2 =$('#typeSearch2').val();

        if(typeof typeSearch2 !== "undefined"){
          $('#typeSearch').val('Especialidad Medica');
        }
         specialtiesCount = $('#specialtiesCount').val();
        if(typeof specialtiesCount !== "undefined"){
          $('#typeSearch').val('Especialidad Medica');
        }
          medicosCercCount = $('#medicosCercCount').val();
          if(typeof medicosCercCount !== "undefined"){
            $("#map").addClass("widthDiv");
            map();
          }

          function geolocation(){
              if (!navigator.geolocation){
                alert('La Geolocalozación no es compatible con en este navegador');
                return;
              }

              function success(position) {
                latitude = position.coords.latitude;
                $('#lat').val(latitude);
                longitude = position.coords.longitude;
                $('#lng').val(longitude);
              };

              function error() {
                alert("Error, hubo un problema al recuperar su ubicación, por favor recargue la pagina e intente nuevamente");
              };
              navigator.geolocation.getCurrentPosition(success, error);
        }

        $('.radioDist').click(function(){
            geolocation();
        });

        function login(){
          route = "{{route('login2')}}";
          email = $('#emailLogin').val();
          password = $('#passwordLogin').val();
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url: route,
            data:{email:email,password:password},
            success:function(result){
              if(result == 'true'){
                location.reload();
                window.location.href = '{{route("loginRedirect")}}';
              }else{
                $('#text-alert').html('Email o Contraseña Invalida');
                $('#alert').fadeIn();
              }
            },
            error:function(result){
              errores ='';
              $.each(result.responseJSON.errors, function( index, value ) {
                errores += '<li>'+value+'</li>';
              });
              console.log(errores);
              $('#text-alert').html(errores);
              $('#alert').fadeIn();
              // $error += '<li>result.message</li>';
              //  console.log(result.message);
            }
          });
        }

        //UBICA LOS PUNTOS EN EL MAPA  //UBICA LOS PUNTOS EN EL MAPA
        function map(){
          medicosCercCount = $('#medicosCercCount').val();

          if(medicosCercCount = 0){
            return;
          }

          search = $('#search').val();
          typeSearch = $('#typeSearch').val();
          lat = $('#lat').val();
          lng = $('#lng').val();
          city = $('#city').val();
          state = $('#state').val();
          dist = $('#dist').val();
          numberPageNow = $('#numberPageNow').val();
          route = "{{route('tolist3')}}";


          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'get',
            url: route,
            data:{search:search,typeSearch:typeSearch,lat:lat,lng:lng,city:city,state:state,dist:dist,numberPageNow:numberPageNow},
            success:function(result){
                var lat = 32.6245389;
                //$('#lat').val();
                var lng = -115.4522623;
                //$('#lng').val();

                var map = new GMaps({
                  el: '#map',
                  lat: lat,
                  lng: lng,
                });

                map.addMarker({
                  lat: lat,
                  lng: lng,
                  title: 'Tu',
                  icon: "{{asset('img/marker-icon.png')}}",
                  click: function(e) {
                    alert(value.name);
                  }
              });//fin marker



              $.each(result, function(index,value){
                map.addMarker({
                  lat: value.lat,
                  lng: value.lng,
                  title: value.name,
                  click: function(e) {
                    alert(value.name);
                  }
              });//fin marker
                console.log(value.lng);
              });
            },//fin success

            error:function(error){
              console.log(error);
            },
          });
        }


        $('#stateMedic').on('change', function() {
    			state_id = $('#stateMedic').val();

    			route = "{{route('inner_cities_select2')}}";

    			$.ajax({
    				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    				type:'post',
    				url: route,
    				data:{state_id:state_id},
    				success:function(result){
    				$("#cityMedic").empty();
            $('#cityMedic').append($('<option>', {
               value: null,
               text: 'ciudad'
           }));
						 $.each(result,function(key, val){
							 $('#cityMedic').append($('<option>', {
                  value: val,
                  text: val
              }));
						 });
    				},
    				error:function(error){
    					console.log(error);
    				},
    			});
    	   })

      </script>

    @endsection

  @endsection
