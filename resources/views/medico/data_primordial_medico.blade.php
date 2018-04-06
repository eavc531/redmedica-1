@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="register">
      <div class="row">
        <div class="col-12">
            <h5>Bienevenido: {{$medico->name}} {{$medico->lastName}}</h5>
            <p>Por Favor rellene los datos a continuación, requeridos para poder gestionar correctamente todas las funciones de nuestro  sistema.</p>

        </div>
      </div>

{!!Form::model($medico,['route'=>['medico.update',$medico],'method'=>'PUT','id'=>'person'])!!}
<div class="row">
  <div class="col-lg-6 col-12">
    <div class="form-group">
        <label for="">Nombre</label>
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
      <label for="">Cedula</label>
      {!!Form::text('identification',null,['class'=>'form-control','id'=>'identificationMedic'])!!}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="form-group">

   </div>
 </div>
</div>
    <div class="row">
      <div class="col-6">
        <button type="submit" name="button" class="btn btn-primary btn-block">Guardar Cambios</button>
      </div>
      {!!Form::close()!!}
    </div>
          </div>
      </div>
@endsection
