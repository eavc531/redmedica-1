{!!Form::select('hourStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24'],null,['class'=>'form-control','id'=>'hourStart'])!!}
  {!!Form::select('minsStart',['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'],null,['class'=>'form-control','id'=>'minsStart'])!!}


@extends('layouts.app')

@section('content')
    <div class="">

      <a href="{{route('medico_diary_events')}}">Agenda 2</a>

    </div>
        @if(!isset(Auth::user()->id))
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12">
            <h5 class="font-title-index">¿Ya eres un profesional registrado?</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-12 pull-right">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12 p-1">
                <a href="" data-toggle="modal" data-target="#modal-register"><img class="box-shadox" src="img/botones-medicossi-18.png"></a>
              </div>
              <div class="col-lg-6 col-md-6 col-12 p-1">
                <a href="" data-toggle="modal" data-target="#modal-login"><img class="box-shadox" src="img/botones-medicossi-20.png"></a>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="row box-index mt-4">
          <div class="col-12">
            <div id="flip">
              <div class="col-lg-12">
                  <div class="input-group search">
                    <span class="mr-2 white" id="filter"><i class="fas fa-filter fa-2x"></i></span>
                      <input type="text" class="form-control search" placeholder="Search for..." id="searchVar">
                  <button onclick="search()" type="button" class="ml-2 white" data-toggle="modal" data-target=".bd-example-modal-lg"><span id="filter"><i class="fas fa-search fa-2x"></i></span></button>
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
                  </div>
                </div>
              </div>
            </div>
            <div class="row my-5">
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  <a href=""><img src="img/botones-medicossi-01.jpg" alt="" width="100%" class="img-responsive"></a>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  <a href=""><img src="img/botones-medicossi-05.jpg" alt="" width="100%" class="img-responsive"></a>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  <a href=""><img src="img/botones-medicossi-03.jpg" alt="" width="100%" class="img-responsive"></a>
                </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="box-img">
                  <a href=""><img src="img/botones-medicossi-11.jpg" alt="" width="100%" class="img-responsive"></a>
                </div>
              </div>
            </div>
          </div>
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
   @include('home.modals')
@endsection

@section('scriptJS')
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
   // function search(){
   //
   //    route = "{{route('tolist')}}";
   //    search = $('#searchVar').val();
   //
   //
   //
   //       $.ajax({
   //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   //          type:'post',
   //          url: route,
   //          data:{search:search},
   //          success:function(result){
   //             $('#listSearchAjax').empty().html(result);
   //             console.log(result);
   //          }
   //       });
   //    }
   </script>

@endsection
