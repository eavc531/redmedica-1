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
							<div class="col-6">


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
							<div class="col-6 text-center">
								<label for="">Barra de progreso</label>
								<div class="progress">
								  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%; vertical-align: center;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
						<hr>
						<div id="alert_error_medic" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
							<p id="text_error_medic"></p>
					 </div>
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
						<div class="col-lg-6 col-12">
							<div class="form-group">
								<label for="">Cedula</label>
								{!!Form::text('identification',null,['class'=>'form-control','id'=>'identificationMedic'])!!}
						 </div>
                <div class="form-group">
                  <div class="row">
                      <div class="col-8" style="text-align:justify">
                        <p for="">¿Desea que su numero celular aparezca visible en formatos e información a pacientes?</p>
                      </div>
                      <div class="col-4">
                           {{Form::select('showNumber',['si'=>'si','no'=>'no'],null,['class'=>'form-control'])}}
                      </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-6">

                  <div class="col-6">
                    <button type="submit" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
										<button onclick="updateMedic()" type="button" name="button">test</button>
                  </div>
									{!!Form::close()!!}
                </div>

          <hr>

          <div class="row">
            <div class="col-12">
              <h4 class="font-title-blue">Consultorios</h4>
            <hr>

              <table class="table config-table">
                <thead>
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
                  @endforeach
                </tbody>
                <tfoot>
                  <td colspan="7">{{$info_medico->links()}}</td>
                </tfoot>
              </table>
            </div>
          </div>
					<div class="row">
						<div class="col-12 text-right">
							<a href="{{route('consulting_room_create',$medico->id)}}" class="btn btn-config-blue">Agregar Consultorio</a>
						</div>
					</div>
          @if($consultingIsset == 0)

          @endif
								<hr>
                <div class="box-panel-register">
                   <div class="row mt-3">
                     <div class="col-12 text-center">
                       <h4 class="font-title-blue">Especialidad/Estudios Realizados</h4>
                     <hr>
                     </div>
                   </div>
                   <div class="row">
                     <div class="">
                           <table class="table table-config">
                             <thead>
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
                               <td colspan="7">{{$info_medico->links()}}</td>
                             </tfoot>
                           </table>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-12 text-right">
                       <a href="{{route('info_medicoCreate',$medico->id)}}" class="btn btn-config-blue">Agregar Especialidad/Estudios Realizados</a>
                     </div>
                   </div>
                 </div>

							<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Servicios otorgados</h4>
									<hr>
								</div>
							</div>

              <div id="list_service_ajax" style="text-align:justify">

                </div>

							<div class="row">
						  		<div class="col-12 text-right">


						  			<a href="" data-toggle="modal" data-target="#modal-service2" class="btn btn-config-blue">Agregar servicio</a>
								<hr>
						  		</div>
						  	</div>
						  	</div>

						  	<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Experiencia en transtornos mentales</h4>
									<hr>
								</div>
							</div>

              <div class="row">

                  <div class="col-lg-2 col-12">
                    <div class="form-group">
                    <a href="" data-toggle="modal" data-target="#modal-experience" class="btn btn-config-blue">Agregar Experiencia</a>
                     </div>
                  </div>
              </div>
              <div id="medico_experience_ajax" style="text-align:justify">

              </div>

						  	<div class="row mt-3">
								<div class="col-12">
									<h4 id="imgs" class="font-title-blue">Agrega videos y fotos</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
								 <div class="form-group">

								    <div class="input-group col-xs-12">

											@include('medico.alert2.alert2')

										<div class="" id="">
												@foreach ($images as $image)
													{{-- div que encierra cada imagen --}}
													<div class="">
														<img src="{{asset($image->path)}}" width="120px" height="80px" alt="">
														<a onclick="return confirm('¿Esta seguro de eliminar esta Imagen?')"href="{{route('photo_delete',$image->id)}}">x</a>
													</div>
												@endforeach
										</div>

												{!!Form::open(['route'=>'image_store','method'=>'POST','files'=>true])!!}
												{!!Form::file('image')!!}
												{!!Form::hidden('medico_id',$medico->id)!!}
												{!!Form::hidden('email',$medico->email)!!}
												{!!Form::submit('Subir Imagen',['class'=>'btn btn-primary'])!!}
												{!!Form::close()!!}
								    </div>
								  </div>
								</div>

							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h4 class="font-title-blue">Mis redes sociales</h4>
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
                          <button onclick="storeSocial()" type="button" name="button" class="btn btn-primary">Agregar</button>

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
							<h4 class="font-title-blue">Aseguradoras</h4>
							<hr>
							<div class="">

							</div>



	</section>

{{-- //////////////////Modals///////////////////////////////////////MODALS//////////////// --}}

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

					<button onclick="service_medico_experience()" name="button" class="btn btn-block btn-config-green">Agregar</button>
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

							<button onclick="service_medico_store()" name="button" class="btn btn-block btn-config-green">Agregar</button>
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
			 $('#alert_error_medic').html('<ul>'+errormsj+'</ul>');
			 $('#alert_error_medic').fadeIn();
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
