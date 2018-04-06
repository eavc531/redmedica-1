@extends('layouts.app')

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
                {{Form::model(Request::only(['typeSearch','search']),['route'=>'tolist','method'=>'get'])}}
                  <div class="input-group search">
                    <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x" data-toggle="tooltip" data-placement="top" title="Busqueda Avanzada"></i></span>
                      {{Form::select('typeSearch',['Centro Medico'=>'Nombre del Centro Médico','Especialidad'=>'Especialidad Médica',  'Medico'=>'Nombre del Médico'],null,['placeholder'=>'Buscar Por:'])}}
                      {{Form::text('search',null,['class'=>'form-control','placeholder'=>'Ingresar termino de Busqueda'])}}
                      {{Form::hidden('city',null)}}
                      {{Form::hidden('state',null)}}
                  <button type="submit" class="ml-2 white"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
                  </div>
                  {{Form::close()}}
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
                  {{-- <div class="col-4">
                    <div class="col-12 mt-3">
                      <div class="form-group">
                          <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">(050km)</span>
                          </label>
                      </div>
                      <div class="form-group">
                          <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">(100km)</span>
                          </label>
                      </div>
                      <div class="form-group">
                          <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">(200km)</span>
                          </label>
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
{{-- //////////////////tableSearch MEDICOS////////tableSearch MEDICOS////////////////// --}}
            <div class="text-justify mt-3">
              @if(isset($medicosCount) and $medicosCount != 0)
                <div class="card">

                  <div class="card-header">
                    <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                    <h4>Busqueda de Medico: {{$search}}</h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead class="bg-primary text-white">
                        <tr>
                          <td>Nombre Completo</td>
                          <td>Especialidad</td>
                          <td>Ciudad</td>
                          <td>Acciones</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($medicos as $medico)
                          <tr>
                            <td>
                              {{$medico->name}} {{$medico->lastName}}
                            </td>
                            <td>
                                {{$medico->specialty}}
                            </td>
                            <td>
                              {{$medico->city}}
                            </td>
                            <td>
                              <a href="{{route("medico_perfil",$medico->id)}}" class="btn btn-primary">Ver Perfil</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    {{$medicos->appends(Request::only(['typeSearch']))->links()}}
                  </div>
                </div>
              @elseif(isset($medicosCount))
                <div class="card">
                  <div class="card-body">
                    <h5>No se Encontraron Resultados para la Busqueda de Medico: "{{$search}}"</h5>
                  </div>
                </div>
              @endif

              {{-- Busqueda Medicos por Categoria --}}
              @if(isset($medicosCount2) and $medicosCount2 != 0)
                <div class="card">

                  <div class="card-header">
                    <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                    <h4>Busqueda de Medico Por Categoria: {{$search}}</h4>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead class="bg-primary text-white">
                        <tr>
                          <td>Nombre Completo</td>
                          <td>Especialidad</td>
                          <td>Ciudad</td>
                          <td>Acciones</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($medicos2 as $medico)
                          <tr>
                            <td>
                              {{$medico->name}} {{$medico->lastName}}
                            </td>
                            <td>
                                {{$medico->specialty}}
                            </td>
                            <td>
                              {{$medico->city}}
                            </td>
                            <td>
                              <a href="{{route("medico_perfil",$medico->id)}}" class="btn btn-primary">Ver Perfil</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    {{$medicos2->appends(Request::only(['typeSearch']))->links()}}
                  </div>
                </div>
              @elseif(isset($medicosCount2))
                <div class="card">
                  <div class="card-body">
                    <h5>No se Encontraron Resultados para la Busqueda de Medico: "{{$search}}"</h5>
                      <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                  </div>
                </div>
              @endif

              {{-- Centros Medicos --}}
              <div class="text-justify mt-3">
                  @if(isset($medicalCentersCount) and $medicalCentersCount != 0)
                  <div class="card">
                    <div class="card-header">
                      <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                      <h4>Busqueda de Centro Medico:{{$search}}</h4>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                          <tr>
                            <td>Nombre</td>
                            <td>Ciudad</td>
                            <td>Acciones</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($medicalCenters as $mC)
                            <tr>
                              <td>{{$mC->name}}</td>
                              <td>{{$mC->city}}</td>
                              <td><a href="" class="btn btn-primary"><i class="far fa-hospital" data-toggle="tooltip" data-placement="top" title="Ver Perfil"></i></a> <a href="" class="btn btn-success"><i class="fas fa-user-md" data-toggle="tooltip" data-placement="top" title="Ver Medicos"></i></a></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer">
                      {{$medicalCenters->appends(Request::only(['typeSearch','search']))->links()}}
                    </div>
                  </div>
                @elseif(isset($medicalCentersCount))
                  <div class="card">
                    <div class="card-body">
                      <h5>No se Encontraron Resultados para la Busqueda del Centro Medico: "{{$search}}"</h5>
                        <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                    </div>
                  </div>
                @endif

                {{-- especialidades --}}
                <div class="text-justify mt-3">
                    @if(isset($specialtyCount) and $specialtyCount != 0)
                    <div class="card">
                      <div class="card-header">
                        <a href="{{route('home')}}" class="close"><span aria-hidden="true">&times;</span></a>
                          <h4>Busqueda de Especialidad Médica: {{$search}}</h4>
                      </div>
                      <div class="card-body">
                        <table class="table table-bordered">
                          <thead class="bg-primary text-white">
                            <tr>
                              <td>Nombre</td>
                              <td>Medicos</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($specialties as $specialty)
                              <tr>
                                <td>{{$specialty->name}}</td>
                                <td><a href="" class="btn btn-success"><i class="fas fa-user-md" data-toggle="tooltip" data-placement="top" title="Ver Medicos"></i></a></td>
                              </tr>
                            @endforeach
                          </tbody>

                        </table>

                      </div>
                      <div class="card-footer">
                        {{$specialties->appends(Request::only(['typeSearch','search']))->links()}}
                      </div>
                    </div>

                  @elseif(isset($specialtyCount) and $specialtyCount == 0)
                    <div class="card">
                      <div class="card-body">
                        <h5>No se Encontraron Resultados para la Busqueda de Especialidad Médica: "{{$search}}"</h5>
                      </div>
                    </div>
                  @endif



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
                  {{Form::open(['route'=>'tolist','method'=>'get'])}}
                    {{Form::hidden('typeSearch','Medicos y Especialistas')}}
                    <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-05.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                    {{Form::close()}}

                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  {{Form::model(Request::only(['typeSearch','search']),['route'=>'tolist','method'=>'get'])}}
                    {{Form::hidden('typeSearch','Dentistas')}}
                    <button type="submit" class="ml-2 white"><img src="{{asset('img/botones-medicossi-03.jpg')}}" alt="" width="100%" class="img-responsive"></button>
                    {{Form::close()}}

                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  {{Form::model(Request::only(['typeSearch','search']),['route'=>'tolist','method'=>'get'])}}
                    {{Form::hidden('typeSearch','Terapeutas y Nutricion')}}
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
        		<img width="100%" height="100%" src="img/Medicossi-Marca original-01.png">
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

   <input type="hidden" name="" value="{{$nada = ''}}">


    {{Form::hidden('paginate',null,['id'=>'paginate'])}} {{-- Valor Actual de el take y el skip para la paginacion de las busquedas--}}
    {{Form::hidden('paginate',null,['id'=>'paginate_skip'])}}


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


     
@endsection




   <script type="text/javascript">


   // $(document).ready(function(){
   //    tolist();
   // });
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

//Search//Search//Search//Search//Search//Search//Search//Search//Search

   function search(){

      //$('#paginate_skip').val(0);
      //skip = 0;
      route = "{{route('tolist')}}";
      var search = $('#searchVar').val();
      $('#searchModal').val(search);

         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url: route,
            data:{search:search},
            success:function(result){
               $('#listSearchAjax').empty().html(result);
               console.log(result);
            },
            error:function(error){
               console.log(error);
            },
         });
      }

      // function pag_next(){
      //
      //    skipnow = $('#paginate_skip').val();
      //    skip = parseInt(skipnow) + parseInt(2);
      //    $('#paginate_skip').val(skip);
      //    route = "{{route('tolist')}}";
      //    var search = $('#searchVar').val();
      //
      //       $.ajax({
      //          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //          type:'post',
      //          url: route,
      //          data:{search:search,skip:skip},
      //          success:function(result){
      //             $('#listSearchAjax').empty().html(result);
      //             console.log(result);
      //          },
      //          error:function(error){
      //             console.log(error);
      //          },
      //       });
      //    }
      //
      //    function pag_prev(){
      //
      //       skipnow = $('#paginate_skip').val();
      //
      //       skip = parseInt(skipnow) - parseInt(2);
      //       if(skip < 0){
      //         $('#paginate_skip').val(0);
      //       }else{
      //         $('#paginate_skip').val(skip);
      //       }
      //
      //       route = "{{route('tolist')}}";
      //       var search = $('#searchVar').val();
      //
      //          $.ajax({
      //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //             type:'post',
      //             url: route,
      //             data:{search:search,skip:skip},
      //             success:function(result){
      //                $('#listSearchAjax').empty().html(result);
      //                console.log(result);
      //             },
      //             error:function(error){
      //                console.log(error);
      //             },
      //          });
      //       }
   </script>

@endsection
