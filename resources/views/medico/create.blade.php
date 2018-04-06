@extends('layouts.app')

@section('content')


	<section class="box-register">
		<div class="row">
	    <div class="col-12 text-right">
	      <div class="btn-group " role="group" aria-label="Basic example">
	        <button type="button" class="btn btn-config-blue">1</button>
	        <button type="button" class="btn btn-secondary">2</button>
	        <button type="button" class="btn btn-secondary">3</button>
	      </div>
	    </div>
	  </div>
		<div class="container">
			<div class="register">
				<div class="row">
					<div class="col-12 mb-3">
						<h2 class="text-center font-title">Registro de profesionales de la Salud</h2>
					</div>
				</div>
						{!!Form::open(['route'=>'medico.store','method'=>'POST'])!!}
						{{-- <div class="row mt-2">
							<div class="col-lg-12 col-12">
								<div class="form-group">
								    {!!Form::text('identification',null,['class'=>'form-control','placeholder'=>'Cedula'])!!}
								</div>
							</div>
						</div> --}}
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre'])!!}
								</div>
							</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
									     {!!Form::text('lastName',null,['class'=>'form-control','placeholder'=>'Apellido'])!!}
									 </div>
								</div>
						</div>
						<div class="row">
							<div class="col-6">
								  <div class="form-group">
								    	{!!Form::select('gender',['Masculino','Femenino'],null,['class'=>'form-control','placeholder'=>'Sexo'])!!}
								  </div>
							</div>
							<div class="col-6">
								  	<div class="form-group">
								    	{!!Form::select('city',$cities,null,['class'=>'form-control','placeholder'=>'Ciudad'])!!}
								  </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								    {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
								</div>
							</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
									   {!!Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])!!}
									 </div>
								</div>
						</div>

						{{-- <div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								   {!!Form::select('medicalCenter_id',$medicalCenter,null,['class'=>'form-control','placeholder'=>'Centro Medico'])!!}
								</div>
							</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
									   {!!Form::text('id_promoter',null,['class'=>'form-control','placeholder'=>'id del Promotor (Opcional)'])!!}
									 </div>
								</div>
							</div> --}}
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
								     {!!Form::text('phone',null,['class'=>'form-control','placeholder'=>'Teléfono'])!!}
								</div>
							</div>
							{{-- <div class="col-lg-6 col-12">
								<div class="form-group">
									 {!!Form::text('facebook',null,['class'=>'form-control','placeholder'=>'Facebook'])!!}
								</div>
							</div> --}}
						</div>

						<div class="row">
						 <div class="col-lg-6 col-12 mt-2">
							 <a href="" class="btn-config-blue btn btn-block">Limpiar</a>
						 </div>
						 <div class="col-lg-6 col-12 mt-2">
							 <button type="submit" class="btn-config-green btn btn-block">Registrar</button>
						 </div>
					 </div>
					  <div class="row">

					{!!Form::close()!!}
			</div>
		</div>
	</section>
@endsection
