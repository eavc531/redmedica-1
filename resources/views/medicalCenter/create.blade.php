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
          <h2 class="text-center font-title">Registro de centro médico</h2>
        </div>
      </div>


        {!!Form::open(['route'=>'medicalCenter.store','method'=>'POST'])!!}

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Centro Medico'])}}
                </div>
                <div class="form-group">
                  {{Form::text('nameAdmin',null,['class'=>'form-control','placeholder'=>'Nombre del Administrador'])}}
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="form-group">

                  {{Form::text('phone_admin',null,['class'=>'form-control','placeholder'=>'Telefono'])}}
                 </div>
                <div class="form-group">
                  {{Form::select('country',$countries,'México',['class'=>'form-control'])}}
                </div>
            </div>
          </div>
          <div class=row>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::email('emailAdmin',null,['class'=>'form-control','placeholder'=>'Correo del Administrador'])}}
              </div>

            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                {{Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])}}
              </div>

            </div>
          </div>


          <div class="row">
            <div class="col-lg-6 col-12 mt-2">
              <a href="{{route('medicalCenter.create')}}" class="btn-config-blue btn btn-block">Limpiar</a>
            </div>
            <div class="col-lg-6 col-12 mt-2">
              <button type="submit" class="btn-config-green btn btn-block">Registrar</button>
            </div>
          </div>
         {!!Form::close()!!}
    </div>
  </div>
</section>
@endsection
